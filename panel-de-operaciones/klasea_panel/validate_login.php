<?php
session_start();
require_once __DIR__ . '/db/config.php';

function redirect_with_error(string $message): void {
    $encoded = urlencode($message);
    header("Location: login.php?error={$encoded}");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_with_error('Método no permitido');
}

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($email === '' || $password === '') {
    redirect_with_error('Complete email y contraseña');
}

try {
    $stmt = $pdo->prepare('SELECT id, nombre, email, password, modelo_barco FROM propietarios WHERE email = ? LIMIT 1');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user) {
        redirect_with_error('Credenciales inválidas');
    }

    if (!password_verify($password, $user['password'])) {
        redirect_with_error('Credenciales inválidas');
    }

    $_SESSION['user'] = [
        'id' => (int) $user['id'],
        'nombre' => $user['nombre'],
        'email' => $user['email'],
        'modelo_barco' => $user['modelo_barco'],
        'login_time' => time(),
    ];

    $modelo = preg_replace('/[^0-9]/', '', $user['modelo_barco']);
    header("Location: barcos/panel_{$modelo}.php");
    exit;
} catch (Throwable $e) {
    if (ini_get('display_errors')) {
        redirect_with_error('Error interno: ' . $e->getMessage());
    }
    redirect_with_error('Error interno');
}
