<?php

// Proteje contra acesso direto ao arquivo
require __DIR__ . '/../protege-arquivo.php';

$tituloPage = 'Categorias';
require __DIR__ . '/../header.php';
require __DIR__ . '/../sidebar.php';
?>
<div class="content-page">
<h1 class="text-center">Categorias</h1>
<div class="gerenciar-categoria clearfix">
    <div class="cadastrar-editar-categoria">
        <?php require 'Categorias/editar.php'; ?>
    </div>
    <div class="lista-categorias">
        <?php require 'Categorias/listar.php'; ?>
    </div>
    
</div>
</div>
<?php require __DIR__ . '/../footer.php'; ?>
</body>
</html>