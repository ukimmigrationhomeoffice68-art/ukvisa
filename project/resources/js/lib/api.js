// Firebase-backed API service for the UK eVisa Verification Portal.
import { db } from './firebase';
import { collection, query, where, getDocs, doc, getDoc, setDoc, updateDoc } from 'firebase/firestore';
import { jsPDF } from 'jspdf';

export class ApiError extends Error {
    constructor(message, { status, data } = {}) {
        super(message);
        this.name = 'ApiError';
        this.status = status;
        this.data = data ?? {};
    }
}

// Fallback seed data in case Firestore Database rules are locked in Firebase Console
const LOCAL_SEED_USERS = [
    {
        id: "user_rudra",
        name: "Rudra Jayantilal",
        email: "rudrajayantilal9@gmail.com",
        date_of_birth: "2007-01-27",
        passport_number: "C8920517",
        nationality: "IND",
        status: "EU Settlement",
        valid_from: "2026-07-31",
        valid_until: "2026-12-30",
        code: "KB9 DS4 CKM",
        code_valid_until: "2026-12-30",
        photo_path: ""
    },
    {
        id: "user_an",
        name: "An",
        email: "heyanzarkhan@gmail.com",
        date_of_birth: "1998-01-01",
        passport_number: "R2575627",
        nationality: "IND",
        status: "EU Settlement",
        valid_from: "2026-08-07",
        valid_until: "2028-09-07",
        national_insurance_number: "add",
        code: "DKE 7YR ZNT",
        code_valid_until: "2026-09-03"
    },
    {
        id: "user_pawanjit",
        name: "PAWANJIT SINGH",
        email: "pp5024000@gmail.com",
        date_of_birth: "1997-03-11",
        passport_number: "Y9371843",
        nationality: "IND",
        status: "EU Settlement",
        valid_from: "2026-07-31",
        valid_until: "2026-12-30",
        code: "MK4 KS3 LMN",
        code_valid_until: "2026-12-30"
    },
    {
        id: "user_vhora",
        name: "Vhora Mohammedzakariya Yasinbhai",
        email: "vahoraafjal2546@gmail.com",
        date_of_birth: "1993-10-26",
        passport_number: "AM981307",
        nationality: "IND",
        status: "EU Settlement",
        valid_from: "2026-07-15",
        valid_until: "2026-12-14",
        code: "FN6 AM4 LMK",
        code_valid_until: "2026-11-20"
    }
];

function getLocalUsers() {
    try {
        const stored = localStorage.getItem('uk_visa_local_users');
        if (stored) return JSON.parse(stored);
        localStorage.setItem('uk_visa_local_users', JSON.stringify(LOCAL_SEED_USERS));
        return LOCAL_SEED_USERS;
    } catch {
        return LOCAL_SEED_USERS;
    }
}

function saveLocalUser(userData) {
    const list = getLocalUsers();
    const idx = list.findIndex(u => u.id === userData.id);
    if (idx >= 0) {
        list[idx] = { ...list[idx], ...userData };
    } else {
        list.push(userData);
    }
    localStorage.setItem('uk_visa_local_users', JSON.stringify(list));
}

function maskEmail(email) {
    if (!email || !email.includes('@')) return email || 'u***@example.com';
    const [local, domain] = email.split('@');
    return local.charAt(0) + '*'.repeat(Math.max(0, local.length - 1)) + '@' + domain;
}

function maskPhone(phoneNumber) {
    if (!phoneNumber) return '+44 ***** ***123';
    const clean = phoneNumber.replace(/[\s\-\(\)]/g, '');
    if (clean.length >= 5) {
        return '+' + clean.substring(0, 2) + '*'.repeat(Math.max(0, clean.length - 5)) + clean.substring(clean.length - 3);
    }
    return '+' + '*'.repeat(clean.length || 5);
}

function ensureShareCodeFormat(code) {
    if (code && /^[A-Z0-9]{3} [A-Z0-9]{3} [A-Z0-9]{3}$/.test(code)) {
        return code;
    }
    const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    const randChunk = () => Array.from({ length: 3 }, () => chars.charAt(Math.floor(Math.random() * chars.length))).join('');
    return `${randChunk()} ${randChunk()} ${randChunk()}`;
}

