<?php
require appConfig('frontDir') . '/header.php';
?>
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
            <?php } ?>
        </div><!-- ./container -->
    </section>
</div>
<?php require appConfig('frontDir') . '/footer.php'; ?>
</body>
</html>
