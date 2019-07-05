<?php

namespace App\controllers;

use App\model\Usuario;
use ProjetoMvc\render\Action;
use App\model\TipoUsuario;
use App\model\Menu;
use App\model\Data_Validator;

if (! defined('ABSPATH'))
    die;

class TipoUsuarioController extends Action
{

    public function __construct()
    {
        parent::__construct();
        /**
         * caminho com o arquivo do layout padrão que todas as paginas dessa controller poderá usar
         */
        $this->layoutPadrao = PATH_VIEWS.'shared/layoutPadrao';
    }

    public function pageTiposUsuarios() {
        $tipo = new TipoUsuario();
        $menus = new Menu();

        $pagina_atual = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
        $pagina_atual = empty($pagina_atual) ? 1 : $pagina_atual;

        $qtde_registros = 5;

        /*definição de paginação*/

        // Constantes de configuração
            $this->dados->paginacao = new \stdClass;
            $this->dados->paginacao->registros_paginas = $qtde_registros;
            $this->dados->paginacao->pagina_atual = $pagina_atual;
            $this->dados->paginacao->range_paginas = 2; // quantas paginas será exibida ao redor da página atual

        // Calcula a linha inicial da consulta */
            $inicio_registro = ($pagina_atual -1) * $qtde_registros;


        // Consulta dos registros utilizando o LIMIT
            $this->dados->registros = $tipo->paginacao($inicio_registro, $qtde_registros);
        // Total de registros
            $this->dados->paginacao->total_registros = $tipo->totalRegistros();

        /***/
        $tipo->carregarTipoUsuario();
        $this->dados->tipo_usuario = $tipo->getId();

        if (!empty($this->dados->editar))
        	$this->dados->todosMenus = $menus->listarMenus(1, $this->dados->id);
        else
        	$this->dados->todosMenus = $menus->listarMenus(1);

        $this->dados->title = 'Gerenciar Tipos de Usuarios';
        $this->dados->validation = true;
        $this->render('gerenciar-tipos-usuarios.php');
    }

    public function pageTiposUsuariosEdit() {
        $tipo = new TipoUsuario();

        $url = $_SERVER['REQUEST_URI'];

        //Remove as barras e também remove URI caso tenha
        $url = trim($url,'/');
        if(SUBDOMINIO)
            $url = trim(substr($url, strlen(URI)),'/');

        if ('.php' === substr($url,-4))
            $url = substr($url,0,-4);

        $pos = strripos($url, '/');
        $valor = substr($url,$pos+1);

        $pos = strpos($valor,'?');
        if (!empty($pos)) {
            $valor = substr($valor, 0, $pos);
        }

        $id = filter_var($valor, FILTER_VALIDATE_INT);

        if (!empty($id)) {
            $tipo->setId($id);

            if ($tipo->carregar()) {

                $this->dados->editar = true;
                $this->dados->id = $id;
                $this->dados->nome = $tipo->getNome();
                $carregado = true;
            }

        }

        if (!empty($carregado))
            $this->pageTiposUsuarios();
        else {
            header('Location: ' . URL . 'usuarios/gerenciar-tipos-usuarios');
            die();
        }
    }

