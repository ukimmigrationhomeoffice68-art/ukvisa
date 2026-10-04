<?php
if (!isset($_GET['token']) || $_GET['token'] !== 'seed-7x9k2-greenwebprojectvisa') {
    http_response_code(403);
    exit('Forbidden');
}
try {
    $pdo = new PDO(
        'mysql:host=127.0.0.1;dbname=u756429571_greenwebprojectvisa;charset=utf8mb4',
        'u756429571_greenwebprojectvisa',
        '3SgDQ&wzK5%&hZ1c'
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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

    echo "<pre>Done!\nAdmin user created.\nEmail: admin@greenwebproject.com\nPassword: Admin@2024#</pre>";
} catch (Exception $e) {
    echo "<pre>Error: " . htmlspecialchars($e->getMessage()) . "</pre>";
}
