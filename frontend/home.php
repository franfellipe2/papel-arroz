<?php
$pageTitle = appConfig('siteName');
require appConfig('frontDir') . '/header.php';
?>
<?php require __DIR__.'/alert-msg.php'; ?>
<div class="jumbotron banner-home">
    <div class="container text-center">
        <h1 class="display-4">Papel de arroz comestível</h1>
        <p class="lead">O papel de arroz é utilizado para decoração de alimentos, é impresso com corante comestível a base de água. Pode ser aplicado em: bolos, pirulitos de chocolate, doces, bombons, tortas, salgados, e até mesmo em velas e sabonetes artesanais.</p>                        
        <img class="img-fluid" src="<?php echo appUrl('/frontend/assets/images/banner-home.png'); ?>" title="banner papel arroz comestível">
        <div class="scroll-to-content-container">
            <a class="scroll-to-content" href="#" onclick="appScrollTo('#site-content')">
                <i class="fas fa-angle-down h1"></i>
            </a>
        </div>
    </div>
</div>

<div class="page-content py-4">   
    <section class="page-content secao">
        <div class="container" id="site-content">
            <h2 class="titulo-secao">Papel arroz</h2>       
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
                <?php $paginate->draw(); ?>
            <?php } ?>
        </div><!-- ./container -->
    </section>
</div>
<?php require appConfig('frontDir') . '/footer.php'; ?>

</body>
</html>
