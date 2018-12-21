<?php
if (! defined('ABSPATH')){
    header("Location: /");
    exit();
}

?>

    <?php include_once PATH_VIEWS.'shared/cabecalho.php'; ?>

    <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item">
                <a href="#">Admin</a>
            </li>
            <li class="breadcrumb-item active">Dashboard</li>
            <!-- Breadcrumb Menu-->
            <li class="breadcrumb-menu d-md-down-none">
                <div class="btn-group" role="group" aria-label="Button group">
                    <a class="btn" href="#">
                        <i class="icon-speech"></i>
                    </a>
                    <a class="btn" href="./">
                        <i class="icon-graph"></i>  Dashboard</a>
                    <a class="btn" href="#">
                        <i class="icon-settings"></i>  Settings</a>
                </div>
            </li>
        </ol>
        <div class="container-fluid">
        <div class="animated fadeIn"></div>

            <div id="conteudo">
                <?= $this->content(); ?>
            </div>

        </div>
    </main>

    <?php include_once PATH_VIEWS.'shared/rodape.php'; ?>