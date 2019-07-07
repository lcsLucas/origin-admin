<?php
	if (! defined('ABSPATH'))
		die;
	
	$retorno = null;

	include_once ABSPATH . 'app/funcoesGlobais/paginacao.php';

	if (!empty($this->dados->retorno))
		$retorno = $this->dados->retorno;

	$todos_tipos = !empty($this->dados->todosTipos) ? $this->dados->todosTipos : array();
	$parametros = !empty($this->dados->parametros) ? $this->dados->parametros : array();

	$lista_registros = $this->dados->registros;

	$paginacao = $this->dados->paginacao;

	$this->dados->alert = true;

	$query_uri = '';
	if (!empty($_SERVER['QUERY_STRING']))
		$query_uri .= '?' . $_SERVER['QUERY_STRING'];

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

    <div id="conteudo" class="container-fluid">

		<?php include_once PATH_VIEWS . 'shared/mensagens-retorno.php' ?>

        <div class="card border-0">

            <div class="card-header bg-primary py-3">
                <h5 class="text-uppercase m-0">
					<?= !empty($this->dados->editar) ? "usuário \"" . $parametros["param_nome"] . "\" [<strong>Editar</strong>]" : "Gerenciar Usuários" ?>
                </h5>
            </div>

            <div class="card-body border border-top-0 border-primary">

                <form action="<?= !empty($this->dados->editar) ? URL . 'usuarios/gerenciar-usuarios/edit/' . $parametros['param_id'] . $query_uri : URL . 'usuarios/gerenciar-usuarios' . $query_uri ?>"
                      method="post" class="form-validate" id="formUsuario">

                    <p class="text-muted font-weight-lighter">(<span class="text-danger">*</span>) Campos obrigatórios</p>

                    <div class="row clearfix">

                        <div class="col-12 col-md-6">

                            <div class="form-group form-group-lg">
                                <label for="nome" class="font-weight-bold">Nome do usuário <sup
                                            class="text-danger">*</sup>:</label>
                                <input required maxlength="60" autofocus tabindex="1" type="text"
                                       class="form-control form-control-lg"
                                       value="<?= !empty($parametros["param_nome"]) ? $parametros["param_nome"] : "" ?>"
                                       id="nome" name="nome" title="Por favor, informe o nome do novo usuário">
                            </div>

                        </div>

                        <div class="col-12 col-md-6">

                            <div class="form-group form-group-lg">
                                <label for="email" class="font-weight-bold">Email do usuário <sup
                                            class="text-danger">*</sup>:</label>
                                <input required maxlength="60"
                                       type="email" <?= !empty($this->dados->editar) ? "disabled" : "" ?> tabindex="2"
                                       class="form-control form-control-lg" id="email" name="email"
                                       value="<?= !empty($parametros["param_email"]) ? $parametros["param_email"] : "" ?>"
                                       title="<?= !empty($this->dados->editar) ? "Você não pode alterar o email do usuário" : "Por favor, informe um email válido para o usuário" ?>">
                            </div>

                        </div>

                        <div class="col-12 col-md-6">

                            <div class="form-group form-group-lg">
                                <label for="sel_tipo" class="font-weight-bold">Tipo de usuário <sup class="text-danger">*</sup>:</label>
                                <select required tabindex="3" title="Por favor, selecione o tipo do novo usuário"
                                        name="sel_tipo" id="sel_tipo" class="form-control form-control-lg">

                                    <option value="">Selecione um tipo</option>

									<?php

										if (!empty($todos_tipos)) {
											foreach ($todos_tipos as $tipo) {
												?>
                                                <option <?= (!empty($parametros["param_tipo"]) && (int)$parametros["param_tipo"] === (int)$tipo['tip_id']) ? "selected" : "" ?>
                                                        value="<?= $tipo['tip_id'] ?>"><?= $tipo['tip_nome'] ?></option>
												<?php
											}
										}

									?>

                                </select>
                            </div>

                        </div>

                        <div class="col-12 col-md-6">

                            <div class="form-group form-group-lg">
                                <label for="usuario" class="font-weight-bold">Login do usuário <sup class="text-danger">*</sup>:</label>
                                <input required maxlength="15" <?= !empty($this->dados->editar) ? "disabled" : "" ?>
                                       tabindex="4" type="text" class="form-control form-control-lg" id="usuario"
                                       name="usuario"
                                       value="<?= !empty($parametros["param_usuario"]) ? $parametros["param_usuario"] : "" ?>"
                                       title="<?= !empty($this->dados->editar) ? "Você não pode alterar o login do usuário" : "Por favor, informe um login para o usuário" ?>">
                            </div>

                        </div>

                        <div class="col-12 col-md-6">

                            <div class="form-group form-group-lg">
                                <label for="senha_nova" class="font-weight-bold">Senha do usuário <sup
                                            class="text-danger">*</sup>:</label>
                                <div class="input-group">
                                    <input required maxlength="30" tabindex="5" type="password"
                                           class="form-control form-control-lg b-r-0" id="senha_nova" name="senha_nova"
                                           title="Por favor, informe a senha do usuário">
                                    <div class="input-group-append b-l-0">
                                    <span class="input-group-text bg-white">
                                        <a href="javascript:void(0)" onclick="exibiSenha(this)"><i
                                                    class="fa fa-eye-slash text-muted"></i></a>
                                    </span>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-12 col-md-6">

                            <div class="form-group form-group-lg">
                                <label for="senha_nova2" class="font-weight-bold">Repita a senha <sup
                                            class="text-danger">*</sup>:</label>
                                <div class="input-group">
                                    <input required maxlength="30" tabindex="6" type="password"
                                           class="form-control form-control-lg b-r-0" id="senha_nova2"
                                           name="senha_nova2" title="Por favor, repita a senha do usuário">
                                    <div class="input-group-append b-l-0">
                                    <span class="input-group-text bg-white">
                                        <a href="javascript:void(0)" onclick="exibiSenha(this)"><i
                                                    class="fa fa-eye-slash text-muted"></i></a>
                                    </span>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-12">

                            <div class="form-group form-group-lg text-right mt-5 mb-0">
                                <input type="hidden" name="token"
                                       value="<?= password_hash(TOKEN_SESSAO, PASSWORD_DEFAULT) ?>">
                                <a role="button" tabindex="8" href="<?= URL ?>usuarios/gerenciar-usuarios"
                                   class="btn btn-lg active btn-link text-primary">Cancelar</a>
                                <button tabindex="7" type="submit" class="btn btn-success active text-white btn-lg"
                                        name="btnConfirmar">Confirmar <i class="fa fa-check fa-fw"></i></button>
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

                <form method="get">

                    <div class="d-flex align-items-center"
                         style="max-width: 500px;margin-left: auto;margin-right: 30px;">

                        <label class="font-weight-bold m-0 text-muted mr-2" for="sel-busca">Pesquisar:</label>

                        <div class="input-group my-4">
                            <div class="input-group-prepend">

                                <select style="border-top-right-radius: 0; border-bottom-right-radius: 0" name="tipo"
                                        id="sel-busca" class="form-control">

									<?php

										$param_tipo = filter_input(INPUT_GET, 'tipo', FILTER_VALIDATE_INT);

									?>

                                    <option <?= empty($param_tipo) ? 'checked' : '' ?> value="">Nome</option>
                                    <option <?= (!empty($param_tipo) && $param_tipo === 2) ? 'selected' : '' ?>
                                            value="2">Email
                                    </option>
                                    <option <?= (!empty($param_tipo) && $param_tipo === 3) ? 'selected' : '' ?>
                                            value="3">Login
                                    </option>

                                </select>

                            </div>
                            <input type="text" class="form-control border-right-0"
                                   aria-label="Text input com dropdown button" name="termo"
                                   value="<?= filter_input(INPUT_GET, 'termo', FILTER_SANITIZE_STRING) ?>">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary border-left-0" type="submit"><i
                                            class="fa fa-search"></i></button>
                            </div>
							<?php
								if (filter_has_var(INPUT_GET, 'termo')) {
									?>
                                    <a href="<?= URL ?>usuarios/gerenciar-usuarios"
                                       class="btn btn-link text-danger pr-0"><i class="fas fa-times"></i></a>
									<?php
								}
							?>

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
									$editar = true;
									$title_disabled = 'Desativar esse usuário';
									$title_editar = 'Editar esse usuário';
									$title_excluir = 'Excluir esse usuário';

									if (!empty($registro["tip_administrador"]) && empty($this->dados->tipo_admin)) {
										$disabled = true;
										$editar = false;
										$title_disabled = 'Você não pode desativar um usuário administrador';
										$title_excluir = 'Você não pode excluir um usuário administrador';
										$title_editar = 'Você não pode editar um usuário administrador';
									} elseif ((int)$_SESSION['_idusuario'] === (int)$registro["usu_id"]) {
										$title_disabled = 'Você não pode desativar seu usuário';
										$title_excluir = 'Você não pode excluir seu usuário';
										$disabled = true;
										$editar = true;
									}

									?>

                                    <tr>

                                        <td class="font-weight-lighter lead text-muted">
											<?php

												if (!empty($registro['usu_avatar']) && PATH_IMG . 'usuarios/thumbs/' . $registro['usu_avatar']) {
													?>
                                                    <img src="<?= URL_IMG ?>usuarios/thumbs/<?= $registro['usu_avatar'] ?>"
                                                         alt="" class="img-avatar mr-3" width="50">
													<?php
												} else {
													?>
                                                    <img src="<?= URL_IMG ?>usuarios/default-avatar.png" alt=""
                                                         class="img-avatar mr-3" width="50">
													<?php
												}

											?>
											<?= $registro["usu_nome"] ?>
                                        </td>
                                        <td class="font-weight-lighter lead text-muted"><?= $registro["tip_nome"] ?></td>
                                        <td class="text-center font-weight-lighter lead text-muted"><?= date("d/m/Y", strtotime($registro["usu_dtCad"])) ?></td>
                                        <td class="text-center font-weight-lighter lead text-muted">
                                            <form action="<?= URL ?>usuarios/gerenciar-usuarios/alterar-status"
                                                  method="post">
                                                <input type="hidden" name="codigo-acao"
                                                       value="<?= $registro["usu_id"] ?>">
                                                <label title="<?= $title_disabled ?>"
                                                       class="switch switch-label switch-pill switch-success switch-sm">
                                                    <input class="switch-input desativar-usuarios" type="checkbox"
														<?= !empty($registro["usu_ativo"]) ? "checked" : "" ?> <?= ($disabled) ? 'disabled' : '' ?>
                                                           name="alterar-status">
                                                    <span class="switch-slider" data-checked=""
                                                          data-unchecked=""></span>
                                                </label>
                                            </form>
                                        </td>

                                        <td class="text-center">

											<?php

												$url_editar = URL . "usuarios/gerenciar-usuarios/edit/" . $registro["usu_id"];

												if (!empty($_SERVER["QUERY_STRING"]))
													$url_editar .= "?" . $_SERVER["QUERY_STRING"];

											?>

                                            <a class="btn btn-primary btn-acao <?= !$editar ? 'disabled' : '' ?>"
                                               title="<?= $title_editar ?>"
                                               href="<?= $url_editar ?>">
                                                <i class="fas fa-pen"></i>
                                            </a>

                                            <form class="d-inline"
                                                  action="<?= URL ?>usuarios/gerenciar-usuarios/deletar" method="post">
                                                <input type="hidden" name="codigo-acao"
                                                       value="<?= $registro["usu_id"] ?>">
                                                <input type="hidden" name="token"
                                                       value="<?= password_hash(TOKEN_SESSAO, PASSWORD_DEFAULT) ?>">
                                                <button type="button"
                                                        class="btn btn-danger btn-acao deletar-usuario" <?= ($disabled) ? 'disabled' : '' ?>
                                                        title="<?= $title_excluir ?>">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>

                                        </td>

                                    </tr>

									<?php

								}
							} else
								echo '<tr><td colspan="5" class="text-center text-muted">Nenhum registro encontrado</td></tr>';

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