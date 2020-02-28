<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title><?php echo $pageTitle; ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?php echo $pageDescription; ?>">
        <?php echo appSMO($pageUrl, $pageImage, $pageTitle, $pageDescription, $pageType); ?>        
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap" rel="stylesheet">        
        <?php /* <link href="<?php echo appUrl('/frontend/assets/css/bootstrap.css'); ?>" rel="stylesheet" type="text/css"/> */ ?>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <?php /* <link href="<?php echo appUrl('/frontend/assets/css/fontawesome.min.css'); ?>" rel="stylesheet" type="text/css"/> */ ?>
        <link href="<?php echo appUrl('/frontend/assets/css/style.css'); ?>" rel="stylesheet" type="text/css"/>        

        <script src="https://kit.fontawesome.com/d215cbee4a.js" crossorigin="anonymous"></script>        
    </head>
    <body>
        <div id="site-top"></div>
        <div class="page">
            <div class="site-header">
                <?php require appConfig('frontDir') . 'menu-header.php'; ?>                
            </div>