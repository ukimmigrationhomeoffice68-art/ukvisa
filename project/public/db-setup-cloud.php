<?php

// Web helper script to initialize and import database on Vercel / Cloud MySQL
$db_host = getenv('DB_HOST') ?: ($_ENV['DB_HOST'] ?? '127.0.0.1');
$db_port = getenv('DB_PORT') ?: ($_ENV['DB_PORT'] ?? '3306');
$db_database = getenv('DB_DATABASE') ?: ($_ENV['DB_DATABASE'] ?? 'defaultdb');
$db_username = getenv('DB_USERNAME') ?: ($_ENV['DB_USERNAME'] ?? 'root');
$db_password = getenv('DB_PASSWORD') ?: ($_ENV['DB_PASSWORD'] ?? '');

echo "<!DOCTYPE html><html><head><title>Cloud DB Setup</title>";
echo "<style>body{font-family:sans-serif;padding:30px;background:#f4f6f8;color:#333;}.card{background:#fff;padding:25px;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.1);max-width:700px;margin:auto;}h1{margin-top:0;color:#0b0c0c;}.success{color:#00703c;font-weight:bold;}.error{color:#d4351c;font-weight:bold;}pre{background:#f3f2f1;padding:15px;border-radius:4px;overflow-x:auto;}</style>";
echo "</head><body><div class='card'>";
echo "<h1>Cloud Database Setup</h1>";
echo "<p>Connecting to MySQL: <code>" . htmlspecialchars($db_database) . "@" . htmlspecialchars($db_host) . ":" . htmlspecialchars($db_port) . "</code></p>";

try {
    $dsn = "mysql:host={$db_host};port={$db_port};dbname={$db_database};charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
    ];

    // Enable SSL if running on Aiven or external host
    if (str_contains($db_host, 'aivencloud.com') || getenv('MYSQL_ATTR_SSL_CA')) {
        $options[PDO::MYSQL_ATTR_SSL_CA] = '/etc/ssl/certs/ca-certificates.crt';
        $options[PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT] = false;
    }

    $pdo = new PDO($dsn, $db_username, $db_password, $options);
    echo "<p class='success'>✓ Connection to Database Successful!</p>";

    // Read and run the SQL dump file
    $sqlFile = __DIR__ . '/../database/visa_db_live_full_backup.sql';
    if (!file_exists($sqlFile)) {
        $sqlFile = __DIR__ . '/../database/greenwebprojectvisa_local.sql';
    }

    if (file_exists($sqlFile)) {
        echo "<p>Importing database dump (<code>" . htmlspecialchars(basename($sqlFile)) . "</code>)...</p>";
        $sql = file_get_contents($sqlFile);
        $pdo->exec($sql);
        echo "<p class='success'>✓ Database Tables & Initial Data Imported Successfully!</p>";
    } else {
        echo "<p class='error'>SQL dump file not found, skipping dump import.</p>";
    }

    // Ensure Admin user exists with correct password
    $hash = password_hash('Admin@2024#', PASSWORD_BCRYPT);
    $now  = date('Y-m-d H:i:s');

    $stmt = $pdo->prepare(
        "INSERT INTO users (name, email, email_verified_at, password, created_at, updated_at)
         VALUES (:name, :email, :ver, :pass, :ca, :ua)
         ON DUPLICATE KEY UPDATE password = VALUES(password), updated_at = VALUES(updated_at)"
    );
    $stmt->execute([
        ':name'  => 'Admin',
        ':email' => 'admin@greenwebproject.com',
        ':ver'   => $now,
        ':pass'  => $hash,
        ':ca'    => $now,
        ':ua'    => $now,
    ]);

    // Save Gmail SMTP credentials into settings table
    $smtpSettings = [
        'mail_host' => 'smtp.gmail.com',
        'mail_port' => '587',
        'mail_encryption' => 'tls',
        'mail_username' => 'matinshaikh79070@gmail.com',
        'mail_password' => 'ygfz xjex fwty piim',
        'mail_from_address' => 'matinshaikh79070@gmail.com',
        'mail_from_name' => 'GOV.UK VISA',
    ];

    foreach ($smtpSettings as $k => $v) {
        $stmt = $pdo->prepare("INSERT INTO settings (`key`, `value`, created_at, updated_at) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`), updated_at = VALUES(updated_at)");
        $stmt->execute([$k, $v, $now, $now]);
    }

    echo "<p class='success'>✓ Gmail SMTP Configuration Configured Successfully!</p>";
    echo "<p class='success'>✓ Admin Account Verified!</p>";
    echo "<pre>Admin Login Credentials:\nEmail: admin@greenwebproject.com\nPassword: Admin@2024#\n\nGmail SMTP: matinshaikh79070@gmail.com (Configured)</pre>";
    echo "<p><strong>Everything is ready! Real OTP Emails will now be sent via Gmail.</strong></p>";

} catch (Exception $e) {
    echo "<p class='error'>❌ Setup Error: " . htmlspecialchars($e->getMessage()) . "</p>";
}

echo "</div></body></html>";
