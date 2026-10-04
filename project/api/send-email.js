import nodemailer from 'nodemailer';

export default async function handler(req, res) {
    // Enable CORS
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
        const { to, otp, userName, settings } = req.body || {};

        if (!to || !otp) {
            return res.status(400).json({ error: 'Missing required parameters: to and otp' });
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

        const nameDisplay = userName ? `Hello ${userName},\n\n` : '';

        const mailOptions = {
            from: `"${fromName}" <${fromAddr}>`,
            to,
            subject: 'Your GOV.UK security code',
            text: `${nameDisplay}Your security code is: ${otp}\n\nThis code will expire in 10 minutes.\n\nIf you did not request this code, please ignore this email.`,
            html: `
                <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #e0e0e0;">
                    <div style="background-color: #0b0c0c; padding: 15px; text-align: left;">
                        <span style="color: #ffffff; font-size: 24px; font-weight: bold;">GOV.UK</span>
                    </div>
                    <div style="padding: 20px 0;">
                        <h2 style="color: #0b0c0c; font-size: 20px; margin-bottom: 20px;">Your GOV.UK security code</h2>
                        <p style="font-size: 16px; color: #0b0c0c;">Use this security code to complete your sign in:</p>
                        <div style="background-color: #f3f2f1; padding: 15px; font-size: 32px; font-weight: bold; letter-spacing: 5px; text-align: center; margin: 20px 0; color: #0b0c0c; border-left: 5px solid #1d70b8;">
                            ${otp}
                        </div>
                        <p style="font-size: 14px; color: #505a5f;">This code will expire in 10 minutes.</p>
                        <p style="font-size: 14px; color: #505a5f; margin-top: 30px;">If you did not request this code, you can safely ignore this email.</p>
                    </div>
                </div>
            `
        };

        const info = await transporter.sendMail(mailOptions);
        console.log('Message sent: %s', info.messageId);

        return res.status(200).json({ ok: true, messageId: info.messageId });
    } catch (err) {
        console.error('Failed to send email via SMTP:', err);
        return res.status(500).json({ error: err.message || 'Failed to send email' });
    }
}
