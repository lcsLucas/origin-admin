<?php

namespace App\model;

use App\dao\BannerDao;

if (! defined('ABSPATH'))
	die;

class Banner extends BannerDao
{
	private $id;
	private $titulo;
	private $data_cadastro;
	private $data_alteracao;
	private $sub_titulo;
	private $link_banner;
	private $ativo;
	private $opt_janela;
	private $opt_exibir_texto;
	private $file_imagem;
	private $file_tablet;
	private $file_mobile;
	private $nome_imagem;
	private $nome_tablet;
	private $nome_mobile;

	/**
	 * Banner constructor.
	 * @param $titulo
	 * @param $sub_titulo
	 * @param $link_banner
	 * @param $ativo
	 * @param $opt_janela
	 * @param $opt_exibir_texto
	 */
	public function __construct($titulo='', $sub_titulo='', $link_banner='', $ativo='0', $opt_janela='0', $opt_exibir_texto='0')
	{
		parent::__construct($this);
		$this->data_cadastro = date('Y-m-d');
		$this->data_alteracao = null;
		$this->titulo = $titulo;
		$this->sub_titulo = $sub_titulo;
		$this->link_banner = $link_banner;
		$this->ativo = $ativo;
		$this->opt_janela = $opt_janela;
		$this->opt_exibir_texto = $opt_exibir_texto;
		$this->nome_imagem = $this->nome_tablet = $this->nome_mobile = '';
		$this->file_imagem = new ManipulacaoImagem();
		$this->file_tablet = new ManipulacaoImagem();
		$this->file_mobile = new ManipulacaoImagem();
	}

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId($id): void
	{
		$this->id = $id;
	}

    /**
     * @return false|string
     */
    public function getDataCadastro()
    {
        return $this->data_cadastro;
    }

    /**
     * @param false|string $data_cadastro
     */
    public function setDataCadastro($data_cadastro): void
    {
        $this->data_cadastro = $data_cadastro;
    }

    /**
     * @return mixed
     */
    public function getDataAlteracao()
    {
        return $this->data_alteracao;
    }

    /**
     * @param mixed $data_alteracao
     */
    public function setDataAlteracao($data_alteracao): void
    {
        $this->data_alteracao = $data_alteracao;
    }

	/**
	 * @return string
	 */
	public function getTitulo(): string
	{
		return $this->titulo;
	}

	/**
	 * @param string $titulo
	 */
	public function setTitulo(string $titulo): void
	{
		$this->titulo = $titulo;
	}

	/**
	 * @return string
	 */
	public function getSubTitulo(): string
	{
		return $this->sub_titulo;
	}

	/**
	 * @param string $sub_titulo
	 */
	public function setSubTitulo(string $sub_titulo): void
	{
		$this->sub_titulo = $sub_titulo;
	}

	/**
	 * @return string
	 */
	public function getLinkBanner(): string
	{
		return $this->link_banner;
	}

	/**
	 * @param string $link_banner
	 */
	public function setLinkBanner(string $link_banner): void
	{
		$this->link_banner = $link_banner;
	}

	/**
	 * @return string
	 */
	public function getAtivo(): string
	{
		return $this->ativo;
	}

	/**
	 * @param string $ativo
	 */
	public function setAtivo(string $ativo): void
	{
		$this->ativo = $ativo;
	}

	/**
	 * @return string
	 */
	public function getOptJanela(): string
	{
		return $this->opt_janela;
	}

	/**
	 * @param string $opt_janela
	 */
	public function setOptJanela(string $opt_janela): void
	{
		$this->opt_janela = $opt_janela;
	}

	/**
	 * @return string
	 */
	public function getOptExibirTexto(): string
	{
		return $this->opt_exibir_texto;
	}

	/**
	 * @param string $opt_exibir_texto
	 */
	public function setOptExibirTexto(string $opt_exibir_texto): void
	{
		$this->opt_exibir_texto = $opt_exibir_texto;
	}

    /**
     * @return ManipulacaoImagem
     */
    public function getFileImagem(): ManipulacaoImagem
    {
        return $this->file_imagem;
    }

