<?php 
$pageTitle = 'Pesquisa';
$pageUrl = appUrl('/pesquisa');
$pageImage = null;
$pageImageAlt = null;
$pageDescription = 'Pesquisar no site';
$pageType = app\enumerations\SMOTypes::WEBSITE;
require appConfig('frontDir') . '/header.php'; 
?>
<?php require __DIR__.'/alert-msg.php'; ?>
<section class="page-content">
    <div class="jumbotron jumbotron-fluid">
        <header class="container text-center">
            <h1 class="display-4 page-title">Pagina de Busca</h1>
            <p class="lead">Busca por: <b style="text-transform: capitalize;" class="h3"><?php echo $pesquisa; ?></b></p>
        </header>
    </div>
    <div class="container">
        <?php
        if (empty($produtos)) {
            echo '<p class="alert alert-info">Opsss... Não encontramos nenhum resultado para a sua busca.</p>';
        } else {
            ?>
            <div class="card-columns">
                <?php
                foreach ($produtos as $p):
                    if ($p->getTipo() == 'Papel Arroz') {
                        $papelArroz = $p;
                        require __DIR__ . '/template_parts/card-papel-arroz.php';
                    } else {
                        echo 'Outros produtos em desenvolvimento...';
                    }
                endforeach;
                ?>
            </div>
            <?php echo $pagination->draw();?>
        <?php } ?>
    </div><!-- ./container -->
</section>
<?php require appConfig('frontDir') . '/footer.php'; ?>
</body>
</html>
