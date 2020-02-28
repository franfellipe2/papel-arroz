<?php 
$pageTitle = 'Carrinho de compras';
$pageUrl = appUrl('/carrinho');
$pageImage = null;
$pageDescription = 'Carrinho de compras';
$pageType = app\enumerations\SMOTypes::WEBSITE;
require appConfig('frontDir') . '/header.php'; 
?>
<?php require __DIR__.'/alert-msg.php'; ?>
<section class="page-content mb-4">
    <div class="jumbotron jumbotron-fluid">
        <header class="container text-center">
            <h1 class="display-4 page-title"><i class="fas fa-shopping-cart icon"></i> Seu Carrinho de compras</h1>
            <p class="lead">Confira os itens adicionados em seu carrinho.</p>
        </header>
    </div>
    <div class="container" id="produtos">
        <p><?php echo $carrinho->getTotalProdutos(); ?> produtos adicinados ao carrinho:</p>
        <div class="carrinho-list">
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th><small>Produto<small></th>
                                    <th><small>Preço</small></th>
                                    <th><small>Q. Produtos</small></th>
                                    <th class="text-right"><small>V.Total</small></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($carrinho->getProdutos() as $p) { ?>
                                            <tr>
                                                <td><a class="btn btn-sm btn-danger" href="<?php echo appUrl('/carrinho/' . $p['id'] . '/remove') ?>" title="Excluir">x</a></td>
                                                <TD><?php echo $p['id'];?></TD>
                                                <td class="clearfix">
                                                    <img class="float-left mr-1" width="50" src="<?php echo appImageUrl($p['imagem'], 'thumb'); ?>">
                                                    <a href="<?php echo appUrl('/produto/' . $p['slug']); ?>"><?php echo $p['titulo']; ?></a>
                                                </td>
                                                <td>R$ <?php echo appFormPrice($p['preco']); ?></td>
                                                <td>
                                                    <?php $formName = "formQuantidade" . $p['id']; ?>
                                                    <div class="btn-group">
                                                        <div>
                                                            <a class="btn btn-sm btn-dark" href="<?php echo appUrl('/carrinho/' . $p['id'] . '/minus') ?>">-</a>
                                                        </div>
                                                        <form name="<?php echo $formName; ?>" action="<?php echo appUrl('/carrinho/' . $p['id']) . '/add'; ?>" method="post">
                                                            <input name="quantidade" onchange="upQtd('<?php echo $formName; ?>')" type="text" class="form-control form-control-sm" value="<?php echo $p['quantidade']; ?>" style="max-width: 50px; min-width: 30px;">
                                                        </form>
                                                        <form name="<?php echo $formName; ?>" action="<?php echo appUrl('/carrinho/' . $p['id']) . '/add'; ?>" method="post">
                                                            <input type="hidden" name="increment" value="true">
                                                            <button name="quantidade" type="submit" value="1" class="btn btn-sm btn-dark">+</button>                                      
                                                        </form>
                                                    </div>
                                                </td>
                                                <td class="text-right">R$ <?php echo appFormPrice($p['vltotal']); ?></td>
                                            </tr>

                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="2">
                                                Soma Total
                                            </th>
                                            <th class="text-right" colspan="4">
                                                R$ <?php echo appFormPrice($carrinho->getPrecoCarrinho()); ?>
                                            </th>
                                        </tr>
                                    </tfoot>
                                    </table>
                                    </div><!-- /.carrinho-list -->

                                    <div class="carrinho-tomar-decisao text-center">
                                        <h2>Valor Total <b>a pagar</b></h2>
                                        <h3>R$ <?php echo appFormPrice($carrinho->getPrecoCarrinho()); ?></h3>
                                        <br>
                                        <?php if ($carrinho->getPrecoCarrinho() > 0) { ?>
                                            <a class="btn btn-convert btn-lg" href="<?php echo appUrl('/fechar-pedido/'); ?>" title="Ir para finalizar compra.">Fechar Pedido</a>                                                                             
                                        <?php } ?>
                                        <a class="btn btn-outline-primary btn-lg" href="<?php echo appUrl('/'); ?>">Continuar Comprando</a>
                                    </div>

                                    </div><!-- ./container -->
                                    </section>                                    
                                    <?php require appConfig('frontDir') . '/footer.php'; ?>
                                    <script type="text/javascript">
                                        function upQtd(formName) {
                                            document.getElementsByName(formName)[0].submit();
                                        }
                                    </script>
                                    </body>
                                    </html>