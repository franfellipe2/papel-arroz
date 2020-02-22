<?php

// Proteje contra acesso direto ao arquivo
require __DIR__ . '/../protege-arquivo.php';

$tituloPage = 'Categorias';
require __DIR__ . '/../header.php';
require __DIR__ . '/../sidebar.php';
?>
<div class="content-page">
    <?php if ($papelArroz->getMsgError()) { ?>
        <div class="alert alert-danger" role="alert">
            <h4><?php echo $papelArroz->getMsgError(); ?></h4>
            <ul class="list-group">
                <?php foreach ($erros as $e): ?>
                    <li class="list-group-item"><?php echo $e; ?></li>
                <?php endforeach; ?>
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
                    <input name='titulo' type="text" class="form-control <?php if (!empty($erros['titulo'])) echo 'is-invalid'; ?>" value="<?php echo $papelArroz->getTitulo(); ?>">
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
                    <textarea name="descricao" class="form-control <?php if (!empty($erros['descricao'])) echo 'is-invalid'; ?>"><?php echo $papelArroz->getDescricao(); ?></textarea>
                    <div class="invalid-feedback">
                        <?php if (!empty($erros['descricao'])) echo $erros['descricao']; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Preço </label>
                    <input type="text" name="preco" class="form-control <?php if (!empty($erros['preco'])) echo 'is-invalid'; ?>" value="<?php echo $papelArroz->getPreco(); ?>">
                    <div class="invalid-feedback">
                        <?php if (!empty($erros['preco'])) echo $erros['preco']; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Categoria</label>                
                    <?php
                    $ca = $categoriasAninhadas;
                    $catInvalid = !empty($erros['cat_ids_form']) ? 'is-invalid' : null;
                    $catIds = $papelArroz->getCatIdsForm();
                    foreach ($ca->get() as $r => $c):
                        ?>     
                        <div class="form-check">
                            <input name="cat_ids_form[]" class="form-check-input <?php echo $catInvalid; ?>" type="checkbox" value=" <?php echo $c['id']; ?>" 
                            <?php
                            if (!empty($catIds) && in_array($c['id'], $catIds)) {
                                echo 'checked';
                            }
                            ?>>
                            <label class="form-check-label">
                                <?php echo $c['nome']; ?>
                            </label>                       
                        </div>
                        <?php
                    endforeach;
                    ?>
                    <div class="form-control <?php echo $catInvalid; ?>" style="display:none"></div>
                    <div class="invalid-feedback">                   
                        <?php if (!empty($erros['cat_ids_form'])) echo $erros['cat_ids_form']; ?>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" type="submit">Cadastrar</button>
            </div>
        </div>
    </form>
</div>
<?php require __DIR__ . '/../footer.php'; ?>
</body>
</html>