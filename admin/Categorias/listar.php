<?php 
// Proteje contra acesso direto ao arquivo
require __DIR__ . '/../protege-arquivo.php';
?>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Descricao</th>            
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categoriasAninhadas as $r => $c): ?>
            <tr>
                <th scope="row"><?php echo $c['id']; ?></th>
                <td>                    
                    <?php echo $c['nome']; ?>
                    <div class="float-right">
                        <a class="btn btn-sm btn-primary pl-2" href="<?php echo $this->pageAction('editar', ['id' => $c['id']]); ?>">Editar</a>
                        <a class="btn btn-sm btn-danger pl-2" href="<?php echo $this->pageAction('delete', ['id' => $c['id']]); ?>">X</a>                        
                    </div>
                </td>
                <td><?php echo $c['descricao']; ?></td>          
            </tr>        
        <?php endforeach; ?>
    </tbody>
</table>
