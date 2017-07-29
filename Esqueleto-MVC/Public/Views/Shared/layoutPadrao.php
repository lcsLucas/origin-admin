<?php
if (! defined('ABSPATH')){
    header("Location: /");
    exit();
}
?>
<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
    	<meta charset="UTF-8" />
        <title><?= $this->view->title; ?></title>
        <?php include_once PATH_VIEWS.'Shared/carrega_styles.php'; ?>
        <?= $this->renderCss(); ?>
    </head>
    <body style="display:none">
        <!-- Carrega conteudo -->
        <section id="conteudo" class="container-fluid">
            <?php include_once PATH_VIEWS.'Shared/cabecalho.php'; ?>

        	<?=	$this->content(); ?>
    	</section>

        <?php include_once PATH_VIEWS.'Shared/rodape.php'; ?>
        <?php include_once PATH_VIEWS.'Shared/carrega_scripts.php'; ?>
        <?= $this->renderJs(); ?>
    </body>
</html>