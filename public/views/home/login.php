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
    <link href="<?= URL_CSS ?>style.min.css" rel="stylesheet">
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">

<div class="loader-wrap">
    <div class="loader">

        <span class="loader-item"></span>
        <span class="loader-item"></span>
        <span class="loader-item"></span>
        <span class="loader-item"></span>
        <span class="loader-item"></span>
        <span class="loader-item"></span>
        <span class="loader-item"></span>
        <span class="loader-item"></span>
        <span class="loader-item"></span>
        <span class="loader-item"></span>

    </div>
</div>

<div id="container-login" class="d-flex justify-content-center align-items-center">

    <div id="wrapper-login">

        <div class="card m-0">

            <div class="card-header border-0 bg-white">
                <h1 class="text-uppercase m-0 mt-3 h5 titulo text-center mb-1">Bem vindo ao sistema</h1>
                <h2 class="m-0 h6 text-muted text-center">Acesse o painel através do seu usuário e senha</h2>
            </div>

            <div class="card-body pt-1">

                <div class="alert text-center" role="alert" id="retorno-erro"></div>

                <form action="<?= URL ?>fazer_login" method="post" id="formLogin" name="formLogin" class="form-validate">

                    <div class="form-group">

                        <div class="wrapper-float">

                            <div class="prepend-group">
                                <i class="fa fa-user"></i>
                            </div>

                            <div class="form-float w-100 pr-2">
                                <input type="text" autocomplete="username" id="login" name="login" required maxlength="60" title="Por favor, informe seu usuário ou email">
                                <label class="form-label" for="login">E-mail ou usuário</label>
                            </div>

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="wrapper-float">

                            <div class="prepend-group">
                                <i class="fa fa-key"></i>
                            </div>

                            <div class="form-float w-100 pr-2">
                                <input type="password" autocomplete="current-password" id="senha" name="senha" maxlength="60" required title="Por favor, informe sua senha">
                                <label class="form-label" for="senha">Senha</label>
                            </div>

                        </div>

                    </div>

                    <div class="form-group mt-5 clearfix">
                        <button name="btnLogar" class="btn btn-primary btn-block btn-lg text-white" type="submit">ENTRAR</button>
                        <input type="hidden" name="token" value="<?= password_hash(TOKEN_SESSAO, PASSWORD_DEFAULT) ?>">
                        <div class="mt-2">
                            <div class="wrapper-check float-left">
                                <input type="checkbox" class="form-check-input" id="ckLogado">
                                <label class="form-check-label" for="ckLogado">Permanecer logado</label>
                            </div>
                            <a class="float-right" href="">Esqueceu sua senha?</a>
                        </div>
                    </div>

                </form>

            </div>

        </div>

        <p class="my-4 font-xs text-muted text-center">Copyright &copy; <?= date("Y") ?> Todos os diretos reservados</p>

    </div>

</div>

<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,600" rel="stylesheet">
<link href="<?= URL_PUBLIC ?>vendors/@coreui/icons/css/coreui-icons.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
<link href="<?= URL_CSS ?>estilo.css" rel="stylesheet">

<!-- CoreUI and necessary plugins-->
<script src="<?= URL_PUBLIC ?>vendors/jquery/dist/jquery.min.js"></script>
<script src="<?= URL_PUBLIC ?>vendors/popper.js/dist/popper.min.js"></script>
<script src="<?= URL_PUBLIC ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?= URL_PUBLIC ?>vendors/jquery-validate/jquery.validate.min.js"></script>
<script src="<?= URL_PUBLIC ?>vendors/jquery-validate/localization/messages_pt_PT.js"></script>
<script src="<?= URL_PUBLIC ?>vendors/@coreui/coreui/dist/js/coreui.min.js"></script>
<script src="<?= URL_JS ?>script_login.js"></script>
</body>
</html>