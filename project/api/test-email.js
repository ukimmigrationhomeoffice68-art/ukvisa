import nodemailer from 'nodemailer';

export default async function handler(req, res) {
    res.setHeader('Access-Control-Allow-Credentials', true);
    res.setHeader('Access-Control-Allow-Origin', '*');
    res.setHeader('Access-Control-Allow-Methods', 'GET,OPTIONS,PATCH,DELETE,POST,PUT');
    res.setHeader(
        'Access-Control-Allow-Headers',
        'X-CSRF-Token, X-Requested-With, Accept, Accept-Version, Content-Length, Content-MD5, Content-Type, Date, X-Api-Version'
    );

    if (req.method === 'OPTIONS') {
        return res.status(200).end();
    }

    if (req.method !== 'POST') {
        return res.status(455).json({ error: 'Method Not Allowed' });
    }

    try {
        const { test_email, settings } = req.body || {};

        if (!test_email) {
            return res.status(400).json({ error: 'Missing test_email parameter' });
        }

        const host = settings?.mail_host || 'smtp.gmail.com';
        const port = parseInt(settings?.mail_port || '587', 10);
        const user = settings?.mail_username || 'matinshaikh79070@gmail.com';
        const pass = settings?.mail_password || 'ekge iphu botc Ipth';
        const fromAddr = settings?.mail_from_address || user;
        const fromName = settings?.mail_from_name || 'GOV.UK VISA';

        const transporter = nodemailer.createTransport({
            host,
            port,
            secure: port === 465,
            auth: {
                user,
                pass,
            },
            tls: {
                rejectUnauthorized: false
            }
        });

        await transporter.sendMail({
            from: `"${fromName}" <${fromAddr}>`,
            to: test_email,
            subject: 'SMTP test email',
            text: 'This is a test email from your GOV.UK VISA CO admin panel. Your SMTP settings are working.',
        });

        return res.status(200).json({ ok: true, message: `Test email sent successfully to ${test_email}.` });
    } catch (err) {
        console.error('SMTP Test email failed:', err);
        return res.status(500).json({ error: err.message || 'Failed to send test email' });
    }
}
