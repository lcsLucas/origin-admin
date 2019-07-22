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

				$stms = $this->getCon()->prepare('SELECT * FROM banner ORDER BY ordem, idbanner LIMIT :inicio,:fim');
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

	protected function cadastrarDAO() {
		$ordem = 1;
		if(!empty($this->Conectar())) :

			try
			{

				$result = $this->getCon()->query('SELECT MAX(ordem) + 1 as ordem FROM banner');

				foreach ($result->fetch() as $result_ordem)
					if ((int) $result_ordem)
						$ordem = (int) $result_ordem;

				$stms = $this->getCon()->prepare('INSERT INTO banner(data_cadastro, titulo, subtitulo, link, opt_titulos, opt_externo, ativo, ordem) VALUES(:dt_cadastro, :titulo, :subtitulo, :link, :opt_titulos, :opt_externo, :ativo, :ordem)');
				$stms->bindValue(':titulo', $this->banner->getTitulo(), \PDO::PARAM_STR);
				$stms->bindValue(':dt_cadastro', $this->banner->getDataCadastro(), \PDO::PARAM_STR);
				$stms->bindValue(':subtitulo', $this->banner->getSubTitulo(), \PDO::PARAM_STR);
				$stms->bindValue(':link', $this->banner->getLinkBanner(), \PDO::PARAM_STR);
				$stms->bindValue(':opt_titulos', $this->banner->getOptExibirTexto(), \PDO::PARAM_STR);
				$stms->bindValue(':opt_externo', $this->banner->getOptJanela(), \PDO::PARAM_STR);
				$stms->bindValue(':ativo', $this->banner->getAtivo(), \PDO::PARAM_STR);
				$stms->bindValue(':ordem', $ordem, \PDO::PARAM_INT);

				return $stms->execute();

			}
			catch(\PDOException $e)
			{
				$this->setRetorno('Erro Ao Fazer a Consulta No Banco de Dados | '.$e->getMessage(), false, false);
			}

		endif;

		return false;
	}

}