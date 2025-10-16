<?php
require_once __DIR__ . '/../auth_guard.php';
require_model('42');
$owner = $_SESSION['user'];
$modelo = '42';
require __DIR__ . '/panel_base.php';
