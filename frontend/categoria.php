<?php
require appConfig('frontDir') . '/header.php';
require appConfig('frontDir') . 'menu-header.php';
?>

<div class="page-sidebar">
    barra lateral
</div>
<section class="page-content">
    <div class="jumbotron jumbotron-fluid">
        <header class="container">
            <strong>Categoria</strong>
            <h1 class="display-4"><?php echo $categoria->getNome(); ?></h1>
            <p class="lead"><?php echo $categoria->getDescricao(); ?></p>
        </header>
    </div>
    <div class="container">
        <div class="card-deck">
            <?php foreach ($produtos as $p): ?>
                <article class="card">
                    <img src="<?php echo appUrl('/'.$p->getImagem());?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $p->getTitulo();?></h5>
                        <p>Formato A4: 21:30cm</p>
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
