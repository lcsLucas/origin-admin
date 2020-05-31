<?php
if (! defined('ABSPATH'))
    die;

use App\controllers\UsuarioController;
use App\controllers\MenuController;

$usu_controller = new UsuarioController();
$menus_controller = new MenuController();

$usuario_logado = $usu_controller->carregarInformacoes2();
$todos_menus = $menus_controller->carregarMenusUsuario();

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
    <link rel="stylesheet"
        href="<?= URL_CSS ?>estilo-painel<?= !LOCALHOST ? '.min' : '' ?>.css<?= !empty(VERSAO) ? '?versao=' . VERSAO : '' ?>">

</head>

<body class="c-app">
    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
        <div class="c-sidebar-brand d-md-down-none">
            <svg class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
                <use xlink:href="<?= URL_IMG ?>brand/logo.svg#full"></use>
            </svg>
            <svg class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">
                <use xlink:href="<?= URL_IMG ?>brand/logo.svg#signet"></use>
            </svg>
        </div>

        <?php
            include_once PATH_VIEWS . 'shared/sidebar-menu.php';
        ?>

        <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
            data-class="c-sidebar-minimized"></button>
    </div>
    <div class="c-sidebar c-sidebar-lg c-sidebar-light c-sidebar-right c-sidebar-overlaid" id="aside">
        <button class="c-sidebar-close c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-show"
            responsive="true">
            <svg class="c-icon">
                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-x"></use>
            </svg>
        </button>
        <ul class="nav nav-tabs nav-underline nav-underline-primary" role="tablist">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#timeline" role="tab">
                    <svg class="c-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-list"></use>
                    </svg></a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#messages" role="tab">
                    <svg class="c-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speech"></use>
                    </svg></a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#settings" role="tab">
                    <svg class="c-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                    </svg></a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="timeline" role="tabpanel">
                <div class="list-group list-group-accent">
                    <div
                        class="list-group-item list-group-item-accent-secondary bg-light text-center font-weight-bold text-muted text-uppercase c-small">
                        Today</div>
                    <div class="list-group-item list-group-item-accent-warning list-group-item-divider">
                        <div class="c-avatar float-right"><img class="c-avatar-img" src="assets/img/avatars/7.jpg"
                                alt="user@email.com"></div>
                        <div>Meeting with <strong>Lucas</strong></div><small class="text-muted mr-3">
                            <svg class="c-icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-calendar"></use>
                            </svg>&nbsp; 1 - 3pm</small><small class="text-muted">
                            <svg class="c-icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-location-pin"></use>
                            </svg>&nbsp; Palo Alto, CA</small>
                    </div>
                    <div class="list-group-item list-group-item-accent-info">
                        <div class="c-avatar float-right"><img class="c-avatar-img" src="assets/img/avatars/4.jpg"
                                alt="user@email.com"></div>
                        <div>Skype with <strong>Megan</strong></div><small class="text-muted mr-3">
                            <svg class="c-icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-calendar"></use>
                            </svg>&nbsp; 4 - 5pm</small><small class="text-muted">
                            <svg class="c-icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-skype"></use>
                            </svg>&nbsp; On-line</small>
                    </div>
                    <div
                        class="list-group-item list-group-item-accent-secondary bg-light text-center font-weight-bold text-muted text-uppercase c-small">
                        Tomorrow</div>
                    <div class="list-group-item list-group-item-accent-danger list-group-item-divider">
                        <div>New UI Project - <strong>deadline</strong></div><small class="text-muted mr-3">
                            <svg class="c-icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-calendar"></use>
                            </svg>&nbsp; 10 - 11pm</small><small class="text-muted">
                            <svg class="c-icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-home"></use>
                            </svg>&nbsp; creativeLabs HQ</small>
                        <div class="c-avatars-stack mt-2">
                            <div class="c-avatar c-avatar-xs"><img class="c-avatar-img" src="assets/img/avatars/2.jpg"
                                    alt="user@email.com"></div>
                            <div class="c-avatar c-avatar-xs"><img class="c-avatar-img" src="assets/img/avatars/3.jpg"
                                    alt="user@email.com"></div>
                            <div class="c-avatar c-avatar-xs"><img class="c-avatar-img" src="assets/img/avatars/4.jpg"
                                    alt="user@email.com"></div>
                            <div class="c-avatar c-avatar-xs"><img class="c-avatar-img" src="assets/img/avatars/5.jpg"
                                    alt="user@email.com"></div>
                            <div class="c-avatar c-avatar-xs"><img class="c-avatar-img" src="assets/img/avatars/6.jpg"
                                    alt="user@email.com"></div>
                        </div>
                    </div>
                    <div class="list-group-item list-group-item-accent-success list-group-item-divider">
                        <div><strong>#10 Startups.Garden</strong> Meetup</div><small class="text-muted mr-3">
                            <svg class="c-icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-calendar"></use>
                            </svg>&nbsp; 1 - 3pm</small><small class="text-muted">
                            <svg class="c-icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-location-pin"></use>
                            </svg>&nbsp; Palo Alto, CA</small>
                    </div>
                    <div class="list-group-item list-group-item-accent-primary list-group-item-divider">
                        <div><strong>Team meeting</strong></div><small class="text-muted mr-3">
                            <svg class="c-icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-calendar"></use>
                            </svg>&nbsp; 4 - 6pm</small><small class="text-muted">
                            <svg class="c-icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-home"></use>
                            </svg>&nbsp; creativeLabs HQ</small>
                        <div class="c-avatars-stack mt-2">
                            <div class="c-avatar c-avatar-xs"><img class="c-avatar-img" src="assets/img/avatars/2.jpg"
                                    alt="user@email.com"></div>
                            <div class="c-avatar c-avatar-xs"><img class="c-avatar-img" src="assets/img/avatars/3.jpg"
                                    alt="user@email.com"></div>
                            <div class="c-avatar c-avatar-xs"><img class="c-avatar-img" src="assets/img/avatars/4.jpg"
                                    alt="user@email.com"></div>
                            <div class="c-avatar c-avatar-xs"><img class="c-avatar-img" src="assets/img/avatars/5.jpg"
                                    alt="user@email.com"></div>
                            <div class="c-avatar c-avatar-xs"><img class="c-avatar-img" src="assets/img/avatars/6.jpg"
                                    alt="user@email.com"></div>
                            <div class="c-avatar c-avatar-xs"><img class="c-avatar-img" src="assets/img/avatars/7.jpg"
                                    alt="user@email.com"></div>
                            <div class="c-avatar c-avatar-xs"><img class="c-avatar-img" src="assets/img/avatars/8.jpg"
                                    alt="user@email.com"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane p-3" id="messages" role="tabpanel">
                <div class="message">
                    <div class="py-3 pb-5 mr-3 float-left">
                        <div class="c-avatar"><img class="c-avatar-img" src="assets/img/avatars/7.jpg"
                                alt="user@email.com"><span class="c-avatar-status bg-success"></span></div>
                    </div>
                    <div><small class="text-muted">Lukasz Holeczek</small><small
                            class="text-muted float-right mt-1">1:52 PM</small></div>
                    <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div><small
                        class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt...</small>
                </div>
                <hr>
                <div class="message">
                    <div class="py-3 pb-5 mr-3 float-left">
                        <div class="c-avatar"><img class="c-avatar-img" src="assets/img/avatars/7.jpg"
                                alt="user@email.com"><span class="c-avatar-status bg-success"></span></div>
                    </div>
                    <div><small class="text-muted">Lukasz Holeczek</small><small
                            class="text-muted float-right mt-1">1:52 PM</small></div>
                    <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div><small
                        class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt...</small>
                </div>
                <hr>
                <div class="message">
                    <div class="py-3 pb-5 mr-3 float-left">
                        <div class="c-avatar"><img class="c-avatar-img" src="assets/img/avatars/7.jpg"
                                alt="user@email.com"><span class="c-avatar-status bg-success"></span></div>
                    </div>
                    <div><small class="text-muted">Lukasz Holeczek</small><small
                            class="text-muted float-right mt-1">1:52 PM</small></div>
                    <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div><small
                        class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt...</small>
                </div>
                <hr>
                <div class="message">
                    <div class="py-3 pb-5 mr-3 float-left">
                        <div class="c-avatar"><img class="c-avatar-img" src="assets/img/avatars/7.jpg"
                                alt="user@email.com"><span class="c-avatar-status bg-success"></span></div>
                    </div>
                    <div><small class="text-muted">Lukasz Holeczek</small><small
                            class="text-muted float-right mt-1">1:52 PM</small></div>
                    <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div><small
                        class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt...</small>
                </div>
                <hr>
                <div class="message">
                    <div class="py-3 pb-5 mr-3 float-left">
                        <div class="c-avatar"><img class="c-avatar-img" src="assets/img/avatars/7.jpg"
                                alt="user@email.com"><span class="c-avatar-status bg-success"></span></div>
                    </div>
                    <div><small class="text-muted">Lukasz Holeczek</small><small
                            class="text-muted float-right mt-1">1:52 PM</small></div>
                    <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div><small
                        class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt...</small>
                </div>
            </div>
            <div class="tab-pane p-3" id="settings" role="tabpanel">
                <h6>Settings</h6>
                <div class="c-aside-options">
                    <div class="clearfix mt-4"><small><b>Option 1</b></small>
                        <label class="c-switch c-switch-label c-switch-pill c-switch-success c-switch-sm float-right">
                            <input class="c-switch-input" type="checkbox" checked=""><span class="c-switch-slider"
                                data-checked="On" data-unchecked="Off"></span>
                        </label>
                    </div>
                    <div><small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna aliqua.</small></div>
                </div>
                <div class="c-aside-options">
                    <div class="clearfix mt-3"><small><b>Option 2</b></small>
                        <label class="c-switch c-switch-label c-switch-pill c-switch-success c-switch-sm float-right">
                            <input class="c-switch-input" type="checkbox"><span class="c-switch-slider"
                                data-checked="On" data-unchecked="Off"></span>
                        </label>
                    </div>
                    <div><small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna aliqua.</small></div>
                </div>
                <div class="c-aside-options">
                    <div class="clearfix mt-3"><small><b>Option 3</b></small>
                        <label class="c-switch c-switch-label c-switch-pill c-switch-success c-switch-sm float-right">
                            <input class="c-switch-input" type="checkbox"><span class="c-switch-slider"
                                data-checked="On" data-unchecked="Off"></span>
                        </label>
                    </div>
                </div>
                <div class="c-aside-options">
                    <div class="clearfix mt-3"><small><b>Option 4</b></small>
                        <label class="c-switch c-switch-label c-switch-pill c-switch-success c-switch-sm float-right">
                            <input class="c-switch-input" type="checkbox" checked=""><span class="c-switch-slider"
                                data-checked="On" data-unchecked="Off"></span>
                        </label>
                    </div>
                </div>
                <hr>
                <h6>System Utilization</h6>
                <div class="text-uppercase mb-1 mt-4"><small><b>CPU Usage</b></small></div>
                <div class="progress progress-xs">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div><small class="text-muted">348 Processes. 1/4 Cores.</small>
                <div class="text-uppercase mb-1 mt-2"><small><b>Memory Usage</b></small></div>
                <div class="progress progress-xs">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 70%" aria-valuenow="70"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div><small class="text-muted">11444GB/16384MB</small>
                <div class="text-uppercase mb-1 mt-2"><small><b>SSD 1 Usage</b></small></div>
                <div class="progress progress-xs">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div><small class="text-muted">243GB/256GB</small>
                <div class="text-uppercase mb-1 mt-2"><small><b>SSD 2 Usage</b></small></div>
                <div class="progress progress-xs">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 10%" aria-valuenow="10"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div><small class="text-muted">25GB/256GB</small>
            </div>
        </div>
    </div>
    <div class="c-wrapper c-fixed-components">
        <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
            <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar"
                data-class="c-sidebar-show">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="fa-fw">
                    <path fill="currentColor"
                        d="M442 114H6a6 6 0 0 1-6-6V84a6 6 0 0 1 6-6h436a6 6 0 0 1 6 6v24a6 6 0 0 1-6 6zm0 160H6a6 6 0 0 1-6-6v-24a6 6 0 0 1 6-6h436a6 6 0 0 1 6 6v24a6 6 0 0 1-6 6zm0 160H6a6 6 0 0 1-6-6v-24a6 6 0 0 1 6-6h436a6 6 0 0 1 6 6v24a6 6 0 0 1-6 6z"
                        class=""></path>
                </svg>
            </button><a class="c-header-brand d-lg-none" href="#">
                <svg width="118" height="46" alt="CoreUI Logo">
                    <use xlink:href="<?= URL_IMG ?>brand/logo.svg#full"></use>
                </svg></a>
            <ul class="nav navbar-nav d-md-down-none ml-auto justify-content-center">
                <li class="nav-item px-3 text-muted font-weight-light">
                    Logado como: <span class="font-weight-bold text-dark"><?= $usuario_logado->getNome() ?></span>
                </li>
            </ul>
            <ul class="c-header-nav ml-auto mr-4">
                <li class="c-header-nav-item d-md-down-none mx-2"><a class="c-header-nav-link" href="#">
                        <svg class="c-icon">
                            <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-bell"></use>
                        </svg></a></li>
                <li class="c-header-nav-item d-md-down-none mx-2"><a class="c-header-nav-link" href="#">
                        <svg class="c-icon">
                            <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-list-rich"></use>
                        </svg></a></li>
                <li class="c-header-nav-item d-md-down-none mx-2"><a class="c-header-nav-link" href="#">
                        <svg class="c-icon">
                            <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-envelope-open"></use>
                        </svg></a></li>
                <li class="c-header-nav-item dropdown"><a class="c-header-nav-link" data-toggle="dropdown" href="#"
                        role="button" aria-haspopup="true" aria-expanded="false">
                        <div class="c-avatar">
                            <img class="c-avatar-img"
                                src="<?= !empty($usuario_logado->getImagem()->getNomeImagem()) && file_exists(PATH_IMG . 'usuarios/thumbs/' . $usuario_logado->getImagem()->getNomeImagem()) ? URL_IMG . 'usuarios/thumbs/' . $usuario_logado->getImagem()->getNomeImagem() . '?random =' .rand(1,100) : URL_IMG . 'usuarios/default-avatar.png' ?>"
                                alt="<?= $usuario_logado->getNome() ?>">
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right pt-0">
                        <div class="dropdown-header bg-light py-2"><strong>Account</strong></div><a
                            class="dropdown-item" href="#">
                            <svg class="c-icon mr-2">
                                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-bell"></use>
                            </svg> Updates<span class="badge badge-info ml-auto">42</span></a><a class="dropdown-item"
                            href="#">
                            <svg class="c-icon mr-2">
                                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-envelope-open"></use>
                            </svg> Messages<span class="badge badge-success ml-auto">42</span></a><a
                            class="dropdown-item" href="#">
                            <svg class="c-icon mr-2">
                                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-task"></use>
                            </svg> Tasks<span class="badge badge-danger ml-auto">42</span></a><a class="dropdown-item"
                            href="#">
                            <svg class="c-icon mr-2">
                                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-comment-square"></use>
                            </svg> Comments<span class="badge badge-warning ml-auto">42</span></a>
                        <div class="dropdown-header bg-light py-2"><strong>Settings</strong></div><a
                            class="dropdown-item" href="#">
                            <svg class="c-icon mr-2">
                                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-user"></use>
                            </svg> Profile</a><a class="dropdown-item" href="#">
                            <svg class="c-icon mr-2">
                                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-settings"></use>
                            </svg> Settings</a><a class="dropdown-item" href="#">
                            <svg class="c-icon mr-2">
                                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-credit-card"></use>
                            </svg> Payments<span class="badge badge-secondary ml-auto">42</span></a><a
                            class="dropdown-item" href="#">
                            <svg class="c-icon mr-2">
                                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-file"></use>
                            </svg> Projects<span class="badge badge-primary ml-auto">42</span></a>
                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#">
                            <svg class="c-icon mr-2">
                                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-lock-locked"></use>
                            </svg> Lock Account</a><a class="dropdown-item" href="#">
                            <svg class="c-icon mr-2">
                                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-account-logout"></use>
                            </svg> Logout</a>
                    </div>
                </li>
                <button class="c-header-toggler c-class-toggler mfe-md-3" type="button" data-target="#aside"
                    data-class="c-sidebar-show">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="fa-fw">
                        <path fill="currentColor"
                            d="M496 384H160v-16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v16H16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h80v16c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-16h336c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm0-160h-80v-16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v16H16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h336v16c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-16h80c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm0-160H288V48c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v16H16C7.2 64 0 71.2 0 80v32c0 8.8 7.2 16 16 16h208v16c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-16h208c8.8 0 16-7.2 16-16V80c0-8.8-7.2-16-16-16z"
                            class=""></path>
                    </svg>
                </button>
            </ul>
            <div class="c-subheader px-3">
                <!-- Breadcrumb-->
                <ol class="breadcrumb border-0 m-0">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                    <!-- Breadcrumb Menu-->
                </ol>
            </div>
        </header>
        <div class="c-body">
            <main class="c-main">