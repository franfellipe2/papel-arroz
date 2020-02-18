<?php require appConfig('frontDir') . '/header.php'; ?>

<section class="page-content">
    <div class="jumbotron jumbotron-fluid">
        <header class="container text-center">
            <h1>Acompanhar Pedido</h1>
            <p>Acompanhe aqui seu pedido</p>
        </header>
    </div>
    <div class="container">
        <form action="<?php echo appUrl('/pedido/acompanhar/form'); ?>" method="post">
            <div class="row">
                <div class="col col-sm-6">
                    <div class="form-group">                
                        <label>Número do pedido:</label>                               
                        <input name="numero" type="text" class="form-control"  placeholder="Numero do pedido...">                
                    </div>
                </div>
                <div class="col col-sm-6">
                    <div class="form-group">                
                        <label>Senha de acesso:</label>                               
                        <input name="senha" type="text" class="form-control"  placeholder="Sua senha de acesso...">                
                    </div>
                </div>
            </div>
            <input class="btn btn-primary" type="submit" value="Mostrar Pedido">
        </form>
    </div><!-- ./container -->
</section>
<?php require appConfig('frontDir') . '/footer.php'; ?>
</body>
</html>
