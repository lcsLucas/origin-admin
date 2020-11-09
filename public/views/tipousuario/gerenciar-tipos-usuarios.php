<?php
	if (! defined('ABSPATH'))
		die;

	$retorno = null;

	include_once ABSPATH . 'backend/app/funcoesGlobais/paginacao.php';

	if (!empty($this->dados->retorno))
		$retorno = $this->dados->retorno;

	$nome = !empty($this->dados->nome) ? $this->dados->nome : '';

	$lista_registros = $this->dados->registros;

	$paginacao = $this->dados->paginacao;

	$this->dados->alert = true;

	$url = URL . 'usuarios/gerenciar-tipos-usuarios' . (!empty($this->dados->editar) ? '/edit/' . $this->dados->id : '');
	$query_uri = '';
	if (!empty($_SERVER['QUERY_STRING']))
		$query_uri .= '?' . $_SERVER['QUERY_STRING'];

?>

<!-- Breadcrumb-->
<!--<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?= URL ?>">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Usuários</li>
    <li class="breadcrumb-item active">Tipos de usuários</li>
</ol>
-->

<div class="animated fadeIn">

    <div id="conteudo" class="container-fluid">

		<?php include_once PATH_VIEWS . 'shared/mensagens-retorno.php' ?>

        <div class="card border-0">

            <div class="card-header bg-primary py-3">
                <h5 class="text-uppercase m-0 text-center text-md-left">
					<?= !empty($this->dados->editar) ? "Tipo de Usuários \"" . $nome . "\" [<strong>Editar</strong>]" : "Gerenciar Tipos de Usuários" ?>
                </h5>
            </div>

            <div class="card-body border border-top-0 border-primary">

                <form action="<?= $url . $query_uri ?>" method="post" class="form-validate"
                      id="formTipoUsuario">

                    <p class="text-muted font-weight-lighter">(<span class="text-danger">*</span>) Campos obrigatórios
                    </p>

                    <div class="form-group form-group-lg">
                        <label for="nome" class="font-weight-bold">Nome do tipo <sup
                                    class="text-danger">*</sup>:</label>
                        <input required maxlength="20" autofocus type="text" class="form-control form-control-lg"
                               value="<?= $nome ?>" id="nome" name="nome"
                               title="Por favor, informe o nome do novo tipo de usuário">
                    </div>

                    <div class="form-group form-group-lg mt-4">
                        <h4 class="text-muted text-uppercase">Controle de Acesso</h4>
                        <hr>

                        <?php

                            if (!empty($this->dados->todosMenus)) {
                                ?>

                                <div id="controle-acesso" class="row">

                                    <?php

                                        foreach ($this->dados->todosMenus as $id => $men) {
                                            ?>

                                            <div class="col-lg-4 col-md-6 col-12">

                                                <div class="form-group">

                                                    <label class="<?= !empty($this->dados->id) && $this->dados->id === 1 ? 'disabled' : '' ?>" <?= !empty($this->dados->id) && $this->dados->id === 1 ? 'title="Não é possível alterar as permissões do Administrador do Sistema"' : '' ?>>
                                                        <input class="d-none" type="checkbox" name="menu[]" value="<?= $id ?>" <?= !empty($men['ativo']) ? 'checked' : '' ?>>
                                                            <?php

                                                                if (!empty($men['ativo'])) {
                                                                    ?>
                                                                    <i class="fas fa-fw fa-check text-success"></i>
                                                            <?php
                                                                } else {
                                                                 ?>
                                                                    <i class="far fa-fw fa-square text-danger"></i>
                                                            <?php
                                                                }

                                                            ?>
                                                        <?= $men['nome'] ?>
                                                    </label>

                                                    <?php

                                                        if (!empty($men['submenu'])) {
                                                            ?>

                                                            <ul class="nav flex-column ml-4">

                                                                <?php

                                                                    foreach ($men['submenu'][0] as $sub) {
                                                                        ?>
                                                                        <li class="nav-item">
                                                                            <label class="<?= !empty($this->dados->id) && $this->dados->id === 1 ? 'disabled' : '' ?>" <?= !empty($this->dados->id) && $this->dados->id === 1 ? 'title="Não é possível alterar as permissões do Administrador do Sistema"' : '' ?>>
                                                                                <input class="d-none" type="checkbox" name="menu[]" value="<?= $sub['id'] ?>" <?= !empty($sub['ativo']) ? 'checked' : '' ?> >
                                                                                    <?php

                                                                                        if (!empty($sub['ativo'])) {
                                                                                            ?>
                                                                                            <i class="fas fa-fw fa-check text-success"></i>
                                                                                            <?php
                                                                                        } else {
                                                                                            ?>
                                                                                            <i class="far fa-fw fa-square text-danger"></i>
                                                                                            <?php
                                                                                        }

                                                                                    ?>
																				<?= $sub['nome'] ?>
                                                                            </label>
                                                                        </li>
                                                                <?php
                                                                    }

                                                                ?>

                                                            </ul>

                                                    <?php
                                                        }

                                                    ?>

                                                </div>

                                            </div>

                                    <?php
                                        }

                                    ?>

                                </div>

                        <?php
                            } else {
                             ?>

                                <p class="text-center text-muted">Não há nenhum Menu à ser listado no momento</p>

                        <?php
                            }

                        ?>

                    </div>

                    <div class="form-group form-group-lg text-right mt-5 mb-0">
                        <input type="hidden" name="token" value="<?= password_hash(TOKEN_SESSAO, PASSWORD_DEFAULT) ?>">
                        <a role="button" href="<?= URL ?>usuarios/gerenciar-tipos-usuarios"
                           class="btn btn-lg active btn-link text-primary">Cancelar</a>
                        <button type="submit" class="btn btn-success active text-white btn-lg" name="btnConfirmar">
                            Confirmar <i class="fa fa-check fa-fw"></i></button>
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
									$editar_adm = false;

									if (!empty($registro["tip_administrador"])) {
										$title_desativar = "Você não pode desativar o tipo de usuários Administrador";
										$title_excluir = "Você não pode excluir o tipo de usuários Administrador";
										$disabled = true;

										if ((int)$this->dados->tipo_usuario === (int)$registro["tip_id"])
											$editar_adm = true;

									} elseif ((int)$this->dados->tipo_usuario === (int)$registro["tip_id"]) {
										$title_desativar = "Você não pode desativar seu tipo de usuários";
										$title_excluir = "Você não pode excluir seu tipo de usuários";
										$disabled = true;
									}

									?>

                                    <tr>

                                        <td class="font-weight-lighter lead text-muted"><?= $registro["tip_nome"] ?></td>
                                        <td class="font-weight-lighter lead text-muted text-center"><?= date("d/m/Y", strtotime($registro["tip_dtcad"])) ?></td>
                                        <td class="text-center font-weight-bold text-muted">
                                            <form action="<?= URL ?>usuarios/gerenciar-tipos-usuarios/alterar-status"
                                                  method="post">
                                                <input type="hidden" name="codigo-acao"
                                                       value="<?= $registro["tip_id"] ?>">
                                                <label class="switch switch-label switch-pill switch-success switch-sm"
                                                       title="<?= $title_desativar ?>">
                                                    <input class="switch-input desativar-tipo-usuarios" type="checkbox"
														<?= !empty($registro["tip_ativo"]) ? "checked" : "" ?> <?= !empty($disabled) ? "disabled" : "" ?>
                                                           name="alterar-status">
                                                    <span class="switch-slider" data-checked=""
                                                          data-unchecked=""></span>
                                                </label>

                                            </form>

                                        </td>
                                        <td class="text-center">

                                            <a class="btn btn-primary btn-acao <?= !empty($registro["tip_administrador"]) && empty($editar_adm) ? "disabled" : "" ?>"
                                               title="Editar"
                                               href="<?= URL . 'usuarios/gerenciar-tipos-usuarios/edit/' . $registro['tip_id'] ?>">

                                                <i class="fas fa-pen"></i>

                                            </a>

                                            <form class="d-inline"
                                                  action="<?= URL ?>usuarios/gerenciar-tipos-usuarios/deletar"
                                                  method="post">
                                                <input type="hidden" name="codigo-acao"
                                                       value="<?= $registro["tip_id"] ?>">
                                                <input type="hidden" name="token"
                                                       value="<?= password_hash(TOKEN_SESSAO, PASSWORD_DEFAULT) ?>">
                                                <button type="button" class="btn btn-danger btn-acao deletar-tipo"
                                                        title="<?= $title_excluir ?>" <?= !empty($disabled) ? 'disabled' : '' ?> >

                                                    <i class="fas fa-times"></i>

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
					paginacao($paginacao->total_registros, $paginacao->registros_paginas, $paginacao->pagina_atual, $paginacao->range_paginas, $url)
				?>

            </div>

        </div>

    </div>

</div>