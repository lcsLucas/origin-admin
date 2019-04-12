<?php

namespace App\controllers;
use App\model\Usuario;

if (! defined('ABSPATH')){
    header("Location: /");
    exit();
}

abstract class MiddlewarePrincipal {

    public static function autenticacao($uri) {

        // fazer a autenticação de usuário nessa url, e se tiver autenticado carregar a foto e o nome (se necessario)

        return true;
    }

}