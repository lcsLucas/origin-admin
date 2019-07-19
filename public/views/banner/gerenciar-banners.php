<?php
	if (! defined('ABSPATH'))
		die;

	$retorno = null;

	include_once ABSPATH . 'app/funcoesGlobais/paginacao.php';

	if (!empty($this->dados->retorno))
		$retorno = $this->dados->retorno;

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
	<li class="breadcrumb-item active">Cadastros</li>
	<li class="breadcrumb-item active">Gerenciar Banners</li>
</ol>

<div class="animated fadeIn">

	<div id="conteudo" class="container-fluid">

		<?php include_once PATH_VIEWS . 'shared/mensagens-retorno.php' ?>

		<div class="card border-0">

			<div class="card-header bg-primary py-3">
				<h5 class="text-uppercase m-0 text-center text-md-left">
					<?= !empty($this->dados->editar) ? 'Banner "' . $parametros['param_titulo'] . '" [<strong>Editar</strong>]' : 'Cadastrar Novo Banner' ?>
				</h5>
			</div>

			<div class="card-body border border-top-0 border-primary">

				<form action="<?= !empty($this->dados->editar) ? URL . 'cadastros/banners/edit/' . $parametros['param_id'] . $query_uri : URL . 'cadastros/banners/gerenciar-banners' . $query_uri ?>"
					  method="post" class="form-validate" id="formBanners" enctype="multipart/form-data">

					<p class="text-muted font-weight-lighter">(<span class="text-danger">*</span>) Campos obrigatórios</p>

					<div class="form-group form-group-lg">
						<label for="titulo" class="font-weight-bold">Título do Banner <sup class="text-danger">*</sup>:</label>
						<input required maxlength="100" autofocus type="text" class="form-control form-control-lg"
							   value="<?= !empty($parametros['param_titulo']) ? $parametros['param_titulo'] : '' ?>"
							   id="titulo" name="titulo" title="Por favor, informe o título do banner">
					</div>

					<div class="form-group form-group-lg">
						<label for="subtitulo" class="font-weight-bold">SubTítulo do Banner <sup class="text-muted font-weight-normal">(opcional)</sup>:</label>
						<input maxlength="100" type="text" class="form-control form-control-lg"
							   value="<?= !empty($parametros['param_subtitulo']) ? $parametros['param_subtitulo'] : '' ?>"
							   id="subtitulo" name="subtitulo" title="Por favor, informe o SubTítulo do banner">
					</div>

					<div class="form-group form-group-lg">
						<label for="url" class="font-weight-bold">Link do Banner <sup class="text-danger">*</sup>:</label>
						<input required maxlength="400" type="text" class="form-control form-control-lg"
							   value="<?= !empty($parametros['param_url']) ? $parametros['param_url'] : '' ?>"
							   id="url" name="url" title="Por favor, informe o link do banner">
					</div>

                    <div class="col-xs-12 text-center">

                        <label>Abrir em <sup class="col-pink">*</sup>:</label>

                        <div class="form-group">

                            <div class="inputGroup">
                                <input required id="radio1" name="optExterno" type="radio" value="0" checked />
                                <label title="Link direciona para o próprio site" for="radio1">Mesma Janela</label>
                            </div>
                            <div class="inputGroup">
                                <input required id="radio2" name="optExterno" type="radio" value="1" />
                                <label title="Link direciona para fora do site (abre em uma nova janela do navegador)" for="radio2">Nova Janela</label>
                            </div>

                        </div>

                    </div>

                    <div class="col-xs-12 text-center">
                        <label for="txtLink">Mostrar os titulos no banner? <sup class="col-pink">*</sup>:</label>

                        <div class="form-group">

                            <div class="inputGroup">
                                <input required id="radio3" name="optTitulo" type="radio" value="0" checked />
                                <label title="Apenas a imagem do banner será mostrado" for="radio3">Não</label>
                            </div>
                            <div class="inputGroup">
                                <input required id="radio4" name="optTitulo" type="radio" value="1" />
                                <label title="O título será mostrado junto com a imagem do banner" for="radio4">Sim</label>
                            </div>

                        </div>

                    </div>

                    <div class="col-xs-12 mt-5">

                        <ul class="nav nav-tabs d-flex justify-content-center text-center border-0" role="tablist" id="tab-banners">
                            <li class="nav-item">
                                <a class="d-block active show text-uppercase" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true">
                                    <i class="fas fa-desktop d-block mx-auto"></i> Imagem Principal
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="d-block text-uppercase mx-3" data-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="false">
                                    <i class="fas fa-tablet-alt d-block mx-auto"></i> Imagem para Tablet
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="d-block text-uppercase" data-toggle="tab" href="#tab-3" role="tab" aria-controls="tab-3" aria-selected="false">
                                    <i class="fas fa-mobile-alt d-block mx-auto"></i> Imagem para Mobile
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content mt-3" id="tab-content-banners">
                            <div class="tab-pane active show" id="tab-1" role="tabpanel">
                                <div class="form-group text-center">
                                    <label class="font-weight-bold">Selecione a imagem de Destaque: <sup class="text-danger">*</sup>:</label>
                                    <div class="kv-avatar">
                                        <div class="file-loading">
                                            <input class="file-input-bootstrap" name="img_destaque" type="file" accept=".jpeg,.jpg,.png" data-preview="https://via.placeholder.com/1600x520">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-2" role="tabpanel">
                                <div class="form-group text-center">
                                    <label class="font-weight-bold">Selecione a imagem para Tablets <sup class="text-muted font-weight-normal">(opcional)</sup>:</label>
                                    <div class="kv-avatar">
                                        <div class="file-loading">
                                            <input class="file-input-bootstrap" name="img_tablet" type="file" accept=".jpeg,.jpg,.png" data-preview="https://via.placeholder.com/1024x500">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-3" role="tabpanel">
                                <div class="form-group text-center">
                                    <label class="font-weight-bold">Selecione a imagem para Mobile <sup class="text-muted font-weight-normal">(opcional)</sup>:</label>
                                    <div class="kv-avatar">
                                        <div class="file-loading">
                                            <input class="file-input-bootstrap" name="img_mobile" type="file" accept=".jpeg,.jpg,.png" data-preview="https://via.placeholder.com/540x540">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

					<div class="form-group form-group-lg text-right mt-5 mb-0">
						<input type="hidden" name="token" value="<?= password_hash(TOKEN_SESSAO, PASSWORD_DEFAULT) ?>">
						<a role="button" href="<?= URL ?>cadastros/banners/gerenciar-banners"
						   class="btn btn-lg active btn-link text-primary">Cancelar</a>
						<button type="submit" class="btn btn-success active text-white btn-lg" name="btnConfirmar">
							Confirmar <i class="fa fa-check fa-fw"></i></button>
					</div>

				</form>

			</div>

		</div>

		<div class="card border-primary">

			<div class="card-header bg-primary py-3">
				<h5 class="text-uppercase m-0 text-white text-center text-md-left">Banners Cadastrados</h5>
			</div>

			<div class="card-body p-0">

				<form method="get" class="form-pesquisa">

					<div class="d-flex align-items-center container-form" >

						<label class="font-weight-bold m-0 text-muted mr-2" for="sel-busca">Pesquisar:</label>

						<div class="input-group my-4">
							<div class="input-group-prepend">

								<select name="tipo" id="sel-busca" class="form-control">

									<?php

										$param_tipo = filter_input(INPUT_GET, 'tipo', FILTER_VALIDATE_INT);

									?>

									<option <?= empty($param_tipo) ? 'checked' : '' ?> value="">Título</option>
									<option <?= (!empty($param_tipo) && $param_tipo === 2) ? 'selected' : '' ?> value="2">
										Link
									</option>

								</select>

							</div>
							<input required type="text" class="form-control border-right-0" aria-label="Text input com dropdown button" name="termo" value="<?= filter_input(INPUT_GET, 'termo', FILTER_SANITIZE_STRING) ?>">
							<div class="input-group-append">
								<button class="btn btn-outline-secondary border-left-0" type="submit">
									<i class="fa fa-search"></i>
								</button>
							</div>
							<?php
								if (filter_has_var(INPUT_GET, 'termo')) {
									?>
									<a href="<?= URL ?>cadastros/banners/gerenciar-banners" class="btn btn-link text-danger pr-0">
										<i class="fas fa-times"></i>
									</a>
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

							<th class="border-0 font-weight-bold text-uppercase text-dark">Título</th>
							<th class="border-0 font-weight-bold text-uppercase text-dark">Link</th>
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
										<td class="font-weight-lighter lead text-muted"><?= $registro['nome'] ?></td>
										<td class="text-center font-weight-bold text-muted">
											<form action="<?= URL ?>cadastros/banners/alterar-status"
												  method="post">
												<input type="hidden" name="codigo-acao"
													   value="<?= $registro['idbanner'] ?>">
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

											<form action="<?= URL ?>cadastros/banners/alterar-ordem<?= $query_uri ?>"
												  method="post">
												<input type="hidden" name="codigo-acao"
													   value="<?= $registro['idbanner'] ?>">

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
											   href="<?= URL . 'cadastros/banners/edit/' . $registro['idbanner'] . $query_uri ?>">
												<i class="fas fa-pen"></i>
											</a>

											<form class="d-inline"
												  action="<?= URL ?>cadastros/banners/gerenciar-banners/deletar"
												  method="post">
												<input type="hidden" name="codigo-acao"
													   value="<?= $registro['idbanner'] ?>">
												<input type="hidden" name="token"
													   value="<?= password_hash(TOKEN_SESSAO, PASSWORD_DEFAULT) ?>">
												<button type="button" class="btn btn-danger btn-acao deletar"
														title="Excluir Banner">
													<i class="fas fa-times"></i>
												</button>

											</form>

										</td>
									</tr>

									<?php
								}
							} else {
								echo '<tr><td class="text-center text-muted" colspan="5">Nenhum banner cadastrado</td></tr>';
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

<div id="modalEditorFoto">

    <div id="modal-header" class="d-flex justify-content-between align-items-center">
        <h2 class="mb-0">Editor de Imagens</h2>

        <div>
            <button class="btn-close-crop btn btn-link text-white">Cancelar</button>
            <button class="btn btn-primary px-4 py-2 btn-confirmar-crop">Salvar</button>
        </div>

    </div>

    <div id="modal-body" class="h-100 mh-100"></div>

    <div id="modal-footer">
        <a href="" class="active crop-cortar" title="Cortar" >
            <i class="fas fa-crop-alt"></i>
        </a>
        <a href="" title="Mover" class="crop-mover">
            <i class="fas fa-arrows-alt"></i>
        </a>
        <a href="" title="Zoom +" class="crop-zoomup">
            <i class="fas fa-search-plus"></i>
        </a>
        <a href="" title="Zoom -" class="crop-zoomdown">
            <i class="fas fa-search-minus"></i>
        </a>
        <a href="" title="Rotacionar para esquerda" class="crop-rotaesquerda">
            <i class="fas fa-redo fa-rotate-180"></i>
        </a>
        <a href="" title="Rotacionar para direita" class="crop-rotadireita">
            <i class="fas fa-redo"></i>
        </a>
        <a href="" title="Inverter Horizontalmente" class="crop-iverter-h">
            <i class="fas fa-arrows-alt-h"></i>
        </a>
        <a href="" title="Inverter Verticalmente" class="crop-iverter-v">
            <i class="fas fa-arrows-alt-v"></i>
        </a>
    </div>

</div>