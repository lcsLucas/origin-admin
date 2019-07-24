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
				$stms->bindValue(':dt_cadastro', $this->banner->getDataCadastro(), \PDO::PARAM_STR);
				$stms->bindValue(':titulo', $this->banner->getTitulo(), \PDO::PARAM_STR);
				$stms->bindValue(':subtitulo', $this->banner->getSubTitulo(), \PDO::PARAM_STR);
				$stms->bindValue(':link', $this->banner->getLinkBanner(), \PDO::PARAM_STR);
				$stms->bindValue(':opt_titulos', $this->banner->getOptExibirTexto(), \PDO::PARAM_STR);
				$stms->bindValue(':opt_externo', $this->banner->getOptJanela(), \PDO::PARAM_STR);
				$stms->bindValue(':ativo', $this->banner->getAtivo(), \PDO::PARAM_STR);
				$stms->bindValue(':ordem', $ordem, \PDO::PARAM_INT);

				if ($stms->execute()) {
					$this->banner->setId($this->getCon()->lastInsertId());
					return true;
				}

			}
			catch(\PDOException $e)
			{
				$this->setRetorno('Erro Ao Fazer a Consulta No Banco de Dados | '.$e->getMessage(), false, false);
			}

		endif;

		return false;
	}

	protected function alterarImagensBancoDAO() {
		if(!empty($this->Conectar())) :

			try
			{

				$stms = $this->getCon()->prepare('UPDATE banner SET img_principal = :destaque, img_tablet = :tablet, img_mobile = :mobile WHERE idbanner = :id LIMIT 1');
				$stms->bindValue(':destaque', $this->banner->getFileImagem()->getNomeImagem(), \PDO::PARAM_STR);
				$stms->bindValue(':tablet', $this->banner->getFileTablet()->getNomeImagem(), \PDO::PARAM_STR);
				$stms->bindValue(':mobile', $this->banner->getFileMobile()->getNomeImagem(), \PDO::PARAM_STR);
				$stms->bindValue(':id', $this->banner->getId(), \PDO::PARAM_INT);
				if ($stms->execute())
					return ($stms->rowCount() > 0) ? true : false;
				else
					return false;

			}
			catch(\PDOException $e)
			{
				$this->setRetorno('Erro Ao Fazer a Consulta No Banco de Dados | '.$e->getMessage(), false, false);
			}

		endif;

		return false;
	}

	protected function alterarStatusDAO() {

		if(!empty($this->Conectar())) :

			try
			{

				$stms = $this->getCon()->prepare('UPDATE banner SET ativo = :status WHERE idbanner = :id LIMIT 1');
				$stms->bindValue(':status', $this->banner->getAtivo(), \PDO::PARAM_STR);
				$stms->bindValue(':id', $this->banner->getId(), \PDO::PARAM_INT);
				if ($stms->execute())
					return ($stms->rowCount() > 0) ? true : false;
				else
					return false;

			}
			catch(\PDOException $e)
			{
				$this->setRetorno('Erro Ao Fazer a Consulta No Banco de Dados | '.$e->getMessage(), false, false);
			}

		endif;

		return false;

	}

	protected function carregarDAO() {
		if(!empty($this->Conectar())) :

			try
			{

				$stms = $this->getCon()->prepare('SELECT titulo, subtitulo, link, opt_titulos, opt_externo, img_principal, img_tablet, img_mobile FROM banner WHERE idbanner = :id LIMIT 1');
				$stms->bindValue(':id', $this->banner->getId(), \PDO::PARAM_INT);

				$stms->execute();

				$result = $stms->fetch();

				if (!empty($result)) {
					$this->banner->setTitulo($result['titulo']);
					$this->banner->setSubTitulo($result['subtitulo']);
					$this->banner->setLinkBanner($result['link']);
					$this->banner->setOptExibirTexto($result['opt_titulos']);
					$this->banner->setOptJanela($result['opt_externo']);
					$this->banner->getFileImagem()->setNomeImagem($result['img_principal']);
					$this->banner->getFileTablet()->setNomeImagem($result['img_tablet']);
					$this->banner->getFileMobile()->setNomeImagem($result['img_mobile']);

					return true;
				}

			}
			catch(\PDOException $e)
			{
				$this->setRetorno('Erro Ao Fazer a Consulta No Banco de Dados | '.$e->getMessage(), false, false);
			}

		endif;

		return null;
	}

}