<?php
// Database connection using PDO with SQLite
$DB_PATH = getenv('DB_PATH') ?: __DIR__ . '/klasea_panel.db';

$dsn = "sqlite:{$DB_PATH}";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, null, null, $options);
    
    // Initialize database schema if tables don't exist
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS propietarios (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nombre VARCHAR(120) NOT NULL,
            email VARCHAR(160) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            modelo_barco TEXT NOT NULL CHECK(modelo_barco IN ('85','64','52','43','42','37','34')),
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )
    ");
} catch (Throwable $e) {
    http_response_code(500);
    echo '<h1>Database connection error</h1>';
    echo '<p>Please check db/config.php and database file permissions.</p>';
    if (ini_get('display_errors')) {
        echo '<pre>' . htmlspecialchars($e->getMessage()) . '</pre>';
    }
    exit;
}
