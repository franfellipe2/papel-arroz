<?php
$pageTitle = 'erro 404';
$pageUrl = null;
$pageImage = null;
$pageImageAlt = null;
$pageDescription = 'Pagina não encontrada';
$pageType = app\enumerations\SMOTypes::WEBSITE;
require appConfig('frontDir') . '/header.php';
?>
<DIV class="container text-center py-5">
    <h1>ERRO 404 <br> Pagina não encontrada!</h1>
    <p>Faça uma busca ou utilize o menu para encontrar o que você está producrando.</p>
</DIV>
<?php require appConfig('frontDir') . '/footer.php'; ?>
</body>
</html>
