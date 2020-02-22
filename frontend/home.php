<?php require appConfig('frontDir') . '/header.php'; ?>
<div class="msg-info smg-info-primary text-center">
    <p>Frutal - MG.    Por Enquanto estamos vendendo somente para a cidade de Frutal - MG.</p>
    <p>Entregas de Segunda a Sexta, das 14:00 as 17:00; e Sábado das 8:00 as 11:00</p>
</div>
<div class="page-content py-4">
    <section class="page-content secao">
        <div class="container">
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
