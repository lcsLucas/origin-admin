<?php

namespace App\model;

use App\dao\ConfiguracaoDao;

if (! defined('ABSPATH'))
	die;

class Configuracao extends ConfiguracaoDao
{
	private $nome_site;
	private $resumo_site;
	private $file_logo;
	private $file_favicon;

	public function __construct($nome_site='', $resumo_site='')
	{
		parent::__construct($this);
		$this->nome_site = $nome_site;
		$this->resumo_site = $resumo_site;
		$this->file_logo = new ManipulacaoImagem();
		$this->file_favicon = new ManipulacaoImagem();
	}

	/**
	 * @return string
	 */
	public function getNomeSite(): string
	{
		return $this->nome_site;
	}

	/**
	 * @param string $nome_site
	 */
	public function setNomeSite(string $nome_site): void
	{
		$this->nome_site = $nome_site;
	}

	/**
	 * @return string
	 */
	public function getResumoSite(): string
	{
		return $this->resumo_site;
	}

	/**
	 * @param string $resumo_site
	 */
	public function setResumoSite(string $resumo_site): void
	{
		$this->resumo_site = $resumo_site;
	}

	/**
	 * @return ManipulacaoImagem
	 */
	public function getFileLogo(): ManipulacaoImagem
	{
		return $this->file_logo;
	}

	/**
	 * @param ManipulacaoImagem $file_logo
	 */
	public function setFileLogo(ManipulacaoImagem $file_logo): void
	{
		$this->file_logo = $file_logo;
	}

	/**
	 * @return ManipulacaoImagem
	 */
	public function getFileFavicon(): ManipulacaoImagem
	{
		return $this->file_favicon;
	}

	/**
	 * @param ManipulacaoImagem $file_favicon
	 */
	public function setFileFavicon(ManipulacaoImagem $file_favicon): void
	{
		$this->file_favicon = $file_favicon;
	}

	public function getRetorno() {
		return parent::getRetorno();
	}

	public function cadastrar() {
		$result = false;

		if ($this->conectar()) {
			$this->beginTransaction();

			if (empty($this->verificaDAO()))
				$result = $this->cadastrarDAO();
			else
				$result = $this->alterarDAO();

			if (!empty($result)) {
				$nome_imagem = $this->slug($this->nome_site);

				if ($result && !empty($this->file_logo->getFileImagem())) { // grava imagem de destaque do banner

					$this->file_logo->setNomeImagem($nome_imagem . $this->file_logo->getTipoImagem());

					if (!empty($this->file_logo->getDadosImagem()))
						$result = $this->file_logo->salvarImagemDados(PATH_IMG, 250, 250);
					else
						$result = $this->file_logo->salvarImagem(PATH_IMG, 250, 250);

					if (!$result)
						$this->setRetorno($this->file_logo->getRetorno()['mensagem'], $this->file_logo->getRetorno()['exibir'], $this->file_logo->getRetorno()['status']);
				}

			}

			if ($result && !empty($this->file_favicon->getFileImagem())) { // se tiver grava imagem de tablet do banner

				$this->file_favicon->setNomeImagem($nome_imagem . $this->file_favicon->getTipoImagem());

				if (!empty($this->file_favicon->getDadosImagem()))
					$result = $this->file_favicon->salvarImagemDados(PATH_IMG . 'favicon/', 32, 32);
				else
					$result = $this->file_favicon->salvarImagem(PATH_IMG . 'favicon/', 32, 32);

				if (!$result)
					$this->setRetorno($this->file_favicon->getRetorno()['mensagem'], $this->file_favicon->getRetorno()['exibir'], $this->file_favicon->getRetorno()['status']);
			}

			if ($result)
				$result = $this->alterarImagensBancoDAO();
		}

		if (!$result)
			$this->excluirImagens();

		$this->commitar($result);
		return $result;
	}

	private function slug($string) {
		$a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖFÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûÚªº·_,:;';
		$b = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuuao------';
		$string = utf8_decode($string);
		$string = strtr($string, utf8_decode($a), $b); //substitui letras acentuadas por "normais"

		$string = str_replace("(", " ", $string); // troca ( por -
		$string = str_replace(")", " ", $string); // troca ) por -
		$string = str_replace(".", " ", $string);
		$string = str_replace("!", " ", $string);
		$string = str_replace("?", " ", $string);
		$string = str_replace("@", " ", $string);
		$string = str_replace("-", " ", $string);
		$string = str_replace("&", " e ", $string);
		$string = str_replace(" de ", " ", $string);
		$string = str_replace("+", " e ", $string);
		$string = str_replace('\'', ' ', $string);
		$string = str_replace('"', ' ', $string);
		$string = preg_replace('/(\s{2,})/', ' ', $string);
		$string = preg_replace('/(\s+)/', '-', $string);

		$string = filter_var($string, FILTER_SANITIZE_STRING, array('options' => array(FILTER_FLAG_STRIP_LOW, FILTER_FLAG_STRIP_HIGH)));
		$string = strtolower(trim($string));
		return $string;

		/*
		$table = array(
            'Š'=>'S', 'š'=>'s', 'Đ'=>'Dj', 'đ'=>'dj', 'Ž'=>'Z', 'ž'=>'z', 'Č'=>'C', 'č'=>'c', 'Ć'=>'C', 'ć'=>'c',
            'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
            'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
            'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
            'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
            'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b',
            'ÿ'=>'y', 'Ŕ'=>'R', 'ŕ'=>'r', '/' => ' ', '-' => ' '
        );

        // -- Remove duplicated spaces
		$stripped = filter_var($string, FILTER_SANITIZE_STRING, array('options' => array(FILTER_FLAG_STRIP_LOW, FILTER_FLAG_STRIP_HIGH)));
        $stripped = preg_replace(array('/[^A-z0-9]/'), ' ', $stripped);
		$stripped = preg_replace('/\s\r\t\n/', ' ', $stripped);
		$stripped = preg_replace('/ {2,}/', ' ', $stripped);
		$stripped = str_replace(' ', '-', $stripped);
		$stripped = strtolower(strtr($stripped, $table));

		return $stripped;*/
	}

	private function excluirImagens() {
		if (!empty($this->file_logo->getNomeImagem()) && file_exists(PATH_IMG . $this->file_logo->getNomeImagem()))
			unlink(PATH_IMG . $this->file_logo->getNomeImagem());

		if (!empty($this->file_favicon->getNomeImagem()) && file_exists(PATH_IMG . 'favicon/' . $this->file_favicon->getNomeImagem()))
			unlink(PATH_IMG . 'favicon/' . $this->file_favicon->getNomeImagem());
	}

}