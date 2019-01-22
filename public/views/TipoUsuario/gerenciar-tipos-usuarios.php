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
        <li class="breadcrumb-item active">Tipos de usuários</li>
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
                    <h5 class="text-uppercase m-0 text-center text-md-left">
                        <?= !empty($this->dados->editar) ? "Editar o Tipo de Usuários \"". $nome ."\"" : "Gerenciar Tipos de Usuários" ?>
                    </h5>
                </div>

                <div class="card-body border border-top-0 <?= !empty($this->dados->editar) ? "border-danger" : "border-primary" ?>">

                    <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="post" class="form-validate" id="formTipoUsuario">

                        <div class="form-group form-group-lg">
                            <label for="nome" class="font-weight-bold">Tipo de usuários:</label>
                            <input required maxlength="20" autofocus type="text" class="form-control form-control-lg" value="<?= $nome ?>" id="nome" name="nome" title="Por favor, informe o nome do novo tipo de usuário">
                        </div>

                        <div class="form-group form-group-lg text-right mt-5">
                            <input type="hidden" name="token" value="<?= password_hash(TOKEN_SESSAO, PASSWORD_DEFAULT) ?>">
                            <a role="button" href="<?= URL ?>usuarios/gerenciar-tipos-usuarios" class="btn btn-lg active btn-link text-primary">Cancelar</a>
                            <button type="submit" class="btn <?= !empty($this->dados->editar) ? "btn-danger" : "btn-success" ?> active text-white btn-lg" name="btnConfirmar">Confirmar <i class="fa fa-check"></i></button>
                        </div>

                    </form>

                </div>

            </div>

            <div class="card border-primary">

                <div class="card-header bg-primary py-3">
                    <h5 class="text-uppercase m-0 text-white text-center text-md-left">Tipos de Usuários Cadastrados</h5>
                </div>

                <div class="card-body p-0">

                    <div class="table-responsive">

                        <table class="table table-hover m-0">

                            <thead>

                            <tr class="bg-gray-100">

                                <th class="border-0 font-weight-bold text-uppercase text-dark">Nome</th>
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

                                    if (!empty($registro["tip_administrador"])) {
                                        $title_desativar = "Você não pode desativar o tipo de usuários Administrador";
                                        $title_excluir = "Você não pode excluir o tipo de usuários Administrador";
                                        $disabled = true;
                                    } elseif (intval($this->dados->tipo_usuario) === intval($registro["tip_id"])) {
                                        $title_desativar = "Você não pode desativar seu tipo de usuários";
                                        $title_excluir = "Você não pode excluir seu tipo de usuários";
                                        $disabled = true;
                                    }

                                    ?>

                                    <tr>

                                        <td class="font-weight-bold text-muted"><?= $registro["tip_nome"] ?></td>
                                        <td class="text-center font-weight-bold text-muted"><?= date("d/m/Y", strtotime($registro["tip_dtcad"])) ?></td>
                                        <td class="text-center font-weight-bold text-muted">
                                            <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="post">

                                                <label class="switch switch-label switch-pill switch-success switch-sm"
                                                       title="<?= $title_desativar ?>">
                                                    <input class="switch-input desativar-tipo-usuarios" type="checkbox"
                                                           checked="" <?= !empty($disabled) ? "disabled" : "" ?> name="alterar-status">
                                                    <span class="switch-slider" data-checked="" data-unchecked=""></span>
                                                </label>

                                            </form>

                                        </td>
                                        <td class="text-center">

                                            <?php

                                            $url_editar = URL . "usuarios/gerenciar-tipos-usuarios/edit/" . $registro["tip_id"];

                                            if (!empty($_SERVER["QUERY_STRING"]))
                                                $url_editar .= "?" . $_SERVER["QUERY_STRING"];

                                            ?>

                                            <a class="btn btn-primary btn-acao" title="Editar"
                                               href="<?= $url_editar ?>">

                                                <i class="material-icons">edit</i>

                                            </a>

                                            <button class="btn btn-danger btn-acao"
                                                    title="<?= $title_excluir ?>" <?= !empty($disabled) ? "disabled" : "" ?> >

                                                <i class="material-icons">close</i>

                                            </button>

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