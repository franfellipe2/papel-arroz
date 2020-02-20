<?php if ($categoria->getMsgError()) { ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $categoria->getMsgError(); ?>
    </div>
<?php } ?>
<form name="categoria-editar" action="<?php echo $formAction; ?>" method="post">
    <input type="hidden" value="<?php echo $categoria->getId();?>" name="id">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                Editar categoria  <a class="btn btn-sm btn-secondary float-right" href="<?php echo $this->pageAction('gerenciar'); ?>">Nova</a>
            </h5>
            
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>Nome</label>
                <input name='nome' type="text" class="form-control <?php if (!empty($erros['nome'])) echo 'is-invalid'; ?>" value="<?php echo $categoria->getNome(); ?>">

                <div class="invalid-feedback">
                    <?php if (!empty($erros['nome'])) echo $erros['nome']; ?>
                </div>
            </div>
            <div class="form-group">
                <label>Descrição </label>
                <textarea name="descricao" class="form-control <?php if (!empty($erros['descricao'])) echo 'is-invalid'; ?>"><?php echo $categoria->getDescricao(); ?></textarea>
                <div class="invalid-feedback">
                    <?php if (!empty($erros['descricao'])) echo $erros['descricao']; ?>
                </div>
            </div>
            <div class="form-group">
                <label>Pai</label>
                <select name="cat_pai" class="form-control <?php if (!empty($erros['cat_pai'])) echo 'is-invalid'; ?>">
                    <option></option>
                    <?php
                    $cats = $categoria->listAll(false);
                    foreach ($cats as $r => $c):

                        if ($categoria->getPai() == $c['id']) {
                            ?>
                            <option value="<?php echo $c['id']; ?>" selected><?php echo $c['nome']; ?></option>
                            <?php
                        } else {
                            ?>
                            <option value="<?php echo $c['id']; ?>"><?php echo $c['nome']; ?></option>
                            <?php
                        }

                    endforeach;
                    ?>
                </select>
                <div class="invalid-feedback">
                    <?php if (!empty($erros['cat_pai'])) echo $erros['cat_pai']; ?>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" type="submit">Atualizar</button>
        </div>
    </div>
</form>