<?php

$retorno = null;

include_once ABSPATH . "app/funcoesGlobais/paginacao.php";

if (!empty($this->dados->retorno))
    $retorno = $this->dados->retorno;

$nome = !empty($this->dados->nome) ? $this->dados->nome : "";

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

        <div class="card border-primary">

            <div class="card-header bg-primary py-3">
                <h5 class="text-uppercase m-0 text-white text-center text-md-left">Usuários Cadastrados</h5>
            </div>

            <div class="card-body p-0">

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

                                    $title_desativar = "Desativar esse tipo de usuários";
                                    $title_excluir = "Excluir esse tipo de usuários";
                                    $disabled = false;
                                    $editar_adm = false;

                                    if (!empty($registro["tip_administrador"])) {
                                        $title_desativar = "Você não pode desativar o tipo de usuários Administrador";
                                        $title_excluir = "Você não pode excluir o tipo de usuários Administrador";
                                        $disabled = true;

                                        if (intval($this->dados->tipo_usuario) === intval($registro["tip_id"]))
                                            $editar_adm = true;

                                    } elseif (intval($this->dados->tipo_usuario) === intval($registro["tip_id"])) {
                                        $title_desativar = "Você não pode desativar seu tipo de usuários";
                                        $title_excluir = "Você não pode excluir seu tipo de usuários";
                                        $disabled = true;
                                    }

                                    ?>

                                    <tr>

                                        <td class="font-weight-bold text-muted"><?= $registro["usu_nome"] ?></td>
                                        <td class="font-weight-bold text-muted"><?= $registro["tip_nome"] ?></td>
                                        <td class="text-center font-weight-bold text-muted"><?= date("d/m/Y", strtotime($registro["usu_dtCad"])) ?></td>
                                        <td class="text-center font-weight-bold text-muted">
                                            <form action="<?= URL ?>usuarios/gerenciar-tipos-usuarios/alterar-status" method="post">
                                                <input type="hidden" name="codigo-acao" value="<?= $registro["usu_id"] ?>">
                                                <label class="switch switch-label switch-pill switch-success switch-sm"
                                                       title="<?= $title_desativar ?>">
                                                    <input class="switch-input desativar-tipo-usuarios" type="checkbox"
                                                        <?= !empty($registro["usu_ativo"]) ? "checked" : "" ?> <?= !empty($disabled) ? "disabled" : "" ?> name="alterar-status">
                                                    <span class="switch-slider" data-checked="" data-unchecked=""></span>
                                                </label>

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