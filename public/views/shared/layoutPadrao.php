<?php
if (! defined('ABSPATH')){
    header("Location: /");
    exit();
}
?>
    <?php include_once PATH_VIEWS.'shared/cabecalho.php'; ?>

    <!-- Carrega conteudo -->
    <section id="conteudo">
        <?= $this->content(); ?>
    </section>

    <?php include_once PATH_VIEWS.'shared/rodape.php'; ?>