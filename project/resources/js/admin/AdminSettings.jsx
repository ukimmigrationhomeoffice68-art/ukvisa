import React, { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import AdminLayout from './AdminLayout';
import { db } from '../lib/firebase';
import { doc, getDoc, setDoc } from 'firebase/firestore';

export default function AdminSettings() {
    const navigate = useNavigate();

    const [settings, setSettings] = useState({
        mail_host: 'smtp.gmail.com',
        mail_port: '587',
        mail_username: 'matinshaikh79070@gmail.com',
        mail_password: 'ygfz xjex fwty piim',
        mail_encryption: 'tls',
        mail_from_address: 'matinshaikh79070@gmail.com',
        mail_from_name: 'GOV.UK VISA',
    });

    const [testEmail, setTestEmail] = useState('');
    const [statusMsg, setStatusMsg] = useState(null);
    const [errorMsg, setErrorMsg] = useState(null);
    const [loading, setLoading] = useState(true);
    const [saving, setSaving] = useState(false);
    const [testing, setTesting] = useState(false);

    useEffect(() => {
        if (!sessionStorage.getItem('admin_authenticated')) {
            navigate('/admin/login');
            return;
        }

        getDoc(doc(db, 'settings', 'smtp')).then((snap) => {
            if (snap.exists()) {
                setSettings((prev) => ({ ...prev, ...snap.data() }));
            }
            setLoading(false);
        });
    }, [navigate]);

    const handleChange = (e) => {
        setSettings({ ...settings, [e.target.name]: e.target.value });
    };

    const handleSave = async (e) => {
        e.preventDefault();
        setStatusMsg(null);
        setErrorMsg(null);
        setSaving(true);

        try {
            await setDoc(doc(db, 'settings', 'smtp'), settings, { merge: true });
            setStatusMsg('SMTP settings saved successfully to Firestore!');
        } catch (err) {
            setErrorMsg('Failed to save settings: ' + err.message);
        } finally {
            setSaving(false);
        }
    };

    const handleSendTestEmail = async (e) => {
        e.preventDefault();
        setStatusMsg(null);
        setErrorMsg(null);

        if (!testEmail) {
            setErrorMsg('Please enter a valid recipient email address for testing.');
            return;
        }

        setTesting(true);
        try {
            const res = await fetch('/api/test-email', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    test_email: testEmail,
                    settings
                })
            });

            const data = await res.json();
            if (res.ok && data.ok) {
                setStatusMsg(data.message || `Test email sent successfully to ${testEmail}!`);
            } else {
                throw new Error(data.error || 'Failed to send test email.');
            }
        } catch (err) {
            setErrorMsg(err.message);
        } finally {
            setTesting(false);
        }
    };

    const inputClass =
        'w-full border-2 border-greenwebproject-black px-3 py-2 text-[16px] focus:outline-none focus:border-greenwebproject-blue focus:ring-2 focus:ring-greenwebproject-yellow';

    if (loading) {
        return (
            <AdminLayout>
                <div className="py-12 text-center text-greenwebproject-grey font-bold">Loading SMTP configuration...</div>
            </AdminLayout>
        );
    }

    return (
        <AdminLayout>
            <h1 className="text-[32px] font-bold text-greenwebproject-black mb-6">SMTP & Email Delivery Settings</h1>

            {statusMsg && (
                <div className="bg-[#d5e8d4] border border-[#82b366] text-[#274e13] px-4 py-3 mb-6 font-bold">
                    {statusMsg}
                </div>
            )}

            {errorMsg && (
                <div className="bg-[#f8d7da] border border-[#f5c6cb] text-[#721c24] px-4 py-3 mb-6 font-bold">
                    {errorMsg}
                </div>
            )}

            <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div className="md:col-span-2">
                    <form onSubmit={handleSave} className="space-y-6 bg-white p-6 border border-greenwebproject-mid-grey">
                        <div>
                            <label className="block text-[16px] font-bold text-greenwebproject-black mb-1" htmlFor="mail_host">
                                SMTP Host Server
                            </label>
                            <input id="mail_host" name="mail_host" type="text" value={settings.mail_host} onChange={handleChange} className={inputClass} placeholder="smtp.gmail.com" />
                        </div>

                        <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label className="block text-[16px] font-bold text-greenwebproject-black mb-1" htmlFor="mail_port">
                                    SMTP Port
                                </label>
                                <input id="mail_port" name="mail_port" type="text" value={settings.mail_port} onChange={handleChange} className={inputClass} placeholder="587" />
                            </div>

                            <div>
                                <label className="block text-[16px] font-bold text-greenwebproject-black mb-1" htmlFor="mail_encryption">
                                    Encryption Protocol
                                </label>
                                <select id="mail_encryption" name="mail_encryption" value={settings.mail_encryption} onChange={handleChange} className={inputClass}>
                                    <option value="tls">TLS (Port 587)</option>
                                    <option value="ssl">SSL (Port 465)</option>
                                    <option value="none">None (Port 25)</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label className="block text-[16px] font-bold text-greenwebproject-black mb-1" htmlFor="mail_username">
                                SMTP Username (Gmail Address)
                            </label>
                            <input id="mail_username" name="mail_username" type="text" value={settings.mail_username} onChange={handleChange} className={inputClass} placeholder="matinshaikh79070@gmail.com" />
                        </div>

                        <div>
                            <label className="block text-[16px] font-bold text-greenwebproject-black mb-1" htmlFor="mail_password">
                                SMTP App Password
                            </label>
                            <input id="mail_password" name="mail_password" type="password" value={settings.mail_password} onChange={handleChange} className={inputClass} placeholder="••••••••••••••••" />
                            <p className="text-xs text-greenwebproject-grey mt-1">For Gmail, generate an App Password in Google Account security settings.</p>
                        </div>

                        <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label className="block text-[16px] font-bold text-greenwebproject-black mb-1" htmlFor="mail_from_address">
                                    From Email Address
                                </label>
                                <input id="mail_from_address" name="mail_from_address" type="email" value={settings.mail_from_address} onChange={handleChange} className={inputClass} placeholder="matinshaikh79070@gmail.com" />
                            </div>

                            <div>
                                <label className="block text-[16px] font-bold text-greenwebproject-black mb-1" htmlFor="mail_from_name">
                                    From Sender Name
                                </label>
                                <input id="mail_from_name" name="mail_from_name" type="text" value={settings.mail_from_name} onChange={handleChange} className={inputClass} placeholder="GOV.UK VISA" />
                            </div>
                        </div>

                        <button
                            type="submit"
                            disabled={saving}
                            className="bg-greenwebproject-green text-white font-bold text-[18px] px-8 py-3 shadow-[0_2px_0_#002d18] hover:bg-[#005a30] cursor-pointer"
                        >
                            {saving ? 'Saving Settings...' : 'Save SMTP Settings'}
                        </button>
                    </form>
                </div>

                {/* Send Test Email Panel */}
                <div>
                    <div className="bg-gray-50 border border-greenwebproject-mid-grey p-6">
                        <h2 className="text-[20px] font-bold text-greenwebproject-black mb-3">Send Test Email</h2>
                        <p className="text-sm text-greenwebproject-grey mb-4">
                            Send a real security test email to verify that your Gmail SMTP credentials work properly.
                        </p>

                        <form onSubmit={handleSendTestEmail} className="space-y-4">
                            <div>
                                <label className="block text-[14px] font-bold text-greenwebproject-black mb-1" htmlFor="test_email">
                                    Recipient Email
                                </label>
                                <input
                                    id="test_email"
                                    type="email"
                                    value={testEmail}
                                    onChange={(e) => setTestEmail(e.target.value)}
                                    placeholder="your-email@example.com"
                                    className="w-full border-2 border-greenwebproject-black px-3 py-2 text-[14px]"
                                    required
                                />
                            </div>

                            <button
                                type="submit"
                                disabled={testing}
                                className="w-full bg-greenwebproject-blue text-white font-bold text-[15px] py-2 hover:bg-greenwebproject-dark-blue cursor-pointer"
                            >
                                {testing ? 'Sending Test Email...' : 'Send Test Email Now'}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </AdminLayout>
    );
}
