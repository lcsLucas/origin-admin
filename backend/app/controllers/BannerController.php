<?php

namespace App\controllers;

use App\model\Banner;
use ProjetoMvc\render\Action;
use App\model\Data_Validator;

if (! defined('ABSPATH'))
	die;

class BannerController extends Action
{
	public function __construct()
	{
		$this->autenticacao = true;
		parent::__construct();
		/**
		 * caminho com o arquivo do layout padrão que todas as paginas dessa controller poderá usar
		 */
		$this->layoutPadrao = PATH_VIEWS.'shared/layoutPadrao';
		$this->dados->menu = 'conteúdos';
		$this->dados->submenu = 'gerenciar banners';
	}

	public function pageGerenciarBanners() {
		$banner = new Banner();

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

		$tipo_filtro = filter_input(INPUT_GET, 'tipo', FILTER_VALIDATE_INT);
		$filtro = trim(filter_input(INPUT_GET, 'termo', FILTER_SANITIZE_SPECIAL_CHARS));

		$parametros = array(
			'tipo' => $tipo_filtro,
			'filtro' => $filtro
		);

		// Consulta dos registros utilizando o LIMIT
		$this->dados->registros = $banner->paginacao($inicio_registro, $qtde_registros, $parametros);
		// Total de registros
		$this->dados->paginacao->total_registros = $banner->totalRegistros($parametros);

		$this->dados->title = 'Gerenciar Banners';
		$this->dados->validation = true;
		$this->dados->input_drop = true;
		$this->dados->cropjs = true;

		$this->render('gerenciar-banners.php');
	}

	public function requestNovoBanner() {
		$banner = new Banner();

		if ($this->requestParameters($banner)) {

			if ($banner->cadastrar()) {
				$this->dados->parametros = null;
				$this->setRetorno('Banner cadastrado com sucesso', true, true);
			} else if(!empty($banner->getRetorno()['exibir']))
				$this->setRetorno($banner->getRetorno()['mensagem'], $banner->getRetorno()['exibir'], $banner->getRetorno()['status']);
			else
				$this->setRetorno('Não foi possível cadastrar o banner, tente novamente', true, false);
		}

		$this->dados->retorno = $this->getRetorno();
		$this->pageGerenciarBanners();
	}

	public function requestAlterarStatus() {
		$id = filter_input(INPUT_POST, 'codigo-acao', FILTER_VALIDATE_INT);
		$status = filter_has_var(INPUT_POST, 'alterar-status') ? '1' : '0';

		if (!empty($id)) {

			$banner = new Banner();
			$banner->setId($id);
			$banner->setAtivo($status);

			if (!empty($banner->alterarStatus()))
				$retorno = array('status' => $status ? true : false, 'msg' => '', 'erro' => false);
			else
				$retorno = array('status' => !$status ? true : false, 'msg' => 'Não foi possível alterar o status', 'erro' => true);

		} else
			$retorno = array('status' => !$status ? true : false, 'msg' => 'Não foi possível alterar o status', 'erro' => true);

		echo json_encode($retorno, JSON_FORCE_OBJECT);

	}

	public function pageBannerEdit() {
		$banner = new Banner();

		if (empty($this->dados->editar)) {
			$id = $this->getIdUri();

			if (!empty($id)) {
				$banner->setId($id);

				if ($banner->carregar()) {
					$this->dados->editar = true;
					$this->dados->parametros =
						array(
							'param_id' => $banner->getId(),
							'param_alteracao' => !empty($banner->getDataAlteracao()) ? date('Ymd', strtotime($banner->getDataAlteracao())) : '',
							'param_titulo' => $banner->getTitulo(),
							'param_subtitulo' => $banner->getSubTitulo(),
							'param_link' => $banner->getLinkBanner(),
							'param_optExterno' => $banner->getOptJanela(),
							'param_opttitulos' => $banner->getOptExibirTexto(),
							'param_img_principal' => $banner->getFileImagem()->getNomeImagem(),
							'param_img_tablet' => $banner->getFileTablet()->getNomeImagem(),
							'param_img_mobile' => $banner->getFileMobile()->getNomeImagem(),
						);
					$carregado = true;
				}

			}
		} else
			$carregado = true;

		if (!empty($carregado))
			$this->pageGerenciarBanners();
		else {
			header('Location: ' . URL . 'permissoes/gerenciar-secoes-menus');
			die();
		}

	}

