<?php

	namespace App\controllers;

	use ProjetoMvc\render\Action;
	use App\model\Data_Validator;
	use App\model\Menu;
	use App\model\SecaoMenu;

    if (! defined('ABSPATH'))
        die;

	class MenuController extends Action
	{
		public function __construct()
		{
			parent::__construct();
			/**
			 * caminho com o arquivo do layout padrão que todas as paginas dessa controller poderá usar
			 */
			$this->layoutPadrao = PATH_VIEWS.'shared/layoutPadrao';
		}

		public function pageGerenciarMenus() {
			$secao_menu = new SecaoMenu();
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
			$this->dados->registros = $menus->paginacao($inicio_registro, $qtde_registros);
			// Total de registros
			$this->dados->paginacao->total_registros = $menus->totalRegistros();

			$this->dados->todasSecoes = $secao_menu->listarTodas();
			$this->dados->title = 'Gerenciar Menus';
			$this->dados->validation = true;
			$this->render('gerenciar-menus.php');
		}

		public function pageGerenciarSubMenus() {
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
			$this->dados->registros = $menus->paginacao2($inicio_registro, $qtde_registros);
			// Total de registros
			$this->dados->paginacao->total_registros = $menus->totalRegistros2();
			$this->dados->todosMenus = $menus->listarTodosMenus();

			$this->dados->title = "Gerenciar SubMenus";
			$this->dados->validation = true;
			$this->render('gerenciar-submenus.php');
		}

		public function requestGerenciarMenus() {
			$validate = new Data_Validator();
			$menus = new Menu();

			$nome = trim(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS));
			$url = trim(filter_input(INPUT_POST, 'url', FILTER_SANITIZE_SPECIAL_CHARS));
			$id_secao = filter_input(INPUT_POST, 'sel_secao', FILTER_VALIDATE_INT);
			$id_menu = filter_input(INPUT_POST, "sel_menu", FILTER_VALIDATE_INT);
			$icone = trim(filter_input(INPUT_POST, 'icone', FILTER_SANITIZE_SPECIAL_CHARS));
			$token = trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_SPECIAL_CHARS));
			$cad_submenu = filter_has_var(INPUT_POST, 'sub_on');

			$validate->define_pattern('erro_');

			$validate
				->set('nome', $nome)->is_required()->max_length(40)
				->set('url', $url)->max_length(255)
				->set('token', $token)->is_required()
				->set('url', $url)->max_length(255)
				->set('token', $token)->is_required();

			if (!empty($cad_submenu)) {
				$validate->set('url', $url)->is_required();
				$validate->set('Menu Principal', $id_menu)->is_required();
			}

			if ($validate->validate()) {

				if (password_verify(TOKEN_SESSAO, $token)) {

					$menus->setNome($nome);
					$menus->setUrl($url);
					$menus->setIcone($icone);

					if (!empty($id_secao))
						$menus->setSecaoMenu($id_secao);

					if (!empty($id_menu))
						$menus->setMenuPai($id_menu);

					if ($menus->cadastrar())
						$this->setRetorno('Menu cadastrado com sucesso', true, true);
					else if(!empty($menus->getRetorno()['exibir']))
						$this->setRetorno($menus->getRetorno()['mensagem'], $menus->getRetorno()['exibir'], $menus->getRetorno()['status']);
					else
						$this->setRetorno('Não foi possível cadastrar o menu, tente novamente', true, false);

				} else
					$this->setRetorno('Token de autenticação inválido, recarregue a página e tente novamente', true, false);

			} else {
				$array_erros = $validate->get_errors();
				$array_erro = array_shift($array_erros);
				$erro = array_shift($array_erro);
				$this->setRetorno($erro, true, false);
			}

			if (empty($this->getRetorno()['status'])) { //quando dar erro, devove os parametros passados para view, e coloca nos campos correspondente

				$this->dados->parametros =
					array(
						'param_nome' => $nome,
						'param_url' => $url,
						'param_secao' => $id_secao,
						'param_icone' => $icone,
						'param_menu' => $id_menu
					);

			}

			$this->dados->retorno = $this->getRetorno();
			if ($cad_submenu)
				$this->pageGerenciarSubMenus();
			else
				$this->pageGerenciarMenus();
		}

		public function requestAlterarStatus() {
			$id = filter_input(INPUT_POST, 'codigo-acao', FILTER_VALIDATE_INT);
			$status = filter_has_var(INPUT_POST, 'alterar-status') ? '1' : '0';

			if (!empty($id)) {

				$menu = new Menu();
				$menu->setId($id);
				$menu->setAtivo($status);

				if (!empty($menu->alterarStatus()))
					$retorno = array('status' => $status ? true : false, 'msg' => '', 'erro' => false);
				else
					$retorno = array('status' => !$status ? true : false, 'msg' => 'Não foi possível alterar o status', 'erro' => true);

			} else
				$retorno = array('status' => !$status ? true : false, 'msg' => 'Não foi possível alterar o status', 'erro' => true);

			echo json_encode($retorno, JSON_FORCE_OBJECT);
		}

		public function pageMenusEdit() {
			$menu = new Menu();

			$id = $this->getIdUri();

			if (!empty($id)) {
				$menu->setId($id);

				if ($menu->carregar()) {
					$this->dados->editar = true;
					$this->dados->parametros = array('param_id' => $id, 'param_nome' => $menu->getNome(), 'param_url' => $menu->getUrl(), 'param_secao' => $menu->getSecaoMenu(), 'param_icone' => $menu->getIcone());
					$carregado = true;
				}

			}

			if (!empty($carregado))
				$this->pageGerenciarMenus();
			else {
				header('Location: ' . URL . 'permissoes/gerenciar-menus');
				die();
			}

		}

		public function pageSubMenusEdit() {
			$menu = new Menu();

			$id = $this->getIdUri();

			if (!empty($id)) {
				$menu->setId($id);

				if ($menu->carregar()) {
					$this->dados->editar = true;
					$this->dados->parametros = array('param_id' => $id, 'param_nome' => $menu->getNome(), 'param_url' => $menu->getUrl(), 'param_menu' => $menu->getMenuPai(), 'param_icone' => $menu->getIcone());
					$carregado = true;
				}

			}

			if (!empty($carregado))
				$this->pageGerenciarSubMenus();
			else {
				header("Location: " . URL . "permissoes/gerenciar-menus");
				die();
			}

		}

		public function requestMenusEdit() {
			$validate = new Data_Validator();
			$menus = new Menu();

			$id = $this->getIdUri();
			$nome = trim(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS));
			$url = trim(filter_input(INPUT_POST, 'url', FILTER_SANITIZE_SPECIAL_CHARS));
			$id_secao = filter_input(INPUT_POST, 'sel_secao', FILTER_VALIDATE_INT);
			$id_menu = filter_input(INPUT_POST, 'sel_menu', FILTER_VALIDATE_INT);
			$icone = trim(filter_input(INPUT_POST, 'icone', FILTER_SANITIZE_SPECIAL_CHARS));
			$token = trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_SPECIAL_CHARS));
			$cad_submenu = filter_has_var(INPUT_POST, 'sub_on');

			if (!empty($id)) {
				$menus->setId($id);

				$validate->define_pattern('erro_');

				$validate
					->set('nome', $nome)->is_required()->max_length(40)
					->set('url', $url)->max_length(255)
					->set('token', $token)->is_required();

				if (!empty($cad_submenu)) {
					$validate->set('url', $url)->is_required();
					$validate->set('Menu Principal', $id_menu)->is_required();
				}

				if ($validate->validate()) {

					if (password_verify(TOKEN_SESSAO, $token)) {

						$menus->setNome($nome);
						$menus->setUrl($url);
						$menus->setIcone($icone);
						if (!empty($id_secao))
							$menus->setSecaoMenu($id_secao);

						if (!empty($id_menu))
							$menus->setMenuPai($id_menu);

						if ($menus->alterar())
							$this->setRetorno('Menu alterado com sucesso', true, true);
						else if(!empty($menus->getRetorno()['exibir']))
							$this->setRetorno($menus->getRetorno()['mensagem'], $menus->getRetorno()['exibir'], $menus->getRetorno()['status']);
						else
							$this->setRetorno('Não foi possível alterar o menu, tente novamente', true, false);

					} else
						$this->setRetorno('Token de autenticação inválido, recarregue a página e tente novamente', true, false);

				} else {
					$array_erros = $validate->get_errors();
					$array_erro = array_shift($array_erros);
					$erro = array_shift($array_erro);
					$this->setRetorno($erro, true, false);
				}

			} else
				$this->setRetorno('Não foi possível alterar esse menu, tente novamente', true, false);

			$this->dados->retorno = $this->getRetorno();
			if ($cad_submenu)
				$this->pageSubMenusEdit();
			else
				$this->pageMenusEdit();
		}

		public function requestMenusDeletar() {
			$id = filter_input(INPUT_POST, 'codigo-acao', FILTER_VALIDATE_INT);
			$token = trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_SPECIAL_CHARS));
			$cad_submenu = filter_has_var(INPUT_POST, 'sub_on');

			$menus = new Menu();

			if (!empty($id)) {

				if (password_verify(TOKEN_SESSAO, $token)) {

					$menus->setId($id);

					if ($menus->excluir())
						$this->setRetorno("Menu excluído com sucesso", true, true);
					else if($menus->getRetorno()["exibir"])
						$this->retorno = $menus->getRetorno();
					else
						$this->setRetorno("Não foi possível excluir o menu, tente novamente", true, false);

				} else
					$this->setRetorno("Token de autenticação inválido, recarregue a página e tente novamente", true, false);

			} else
				$this->setRetorno("Não foi possível excluir o menu, tente novamente", true, false);

			$this->dados->retorno = $this->getRetorno();

			if ($cad_submenu) {
				$this->pageGerenciarSubMenus();
				$this->ModificaURL(URL . "permissoes/gerenciar-submenus");
			} else {
				$this->pageGerenciarMenus();
				$this->ModificaURL(URL . "permissoes/gerenciar-menus");
			}

		}

		public function carregarMenusUsuario() {
			$menus = new Menu();
			return $menus->carregarMenusUsuario($_SESSION['_idusuario']);
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