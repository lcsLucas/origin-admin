<?php

	$retorno = null;
	$usuario = $this->dados->informacoes;

	if (!empty($this->dados->retorno))
		$retorno = $this->dados->retorno;

?>

<!-- Breadcrumb-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?= URL ?>">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Meu Perfil</li>
</ol>

<div class="animated fadeIn">

    <div id="conteudo" class="container-fluid">

        <div id="container-errors">

            <div id="erro-file-input"></div>

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

            <div class="card-header bg-primary">
                <h5 class="text-uppercase m-0">Alterar Perfil</h5>
            </div>

            <div class="card-body border border-top-0 border-primary">

                <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="post" class="form-validate"
                      enctype="multipart/form-data" id="formAlterarPerfil">

                    <p class="text-muted font-weight-lighter">(<span class="text-danger">*</span>) Campos obrigatórios
                    </p>

                    <div class="form-group form-group-lg">
                        <label for="nome" class="font-weight-bold">Nome <sup class="text-danger">*</sup>:</label>
                        <input required maxlength="60" autofocus type="text" class="form-control form-control-lg"
                               id="nome" name="nome" value="<?= $usuario->getNome() ?>"
                               title="Por favor, informe seu nome">
                    </div>

                    <div class="form-group form-group-lg">
                        <label for="apelido" class="font-weight-bold">Apelido <sup class="text-muted font-weight-normal">(opcional)</sup>:</label>
                        <input maxlength="20" type="text" class="form-control form-control-lg" id="apelido"
                               name="apelido" value="<?= $usuario->getApelido() ?>"
                               title="Por favor, informe um apelido">
                    </div>

                    <div class="form-group form-group-lg">
                        <label for="email" class="font-weight-bold">Email:</label>
                        <input disabled type="email" class="form-control form-control-lg" id="email" name="email"
                               value="<?= $usuario->getEmail() ?>" title="Você não pode alterar esse campo">
                    </div>

                    <div class="form-group form-group-lg">
                        <label for="usuario" class="font-weight-bold">Usuário:</label>
                        <input disabled type="text" class="form-control form-control-lg" id="usuario" name="usuario"
                               value="<?= $usuario->getLogin() ?>" title="Você não pode alterar esse campo">
                    </div>

                    <div class="form-group">
                        <input type="hidden" id="img_avatar"
                               value="<?= !empty($usuario->getImagem()->getNomeImagem()) && is_file(PATH_IMG . "usuarios/thumbs/" . $usuario->getImagem()->getNomeImagem()) ? URL_IMG . "usuarios/thumbs/" . $usuario->getImagem()->getNomeImagem() . "?random=" . rand() : '' ?>">
                        <div class="kv-avatar">
                            <div class="file-loading">
                                <input name="avatar" id="avatar" type="file" accept=".jpeg,.jpg,.png,.gif">
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-right mt-4 mb-0">
                        <input type="hidden" name="token" value="<?= password_hash(TOKEN_SESSAO, PASSWORD_DEFAULT) ?>">
                        <a role="button" href="<?= $_SERVER["REQUEST_URI"] ?>"
                           class="btn btn-lg active btn-link text-primary">Cancelar</a>
                        <button type="submit" class="btn btn-success active text-white btn-lg" name="btnConfirmar">
                            Confirmar <i class="fa fa-check"></i></button>
                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<div class="modal fade" id="modalFoto" tabindex="-1" role="dialog" aria-labelledby="ModalFoto" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Foto</h5>
                <button type="button" class="close" id="cancelaFoto" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div id="wrapper-img-crop"></div>
                <p class="text-white text-center mt-5 mb-2 mx-0 font-weight-light">Arraste para posicionar a foto e
                    clique em "Confirmar"</p>
                <div class="slidecontainer">
                    <input type="range" min="1" max="100" value="50" class="slider" id="myRange">
                </div>
            </div>
            <div class="modal-footer">
                <button id="confirmaFoto" disabled type="button" class="btn btn-primary btn-lg"><i
                            class="fas fa-spinner fa-spin"></i></button>
            </div>
        </div>
    </div>
</div>