	public function requestBannerEdit() {
		$banner = new Banner();
		$id = $this->getIdUri();
		$this->dados->editar = true;

		if (!empty($id)) {
			$banner->setId($id);
			$this->dados->parametros['param_id'] = $id;

			if ($this->requestParameters($banner)) {

				if ($banner->alterar()) {
					$this->dados->parametros['param_img_principal'] = $banner->getFileImagem()->getNomeImagem();
					$this->dados->parametros['param_img_tablet'] = $banner->getFileTablet()->getNomeImagem();
					$this->dados->parametros['param_img_mobile'] = $banner->getFileMobile()->getNomeImagem();
					$this->setRetorno('Banner alterado com sucesso', true, true);
				} else if(!empty($banner->getRetorno()['exibir']))
					$this->setRetorno($banner->getRetorno()['mensagem'], $banner->getRetorno()['exibir'], $banner->getRetorno()['status']);
				else
					$this->setRetorno('Não foi possível alterar o banner, tente novamente', true, false);
			}

		} else
			$this->setRetorno('Não foi possível recuperar os parametros desse banner, tente novamente', true, false);

		$this->dados->retorno = $this->getRetorno();
		$this->pageBannerEdit();
	}

	public function requestAlterarOrdem() {
		$id = filter_input(INPUT_POST, 'codigo-acao', FILTER_VALIDATE_INT);
		$ordem = filter_input(INPUT_POST, 'ordem', FILTER_VALIDATE_INT, array('min_range' => 1, 'max_range' => 2));

		if (!empty($id)) {

			$banner = new Banner();
			$banner->setId($id);

			$retorno_reg = $banner->alterarOrdem($ordem);

			if (!empty($retorno_reg))
				$retorno = array('msg' => '', 'erro' => false, 'registros' => $retorno_reg);
			elseif(empty($banner->getRetorno()['mensagem']))
				$retorno = array('msg' => '', 'erro' => false, 'registros' => array());
			else
				$retorno = array('msg' => 'Não foi possível alterar a ordem', 'erro' => true);

		} else
			$retorno = array('msg' => 'Não foi possível alterar a ordem', 'erro' => true);

		echo json_encode($retorno, JSON_FORCE_OBJECT);

	}

