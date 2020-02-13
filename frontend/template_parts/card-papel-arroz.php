<article class="card card-papel-arroz">
    <div class="header-img card-img-top">
        <div class="bg-papel-dobrado"></div>
        <img src="<?php echo appImageUrl('/' . $papelArroz->getImagem(), 'media'); ?>" class="card-img-top" alt="...">
    </div>
    <div class="card-body">
        <h5 class="card-title"><?php echo $papelArroz->getTitulo(); ?></h5>
        <p>Formato A4: 21:30cm</p>                           
    </div>
    <div class="card-footer">
        <a class="btn btn-sm btn-convert"  href="<?php echo appUrl('/carrinho/' . $papelArroz->getId() . '/add'); ?>#produtos">Comprar <i class="fas fa-shopping-cart"></i></a>
        <a class="btn btn-sm btn-outline-secondary float-right" href="<?php echo appUrl('/produto/') . $papelArroz->getSlug(); ?>">Ver Detalhes</a>
    </div>
</article>