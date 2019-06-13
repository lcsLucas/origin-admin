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
    <li class="breadcrumb-item active">Permissões</li>
    <li class="breadcrumb-item active">Seções de Menus</li>
</ol>

<div class="animated fadeIn">

    <div id="conteudo" class="container-fluid">

        <div id="container-errors">

            <?php

            if (!empty($retorno)) {

                if (empty($retorno["status"])) {
                    ?>

                    <div class="alert alert-block alert-danger text-center">
                        <?= $retorno["mensagem"] ?>
                    </div>

                    <?php
                } else {
                    ?>

                    <div class="alert alert-block alert-success text-center">
                        <?= $retorno["mensagem"] ?>
                    </div>

                    <?php
                }

            }

            ?>

        </div>

        <div class="card border-0">

            <div class="card-header bg-primary py-3">
                <h5 class="text-uppercase m-0 text-center text-md-left">
                    <?= !empty($this->dados->editar) ? "Editar a Seção \"". $nome ."\"" : "Gerenciar Seções de Menus" ?>
                </h5>
            </div>

            <div class="card-body border border-top-0 border-primary">

                <form action="<?= $_SERVER["REQUEST_SCHEME"] . '://' . $_SERVER["SERVER_NAME"] . $_SERVER['REQUEST_URI'] ?>" method="post" class="form-validate" id="formSecaoMenus">

                    <p class="text-muted font-weight-lighter">(<span class="text-danger">*</span>) Campos obrigatórios</p>

                    <div class="form-group form-group-lg">
                        <label for="nome" class="font-weight-bold">Nome da Seção <sup class="text-danger">*</sup>:</label>
                        <input required maxlength="20" autofocus type="text" class="form-control form-control-lg" value="<?= $nome ?>" id="nome" name="nome" title="Por favor, informe o nome da seção de menus">
                    </div>

                    <div class="form-group form-group-lg text-right mt-5 mb-0">
                        <input type="hidden" name="token" value="<?= password_hash(TOKEN_SESSAO, PASSWORD_DEFAULT) ?>">
                        <a role="button" href="<?= URL ?>permissoes/gerenciar-secoes-menus" class="btn btn-lg active btn-link text-primary">Cancelar</a>
                        <button type="submit" class="btn btn-success active text-white btn-lg" name="btnConfirmar">Confirmar <i class="fa fa-check fa-fw"></i></button>
                    </div>

                </form>

            </div>

        </div>

        <div class="card border-primary">

            <div class="card-header bg-primary py-3">
                <h5 class="text-uppercase m-0 text-white text-center text-md-left">Seções de Menus Cadastrados</h5>
            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover m-0">

                        <thead>

                        <tr class="bg-gray-100">

                            <th class="border-0 font-weight-bold text-uppercase text-dark">Nome</th>
                            <th class="border-0 text-center font-weight-bold text-uppercase text-dark">Ativado</th>
                            <th class="border-0 text-center font-weight-bold text-uppercase text-dark">Ordem</th>
                            <th class="border-0 text-center font-weight-bold text-uppercase text-dark min-180">Ação</th>

                        </tr>

                        </thead>

                        <tbody class="px-2">

                        <?php

                        if (!empty($lista_registros)) {
                            foreach ($lista_registros as $i => $registro) {
                                ?>

                                <tr>
                                    <td class="font-weight-lighter lead text-muted"><?= $registro["nome"] ?></td>
                                    <td class="text-center font-weight-bold text-muted">
                                        <form action="<?= URL ?>permissoes/gerenciar-secoes-menus/alterar-status" method="post">
                                            <input type="hidden" name="codigo-acao" value="<?= $registro["idsecao_menu"] ?>">
                                            <label class="switch switch-label switch-pill switch-success switch-sm">
                                                <input class="switch-input desativar" type="checkbox"
                                                    <?= !empty($registro['ativo']) ? 'checked' : '' ?> <?= !empty($disabled) ? 'disabled' : '' ?> name="alterar-status">
                                                <span class="switch-slider" data-checked="" data-unchecked=""></span>
                                            </label>

                                        </form>

                                    </td>
                                    <td class="text-center font-weight-bold text-muted">

                                        <a href="javascript:void(0)" class="btn btn-lg btn-link <?= $i === $paginacao->total_registros-1 ? 'text-secondary disabled' : 'text-danger' ?>  p-1">
                                            <i class="fas fa-long-arrow-alt-down"></i>
                                        </a>

                                        <a href="javascript:void(0)" class="btn btn-lg btn-link <?= $i === 0 ? 'text-secondary disabled' : 'text-success' ?> p-1">
                                            <i class="fas fa-long-arrow-alt-up"></i>
                                        </a>

                                    </td>
                                    <td class="text-center">

                                        <a class="btn btn-primary btn-acao" title="Editar"
                                           href="<?= URL . 'permissoes/gerenciar-secoes-menus/edit/' . $registro['idsecao_menu'] ?>">

                                            <i class="material-icons">edit</i>

                                        </a>

                                        <form class="d-inline" action="<?= URL ?>permissoes/gerenciar-secoes-menus/deletar" method="post">
                                            <input type="hidden" name="codigo-acao" value="<?= $registro["idsecao_menu"] ?>">
                                            <input type="hidden" name="token" value="<?= password_hash(TOKEN_SESSAO, PASSWORD_DEFAULT) ?>">
                                            <button type="button" class="btn btn-danger btn-acao"
                                                    title="Excluir Seção de Menu" >

                                                <i class="material-icons">close</i>

                                            </button>

                                        </form>

                                    </td>
                                </tr>

                        <?php
                            }
                        } else {
                            echo '<tr><td class="text-center text-muted" colspan="4">Nenhuma seção de menu cadastrada</td></tr>';
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
