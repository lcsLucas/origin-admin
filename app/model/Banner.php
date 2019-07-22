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
		$this->data_cadastro = $this->data_alteracao = date('Y-m-d');
		$this->titulo = $titulo;
		$this->sub_titulo = $sub_titulo;
		$this->link_banner = $link_banner;
		$this->ativo = $ativo;
		$this->opt_janela = $opt_janela;
		$this->opt_exibir_texto = $opt_exibir_texto;
		$this->file_imagem = $this->file_tablet = $this->file_mobile = new ManipulacaoImagem();
		$this->nome_imagem = $this->nome_tablet = $this->nome_mobile = '';
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

	public  function paginacao($incio, $fim) {
		return $this->limiteRegistroDAO($incio, $fim);
	}

	public function totalRegistros() {
		return $this->totalRegistrosDAO();
	}

	public function cadastrar() {
	    $result = false;

        if ($this->conectar()) {
            $this->beginTransaction();
            $result = $this->cadastrarDAO();

            if ($result && !empty($this->file_imagem)) {
                $this->file_imagem->setNomeImagem($this->slug($this->titulo) .'-'. $this->getId() . $this->file_imagem->getTipoImagem());

                /* Gravar as imagens do banner
                 *
                 *
                if (!empty($this->file_imagem->getDadosImagem())) {

                    $result = $this->file_imagem->salvarImagemDados(PATH_IMG . 'banners/', 200, 200);

                    if (!$result && !empty($this->file_imagem->getRetorno()))
                        $this->setRetorno($this->file_imagem->getRetorno()['mensagem'], $this->file_imagem->getRetorno()['exibir'], $this->file_imagem->getRetorno()['status']);


                } else {

                }*/

            }

            $this->commitar(false);

        }


        return $result;
	}

	public function alterarStatus() {
		return $this->alterarStatusDAO();
	}

	public function carregar() {
		return $this->carregarDAO();
	}

	public function alterar() {
		return $this->alterarDAO();
	}

	public function excluir() {
		return $this->excluirDAO();
	}

	public function alterarOrdem($ordem) {
		$query_uri = '';

		if (!empty($_SERVER['QUERY_STRING']))
			$query_uri .= '?' . $_SERVER['QUERY_STRING'];

		if ($ordem === 1) {
			$retorno = $this->alterarOrdemProximoDAO();
			$retorno['proximo']['url_editar'] = URL . 'permissoes/gerenciar-secoes-menus/edit/' . $retorno['proximo']['idsecao_menu'] . $query_uri;
		} else {
			$retorno = $this->alterarOrdemAnteriorDAO();
			$retorno['anterior']['url_editar'] = URL . 'permissoes/gerenciar-secoes-menus/edit/' . $retorno['anterior']['idsecao_menu'] . $query_uri;
		}

		return $retorno;
	}

	private function slug($string) {
        $table = array(
            'Š'=>'S', 'š'=>'s', 'Đ'=>'Dj', 'đ'=>'dj', 'Ž'=>'Z', 'ž'=>'z', 'Č'=>'C', 'č'=>'c', 'Ć'=>'C', 'ć'=>'c',
            'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
            'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
            'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
            'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
            'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b',
            'ÿ'=>'y', 'Ŕ'=>'R', 'ŕ'=>'r', '/' => '-', ' ' => '-'
        );

        // -- Remove duplicated spaces
        $stripped = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $string);

        // -- Returns the slug
        return strtolower(strtr($string, $table));
    }

}