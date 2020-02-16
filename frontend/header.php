<!DOCTYPE html>
<html>
    <head>
        <title><?php ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap" rel="stylesheet">
        <link href="<?php echo appUrl('/frontend/assets/css/bootstrap.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo appUrl('/frontend/assets/css/fontawesome.min.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo appUrl('/frontend/assets/css/style.css'); ?>" rel="stylesheet" type="text/css"/>        
    </head>
    <body>
        <div class="page">
            <div class="site-header">
                <?php require appConfig('frontDir') . 'menu-header.php'; ?>
                <div class="msg-info smg-info-primary text-center">
                    <p>Frutal - MG.    Por Enquanto estamos vendendo somente para a cidade de Frutal - MG.</p>
                    <p>Entregas de Segunda a Sexta, das 14:00 as 17:00; e Sábado das 8:00 as 11:00</p>
                </div>
            </div>