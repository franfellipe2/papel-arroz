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
            </div>