<?php
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
                <th scope="col">Cliente</th>
                <th scope="col">Status</th>                                  
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pedidos->listAll() as $r => $p): ?>
                <tr>
                    <th scope="row"><?php echo $p->getId(); ?></th>
                    <td>                    
                        <?php echo $p->cliente()->getNome(); ?>
                        <div class="float-right">
                            <a class="btn btn-sm btn-primary pl-2" href="#">Editar</a>
                            <a class="btn btn-sm btn-danger pl-2" href="#">X</a>                        
                        </div>
                    </td>
                    <td><?php 
                    foreach($p->):
                        
                    endforeach;
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