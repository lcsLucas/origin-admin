<?php
	if (! defined('ABSPATH'))
        die;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keyword" content="">
    <title><?= $this->dados->title ?></title>

    <!-- Main styles for this application-->
    <link rel="stylesheet" href="<?= URL_CSS ?>load-page<?= !LOCALHOST ? '.min' : '' ?>.css<?= !empty(VERSAO) ? '?versao=' . VERSAO : '' ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;800&display=swap" rel="stylesheet">

</head>
<body>
<div class="load-page">
    <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    <p>
        Carregando...
    </p>
</div>

<div class="container-login">
    <div class="wrapper-login">
        <div class="alert text-center" role="alert" id="retorno-erro"></div>
        <h1 class="title-login">
            Login
        </h1>

        <form action="<?= URL ?>fazer_login" method="post" id="formLogin" name="formLogin" class="form-validate">

            <div class="form-group">

                <div class="wrapper-input">
                    <label for="login">Username</label>
                    <div class="input-group">
                        <label for="login" class="input-group-prepend">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="fa-fw"><path fill="currentColor" d="M313.6 304c-28.7 0-42.5 16-89.6 16-47.1 0-60.8-16-89.6-16C60.2 304 0 364.2 0 438.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-25.6c0-74.2-60.2-134.4-134.4-134.4zM400 464H48v-25.6c0-47.6 38.8-86.4 86.4-86.4 14.6 0 38.3 16 89.6 16 51.7 0 74.9-16 89.6-16 47.6 0 86.4 38.8 86.4 86.4V464zM224 288c79.5 0 144-64.5 144-144S303.5 0 224 0 80 64.5 80 144s64.5 144 144 144zm0-240c52.9 0 96 43.1 96 96s-43.1 96-96 96-96-43.1-96-96 43.1-96 96-96z" class=""></path></svg>
                        </label>
                        <input class="form-control" type="text" autocomplete="username" id="login" name="login" required maxlength="60" title="Por favor, informe seu usuário ou email">
                        <span class="focus-input"></span>
                    </div>
                </div>
            </div>

            <div class="form-group">

                <div class="wrapper-input">
                    <label for="senha">Senha</label>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="fa-fw"><path fill="currentColor" d="M224 412c-15.5 0-28-12.5-28-28v-64c0-15.5 12.5-28 28-28s28 12.5 28 28v64c0 15.5-12.5 28-28 28zm224-172v224c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V240c0-26.5 21.5-48 48-48h32v-48C80 64.5 144.8-.2 224.4 0 304 .2 368 65.8 368 145.4V192h32c26.5 0 48 21.5 48 48zm-320-48h192v-48c0-52.9-43.1-96-96-96s-96 43.1-96 96v48zm272 48H48v224h352V240z" class=""></path></svg>
                        </div>
                        <input class="form-control" type="password" autocomplete="current-password" id="senha" name="senha" maxlength="60" required title="Por favor, informe sua senha">
                        <span class="focus-input"></span>
                    </div>

                    <a class="float-right link-senha" href="">Esqueceu sua senha?</a>

                </div>
            </div>

            <div class="form-group d-none" id="wrapper-desafio"></div>

            <div class="form-group">
                <button class="btn btn-primary btn-block btn-lg text-white" type="submit">ENTRAR</button>
                <input type="hidden" name="token" value="<?= password_hash(TOKEN_SESSAO, PASSWORD_DEFAULT) ?>">
                <input type="hidden" name="recaptcha_response" id="recaptcha-response">
                <input type="hidden" name="btnLogar">
                <div class="mt-2">
                    <div class="wrapper-check float-left">
                        <input type="checkbox" class="form-check-input" id="ckLogado" name="ckLogado">
                        <label class="form-check-label" for="ckLogado">Permanecer logado</label>
                    </div>
                </div>
            </div>

        </form>

    </div>

    <div class="text-center d-none">
        <p class="mt-4 mb-0 font-xs text-muted">Desenvolvido por:</p>
        <a href="" rel="noopener" target="_blank">
            <img src="<?= URL_IMG ?>logo.png" alt="logo Sites monkey" class="img-fluid" style="max-width: 160px">
        </a>
    </div>

    <p class="mb-2 font-xs text-white text-center">Copyright &copy; <?= date("Y") ?> Todos os diretos reservados</p>

</div>

<link rel="stylesheet" href="<?= URL_CSS ?>estilo-login<?= !LOCALHOST ? '.min' : '' ?>.css<?= !empty(VERSAO) ? '?versao=' . VERSAO : '' ?>">

<script>
    const RECAPTCHA_SITE_KEY = '<?= RECAPTCHA_SITE_KEY ?>';
</script>

<script src="<?= URL_JS ?>script-login<?= !LOCALHOST ? '.min' : '' ?>.js<?= VERSAO ? '?versao=' . VERSAO : '' ?>"></script>

<!-- reCAPTCH -->
<script src="https://www.google.com/recaptcha/api.js?render=<?= RECAPTCHA_SITE_KEY ?>"></script>

</body>
</html>