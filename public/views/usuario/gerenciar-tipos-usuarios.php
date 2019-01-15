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
        <li class="breadcrumb-item active">Tipos de Usuários</li>
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

                <div class="card-header bg-primary py-3">
                    <h5 class="text-uppercase m-0">Gerenciar Tipos de Usuários</h5>
                </div>

                <div class="card-body border border-top-0 border-primary">

                    <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="post" class="form-validate" id="formTipoUsuario">

                        <div class="form-group form-group-lg">
                            <label for="nome" class="font-weight-bold">Nome do Tipo:</label>
                            <input required maxlength="20" autofocus type="text" class="form-control form-control-lg" id="nome" name="nome" title="Por favor, informe o nome do novo tipo de usuário">
                        </div>

                        <div class="form-group form-group-lg text-right mt-5">
                            <input type="hidden" name="token" value="<?= password_hash(TOKEN_SESSAO, PASSWORD_DEFAULT) ?>">
                            <a role="button" href="<?= $_SERVER["REQUEST_URI"] ?>" class="btn btn-lg active btn-link text-primary">Cancelar</a>
                            <button type="submit" class="btn btn-success active text-white btn-lg" name="btnConfirmar">Confirmar <i class="fa fa-check"></i></button>
                        </div>

                    </form>

                </div>

            </div>

            <div class="card border-0">

                <div class="card-header bg-primary py-3">
                    <h5 class="text-uppercase m-0 text-white">Tipos de Usuários Cadastrados</h5>
                </div>

                <div class="card-body p-0">

                    <div class="table-responsive">

                        <table class="table table-striped table-hover m-0">

                            <thead>

                            <tr class="bg-gray-100">

                                <td class="border-0 font-weight-bold text-uppercase text-dark">Nome</td>
                                <td class="border-0 text-center font-weight-bold text-uppercase text-dark">Criado</td>
                                <td class="border-0 text-center font-weight-bold text-uppercase text-dark">Status</td>
                                <td class="border-0 text-center font-weight-bold text-uppercase text-dark">Ação</td>

                            </tr>

                            </thead>

                            <tbody>

                            <tr>

                                <td class="font-weight-bold text-muted">Administrador</td>
                                <td class="text-center font-weight-bold text-muted">15/01/2018</td>
                                <td class="text-center font-weight-bold text-muted"></td>
                                <td class="text-center"></td>

                            </tr>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</main>
