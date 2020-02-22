<?php
session_start();
require '../vendor/autoload.php';
require '../_core/functions.php';

use app\models\Login;

if (isset($_SESSION[Login::SESSION])) {
    unset($_SESSION[Login::SESSION]);
}

header('Location: ' . appUrl('/admin/login.php'));
