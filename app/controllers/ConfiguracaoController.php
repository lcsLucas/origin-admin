<?php

namespace App\controllers;

use App\model\Configuracao;
use ProjetoMvc\render\Action;
use App\model\Data_Validator;

if (! defined('ABSPATH'))
	die;

class ConfiguracaoController extends Action
{

	public function __construct()
	{
		$this->autenticacao = true;
		parent::__construct();
		/**
		 * caminho com o arquivo do layout padrão que todas as paginas dessa controller poderá usar
		 **/
		$this->layoutPadrao = PATH_VIEWS.'shared/layoutPadrao';
		$this->dados->menu = 'configurações';
		$this->dados->submenu = 'gerais';
	}

	public function pageGerenciarConfiguracoes() {
		$configuracao = new Configuracao();

		$this->dados->title = 'Configurações Gerais';
		$this->dados->validation = true;
		$this->dados->input_drop = true;
		$this->dados->cropjs = true;

		if (empty($this->dados->editar) && $configuracao->carregar()) {
			$this->dados->editar = true;
			$this->dados->parametros['param_nome'] = $configuracao->getNomeSite();
			$this->dados->parametros['param_resumo'] = $configuracao->getResumoSite();
			$this->dados->parametros['param_alteracao'] = $configuracao->getDataAlteracao();
			$this->dados->parametros['param_logo'] = $configuracao->getFileLogo()->getNomeImagem();
			$this->dados->parametros['param_favicon'] = $configuracao->getFileFavicon()->getNomeImagem();
		} elseif (!empty($this->dados->editar) && $configuracao->verificar()) {
			$this->dados->parametros['param_logo'] = $configuracao->getFileLogo()->getNomeImagem();
			$this->dados->parametros['param_favicon'] = $configuracao->getFileFavicon()->getNomeImagem();
		}

		$this->render('gerenciar-configuracoes.php');
	}

	public function requestGerenciarConfiguracoesEdit() {
		$this->dados->editar = true;
		$this->requestGerenciarConfiguracoes();
		$this->ModificaURL(URL . 'configuracoes/gerais/'); //altera url atual 'gerenciar-tipos-usuarios/deletar' para apenas '/gerenciar-tipos-usuarios/'
	}

	public function requestGerenciarConfiguracoes() {
		$configuracao = new Configuracao();

		if ($this->requestParameters($configuracao)) {

			if ($configuracao->cadastrar()) {
				$this->setRetorno('Informações registradas com sucesso', true, true);
			} else if(!empty($configuracao->getRetorno()['exibir']))
				$this->setRetorno($configuracao->getRetorno()['mensagem'], $configuracao->getRetorno()['exibir'], $configuracao->getRetorno()['status']);
			else
				$this->setRetorno('Não foi possível cadastrar o banner, tente novamente', true, false);
		}

		$this->dados->retorno = $this->getRetorno();
		$this->pageGerenciarConfiguracoes();
	}

	private function requestParameters(Configuracao $configuracao) {
		$validate = new Data_Validator();
		$result = false;

		$nome = trim(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS));
		$resumo = trim(filter_input(INPUT_POST, 'resumo', FILTER_SANITIZE_SPECIAL_CHARS));
		$token = trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_SPECIAL_CHARS));

		$validate
			->set('nome', $nome)->is_required()->max_length(255)
			->set('resumo', $resumo)->is_required()
			->set('Token"', $token)->is_required();

		if ($validate->validate()) {

			if (password_verify(TOKEN_SESSAO, $token)) {

				$configuracao->setNomeSite($nome);
				$configuracao->setResumoSite($resumo);

				$result = $this->requestParametersImages($configuracao);

			} else
				$this->setRetorno('Token de autenticação inválido, recarregue a página e tente novamente', true, false);

		} else {
			$array_erros = $validate->get_errors();
			$array_erro = array_shift($array_erros);
			$erro = array_shift($array_erro);
			$this->setRetorno($erro, true, false);
		}

		$this->dados->parametros['param_nome'] = $nome;
		$this->dados->parametros['param_resumo'] = $resumo;
		$this->dados->editar = true;

		return $result;
	}

	private function requestParametersImages(Configuracao $configuracao) {
		if (!empty($this->dados->editar))
			$retorno = true;
		else
			$retorno = false;

		$dados_logo = trim(filter_input(INPUT_POST, 'dados_img_logo', FILTER_DEFAULT));
		$dados_favicon = trim(filter_input(INPUT_POST, 'dados_img_favicon', FILTER_DEFAULT));

		$file_logo = $_FILES['img_logo'];
		$file_favicon = $_FILES['img_favicon'];

		$restricoes = array();
		$restricoes[0] = 2560000;
		$restricoes[1] = array('image/png', 'image/jpeg');

		if (!empty($file_logo['name'])) {
			$configuracao->getFileLogo()->setFileImagem($file_logo);
			$erro_img = $configuracao->getFileLogo()->verificaImagem($restricoes);

			if (empty($erro_img)) {
				$retorno = true;

				$dados_principal = json_decode($dados_logo, true);
				if (json_last_error() === JSON_ERROR_NONE)
					$configuracao->getFileLogo()->setDadosImagem($dados_principal);

			} else
				$this->setRetorno($configuracao->getFileLogo()->getRetorno()['mensagem'], $configuracao->getFileLogo()->getRetorno()['exibir'], $configuracao->getFileLogo()->getRetorno()['status']);

		} elseif (empty($this->dados->editar)){
			$erro_img = true;
			$this->setRetorno('A Imagem da logo não foi enviada', true, false);
		}

		if (empty($erro_img) && !empty($file_favicon['name'])) {

			$configuracao->getFileFavicon()->setFileImagem($file_favicon);
			$erro_img = $configuracao->getFileFavicon()->verificaImagem($restricoes);

			if (empty($erro_img)) {

				$dados_tablet = json_decode($dados_favicon, true);
				if (json_last_error() === JSON_ERROR_NONE)
					$configuracao->getFileFavicon()->setDadosImagem($dados_tablet);

			} else {
				$retorno = false;
				$this->setRetorno($configuracao->getFileFavicon()->getRetorno()['mensagem'], $configuracao->getFileFavicon()->getRetorno()['exibir'], $configuracao->getFileFavicon()->getRetorno()['status']);
			}
		} elseif(empty($this->dados->editar))
			$configuracao->setFileFavicon($configuracao->getFileLogo());

		return $retorno;
	}

}