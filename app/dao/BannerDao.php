<?php

namespace App\dao;

use App\model\Banco;
use App\model\Banner;

if (! defined('ABSPATH'))
	die;

class BannerDao extends Banco
{
	private $banner;

	public function __construct(Banner $banner)
	{
		parent::__construct();
		$this->banner = $banner;
	}

	public function getRetorno() {
		return parent::getRetorno();
	}

	protected function limiteRegistroDAO($inicio, $fim) {

		if(!empty($this->Conectar())) :

			try
			{

				$stms = $this->getCon()->prepare('SELECT * FROM banners ORDER BY ordem, idbanner LIMIT :inicio,:fim');
				$stms->bindValue(':inicio', $inicio, \PDO::PARAM_INT);
				$stms->bindValue(':fim', $fim, \PDO::PARAM_INT);

				$stms->execute();
				return $stms->fetchAll();

			}
			catch(\PDOException $e)
			{
				$this->setRetorno('Erro Ao Fazer a Consulta No Banco de Dados | '.$e->getMessage(), false, false);
			}

		endif;

		return array();
	}

	protected function totalRegistrosDAO() {

		if(!empty($this->Conectar())) :

			try
			{

				$stms = $this->getCon()->prepare('SELECT COUNT(*) total FROM banner');
				$stms->execute();
				$result = $stms->fetch(\PDO::FETCH_ASSOC);

				if (!empty($result))
					return $result['total'];

			}
			catch(\PDOException $e)
			{
				$this->setRetorno('Erro Ao Fazer a Consulta No Banco de Dados | '.$e->getMessage(), false, false);
			}

		endif;

		return 0;
	}

}