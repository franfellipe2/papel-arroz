<?php require appConfig('frontDir') . '/header.php'; ?>

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
                <?php foreach ($produtos as $p): ?>
                    <article class="card card-papel-arroz">
                        <div class="header-img card-img-top">
                            <div class="bg-papel-dobrado"></div>
                            <img src="<?php echo appImageUrl('/' . $p->getImagem(), 'media'); ?>" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $p->getTitulo(); ?></h5>
                            <p>Formato A4: 21:30cm</p>                           
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-sm btn-convert"  href="<?php echo appUrl('/carrinho/'.$p->getId().'/add') ; ?>#produtos">Comprar <i class="fas fa-shopping-cart"></i></a>
                            <a class="btn btn-sm btn-outline-secondary float-right" href="<?php echo appUrl('/produto/').$p->getSlug(); ?>">Ver Detalhes</a>
                        </div>
                    </article>       
                <?php endforeach; ?>
            </div>
        <?php } ?>
    </div><!-- ./container -->
</section>
<div class="page-footer">
    rodape
</div>
<?php
require appConfig('frontDir') . '/footer.php';
