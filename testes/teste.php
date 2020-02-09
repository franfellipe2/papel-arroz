<?php

require '../vendor/autoload.php';
require '../_core/functions.php';

$id = (int) 'f15.5';
$r = is_integer('1');

$ns = ['1', '3', '8', '5', '9'];

function valid($ns)
{
    foreach ($ns as $id) {
        if (((int) $id) == 0) {
            return false;
        }
    }
    
    return true;
}

var_dump(valid($ns));