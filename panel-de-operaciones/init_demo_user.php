<?php
// Initialize demo user for testing
require_once __DIR__ . '/klasea_panel/db/config.php';

// Demo user credentials
$demo_email = 'demo@example.com';
$demo_password = 'demo1234';
$demo_name = 'Usuario Demo';
$demo_modelo = '85';

try {
    // Check if demo user already exists
    $stmt = $pdo->prepare('SELECT id FROM propietarios WHERE email = ?');
    $stmt->execute([$demo_email]);
    
    if ($stmt->fetch()) {
        echo "Demo user already exists.\n";
        exit(0);
    }
    
    // Create demo user with hashed password
    $hashed_password = password_hash($demo_password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare('INSERT INTO propietarios (nombre, email, password, modelo_barco) VALUES (?, ?, ?, ?)');
    $stmt->execute([$demo_name, $demo_email, $hashed_password, $demo_modelo]);
    
    echo "Demo user created successfully!\n";
    echo "Email: {$demo_email}\n";
    echo "Password: {$demo_password}\n";
    echo "Modelo: {$demo_modelo}\n";
} catch (Throwable $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
