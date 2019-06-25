<?php

	namespace App\controllers;

	use ProjetoMvc\render\Action;
	use App\model\Data_Validator;
	use App\model\Menu;
	use App\model\SecaoMenu;

	if (! defined('ABSPATH')){
		header("Location: /");
		exit();
	}

	class MenuController extends Action
	{
		public function __construct()
		{
			parent::__construct();
			/**
			 * caminho com o arquivo do layout padrão que todas as paginas dessa controller poderá usar
			 */
			$this->layoutPadrao = PATH_VIEWS."shared/layoutPadrao";
		}

		public function pageGerenciarMenus() {
			$secao_menu = new SecaoMenu();
			$menus = new Menu();

			$pagina_atual = filter_input(INPUT_GET, "page", FILTER_VALIDATE_INT);
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
			$this->dados->registros = $menus->paginacao($inicio_registro, $qtde_registros);
			// Total de registros
			$this->dados->paginacao->total_registros = $menus->totalRegistros();

			$this->dados->todasSecoes = $secao_menu->listarTodas();
			$this->dados->title = "Gerenciar Menus";
			$this->dados->validation = true;
			$this->render('gerenciar-menus.php');
		}

		public function requestGerenciarMenus() {
			$validate = new Data_Validator();
			$menus = new Menu();

			$nome = trim(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS));
			$url = trim(filter_input(INPUT_POST, 'url', FILTER_SANITIZE_SPECIAL_CHARS));
			$id_secao = filter_input(INPUT_POST, "sel_secao", FILTER_VALIDATE_INT);
			$icone = trim(filter_input(INPUT_POST, 'icone', FILTER_SANITIZE_SPECIAL_CHARS));
			$token = trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_SPECIAL_CHARS));

			$validate->define_pattern('erro_');

			$validate
				->set('nome', $nome)->is_required()->max_length(40)
				->set('url', $url)->is_required()->max_length(255)
				->set("token", $token)->is_required();

			if ($validate->validate()) {

				if (password_verify(TOKEN_SESSAO, $token)) {

					$menus->setNome($nome);
					$menus->setUrl($url);
					$menus->setSecaoMenu($id_secao);
					$menus->setIcone($icone);

					if ($menus->cadastrar())
						$this->setRetorno("Menu cadastrado com sucesso", true, true);
					else if(!empty($menus->getRetorno()["exibir"]))
						$this->setRetorno($menus->getRetorno()["mensagem"], $menus->getRetorno()["exibir"], $menus->getRetorno()["status"]);
					else
						$this->setRetorno("Não foi possível cadastrar o menu, tente novamente", true, false);

				} else
					$this->setRetorno("Token de autenticação inválido, recarregue a página e tente novamente", true, false);

			} else {
				$array_erros = $validate->get_errors();
				$array_erro = array_shift($array_erros);
				$erro = array_shift($array_erro);
				$this->setRetorno($erro, true, false);
			}

			if (empty($this->getRetorno()["status"])) { //quando dar erro, devove os parametros passados para view, e coloca nos campos correspondente

				$this->dados->parametros =
					array(
						"param_nome" => $nome,
						"param_url" => $url,
						"param_secao" => $id_secao,
						"param_icone" => $icone
					);

			}

			$this->dados->retorno = $this->getRetorno();
			$this->pageGerenciarMenus();

		}

	}