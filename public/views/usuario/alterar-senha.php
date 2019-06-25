<?php

	$retorno = null;

	if (!empty($this->dados->retorno))
		$retorno = $this->dados->retorno;

?>

<!-- Breadcrumb-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?= URL ?>">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Alterar Senha</li>
</ol>

<div class="animated fadeIn">

    <div id="conteudo" class="container-fluid">

		<?php include_once PATH_VIEWS . 'shared/mensagens-retorno.php' ?>

        <div class="card border-0">

            <div class="card-header bg-primary">
                <h5 class="text-uppercase m-0">Alterar Senha</h5>
            </div>

            <div class="card-body border border-top-0 border-primary">

                <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="post" class="form-validate" id="formAlterarSenha"
                      autocomplete="off">

                    <p class="text-muted font-weight-lighter">(<span class="text-danger">*</span>) Campos obrigatórios
                    </p>

                    <div class="form-group form-group-lg">
                        <label for="senha_atual" class="font-weight-bold">Senha Atual <sup class="text-danger">*</sup>:</label>
                        <div class="input-group focus">
                            <input autofocus tabindex="1" required maxlength="30" type="password"
                                   class="form-control form-control-lg b-r-0" id="senha_atual" name="senha_atual"
                                   title="Por favor, informe a senha atual">
                            <div class="input-group-append b-l-0">
                                    <span class="input-group-text bg-white">
                                        <a href="javascript:void(0)" onclick="exibiSenha(this)"><i
                                                    class="fa fa-eye-slash text-muted"></i></a>
                                    </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-group-lg">
                        <label for="senha_nova" class="font-weight-bold">Nova Senha <sup
                                    class="text-danger">*</sup>:</label>
                        <div class="input-group">
                            <input required tabindex="2" maxlength="30" type="password"
                                   class="form-control form-control-lg b-r-0" id="senha_nova" name="senha_nova"
                                   title="Por favor, informe a nova senha">
                            <div class="input-group-append b-l-0">
                                    <span class="input-group-text bg-white">
                                        <a href="javascript:void(0)" onclick="exibiSenha(this)"><i
                                                    class="fa fa-eye-slash text-muted"></i></a>
                                    </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-group-lg">
                        <label for="senha_nova2" class="font-weight-bold">Repita a Nova Senha <sup
                                    class="text-danger">*</sup>:</label>
                        <div class="input-group">
                            <input required maxlength="30" tabindex="3" type="password"
                                   class="form-control form-control-lg b-r-0" id="senha_nova2" name="senha_nova2"
                                   title="Por favor, repita a nova senha">
                            <div class="input-group-append b-l-0">
                                    <span class="input-group-text bg-white">
                                        <a href="javascript:void(0)" onclick="exibiSenha(this)"><i
                                                    class="fa fa-eye-slash text-muted"></i></a>
                                    </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-group-lg text-right mt-5 mb-0">
                        <input type="hidden" name="token" value="<?= password_hash(TOKEN_SESSAO, PASSWORD_DEFAULT) ?>">
                        <a role="button" href="<?= $_SERVER["REQUEST_URI"] ?>"
                           class="btn btn-lg active btn-link text-primary">Cancelar</a>
                        <button tabindex="4" type="submit" class="btn btn-success active text-white btn-lg"
                                name="btnConfirmar">Confirmar <i class="fa fa-check"></i></button>
                    </div>

                </form>

            </div>

        </div>

    </div>

</div>