<?php
if (! defined('ABSPATH')){
    header("Location: /");
    exit();
}

?>

    <?php include_once PATH_VIEWS.'shared/cabecalho.php'; ?>

    <div id="conteudo">
        <?= $this->content(); ?>
    </div>

    <?php include_once PATH_VIEWS.'shared/rodape.php'; ?>