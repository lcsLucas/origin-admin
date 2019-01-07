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
     * Method GET
     */
    public function pageAlterarPerfil()
    {
        $usu = new Usuario();
        $usu->setId($_SESSION["_idusuario"]);
        $usu->carregarInformacoes();

        $this->dados->informacoes = $usu;
        $this->dados->input_drop = true;
        $this->dados->validation = true;
        $this->dados->title = "Alterar Perfil";
        $this->render('alterar-perfil.php');
    }

    public function requestAlterarPerfil() {

        /*header("Location: " . $_SERVER["REQUEST_URI"]);
        exit();*/

    }

}