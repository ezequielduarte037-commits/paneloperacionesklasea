<?php
session_start();
if (!empty($_SESSION['user'])) {
    $modelo = $_SESSION['user']['modelo_barco'] ?? null;
    if ($modelo) {
        header("Location: barcos/panel_{$modelo}.php");
        exit;
    }
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Acceso | Klase A</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root { color-scheme: dark; }
    body { background: #0b0f14; }
    .glass { background: rgba(255,255,255,0.04); backdrop-filter: blur(10px); }
    .btn-primary { background: linear-gradient(135deg,#0ea5e9,#6366f1); }
    .btn-primary:hover { filter: brightness(1.1); }
    .input { background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.08); }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 text-gray-100">
  <div class="w-full max-w-md glass rounded-2xl shadow-2xl p-8">
    <div class="text-center mb-8">
      <i class="fa-solid fa-ship text-3xl text-sky-400"></i>
      <h1 class="mt-3 text-2xl font-semibold tracking-wide">Panel Klase A</h1>
      <p class="text-gray-400 text-sm">Acceda con sus credenciales de propietario</p>
    </div>

    <?php if (!empty($_GET['error'])): ?>
      <div class="mb-4 p-3 rounded-md bg-red-500/10 border border-red-500/30 text-red-300 text-sm">
        <?php echo htmlspecialchars($_GET['error']); ?>
      </div>
    <?php endif; ?>

    <form action="validate_login.php" method="post" class="space-y-4">
      <div>
        <label class="block text-sm mb-1" for="email">Email</label>
        <input class="input w-full rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-sky-500" type="email" name="email" id="email" required placeholder="nombre@correo.com" />
      </div>
      <div>
        <label class="block text-sm mb-1" for="password">Contraseña</label>
        <input class="input w-full rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-sky-500" type="password" name="password" id="password" required placeholder="••••••••" />
      </div>
      <button type="submit" class="btn-primary w-full rounded-lg px-4 py-3 font-medium">Ingresar</button>
    </form>

    <div class="mt-6 text-center text-xs text-gray-400">
      © <?php echo date('Y'); ?> Klase A. Todos los derechos reservados.
    </div>
  </div>
</body>
</html>
