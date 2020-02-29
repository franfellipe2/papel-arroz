<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-159292389-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'UA-159292389-1');
        </script>

        <title><?php echo $pageTitle; ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?php echo $pageDescription; ?>">
        <?php
        echo appSMO($pageUrl, $pageImage, $pageImageAlt, $pageTitle, $pageDescription, $pageType);
        ?>        

        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap" rel="stylesheet">        
        <?php /* <link href="<?php echo appUrl('/frontend/assets/css/bootstrap.css'); ?>" rel="stylesheet" type="text/css"/> */ ?>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <?php /* <link href="<?php echo appUrl('/frontend/assets/css/fontawesome.min.css'); ?>" rel="stylesheet" type="text/css"/> */ ?>
        <link href="<?php echo appUrl('/frontend/assets/css/style.css'); ?>" rel="stylesheet" type="text/css"/>        

        <script src="https://kit.fontawesome.com/d215cbee4a.js" crossorigin="anonymous"></script>

        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo appUrl('/'); ?>apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo appUrl('/'); ?>apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo appUrl('/'); ?>apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo appUrl('/'); ?>apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo appUrl('/'); ?>apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo appUrl('/'); ?>apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo appUrl('/'); ?>apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo appUrl('/'); ?>apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo appUrl('/'); ?>apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo appUrl('/'); ?>android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo appUrl('/'); ?>favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo appUrl('/'); ?>favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo appUrl('/'); ?>favicon-16x16.png">
        <link rel="manifest" href="<?php echo appUrl('/'); ?>manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="<?php echo appUrl('/'); ?>ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

    </head>
    <body>
        <div id="site-top"></div>
        <div class="page">
            <div class="site-header">
                <?php require appConfig('frontDir') . 'menu-header.php'; ?>                
            </div>