    /**
     * @param ManipulacaoImagem $file_imagem
     */
    public function setFileImagem(ManipulacaoImagem $file_imagem)
    {
        $this->file_imagem = $file_imagem;
    }

    /**
     * @return mixed
     */
    public function getFileTablet(): ManipulacaoImagem
    {
        return $this->file_tablet;
    }

    /**
     * @param mixed $file_tablet
     */
    public function setFileTablet(ManipulacaoImagem $file_tablet)
    {
        $this->file_tablet = $file_tablet;
    }

    /**
     * @return mixed
     */
    public function getFileMobile(): ManipulacaoImagem
    {
        return $this->file_mobile;
    }

    /**
     * @param mixed $file_mobile
     */
    public function setFileMobile(ManipulacaoImagem $file_mobile)
    {
        $this->file_mobile = $file_mobile;
    }



	/**
	 * @return string
	 */
	public function getNomeImagem(): string
	{
		return $this->nome_imagem;
	}

	/**
	 * @param string $nome_imagem
	 */
	public function setNomeImagem(string $nome_imagem): void
	{
		$this->nome_imagem = $nome_imagem;
	}

	/**
	 * @return mixed
	 */
	public function getNomeTablet()
	{
		return $this->nome_tablet;
	}

	/**
	 * @param mixed $nome_tablet
	 */
	public function setNomeTablet($nome_tablet): void
	{
		$this->nome_tablet = $nome_tablet;
	}

	/**
	 * @return mixed
	 */
	public function getNomeMobile()
	{
		return $this->nome_mobile;
	}

	/**
	 * @param mixed $nome_mobile
	 */
	public function setNomeMobile($nome_mobile): void
	{
		$this->nome_mobile = $nome_mobile;
	}

	public function getRetorno() {
		return parent::getRetorno();
	}

	public  function paginacao($incio, $fim, $parametros) {
		return $this->limiteRegistroDAO($incio, $fim, $parametros);
	}

	public function totalRegistros($parametros) {
		return $this->totalRegistrosDAO($parametros);
	}

	public function cadastrar() {
	    $result = false;

		if ($this->conectar()) {
            $this->beginTransaction();
            $result = $this->cadastrarDAO();

			$nome_imagem = $this->slug($this->titulo) .'-'. $this->getId();

            if ($result && !empty($this->file_imagem->getFileImagem())) { // grava imagem de destaque do banner

                $this->file_imagem->setNomeImagem($nome_imagem . $this->file_imagem->getTipoImagem());

				if (!empty($this->file_imagem->getDadosImagem()))
					$result = $this->file_imagem->salvarImagemDados(PATH_IMG . 'banners/', 1600, 520);
				else
					$result = $this->file_imagem->salvarImagem(PATH_IMG . 'banners/', 1600, 520);

				if (!$result)
					$this->setRetorno($this->file_imagem->getRetorno()['mensagem'], $this->file_imagem->getRetorno()['exibir'], $this->file_imagem->getRetorno()['status']);
            }

			if ($result && !empty($this->file_tablet->getFileImagem())) { // se tiver grava imagem de tablet do banner

				$this->file_tablet->setNomeImagem($nome_imagem . $this->file_tablet->getTipoImagem());

				if (!empty($this->file_tablet->getDadosImagem()))
					$result = $this->file_tablet->salvarImagemDados(PATH_IMG . 'banners/tablet/', 1024, 500);
				else
					$result = $this->file_tablet->salvarImagem(PATH_IMG . 'banners/tablet/', 1024, 500);

				if (!$result)
					$this->setRetorno($this->file_tablet->getRetorno()['mensagem'], $this->file_tablet->getRetorno()['exibir'], $this->file_tablet->getRetorno()['status']);
			}

			if ($result && !empty($this->file_mobile->getFileImagem())) {

				$this->file_mobile->setNomeImagem($nome_imagem . $this->file_mobile->getTipoImagem());

				if (!empty($this->file_mobile->getDadosImagem())) {
					$result = $this->file_mobile->salvarImagemDados(PATH_IMG . 'banners/mobile/', 540, 540);
					$this->file_mobile->salvarImagemDados(PATH_IMG . 'banners/thumbs/', 100, 100);
				} else {
					$result = $this->file_mobile->salvarImagem(PATH_IMG . 'banners/mobile/', 540, 540);
					$this->file_mobile->salvarImagem(PATH_IMG . 'banners/thumbs/', 100, 100);
				}

				if (!$result)
					$this->setRetorno($this->file_mobile->getRetorno()['mensagem'], $this->file_mobile->getRetorno()['exibir'], $this->file_mobile->getRetorno()['status']);
			}

			if ($result)
				$result = $this->alterarImagensBancoDAO();
        }

        if (!$result)
        	$this->excluirImagens();

		$this->commitar($result);
        return $result;
	}

