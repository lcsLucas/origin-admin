<?php

$retorno = null;

if (!empty($this->dados->retorno))
    $retorno = $this->dados->retorno;

$nome = !empty($this->dados->nome) ? $this->dados->nome : "";

?>

<!-- Breadcrumb-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?= URL ?>">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Usuários</li>
    <li class="breadcrumb-item active">Gerenciar Usuários</li>
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
                <h5 class="text-uppercase m-0">Gerenciar Usuários</h5>
            </div>

            <div class="card-body border border-top-0 border-primary">

                <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="post" class="form-validate" id="formTipoUsuario">

                    <div class="row clearfix">

                        <div class="col-12 col-md-6">

                            <div class="form-group form-group-lg">
                                <label for="nome" class="font-weight-bold">Nome do usuário:</label>
                                <input required maxlength="60" autofocus type="text" class="form-control form-control-lg" value="<?= $nome ?>" id="nome" name="nome" title="Por favor, informe o nome do novo usuário">
                            </div>

                        </div>

                        <div class="col-12 col-md-6">

                            <div class="form-group form-group-lg">
                                <label for="email" class="font-weight-bold">Email do usuário:</label>
                                <input required maxlength="60" type="email" class="form-control form-control-lg" id="email" name="email" value="" title="Por favor, informe o email do novo usuário">
                            </div>

                        </div>

                        <div class="col-12">

                            <div class="form-group form-group-lg">
                                <label for="sel_tipo" class="font-weight-bold">Tipo do Usuário:</label>
                                <select required title="Por favor, selecione o tipo do novo usuário" name="sel_tipo" id="sel_tipo" class="form-control form-control-lg">

                                    <option value="">Selecione um tipo</option>
                                    <option value="1">Administrador</option>
                                    <option value="2">Básico</option>

                                </select>
                            </div>

                        </div>

                        <div class="col-12 col-md-6">

                            <div class="form-group form-group-lg">
                                <label for="usuario" class="font-weight-bold">Usuário:</label>
                                <input required maxlength="15" type="text" class="form-control form-control-lg" id="usuario" name="usuario" value="" title="Por favor, informe um usuário">
                            </div>

                        </div>

                        <div class="col-12 col-md-6">

                            <div class="form-group form-group-lg">
                                <label for="senha" class="font-weight-bold">Senha do usuário:</label>
                                <input required maxlength="30" type="password" class="form-control form-control-lg" id="senha" name="senha" value="" title="Por favor, informe a senha do novo usuário">
                            </div>

                        </div>

                        <div class="col-12">

                            <div class="form-group form-group-lg text-right mt-5">
                                <input type="hidden" name="token" value="<?= password_hash(TOKEN_SESSAO, PASSWORD_DEFAULT) ?>">
                                <a role="button" href="<?= URL ?>usuarios/gerenciar-tipos-usuarios" class="btn btn-lg active btn-link text-primary">Cancelar</a>
                                <button type="submit" class="btn <?= !empty($this->dados->editar) ? "btn-danger" : "btn-success" ?> active text-white btn-lg" name="btnConfirmar">Confirmar <i class="fa fa-check"></i></button>
                            </div>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>