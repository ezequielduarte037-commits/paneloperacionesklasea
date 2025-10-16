<?php
// Base template to render the existing index.html content
// This file expects $modelo (string) and $owner (array) to be set from the panel_* pages
require_once __DIR__ . '/../auth_guard.php';
$owner = $_SESSION['user'];
$modelo = $owner['modelo_barco'];

// Read original index.html content to preserve design
$indexPath = __DIR__ . '/../index.html';
$index = file_exists($indexPath) ? file_get_contents($indexPath) : '';

if ($index === '') {
  http_response_code(500);
  echo '<h1>No se encontró index.html base</h1>';
  exit;
}

// Inject a small header bar with user + logout preserving dark styling
$injection = <<<HTML
  <div class="fixed top-0 left-0 right-0 z-50">
    <div class="mx-auto max-w-screen-2xl px-4 py-3 flex items-center justify-between" style="background: rgba(0,0,0,0.6); backdrop-filter: blur(6px);">
      <div class="text-sm text-gray-300">Modelo: <span class="font-semibold text-sky-400">{$modelo}</span> · Propietario: <span class="font-semibold">{$owner['nombre']}</span></div>
      <div class="flex items-center gap-3">
        <a href="/logout.php" class="px-3 py-1.5 rounded-md text-sm" style="background: rgba(255,255,255,0.08);">Cerrar sesión</a>
      </div>
    </div>
  </div>
  <div style="height:56px"></div>
HTML;

// Try to insert after <body>
$rendered = preg_replace('/<body[^>]*>/i', '$0' . $injection, $index, 1);
if ($rendered === null) {
  $rendered = $index; // fallback
}

// Expose modelo to front-end if needed
$rendered = str_replace('</head>', "\n  <script>window.KLASEA_MODELO = '" . htmlspecialchars($modelo, ENT_QUOTES) . "';</script>\n</head>", $rendered);

// Output final HTML
header('Content-Type: text/html; charset=utf-8');
echo $rendered;
