<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 07/04/2019
 * Time: 14:25
 */

namespace App\controllers;

use App\model\SecaoMenu;
use ProjetoMvc\render\Action;
use App\model\Data_Validator;

if (! defined('ABSPATH'))
    die;

class SecaoMenuController extends Action
{
    public function __construct()
    {
        parent::__construct();
        /**
         * caminho com o arquivo do layout padrão que todas as paginas dessa controller poderá usar
         */
        $this->layoutPadrao = PATH_VIEWS.'shared/layoutPadrao';
    }

    public function pageGerenciarSecoesMenus() {
        $secao = new SecaoMenu();

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
        $this->dados->registros = $secao->paginacao($inicio_registro, $qtde_registros);
        // Total de registros
        $this->dados->paginacao->total_registros = $secao->totalRegistros();

        $this->dados->title = 'Gerenciar Seções de Menus';
        $this->dados->validation = true;
        $this->render('gerenciar-secoes-menus.php');

    }

    public function requestNovaSecao() {
        $secao = new SecaoMenu();

        $nome = trim(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS));
        $token = trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_SPECIAL_CHARS));

        if (!empty($nome)) {

            if (password_verify(TOKEN_SESSAO, $token)) {

                $secao->setNome($nome);

                if ($secao->cadastrar())
                    $this->setRetorno('Nova seção foi cadastrada com sucesso', true, true);
                else if($secao->getRetorno()['exibir'])
                    $this->retorno = $secao->getRetorno();
                else
                    $this->setRetorno('Não foi possível cadastrar a nova seção, tente novamente', true, false);

            } else
                $this->setRetorno('Token de autenticação inválido, recarregue a página e tente novamente', true, false);


        } else
            $this->setRetorno('Você não informou corretamente o nome da seção', true, false);

        $this->dados->retorno = $this->getRetorno();
        $this->pageGerenciarSecoesMenus();
    }

	public function requestAlterarStatus() {
		$id = filter_input(INPUT_POST, 'codigo-acao', FILTER_VALIDATE_INT);
		$status = filter_has_var(INPUT_POST, 'alterar-status') ? '1' : '0';

		if (!empty($id)) {

			$secao = new SecaoMenu();
			$secao->setId($id);
			$secao->setAtivo($status);

			if (!empty($secao->alterarStatus()))
				$retorno = array('status' => $status ? true : false, 'msg' => '', 'erro' => false);
			else
				$retorno = array('status' => !$status ? true : false, 'msg' => 'Não foi possível alterar o status', 'erro' => true);

		} else
			$retorno = array('status' => !$status ? true : false, 'msg' => 'Não foi possível alterar o status', 'erro' => true);

		echo json_encode($retorno, JSON_FORCE_OBJECT);

	}

	public function requestAlterarOrdem() {
		$id = filter_input(INPUT_POST, 'codigo-acao', FILTER_VALIDATE_INT);
		$ordem = filter_input(INPUT_POST, 'ordem', FILTER_VALIDATE_INT, array('min_range' => 1, 'max_range' => 2));

		if (!empty($id)) {

			$secao = new SecaoMenu();
			$secao->setId($id);

			$retorno_reg = $secao->alterarOrdem($ordem);

			if (!empty($retorno_reg))
				$retorno = array('msg' => '', 'erro' => false, 'registros' => $retorno_reg);
			elseif(empty($secao->getRetorno()['mensagem']))
				$retorno = array('msg' => '', 'erro' => false, 'registros' => array());
			else
				$retorno = array('msg' => 'Não foi possível alterar a ordem', 'erro' => true);

		} else
			$retorno = array('msg' => 'Não foi possível alterar a ordem', 'erro' => true);

		echo json_encode($retorno, JSON_FORCE_OBJECT);

	}

	public function pageSecoesMenusEdit() {
    	$secao = new SecaoMenu();

		if (empty($this->dados->editar)) {
			$id = $this->getIdUri();

			if (!empty($id)) {
				$secao->setId($id);

				if ($secao->carregar()) {
					$this->dados->editar = true;
					$this->dados->parametros = array('param_id' => $id, 'param_nome' => $secao->getNome());
					$carregado = true;
				}

			}
		} else
			$carregado = true;

		if (!empty($carregado))
			$this->pageGerenciarSecoesMenus();
		else {
			header('Location: ' . URL . 'permissoes/gerenciar-secoes-menus');
			die();
		}

	}

	public function requestSecoesMenusEdit() {
		$secao = new SecaoMenu();

		$id = $this->getIdUri();

		if (!empty($id)) {
			$secao->setId($id);
			$nome = trim(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS));
			$token = trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_SPECIAL_CHARS));

			if (!empty($nome)) {

				if (password_verify(TOKEN_SESSAO, $token)) {

					$secao->setNome($nome);

					if ($secao->alterar())
						$this->setRetorno('Seção alterada com sucesso', true, true);
					else if($secao->getRetorno()['exibir'])
						$this->retorno = $secao->getRetorno();
					else
						$this->setRetorno('Não foi possível alterar a seção, tente novamente', true, false);

				} else
					$this->setRetorno('Token de autenticação inválido, recarregue a página e tente novamente', true, false);


			} else
				$this->setRetorno('Você não informou corretamente o nome da seção', true, false);

		} else
			$this->setRetorno('Não foi possível alterar o status dessa seção, tente novamente', true, false);

		$this->dados->retorno = $this->getRetorno();

		if (!empty($this->dados->retorno['mensagem'])) {
			$this->dados->editar = true;
			$this->dados->parametros = array('param_id' => $id, 'param_nome' => $secao->getNome());
		}

		$this->pageSecoesMenusEdit();
	}

	public function requestSecoesMenusDeletar() {
		$id = filter_input(INPUT_POST, 'codigo-acao', FILTER_VALIDATE_INT);
		$token = trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_SPECIAL_CHARS));

		$secao = new SecaoMenu();

		if (!empty($id)) {

			if (password_verify(TOKEN_SESSAO, $token)) {

				$secao->setId($id);

				if ($secao->excluir())
					$this->setRetorno('Seção excluída com sucesso', true, true);
				else if($secao->getRetorno()['exibir'])
					$this->retorno = $secao->getRetorno();
				else
					$this->setRetorno('Não foi possível excluir a seção, tente novamente', true, false);

			} else
				$this->setRetorno('Token de autenticação inválido, recarregue a página e tente novamente', true, false);

		} else
			$this->setRetorno('Não foi possível deletar a Seção de Menus, tente novamente', true, false);

		$this->dados->retorno = $this->getRetorno();
		$this->ModificaURL(URL . 'permissoes/gerenciar-secoes-menus'); //altera url atual 'gerenciar-tipos-usuarios/deletar' para apenas '/gerenciar-tipos-usuarios/'
		$this->pageGerenciarSecoesMenus();
	}

	private function getIdUri() {
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

		return $id;
	}

}