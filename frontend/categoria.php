<?php 
$pageTitle = 'Categoria '.$categoria->getNome();
$pageUrl = appUrl('/categoria/'.$categoria->getSlug());
$pageImage = null;
$pageImageAlt = null;
$pageDescription = $categoria->getDescricao();
$pageType = app\enumerations\SMOTypes::WEBSITE;
require appConfig('frontDir') . '/header.php'; 
?>
<?php require __DIR__.'/alert-msg.php'; ?>
<section class="page-content">
    <div class="jumbotron jumbotron-fluid">
        <header class="container text-center">
            <strong class="text-muted">Categoria</strong>
            <h1 class="display-4 page-title"><?php echo $categoria->getNome(); ?></h1>
            <p class="lead"><?php echo $categoria->getDescricao(); ?></p>
        </header>
    </div>
    <div class="container">
        <?php
        if (empty($produtos)) {
            echo '<p class="alert alert-info">Opsss... Descupe-nos, esta categoria ainda não possui conteudos. Está em fase de desenvolvimento.</p>';
        } else {
            ?>
            <div class="card-columns">
                <?php
                foreach ($produtos as $papelArroz):
                    require __DIR__ . '/template_parts/card-papel-arroz.php';                    
                endforeach;                
                ?>
            </div>
        <?php $paginate->draw();?>
        <?php } ?>
    </div><!-- ./container -->
</section>
<?php require appConfig('frontDir') . '/footer.php'; ?>
</body>
</html>
