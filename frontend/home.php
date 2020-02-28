<?php
$pageTitle = appConfig('siteName');
require appConfig('frontDir') . '/header.php';
?>
<?php require __DIR__ . '/alert-msg.php'; ?>
<div class="jumbotron banner-home">
    <div class="container text-center">
        <h1>Papel de arroz comestível</h1>        
        <p>O papel de arroz é utilizado para decoração de alimentos, é impresso com corante comestível a base de água. Pode ser aplicado em: bolos, pirulitos de chocolate, doces, bombons, tortas, salgados, e até mesmo em velas e sabonetes artesanais.</p>                        
        <img class="img-fluid" 
             src="<?php echo appUrl('/frontend/assets/images/banner-home.png'); ?>" title="banner papel arroz comestível"
             alt="banner papel arroz comestível">
            <div class="scroll-to-content-container">
                <a class="scroll-to-content" href="#site-content" onclick="appScrollTo('#site-content')">
                    <i class="fas fa-angle-down h1"></i>
                </a>
            </div>
    </div>
</div>
<section class="container nossos-servicos py-5">
    <h2 class="sr-only">Nossos serviços</h3>
    <div class="row border-bottom pb-5">
        <div class="col-md-4 py-4">
            <div class="icon"><i class="fas fa-pencil-ruler"></i></div>
            <h3 class="title">Projetos Personalizados</h3>
            <p class="description">Fazemos qualquer tema e foto, para isso entre em contato por meio do nosso Whatssap:</p>            
            <div class="footer"><?php echo appConfig('whatssap'); ?></div>
        </div><!-- /.col-lg-4 -->
        <div class="col-md-4 py-4">
            <div class="icon"><i class="fas fa-dolly"></i></div>
            <h3 class="title">Entregas em domicílio</h3>
            <p class="description">Você não precisa sair de casa para buscar sua encomenda. Fazemos entregas de Segunda a Sexta das 14:00 as 18:00 e sabado das 08:00 as 11:00 </p>          
        </div><!-- /.col-lg-4 -->        
        <div class="col-md-4 py-4">
            <div class="icon"><i class="fas fa-money-bill-wave"></i></div>
            <h3 class="title">Só Paga quando receber</h3>
            <p class="description">Receberemos o pagamento no ato da entrega. Por enquanto estamos aceitando somente dinheiro vivo.</p>          
        </div><!-- /.col-lg-4 -->        
    </div>
</section>

<div class="page-content py-4">   
    <section class="page-content secao">
        <div class="container" id="site-content">
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
