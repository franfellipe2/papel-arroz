<?php // $this = o controller      ?>
<table class="table">
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
        <?php foreach ($papelArroz->listAll() as $r => $p): ?>
            <tr>
                <th scope="row"><?php echo $p['id']; ?></th>
                <td>                    
                    <?php echo $p['titulo']; ?>
                    <div class="float-right">
                        <a class="btn btn-sm btn-primary pl-2" href="<?php echo $this->pageAction('editar', ['id' => $p['id']]); ?>">Editar</a>
                        <a class="btn btn-sm btn-danger pl-2" href="<?php echo $this->pageAction('delete', ['id' => $p['id']]); ?>">X</a>                        
                    </div>
                </td>
                <td><?php echo $p['descricao']; ?></td>          
                <td><?php echo $p['preco']; ?></td>          
                <td><?php echo $p['personalizado']; ?></td>          
            </tr>        
        <?php endforeach; ?>
    </tbody>
</table>
