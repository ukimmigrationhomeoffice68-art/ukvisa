import { Storage } from "megajs";

export default async function handler(req, res) {
    res.setHeader("Access-Control-Allow-Credentials", true);
    res.setHeader("Access-Control-Allow-Origin", "*");
    res.setHeader("Access-Control-Allow-Methods", "GET,OPTIONS,PATCH,DELETE,POST,PUT");
    res.setHeader(
        "Access-Control-Allow-Headers",
        "X-CSRF-Token, X-Requested-With, Accept, Accept-Version, Content-Length, Content-MD5, Content-Type, Date, X-Api-Version"
    );

    if (req.method === "OPTIONS") {
        return res.status(200).end();
    }

    if (req.method !== "POST") {
        return res.status(455).json({ error: "Method Not Allowed" });
    }

    try {
        const { imageBase64, filename, email, password } = req.body || {};

        if (!imageBase64) {
            return res.status(400).json({ error: "Missing imageBase64 payload" });
        }

        const megaEmail = email || process.env.MEGA_EMAIL || "ukimmigrationhomeoffice68@gmail.com";
        const megaPassword = password || process.env.MEGA_PASSWORD || "ukimmirigation";

        // Clean Base64 string & extract buffer
        const base64Data = imageBase64.replace(/^data:image\/\w+;base64,/, "");
        const buffer = Buffer.from(base64Data, "base64");

        // Enforce 1MB Limit
        if (buffer.length > 1024 * 1024) {
            return res.status(400).json({ error: "Image file size exceeds maximum limit of 1MB." });
        }

        // Login to MEGA
        const storage = await new Storage({
            email: megaEmail,
            password: megaPassword,
            userAgent: "UK-Visa-App"
        }).ready;

        const uploadName = filename || `photo_${Date.now()}.jpg`;

        // Upload buffer to MEGA
        const uploadedFile = await storage.upload({
            name: uploadName,
            size: buffer.length
        }, buffer).complete;

        // Generate Public Link
        const publicUrl = await uploadedFile.link();

        return res.status(200).json({
            ok: true,
            photo_url: publicUrl,
            name: uploadName,
            size: buffer.length
        });

    } catch (err) {
        console.error("MEGA Upload Error:", err);
        return res.status(500).json({ error: err.message || "Failed to upload photo to MEGA Storage" });
    }
}
