<?php

$retorno = null;

if (!empty($this->dados->retorno))
    $retorno = $this->dados->retorno;

?>

<main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?= URL ?>">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Página</li>
    </ol>

    <div class="animated fadeIn">

        <div id="conteudo" class="container">

            <div id="container-errors">

                <?php

                if (!empty($retorno)) {

                    if (empty($retorno["status"])) {
                        ?>

                        <div class="alert alert-block alert-danger text-center">
                            <a href="javascript:void(0)" class="alert-link position-relative">
                                <i class="fas fa-thumbs-up fa-rotate-180" style="position: absolute;left: -25px;top: 5px;"></i>
                            </a>
                            <?= $retorno["mensagem"] ?>
                        </div>

                        <?php
                    } else {
                        ?>

                        <div class="alert alert-block alert-success text-center">
                            <a href="javascript:void(0)" class="alert-link position-relative"><i class="fas fa-thumbs-up" style="position: absolute;left: -25px;top: 3px;"></i></a> <?= $retorno["mensagem"] ?>
                        </div>

                        <?php
                    }

                }

                ?>

            </div>

            <div class="card border-0">

                <div class="card-header bg-primary">
                    <h5 class="text-uppercase m-0">Página</h5>
                </div>

                <div class="card-body border border-top-0 border-primary">



                </div>

            </div>

        </div>

    </div>

</main>
