<?php
$pageTitle = 'Pedido Cadastrado com sucesso!';
$pageUrl = appUrl('/pedido/cadastrado');
$pageImage = null;
$pageDescription = 'Seu pedido foi cadastrado com sucesso';
$pageType = app\enumerations\SMOTypes::WEBSITE;
require appConfig('frontDir') . '/header.php';
?>
<div class="page-content pb-4">    
    <div class="jumbotron jumbotron-fluid bg-success text-white">
        <header class="container text-center">
            <h1 class="display-6 page-title">Pedido Cadastrado com sucesso!</h1>           
            <br>
            <h3><i class="fas fa-money-bill-wave"></i> Pagamento</h3>
            <p>Por enquanto só estamos aceitando dinheiro vivo.</p>             
        </header>
    </div>
    <div class="container">
        <div class="alert alert-success text-center">
            <h3>Valor a Pagar: <br><span class="h1">R$ <?php echo appFormPrice($pedido->getVlTotal()); ?></span></h3>
            <p><b>ANTENÇÃO!</b> Receberemos o pagamento no ato da entrega. </p>
        </div>
        <div class="alert alert-warning text-center">
            <h4>Atenção!</h4>
            <p><strong>Guarde esses dados para acompanhar seu pedido:</strong></p>
            <p>Número do pedido: <b><?php echo $pedido->getId(); ?></b> - Senha de Acesso: <b><?php echo $pedido->getSenhaAcesso(); ?></b></p>
            <p>Link: <a href="<?php echo appUrl('/pedido/acompanhar'); ?>"><b><?php echo appUrl('/pedido/acompanhar'); ?></b></a></p>
            <form action="<?php echo appUrl('/pedido/acompanhar'); ?>" method="post">
                <input name="id_pedido" type="hidden" value="<?php echo $pedido->getId(); ?>">
                <input name="senha" type="hidden" value="<?php echo $pedido->getSenhaAcesso(); ?>">
                <button type="submit" class="btn btn-sm btn-primary">Acompanhar Pedido</button>
            </form>
        </div>
        <article class="container text-center" style="text-transform: capitalize"> 
            <h2 class="mb-4">Dados do pedido</h2>      
            <section class="mb-4">            
                <h3 class="mb-3 h4 text-muted">Comprador(a):</h3>
                <p style="text-transform: capitalize;"><b>Nome:</b> <?php echo $pedido->cliente()->getNome(); ?> - <b>CPF:</b> <?php echo appFormatCPF($pedido->cliente()->getCpf()); ?></p>
                <p><b>Email:</b> <?php echo $pedido->cliente()->getEmail(); ?></p>
                <p><b>Telefone/Whatssap:</b> <?php echo $pedido->cliente()->getWhatssap(); ?></p>
            </section>
            <br>
            <section>
                <h3 class="mb-3 h4 text-muted">Endereço para entrega:</h3>
                <p style="text-transform: capitalize;"><?php echo $pedido->endereco()->getLongradouro() ?>, <?php echo $pedido->endereco()->getNumero() ?> - Complemento: <?php echo $pedido->endereco()->getComplemento() ?></p>
                <p><b>Bairro:</b> <?php echo $pedido->endereco()->getBairro(); ?></p>
                <p>
<?php echo $pedido->endereco()->getCidade(); ?>
                    <span> - </span>
                    <span style="text-transform: uppercase"><?php echo $pedido->endereco()->getUf(); ?></span>
                </p>
            </section>
            <br>
            <section class="mb-4">
                <h3 class="mb-3 h4 text-muted">Produtos:</h3>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Tipo</th>
                            <th>Quantidade</th>
                        </tr>
                    </thead>

                    <tbody>
<?php foreach ($pedido->carrinho()->getProdutos() as $item) { ?>
                            <tr>
                                <td><?php echo $item['titulo']; ?></td>
                                <td><?php echo str_replace(['-', '_'], ' ', $item['tipo']); ?></td>
                                <td><?php echo $item['quantidade']; ?></td>
                            </tr>
<?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3">
                                Valor Total R$ <?php echo appFormPrice($pedido->getVlTotal()); ?>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </section>

        </article>
    </div>
</div>
<?php require appConfig('frontDir') . '/footer.php'; ?>
</body>
</html>
