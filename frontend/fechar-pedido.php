<?php
require appConfig('frontDir') . '/header.php';
?>
<div class="page-content pb-4">    
    <div class="jumbotron jumbotron-fluid">
        <header class="container text-center">
            <h1 class="display-6 page-title">Fechar Pedido e Finalizar a compra</h1>           
            <br>
            <h3><i class="fas fa-money-bill-wave"></i> Pagamento</h3>
            <p>Por enquanto só estamos aceitando dinheiro vivo. O pagamento será realizado no ato da entrega do seu pedido.</p>            
        </header>
    </div>
    <div class="container"> 

        <h2>Dados da compra:</h2>
        <table class="table table-primary">
            <thead>
                <tr>
                    <th></th>
                    <th>Produtos</th>
                    <th>Tipo</th>
                    <th class="text-center">Quantidade</th>
                    <th class="text-center">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($carrinho->getProdutos() as $p): ?>
                    <tr>
                        <td><img src="<?php echo appImageUrl($p['imagem'],'thumb');?>" style="width: 60px"></td>
                        <td><?php echo $p['titulo'];?></td>
                        <td><?php echo str_replace('_',' ', $p['tipo']);?></td>
                        <td class="text-center"><?php echo $p['quantidade'];?></td>
                        <td class="text-center">R$ <?php echo appFormPrice($p['vltotal']);?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>                
            <tfoot>
                <tr>
                    <td colspan="2"><strong class="h3">Total a pagar: </strong></td>                    
                    <td colspan="3" class="text-right"><strong class="h3">R$ <?php echo appFormPrice($carrinho->getPrecoCarrinho());?></strong></td>
                </tr>
            </tfoot>
        </table>        
        <br><br>
        <h2>Dados do comprador(a):</h2>
        <form name="formFecharPedido" action="<?php echo appUrl('/executar-fechar-pedido/'); ?>" method="post">
            <p>Os campos com (*) são obrigatórios.</p>
            <div class="form-row">
                <div class="col-7 mb-3">
                    <label>Nome Completo(*):</label>
                    <input name="nome" type="text" class="form-control" value="" placeholder="Nome Completo...">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-5 mb-3">
                    <label>CPF(*):</label>
                    <input name="cpf" type="text" class="form-control " placeholder="CPF...">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Email:</label>                    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input name="email" type="email" class="form-control ">
                        <div class="invalid-feedback">
                            Please choose a username.
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Whatssap:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
                        </div>
                        <input name="whatssap" type="text" class="form-control ">
                        <div class="invalid-feedback">
                            Please choose a username.
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-10 mb-3">
                    <label>Endereço(*):</label>
                    <input name="longradouro" type="text" class="form-control ">
                    <div class="invalid-feedback">
                        Please provide a valid city.
                    </div>
                </div>
                <div class="col-md-2 mb-3">
                    <label>Número(*):</label>
                    <input name="numero" type="text" class="form-control ">
                    <div class="invalid-feedback">
                        Please provide a valid city.
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Complemento:</label>
                    <input name="complemento" type="text" class="form-control ">
                    <div class="invalid-feedback">
                        Please provide a valid city.
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Bairro(*):</label>
                    <input name="bairro" type="text" class="form-control ">
                    <div class="invalid-feedback">
                        Please provide a valid city.
                    </div>
                </div>
            </div>            
            <button class="btn btn-convert btn-lg" type="submit">Finalizar Compra</button>
        </form>
    </div>
</div>
<?php require appConfig('frontDir') . '/footer.php'; ?>
</body>
</html>
