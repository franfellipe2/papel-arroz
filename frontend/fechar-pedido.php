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
                    <th class="text-center">Quantidade</th>
                    <th class="text-center">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><img src="http://localhost/papel-arroz/uploads/images/the-walking-dead-1581279691-size(thumb).jpg" style="width: 60px"></td>
                    <td>Papel arroz do homem aranha</td>
                    <td class="text-center">3</td>
                    <td class="text-center">R$ 48,00</td>
                </tr>
            </tbody>                
            <tfoot>
                <tr>
                    <td colspan="2"><strong class="h1">Total a pagar: </strong></td>                    
                    <td colspan="2" class="text-right"><strong class="h1">R$ 48,00</strong></td>
                </tr>
            </tfoot>
        </table>        
        <br><br>
        <h2>Dados do comprador(a):</h2>
        <form name="formFecharPedido" action="<?php echo appUrl('/executar-fechar-pedido/'); ?>" method="post">
            <p>Os campos com (*) são obrigatórios.</p>
            <div class="form-row">
                <div class="col-7 mb-3">
                    <label for="validationServer01">Nome Completo(*):</label>
                    <input name="nome" type="text" class="form-control" id="validationServer01" value="Mark" >
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-5 mb-3">
                    <label for="validationServer01">CPF(*):</label>
                    <input name="cpf" type="text" class="form-control " id="validationServer01" value="Mark" >
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationServerUsername">Email:</label>                    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend3">@</span>
                        </div>
                        <input name="email" type="email" class="form-control " id="validationServerUsername" aria-describedby="inputGroupPrepend3">
                        <div class="invalid-feedback">
                            Please choose a username.
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationServerUsername">Whatssap:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend3">@</span>
                        </div>
                        <input name="email" type="text" class="form-control " id="validationServerUsername" aria-describedby="inputGroupPrepend3">
                        <div class="invalid-feedback">
                            Please choose a username.
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-10 mb-3">
                    <label for="validationServer03">Endereço(*):</label>
                    <input name="longradouro" type="text" class="form-control " id="validationServer03" >
                    <div class="invalid-feedback">
                        Please provide a valid city.
                    </div>
                </div>
                <div class="col-md-2 mb-3">
                    <label for="validationServer03">Número(*):</label>
                    <input name="longradouro" type="text" class="form-control " id="validationServer03" >
                    <div class="invalid-feedback">
                        Please provide a valid city.
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationServer03">Complemento:</label>
                    <input name="longradouro" type="text" class="form-control " id="validationServer03" >
                    <div class="invalid-feedback">
                        Please provide a valid city.
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationServer03">Bairro(*):</label>
                    <input name="longradouro" type="text" class="form-control " id="validationServer03" >
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
