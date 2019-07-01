<?php
if (! defined('ABSPATH')){
    header("Location: /");
    exit();
}

use App\controllers\UsuarioController;
$usuario_logado = UsuarioController::carregarInformacoes2();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Painel Administrativo">
    <meta name="author" content="Lucas S. Rosa - lucas.tarta@hotmail.com">
    <meta name="keyword" content="">
    <title><?= $this->dados->title ?> - Painel Administrativo</title>

    <!-- Main styles for this application-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
    <script src="<?= URL_PUBLIC ?>vendors/pace-progress/pace.min.js"></script>
    <link href="<?= URL_PUBLIC ?>vendors/pace-progress/css/pace.min.css" rel="stylesheet">
    <link href="<?= URL_CSS ?>style.min.css" rel="stylesheet">

    <?php

    if ($_SERVER["REQUEST_METHOD"] === "POST" && empty($this->dados->modificacao_url)) { //se for metodo post, remove do histórico do navegador

        ?>

        <script>history.replaceState({}, '', '<?= $_SERVER["REQUEST_URI"] ?>');</script>

    <?php
    }

    ?>

</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">

<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">
        <img class="navbar-brand-full" src="<?= URL_IMG ?>brand/logo.svg" width="89" height="25" alt="CoreUI Logo">
        <img class="navbar-brand-minimized" src="<?= URL_IMG ?>brand/sygnet.svg" width="30" height="30" alt="CoreUI Logo">
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="nav navbar-nav d-md-down-none ml-auto">
        <li class="nav-item px-3 text-muted font-weight-light">
            Logado como: <span class="font-weight-bold"><?= $usuario_logado->getNome() ?></span>
        </li>
    </ul>
    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item d-md-down-none">
            <a class="nav-link" href="#">
                <i class="fas fa-bell"></i>
                <span class="badge badge-pill badge-danger">5</span>
            </a>
        </li>
        <li class="nav-item d-md-down-none">
            <a class="nav-link" href="#">
                <i class="fas fa-envelope"></i>
                <span class="badge badge-pill badge-danger">2</span>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <img class="img-avatar" src="<?= !empty($usuario_logado->getImagem()->getNomeImagem()) && file_exists(PATH_IMG . 'usuarios/thumbs/' . $usuario_logado->getImagem()->getNomeImagem()) ? URL_IMG . 'usuarios/thumbs/' . $usuario_logado->getImagem()->getNomeImagem() . '?random =' .rand(1,100) : URL_IMG . 'usuarios/default-avatar.png' ?>" alt="<?= $usuario_logado->getNome() ?>">
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header text-center">
                    <strong>Notificações</strong>
                </div>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-bell text-muted"></i> Updates
                    <span class="badge badge-info">42</span>
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-envelope-open-text text-muted"></i> Mensagens
                    <span class="badge badge-success">42</span>
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fa fa-tasks text-muted"></i> Tarefas
                    <span class="badge badge-danger">42</span>
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fa fa-comments text-muted"></i> Comentários
                    <span class="badge badge-warning">42</span>
                </a>
                <div class="dropdown-header text-center">
                    <strong>Conta</strong>
                </div>
                <a class="dropdown-item" href="<?= URL ?>alterar-perfil">
                    <i class="fa fa-user-edit text-muted"></i> Alterar Perfil</a>
                <a class="dropdown-item" href="<?= URL ?>alterar-senha">
                    <i class="fa fa-key text-muted"></i> Alterar Senha</a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs text-muted"></i> Opções</a>
                <a class="dropdown-item" href="<?= URL ?>logout">
                    <i class="fas fa-sign-out-alt text-muted"></i> Sair</a>
            </div>
        </li>
    </ul>
    <button class="navbar-toggler aside-menu-toggler d-md-down-none" type="button" data-toggle="aside-menu-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <button class="navbar-toggler aside-menu-toggler d-lg-none" type="button" data-toggle="aside-menu-show">
        <span class="navbar-toggler-icon"></span>
    </button>
</header>
<div class="app-body">

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

    <div class="sidebar">
        <nav class="sidebar-nav">
            <ul class="nav" id="nav-opcoes">
                <li class="nav-item">
                    <a class="nav-link" href="<?= URL ?>dashboard">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                        <span class="badge badge-primary">NEW</span>
                    </a>
                </li>
                <li class="nav-title">Cadastros Básicos</li>
                
                <li class="nav-title">Configurações</li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fas fa-user-cog"></i> Usuários</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= URL ?>usuarios/gerenciar-tipos-usuarios" target="_top">
                                Tipos de usuários
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= URL ?>usuarios/gerenciar-usuarios" target="_top">
                                Gerenciar usuários
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fas fa-user-lock"></i> Permissões</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= URL ?>permissoes/gerenciar-secoes-menus" target="_top">
                                Gerenciar Seções
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= URL ?>permissoes/gerenciar-menus" target="_top">
                                Gerenciar Menus
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= URL ?>permissoes/gerenciar-submenus" target="_top">
                                Gerenciar SubMenus
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= URL ?>" target="_top">
                                Controle de Acessos
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fas fa-user-edit"></i> Meu Perfil</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= URL ?>alterar-perfil" target="_top">
                                Alterar Perfil
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= URL ?>alterar-senha" target="_top">
                                Alterar Senha
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= URL ?>logout" target="_top">
                                Sair
                            </a>
                        </li>

                    </ul>
                </li>
            </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
    </div>
    <main class="main">

