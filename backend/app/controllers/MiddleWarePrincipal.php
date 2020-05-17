<?php

namespace App\controllers;
use App\model\Menu;
use App\model\Usuario;

if (! defined('ABSPATH'))
    die;


abstract class MiddleWarePrincipal {

    public static function autenticacao($uri) {

        if (!empty($_SESSION['_logado']))
            return true;
		elseif(filter_has_var(INPUT_COOKIE, '_usulogado')) {
			$logado = filter_input(INPUT_COOKIE, '_usulogado', FILTER_SANITIZE_SPECIAL_CHARS);

			if (!empty($logado)) {
				$usu = new Usuario();

				if (filter_var($logado, FILTER_VALIDATE_EMAIL))
					$usu->setEmail($logado);
				else
					$usu->setLogin($logado);

				if (!empty($usu->login_logado())) {
					return true;
				}

			}

		}

        return false;
    }

}