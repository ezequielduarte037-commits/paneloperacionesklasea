<?php
require_once __DIR__ . '/../auth_guard.php';
require_model('43');
$owner = $_SESSION['user'];
$modelo = '43';
require __DIR__ . '/panel_base.php';
