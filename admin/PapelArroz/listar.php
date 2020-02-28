<?php
// Proteje contra acesso direto ao arquivo
require __DIR__ . '/../protege-arquivo.php';

$tituloPage = 'Listar Papeis arroz';
require __DIR__ . '/../header.php';
require __DIR__ . '/../sidebar.php';
?>
<div class="content-page py-4">

    <h1 class="h3">Papeis Arroz</h1>
    <hr>
    <table id="table-listar" class="display">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Titulo</th>
                <th scope="col">Descricao</th>            
                <th scope="col">Preço</th>            
                <th scope="col">Personalizado</th>            
            </tr>
        </thead>
        <tbody>
            <?php
            if ($produtos) {
                foreach ($produtos as $r => $p):
                    ?>
                    <tr>
                        <th scope="row"><?php echo $p->getId(); ?></th>
                        <td>                    
                            <?php echo $p->getTitulo(); ?>
                            <div class="float-right">
                                <a class="btn btn-sm btn-primary pl-2" href="<?php echo $this->pageAction('editar', ['id' => $p->getId()]); ?>">Editar</a>
                                <a class="btn btn-sm btn-danger pl-2" href="<?php echo $this->pageAction('delete', ['id' => $p->getId()]); ?>">X</a>                        
                            </div>
                        </td>
                        <td><?php echo $p->getDescricao(); ?></td>          
                        <td><?php echo $p->getPreco(); ?></td>          
                        <td><?php echo $p->getPersonalizado(); ?></td>          
                    </tr>        
                <?php
                endforeach;
            }
            ?>
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