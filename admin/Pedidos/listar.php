<?php

use app\enumerations\PedidoStatus;

$tituloPage = 'Pedidos';
require __DIR__ . '/../header.php';
require __DIR__ . '/../sidebar.php';
?>
<div class="content-page py-4">

    <h1 class="h3">Pedidos</h1>
    <hr>
    <table id="table-listar" class="display">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Status</th> 
                <th scope="col">Cliente</th>  
                <th scope="col">cpf</th>
                <th scope="col">email</th>
                <th scope="col">telefone</th>
                <th scope="col">endereco</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pedidos as $p): ?>
                <tr>
                    <th scope="row"><a href="<?php echo $this->pageAction('mostrar', ['id' => $p->getId() ]); ?>"><?php echo $p->getId(); ?></a></th>                   
                    <td>
                        <?php
                        foreach (PedidoStatus::getConstants() as $status):
                            $label = PedidoStatus::getLabel($status);
                            $link = $this->pageAction('checkStatus', array(
                                'pedido-id' => $p->getId(),
                                'status'    => $status
                            ));
                            $date = $p->getStatus($status);
                            if (!empty($p->getStatus($status))) {
                                echo '<span style="display:none">1</span>';
                                echo "<a class=\"text-success\" href=\"$link\" title=\"$date\"><i class=\"fas fa-check\"></i> {$label}</a><br>";
                            } else {
                                echo "<a class=\"text-muted\" href=\"$link\"><i class=\"fas fa-check\"></i> {$label}</a><br>";
                            }
                        endforeach;
                        ?>
                    </td> 
                    <td>                    
                        <?php echo $p->cliente()->getNome(); ?>                        
                    </td>
                    <td><?php echo $p->cliente()->getCpf(); ?></td>
                    <td><?php echo $p->cliente()->getEmail(); ?></td>
                    <td><?php echo $p->cliente()->getWhatssap(); ?></td>
                    <td><?php
                        $e = $p->endereco();
                        echo $e->getLongradouro() . ', ' . $e->getNumero() . ' - Bairro: ' . $e->getBairro() . ' - ' . $e->getCidade() . '/' . $e->getUf().' - CEP: '.$e->getCep();
                        ?></td>
                </tr>        
            <?php endforeach; ?>
        </tbody>
    </table>

</div>
<?php require __DIR__ . '/../footer.php'; ?>
<script>
    $(document).ready(function () {
        $('#table-listar').DataTable();
    });
</script>
</body>
</html>