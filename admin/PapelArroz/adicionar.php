
<?php if ($papelArroz->getMsgError()) { ?>
    <div class="alert alert-danger" role="alert">
        <h4><?php echo $papelArroz->getMsgError(); ?></h4>
        <ul class="list-group">
            <?php foreach($erros as $e):?>
            <li class="list-group-item"><?php echo $e; ?></li>
            <?php endforeach;?>
        </ul>
    </div>
<?php } ?>
<form name="categoria-criar" action="<?php echo $formAction; ?>" method="post" enctype="multipart/form-data">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Adicionar Papel Arroz</h5>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>Titulo</label>
                <input name='titulo' type="text" class="form-control <?php if (!empty($erros['titulo'])) echo 'is-invalid'; ?>" value="">

                <div class="invalid-feedback">
                    <?php if (!empty($erros['titulo'])) echo $erros['titulo']; ?>
                </div>
            </div>
            <div class="form-group">
                <label>Imagem</label>
                <input name='imagem' type="file" class="form-control <?php if (!empty($erros['imagem'])) echo 'is-invalid'; ?>" accept=".png, .jpg, .jpeg">

                <div class="invalid-feedback">
                    <?php if (!empty($erros['imagem'])) echo $erros['imagem']; ?>
                </div>
            </div>
            <div class="form-group">
                <label>Descrição </label>
                <textarea name="descricao" class="form-control <?php if (!empty($erros['descricao'])) echo 'is-invalid'; ?>"></textarea>
                <div class="invalid-feedback">
                    <?php if (!empty($erros['descricao'])) echo $erros['descricao']; ?>
                </div>
            </div>
            <div class="form-group">
                <label>Preço </label>
                <input type="text" name="preco" class="form-control <?php if (!empty($erros['preco'])) echo 'is-invalid'; ?>">
                <div class="invalid-feedback">
                    <?php if (!empty($erros['preco'])) echo $erros['preco']; ?>
                </div>
            </div>
            <div class="form-group">
                <label>Categoria</label>
                <select name="cat_id" class="form-control <?php if (!empty($erros['cat_id'])) echo 'is-invalid'; ?>">
                    <option></option>
                    <?php
                    $categoria = new CategoriasAninhadas();
                    $cats = $categoria->get();
                    foreach ($cats as $r => $c):
                        ?>
                        <option value="<?php echo $c['id']; ?>"><?php echo $c['nome']; ?></option>
                        <?php
                    endforeach;
                    ?>
                </select>
                <div class="invalid-feedback">
                    <?php if (!empty($erros['cat_id'])) echo $erros['cat_id']; ?>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" type="submit">Cadastrar</button>
        </div>
    </div>
</form>