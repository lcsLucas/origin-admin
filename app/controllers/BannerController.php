<?php

namespace App\controllers;

use App\model\Banner;
use ProjetoMvc\render\Action;
use App\model\Data_Validator;

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


		// Consulta dos registros utilizando o LIMIT
		$this->dados->registros = $banner->paginacao($inicio_registro, $qtde_registros);
		// Total de registros
		$this->dados->paginacao->total_registros = $banner->totalRegistros();

		$this->dados->title = 'Gerenciar Banners';
		$this->dados->validation = true;
		$this->dados->input_drop = true;
		$this->dados->cropjs = true;

		$this->render('gerenciar-banners.php');
	}

	public function requestNovoBanner() {
		$banner = new Banner();

		if ($this->requestParameters($banner)) {

			if ($banner->cadastrar())
				$this->setRetorno('Banner cadastrado com sucesso', true, true);
			else if(!empty($banner->getRetorno()['exibir']))
				$this->retorno = $banner->getRetorno();
			else
				$this->setRetorno('Não foi possível cadastrar o banner, tente novamente', true, false);

		}

		$this->dados->retorno = $this->getRetorno();
		var_dump($this->dados->retorno);
		//$this->pageGerenciarBanners();
	}

	private function requestParametersImages(Banner $banner) {
	    $retorno = false;
        $dados_principal = trim(filter_input(INPUT_POST, 'dados_img', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $dados_tablet = trim(filter_input(INPUT_POST, 'dados_img_tablet', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $dados_mobile = trim(filter_input(INPUT_POST, 'dados_img_mobile', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        $file_destaque = $_FILES['img_destaque'];
        $file_tablet = $_FILES['img_tablet'];
        $file_mobile = $_FILES['img_mobile'];

        if (!empty($file_destaque['name'])) {

            $restricoes = array();

            $restricoes[0] = 2560000;
            $restricoes[1] = array('image/png', 'image/gif', 'image/jpeg');

            $banner->getFileImagem()->setFileImagem($file_destaque);
            $erro_img = $banner->getFileImagem()->verificaImagem($restricoes);

            if (empty($erro_img)) {
                $retorno = true;

                $dados_principal = json_decode($dados_principal, true);
                if (json_last_error() === JSON_ERROR_NONE)
                    $banner->getFileImagem()->setDadosImagem($dados_principal);

            } else
                $this->retorno = $banner->getFileImagem()->getRetorno();

            if (!empty($file_tablet['name'])) {

                $banner->getFileTablet()->setFileImagem($file_tablet);
                $erro_img = $banner->getFileTablet()->verificaImagem($restricoes);

                if (empty($erro_img)) {

                    $dados_tablet = json_decode($dados_tablet, true);
                    if (json_last_error() === JSON_ERROR_NONE)
                        $banner->getFileTablet()->setDadosImagem($dados_tablet);

                } else {
                    $retorno = false;
                    $this->retorno = $banner->getFileTablet()->getRetorno();
                }

            } else
                $banner->setFileTablet($banner->getFileImagem());

            if (!empty($file_mobile['name'])) {

                $banner->getFileMobile()->setFileImagem($file_mobile);
                $erro_img = $banner->getFileMobile()->verificaImagem($restricoes);

                if (empty($erro_img)) {

                    $dados_mobile = json_decode($dados_mobile, true);
                    if (json_last_error() === JSON_ERROR_NONE)
                        $banner->getFileMobile()->setDadosImagem($dados_mobile);

                } else {
                    $retorno = false;
                    $this->retorno = $banner->getFileMobile()->getRetorno();
                }

            } else
                $banner->setFileMobile($banner->getFileImagem());


        } else {
            $this->setRetorno('Imagem Principal não foi enviada', true, false);
        }

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

		$this->dados->prametros =
			array(
				'param_titulo' => $titulo,
				'param_subtitulo' => $subtitulo,
				'param_link' => $link,
				'param_optExterno' => $optionExterno,
				'param_opttitulos' => $optionTitulos,
			);

		return $result;
	}

}