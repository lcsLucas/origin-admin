<?php


	namespace App\dao;

	use App\model\Banco;
	use App\model\Menu;

	if (! defined('ABSPATH')){
		header('Location: /');
		exit();
	}


	class MenuDao extends Banco
	{
		private $menu;

		public function __construct(Menu $menu)
		{
			parent::__construct();
			$this->menu = $menu;
		}

		public function getRetorno() {
			return parent::getRetorno();
		}

		protected function limiteRegistroDAO($inicio, $fim) {

			if(!empty($this->Conectar())) :

				try
				{

					$stms = $this->getCon()->prepare("SELECT * FROM menu WHERE menu_pai IS NULL ORDER BY ordem LIMIT :inicio,:fim");
					$stms->bindValue(":inicio", $inicio, \PDO::PARAM_INT);
					$stms->bindValue(":fim", $fim, \PDO::PARAM_INT);

					$stms->execute();
					return $stms->fetchAll();

				}
				catch(\PDOException $e)
				{
					$this->setRetorno("Erro Ao Fazer a Consulta No Banco de Dados | ".$e->getMessage(), false, false);
				}

			endif;

			return array();
		}

		protected function totalRegistrosDAO() {

			if(!empty($this->Conectar())) :

				try
				{

					$stms = $this->getCon()->prepare("SELECT COUNT(*) total FROM menu WHERE menu_pai IS NULL");
					$stms->execute();
					$result = $stms->fetch(\PDO::FETCH_ASSOC);

					if (!empty($result))
						return $result["total"];

				}
				catch(\PDOException $e)
				{
					$this->setRetorno("Erro Ao Fazer a Consulta No Banco de Dados | ".$e->getMessage(), false, false);
				}

			endif;

			return 0;
		}

		protected function cadastrarDAO() {

		}

	}