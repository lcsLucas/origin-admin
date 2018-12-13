<?php

namespace App\controllers;

use ProjetoMvc\render\Action;
use App\model\Usuario;
use App\model\Retorno;

if (! defined('ABSPATH')){
    header("Location: /");
    exit();
}

class HomeController extends Action
{
    public function __construct()
    {
        parent::__construct();
        /**
         * caminho com o arquivo do layout padrão que todasas paginas dessa controller poderá usar
         */
        $this->layoutPadrao = PATH_VIEWS."shared/layoutPadrao";
    }

    /**
     * Chama a view de tela principal.
     */
    public function pageIndex()
    {
		$this->dados->title = "Página Principal";
		$this->render('index');
    }

    /**
     * chama a view dashboard, passando o titulo da página
     * @return void
     */
    public function pageDashboard()
    {
        $this->layoutPadrao = PATH_VIEWS."shared/admin/layoutPadraoAdmin";
        $this->dados->title = "Dashboard";
        $this->css = "partial-dashboard";
        $this->render('dashboard');
    }

    /**
     * chama a view de pagina nao encontrada
     */
    public function pageError404()
    {
            $this->dados->title = "Página Não Encontrada";
            http_response_code(404);
            $this->render('error404');
    }

    public function pageRecuperarSenha()
    {
            $this->dados->title = "Recuperar Senha";
            $this->css = "partial-login";
            $this->render('recuperar-senha');
    }

    public function pageLogin()
    {
        if (isset($_SESSION['usuario-codigo'])) :
            header('Location: /Area-Administrativa/Dashboard/');
            exit();
        else :
            $this->dados->title = "Área Restrita";
            $this->css = "partial-login";
            $this->render('login');
        endif;
    }

    public function login()
    {
        if (filter_has_var(INPUT_POST, 'btnLogar')) :
            $usuario = trim(filter_input(INPUT_POST, 'txtUsuario', FILTER_SANITIZE_SPECIAL_CHARS));
            $senha = trim(filter_input(INPUT_POST, 'txtSenha', FILTER_SANITIZE_SPECIAL_CHARS));
            $token = trim(filter_input(INPUT_POST, 'txtToken', FILTER_SANITIZE_SPECIAL_CHARS));

            $usu = new Usuario();
            $retorno = new Retorno();

            if (!empty($usu->login($usuario, $senha, $token))) :
                $retorno->setRetorno(0,1,"OK");
                echo json_encode($retorno->toArray());
            else :
                $retorno->setRetorno($usu->getRetorno()->getCodigo(),$usu->getRetorno()->getTipo(),$usu->getRetorno()->getMensagem());
                echo json_encode($retorno->toArray());
            endif;
        else :
            header('Location: /Area-Administrativa/Fazer-Login/');
            exit();
        endif;
    }

    public function logout()
    {
        if (isset($_SESSION['usuario-codigo'])) :
            unset($_SESSION['usuario-codigo'], $_SESSION['usuario-nome'], $_SESSION['usuario-status'], $_SESSION['usuario-token']);
        endif;

        header('Location: /Area-Administrativa/Fazer-Login/');
        exit();
    }
}
