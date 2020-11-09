<?php
if (!defined('ABSPATH'))
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
    <link href="<?= URL_CSS ?>style.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= URL_CSS ?>estilo-painel<?= !LOCALHOST ? '.min' : '' ?>.css<?= !empty(VERSAO) ? '?versao=' . VERSAO : '' ?>">
    <link rel="stylesheet" href="<?= URL_PUBLIC ?>css/estilo-painel<?= !LOCALHOST ? '.min' : '' ?>.css<?= !empty(VERSAO) ? '?versao=' . VERSAO : '' ?>">

</head>

<body class="c-app">
    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
        <div class="c-sidebar-brand d-md-down-none">
            <img width="80" src="<?= URL_IMG ?>logo-branca.svg" alt="Agência Origin" class="img-fluid c-sidebar-brand-full">
            <img width="25" src="<?= URL_IMG ?>logo-branca-2.svg" alt="Agência Origin" class="img-fluid c-sidebar-brand-minimized">

            <!--<svg class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
                <use xlink:href="<?= URL_IMG ?>brand/logo.svg#full"></use>
            </svg>
            <svg class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">
                <use xlink:href="<?= URL_IMG ?>brand/logo.svg#signet"></use>
            </svg>-->
        </div>

        <?php
        include_once PATH_VIEWS . 'shared/sidebar-menu.php';
        ?>

        <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
    </div>
    <div class="c-sidebar c-sidebar-lg c-sidebar-light c-sidebar-right c-sidebar-overlaid" id="aside">
        <button class="c-sidebar-close c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-show" responsive="true">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="c-icon">
                <path fill="currentColor" d="M193.94 256L296.5 153.44l21.15-21.15c3.12-3.12 3.12-8.19 0-11.31l-22.63-22.63c-3.12-3.12-8.19-3.12-11.31 0L160 222.06 36.29 98.34c-3.12-3.12-8.19-3.12-11.31 0L2.34 120.97c-3.12 3.12-3.12 8.19 0 11.31L126.06 256 2.34 379.71c-3.12 3.12-3.12 8.19 0 11.31l22.63 22.63c3.12 3.12 8.19 3.12 11.31 0L160 289.94 262.56 392.5l21.15 21.15c3.12 3.12 8.19 3.12 11.31 0l22.63-22.63c3.12-3.12 3.12-8.19 0-11.31L193.94 256z" class=""></path>
            </svg>
        </button>
        <ul class="nav nav-tabs nav-underline nav-underline-primary" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#timeline" role="tab">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="c-icon">
                        <path fill="currentColor" d="M32.39 224C14.73 224 0 238.33 0 256s14.73 32 32.39 32a32 32 0 0 0 0-64zm0-160C14.73 64 0 78.33 0 96s14.73 32 32.39 32a32 32 0 0 0 0-64zm0 320C14.73 384 0 398.33 0 416s14.73 32 32.39 32a32 32 0 0 0 0-64zM504 80H136a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h368a8 8 0 0 0 8-8V88a8 8 0 0 0-8-8zm0 160H136a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h368a8 8 0 0 0 8-8v-16a8 8 0 0 0-8-8zm0 160H136a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h368a8 8 0 0 0 8-8v-16a8 8 0 0 0-8-8z" class=""></path>
                    </svg>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#messages" role="tab">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="c-icon">
                        <path fill="currentColor" d="M448 0H64C28.7 0 0 28.7 0 64v288c0 35.3 28.7 64 64 64h96v84c0 7.1 5.8 12 12 12 2.4 0 4.9-.7 7.1-2.4L304 416h144c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64zm32 352c0 17.6-14.4 32-32 32H293.3l-8.5 6.4L192 460v-76H64c-17.6 0-32-14.4-32-32V64c0-17.6 14.4-32 32-32h384c17.6 0 32 14.4 32 32v288zM128 184c-13.3 0-24 10.7-24 24s10.7 24 24 24 24-10.7 24-24-10.7-24-24-24zm128 0c-13.3 0-24 10.7-24 24s10.7 24 24 24 24-10.7 24-24-10.7-24-24-24zm128 0c-13.3 0-24 10.7-24 24s10.7 24 24 24 24-10.7 24-24-10.7-24-24-24z" class=""></path>
                    </svg>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#settings" role="tab">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="c-icon">
                        <path fill="currentColor" d="M482.696 299.276l-32.61-18.827a195.168 195.168 0 0 0 0-48.899l32.61-18.827c9.576-5.528 14.195-16.902 11.046-27.501-11.214-37.749-31.175-71.728-57.535-99.595-7.634-8.07-19.817-9.836-29.437-4.282l-32.562 18.798a194.125 194.125 0 0 0-42.339-24.48V38.049c0-11.13-7.652-20.804-18.484-23.367-37.644-8.909-77.118-8.91-114.77 0-10.831 2.563-18.484 12.236-18.484 23.367v37.614a194.101 194.101 0 0 0-42.339 24.48L105.23 81.345c-9.621-5.554-21.804-3.788-29.437 4.282-26.36 27.867-46.321 61.847-57.535 99.595-3.149 10.599 1.47 21.972 11.046 27.501l32.61 18.827a195.168 195.168 0 0 0 0 48.899l-32.61 18.827c-9.576 5.528-14.195 16.902-11.046 27.501 11.214 37.748 31.175 71.728 57.535 99.595 7.634 8.07 19.817 9.836 29.437 4.283l32.562-18.798a194.08 194.08 0 0 0 42.339 24.479v37.614c0 11.13 7.652 20.804 18.484 23.367 37.645 8.909 77.118 8.91 114.77 0 10.831-2.563 18.484-12.236 18.484-23.367v-37.614a194.138 194.138 0 0 0 42.339-24.479l32.562 18.798c9.62 5.554 21.803 3.788 29.437-4.283 26.36-27.867 46.321-61.847 57.535-99.595 3.149-10.599-1.47-21.972-11.046-27.501zm-65.479 100.461l-46.309-26.74c-26.988 23.071-36.559 28.876-71.039 41.059v53.479a217.145 217.145 0 0 1-87.738 0v-53.479c-33.621-11.879-43.355-17.395-71.039-41.059l-46.309 26.74c-19.71-22.09-34.689-47.989-43.929-75.958l46.329-26.74c-6.535-35.417-6.538-46.644 0-82.079l-46.329-26.74c9.24-27.969 24.22-53.869 43.929-75.969l46.309 26.76c27.377-23.434 37.063-29.065 71.039-41.069V44.464a216.79 216.79 0 0 1 87.738 0v53.479c33.978 12.005 43.665 17.637 71.039 41.069l46.309-26.76c19.709 22.099 34.689 47.999 43.929 75.969l-46.329 26.74c6.536 35.426 6.538 46.644 0 82.079l46.329 26.74c-9.24 27.968-24.219 53.868-43.929 75.957zM256 160c-52.935 0-96 43.065-96 96s43.065 96 96 96 96-43.065 96-96-43.065-96-96-96zm0 160c-35.29 0-64-28.71-64-64s28.71-64 64-64 64 28.71 64 64-28.71 64-64 64z" class=""></path>
                    </svg>
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="timeline" role="tabpanel">
                <div class="list-group list-group-accent">
                    <div class="list-group-item list-group-item-accent-secondary bg-light text-center font-weight-bold text-muted text-uppercase c-small">
                        Hoje
                    </div>
                    <div class="list-group-item list-group-item-accent-warning list-group-item-divider">
                        <div class="c-avatar float-right">
                            <img class="c-avatar-img" src="<?= URL_IMG  ?>avatars/7.jpg" alt="user@email.com">
                        </div>
                        <div>
                            Encontrar com
                            <strong>Lucas</strong>
                        </div>
                        <small class="text-muted mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="c-icon">
                                <path fill="currentColor" d="M400 64h-48V12c0-6.6-5.4-12-12-12h-8c-6.6 0-12 5.4-12 12v52H128V12c0-6.6-5.4-12-12-12h-8c-6.6 0-12 5.4-12 12v52H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zM48 96h352c8.8 0 16 7.2 16 16v48H32v-48c0-8.8 7.2-16 16-16zm352 384H48c-8.8 0-16-7.2-16-16V192h384v272c0 8.8-7.2 16-16 16zM148 320h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm96 0h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm96 0h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm-96 96h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm-96 0h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm192 0h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12z" class=""></path>
                            </svg>
                            &nbsp; 1 - 3pm</small><small class="text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="c-icon">
                                <path fill="currentColor" d="M192 96c-52.935 0-96 43.065-96 96s43.065 96 96 96 96-43.065 96-96-43.065-96-96-96zm0 160c-35.29 0-64-28.71-64-64s28.71-64 64-64 64 28.71 64 64-28.71 64-64 64zm0-256C85.961 0 0 85.961 0 192c0 77.413 26.97 99.031 172.268 309.67 9.534 13.772 29.929 13.774 39.465 0C357.03 291.031 384 269.413 384 192 384 85.961 298.039 0 192 0zm0 473.931C52.705 272.488 32 256.494 32 192c0-42.738 16.643-82.917 46.863-113.137S149.262 32 192 32s82.917 16.643 113.137 46.863S352 149.262 352 192c0 64.49-20.692 80.47-160 281.931z" class=""></path>
                            </svg>
                            &nbsp; Palo Alto, CA
                        </small>
                    </div>
                    <div class="list-group-item list-group-item-accent-info">
                        <div class="c-avatar float-right">
                            <img class="c-avatar-img" src="<?= URL_IMG  ?>avatars/4.jpg" alt="user@email.com">
                        </div>
                        <div>
                            Skype com
                            <strong>Megan</strong>
                        </div>
                        <small class="text-muted mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="c-icon">
                                <path fill="currentColor" d="M400 64h-48V12c0-6.6-5.4-12-12-12h-8c-6.6 0-12 5.4-12 12v52H128V12c0-6.6-5.4-12-12-12h-8c-6.6 0-12 5.4-12 12v52H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zM48 96h352c8.8 0 16 7.2 16 16v48H32v-48c0-8.8 7.2-16 16-16zm352 384H48c-8.8 0-16-7.2-16-16V192h384v272c0 8.8-7.2 16-16 16zM148 320h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm96 0h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm96 0h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm-96 96h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm-96 0h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm192 0h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12z" class=""></path>
                            </svg>
                            &nbsp; 4 - 5pm
                        </small>
                        <small class="text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="c-icon">
                                <path fill="currentColor" d="M424.7 299.8c2.9-14 4.7-28.9 4.7-43.8 0-113.5-91.9-205.3-205.3-205.3-14.9 0-29.7 1.7-43.8 4.7C161.3 40.7 137.7 32 112 32 50.2 32 0 82.2 0 144c0 25.7 8.7 49.3 23.3 68.2-2.9 14-4.7 28.9-4.7 43.8 0 113.5 91.9 205.3 205.3 205.3 14.9 0 29.7-1.7 43.8-4.7 19 14.6 42.6 23.3 68.2 23.3 61.8 0 112-50.2 112-112 .1-25.6-8.6-49.2-23.2-68.1zm-194.6 91.5c-65.6 0-120.5-29.2-120.5-65 0-16 9-30.6 29.5-30.6 31.2 0 34.1 44.9 88.1 44.9 25.7 0 42.3-11.4 42.3-26.3 0-18.7-16-21.6-42-28-62.5-15.4-117.8-22-117.8-87.2 0-59.2 58.6-81.1 109.1-81.1 55.1 0 110.8 21.9 110.8 55.4 0 16.9-11.4 31.8-30.3 31.8-28.3 0-29.2-33.5-75-33.5-25.7 0-42 7-42 22.5 0 19.8 20.8 21.8 69.1 33 41.4 9.3 90.7 26.8 90.7 77.6 0 59.1-57.1 86.5-112 86.5z" class=""></path>
                            </svg>
                            &nbsp; On-line
                        </small>
                    </div>
                    <div class="list-group-item list-group-item-accent-secondary bg-light text-center font-weight-bold text-muted text-uppercase c-small">
                        Amanhã
                    </div>
                    <div class="list-group-item list-group-item-accent-danger list-group-item-divider">
                        <div>
                            Novo Projeto -
                            <strong>deadline</strong>
                        </div>
                        <small class="text-muted mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="c-icon">
                                <path fill="currentColor" d="M400 64h-48V12c0-6.6-5.4-12-12-12h-8c-6.6 0-12 5.4-12 12v52H128V12c0-6.6-5.4-12-12-12h-8c-6.6 0-12 5.4-12 12v52H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zM48 96h352c8.8 0 16 7.2 16 16v48H32v-48c0-8.8 7.2-16 16-16zm352 384H48c-8.8 0-16-7.2-16-16V192h384v272c0 8.8-7.2 16-16 16zM148 320h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm96 0h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm96 0h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm-96 96h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm-96 0h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm192 0h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12z" class=""></path>
                            </svg>
                            &nbsp; 10 - 11pm</small><small class="text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="c-icon">
                                <path fill="currentColor" d="M541 229.16l-232.85-190a32.16 32.16 0 0 0-40.38 0L35 229.16a8 8 0 0 0-1.16 11.24l10.1 12.41a8 8 0 0 0 11.2 1.19L96 220.62v243a16 16 0 0 0 16 16h128a16 16 0 0 0 16-16v-128l64 .3V464a16 16 0 0 0 16 16l128-.33a16 16 0 0 0 16-16V220.62L520.86 254a8 8 0 0 0 11.25-1.16l10.1-12.41a8 8 0 0 0-1.21-11.27zm-93.11 218.59h.1l-96 .3V319.88a16.05 16.05 0 0 0-15.95-16l-96-.27a16 16 0 0 0-16.05 16v128.14H128V194.51L288 63.94l160 130.57z" class=""></path>
                            </svg>
                            &nbsp; creativeLabs HQ
                        </small>
                        <div class="c-avatars-stack mt-2">
                            <div class="c-avatar c-avatar-xs"><img class="c-avatar-img" src="<?= URL_IMG  ?>avatars/2.jpg" alt="user@email.com"></div>
                            <div class="c-avatar c-avatar-xs"><img class="c-avatar-img" src="<?= URL_IMG  ?>avatars/3.jpg" alt="user@email.com"></div>
                            <div class="c-avatar c-avatar-xs"><img class="c-avatar-img" src="<?= URL_IMG  ?>avatars/4.jpg" alt="user@email.com"></div>
                            <div class="c-avatar c-avatar-xs"><img class="c-avatar-img" src="<?= URL_IMG  ?>avatars/5.jpg" alt="user@email.com"></div>
                            <div class="c-avatar c-avatar-xs"><img class="c-avatar-img" src="<?= URL_IMG  ?>avatars/6.jpg" alt="user@email.com"></div>
                        </div>
                    </div>
                    <div class="list-group-item list-group-item-accent-success list-group-item-divider">
                        <div>
                            <strong>#10 Startups.Garden</strong>
                            Meetup
                        </div>
                        <small class="text-muted mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="c-icon">
                                <path fill="currentColor" d="M400 64h-48V12c0-6.6-5.4-12-12-12h-8c-6.6 0-12 5.4-12 12v52H128V12c0-6.6-5.4-12-12-12h-8c-6.6 0-12 5.4-12 12v52H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zM48 96h352c8.8 0 16 7.2 16 16v48H32v-48c0-8.8 7.2-16 16-16zm352 384H48c-8.8 0-16-7.2-16-16V192h384v272c0 8.8-7.2 16-16 16zM148 320h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm96 0h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm96 0h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm-96 96h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm-96 0h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm192 0h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12z" class=""></path>
                            </svg>
                            &nbsp; 1 - 3pm
                        </small>
                        <small class="text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="c-icon">
                                <path fill="currentColor" d="M192 96c-52.935 0-96 43.065-96 96s43.065 96 96 96 96-43.065 96-96-43.065-96-96-96zm0 160c-35.29 0-64-28.71-64-64s28.71-64 64-64 64 28.71 64 64-28.71 64-64 64zm0-256C85.961 0 0 85.961 0 192c0 77.413 26.97 99.031 172.268 309.67 9.534 13.772 29.929 13.774 39.465 0C357.03 291.031 384 269.413 384 192 384 85.961 298.039 0 192 0zm0 473.931C52.705 272.488 32 256.494 32 192c0-42.738 16.643-82.917 46.863-113.137S149.262 32 192 32s82.917 16.643 113.137 46.863S352 149.262 352 192c0 64.49-20.692 80.47-160 281.931z" class=""></path>
                            </svg>
                            &nbsp; Palo Alto, CA
                        </small>
                    </div>
                    <div class="list-group-item list-group-item-accent-primary list-group-item-divider">
                        <div>
                            <strong>Team meeting</strong>
                        </div>
                        <small class="text-muted mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="c-icon">
                                <path fill="currentColor" d="M400 64h-48V12c0-6.6-5.4-12-12-12h-8c-6.6 0-12 5.4-12 12v52H128V12c0-6.6-5.4-12-12-12h-8c-6.6 0-12 5.4-12 12v52H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zM48 96h352c8.8 0 16 7.2 16 16v48H32v-48c0-8.8 7.2-16 16-16zm352 384H48c-8.8 0-16-7.2-16-16V192h384v272c0 8.8-7.2 16-16 16zM148 320h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm96 0h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm96 0h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm-96 96h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm-96 0h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm192 0h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12z" class=""></path>
                            </svg>
                            &nbsp; 4 - 6pm
                        </small>
                        <small class="text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="c-icon">
                                <path fill="currentColor" d="M541 229.16l-232.85-190a32.16 32.16 0 0 0-40.38 0L35 229.16a8 8 0 0 0-1.16 11.24l10.1 12.41a8 8 0 0 0 11.2 1.19L96 220.62v243a16 16 0 0 0 16 16h128a16 16 0 0 0 16-16v-128l64 .3V464a16 16 0 0 0 16 16l128-.33a16 16 0 0 0 16-16V220.62L520.86 254a8 8 0 0 0 11.25-1.16l10.1-12.41a8 8 0 0 0-1.21-11.27zm-93.11 218.59h.1l-96 .3V319.88a16.05 16.05 0 0 0-15.95-16l-96-.27a16 16 0 0 0-16.05 16v128.14H128V194.51L288 63.94l160 130.57z" class=""></path>
                            </svg>
                            &nbsp; creativeLabs HQ
                        </small>
                        <div class="c-avatars-stack mt-2">
                            <div class="c-avatar c-avatar-xs"><img class="c-avatar-img" src="<?= URL_IMG  ?>avatars/2.jpg" alt="user@email.com"></div>
                            <div class="c-avatar c-avatar-xs"><img class="c-avatar-img" src="<?= URL_IMG  ?>avatars/3.jpg" alt="user@email.com"></div>
                            <div class="c-avatar c-avatar-xs"><img class="c-avatar-img" src="<?= URL_IMG  ?>avatars/4.jpg" alt="user@email.com"></div>
                            <div class="c-avatar c-avatar-xs"><img class="c-avatar-img" src="<?= URL_IMG  ?>avatars/5.jpg" alt="user@email.com"></div>
                            <div class="c-avatar c-avatar-xs"><img class="c-avatar-img" src="<?= URL_IMG  ?>avatars/6.jpg" alt="user@email.com"></div>
                            <div class="c-avatar c-avatar-xs"><img class="c-avatar-img" src="<?= URL_IMG  ?>avatars/7.jpg" alt="user@email.com"></div>
                            <div class="c-avatar c-avatar-xs"><img class="c-avatar-img" src="<?= URL_IMG  ?>avatars/8.jpg" alt="user@email.com"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane p-3" id="messages" role="tabpanel">
                <div class="message">
                    <div class="py-3 pb-5 mr-3 float-left">
                        <div class="c-avatar">
                            <img class="c-avatar-img" src="<?= URL_IMG  ?>avatars/7.jpg" alt="user@email.com">
                            <span class="c-avatar-status bg-success"></span>
                        </div>
                    </div>
                    <div>
                        <small class="text-muted">Lukasz Holeczek</small>
                        <small class="text-muted float-right mt-1">1:52 PM</small>
                    </div>
                    <div class="text-truncate font-weight-bold">
                        Lorem ipsum dolor sit amet
                    </div>
                    <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt...
                    </small>
                </div>
                <hr>
                <div class="message">
                    <div class="py-3 pb-5 mr-3 float-left">
                        <div class="c-avatar">
                            <img class="c-avatar-img" src="<?= URL_IMG  ?>avatars/7.jpg" alt="user@email.com">
                            <span class="c-avatar-status bg-success"></span>
                        </div>
                    </div>
                    <div>
                        <small class="text-muted">Lukasz Holeczek</small>
                        <small class="text-muted float-right mt-1">1:52 PM</small>
                    </div>
                    <div class="text-truncate font-weight-bold">
                        Lorem ipsum dolor sit amet
                    </div>
                    <small class="text-muted">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt...
                    </small>
                </div>
                <hr>
                <div class="message">
                    <div class="py-3 pb-5 mr-3 float-left">
                        <div class="c-avatar">
                            <img class="c-avatar-img" src="<?= URL_IMG  ?>avatars/7.jpg" alt="user@email.com">
                            <span class="c-avatar-status bg-success"></span>
                        </div>
                    </div>
                    <div>
                        <small class="text-muted">Lukasz Holeczek</small>
                        <small class="text-muted float-right mt-1">1:52 PM</small>
                    </div>
                    <div class="text-truncate font-weight-bold">
                        Lorem ipsum dolor sit amet
                    </div>
                    <small class="text-muted">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt...
                    </small>
                </div>
                <hr>
                <div class="message">
                    <div class="py-3 pb-5 mr-3 float-left">
                        <div class="c-avatar">
                            <img class="c-avatar-img" src="<?= URL_IMG  ?>avatars/7.jpg" alt="user@email.com">
                            <span class="c-avatar-status bg-success"></span>
                        </div>
                    </div>
                    <div>
                        <small class="text-muted">
                            Lukasz Holeczek
                        </small>
                        <small class="text-muted float-right mt-1">
                            1:52 PM
                        </small>
                    </div>
                    <div class="text-truncate font-weight-bold">
                        Lorem ipsum dolor sit amet
                    </div>
                    <small class="text-muted">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt...
                    </small>
                </div>
                <hr>
                <div class="message">
                    <div class="py-3 pb-5 mr-3 float-left">
                        <div class="c-avatar">
                            <img class="c-avatar-img" src="<?= URL_IMG  ?>avatars/7.jpg" alt="user@email.com">
                            <span class="c-avatar-status bg-success"></span>
                        </div>
                    </div>
                    <div>
                        <small class="text-muted">
                            Lukasz Holeczek
                        </small>
                        <small class="text-muted float-right mt-1">
                            1:52 PM
                        </small>
                    </div>
                    <div class="text-truncate font-weight-bold">
                        Lorem ipsum dolor sit amet
                    </div>
                    <small class="text-muted">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt...
                    </small>
                </div>
            </div>
            <div class="tab-pane p-3" id="settings" role="tabpanel">
                <h6>Settings</h6>
                <div class="c-aside-options">
                    <div class="clearfix mt-4"><small><b>Option 1</b></small>
                        <label class="c-switch c-switch-label c-switch-pill c-switch-success c-switch-sm float-right">
                            <input class="c-switch-input" type="checkbox" checked=""><span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                        </label>
                    </div>
                    <div><small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna aliqua.</small></div>
                </div>
                <div class="c-aside-options">
                    <div class="clearfix mt-3"><small><b>Option 2</b></small>
                        <label class="c-switch c-switch-label c-switch-pill c-switch-success c-switch-sm float-right">
                            <input class="c-switch-input" type="checkbox"><span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                        </label>
                    </div>
                    <div><small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna aliqua.</small></div>
                </div>
                <div class="c-aside-options">
                    <div class="clearfix mt-3"><small><b>Option 3</b></small>
                        <label class="c-switch c-switch-label c-switch-pill c-switch-success c-switch-sm float-right">
                            <input class="c-switch-input" type="checkbox"><span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                        </label>
                    </div>
                </div>
                <div class="c-aside-options">
                    <div class="clearfix mt-3"><small><b>Option 4</b></small>
                        <label class="c-switch c-switch-label c-switch-pill c-switch-success c-switch-sm float-right">
                            <input class="c-switch-input" type="checkbox" checked=""><span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                        </label>
                    </div>
                </div>
                <hr>
                <h6>System Utilization</h6>
                <div class="text-uppercase mb-1 mt-4"><small><b>CPU Usage</b></small></div>
                <div class="progress progress-xs">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div><small class="text-muted">348 Processes. 1/4 Cores.</small>
                <div class="text-uppercase mb-1 mt-2"><small><b>Memory Usage</b></small></div>
                <div class="progress progress-xs">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                </div><small class="text-muted">11444GB/16384MB</small>
                <div class="text-uppercase mb-1 mt-2"><small><b>SSD 1 Usage</b></small></div>
                <div class="progress progress-xs">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                </div><small class="text-muted">243GB/256GB</small>
                <div class="text-uppercase mb-1 mt-2"><small><b>SSD 2 Usage</b></small></div>
                <div class="progress progress-xs">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                </div><small class="text-muted">25GB/256GB</small>
            </div>
        </div>
    </div>
    <div class="c-wrapper c-fixed-components">
        <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
            <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="fa-fw">
                    <path fill="currentColor" d="M442 114H6a6 6 0 0 1-6-6V84a6 6 0 0 1 6-6h436a6 6 0 0 1 6 6v24a6 6 0 0 1-6 6zm0 160H6a6 6 0 0 1-6-6v-24a6 6 0 0 1 6-6h436a6 6 0 0 1 6 6v24a6 6 0 0 1-6 6zm0 160H6a6 6 0 0 1-6-6v-24a6 6 0 0 1 6-6h436a6 6 0 0 1 6 6v24a6 6 0 0 1-6 6z" class=""></path>
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
                <li class="c-header-nav-item d-md-down-none mx-2">
                    <a class="c-header-nav-link" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="c-icon">
                            <path fill="currentColor" d="M224 480c-17.66 0-32-14.38-32-32.03h-32c0 35.31 28.72 64.03 64 64.03s64-28.72 64-64.03h-32c0 17.65-14.34 32.03-32 32.03zm209.38-145.19c-27.96-26.62-49.34-54.48-49.34-148.91 0-79.59-63.39-144.5-144.04-152.35V16c0-8.84-7.16-16-16-16s-16 7.16-16 16v17.56C127.35 41.41 63.96 106.31 63.96 185.9c0 94.42-21.39 122.29-49.35 148.91-13.97 13.3-18.38 33.41-11.25 51.23C10.64 404.24 28.16 416 48 416h352c19.84 0 37.36-11.77 44.64-29.97 7.13-17.82 2.71-37.92-11.26-51.22zM400 384H48c-14.23 0-21.34-16.47-11.32-26.01 34.86-33.19 59.28-70.34 59.28-172.08C95.96 118.53 153.23 64 224 64c70.76 0 128.04 54.52 128.04 121.9 0 101.35 24.21 138.7 59.28 172.08C421.38 367.57 414.17 384 400 384z" class=""></path>
                        </svg>
                    </a>
                </li>
                <li class="c-header-nav-item d-md-down-none mx-2">
                    <a class="c-header-nav-link" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="c-icon">
                            <path fill="currentColor" d="M88 56H40a16 16 0 0 0-16 16v48a16 16 0 0 0 16 16h48a16 16 0 0 0 16-16V72a16 16 0 0 0-16-16zm0 160H40a16 16 0 0 0-16 16v48a16 16 0 0 0 16 16h48a16 16 0 0 0 16-16v-48a16 16 0 0 0-16-16zm0 160H40a16 16 0 0 0-16 16v48a16 16 0 0 0 16 16h48a16 16 0 0 0 16-16v-48a16 16 0 0 0-16-16zm416 24H168a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h336a8 8 0 0 0 8-8v-16a8 8 0 0 0-8-8zm0-320H168a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h336a8 8 0 0 0 8-8V88a8 8 0 0 0-8-8zm0 160H168a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h336a8 8 0 0 0 8-8v-16a8 8 0 0 0-8-8z" class=""></path>
                        </svg>
                    </a>
                </li>
                <li class="c-header-nav-item d-md-down-none mx-2">
                    <a class="c-header-nav-link" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="c-icon">
                            <path fill="currentColor" d="M352 248v-16c0-4.42-3.58-8-8-8H168c-4.42 0-8 3.58-8 8v16c0 4.42 3.58 8 8 8h176c4.42 0 8-3.58 8-8zm-184-56h176c4.42 0 8-3.58 8-8v-16c0-4.42-3.58-8-8-8H168c-4.42 0-8 3.58-8 8v16c0 4.42 3.58 8 8 8zm326.59-27.48c-1.98-1.63-22.19-17.91-46.59-37.53V96c0-17.67-14.33-32-32-32h-46.47c-4.13-3.31-7.71-6.16-10.2-8.14C337.23 38.19 299.44 0 256 0c-43.21 0-80.64 37.72-103.34 55.86-2.53 2.01-6.1 4.87-10.2 8.14H96c-17.67 0-32 14.33-32 32v30.98c-24.52 19.71-44.75 36.01-46.48 37.43A48.002 48.002 0 0 0 0 201.48V464c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V201.51c0-14.31-6.38-27.88-17.41-36.99zM256 32c21.77 0 44.64 16.72 63.14 32H192.9c18.53-15.27 41.42-32 63.1-32zM96 96h320v173.35c-32.33 26-65.3 52.44-86.59 69.34-16.85 13.43-50.19 45.68-73.41 45.31-23.21.38-56.56-31.88-73.41-45.32-21.29-16.9-54.24-43.33-86.59-69.34V96zM32 201.48c0-4.8 2.13-9.31 5.84-12.36 1.24-1.02 11.62-9.38 26.16-21.08v75.55c-11.53-9.28-22.51-18.13-32-25.78v-16.33zM480 464c0 8.82-7.18 16-16 16H48c-8.82 0-16-7.18-16-16V258.91c42.75 34.44 99.31 79.92 130.68 104.82 20.49 16.36 56.74 52.53 93.32 52.26 36.45.26 72.27-35.46 93.31-52.26C380.72 338.8 437.24 293.34 480 258.9V464zm0-246.19c-9.62 7.75-20.27 16.34-32 25.79v-75.54c14.44 11.62 24.8 19.97 26.2 21.12 3.69 3.05 5.8 7.54 5.8 12.33v16.3z" class=""></path>
                        </svg>
                    </a>
                </li>
                <li class="c-header-nav-item dropdown"><a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <div class="c-avatar">
                            <img class="c-avatar-img" src="<?= !empty($usuario_logado->getImagem()->getNomeImagem()) && file_exists(PATH_IMG . 'usuarios/thumbs/' . $usuario_logado->getImagem()->getNomeImagem()) ? URL_IMG . 'usuarios/thumbs/' . $usuario_logado->getImagem()->getNomeImagem() . '?random =' . rand(1, 100) : URL_IMG . 'usuarios/default-avatar.png' ?>" alt="<?= $usuario_logado->getNome() ?>">
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right pt-0">
                        <div class="dropdown-header bg-light py-2">
                            <strong>Account</strong>
                        </div>
                        <a class="dropdown-item" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="c-icon mr-2">
                                <path fill="currentColor" d="M224 480c-17.66 0-32-14.38-32-32.03h-32c0 35.31 28.72 64.03 64 64.03s64-28.72 64-64.03h-32c0 17.65-14.34 32.03-32 32.03zm209.38-145.19c-27.96-26.62-49.34-54.48-49.34-148.91 0-79.59-63.39-144.5-144.04-152.35V16c0-8.84-7.16-16-16-16s-16 7.16-16 16v17.56C127.35 41.41 63.96 106.31 63.96 185.9c0 94.42-21.39 122.29-49.35 148.91-13.97 13.3-18.38 33.41-11.25 51.23C10.64 404.24 28.16 416 48 416h352c19.84 0 37.36-11.77 44.64-29.97 7.13-17.82 2.71-37.92-11.26-51.22zM400 384H48c-14.23 0-21.34-16.47-11.32-26.01 34.86-33.19 59.28-70.34 59.28-172.08C95.96 118.53 153.23 64 224 64c70.76 0 128.04 54.52 128.04 121.9 0 101.35 24.21 138.7 59.28 172.08C421.38 367.57 414.17 384 400 384z" class=""></path>
                            </svg>
                            Updates<span class="badge badge-info ml-auto">42</span>
                        </a>
                        <a class="dropdown-item" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="c-icon mr-2">
                                <path fill="currentColor" d="M352 248v-16c0-4.42-3.58-8-8-8H168c-4.42 0-8 3.58-8 8v16c0 4.42 3.58 8 8 8h176c4.42 0 8-3.58 8-8zm-184-56h176c4.42 0 8-3.58 8-8v-16c0-4.42-3.58-8-8-8H168c-4.42 0-8 3.58-8 8v16c0 4.42 3.58 8 8 8zm326.59-27.48c-1.98-1.63-22.19-17.91-46.59-37.53V96c0-17.67-14.33-32-32-32h-46.47c-4.13-3.31-7.71-6.16-10.2-8.14C337.23 38.19 299.44 0 256 0c-43.21 0-80.64 37.72-103.34 55.86-2.53 2.01-6.1 4.87-10.2 8.14H96c-17.67 0-32 14.33-32 32v30.98c-24.52 19.71-44.75 36.01-46.48 37.43A48.002 48.002 0 0 0 0 201.48V464c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V201.51c0-14.31-6.38-27.88-17.41-36.99zM256 32c21.77 0 44.64 16.72 63.14 32H192.9c18.53-15.27 41.42-32 63.1-32zM96 96h320v173.35c-32.33 26-65.3 52.44-86.59 69.34-16.85 13.43-50.19 45.68-73.41 45.31-23.21.38-56.56-31.88-73.41-45.32-21.29-16.9-54.24-43.33-86.59-69.34V96zM32 201.48c0-4.8 2.13-9.31 5.84-12.36 1.24-1.02 11.62-9.38 26.16-21.08v75.55c-11.53-9.28-22.51-18.13-32-25.78v-16.33zM480 464c0 8.82-7.18 16-16 16H48c-8.82 0-16-7.18-16-16V258.91c42.75 34.44 99.31 79.92 130.68 104.82 20.49 16.36 56.74 52.53 93.32 52.26 36.45.26 72.27-35.46 93.31-52.26C380.72 338.8 437.24 293.34 480 258.9V464zm0-246.19c-9.62 7.75-20.27 16.34-32 25.79v-75.54c14.44 11.62 24.8 19.97 26.2 21.12 3.69 3.05 5.8 7.54 5.8 12.33v16.3z" class=""></path>
                            </svg>
                            Messages<span class="badge badge-success ml-auto">42</span>
                        </a>
                        <a class="dropdown-item" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="c-icon mr-2">
                                <path fill="currentColor" d="M300.8 203.9L290.7 128H328c13.2 0 24-10.8 24-24V24c0-13.2-10.8-24-24-24H56C42.8 0 32 10.8 32 24v80c0 13.2 10.8 24 24 24h37.3l-10.1 75.9C34.9 231.5 0 278.4 0 335.2c0 8.8 7.2 16 16 16h160V472c0 .7.1 1.3.2 1.9l8 32c2 8 13.5 8.1 15.5 0l8-32c.2-.6.2-1.3.2-1.9V351.2h160c8.8 0 16-7.2 16-16 .1-56.8-34.8-103.7-83.1-131.3zM33.3 319.2c6.8-42.9 39.6-76.4 79.5-94.5L128 96H64V32h256v64h-64l15.3 128.8c40 18.2 72.7 51.8 79.5 94.5H33.3z" class=""></path>
                            </svg>
                            Tasks<span class="badge badge-danger ml-auto">42</span>
                        </a>
                        <a class="dropdown-item" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="c-icon mr-2">
                                <path fill="currentColor" d="M448 0H64C28.7 0 0 28.7 0 64v288c0 35.3 28.7 64 64 64h96v84c0 7.1 5.8 12 12 12 2.4 0 4.9-.7 7.1-2.4L304 416h144c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64zm32 352c0 17.6-14.4 32-32 32H293.3l-8.5 6.4L192 460v-76H64c-17.6 0-32-14.4-32-32V64c0-17.6 14.4-32 32-32h384c17.6 0 32 14.4 32 32v288zM280 240H136c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h144c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8zm96-96H136c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h240c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8z" class=""></path>
                            </svg>
                            Comments<span class="badge badge-warning ml-auto">42</span>
                        </a>
                        <div class="dropdown-header bg-light py-2"><strong>Settings</strong></div>
                        <a class="dropdown-item" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="c-icon mr-2">
                                <path fill="currentColor" d="M256 32c61.8 0 112 50.2 112 112s-50.2 112-112 112-112-50.2-112-112S194.2 32 256 32m128 320c52.9 0 96 43.1 96 96v32H32v-32c0-52.9 43.1-96 96-96 85 0 67.3 16 128 16 60.9 0 42.9-16 128-16M256 0c-79.5 0-144 64.5-144 144s64.5 144 144 144 144-64.5 144-144S335.5 0 256 0zm128 320c-92.4 0-71 16-128 16-56.8 0-35.7-16-128-16C57.3 320 0 377.3 0 448v32c0 17.7 14.3 32 32 32h448c17.7 0 32-14.3 32-32v-32c0-70.7-57.3-128-128-128z" class=""></path>
                            </svg>
                            Profile
                        </a>
                        <a class="dropdown-item" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="c-icon mr-2">
                                <path fill="currentColor" d="M482.696 299.276l-32.61-18.827a195.168 195.168 0 0 0 0-48.899l32.61-18.827c9.576-5.528 14.195-16.902 11.046-27.501-11.214-37.749-31.175-71.728-57.535-99.595-7.634-8.07-19.817-9.836-29.437-4.282l-32.562 18.798a194.125 194.125 0 0 0-42.339-24.48V38.049c0-11.13-7.652-20.804-18.484-23.367-37.644-8.909-77.118-8.91-114.77 0-10.831 2.563-18.484 12.236-18.484 23.367v37.614a194.101 194.101 0 0 0-42.339 24.48L105.23 81.345c-9.621-5.554-21.804-3.788-29.437 4.282-26.36 27.867-46.321 61.847-57.535 99.595-3.149 10.599 1.47 21.972 11.046 27.501l32.61 18.827a195.168 195.168 0 0 0 0 48.899l-32.61 18.827c-9.576 5.528-14.195 16.902-11.046 27.501 11.214 37.748 31.175 71.728 57.535 99.595 7.634 8.07 19.817 9.836 29.437 4.283l32.562-18.798a194.08 194.08 0 0 0 42.339 24.479v37.614c0 11.13 7.652 20.804 18.484 23.367 37.645 8.909 77.118 8.91 114.77 0 10.831-2.563 18.484-12.236 18.484-23.367v-37.614a194.138 194.138 0 0 0 42.339-24.479l32.562 18.798c9.62 5.554 21.803 3.788 29.437-4.283 26.36-27.867 46.321-61.847 57.535-99.595 3.149-10.599-1.47-21.972-11.046-27.501zm-65.479 100.461l-46.309-26.74c-26.988 23.071-36.559 28.876-71.039 41.059v53.479a217.145 217.145 0 0 1-87.738 0v-53.479c-33.621-11.879-43.355-17.395-71.039-41.059l-46.309 26.74c-19.71-22.09-34.689-47.989-43.929-75.958l46.329-26.74c-6.535-35.417-6.538-46.644 0-82.079l-46.329-26.74c9.24-27.969 24.22-53.869 43.929-75.969l46.309 26.76c27.377-23.434 37.063-29.065 71.039-41.069V44.464a216.79 216.79 0 0 1 87.738 0v53.479c33.978 12.005 43.665 17.637 71.039 41.069l46.309-26.76c19.709 22.099 34.689 47.999 43.929 75.969l-46.329 26.74c6.536 35.426 6.538 46.644 0 82.079l46.329 26.74c-9.24 27.968-24.219 53.868-43.929 75.957zM256 160c-52.935 0-96 43.065-96 96s43.065 96 96 96 96-43.065 96-96-43.065-96-96-96zm0 160c-35.29 0-64-28.71-64-64s28.71-64 64-64 64 28.71 64 64-28.71 64-64 64z" class=""></path>
                            </svg>
                            Settings
                        </a>
                        <a class="dropdown-item" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="c-icon mr-2">
                                <path fill="currentColor" d="M528 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h480c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zM48 64h480c8.8 0 16 7.2 16 16v48H32V80c0-8.8 7.2-16 16-16zm480 384H48c-8.8 0-16-7.2-16-16V224h512v208c0 8.8-7.2 16-16 16zm-336-84v8c0 6.6-5.4 12-12 12h-72c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h72c6.6 0 12 5.4 12 12zm192 0v8c0 6.6-5.4 12-12 12H236c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h136c6.6 0 12 5.4 12 12z" class=""></path>
                            </svg>
                            Payments<span class="badge badge-secondary ml-auto">42</span>
                        </a>
                        <a class="dropdown-item" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="c-icon mr-2">
                                <path fill="currentColor" d="M136 320h-16c-4.4 0-8 3.6-8 8v96c0 4.4 3.6 8 8 8h16c4.4 0 8-3.6 8-8v-96c0-4.4-3.6-8-8-8zm64-96h-16c-4.4 0-8 3.6-8 8v192c0 4.4 3.6 8 8 8h16c4.4 0 8-3.6 8-8V232c0-4.4-3.6-8-8-8zm40 72v128c0 4.4 3.6 8 8 8h16c4.4 0 8-3.6 8-8V296c0-4.4-3.6-8-8-8h-16c-4.4 0-8 3.6-8 8zM369.9 97.98L286.02 14.1c-9-9-21.2-14.1-33.89-14.1H47.99C21.5.1 0 21.6 0 48.09v415.92C0 490.5 21.5 512 47.99 512h288.02c26.49 0 47.99-21.5 47.99-47.99V131.97c0-12.69-5.1-24.99-14.1-33.99zM256.03 32.59c2.8.7 5.3 2.1 7.4 4.2l83.88 83.88c2.1 2.1 3.5 4.6 4.2 7.4h-95.48V32.59zm95.98 431.42c0 8.8-7.2 16-16 16H47.99c-8.8 0-16-7.2-16-16V48.09c0-8.8 7.2-16.09 16-16.09h176.04v104.07c0 13.3 10.7 23.93 24 23.93h103.98v304.01z" class=""></path>
                            </svg>
                            Projects<span class="badge badge-primary ml-auto">42</span>
                        </a>
                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="c-icon mr-2">
                                <path fill="currentColor" d="M224 420c-11 0-20-9-20-20v-64c0-11 9-20 20-20s20 9 20 20v64c0 11-9 20-20 20zm224-148v192c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V272c0-26.5 21.5-48 48-48h16v-64C64 71.6 136-.3 224.5 0 312.9.3 384 73.1 384 161.5V224h16c26.5 0 48 21.5 48 48zM96 224h256v-64c0-70.6-57.4-128-128-128S96 89.4 96 160v64zm320 240V272c0-8.8-7.2-16-16-16H48c-8.8 0-16 7.2-16 16v192c0 8.8 7.2 16 16 16h352c8.8 0 16-7.2 16-16z" class=""></path>
                            </svg>
                            Lock Account
                        </a>
                        <a class="dropdown-item" href="<?= URL ?>logout">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="c-icon mr-2">
                                <path fill="currentColor" d="M160 217.1c0-8.8 7.2-16 16-16h144v-93.9c0-7.1 8.6-10.7 13.6-5.7l141.6 143.1c6.3 6.3 6.3 16.4 0 22.7L333.6 410.4c-5 5-13.6 1.5-13.6-5.7v-93.9H176c-8.8 0-16-7.2-16-16v-77.7m-32 0v77.7c0 26.5 21.5 48 48 48h112v61.9c0 35.5 43 53.5 68.2 28.3l141.7-143c18.8-18.8 18.8-49.2 0-68L356.2 78.9c-25.1-25.1-68.2-7.3-68.2 28.3v61.9H176c-26.5 0-48 21.6-48 48zM0 112v288c0 26.5 21.5 48 48 48h132c6.6 0 12-5.4 12-12v-8c0-6.6-5.4-12-12-12H48c-8.8 0-16-7.2-16-16V112c0-8.8 7.2-16 16-16h132c6.6 0 12-5.4 12-12v-8c0-6.6-5.4-12-12-12H48C21.5 64 0 85.5 0 112z" class=""></path>
                            </svg>
                            Logout
                        </a>
                    </div>
                </li>
                <button class="c-header-toggler c-class-toggler mfe-md-3" type="button" data-target="#aside" data-class="c-sidebar-show">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="fa-fw" style="width: 1.05em;">
                        <path fill="currentColor" d="M504 384H192v-40c0-13.3-10.7-24-24-24h-48c-13.3 0-24 10.7-24 24v40H8c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h88v40c0 13.3 10.7 24 24 24h48c13.3 0 24-10.7 24-24v-40h312c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8zm-344 64h-32v-96h32v96zM504 96H256V56c0-13.3-10.7-24-24-24h-48c-13.3 0-24 10.7-24 24v40H8c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h152v40c0 13.3 10.7 24 24 24h48c13.3 0 24-10.7 24-24v-40h248c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8zm-280 64h-32V64h32v96zm280 80h-88v-40c0-13.3-10.7-24-24-24h-48c-13.3 0-24 10.7-24 24v40H8c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h312v40c0 13.3 10.7 24 24 24h48c13.3 0 24-10.7 24-24v-40h88c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8zm-120 64h-32v-96h32v96z" class=""></path>
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