	public function alterarStatus() {
		return $this->alterarStatusDAO();
	}

	public function carregar() {
		return $this->carregarDAO();
	}

	public function alterar() {
		$result = false;

		if ($this->conectar()) {
			$this->beginTransaction();

			$result = $this->alterarDAO();

			if ($result && (!empty($this->file_imagem->getFileImagem()) || !empty($this->file_tablet->getFileImagem()) || !empty($this->file_mobile->getFileImagem()))) {
				$nome_imagem = $this->slug($this->titulo) .'-'. $this->getId();

				$resp_imgs = $this->recuperarImagensDAO();

				$result = $this->gravarImagens($nome_imagem);

				if ($result && !empty($resp_imgs)) {

					$temp_img = $this->file_imagem->getNomeImagem();
					$temp_tablet = $this->file_tablet->getNomeImagem();
					$temp_mobile = $this->file_mobile->getNomeImagem();

					if (empty($this->file_imagem->getFileImagem()) || $this->file_imagem->getNomeImagem() === $resp_imgs['img_principal'])
						$this->file_imagem->setNomeImagem('');
					else
						$this->file_imagem->setNomeImagem($resp_imgs['img_principal']);

					if (empty($this->file_tablet->getFileImagem()) || $this->file_tablet->getNomeImagem() === $resp_imgs['img_tablet'])
						$this->file_tablet->setNomeImagem('');
					else
						$this->file_tablet->setNomeImagem($resp_imgs['img_tablet']);

					if (empty($this->file_mobile->getFileImagem()) || $this->file_mobile->getNomeImagem() === $resp_imgs['img_mobile'])
						$this->file_mobile->setNomeImagem('');
					else
						$this->file_mobile->setNomeImagem($resp_imgs['img_mobile']);

					$this->excluirImagens();

					if (!empty($temp_img))
						$this->file_imagem->setNomeImagem($temp_img);
					else
						$this->file_imagem->setNomeImagem($resp_imgs['img_principal']);

					if (!empty($temp_tablet))
						$this->file_tablet->setNomeImagem($temp_tablet);
					else
						$this->file_tablet->setNomeImagem($resp_imgs['img_tablet']);

					if (!empty($temp_mobile))
						$this->file_mobile->setNomeImagem($temp_mobile);
					else
						$this->file_mobile->setNomeImagem($resp_imgs['img_mobile']);
				}

				if ($result)
					$result = $this->alterarImagensBancoDAO();

			}

		}

		$this->commitar($result);
		return $result;
	}

