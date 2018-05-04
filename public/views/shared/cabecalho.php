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
        <meta name="description" content="<?= !empty($this->dados->meta) ? $this->dados->meta : "" ?>">
        <meta name="author" content="Lucas S. Rosa (lucas.tarta@hotmail.com)">

        <title><?= !empty($this->dados->title) ? $this->dados->title : "" ?></title>

        <?php include_once PATH_VIEWS.'shared/carrega_styles.php'; ?>
        <?= $this->renderCss(); //renderiza o css incorporado da pagina ?>
    </head>
    <body>
        <div class="car"></div>
        <div style="display:none" id="div-geral">
            <header id="cabecalho">

            </header>