<?php
if (! defined('ABSPATH')){
    header("Location: /");
    exit();
}

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
    <title><?= $this->dados->title ?> - Painel Administrativo</title>
    <!-- Icons-->
    <link href="<?= URL_PUBLIC ?>vendors/@coreui/icons/css/coreui-icons.min.css" rel="stylesheet">
    <link href="<?= URL_PUBLIC ?>vendors/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="<?= URL_PUBLIC ?>vendors/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
    <!-- Main styles for this application-->
    <link href="<?= URL_CSS ?>style.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="<?= URL_CSS ?>estilo-painel.css" rel="stylesheet">
    <link href="<?= URL_PUBLIC ?>vendors/pace-progress/css/pace.min.css" rel="stylesheet">
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
    <ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item px-3">
            <a class="nav-link" href="#">Dashboard</a>
        </li>
        <li class="nav-item px-3">
            <a class="nav-link" href="#">Users</a>
        </li>
        <li class="nav-item px-3">
            <a class="nav-link" href="#">Settings</a>
        </li>
    </ul>
    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item d-md-down-none">
            <a class="nav-link" href="#">
                <i class="icon-bell"></i>
                <span class="badge badge-pill badge-danger">5</span>
            </a>
        </li>
        <li class="nav-item d-md-down-none">
            <a class="nav-link" href="#">
                <i class="icon-list"></i>
            </a>
        </li>
        <li class="nav-item d-md-down-none">
            <a class="nav-link" href="#">
                <i class="icon-location-pin"></i>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <img class="img-avatar" src="<?= URL_IMG ?>avatars/6.jpg" alt="admin@bootstrapmaster.com">
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
                    <i class="fa fa-user text-muted"></i> Perfil</a>
                <a class="dropdown-item" href="<?= URL ?>alterar-senha">
                    <i class="fa fa-lock text-muted"></i> Alterar Senha</a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs text-muted"></i> Opções</a>
                <a class="dropdown-item" href="<?= URL ?>logout">
                    <i class="fas fa-sign-out-alt text-muted"></i> Logout</a>
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
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.html">
                        <i class="nav-icon icon-speedometer"></i> Dashboard
                        <span class="badge badge-primary">NEW</span>
                    </a>
                </li>
                <li class="nav-title">Cadastros Básicos</li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="nav-icon icon-user"></i> Usuários</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= URL ?>usuarios/gerenciar-tipos-usuarios" target="_top">
                                <i class="nav-icon icon-star"></i> Tipos de Usuários
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= URL ?>usuarios/gerenciar-usuarios" target="_top">
                                <i class="nav-icon icon-star"></i> Gerenciar Usuários
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-title">Theme</li>
                <li class="nav-item">
                    <a class="nav-link" href="colors.html">
                        <i class="nav-icon icon-drop"></i> Colors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="typography.html">
                        <i class="nav-icon icon-pencil"></i> Typography</a>
                </li>
                <li class="nav-title">Components</li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="nav-icon icon-puzzle"></i> Base</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="base/breadcrumb.html">
                                <i class="nav-icon icon-puzzle"></i> Breadcrumb</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="base/cards.html">
                                <i class="nav-icon icon-puzzle"></i> Cards</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="base/carousel.html">
                                <i class="nav-icon icon-puzzle"></i> Carousel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="base/collapse.html">
                                <i class="nav-icon icon-puzzle"></i> Collapse</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="base/forms.html">
                                <i class="nav-icon icon-puzzle"></i> Forms</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="base/jumbotron.html">
                                <i class="nav-icon icon-puzzle"></i> Jumbotron</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="base/list-group.html">
                                <i class="nav-icon icon-puzzle"></i> List group</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="base/navs.html">
                                <i class="nav-icon icon-puzzle"></i> Navs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="base/pagination.html">
                                <i class="nav-icon icon-puzzle"></i> Pagination</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="base/popovers.html">
                                <i class="nav-icon icon-puzzle"></i> Popovers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="base/progress.html">
                                <i class="nav-icon icon-puzzle"></i> Progress</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="base/scrollspy.html">
                                <i class="nav-icon icon-puzzle"></i> Scrollspy</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="base/switches.html">
                                <i class="nav-icon icon-puzzle"></i> Switches</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="base/tables.html">
                                <i class="nav-icon icon-puzzle"></i> Tables</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="base/tabs.html">
                                <i class="nav-icon icon-puzzle"></i> Tabs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="base/tooltips.html">
                                <i class="nav-icon icon-puzzle"></i> Tooltips</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="nav-icon icon-cursor"></i> Buttons</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="buttons/buttons.html">
                                <i class="nav-icon icon-cursor"></i> Buttons</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="buttons/button-group.html">
                                <i class="nav-icon icon-cursor"></i> Buttons Group</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="buttons/dropdowns.html">
                                <i class="nav-icon icon-cursor"></i> Dropdowns</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="buttons/brand-buttons.html">
                                <i class="nav-icon icon-cursor"></i> Brand Buttons</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="charts.html">
                        <i class="nav-icon icon-pie-chart"></i> Charts</a>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="nav-icon icon-star"></i> Icons</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="icons/coreui-icons.html">
                                <i class="nav-icon icon-star"></i> CoreUI Icons
                                <span class="badge badge-success">NEW</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="icons/flags.html">
                                <i class="nav-icon icon-star"></i> Flags</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="icons/font-awesome.html">
                                <i class="nav-icon icon-star"></i> Font Awesome
                                <span class="badge badge-secondary">4.7</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="icons/simple-line-icons.html">
                                <i class="nav-icon icon-star"></i> Simple Line Icons</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="nav-icon icon-bell"></i> Notifications</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="notifications/alerts.html">
                                <i class="nav-icon icon-bell"></i> Alerts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="notifications/badge.html">
                                <i class="nav-icon icon-bell"></i> Badge</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="notifications/modals.html">
                                <i class="nav-icon icon-bell"></i> Modals</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="widgets.html">
                        <i class="nav-icon icon-calculator"></i> Widgets
                        <span class="badge badge-primary">NEW</span>
                    </a>
                </li>
                <li class="divider"></li>
            </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
    </div>
    <main class="main">

