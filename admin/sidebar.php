<?php

use app\Config;
?>
<div class="sidebar p1 nao-imprimir">
    <h3 class="title"><a href="<?php echo appConfig('baseUrl'); ?>">SITE</a></h3>
    <hr>
    <p class="text-white">
        Admin: <?php echo $_SESSION['user']['nome']; ?>
        <span> - </span>
        <a href="<?php echo appUrl('/admin/logout.php'); ?>">SAIR</a>
    </p>
    <hr>
    <h3 class="title">Categorias</h3>
    <ul>
        <li><a href="?pg=categorias&action=gerenciar">Gerenciar</a></li>        
    </ul>
    <hr>
    <h3 class="title">Papel Arroz</h3>
    <ul>
        <li><a href="?pg=PapelArroz&action=adicionar">Adicionar</a></li>
        <li><a href="?pg=PapelArroz&action=listar">Listar</a></li>        
    </ul>
    <hr>
    <h3 class="title">Pedidos</h3>
    <ul>        
        <li><a href="?pg=Pedidos&action=listar">Listar</a></a></li>
        <li><a href="#">Cadastrar</a></a></li>
    </ul>
    <hr>
</div><!-- /.sidebar -->