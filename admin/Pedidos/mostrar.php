<?php

use app\enumerations\PedidoStatus;

$tituloPage = 'Pedidos';
require __DIR__ . '/../header.php';
require __DIR__ . '/../sidebar.php';
?>
<div class="content-page py-4">

    <div class="card">
        <div class="card-header">
            <h1 class="h3">Pedido nº <?php echo $pedido->getId(); ?></h1>
            <div class="nao-imprimir">
                <?php
                foreach (PedidoStatus::getConstants() as $status):
                    $label = PedidoStatus::getLabel($status);
                    $link = $this->pageAction('checkStatus', array(
                        'pedido-id' => $pedido->getId(),
                        'status'    => $status
                    ));
                    $date = $pedido->getStatus($status);
                    if (!empty($pedido->getStatus($status))) {
                        echo '<span style="display:none">1</span>';
                        echo "<a class=\"text-success\" href=\"$link\" title=\"$date\"><i class=\"fas fa-check\"></i> {$label}</a><br>";
                    } else {
                        echo "<a class=\"text-muted\" href=\"$link\"><i class=\"fas fa-check\"></i> {$label}</a><br>";
                    }
                endforeach;
                ?>
            </div>
        </div>
        <div class="card-body">
            <?php $c = $pedido->cliente(); ?>
            <p>Cliente: <?php echo $c->getNome() . ' - CPF: ' . $c->getCpf(); ?></p>
            <p>Contatos: <?php echo $c->getEmail() . ' - ' . $c->getWhatssap(); ?></p>
            <h6>Endereço para entrega</h6>
            <p>
                <?php
                $e = $pedido->endereco();
                echo $e->getLongradouro() . ', ' . $e->getNumero() . ' - Bairro: ' . $e->getBairro() . ' - ' . $e->getCidade() . '/' . $e->getUf() . ' - CEP: ' . $e->getCep();
                ?>
            </p>
        </div>
        <div class="card-header text-center">
            <b>Produtos</b>
        </div>
        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>img</th>
                    <th>produto</th>
                    <th>tipo</th>
                    <th>P.Unitário</th>
                    <th>QTD</th>
                    <th>P.Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pedido->carrinho()->getProdutos() as $p): ?>
                    <tr>
                        <td><?php echo $p['id']; ?></td>
                        <td>
                            <a href="<?php echo appImageUrl($p['imagem'], 'full'); ?>" target="_blank">
                                <img src="<?php echo appImageUrl($p['imagem'], 'thumb'); ?>" height="50">
                            </a>
                        </td>
                        <td><?php echo $p['titulo']; ?></td>
                        <td><?php echo $p['tipo']; ?></td>
                        <td>R$ <?php echo appFormPrice($p['preco']); ?></td>
                        <td><?php echo $p['quantidade']; ?></td>
                        <td>R$ <?php echo appFormPrice($p['vltotal']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="7" class="text-right"><span class="h3">Valor Total: R$ <?php echo appFormPrice($pedido->getVltotal());?></span></th>
                </tr>
            </tfoot>
        </table>
    </div>

</div>
<?php require __DIR__ . '/../footer.php'; ?>
<script>
    $(document).ready(function () {
        $('#table-listar').DataTable();
    });
</script>
</body>
</html>