<?php

namespace App\controllers;

use ProjetoMvc\render\Action;
use App\model\Usuario;
use App\model\Data_Validator;

if (! defined('ABSPATH'))
    die;

class HomeController extends Action
{
    public function __construct()
    {
        parent::__construct();
        /**
         * caminho com o arquivo do layout padrão que todasas paginas dessa controller poderá usar
         */
        $this->layoutPadrao = PATH_VIEWS.'shared/layoutPadrao';
    }

    /**
     * Chama a view de tela principal.
     */
    public function pageIndex()
    {
        if (isset($_SESSION['_idusuario'])) :
            header('Location: '. URL .'dashboard');
        else :
            $this->dados->title = 'Página de login';
            header('Location: '. URL .'login');
        endif;
        exit();
    }

    /**
     * chama a view dashboard, passando o titulo da página
     * @return void
     */
    public function pageDashboard()
    {
        $this->dados->title = 'Dashboard';
        $this->render('dashboard.php');
    }

    /**
     * chama a view de pagina nao encontrada
     */
    public function pageError404()
    {
            $this->dados->title = 'Página Não Encontrada';
            http_response_code(404);
            $this->render('error404.html');
    }

    public function pageLogin() {

        if (isset($_SESSION['_idusuario'])) {
            header('Location: '. URL .'dashboard');
            exit();
        } else {
            $this->dados->title = 'Página de login';
            $this->render('login.php', false);
        }

    }

    public function login()
    {
        $usu = new Usuario();
        $validate = new Data_Validator();

        if (filter_has_var(INPUT_POST, 'btnLogar')) :
            $login = trim(filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS));
            $senha = trim(filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS));
            $token = trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_SPECIAL_CHARS));

            $validate->define_pattern('erro_');
            $validate
                ->set('login', $login)->is_required()
                ->set('senha', $senha)->is_required()
                ->set('token', $token)->is_required();

            if ($validate->validate()) {

                if (password_verify(TOKEN_SESSAO, $token)) {

                    if (filter_var($login, FILTER_VALIDATE_EMAIL))
                        $usu->setEmail($login);
                    else
                        $usu->setLogin($login);

                    $usu->setSenha($senha);

                    if (!empty($usu->login())) {

                        $this->setRetorno('Logado com sucesso, aguarde estamos te direcionando...', true, true);
                        $this->setExtra(
                            array(
                                'url_direcionar' => URL . 'dashboard'
                            )
                        );

                    } else if($usu->getRetorno()['exibir']) {
                        $this->setRetorno($usu->getRetorno()['mensagem'], $usu->getRetorno()['exibir'], $usu->getRetorno()['status']);
                    } else {
                        $this->setRetorno('Não foi possível fazer o login', true, false);
                    }

                } else {
                    $this->setRetorno('Token de autenticação inválido', true, false);
                }

            } else {

                $array_erros = $validate->get_errors();
                $array_erro = array_shift($array_erros);
                $erro = array_shift($array_erro);
                $this->setRetorno($erro, true, false);
            }

            echo json_encode($this->getRetorno(), JSON_FORCE_OBJECT);

        else :
            header('Location: '. URL .'login');
            exit();
        endif;
    }

    public function logout()
    {
        session_destroy();
        header('Location: ' . URL);
        exit();
    }
}
