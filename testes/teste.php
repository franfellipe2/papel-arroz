<?php

require '../vendor/autoload.php';
require '../_core/functions.php';

$_GET['coluna'];
$_GET['order'];

$orderBy = str_replace([';', '\'', ' '], '', $_GET['coluna']);
$order = in_array($_GET['order'], ['desc', 'asc']) ? $_GET['order'] : 'asc';

$sql = 'SELECT * FROM produtos ORDER BY ' . $orderBy . ' ' . $order;

$db = new app\DB();
//$p = $db->select($sql);


var_dump($orderBy);
var_dump($order);
var_dump($sql);
