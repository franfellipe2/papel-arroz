<?php

require '../vendor/autoload.php';
require '../_core/functions.php';

use app\utils\ImagesUpload;

$up = new ImagesUpload();

var_dump($up);
var_dump($up->upload(''));


var_dump(scandir('C:\wamp64\www\papel-arroz\uploads\images'));