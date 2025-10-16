<?php
// Require session and redirect to login if not authenticated
session_start();
if (empty($_SESSION['user']) || empty($_SESSION['user']['modelo_barco'])) {
    header('Location: /login.php');
    exit;
}

function require_model(string $expected): void {
    $actual = $_SESSION['user']['modelo_barco'] ?? '';
    if ($actual !== $expected) {
        http_response_code(403);
        echo '<!doctype html><html><head><meta charset="utf-8"><title>Acceso denegado</title></head><body style="font-family: system-ui; background:#0b0f14; color:#eee; display:flex; align-items:center; justify-content:center; height:100vh;">';
        echo '<div style="max-width:600px; padding:24px; background:rgba(255,255,255,0.05); border-radius:12px;">';
        echo '<h1 style="margin:0 0 8px 0;">Acceso denegado</h1>';
        echo '<p style="margin:0 0 16px 0; color:#bbb;">No posee permisos para este panel.</p>';
        echo '<a href="/logout.php" style="color:#8ab4f8;">Cerrar sesión</a>';
        echo '</div></body></html>';
        exit;
    }
}
