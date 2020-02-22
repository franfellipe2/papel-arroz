<article class="card card-papel-arroz">
    <div class="header-img card-img-top">
        <a href="<?php echo appUrl('/produto/') . $papelArroz->getSlug(); ?>">
        <span class="bg-papel-dobrado"></span>
        <img src="<?php echo appImageUrl('/' . $papelArroz->getImagem(), 'media'); ?>" class="card-img-top" alt="...">
        </a>
    </div>
    <div class="card-body">
        <h5 class="card-title"><?php echo $papelArroz->getTitulo(); ?></h5>
        <p>Formato A4: 21:30cm</p>                           
    </div>
    <div class="card-footer">
        <form action="<?php echo appUrl('/carrinho/' . $papelArroz->getId() . '/add'); ?>" method="post">
            <input type="hidden" name="increment" value="true"> 
            <button name="quantidade" value="1" class="btn btn-sm btn-convert d-inline-block">Comprar <i class="fas fa-shopping-cart"></i></button>
            <a class="btn btn-sm btn-outline-secondary float-right" href="<?php echo appUrl('/produto/') . $papelArroz->getSlug(); ?>">Ver Detalhes</a>
        </form>
        
    </div>
</article>