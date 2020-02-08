<?php
header("HTTP/1.0 404 Not Found");
require appConfig('frontDir') . '/header.php';
require appConfig('frontDir') . 'menu-header.php';
?>
<h1>Pagina não encontrada</h1>
<?php
require appConfig('frontDir') . '/footer.php';
