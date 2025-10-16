<?php
require_once __DIR__ . '/../auth_guard.php';
require_model('52');
$owner = $_SESSION['user'];
$modelo = '52';
require __DIR__ . '/panel_base.php';