	private function gravarImagens($nome_imagem) {
		$result = true;

		if ($result && !empty($this->file_imagem->getFileImagem())) { // grava imagem de destaque do banner

			$this->file_imagem->setNomeImagem($nome_imagem . $this->file_imagem->getTipoImagem());

			if (!empty($this->file_imagem->getDadosImagem()))
				$result = $this->file_imagem->salvarImagemDados(PATH_IMG . 'banners/', 1600, 520);
			else
				$result = $this->file_imagem->salvarImagem(PATH_IMG . 'banners/', 1600, 520);

			if (!$result)
				$this->setRetorno($this->file_imagem->getRetorno()['mensagem'], $this->file_imagem->getRetorno()['exibir'], $this->file_imagem->getRetorno()['status']);
		}

		if ($result && !empty($this->file_tablet->getFileImagem())) { // se tiver grava imagem de tablet do banner

			$this->file_tablet->setNomeImagem($nome_imagem . $this->file_tablet->getTipoImagem());

			if (!empty($this->file_tablet->getDadosImagem()))
				$result = $this->file_tablet->salvarImagemDados(PATH_IMG . 'banners/tablet/', 1024, 500);
			else
				$result = $this->file_tablet->salvarImagem(PATH_IMG . 'banners/tablet/', 1024, 500);

			if (!$result)
				$this->setRetorno($this->file_tablet->getRetorno()['mensagem'], $this->file_tablet->getRetorno()['exibir'], $this->file_tablet->getRetorno()['status']);
		}

		if ($result && !empty($this->file_mobile->getFileImagem())) {

			$this->file_mobile->setNomeImagem($nome_imagem . $this->file_mobile->getTipoImagem());

			if (!empty($this->file_mobile->getDadosImagem())) {
				$result = $this->file_mobile->salvarImagemDados(PATH_IMG . 'banners/mobile/', 540, 540);
				$this->file_mobile->salvarImagemDados(PATH_IMG . 'banners/thumbs/', 100, 100);
			} else {
				$result = $this->file_mobile->salvarImagem(PATH_IMG . 'banners/mobile/', 540, 540);
				$this->file_mobile->salvarImagem(PATH_IMG . 'banners/thumbs/', 100, 100);
			}

			if (!$result)
				$this->setRetorno($this->file_mobile->getRetorno()['mensagem'], $this->file_mobile->getRetorno()['exibir'], $this->file_mobile->getRetorno()['status']);
		}

		return $result;
	}

	public function excluir() {
		$retorno = $this->excluirDAO();

		if ($retorno)
			$this->excluirImagens();

		return $retorno;
	}

	public function alterarOrdem($ordem) {
		$query_uri = '';

		if (!empty($_SERVER['QUERY_STRING']))
			$query_uri .= '?' . $_SERVER['QUERY_STRING'];

		if ($ordem === 1) {
			$retorno = $this->alterarOrdemProximoDAO();
			if (!empty($retorno)) {
				$retorno['proximo']['img_mobile'] = URL_IMG . 'banners/mobile/' .$retorno['proximo']['img_mobile'];
				$retorno['proximo']['url_editar'] = URL . 'cadastros/banners/gerenciar-banners/edit/' . $retorno['proximo']['id'] . $query_uri;
			}
		} else {
			$retorno = $this->alterarOrdemAnteriorDAO();
			if (!empty($retorno)) {
				$retorno['anterior']['img_mobile'] = URL_IMG . 'banners/mobile/' .$retorno['anterior']['img_mobile'];
				$retorno['anterior']['url_editar'] = URL . 'cadastros/banners/gerenciar-banners/edit/' . $retorno['anterior']['id'] . $query_uri;
			}
		}

		return $retorno;
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

		if (!empty($this->file_imagem->getNomeImagem()) && file_exists(PATH_IMG . 'banners/' . $this->file_imagem->getNomeImagem()))
			unlink(PATH_IMG . 'banners/' . $this->file_imagem->getNomeImagem());

		if (!empty($this->file_tablet->getNomeImagem()) && file_exists(PATH_IMG . 'banners/tablet/' . $this->file_tablet->getNomeImagem()))
			unlink(PATH_IMG . 'banners/tablet/' . $this->file_tablet->getNomeImagem());

		if (!empty($this->file_mobile->getNomeImagem()) && file_exists(PATH_IMG . 'banners/mobile/' . $this->file_mobile->getNomeImagem()))
			unlink(PATH_IMG . 'banners/mobile/' . $this->file_mobile->getNomeImagem());

		if (!empty($this->file_mobile->getNomeImagem()) && file_exists(PATH_IMG . 'banners/thumbs/' . $this->file_mobile->getNomeImagem()))
			unlink(PATH_IMG . 'banners/thumbs/' . $this->file_mobile->getNomeImagem());

	}

}