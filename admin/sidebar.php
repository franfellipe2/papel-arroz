<?php 
use app\Config; 
?>
<div class="sidebar p1">
    <h3 class="title"><a href="<?php echo appConfig('baseUrl'); ?>">SITE</a></h3>
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
        <li><a href="#"><a href="#">Listar</a></a></li>
        <li><a href="#"><a href="#">Cadastrar</a></a></li>
    </ul>
    <hr>
</div><!-- /.sidebar -->