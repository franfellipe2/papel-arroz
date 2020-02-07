<?php

require_once '../_core/DB.php';
require_once '../_core/model/Categoria.php';

$cat = new Categoria();
$cat->setId(1);
$p = $cat->getBidParams();

$cat->getByName('teste2');