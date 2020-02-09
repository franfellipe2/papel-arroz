<?php require appConfig('frontDir') . '/header.php'; ?>

<section class="page-content">
    <div class="jumbotron jumbotron-fluid">
        <header class="container text-center">
            <h1 class="display-4 page-title">Carrinho</h1>
            <p class="lead">Confira os itens adicionados em seu carrinho.</p>
        </header>
    </div>
    <div class="container">
        <form action="">

            <table cellspacing="0" class="table">
                <thead>
                    <tr>
                        <th class="product-remove">&nbsp;</th>
                        <th class="product-thumbnail">&nbsp;</th>
                        <th class="product-name">Produto</th>
                        <th class="product-price">Preço</th>
                        <th class="product-quantity">Quantidade</th>
                        <th class="product-subtotal">Total</th>
                    </tr>
                </thead>
                <tbody>

                    <tr class="cart_item">
                        <td class="product-remove">
                            <a href="#" class="text-danger"><i class="fas fa-times"></i></a>
                        </td>

                        <td class="product-thumbnail">
                            <a href="#l}"><img width="145" height="145" alt="poster_1_up" class="shop_thumbnail" src="{$value.desphoto}"></a>
                        </td>

                        <td class="product-name">
                            <a href="{$HOME}/product/{$value.desurl}" title="{$value.desproduct}">Papel de arroz do homem aranha</a> 
                        </td>

                        <td class="product-price" style="max-width: 100px">
                            <span class="amount">R$12,00</span> 
                        </td>

                        <td class="product-quantity text-center">
                            <div class="quantity buttons_added">
                                <a class="btn btn-sm btn-secondary" href="{$HOME}/carrinho/minus/{$value.idproduct}">-</a>
                                <div class="form-control">1</div>
                                <a class="btn btn-sm btn-secondary" href="{$HOME}/carrinho/add/{$value.idproduct}">+</a>
                            </div>
                        </td>

                        <td class="product-subtotal">
                            <span class="amount">R$12,00</span> 
                        </td>
                    </tr>                  

                </tbody>
            </table>

            <div class="cart-collaterals">

                <div class="cart_totals ">

                    <h2>Resumo da Compra</h2>

                    <table cellspacing="0">
                        <tbody>
                            <tr class="cart-subtotal">
                                <th>Subtotal</th>
                                <td><span class="amount">R$12,00</span></td>
                            </tr>
                            <tr class="order-total">
                                <th>Total</th>
                                <td><strong><span class="amount">R$12,00</span></strong> </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="pull-right">
                <input class="btn btn-convert" type="submit" value="Fechar Pedido" name="proceed" class="checkout-button button alt wc-forward">
            </div>

        </form>
    </div><!-- ./container -->
</section>
<div class="page-footer">
    rodape
</div>
<?php

require appConfig('frontDir') . '/footer.php';
