<?php

$usuario = $this->dados->informacoes;

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

                <div id="container-errors"></div>

                <div class="card border-0">

                    <div class="card-header bg-primary">
                        <h5 class="text-uppercase m-0">Alterar Perfil</h5>
                    </div>

                    <div class="card-body border border-top-0 border-primary">

                        <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="post">

                            <div class="row">

                                <div class="col-sm-12 col-md-9 d-flex">

                                    <div class="row">

                                        <div class="col-sm-12 col-md-6">

                                            <div class="form-group form-group-lg">
                                                <label for="nome" class="font-weight-bold">Nome:</label>
                                                <input required maxlength="60" autofocus type="text" class="form-control form-control-lg" id="nome" name="nome" value="<?= $usuario->getNome() ?>">
                                            </div>

                                        </div>

                                        <div class="col-sm-12 col-md-6">

                                            <div class="form-group form-group-lg">
                                                <label for="apelido" class="font-weight-bold">Apelido:</label>
                                                <input required maxlength="20" type="text" class="form-control form-control-lg" id="apelido" name="apelido" value="<?= $usuario->getApelido() ?>">
                                            </div>

                                        </div>

                                        <div class="col-sm-12 col-md-6">

                                            <div class="form-group form-group-lg">
                                                <label for="email" class="font-weight-bold">Email:</label>
                                                <input disabled type="text" class="form-control form-control-lg" id="email" name="email" value="<?= $usuario->getEmail() ?>" title="Você não pode alterar esse campo">
                                            </div>

                                        </div>

                                        <div class="col-sm-12 col-md-6">

                                            <div class="form-group form-group-lg">
                                                <label for="usuario" class="font-weight-bold">Usuário:</label>
                                                <input disabled type="text" class="form-control form-control-lg" id="usuario" name="usuario" value="<?= $usuario->getLogin() ?>" title="Você não pode alterar esse campo">
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-sm-12 col-md-3">

                                    <div class="kv-avatar">
                                        <div class="file-loading">
                                            <input id="avatar" name="avatar" type="file" required accept=".jpeg, .png, .gif, .svg">
                                        </div>
                                    </div>

                                    <div class="kv-avatar-hint text-center">
                                        <a href="">selecionar um avatar</a>
                                    </div>

                                </div>

                                <div class="col-sm-12 text-right mt-5">
                                    <a role="button" href="<?= $_SERVER["REQUEST_URI"] ?>" class="btn btn-lg btn-link text-primary">Cancelar</a>
                                    <button type="submit" class="btn btn-success btn-lg" name="btnConfirmar">Confirmar <i class="fa fa-check"></i></button>
                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
</main>