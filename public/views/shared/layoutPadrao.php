<?php
if (! defined('ABSPATH')){
    header("Location: /");
    exit();
}
?>
<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8" />
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta name="author" content="Lucas S. Rosa (lucas.tarta@hotmail.com)">

        <title><?= $this->dados->title; ?></title>

        <?php include_once PATH_VIEWS.'shared/carrega_styles.php'; ?>
        <?= $this->renderCss(); //renderiza o css incorporado da pagina ?>
    </head>
    <body>
        <div class="car"></div>
        <div style="display:none" id="div-geral">
            <?php include_once PATH_VIEWS.'shared/cabecalho.php'; ?>

            <!-- Carrega conteudo -->
            <section id="conteudo" class="container-fluid">
                <?= $this->content(); ?>
            </section>

            <?php include_once PATH_VIEWS.'shared/rodape.php'; ?>
        </div>

        <?php include_once PATH_VIEWS.'shared/carrega_scripts.php'; ?>
        <?= $this->renderJs(); //renderiza o js incorporado da pagina?>
    </body>
</html>