<?php require appConfig('frontDir') . '/header.php'; ?>
<section class="page-content">
    <div class="jumbotron jumbotron-fluid">
        <header class="container text-center">
            <h1 class="display-4 page-title"><i class="fas fa-shopping-cart icon"></i> Seu Carrinho de compras</h1>
            <p class="lead">Confira os itens adicionados em seu carrinho.</p>
        </header>
    </div>
    <div class="container" id="produtos">
        <p><?php echo $carrinho->getData()['total_produtos'];?> produtos adicinados ao carrinho:</p>
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
                                        <?php foreach ($carrinho->getProdutos() as $p) { ?>
                                            <tr>
                                                <td><a class="btn btn-sm btn-danger" href="<?php echo appUrl('/carrinho/'.$p['id'].'/remove') ?>" title="Excluir">x</a></td>
                                                <td class="clearfix">
                                                    <img class="float-left mr-1" width="50" src="<?php echo appImageUrl($p['imagem'], 'thumb'); ?>">
                                                    <a href="<?php echo appUrl('/produto/' . $p['slug']); ?>"><?php echo $p['titulo']; ?></a>
                                                </td>
                                                <td><?php echo $p['preco']; ?></td>
                                                <td>
                                                    <?php $formName = "formQuantidade" . $p['id']; ?>
                                                    <div class="btn-group">
                                                        <a class="btn btn-sm btn-dark" href="<?php echo appUrl('/carrinho/' . $p['id'] . '/minus') ?>">-</a>
                                                        <form name="<?php echo $formName; ?>" action="<?php echo appUrl('/carrinho/' . $p['id']).'/add'; ?>" method="post">
                                                            <input name="quantidade" onchange="upQtd('<?php echo $formName; ?>')" type="text" class="form-control form-control-sm" value="<?php echo $p['quantidade']; ?>" style="max-width: 50px">
                                                        </form>
                                                        <form name="<?php echo $formName; ?>" action="<?php echo appUrl('/carrinho/' . $p['id']).'/add'; ?>" method="post">
                                                            <input type="hidden" name="increment" value="true">
                                                            <button name="quantidade" type="submit" value="1" class="btn btn-sm btn-dark">+</button>                                      
                                                        </form>
                                                    </div>
                                                </td>
                                                <td class="text-right"><?php echo $p['vltotal']; ?></td>
                                            </tr>

                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="2">
                                                Soma Total
                                            </th>
                                            <th class="text-right" colspan="3">
                                                <?php echo $carrinho->getData()['preco_carrinho'];?>
                                            </th>
                                        </tr>
                                    </tfoot>
                                    </table>
                                    </div><!-- /.carrinho-list -->

                                    <div class="carrinho-tomar-decisao text-center">
                                        <h2>Valor Total <b>a pagar</b></h2>
                                        <h3><?php echo $carrinho->getData()['preco_carrinho'];?></h3>
                                        <br>
                                        <a class="btn btn-convert" href="#" title="Ir para finalizar compra.">Fechar Pedido</a>                                                                             
                                        <a class="btn btn-outline-primary" href="#">Continuar Comprando</a>
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