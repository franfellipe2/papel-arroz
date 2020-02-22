<?php

if (!function_exists('appConfig')) {
    require '../../vendor/autoload.php';
    require '../../_core/functions.php';
    header('Location: ' . appUrl('/admin/'));
    die();
}

