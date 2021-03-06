<?php
$pageTitle = $produto->getTitulo();
$pageUrl = appUrl('/produto/' . $produto->getSlug());
$pageImage = appImageUrl($produto->getImagem(), 'grande');
$pageImageAlt = $produto->getTitulo();
$pageDescription = substr($produto->getDescricao(), 0, 255);
$pageDescription .= strlen($produto->getDescricao()) > 157 ? '...' : null;
$pageType = app\enumerations\SMOTypes::ARTICLE;
require appConfig('frontDir') . '/header.php';
?>
<?php require __DIR__ . '/alert-msg.php'; ?>
<section class="page-content page-produto">    
    <div class="container my-4">
        <h1 class="sr-only"><?php echo $produto->getTitulo() ?></h1>
        <article class="produto">

            <h2 class="page-title h2 mb-4 text-center"><?php echo $produto->getTitulo() ?></h2>   

            <div class="row">
                <div  class="produto-content col-md-8">
                    <img src="<?php echo appImageUrl($produto->getImagem(), 'grande'); ?>" alt="<?php echo $produto->getTitulo();?>">
                    <p><?php echo $produto->getDescricao(); ?></p>
                    <div class="alert alert-light" style="background: none; border: none;">
                        <?php if (strtolower(str_replace('_', ' ', $produto->getTipo())) == 'papel arroz') { ?>
                            <p>O papel de arroz comestível a base de água.
                                Pode ser aplicado em: bolos, pirulitos de chocolate, doces, bombons, tortas, salgados, e até mesmo em velas e sabonetes artesanais.</p>

                            <p>Validade: 18 meses a partir da data de fabricação.</p>

                            <p> Ingredientes: água, fécula de batata, fécula de arroz e corante comestível.
                                Tamanho A4: aprox. 20cm x 30cm.
                                Ideal para um Bolo de até 4kg.</p>

                            <p><b>Informação nutricional:</b><p>
                            <p>Valor calórico: 139 kcal - Carboidratos: 29g - Proteínas: 8g - Gorduras totais: 13g - Colesterol: 0mg - Fibra alimentar: 6g - Cálcio: 32mg - Ferro: 1mg - Sódio: 28mg</p>

                        <?php } ?>
                    </div>

                </div>
                <div class="acao col-md-4"> 
                    <section class="widget">
                        <h3 class="titulo-secao">Detalhes</h3>
                        <ul>
                            <?php if ($produto->getTipo() == 'papel_arroz') { ?>
                                <li><b>Dimensões:</b> A4 21x29,7cm</li>
                                <li><b>Tipo:</b> Papel de arroz comestível</li>
                            <?php } ?>
                        </ul>  
                    </section>
                    <form action="<?php echo appUrl('/carrinho/' . $produto->getId() . '/add'); ?>" method="post">
                        <input type="hidden" name="increment" value="true"> 
                        <button name="quantidade" value="1" class="btn btn-sm btn-convert d-inline-block">Comprar <i class="fas fa-shopping-cart"></i></button>
                        <p><small>Adiciona o produto ao carrinho</small></p>
                    </form>
                </div>
            </div><!-- /.row -->
        </article>

    </div><!-- ./container -->
</section>
<?php require appConfig('frontDir') . '/footer.php'; ?>
</body>
</html>
