<?php

use app\models\Carrinho as car;

$TotalProdutosCarrinho = 0;
if (car::hasSessionValid()) {
    $car = car::getFromSession();
    $TotalProdutosCarrinho = $car->getTotalProdutos();
}
?>
<nav class="navbar-header navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand logo" href="<?php echo appConfig('baseUrl'); ?>">
        <img class="img-fluid" src="<?php echo appUrl('/frontend/assets/images/logo.png'); ?>">
    </a>   

    <div class="carrinho nav-sm">
        <a class="carrinho" href="<?php echo appUrl('/carrinho'); ?>">
            <div class="total"><?php echo $TotalProdutosCarrinho; ?></div>
            <i class="fas fa-shopping-cart icon"></i>
        </a>
    </div>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto" style="text-transform: capitalize;">            
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Categorias
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php
                    $c = new app\utils\CategoriasAninhadas();
                    foreach ($c->get() as $r => $c) {
                        ?>
                        <a class="dropdown-item" href="<?php echo appUrl('/categoria') . '/' . appStrSlug($c['nome']); ?>"><?php echo $c['nome']; ?></a>
                    <?php } ?> 
                </div>

            </li>

            <li class="nav-item">
                <span class="nav-link" style="color: #333; font-size: 1.1em; margin-top: -0.3em">
                    <i class="fab fa-whatsapp"></i> (34) 9.9766-9479
                </span>
            </li>
            <li class="nav-item">
                <a class="nav-link color-convert" href="<?php echo appUrl('/pedido/acompanhar'); ?>">Acompanhar Pedido</a>
            </li>
        </ul>

        <div class="carrinho nav-lg" style="margin-right: 32px">
            <a class="carrinho" href="<?php echo appUrl('/carrinho'); ?>">
                <span class="total"><?php echo $TotalProdutosCarrinho; ?></span>
                <i class="fas fa-shopping-cart icon"></i>
            </a>
        </div>

    </div>    
</nav>
<div class="buscar">
    <form class="form-inline my-2 my-lg-0" action="<?php echo appUrl('/pesquisa'); ?>" method="get">
        <input name="pesquisa" class="form-control" type="search" placeholder="Pesquise aqui..." aria-label="Search">
        <button class="btn btn-primary my-2 my-sm-0" type="submit">Pesquisar</button>
    </form>
</div>