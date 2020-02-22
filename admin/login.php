<?php
session_start();
require '../vendor/autoload.php';
require '../_core/functions.php';

use app\models\Login;

$login = new Login();

if (!empty($_POST)) {

    if ($login->entrar(
                    filter_input(INPUT_POST, 'nome')
                    , filter_input(INPUT_POST, 'senha')
            )) {
        header('Location: ' . appUrl('/admin/'));
        die();
    }
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css"  type="text/css"/>
        <link rel="stylesheet" type="text/css" href="assets/css/datatables.min.css"/>
        <link rel="stylesheet" type="text/css" href="assets/css/fontawesome.min.css"  type="text/css"/>        
        <link rel="stylesheet" type="text/css" href="assets/css/style.css"  type="text/css"/> 
    </head>
    <body class="text-center">
        <div class="text-center py-5"> 
            <form class="text-center" method="post" style="width: 480px; margin-left: calc(50% - 150px);" >

                <img src="assets/images/logo.png" style="margin-left: -30px; margin-bottom: 70px;">
                <?php if ($login->getErrors()) { ?>
                    <div class="alert alert-warning">
                        <?php
                        foreach ($login->getErrors() as $k => $v) {
                            echo "<p>$v</p>";
                        }
                        ?>
                    </div>
                <?php } ?>

                <h1 class="h3 mb-3 font-weight-normal">Area administrativa</h1>
                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="email" name="nome" id="inputEmail" class="form-control mb-4" placeholder="Email address" required autofocus>
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" name="senha" id="inputPassword" class="form-control" placeholder="Password" required>
                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
                <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
            </form>           
        </div>

    </body>
</html>