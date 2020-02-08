<?php
session_start();
require '../vendor/autoload.php';
require '../_core/functions.php';
require 'header.php';
?>
<?php require './sidebar.php'; ?>                            
<div class="content-page">

    <?php
    if (!empty($_GET['action']) && !empty($_GET['pg'])) {
        $classController = 'app\\controllers\\admin\\' . $_GET['pg'] . 'Controller';
        //require '../_core/controllers/admin/' . $classController . '.php';

        $controller = new $classController;
        $controller->{$_GET['action']}();
    } else {
        require 'home.php';
    }
    ?>

</div>
<div class="clear-both"></div>
<?php
require 'footer.php';
