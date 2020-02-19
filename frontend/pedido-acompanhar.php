<?php

use app\enumerations\PedidoStatus as pStatus;

require appConfig('frontDir') . '/header.php';
?>

<section class="page-content">
    <div class="jumbotron jumbotron-fluid">
        <header class="container text-center">
            <h1>Acompanhar Pedido</h1>
            <p>Acompanhe aqui seu pedido</p>
        </header>
    </div>
    <div class="container">

        <form action="<?php echo appUrl('/pedido/acompanhar/form#pedido'); ?>" method="post">
            <div class="row">
                <div class="col col-12">
                    <div class="form-group">                
                        <label>Número do pedido:</label>                               
                        <input name="id_pedido" type="text" class="form-control"  placeholder="Numero do pedido...">                
                    </div>
                </div>
                <div class="col col-12 col-sm-6">
                    <div class="form-group">                
                        <label>Senha de acesso:</label>                               
                        <input name="senha" type="text" class="form-control"  placeholder="Sua senha de acesso...">                
                    </div>
                </div>
                <div class="col col-12 col-sm-1 mb-4">ou</div>
                <div class="col col-sm-5">
                    <div class="form-group">                
                        <label>CPF:</label>                               
                        <input name="cpf" type="text" class="form-control"  placeholder="cpf...">                
                    </div>
                </div>
            </div>
            <input class="btn btn-primary" type="submit" value="Mostrar Pedido">
        </form>

        <?php if (!empty($errors)) { ?>
            <hr>
            <div class="alert alert-warning">
                <?php echo $errors; ?>
            </div>
        <?php } else { ?>
            <hr>
            <div id="pedido" class="card">

                <div class="card-header">
                    <h3>Pedido nº <?php echo $pedido->getId(); ?></h3>
                </div>
                <div class="card-body">
                    <h5>STATUS:</h5>
                    <ul>         
                        <?php foreach (pStatus::getConstants() as $k => $status) { ?>
                            <li>
                                <?php
                                if (!empty(($date = $pedido->getStatus($status)))) {
                                    echo '<span class="text-success"><i class="fas fa-check"></i> Recebido - ' . date('d/m/Y H:i:s', strtotime($date)) . '</span>';
                                } else {
                                    ?>
                                    <span class="text-muted"><?php echo pStatus::getLabel($status); ?></span>
                                <?php } ?>
                            </li>
                        <?php } ?>
                    </ul>
                    <h5>DETALHES:</h5>
                    <p><?php echo $pedido->cliente()->getNome(); ?> - CPF <?php echo appFormatCPF($pedido->cliente()->getCpf()); ?></p>
                    <p style="text-transform: capitalize;">
                        <b>Endereço para entrega:</b><br>
                        <?php echo $pedido->endereco()->getLongradouro() . ', ' . $pedido->endereco()->getNumero() . ' - ' . $pedido->endereco()->getComplemento(); ?>                        
                        <span> | </span>
                        Bairro: <?php echo $pedido->endereco()->getBairro() . ' - ' . $pedido->endereco()->getCidade() . ' / <span style="text-transform: uppercase">' . $pedido->endereco()->getUf() . '</span>'; ?>                        
                        <span> - </span>
                        CEP: <?php echo $pedido->endereco()->getCep(); ?>
                    </p>

                </div>                
                <table class="table">                   
                    <thead>
                        <tr>
                            <th colspan="3" class="text-center">PRODUTOS</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th>Tipo</th>
                            <th>Quantidade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pedido->carrinho()->getProdutos() as $p): ?>
                            <tr>
                                <td>
                                    <img src="<?php echo appImageUrl($p['imagem'], 'thumb');?>" height="45px">
                                    <?php echo $p['titulo'] ?>
                                </td>
                                <td><?php echo $p['tipo'] == 'papel_arroz' ? 'Papel Arroz' : null; ?></td>
                                <td><?php echo $p['quantidade']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3">Preço Total:  R$<?php echo appFormPrice($pedido->getVltotal()); ?></th>                                   
                        </tr>
                    </tfoot>
                </table>
            </div>
        <?php } ?>
    </div><!-- ./container -->
</section>
<?php require appConfig('frontDir') . '/footer.php'; ?>
</body>
</html>
