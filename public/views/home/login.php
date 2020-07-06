<?php
if (!defined('ABSPATH'))
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">

</head>

<body>
    <div class="load-page">
        <div class="lds-roller">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <div id="tudo">
        <div id="conteudo">

            <div class="container">
                <div class="wrapper-img">
                    <a title="Agência Digital Origin" target="_blank" href="https://agenciaorigin.com.br">
                        <img src="<?= URL_IMG ?>logo-2.svg" alt="Agência Digital Origin" class="img-fluid logo">
                    </a>
                </div>

                <form action="<?= URL ?>fazer_login" method="post" id="form-login" name="formLogin" class="form-validate">

                    <div class="form-group">
                        <label for="login">Usuário ou Email</label>
                        <div class="input-group">
                            <label for="login" class="input-group-prepend">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="fa-fw">
                                    <path fill="currentColor" d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z" class=""></path>
                                </svg>
                            </label>
                            <input class="form-control" type="text" autocomplete="username" id="login" name="login" placeholder="Seu usuário" required maxlength="60" title="Por favor, informe seu usuário ou email">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="d-flex align-items-center justify-content-between">
                            <label for="senha">Senha</label>
                            <a class="link-senha" href="">Esqueceu sua senha?</a>
                        </div>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="fa-fw">
                                    <path fill="currentColor" d="M400 224h-24v-72C376 68.2 307.8 0 224 0S72 68.2 72 152v72H48c-26.5 0-48 21.5-48 48v192c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V272c0-26.5-21.5-48-48-48zM264 392c0 22.1-17.9 40-40 40s-40-17.9-40-40v-48c0-22.1 17.9-40 40-40s40 17.9 40 40v48zm32-168H152v-72c0-39.7 32.3-72 72-72s72 32.3 72 72v72z" class=""></path>
                                </svg>
                            </div>
                            <input class="form-control" type="password" autocomplete="current-password" id="senha" name="senha" placeholder="Sua senha" maxlength="60" required title="Por favor, informe sua senha">
                            <a class="input-group-append justify-content-center align-items-center px-2 show-password" href="javascript:void(0)">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="fa-fw show-eye">
                                    <path fill="currentColor" d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z" class=""></path>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="fa-fw hidden-eye">
                                    <path fill="currentColor" d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z" class=""></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <?php
                    if (!LOCALHOST) {
                    ?>
                        <div class="g-recaptcha" data-sitekey="6Lffia0ZAAAAALrx0zGXScykCh7ImI4AyW1GUuMY"></div>
                    <?php
                    }
                    ?>

                    <div class="form-group mb-0">
                        <button class="btn btn-primary btn-block btn-lg text-white" type="submit">Login</button>
                        <input type="hidden" name="token" value="<?= password_hash(TOKEN_SESSAO, PASSWORD_DEFAULT) ?>">
                        <input type="hidden" name="btnLogar">
                        <div class="mt-2">
                            <div class="wrapper-check">
                                <input type="checkbox" class="form-check-input" id="ckLogado" name="ckLogado">
                                <label class="form-check-label" for="ckLogado">Permanecer logado</label>
                            </div>
                        </div>
                    </div>

                </form>
            </div>

        </div>
        <footer id="rodape">
            <div class="container">
                <p><a title="Agência Digital Origin" href="https://agenciaorigin.com.br">Agência Origin</a> &copy; <?= date("Y") ?> Todos os diretos reservados.</p>
            </div>
        </footer>
    </div>


    <link rel="stylesheet" href="<?= URL_CSS ?>estilo-login<?= !LOCALHOST ? '.min' : '' ?>.css<?= !empty(VERSAO) ? '?versao=' . VERSAO : '' ?>">
    <script src="<?= URL_JS ?>script-login<?= !LOCALHOST ? '.min' : '' ?>.js<?= VERSAO ? '?versao=' . VERSAO : '' ?>"></script>

    <?php
    if (!LOCALHOST) {
    ?>
        <!-- reCAPTCH -->
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <?php
    }
    ?>
</body>

</html>