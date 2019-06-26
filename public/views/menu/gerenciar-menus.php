<?php

	$retorno = null;

	include_once ABSPATH . "app/funcoesGlobais/paginacao.php";

	if (!empty($this->dados->retorno))
		$retorno = $this->dados->retorno;

	$parametros = !empty($this->dados->parametros) ? $this->dados->parametros : array();

	$lista_registros = $this->dados->registros;
	$paginacao = $this->dados->paginacao;

	$query_uri = '';

	$this->dados->alert = true;

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
                                <input tabindex="1" required maxlength="40" autofocus type="text" class="form-control form-control-lg"
                                       value="<?= !empty($parametros["param_nome"]) ? $parametros["param_nome"] : '' ?>"
                                       id="nome" name="nome" title="Por favor, informe o nome do menu">
                            </div>

                        </div>

                        <div class="col-xs-12 col-md-6">

                            <div class="form-group form-group-lg">
                                <label for="url" class="font-weight-bold">URI do Menu <sup
                                            class="text-danger">*</sup>:</label>
                                <input tabindex="2" required maxlength="255" type="text" class="form-control form-control-lg"
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
                                                <option <?= !empty($parametros['param_secao']) && $parametros['param_secao'] === (int) $sec['idsecao_menu']  ? 'selected' : '' ?> value="<?= $sec['idsecao_menu'] ?>"><?= $sec['nome'] ?></option>
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
                                <input tabindex="4" maxlength="60" type="text" class="form-control form-control-lg"
                                       value="<?= !empty($parametros['param_icone']) ? $parametros['param_icone'] : '' ?>"
                                       id="icone" name="icone" title="Por favor, informe o ícone do menu">
                            </div>

                        </div>

                    </div>

					<div class="form-group form-group-lg text-right mt-5 mb-0">
						<input type="hidden" name="token" value="<?= password_hash(TOKEN_SESSAO, PASSWORD_DEFAULT) ?>">
						<a tabindex="6" role="button" href="<?= URL ?>permissoes/gerenciar-menus"
						   class="btn btn-lg active btn-link text-primary">Cancelar</a>
						<button tabindex="5" type="submit" class="btn btn-success active text-white btn-lg" name="btnConfirmar">
							Confirmar <i class="fa fa-check fa-fw"></i></button>
					</div>

				</form>

			</div>

		</div>

        <div class="card border-primary">

            <div class="card-header bg-primary py-3">
                <h5 class="text-uppercase m-0 text-white text-center text-md-left">Menus Cadastrados</h5>
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
                                            <form action="<?= URL ?>permissoes/gerenciar-menus/alterar-status"
                                                  method="post">
                                                <input type="hidden" name="codigo-acao"
                                                       value="<?= $registro["id"] ?>">
                                                <label class="switch switch-label switch-pill switch-success switch-sm">
                                                    <input class="switch-input desativar" type="checkbox"
														<?= !empty($registro['ativo']) ? 'checked' : '' ?> <?= !empty($disabled) ? 'disabled' : '' ?>
                                                           name="alterar-status">
                                                    <span class="switch-slider" data-checked=""
                                                          data-unchecked=""></span>
                                                </label>

                                            </form>

                                        </td>
                                        <td class="text-center font-weight-bold text-muted">

                                            <form action="<?= URL ?>permissoes/gerenciar-menus/alterar-ordem<?= $query_uri ?>"
                                                  method="post">
                                                <input type="hidden" name="codigo-acao"
                                                       value="<?= $registro["id"] ?>">

                                                <label class="btn btn-lg btn-link p-1 text-danger">
                                                    <input type="radio" value="1" name="ordem"
                                                           class="d-none alterar-ordem">
                                                    <i class="fas fa-long-arrow-alt-down"></i>
                                                </label>

                                                <label class="btn btn-lg btn-link p-1 text-success">
                                                    <input type="radio" value="2" name="ordem"
                                                           class="d-none alterar-ordem">
                                                    <i class="fas fa-long-arrow-alt-up"></i>
                                                </label>

                                            </form>

                                        </td>
                                        <td class="text-center">

                                            <a class="btn btn-primary btn-acao editar" title="Editar"
                                               href="<?= URL . 'permissoes/gerenciar-menus/edit/' . $registro['id'] . $query_uri ?>">
                                                <i class="fas fa-pen"></i>
                                            </a>

                                            <form class="d-inline"
                                                  action="<?= URL ?>permissoes/gerenciar-menus/deletar"
                                                  method="post">
                                                <input type="hidden" name="codigo-acao"
                                                       value="<?= $registro["id"] ?>">
                                                <input type="hidden" name="token"
                                                       value="<?= password_hash(TOKEN_SESSAO, PASSWORD_DEFAULT) ?>">
                                                <button type="button" class="btn btn-danger btn-acao deletar"
                                                        title="Excluir Seção de Menu">
                                                    <i class="fas fa-times"></i>
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
					paginacao($paginacao->total_registros, $paginacao->registros_paginas, $paginacao->pagina_atual, $paginacao->range_paginas)
				?>

            </div>

        </div>

	</div>

</div>