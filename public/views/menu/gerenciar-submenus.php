<?php
	if (! defined('ABSPATH'))
		die;

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
	<li class="breadcrumb-item active">SubMenus</li>
</ol>

<div class="animated fadeIn">

	<div id="conteudo" class="container-fluid">

		<?php include_once PATH_VIEWS . 'shared/mensagens-retorno.php' ?>

		<div class="card border-0">

			<div class="card-header bg-primary py-3">
				<h5 class="text-uppercase m-0 text-center text-md-left">
					<?= !empty($this->dados->editar) ? "SubMenu \"" . $parametros["param_nome"] . "\" <strong class='ml-1'>[Editar]</strong>" : "Gerenciar SubMenus" ?>
				</h5>
			</div>

			<div class="card-body border border-top-0 border-primary">

				<form action="<?= !empty($this->dados->editar) ? URL . 'permissoes/gerenciar-submenus/edit/' . $parametros['param_id'] . $query_uri : URL . 'permissoes/gerenciar-submenus' . $query_uri ?>"
					  method="post" class="form-validate" id="formMenus">

					<p class="text-muted font-weight-lighter">(<span class="text-danger">*</span>) Campos obrigatórios</p>

                    <div class="row clearfix">

                        <div class="col-xs-12 col-md-12">

                            <div class="form-group form-group-lg">
                                <label for="nome" class="font-weight-bold">Nome do SubMenu <sup class="text-danger">*</sup>:</label>
                                <input tabindex="1" required maxlength="40" autofocus type="text" class="form-control form-control-lg"
                                       value="<?= !empty($parametros["param_nome"]) ? $parametros["param_nome"] : '' ?>"
                                       id="nome" name="nome" title="Por favor, informe o nome do submenu">
                            </div>

                        </div>

                        <div class="col-12 col-md-6">

                            <div class="form-group form-group-lg">
                                <label for="sel_menu" class="font-weight-bold">Menu Principal <sup class="text-danger">*</sup>:</label>
                                <select tabindex="2" title="Por favor, selecione o menu principal"
                                        name="sel_menu" id="sel_menu" class="form-control form-control-lg" required>

                                    <option value="">Selecione um Menu</option>

									<?php

										if (!empty($this->dados->todosMenus)) {
											foreach ($this->dados->todosMenus as $men) {
												?>
                                                <option <?= !empty($parametros['param_menu']) && $parametros['param_menu'] === (int) $men['id']  ? 'selected' : '' ?> value="<?= $men['id'] ?>"><?= $men['nome'] ?></option>
												<?php
											}
										}

									?>

                                </select>
                            </div>

                        </div>

                        <div class="col-xs-12 col-md-6">

                            <div class="form-group form-group-lg">
                                <label for="url" class="font-weight-bold">URI do SubMenu <sup class="text-danger">*</sup>:</label>
                                <input tabindex="3" maxlength="255" type="text" class="form-control form-control-lg"
                                       value="<?= !empty($parametros['param_url']) ? $parametros['param_url'] : '' ?>"
                                       id="url" name="url" title="Por favor, informe a uri do submenu" required>
                            </div>

                        </div>

                    </div>

					<div class="form-group form-group-lg text-right mt-5 mb-0">
                        <input type="hidden" name="sub_on" value="">
						<input type="hidden" name="token" value="<?= password_hash(TOKEN_SESSAO, PASSWORD_DEFAULT) ?>">
						<a tabindex="6" role="button" href="<?= URL ?>permissoes/gerenciar-submenus"
						   class="btn btn-lg active btn-link text-primary">Cancelar</a>
						<button tabindex="5" type="submit" class="btn btn-success active text-white btn-lg" name="btnConfirmar">
							Confirmar <i class="fa fa-check fa-fw"></i></button>
					</div>

				</form>

			</div>

		</div>

        <div class="card border-primary">

            <div class="card-header bg-primary py-3">
                <h5 class="text-uppercase m-0 text-white text-center text-md-left">SubMenus Cadastrados</h5>
            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover m-0">

                        <thead>

                        <tr class="bg-gray-100">

                            <th class="border-0 font-weight-bold text-uppercase text-dark">Nome</th>
                            <th class="border-0 text-center font-weight-bold text-uppercase text-dark">Ativado</th>
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
                                        <td class="text-center">

                                            <a class="btn btn-primary btn-acao editar" title="Editar"
                                               href="<?= URL . 'permissoes/gerenciar-submenus/edit/' . $registro['id'] . $query_uri ?>">
                                                <i class="fas fa-pen"></i>
                                            </a>

                                            <form class="d-inline"
                                                  action="<?= URL ?>permissoes/gerenciar-menus/deletar"
                                                  method="post">
                                                <input type="hidden" name="codigo-acao"
                                                       value="<?= $registro["id"] ?>">
                                                <input type="hidden" name="token"
                                                       value="<?= password_hash(TOKEN_SESSAO, PASSWORD_DEFAULT) ?>">
                                                <input type="hidden" name="sub_on" value="">
                                                <button type="button" class="btn btn-danger btn-acao deletar"
                                                        title="Excluir SubMenu">
                                                    <i class="fas fa-times"></i>
                                                </button>

                                            </form>

                                        </td>
                                    </tr>

									<?php
								}
							} else {
								echo '<tr><td class="text-center text-muted" colspan="4">Nenhum submenu cadastrado</td></tr>';
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