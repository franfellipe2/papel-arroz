<?php

use app\utils\Config;

function appConfig($index = null, $file = 'app')
{
    $con = Config::instance();
    if ($index) {
        return $con->get($file, $index);
    } else {
        return $con->getAll($file);
    }
}

function appImageUrl($fileName, $size)
{
    return \app\utils\Images::getUrl($fileName, $size);
}
