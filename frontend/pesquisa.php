<?php 
$pageTitle = 'Pesquisa';
require appConfig('frontDir') . '/header.php'; 
?>
<div class="msg-info smg-info-primary text-center">
    <p>Frutal - MG.    Por Enquanto estamos vendendo somente para a cidade de Frutal - MG.</p>
    <p>Entregas de Segunda a Sexta, das 14:00 as 17:00; e Sábado das 8:00 as 11:00</p>
</div>
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
            echo '<p class="alert alert-info">Opsss... Não encontramos nehum resultado para a sua busca.</p>';
        } else {
            ?>
            <div class="card-columns">
                <?php
                foreach ($produtos as $p):
                    if ($p->getTipo() == 'papel_arroz') {
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
