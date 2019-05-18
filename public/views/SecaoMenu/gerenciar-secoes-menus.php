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

    <div id="conteudo" class="container">

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

                <form action="<?= $_SERVER["REQUEST_SCHEME"] . '://' . $_SERVER["SERVER_NAME"] . $_SERVER['REQUEST_URI'] ?>" method="post" class="form-validate" id="formTipoUsuario">

                    <p class="text-muted font-weight-bold">(<span class="text-danger">*</span>) Campos obrigatórios</p>

                    <div class="form-group form-group-lg">
                        <label for="nome" class="font-weight-bold">Nome da Seção <sup class="text-danger">*</sup>:</label>
                        <input required maxlength="20" autofocus type="text" class="form-control form-control-lg" value="<?= $nome ?>" id="nome" name="nome" title="Por favor, informe o nome do novo tipo de usuário">
                    </div>

                    <div class="form-group form-group-lg text-right mt-5 mb-0">
                        <input type="hidden" name="token" value="<?= password_hash(TOKEN_SESSAO, PASSWORD_DEFAULT) ?>">
                        <a role="button" href="<?= URL ?>permissoes/gerenciar-secoes-menus" class="btn btn-lg active btn-link text-primary">Cancelar</a>
                        <button type="submit" class="btn btn-success active text-white btn-lg" name="btnConfirmar">Confirmar <i class="fa fa-check fa-fw"></i></button>
                    </div>

                </form>

            </div>

        </div>

    </div>

</div>
