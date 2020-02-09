<?php require appConfig('frontDir') . '/header.php';?>

<section class="page-content">
    <div class="jumbotron jumbotron-fluid">
        <header class="container">
            <strong class="text-muted">Categoria</strong>
            <h1 class="display-4"><?php echo $categoria->getNome(); ?></h1>
            <p class="lead"><?php echo $categoria->getDescricao(); ?></p>
        </header>
    </div>
    <div class="container">
        <div class="card-deck">
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
                        <a class="btn btn-convert"  href="#">Adicionar <i class="fas fa-shopping-cart"></i></a>
                        <a class="btn btn-success float-right" href="#">Personalizar</a>
                    </div>
                </article>       
            <?php endforeach; ?>
        </div>
    </div><!-- ./container -->
</section>
<div class="page-footer">
    rodape
</div>
<?php
require appConfig('frontDir') . '/footer.php';
