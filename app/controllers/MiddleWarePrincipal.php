<?php

namespace App\controllers;
use App\model\Menu;

if (! defined('ABSPATH'))
    die;


abstract class MiddleWarePrincipal {

    public static function autenticacao($uri) {

        if (!empty($_SESSION['_logado']))
            return true;

        return false;
    }

}