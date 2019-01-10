<?php

$retorno = null;
$usuario = $this->dados->informacoes;

if (!empty($this->dados->retorno))
    $retorno = $this->dados->retorno;

?>

<main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?= URL ?>">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Meu Perfil</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">

            <div id="conteudo" class="container">

                <div id="container-errors">

                    <div id="erro-file-input"></div>

                    <?php

                    if (!empty($retorno)) {

                        if (empty($retorno["status"])) {
                            ?>

                            <div class="alert alert-block alert-danger text-center">
                                <a href="javascript:void(0)" class="alert-link">ATENÇÃO!</a> <?= $retorno["mensagem"] ?>
                            </div>

                            <?php
                        } else {
                            ?>

                            <div class="alert alert-block alert-success text-center">
                                <a href="javascript:void(0)" class="alert-link">SUCESSO!</a> <?= $retorno["mensagem"] ?>
                            </div>

                            <?php
                        }

                    }

                    ?>

                </div>

                <div class="card border-0">

                    <div class="card-header bg-primary">
                        <h5 class="text-uppercase m-0">Alterar Perfil</h5>
                    </div>

                    <div class="card-body border border-top-0 border-primary">

                        <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="post" class="form-validate" enctype="multipart/form-data" id="formAlterarPerfil">

                            <div class="row">

                                <div class="col-sm-12 col-md-9 d-flex">

                                    <div class="row">

                                        <div class="col-sm-12 col-md-6">

                                            <div class="form-group form-group-lg m-0">
                                                <label for="nome" class="font-weight-bold">Nome:</label>
                                                <input required maxlength="60" autofocus type="text" class="form-control form-control-lg" id="nome" name="nome" value="<?= $usuario->getNome() ?>" title="Por favor, informe seu nome">
                                            </div>

                                        </div>

                                        <div class="col-sm-12 col-md-6">

                                            <div class="form-group form-group-lg m-0">
                                                <label for="apelido" class="font-weight-bold">Apelido:</label>
                                                <input maxlength="20" type="text" class="form-control form-control-lg" id="apelido" name="apelido" value="<?= $usuario->getApelido() ?>" title="Por favor, informe um apelido">
                                            </div>

                                        </div>

                                        <div class="col-sm-12 col-md-6">

                                            <div class="form-group form-group-lg m-0">
                                                <label for="email" class="font-weight-bold">Email:</label>
                                                <input disabled type="text" class="form-control form-control-lg" id="email" name="email" value="<?= $usuario->getEmail() ?>" title="Você não pode alterar esse campo">
                                            </div>

                                        </div>

                                        <div class="col-sm-12 col-md-6">

                                            <div class="form-group form-group-lg m-0">
                                                <label for="usuario" class="font-weight-bold">Usuário:</label>
                                                <input disabled type="text" class="form-control form-control-lg" id="usuario" name="usuario" value="<?= $usuario->getLogin() ?>" title="Você não pode alterar esse campo">
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-sm-12 col-md-3">

                                    <div class="form-group">

                                        <div class="kv-avatar">
                                            <div class="file-loading">
                                                <input id="avatar" name="avatar" type="file" accept="image/jpeg, image/png, image/gif">
                                            </div>
                                        </div>

                                        <div class="kv-avatar-hint text-center">
                                            <a href="">selecionar um avatar</a>
                                        </div>

                                    </div>

                                </div>

                                <div class="col-sm-12 text-right mt-5">
                                    <input type="hidden" name="token" value="<?= password_hash(TOKEN_SESSAO, PASSWORD_DEFAULT) ?>">
                                    <a role="button" href="<?= $_SERVER["REQUEST_URI"] ?>" class="btn btn-lg btn-link text-primary">Cancelar</a>
                                    <button type="submit" class="btn btn-success text-white btn-lg" name="btnConfirmar">Confirmar <i class="fa fa-check"></i></button>
                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
</main>