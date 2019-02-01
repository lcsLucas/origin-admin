<?php

$retorno = null;

include_once ABSPATH . "app/funcoesGlobais/paginacao.php";

if (!empty($this->dados->retorno))
    $retorno = $this->dados->retorno;

$todos_tipos = !empty($this->dados->todosTipos) ? $this->dados->todosTipos : array();
$parametros = !empty($this->dados->parametros) ? $this->dados->parametros : array();

$lista_registros = $this->dados->registros;

$paginacao = $this->dados->paginacao;

$this->dados->alert = true;
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

            <div class="card-header <?= !empty($this->dados->editar) ? "bg-danger" : "bg-primary" ?> py-3">
                <h5 class="text-uppercase m-0">
                    <?= !empty($this->dados->editar) ? "Editar o usuário \"". $parametros["param_nome"] ."\"" : "Gerenciar Usuários" ?>
                </h5>
            </div>

            <div class="card-body border border-top-0 <?= !empty($this->dados->editar) ? "border-danger" : "border-primary" ?>">

                <form action="<?= $_SERVER["REQUEST_SCHEME"] . '://' . $_SERVER["SERVER_NAME"] . $_SERVER['REQUEST_URI'] ?>" method="post" class="form-validate" id="formUsuario">

                    <div class="row clearfix">

                        <div class="col-12 col-md-6">

                            <div class="form-group form-group-lg">
                                <label for="nome" class="font-weight-bold">Nome do usuário:</label>
                                <input required maxlength="60" autofocus tabindex="1" type="text" class="form-control form-control-lg" value="<?= !empty($parametros["param_nome"]) ? $parametros["param_nome"] : ""  ?>" id="nome" name="nome" title="Por favor, informe o nome do novo usuário">
                            </div>

                        </div>

                        <div class="col-12 col-md-6">

                            <div class="form-group form-group-lg">
                                <label for="email" class="font-weight-bold">Email do usuário:</label>
                                <input required maxlength="60" type="email" <?= !empty($this->dados->editar) ? "disabled" : "" ?> tabindex="2" class="form-control form-control-lg" id="email" name="email" value="<?= !empty($parametros["param_email"]) ? $parametros["param_email"] : ""  ?>"  title="<?= !empty($this->dados->editar) ? "Você não pode alterar o email do usuário" : "Por favor, informe um email válido para o usuário" ?>">
                            </div>

                        </div>

                        <div class="col-12 col-md-6">

                            <div class="form-group form-group-lg">
                                <label for="sel_tipo" class="font-weight-bold">Tipo de usuário:</label>
                                <select required tabindex="3" title="Por favor, selecione o tipo do novo usuário" name="sel_tipo" id="sel_tipo" class="form-control form-control-lg">

                                    <option value="">Selecione um tipo</option>

                                    <?php

                                    if (!empty($todos_tipos)) {
                                        foreach ($todos_tipos as $tipo) {
                                            if (!(intval($this->dados->tipo_usuario) !== 1 && intval($tipo['tip_id']) === 1)) {
                                                ?>
                                                <option <?= (!empty($parametros["param_tipo"]) && intval($parametros["param_tipo"]) === intval($tipo['tip_id'])) ? "selected" : "" ?>
                                                        value="<?= $tipo['tip_id'] ?>"><?= $tipo['tip_nome'] ?></option>
                                                <?php
                                            }
                                        }
                                    }

                                    ?>

                                </select>
                            </div>

                        </div>

                        <div class="col-12 col-md-6">

                            <div class="form-group form-group-lg">
                                <label for="usuario" class="font-weight-bold">Login do usuário:</label>
                                <input required maxlength="15" <?= !empty($this->dados->editar) ? "disabled" : "" ?> tabindex="4" type="text" class="form-control form-control-lg" id="usuario" name="usuario" value="<?= !empty($parametros["param_usuario"]) ? $parametros["param_usuario"] : ""  ?>" title="<?= !empty($this->dados->editar) ? "Você não pode alterar o login do usuário" : "Por favor, informe um login para o usuário" ?>">
                            </div>

                        </div>

                        <div class="col-12 col-md-6">

                            <div class="form-group form-group-lg">
                                <label for="senha_nova" class="font-weight-bold">Senha do usuário:</label>
                                <div class="input-group">
                                    <input required maxlength="30" tabindex="5" type="password" class="form-control form-control-lg b-r-0" id="senha_nova" name="senha_nova" title="Por favor, informe a senha do usuário">
                                    <div class="input-group-append b-l-0">
                                    <span class="input-group-text bg-white" >
                                        <a href="javascript:void(0)" onclick="exibiSenha(this)"><i class="fa fa-eye-slash text-muted"></i></a>
                                    </span>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-12 col-md-6">

                            <div class="form-group form-group-lg">
                                <label for="senha_nova2" class="font-weight-bold">Repita a senha:</label>
                                <div class="input-group">
                                    <input required maxlength="30" tabindex="6" type="password" class="form-control form-control-lg b-r-0" id="senha_nova2" name="senha_nova2" title="Por favor, repita a senha do usuário">
                                    <div class="input-group-append b-l-0">
                                    <span class="input-group-text bg-white" >
                                        <a href="javascript:void(0)" onclick="exibiSenha(this)"><i class="fa fa-eye-slash text-muted"></i></a>
                                    </span>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-12">

                            <div class="form-group form-group-lg text-right mt-5 mb-0">
                                <input type="hidden" name="token" value="<?= password_hash(TOKEN_SESSAO, PASSWORD_DEFAULT) ?>">
                                <a role="button" tabindex="8" href="<?= URL ?>usuarios/gerenciar-usuarios" class="btn btn-lg active btn-link text-primary">Cancelar</a>
                                <button tabindex="7" type="submit" class="btn <?= !empty($this->dados->editar) ? "btn-danger" : "btn-success" ?> active text-white btn-lg" name="btnConfirmar">Confirmar <i class="fa fa-check"></i></button>
                            </div>

                        </div>

                    </div>

                </form>

            </div>

        </div>

        <div class="card border-primary">

            <div class="card-header bg-primary py-3">
                <h5 class="text-uppercase m-0 text-white text-center text-md-left">Usuários Cadastrados</h5>
            </div>

            <div class="card-body p-0">

                <form>

                    <div class="d-flex align-items-center" style="max-width: 500px;margin-left: auto;margin-right: 30px;">

                        <label style="min-width: 70px;" class="font-weight-bold m-0 text-muted mr-1">Pesquisar:</label>

                        <div class="input-group my-4">
                            <div class="input-group-prepend">

                                <select style="border-top-right-radius: 0; border-bottom-right-radius: 0" name="sel_busca" id="sel-busca" class="form-control">

                                    <option value="1">Nome</option>
                                    <option value="2">Email</option>
                                    <option value="3">Login</option>

                                </select>

                            </div>
                            <input type="text" class="form-control border-right-0" aria-label="Text input with dropdown button">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary border-left-0" type="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>

                    </div>

                </form>

                <div class="table-responsive">

                    <table class="table table-hover m-0">

                        <thead>

                        <tr class="bg-gray-100">

                            <th class="border-0 font-weight-bold text-uppercase text-dark">Nome</th>
                            <th class="border-0 font-weight-bold text-uppercase text-dark">Tipo</th>
                            <th class="border-0 text-center font-weight-bold text-uppercase text-dark">Criado</th>
                            <th class="border-0 text-center font-weight-bold text-uppercase text-dark">Ativado</th>
                            <th class="border-0 text-center font-weight-bold text-uppercase text-dark min-180">Ação</th>

                        </tr>

                        </thead>

                        <tbody class="px-2">

                        <?php

                            if (!empty($lista_registros)) {
                                foreach ($lista_registros as $registro) {
                                    $disabled = false;
                                    $title_disabled = '';

                                    if (!empty($registro["tip_administrador"]) && empty($this->dados->tipo_usuario)) {
                                        $disabled = true;
                                    } elseif (intval($this->dados->tipo_usuario) === intval($registro["tip_id"])) {
                                        $disabled = true;
                                    }

                                    ?>

                                    <tr>

                                        <td class="font-weight-bold text-muted"><?= $registro["usu_nome"] ?></td>
                                        <td class="font-weight-bold text-muted"><?= $registro["tip_nome"] ?></td>
                                        <td class="text-center font-weight-bold text-muted"><?= date("d/m/Y", strtotime($registro["usu_dtCad"])) ?></td>
                                        <td class="text-center font-weight-bold text-muted">
                                            <form action="<?= URL ?>usuarios/gerenciar-usuarios/alterar-status" method="post">
                                                <input type="hidden" name="codigo-acao" value="<?= $registro["usu_id"] ?>">
                                                <label class="switch switch-label switch-pill switch-success switch-sm">
                                                    <input class="switch-input desativar-usuarios" type="checkbox"
                                                        <?= !empty($registro["usu_ativo"]) ? "checked" : "" ?> <?= ($disabled) ? 'disabled' : '' ?> name="alterar-status">
                                                    <span class="switch-slider" data-checked="" data-unchecked=""></span>
                                                </label>
                                            </form>
                                        </td>

                                        <td class="text-center">

                                            <?php

                                            $url_editar = URL . "usuarios/gerenciar-usuarios/edit/" . $registro["usu_id"];

                                            if (!empty($_SERVER["QUERY_STRING"]))
                                                $url_editar .= "?" . $_SERVER["QUERY_STRING"];

                                            ?>

                                            <a class="btn btn-primary btn-acao" title="Editar"
                                               href="<?= $url_editar ?>">

                                                <i class="material-icons">edit</i>

                                            </a>

                                            <form class="d-inline" action="<?= URL ?>usuarios/gerenciar-usuarios/deletar" method="post">
                                                <input type="hidden" name="codigo-acao" value="<?= $registro["usu_id"] ?>">
                                                <input type="hidden" name="token" value="<?= password_hash(TOKEN_SESSAO, PASSWORD_DEFAULT) ?>">
                                                <button type="button" class="btn btn-danger btn-acao deletar-usuario"
                                                        title="" >

                                                    <i class="material-icons">close</i>

                                                </button>
                                            </form>

                                        </td>

                                    </tr>

                                    <?php

                                }
                            }

                            ?>

                        </tbody>

                    </table>

                </div>

                <?php
                paginacao($paginacao->total_registros,$paginacao->registros_paginas,$paginacao->pagina_atual,$paginacao->range_paginas)
                ?>

            </div>

        </div>

    </div>

</div>