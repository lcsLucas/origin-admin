<?php

namespace App\controllers;

use ProjetoMvc\render\Action;
use App\model\Usuario;
use App\model\Data_Validator;

if (! defined('ABSPATH')){
    header("Location: /");
    exit();
}

class UsuarioController extends Action
{

    public function __construct()
    {
        parent::__construct();
        /**
         * caminho com o arquivo do layout padrão que todas as paginas dessa controller poderá usar
         */
        $this->layoutPadrao = PATH_VIEWS."shared/layoutPadrao";
    }

    /**
     * chama a view de alterar perfil, passando o titulo da página
     * @return void
     */
    public function pageAlterarPerfil()
    {
        $this->dados->title = "Alterar Perfil";
        $this->render('alterar-perfil.php');
    }

}