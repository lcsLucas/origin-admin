<?php

namespace App\controllers;
use App\model\Menu;

if (! defined('ABSPATH'))
    die;


abstract class MiddleWarePrincipal {

    public static function autenticacao($uri) {

        // fazer a autenticação de usuário nessa url, e se tiver autenticado carregar a foto e o nome (se necessario)

        return empty($_SESSION['_logado']) ? false : true;
    }

}