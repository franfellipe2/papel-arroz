<?php
$pageTitle = 'Fechar pedido';
$pageUrl = appUrl('/fechar-pedido/');
$pageImage = null;
$pageImageAlt = null;
$pageDescription = 'Fechar o pedido e finalizar a compra';
$pageType = app\enumerations\SMOTypes::WEBSITE;
require appConfig('frontDir') . '/header.php';
?>
<?php require __DIR__ . '/alert-msg.php'; ?>
<div class="page-content pb-4">    
    <?php if (isset($errors) && !empty($errors)) { ?>
        <div class="jumbotron jumbotron-fluid bg-warning text-white">
            <header class="container text-center">
                <h1 class="display-6 page-title">Opss... Erro ao fechar o pedido!</h1>   
                <br>               
                <p>Por favor, verifique se você informou os dados corretamente.</p>  
            </header>
        </div>
    <?php } else { ?>
        <div class="jumbotron jumbotron-fluid">
            <header class="container text-center">
                <h1 class="display-6 page-title">Fechar Pedido e Finalizar a compra</h1>   
                <br>
                <h3><i class="fas fa-money-bill-wave"></i> Pagamento</h3>
                <p>Por enquanto só estamos aceitando dinheiro vivo. O pagamento será realizado no ato da entrega do seu pedido.</p>  
            </header>
        </div>
    <?php } ?>
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
                        <td><img src="<?php echo appImageUrl($p['imagem'], 'thumb'); ?>" style="width: 60px"></td>
                        <td><?php echo $p['titulo']; ?></td>
                        <td><?php echo str_replace('_', ' ', $p['tipo']); ?></td>
                        <td class="text-center"><?php echo $p['quantidade']; ?></td>
                        <td class="text-center">R$ <?php echo appFormPrice($p['vltotal']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>                
            <tfoot>
                <tr>
                    <td colspan="2"><strong class="h3">Total a pagar: </strong></td>                    
                    <td colspan="3" class="text-right"><strong class="h3">R$ <?php echo appFormPrice($carrinho->getPrecoCarrinho()); ?></strong></td>
                </tr>
            </tfoot>
        </table>        
        <br><br>
        <h2>Dados do comprador(a):</h2>
        <form id="formFecharPedido" name="formFecharPedido" action="<?php echo appUrl('/executar-fechar-pedido/'); ?>" method="post">
            <p>Os campos com (*) são obrigatórios.</p>
            <div class="form-row">
                <div class="col-7 mb-3">
                    <label>Nome Completo(*):</label>
                    <input name="nome" type="text" class="form-control <?php if ($pessoa->getError('nome')) echo 'is-invalid'; ?>" 
                           value="<?php echo $pessoa->getNome(); ?>" placeholder="Nome Completo...">
                    <div class="invalid-feedback">
                        <?php if ($pessoa->getError('nome')) echo $pessoa->getError('nome'); ?>
                    </div>
                </div>
                <div class="col-5 mb-3">
                    <label>CPF(*):</label>                                           
                    <input name="cpf" type="text" class="form-control <?php if ($pessoa->getError('cpf')) echo 'is-invalid'; ?>" 
                           value="<?php echo $pessoa->getCpf(); ?>" placeholder="CPF...">
                    <div class="invalid-feedback">
                        <?php if ($pessoa->getError('cpf')) echo $pessoa->getError('cpf'); ?>
                    </div>                    
                </div>
                <div class="col-md-6 mb-3">
                    <label>Email:</label>                    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input name="email" type="email" class="form-control <?php if ($pessoa->getError('email')) echo 'is-invalid'; ?>"
                               value="<?php echo $pessoa->getEmail(); ?>" placeholder="Email...">
                        <div class="invalid-feedback">
                            <?php if ($pessoa->getError('email')) echo $pessoa->getError('email'); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Telefone/Whatssap:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
                        </div>
                        <input name="whatssap" type="text" class="form-control <?php if ($pessoa->getError('email')) echo 'is-invalid'; ?>" 
                               value="<?php echo $pessoa->getWhatssap(); ?>">
                        <div class="invalid-feedback">
                            <?php if ($pessoa->getError('email')) echo $pessoa->getError('email'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-10 mb-3">
                    <label>Endereço(*):</label>
                    <input name="longradouro" type="text" class="form-control <?php if ($endereco->getError('longradouro')) echo 'is-invalid'; ?>" 
                           value="<?php echo $endereco->getLongradouro(); ?>">
                    <div class="invalid-feedback">
                        <?php if ($endereco->getError('longradouro')) echo $endereco->getError('longradouro'); ?>
                    </div>
                </div>
                <div class="col-md-2 mb-3">
                    <label>Número(*):</label>
                    <input name="numero" type="text" class="form-control <?php if ($endereco->getError('numero')) echo 'is-invalid'; ?>" 
                           value="<?php echo $endereco->getNumero(); ?>">
                    <div class="invalid-feedback">
                        <?php if ($endereco->getError('numero')) echo $endereco->getError('numero'); ?>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Complemento:</label>
                    <input name="complemento" type="text" class="form-control <?php if ($endereco->getError('complemento')) echo 'is-invalid'; ?>"
                           value="<?php echo $endereco->getComplemento(); ?>">
                    <div class="invalid-feedback">
                        <?php if ($endereco->getError('complemento')) echo $endereco->getError('complemento'); ?>
                    </div>
                </div>  
                <div class="col-md-6 mb-3">
                    <label>Bairro(*):</label>
                    <input name="bairro" type="text" class="form-control <?php if ($endereco->getError('bairro')) echo 'is-invalid'; ?>"
                           value="<?php echo $endereco->getBairro(); ?>">
                    <div class="invalid-feedback">
                        <?php if ($endereco->getError('bairro')) echo $endereco->getError('bairro'); ?>
                    </div>
                </div>                              
            </div>            
            <button class="btn btn-convert btn-lg" type="submit">Finalizar Compra</button>
        </form>
    </div>
</div>
<div id="confirmModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog bg-warning" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confira se os dados estão corretos:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">              
                <div id="data-confirm"></div>
            </div>
            <div class="modal-footer">
                <button id="btn-form-submit" type="button" class="btn btn-primary">Prosseguir</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Corrigir</button>
            </div>
        </div>
    </div>
</div>
<?php require appConfig('frontDir') . '/footer.php'; ?>
<script type="text/javascript">
    $('document').ready(function () {
        $('#formFecharPedido').on('submit', function (e) {
            e.preventDefault();
            var form = e.target;
            var d = {};
            $(form).serializeArray().forEach(function (v) {
                d[v.name] = v.value;
            });
            var $msg = '<p><strong><i class="far fa-address-card"></i> Dados pessoais:</strong></p>';
            $msg += '<p>Nome: ' + d.nome + " - CPF: " + d.cpf + "</p>";
            $msg += '<p>Email: ' + d.email + " - Telefone/Whatssap: " + d.whatssap + "</p>";
            $msg += "<p><strong><i class=\"fas fa-map-marked-alt\"></i> Endereço para entrega:</strong></p>";
            $msg += '<p>' + d.longradouro + ', ' + d.numero + " - ";
            $msg += 'Complemento: ' + d.complemento + "</p>";
            $msg += '<p>Bairro: ' + d.bairro + ' - Frutal / MG - CEP: 38200-000</p>';
            $('#data-confirm').html($msg);

            $('#confirmModal').modal('show');

            $('#btn-form-submit').on('click', function () {
                form.submit();
            });

        });



    });

</script>
</body>
</html>
