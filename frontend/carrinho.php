<?php require appConfig('frontDir') . '/header.php'; ?>

<section class="page-content">
    <div class="jumbotron jumbotron-fluid">
        <header class="container text-center">
            <h1 class="display-4 page-title"><i class="fas fa-shopping-cart icon"></i> Seu Carrinho de compras</h1>
            <p class="lead">Confira os itens adicionados em seu carrinho.</p>
        </header>
    </div>
    <div class="container" id="produtos">
        <p>20 Produtos adicinados ao carrinho:</p>
        <div class="carrinho-list">
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th></th>
                        <th><small>Produto<small></th>
                                    <th><small>Preço</small></th>
                                    <th><small>Q. Produtos</small></th>
                                    <th class="text-right"><small>V.Total</small></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php for ($i = 0; $i < 5; $i++) { ?>
                                            <tr>
                                                <td><a class="btn btn-sm btn-danger" href="#" title="Excluir">x</a></td>
                                                <td class="clearfix">
                                                    <img class="float-left mr-1" width="50" src="https://img.elo7.com.br/product/zoom/1B4BA72/painel-homen-aranha-1-80-x-1-20m-decoracao-de-festa.jpg">
                                                    <a href="<?php echo appUrl('/produto/papel-arroz-homem-aranha'); ?>">Papel de arroz do homem aranha</a>
                                                </td>
                                                <td>12,00</td>
                                                <td>
                                                    <form action="" method="post">
                                                        <div class="btn-group">
                                                            <a class="btn btn-sm btn-dark" href="#">-</a>
                                                            <input type="text" class="form-control form-control-sm" value="4" style="max-width: 50px">
                                                            <a class="btn btn-sm btn-dark" href="#">+</a>
                                                        </div>
                                                    </form>
                                                </td>
                                                <td class="text-right">48,00</td>
                                            </tr>

                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="2">
                                                Soma Total
                                            </th>
                                            <th class="text-right" colspan="3">
                                                R$ 240,00
                                            </th>
                                        </tr>
                                    </tfoot>
                                    </table>
                                    </div><!-- /.carrinho-list -->
                                    
                                    <div class="carrinho-tomar-decisao text-center">
                                        <h2>Valor Total <b>a pagar</b></h2>
                                        <h3>R$240,00 </h3>
                                        <br>
                                        <a class="btn btn-convert" href="#" title="Ir para finalizar compra.">Fechar Pedido</a>                                                                             
                                        <a class="btn btn-outline-primary" href="#">Continuar Comprando</a>
                                    </div>

                                    </div><!-- ./container -->
                                    </section>
                                    <div class="page-footer">
                                        rodape
                                    </div>
                                    <?php
                                    require appConfig('frontDir') . '/footer.php';
                                    