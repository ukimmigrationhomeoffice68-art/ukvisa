<?php


// Database credentials from environment
$db_host = $_ENV['DB_HOST'] ?? '127.0.0.1';
$db_database = $_ENV['DB_DATABASE'] ?? 'u962734684_uk';
$db_username = $_ENV['DB_USERNAME'] ?? 'u962734684_uk';
$db_password = $_ENV['DB_PASSWORD'] ?? 'Rv/p4RDCd=j0';

echo "<h1>Database Setup for Green Web Project</h1>";
echo "<p>Connecting to database: " . htmlspecialchars($db_database) . "@" . htmlspecialchars($db_host) . "</p>";

try {
    // Create connection
    $conn = new mysqli($db_host, $db_username, $db_password, $db_database);

    if ($conn->connect_error) {
        echo "<p style='color: red;'><strong>Connection failed:</strong> " . htmlspecialchars($conn->connect_error) . "</p>";
        exit;
    }

    echo "<p style='color: green;'><strong>✓ Database connection successful!</strong></p>";

    // List existing tables
    $result = $conn->query("SHOW TABLES");
    echo "<h2>Existing Tables:</h2>";

    if ($result->num_rows > 0) {
        echo "<ul>";
        while($row = $result->fetch_row()) {
            echo "<li>" . htmlspecialchars($row[0]) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No tables found. Database is empty - ready for migrations.</p>";
    }

    // Get database size
    $size_result = $conn->query("SELECT SUM(data_length + index_length) as size FROM information_schema.tables WHERE table_schema = '" . $db_database . "'");
    if ($size_result) {
        $size_row = $size_result->fetch_assoc();
        $size_mb = round($size_row['size'] / 1024 / 1024, 2);
        echo "<p><strong>Database Size:</strong> " . $size_mb . " MB</p>";
    }

    $conn->close();

    echo "<h2>Next Steps:</h2>";
    echo "<ol>";
    echo "<li>Run: <code>cd /public_html && php artisan migrate --force</code></li>";
    echo "<li>Run: <code>php artisan db:seed</code></li>";
    echo "<li>Clear cache: <code>php artisan cache:clear</code></li>";
    echo "</ol>";

} catch (Exception $e) {
    echo "<p style='color: red;'><strong>Error:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>
