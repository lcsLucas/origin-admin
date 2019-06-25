<?php

	$retorno = null;

	include_once ABSPATH . "app/funcoesGlobais/paginacao.php";

	if (!empty($this->dados->retorno))
		$retorno = $this->dados->retorno;

	$parametros = !empty($this->dados->parametros) ? $this->dados->parametros : array();

	$lista_registros = $this->dados->registros;
	$paginacao = $this->dados->paginacao;

	$query_uri = '';

	if (!empty($_SERVER["QUERY_STRING"]))
		$query_uri .= "?" . $_SERVER["QUERY_STRING"];

?>

<!-- Breadcrumb-->
<ol class="breadcrumb">
	<li class="breadcrumb-item">
		<a href="<?= URL ?>">Dashboard</a>
	</li>
	<li class="breadcrumb-item active">Permissões</li>
	<li class="breadcrumb-item active">Menus</li>
</ol>

<div class="animated fadeIn">

	<div id="conteudo" class="container-fluid">

		<?php include_once PATH_VIEWS . 'shared/mensagens-retorno.php' ?>

		<div class="card border-0">

			<div class="card-header bg-primary py-3">
				<h5 class="text-uppercase m-0 text-center text-md-left">
					<?= !empty($this->dados->editar) ? "Editar o Menu \"" . $parametros["param_nome"] . "\"" : "Gerenciar Menus" ?>
				</h5>
			</div>

			<div class="card-body border border-top-0 border-primary">

				<form action="<?= !empty($this->dados->editar) ? URL . 'permissoes/gerenciar-menus/edit/' . $parametros['param_id'] . $query_uri : URL . 'permissoes/gerenciar-menus' . $query_uri ?>"
					  method="post" class="form-validate" id="formMenus">

					<p class="text-muted font-weight-lighter">(<span class="text-danger">*</span>) Campos obrigatórios</p>

                    <div class="row clearfix">

                        <div class="col-xs-12 col-md-6">

                            <div class="form-group form-group-lg">
                                <label for="nome" class="font-weight-bold">Nome do Menu <sup
                                            class="text-danger">*</sup>:</label>
                                <input required maxlength="40" autofocus type="text" class="form-control form-control-lg"
                                       value="<?= !empty($parametros["param_nome"]) ? $parametros["param_nome"] : '' ?>"
                                       id="nome" name="nome" title="Por favor, informe o nome do menu">
                            </div>

                        </div>

                        <div class="col-xs-12 col-md-6">

                            <div class="form-group form-group-lg">
                                <label for="url" class="font-weight-bold">URL do Menu <sup
                                            class="text-danger">*</sup>:</label>
                                <input required maxlength="255" type="text" class="form-control form-control-lg"
                                       value="<?= !empty($parametros['param_url']) ? $parametros['param_url'] : '' ?>"
                                       id="url" name="url" title="Por favor, informe a url do menu">
                            </div>

                        </div>

                        <div class="col-12 col-md-6">

                            <div class="form-group form-group-lg">
                                <label for="sel_secao" class="font-weight-bold">Seção de Menu <sup class="text-muted font-weight-normal">(opcional)</sup>:</label>
                                <select tabindex="3" title="Por favor, selecione o tipo do novo usuário"
                                        name="sel_secao" id="sel_secao" class="form-control form-control-lg">

                                    <option value="">Selecione um tipo</option>

									<?php

										if (!empty($this->dados->todasSecoes)) {
											foreach ($this->dados->todasSecoes as $sec) {
												?>
                                                <option value="<?= $sec['idsecao_menu'] ?>"><?= $sec['nome'] ?></option>
												<?php
											}
										}

									?>

                                </select>
                            </div>

                        </div>

                        <div class="col-xs-12 col-md-6">

                            <div class="form-group form-group-lg">
                                <label for="icone" class="font-weight-bold">
                                    Ícone do Menu
                                    <sup class="text-muted font-weight-normal"><a target="_blank" rel="noopener" href="https://fontawesome.com/icons"><i class="fas fa-external-link-alt"></i></a> (opcional)</sup>:
                                </label>
                                <input maxlength="60" type="text" class="form-control form-control-lg"
                                       value="<?= !empty($parametros['param_icone']) ? $parametros['param_icone'] : '' ?>"
                                       id="icone" name="icone" title="Por favor, informe o ícone do menu">
                            </div>

                        </div>

                    </div>

					<div class="form-group form-group-lg text-right mt-5 mb-0">
						<input type="hidden" name="token" value="<?= password_hash(TOKEN_SESSAO, PASSWORD_DEFAULT) ?>">
						<a role="button" href="<?= URL ?>permissoes/gerenciar-secoes-menus"
						   class="btn btn-lg active btn-link text-primary">Cancelar</a>
						<button type="submit" class="btn btn-success active text-white btn-lg" name="btnConfirmar">
							Confirmar <i class="fa fa-check fa-fw"></i></button>
					</div>

				</form>

			</div>

		</div>

	</div>

</div>