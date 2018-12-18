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
    <!-- Icons-->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
    <link href="<?= URL_PUBLIC ?>vendors/@coreui/icons/css/coreui-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <!-- Main styles for this application-->
    <link href="<?= URL_CSS ?>style.min.css" rel="stylesheet">
    <link href="<?= URL_CSS ?>estilo.css" rel="stylesheet">
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">

<div id="container-login" class="d-flex justify-content-center align-items-center">

    <div id="wrapper-login">

        <div class="alert text-center" role="alert" id="retorno-erro"></div>

        <div class="card">

            <div class="card-header bg-primary">
                <h3 class="text-uppercase text-center titulo">Acessar o Sistema</h3>
            </div>

            <div class="card-body">

                <form action="<?= URL ?>fazer_login" method="post" id="formLogin" name="formLogin" class="form-validate">

                    <div class="form-group">
                        <label class="form-label" for="login">E-mail ou Usúario:</label>

                        <div class="input-group input-group-lg">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-lg">
                                <i class="fa fa-user"></i>
                            </span>
                            </div>
                            <input type="text" autocomplete="username" class="form-control" id="login" name="login" required autofocus>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="form-label" for="senha">Senha:</label>
                        <div class="input-group input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text" ><i class="fa fa-lock"></i></span>
                            </div>
                            <input type="password" autocomplete="current-password" class="form-control" id="senha" name="senha" required>
                        </div>
                    </div>

                    <div class="form-group mt-5">
                        <button name="btnLogar" class="btn btn-success btn-block btn-lg text-white" type="submit">ENTRAR</button>
                        <input type="hidden" name="token" value="<?= password_hash("seg". $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'], PASSWORD_DEFAULT) ?>">
                        <p class="mt-3 text-right">
                            <a href="">Esqueceu sua senha?</a>
                        </p>
                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

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