    public function requestTiposUsuarios() {

        $validate = new Data_Validator();
        $tipo = new TipoUsuario();

        $nome = trim(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS));
        $token = trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_SPECIAL_CHARS));

		if (filter_has_var(INPUT_POST, 'menu')) {
			$array_menus = array_filter($_POST['menu']);
			$array_menus = filter_var_array($array_menus, FILTER_VALIDATE_INT);

			$tipo->setMenus($array_menus);
		}

        $validate->define_pattern('erro_');
        $validate
            ->set('nome', $nome)->is_required();

        if ($validate->validate()) {

            if (password_verify(TOKEN_SESSAO, $token)) {

                $tipo->setNome($nome);

                if ($tipo->cadastrar())
                    $this->setRetorno('Novo tipo de usuário foi cadastrado com sucesso', true, true);
                else if($tipo->getRetorno()['exibir'])
                    $this->setRetorno($tipo->getRetorno()['mensagem'], $tipo->getRetorno()['exibir'], $tipo->getRetorno()['status']);
                else
                    $this->setRetorno('Não foi possível cadastrar o novo tipo de usuário, tente novamente', true, false);

            } else
                $this->setRetorno('Token de autenticação inválido, recarregue a página e tente novamente', true, false);

        } else {
            $array_erros = $validate->get_errors();
            $array_erro = array_shift($array_erros);
            $erro = array_shift($array_erro);
            $this->setRetorno($erro, true, false);
        }

        $this->dados->retorno = $this->getRetorno();
        $this->pageTiposUsuarios();
    }

    public function requestTiposUsuariosEdit() {

        $url = $_SERVER['REQUEST_URI'];

        //Remove as barras e também remove URI caso tenha
        $url = trim($url,'/');
        if(SUBDOMINIO)
            $url = trim(substr($url, strlen(URI)),'/');

        if ('.php' === substr($url,-4))
            $url = substr($url,0,-4);

        $pos = strripos($url, '/');
        $valor = substr($url,$pos+1);

        $pos = strpos($valor,'?');
        if (!empty($pos)) {
            $valor = substr($valor, 0, $pos);
        }

        $id = filter_var($valor, FILTER_VALIDATE_INT);

        if (!empty($id)) {

            $validate = new Data_Validator();
            $tipo = new TipoUsuario();

            $tipo->setId($id);
            $nome = trim(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS));
            $token = trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_SPECIAL_CHARS));

            $validate->define_pattern('erro_');
            $validate
                ->set('nome', $nome)->is_required();

            if ($validate->validate()) {

                if (password_verify(TOKEN_SESSAO, $token)) {

                    $tipo->setNome($nome);

                    if ($tipo->alterar())
                        $this->setRetorno('Tipo de usuários foi alterado com sucesso', true, true);
                    else if($tipo->getRetorno()['exibir'])
                        $this->setRetorno($tipo->getRetorno()['mensagem'], $tipo->getRetorno()['exibir'], $tipo->getRetorno()['status']);
                    else
                        $this->setRetorno('Não foi possível alterar esse tipo de usuários, tente novamente', true, false);

                } else
                    $this->setRetorno('Token de autenticação inválido, recarregue a página e tente novamente', true, false);

            } else {
                $array_erros = $validate->get_errors();
                $array_erro = array_shift($array_erros);
                $erro = array_shift($array_erro);
                $this->setRetorno($erro, true, false);
            }

        } else
            $this->setRetorno('Não foi possível alterar esse tipo de usuários, tente novamente', true, false);

        $this->dados->retorno = $this->getRetorno();
        $this->pageTiposUsuariosEdit();
    }

    public function requestAlterarStatus() {
        $id = filter_input(INPUT_POST, 'codigo-acao', FILTER_VALIDATE_INT);
        $status = !filter_has_var(INPUT_POST, 'alterar-status') ? '1' : '0';

        if (!empty($id)) {

            $tipo = new TipoUsuario();
            $tipo->setId($id);
            $tipo->setAtivo($status);

            if (!empty($tipo->alterarStatus()))
                $retorno = array('status' => $status ? true : false, 'msg' => '', 'erro' => false);
            else
                $retorno = array('status' => !$status ? true : false, 'msg' => 'Não foi possível alterar o status', 'erro' => true);

        } else
            $retorno = array('status' => !$status ? true : false, 'msg' => 'Não foi possível alterar o status', 'erro' => true);

        echo json_encode($retorno, JSON_FORCE_OBJECT);
    }

    public function requestDeletar() {
        $id = filter_input(INPUT_POST, 'codigo-acao', FILTER_VALIDATE_INT);
        $senha = trim(filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS));
        $token = trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_SPECIAL_CHARS));

        $validate = new Data_Validator();
        $usuario = new Usuario();
        $tipo = new TipoUsuario();

        $validate->define_pattern('erro_');
        $validate
            ->set('id', $id)->is_required()
            ->set('senha', $senha)->is_required()
            ->set('token', $token)->is_required();

        if ($validate->validate()) {

            if (password_verify(TOKEN_SESSAO, $token)) {

                $usuario->setId($_SESSION['_idusuario']);
                $usuario->setSenha($senha);

                $senha_atual = $usuario->obterSenha();

                if (password_verify($senha, $senha_atual['usu_senha'])) {

                    $tipo->setId($id);
                    if ($tipo->excluir())
                        $this->setRetorno('Tipo de usuários excluído com sucesso', true, true);
                    else if($tipo->getRetorno()['exibir'])
                        $this->setRetorno($tipo->getRetorno()['mensagem'], $tipo->getRetorno()['exibir'], $tipo->getRetorno()['status']);
                    else
                        $this->setRetorno('Não foi possível excluir o tipo de usuários, tente novamente', true, false);

                } else
                    $this->setRetorno('Senha informada inválida, tente novamente', true, false);

            } else
                $this->setRetorno('Token de autenticação inválido, recarregue a página e tente novamente', true, false);

        } else {
            $array_erros = $validate->get_errors();
            $array_erro = array_shift($array_erros);
            $erro = array_shift($array_erro);
            $this->setRetorno($erro, true, false);
        }

        $this->dados->retorno = $this->getRetorno();
        $this->ModificaURL(URL . 'usuarios/gerenciar-tipos-usuarios'); //altera url atual 'gerenciar-tipos-usuarios/deletar' para apenas '/gerenciar-tipos-usuarios/'
        $this->pageTiposUsuarios();
    }

}