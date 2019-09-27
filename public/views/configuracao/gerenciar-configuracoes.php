<?php
	if (! defined('ABSPATH'))
		die;

	$retorno = null;

	if (!empty($this->dados->retorno))
		$retorno = $this->dados->retorno;

	$parametros = !empty($this->dados->parametros) ? $this->dados->parametros : array();

?>

<!-- Breadcrumb-->
<ol class="breadcrumb">
	<li class="breadcrumb-item">
		<a href="<?= URL ?>">Dashboard</a>
	</li>
	<li class="breadcrumb-item active">Configurações</li>
	<li class="breadcrumb-item active">Gerais</li>
</ol>

<div class="animated fadeIn">

	<div id="conteudo" class="container">

		<?php include_once PATH_VIEWS . 'shared/mensagens-retorno.php' ?>

		<div class="card border-0">

			<div class="card-header bg-primary">
				<h5 class="text-uppercase m-0">Configurações Gerais</h5>
			</div>

			<div class="card-body border border-top-0 border-primary">

				<form action="<?= URL ?>configuracoes/gerais<?= !empty($parametros) ? '/editar' : '' ?>" method="post" class="form-validate" id="formConfig" enctype="multipart/form-data">
					<p class="text-muted font-weight-lighter">(<span class="text-danger">*</span>) Campos obrigatórios</p>

					<div class="form-group form-group-lg">
						<label for="nome" class="font-weight-bold">Nome do Site <sup class="text-danger">*</sup>:</label>
						<input required maxlength="100" autofocus type="text" class="form-control form-control-lg"
							   value="<?= !empty($parametros['param_nome']) ? $parametros['param_nome'] : '' ?>"
							   id="nome" name="nome" title="Por favor, informe o nome do site">
					</div>

					<div class="form-group form-group-lg">
						<label for="resumo" class="font-weight-bold">Resumo do Site <sup class="text-danger">*</sup>:</label>
						<textarea name="resumo" id="resumo" cols="30" required rows="4" class="form-control form-control-lg" title="Por favor, informe o resumo do site"><?= !empty($parametros['param_resumo']) ? $parametros['param_resumo'] : '' ?></textarea>
						<span class="form-text text-muted font-weight-light">Esse resumo será usado para encontrar o seu site no Google</span>
					</div>

                    <div class="row">

                        <div class="col-12 col-lg-6">
                            <div class="form-group text-center">
                                <label class="font-weight-bold mb-0">Selecione a Logo do Site: <sup class="text-danger">*</sup>:</label>
                                <div class="kv-avatar">
                                    <div class="file-loading">
                                        <input id="file-logo" title="Selecione uma imagem para a logo" class="file-input-bootstrap <?= empty($parametros) ? 'required' : '' ?>" name="img_logo" type="file" accept=".jpeg,.jpg,.png" data-preview="<?= !empty($parametros['param_logo']) && file_exists(PATH_IMG . $parametros['param_logo']) ? URL_IMG . $parametros['param_logo'] . (!empty($parametros['param_alteracao']) ? '?versao=' . $parametros['param_alteracao'] : '') : 'https://via.placeholder.com/350x350' ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group text-center">
                                <label class="font-weight-bold mb-0">Selecione o Favicon do Site: <sup class="text-muted font-weight-normal">(opcional)</sup>:</label>
                                <div class="kv-avatar">
                                    <div class="file-loading">
                                        <input id="file-favicon" class="file-input-bootstrap" name="img_favicon" type="file" accept=".jpeg,.jpg,.png" data-preview="<?= !empty($parametros['param_favicon']) && file_exists(PATH_IMG . 'favicon/' . $parametros['param_favicon']) ? URL_IMG . 'favicon/' . $parametros['param_favicon'] . (!empty($parametros['param_alteracao']) ? '?versao=' . $parametros['param_alteracao'] : '') : 'https://via.placeholder.com/350x350' ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-12">
                            <div class="form-group form-group-lg text-right mt-5 mb-0">
                                <input type="hidden" name="token" value="<?= password_hash(TOKEN_SESSAO, PASSWORD_DEFAULT) ?>">
                                <a role="button" href="<?= URL ?>cadastros/banners/gerenciar-banners"
                                   class="btn btn-lg active btn-link text-primary">Cancelar</a>
                                <button type="submit" class="btn btn-success text-white btn-lg" name="btnConfirmar">
                                    Confirmar <i class="fa fa-check fa-fw"></i></button>
                            </div>
                        </div>
                    </div>
				</form>

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

    <div id="modal-body" class=""></div>

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