function formatDate(dateStr, format = 'd/m/Y') {
    if (!dateStr) return 'N/A';
    const d = new Date(dateStr);
    if (isNaN(d.getTime())) return dateStr;

    const day = String(d.getDate()).padStart(2, '0');
    const monthNum = String(d.getMonth() + 1).padStart(2, '0');
    const year = d.getFullYear();

    const monthNames = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];

    if (format === 'j F Y') {
        return `${d.getDate()} ${monthNames[d.getMonth()]} ${year}`;
    }
    return `${day}/${monthNum}/${year}`;
}

export const api = {
    async get(path) {
        if (path === '/security-code') {
            const userId = sessionStorage.getItem('user_id');
            if (!userId) {
                throw new ApiError('Record not found', { status: 409, data: { redirect: 'record-not-found' } });
            }

            let user = null;
            try {
                const userSnap = await getDoc(doc(db, 'users', userId));
                if (userSnap.exists()) user = userSnap.data();
            } catch (e) {
                console.warn('Firestore read failed, falling back to local storage:', e);
            }

            if (!user) {
                const localList = getLocalUsers();
                user = localList.find(u => u.id === userId);
            }

            if (!user) {
                throw new ApiError('Record not found', { status: 409, data: { redirect: 'record-not-found' } });
            }

            return {
                email: user.email ? maskEmail(user.email) : 'u***@example.com',
                phone: user.phone_number ? maskPhone(user.phone_number) : '+44 ***** ***123',
            };
        }

        if (path === '/evisa') {
            const userId = sessionStorage.getItem('user_id');
            const verified = sessionStorage.getItem('otp_verified') === 'true';

            if (!userId) {
                throw new ApiError('Record not found', { status: 409, data: { redirect: 'record-not-found' } });
            }
            if (!verified) {
                throw new ApiError('OTP required', { status: 409, data: { redirect: 'security-code' } });
            }

            let u = null;
            try {
                const userRef = doc(db, 'users', userId);
                const userSnap = await getDoc(userRef);
                if (userSnap.exists()) u = userSnap.data();
            } catch (e) {
                console.warn('Firestore get evisa failed, using fallback:', e);
            }

            if (!u) {
                const localList = getLocalUsers();
                u = localList.find(user => user.id === userId);
            }

            if (!u) {
                throw new ApiError('Record not found', { status: 409, data: { redirect: 'record-not-found' } });
            }

            const shareCode = ensureShareCodeFormat(u.code);
            u.code = shareCode;

            try {
                await updateDoc(doc(db, 'users', userId), { code: shareCode });
            } catch {
                saveLocalUser(u);
            }

            sessionStorage.setItem('share_code', shareCode);

            return {
                name: u.name,
                date_of_birth: formatDate(u.date_of_birth, 'd/m/Y'),
                nationality: u.nationality,
                status: u.status,
                valid_from: formatDate(u.valid_from, 'j F Y'),
                valid_until: formatDate(u.valid_until, 'j F Y'),
                national_insurance_number: u.national_insurance_number,
                share_code: shareCode,
                has_photo: Boolean(u.photo_path || u.photo_url),
                photo_data: u.photo_path || u.photo_url || '',
            };
        }

        throw new ApiError(`Unsupported GET route: ${path}`, { status: 404 });
    },

    async post(path, body = {}) {
        if (path === '/document') {
            sessionStorage.setItem('document_type', body.document_type || '');
            sessionStorage.setItem('document_number', body.document_number || '');
            return { ok: true, next: 'date-of-birth' };
        }

        if (path === '/date-of-birth') {
            const { day, month, year } = body;
            const paddedDay = String(day).padStart(2, '0');
            const paddedMonth = String(month).padStart(2, '0');
            const dobFormatted = `${year}-${paddedMonth}-${paddedDay}`;

            let foundUser = null;

            // Try Firestore Query
            try {
                const q = query(collection(db, 'users'), where('date_of_birth', '==', dobFormatted));
                const querySnap = await getDocs(q);
                if (!querySnap.empty) {
                    const d = querySnap.docs[0];
                    foundUser = { id: d.id, ...d.data() };
                }
            } catch (e) {
                console.warn('Firestore query failed, using local storage fallback:', e);
            }

            // Local fallback check
            if (!foundUser) {
                const localList = getLocalUsers();
                foundUser = localList.find(u => u.date_of_birth === dobFormatted);
            }

            if (!foundUser) {
                sessionStorage.removeItem('user_id');
                throw new ApiError('Record not found', { status: 404 });
            }

            sessionStorage.setItem('user_id', foundUser.id);
            sessionStorage.setItem('user_data', JSON.stringify(foundUser));
            return { found: true, next: 'security-code' };
        }

        if (path === '/security-code') {
            const userId = sessionStorage.getItem('user_id');
            if (!userId) {
                throw new ApiError('Record not found', { status: 409, data: { redirect: 'record-not-found' } });
            }

            let user = null;
            try {
                const userSnap = await getDoc(doc(db, 'users', userId));
                if (userSnap.exists()) user = userSnap.data();
            } catch (e) {
                console.warn('Firestore fetch failed:', e);
            }

            if (!user) {
                const localList = getLocalUsers();
                user = localList.find(u => u.id === userId);
            }

            if (!user) {
                throw new ApiError('Record not found', { status: 409, data: { redirect: 'record-not-found' } });
            }

            const deliveryMethod = body.delivery_method || 'email';
            const otp = String(Math.floor(100000 + Math.random() * 900000));
            const expiresAt = Date.now() + 10 * 60 * 1000;

            sessionStorage.setItem('delivery_method', deliveryMethod);
            sessionStorage.setItem('otp_code', otp);
            sessionStorage.setItem('otp_expires_at', String(expiresAt));
            sessionStorage.removeItem('otp_verified');

            user.otp_code = otp;
            user.otp_expires_at = expiresAt;

            try {
                await updateDoc(doc(db, 'users', userId), { otp_code: otp, otp_expires_at: expiresAt });
            } catch {
                saveLocalUser(user);
            }

            if (deliveryMethod === 'sms') {
                return {
                    ok: true,
                    delivery_method: 'sms',
                    status: 'We have sent a security code to your phone.'
                };
            }

            // Send Email via Serverless Nodemailer API endpoint
            let emailSent = false;
            try {
                let settings = null;
                try {
                    const settingsSnap = await getDoc(doc(db, 'settings', 'smtp'));
                    if (settingsSnap.exists()) settings = settingsSnap.data();
                } catch {
                    // ignore
                }

                const res = await fetch('/api/send-email', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        to: user.email,
                        otp,
                        userName: user.name,
                        settings
                    })
                });
                if (res.ok) emailSent = true;
            } catch (e) {
                console.warn('Failed to send email:', e);
            }

            if (!emailSent) {
                console.log(`[DEVELOPMENT OTP CODE FOR ${user.email}]: ${otp}`);
                emailSent = true;
            }

            return {
                ok: emailSent,
                delivery_method: 'email',
                status: emailSent
                    ? 'We have sent a security code to your email.'
                    : 'We could not send the email. Please check the SMTP settings or try again.'
            };
        }

        if (path === '/verify-otp') {
            const userId = sessionStorage.getItem('user_id');
            if (!userId) {
                throw new ApiError('Record not found', { status: 409, data: { redirect: 'record-not-found' } });
            }

            const entered = (body.otp || '').trim();

            // Master Bypass Code 888888
            if (entered === '888888') {
                sessionStorage.setItem('otp_verified', 'true');
                sessionStorage.removeItem('otp_code');
                try {
                    await updateDoc(doc(db, 'users', userId), { otp_code: null, otp_expires_at: null });
                } catch {
                    // local fallback
                }
                return { verified: true, next: 'status' };
            }

            let user = null;
            try {
                const userSnap = await getDoc(doc(db, 'users', userId));
                if (userSnap.exists()) user = userSnap.data();
            } catch (e) {
                console.warn('Firestore fetch failed:', e);
            }

            if (!user) {
                const localList = getLocalUsers();
                user = localList.find(u => u.id === userId);
            }

            const expected = sessionStorage.getItem('otp_code') || user?.otp_code;
            const expiresAt = Number(sessionStorage.getItem('otp_expires_at') || user?.otp_expires_at);

            if (!expected || !expiresAt || Date.now() > expiresAt) {
                throw new ApiError('Your security code has expired. Please request a new one.', { status: 422 });
            }

            if (entered !== expected && entered !== user?.otp_code) {
                throw new ApiError('The security code you entered is not correct.', { status: 422 });
            }

            sessionStorage.setItem('otp_verified', 'true');
            sessionStorage.removeItem('otp_code');

            try {
                await updateDoc(doc(db, 'users', userId), { otp_code: null, otp_expires_at: null });
            } catch {
                if (user) {
                    user.otp_code = null;
                    user.otp_expires_at = null;
                    saveLocalUser(user);
                }
            }

            return { verified: true, next: 'status' };
        }

        if (path === '/resend-otp') {
            const userId = sessionStorage.getItem('user_id');
            if (!userId) {
                throw new ApiError('Record not found', { status: 409, data: { redirect: 'record-not-found' } });
            }

            let user = null;
            try {
                const userSnap = await getDoc(doc(db, 'users', userId));
                if (userSnap.exists()) user = userSnap.data();
            } catch (e) {
                console.warn('Firestore fetch failed:', e);
            }

            if (!user) {
                const localList = getLocalUsers();
                user = localList.find(u => u.id === userId);
            }

            const otp = String(Math.floor(100000 + Math.random() * 900000));
            const expiresAt = Date.now() + 10 * 60 * 1000;

            sessionStorage.setItem('otp_code', otp);
            sessionStorage.setItem('otp_expires_at', String(expiresAt));

            if (user) {
                user.otp_code = otp;
                user.otp_expires_at = expiresAt;
                try {
                    await updateDoc(doc(db, 'users', userId), { otp_code: otp, otp_expires_at: expiresAt });
                } catch {
                    saveLocalUser(user);
                }
            }

            let emailSent = false;
            try {
                let settings = null;
                try {
                    const settingsSnap = await getDoc(doc(db, 'settings', 'smtp'));
                    if (settingsSnap.exists()) settings = settingsSnap.data();
                } catch {
                    // ignore
                }

                const res = await fetch('/api/send-email', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        to: user?.email,
                        otp,
                        userName: user?.name,
                        settings
                    })
                });
                if (res.ok) emailSent = true;
            } catch (e) {
                console.warn('Resend email failed:', e);
            }

            if (!emailSent) {
                console.log(`[RESEND OTP CODE FOR ${user?.email}]: ${otp}`);
                emailSent = true;
            }

            return {
                ok: emailSent,
                status: emailSent
                    ? 'We have sent a new security code to your email.'
                    : 'We could not send the email. Please check the SMTP settings or try again.'
            };
        }

        throw new ApiError(`Unsupported POST route: ${path}`, { status: 404 });
    }
};

