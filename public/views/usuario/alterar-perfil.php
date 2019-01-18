<?php

$retorno = null;
$usuario = $this->dados->informacoes;

if (!empty($this->dados->retorno))
    $retorno = $this->dados->retorno;

?>

    <!-- Breadcrumb-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?= URL ?>">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Meu Perfil</li>
    </ol>

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
                                <a href="javascript:void(0)" class="alert-link">ATENÇÃO!</a> <?= $retorno["mensagem"] ?>
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

                            <div class="form-group form-group-lg">
                                <label for="nome" class="font-weight-bold">Nome:</label>
                                <input required maxlength="60" autofocus type="text" class="form-control form-control-lg" id="nome" name="nome" value="<?= $usuario->getNome() ?>" title="Por favor, informe seu nome">
                            </div>

                            <div class="form-group form-group-lg">
                                <label for="apelido" class="font-weight-bold">Apelido:</label>
                                <input maxlength="20" type="text" class="form-control form-control-lg" id="apelido" name="apelido" value="<?= $usuario->getApelido() ?>" title="Por favor, informe um apelido">
                            </div>

                            <div class="form-group form-group-lg">
                                <label for="email" class="font-weight-bold">Email:</label>
                                <input disabled type="text" class="form-control form-control-lg" id="email" name="email" value="<?= $usuario->getEmail() ?>" title="Você não pode alterar esse campo">
                            </div>

                            <div class="form-group form-group-lg">
                                <label for="usuario" class="font-weight-bold">Usuário:</label>
                                <input disabled type="text" class="form-control form-control-lg" id="usuario" name="usuario" value="<?= $usuario->getLogin() ?>" title="Você não pode alterar esse campo">
                            </div>

                            <div class="form-group">

                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Enviar Foto</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Escolher um Avatar</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                        <div class="form-group">

                                            <div class="kv-avatar">
                                                <div class="file-loading">
                                                    <input id="avatar" name="avatar" type="file" accept="image/jpeg, image/png, image/gif" <?= is_file(PATH_IMG . "usuarios/" . $usuario->getImgAvatar()) ? "data-avatar='". URL_IMG . "usuarios/" . $usuario->getImgAvatar() ."'" : "" ?> >
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                                        <div class="row">

                                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2"><img src="<?= URL_IMG . "avatars/avatars/avatar1.svg" ?>" alt=""></div>
                                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2"><img src="<?= URL_IMG . "avatars/avatars/avatar2.svg" ?>" alt=""></div>
                                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2"><img src="<?= URL_IMG . "avatars/avatars/avatar3.svg" ?>" alt=""></div>
                                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2"><img src="<?= URL_IMG . "avatars/avatars/avatar4.svg" ?>" alt=""></div>
                                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2"><img src="<?= URL_IMG . "avatars/avatars/avatar5.svg" ?>" alt=""></div>
                                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2"><img src="<?= URL_IMG . "avatars/avatars/avatar6.svg" ?>" alt=""></div>
                                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2"><img src="<?= URL_IMG . "avatars/avatars/avatar7.svg" ?>" alt=""></div>
                                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2"><img src="<?= URL_IMG . "avatars/avatars/avatar8.svg" ?>" alt=""></div>
                                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2"><img src="<?= URL_IMG . "avatars/avatars/avatar9.svg" ?>" alt=""></div>
                                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2"><img src="<?= URL_IMG . "avatars/avatars/avatar10.svg" ?>" alt=""></div>
                                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2"><img src="<?= URL_IMG . "avatars/avatars/avatar11.svg" ?>" alt=""></div>
                                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2"><img src="<?= URL_IMG . "avatars/avatars/avatar12.svg" ?>" alt=""></div>
                                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2"><img src="<?= URL_IMG . "avatars/avatars/avatar13.svg" ?>" alt=""></div>
                                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2"><img src="<?= URL_IMG . "avatars/avatars/avatar14.svg" ?>" alt=""></div>
                                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2"><img src="<?= URL_IMG . "avatars/avatars/avatar15.svg" ?>" alt=""></div>
                                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2"><img src="<?= URL_IMG . "avatars/avatars/avatar16.svg" ?>" alt=""></div>
                                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2"><img src="<?= URL_IMG . "avatars/avatars/avatar17.svg" ?>" alt=""></div>
                                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2"><img src="<?= URL_IMG . "avatars/avatars/avatar18.svg" ?>" alt=""></div>

                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="form-group text-right mt-4">
                                <input type="hidden" name="token" value="<?= password_hash(TOKEN_SESSAO, PASSWORD_DEFAULT) ?>">
                                <a role="button" href="<?= $_SERVER["REQUEST_URI"] ?>" class="btn btn-lg active btn-link text-primary">Cancelar</a>
                                <button type="submit" class="btn btn-success active text-white btn-lg" name="btnConfirmar">Confirmar <i class="fa fa-check"></i></button>
                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>