	public function requestBannerDeletar() {
		$id = filter_input(INPUT_POST, 'codigo-acao', FILTER_VALIDATE_INT);
		$token = trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_SPECIAL_CHARS));

		$banner = new Banner();

		if (!empty($id)) {

			if (password_verify(TOKEN_SESSAO, $token)) {

				$banner->setId($id);

				if ($banner->excluir())
					$this->setRetorno('Banner excluído com sucesso', true, true);
				else if($banner->getRetorno()['exibir'])
					$this->setRetorno($banner->getRetorno()['mensagem'], $banner->getRetorno()['exibir'], $banner->getRetorno()['status']);
				else
					$this->setRetorno('Não foi possível excluir a seção, tente novamente', true, false);

			} else
				$this->setRetorno('Token de autenticação inválido, recarregue a página e tente novamente', true, false);

		} else
			$this->setRetorno('Não foi possível deletar a Seção de Menus, tente novamente', true, false);

		$this->dados->retorno = $this->getRetorno();
		$this->ModificaURL(URL . 'cadastros/banners/gerenciar-banners'); //altera url atual 'gerenciar-tipos-usuarios/deletar' para apenas '/gerenciar-tipos-usuarios/'
		$this->pageGerenciarBanners();
	}

	private function requestParametersImages(Banner $banner) {
		if (!empty($this->dados->editar))
			$retorno = true;
		else
	    	$retorno = false;

        $dados_principal = trim(filter_input(INPUT_POST, 'dados_img_destaque', FILTER_DEFAULT));
        $dados_tablet = trim(filter_input(INPUT_POST, 'dados_img_tablet', FILTER_DEFAULT));
        $dados_mobile = trim(filter_input(INPUT_POST, 'dados_img_mobile', FILTER_DEFAULT));

        $file_destaque = $_FILES['img_destaque'];
        $file_tablet = $_FILES['img_tablet'];
        $file_mobile = $_FILES['img_mobile'];

		$restricoes = array();
		$restricoes[0] = 2560000;
		$restricoes[1] = array('image/png', 'image/jpeg');

        if (!empty($file_destaque['name'])) {

            $banner->getFileImagem()->setFileImagem($file_destaque);
            $erro_img = $banner->getFileImagem()->verificaImagem($restricoes);

            if (empty($erro_img)) {
                $retorno = true;

                $dados_principal = json_decode($dados_principal, true);
                if (json_last_error() === JSON_ERROR_NONE)
                    $banner->getFileImagem()->setDadosImagem($dados_principal);

            } else
				$this->setRetorno($banner->getFileImagem()->getRetorno()['mensagem'], $banner->getFileImagem()->getRetorno()['exibir'], $banner->getFileImagem()->getRetorno()['status']);

        } elseif (empty($this->dados->editar)){
			$erro_img = true;
            $this->setRetorno('A Imagem Principal do Banner não foi enviada', true, false);
        }

		if (empty($erro_img) && !empty($file_tablet['name'])) {

			$banner->getFileTablet()->setFileImagem($file_tablet);
			$erro_img = $banner->getFileTablet()->verificaImagem($restricoes);

			if (empty($erro_img)) {

				$dados_tablet = json_decode($dados_tablet, true);
				if (json_last_error() === JSON_ERROR_NONE)
					$banner->getFileTablet()->setDadosImagem($dados_tablet);

			} else {
				$retorno = false;
				$this->setRetorno($banner->getFileTablet()->getRetorno()['mensagem'], $banner->getFileTablet()->getRetorno()['exibir'], $banner->getFileTablet()->getRetorno()['status']);
			}

		} elseif(empty($this->dados->editar))
			$banner->setFileTablet($banner->getFileImagem());

		if (empty($erro_img) && !empty($file_mobile['name'])) {

			$banner->getFileMobile()->setFileImagem($file_mobile);
			$erro_img = $banner->getFileMobile()->verificaImagem($restricoes);

			if (empty($erro_img)) {

				$dados_mobile = json_decode($dados_mobile, true);
				if (json_last_error() === JSON_ERROR_NONE)
					$banner->getFileMobile()->setDadosImagem($dados_mobile);

			} else {
				$retorno = false;
				$this->setRetorno($banner->getFileMobile()->getRetorno()['mensagem'], $banner->getFileMobile()->getRetorno()['exibir'], $banner->getFileMobile()->getRetorno()['status']);
			}

		} elseif(empty($this->dados->editar))
			$banner->setFileMobile($banner->getFileImagem());

        return $retorno;
    }

	private function requestParameters(Banner $banner) {
		$validate = new Data_Validator();
		$result = false;

		$titulo = trim(filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS));
		$subtitulo = trim(filter_input(INPUT_POST, 'subtitulo', FILTER_SANITIZE_SPECIAL_CHARS));
		$link = trim(filter_input(INPUT_POST, 'url', FILTER_SANITIZE_SPECIAL_CHARS));
		$optionExterno = filter_input(INPUT_POST, 'optExterno', FILTER_VALIDATE_INT, array("options" => array("min_range"=>0, "max_range"=>1)));
		$optionTitulos = filter_input(INPUT_POST, 'optTitulo', FILTER_VALIDATE_INT, array("options" => array("min_range"=>0, "max_range"=>1)));
		$token = trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_SPECIAL_CHARS));

		$validate
			->set('titulo', $titulo)->is_required()->max_length(255)
			->set('subTitulo', $subtitulo)->is_required()->max_length(255)
			->set('link', $link)->is_required()->max_length(400)
			->set('Token"', $token)->is_required();

		if ($validate->validate()) {

			if (password_verify(TOKEN_SESSAO, $token)) {

				$banner->setTitulo($titulo);
				$banner->setSubTitulo($subtitulo);
				$banner->setLinkBanner($link);
				$banner->setOptJanela($optionExterno);
				$banner->setOptExibirTexto($optionTitulos);

				$result = $this->requestParametersImages($banner);

			} else
				$this->setRetorno('Token de autenticação inválido, recarregue a página e tente novamente', true, false);

		} else {
			$array_erros = $validate->get_errors();
			$array_erro = array_shift($array_erros);
			$erro = array_shift($array_erro);
			$this->setRetorno($erro, true, false);
		}

		$this->dados->parametros['param_titulo'] = $titulo;
		$this->dados->parametros['param_subtitulo'] = $subtitulo;
		$this->dados->parametros['param_link'] = $link;
		$this->dados->parametros['param_optExterno'] = $optionExterno;
		$this->dados->parametros['param_opttitulos'] = $optionTitulos;

		return $result;
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