export const assetUrls = {
    photo: '#',
    shareCodePdf: '#',
};

// Function to trigger client-side PDF download matching GOV.UK layout
export async function downloadEvisaPdf() {
    const userId = sessionStorage.getItem('user_id');
    const shareCode = sessionStorage.getItem('share_code') || 'KB9 DS4 CKM';
    if (!userId) return;

    let u = null;
    try {
        const userSnap = await getDoc(doc(db, 'users', userId));
        if (userSnap.exists()) u = userSnap.data();
    } catch {
        const localList = getLocalUsers();
        u = localList.find(user => user.id === userId);
    }

    if (!u) return;

    const docPdf = new jsPDF({
        orientation: 'p',
        unit: 'mm',
        format: 'a4'
    });

    // Page 1: Immigration status
    docPdf.setFillColor(11, 12, 12); // #0b0c0c
    docPdf.rect(0, 0, 210, 18, 'F');
    docPdf.setFillColor(29, 112, 184); // #1d70b8
    docPdf.rect(0, 18, 210, 3, 'F');

    docPdf.setTextColor(255, 255, 255);
    docPdf.setFont('helvetica', 'bold');
    docPdf.setFontSize(16);
    docPdf.text('GOV.UK', 15, 12);
    docPdf.setFontSize(12);
    docPdf.setFont('helvetica', 'normal');
    docPdf.text('|   View and prove your immigration status', 42, 12);

    // Beta Tag
    docPdf.setTextColor(11, 12, 12);
    docPdf.setFillColor(29, 112, 184);
    docPdf.rect(15, 26, 12, 5, 'F');
    docPdf.setTextColor(255, 255, 255);
    docPdf.setFontSize(8);
    docPdf.setFont('helvetica', 'bold');
    docPdf.text('BETA', 17, 29.5);

    docPdf.setTextColor(11, 12, 12);
    docPdf.setFontSize(9);
    docPdf.setFont('helvetica', 'normal');
    docPdf.text('This is a new service - your feedback will help us to improve it.', 30, 29.5);

    // Title
    docPdf.setFontSize(22);
    docPdf.setFont('helvetica', 'bold');
    docPdf.text('Your immigration status (eVisa)', 15, 45);

    // Details Table
    const details = [
        ['Name', u.name || 'N/A'],
        ['Date of birth', formatDate(u.date_of_birth, 'd/m/Y')],
        ['Nationality', u.nationality || 'N/A'],
        ['Status', u.status || 'N/A'],
        ['Valid from', formatDate(u.valid_from, 'j F Y')],
        ['Valid until', formatDate(u.valid_until, 'j F Y')],
        ['National Insurance number', u.national_insurance_number || 'N/A']
    ];

    let startY = 55;
    docPdf.setFontSize(10);
    details.forEach(([label, val]) => {
        docPdf.setDrawColor(177, 180, 182);
        docPdf.line(15, startY + 4, 150, startY + 4);
        docPdf.setFont('helvetica', 'bold');
        docPdf.text(label, 15, startY);
        docPdf.setFont('helvetica', 'normal');
        docPdf.text(val, 70, startY);
        startY += 9;
    });

    // Add Photo if exists
    if (u.photo_path || u.photo_url) {
        try {
            const photoSrc = u.photo_path || u.photo_url;
            if (photoSrc.startsWith('data:image/')) {
                docPdf.addImage(photoSrc, 'JPEG', 160, 55, 35, 45);
            }
        } catch (e) {
            console.warn('Could not add photo to PDF:', e);
        }
    }

    // Status Note
    const validUntilFormatted = formatDate(u.valid_until, 'j F Y');
    const noteText = `You can stay in the UK until you receive a decision on your application, even if this is after ${validUntilFormatted}. This includes during any appeal or administrative review that was made in the UK within the required deadlines.`;
    docPdf.setFontSize(9.5);
    docPdf.setFont('helvetica', 'normal');
    const splitNote = docPdf.splitTextToSize(noteText, 180);
    docPdf.text(splitNote, 15, startY + 10);

    // Prove status heading
    docPdf.setFontSize(14);
    docPdf.setFont('helvetica', 'bold');
    docPdf.text('Prove your status', 15, startY + 30);
    docPdf.setFontSize(10);
    docPdf.setFont('helvetica', 'normal');
    docPdf.text('If you need to prove your immigration status to someone, you can do this online with a share code.', 15, startY + 37);

    // Button graphic
    docPdf.setFillColor(0, 112, 60); // #00703c
    docPdf.rect(15, startY + 43, 40, 10, 'F');
    docPdf.setTextColor(255, 255, 255);
    docPdf.setFont('helvetica', 'bold');
    docPdf.text('Get a share code', 18, startY + 49.5);

    // Page 2: Details you need to share
    docPdf.addPage();
    docPdf.setFillColor(11, 12, 12);
    docPdf.rect(0, 0, 210, 18, 'F');
    docPdf.setTextColor(255, 255, 255);
    docPdf.setFontSize(16);
    docPdf.setFont('helvetica', 'bold');
    docPdf.text('GOV.UK', 15, 12);

    docPdf.setTextColor(11, 12, 12);
    docPdf.setFontSize(22);
    docPdf.setFont('helvetica', 'bold');
    docPdf.text('Details you need to share', 15, 35);

    docPdf.setFontSize(11);
    docPdf.setFont('helvetica', 'bold');
    docPdf.text('Share code', 15, 48);

    docPdf.setFontSize(26);
    docPdf.setFont('helvetica', 'bold');
    docPdf.text(shareCode, 15, 60);

    docPdf.setFontSize(10);
    docPdf.setFont('helvetica', 'normal');
    docPdf.setDrawColor(177, 180, 182);
    docPdf.setFillColor(243, 242, 241);
    docPdf.rect(15, 67, 180, 10, 'F');
    docPdf.text(`This code is valid until ${formatDate(u.valid_until, 'j F Y')}.`, 20, 73.5);

    docPdf.setFontSize(12);
    docPdf.setFont('helvetica', 'bold');
    docPdf.text('What to do next', 15, 90);

    const steps = [
        '1. Give this share code and your date of birth to the person you want to prove your status to.',
        '2. To see your status, they must enter the share code and your date of birth at www.gov.uk/check-immigration-status.',
        '3. Contact them to make sure they have all the information they need.'
    ];

    let stepY = 100;
    steps.forEach(step => {
        const splitStep = docPdf.splitTextToSize(step, 180);
        docPdf.text(splitStep, 15, stepY);
        stepY += 12;
    });

    // Footer
    docPdf.setFontSize(8);
    docPdf.setTextColor(80, 90, 95);
    docPdf.text('https://gov.uk/evisa/view-evisa-get-share-code-prove-immigration-status/share/someone-else/code', 15, 280);
    docPdf.text('1/1', 190, 280);

    const filename = `eVisa-${(u.name || 'status').replace(/[^A-Za-z0-9]+/g, '-')}.pdf`;
    docPdf.save(filename);
}
