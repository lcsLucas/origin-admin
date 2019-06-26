<?php


	namespace App\model;

	use App\dao\MenuDao;

	if (! defined('ABSPATH')){
		header('Location: /');
		exit();
	}

	class Menu extends MenuDao
	{
		private $id;
		private $nome;
		private $url;
		private $icone;
		private $ordem;
		private $ativo;
		private $menu_pai;
		private $secao_menu;

		/**
		 * Menu constructor.
		 * @param $nome
		 * @param $url
		 * @param $ativo
		 * @param $ordem
		 */
		public function __construct($nome='', $url='', $ativo = '0', $ordem=null)
		{
			parent::__construct($this);
			$this->nome = $nome;
			$this->url = $url;
			$this->ativo = $ativo;
			$this->ordem = $ordem;
			$this->icone = null;
			$this->menu_pai = null;
			$this->secao_menu = null;
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
		 * @return string
		 */
		public function getNome(): string
		{
			return $this->nome;
		}

		/**
		 * @param string $nome
		 */
		public function setNome(string $nome): void
		{
			$this->nome = $nome;
		}

		/**
		 * @return string
		 */
		public function getUrl(): string
		{
			return $this->url;
		}

		/**
		 * @param string $url
		 */
		public function setUrl(string $url): void
		{
			$this->url = $url;
		}

		/**
		 * @return null
		 */
		public function getIcone()
		{
			return $this->icone;
		}

		/**
		 * @param null $icone
		 */
		public function setIcone($icone): void
		{
			$this->icone = $icone;
		}

		/**
		 * @return null
		 */
		public function getOrdem()
		{
			return $this->ordem;
		}

		/**
		 * @param null $ordem
		 */
		public function setOrdem($ordem): void
		{
			$this->ordem = $ordem;
		}

		/**
		 * @return null
		 */
		public function getMenuPai()
		{
			return $this->menu_pai;
		}

		/**
		 * @param null $menu_pai
		 */
		public function setMenuPai($menu_pai): void
		{
			$this->menu_pai = $menu_pai;
		}

		/**
		 * @return null
		 */
		public function getSecaoMenu()
		{
			return $this->secao_menu;
		}

		/**
		 * @param null $secao_menu
		 */
		public function setSecaoMenu($secao_menu): void
		{
			$this->secao_menu = $secao_menu;
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
			return $this->cadastrarDAO();
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

	}