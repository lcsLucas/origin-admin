<?php

namespace App\dao;

use App\model\Banco;
use App\model\Configuracao;

if (! defined('ABSPATH'))
	die;

class ConfiguracaoDao extends Banco
{
	private $configuracao;

	public function __construct(Configuracao $configuracao)
	{
		parent::__construct();
		$this->configuracao = $configuracao;
	}

	public function getRetorno() {
		return parent::getRetorno();
	}

	protected function verificaDAO() {

		if(!empty($this->Conectar())) :

			try
			{
				$stms = $this->getCon()->prepare('SELECT logo_site, favicon_site, COUNT(*) total FROM configuracao');
				$stms->execute();
				$result = $stms->fetch();
				if (!empty($result)) {
					$this->configuracao->getFileLogo()->setNomeImagem($result['logo_site']);
					$this->configuracao->getFileFavicon()->setNomeImagem($result['logo_site']);
					return true;
				}
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

	protected function cadastrarDAO() {

		if(!empty($this->Conectar())) :

			try
			{
				$stms = $this->getCon()->prepare('INSERT INTO configuracao(nome_site, resumo_site) VALUES(:nome, :resumo)');
				$stms->bindValue(':nome', $this->configuracao->getNomeSite(), \PDO::PARAM_STR);
				$stms->bindValue(':resumo', $this->configuracao->getResumoSite(), \PDO::PARAM_STR);

				return $stms->execute();
			}
			catch(\PDOException $e)
			{
				$this->setRetorno('Erro Ao Fazer a Consulta No Banco de Dados | '.$e->getMessage(), false, false);
			}

		endif;

		return false;
	}

	protected function alterarDAO() {

		if(!empty($this->Conectar())) :

			try
			{

				$stms = $this->getCon()->prepare('UPDATE configuracao SET nome_site = :nome, resumo_site = :resumo LIMIT 1');
				$stms->bindValue(':nome', $this->configuracao->getNomeSite(), \PDO::PARAM_STR);
				$stms->bindValue(':resumo', $this->configuracao->getResumoSite(), \PDO::PARAM_STR);

				if ($stms->execute())
					return ($stms->rowCount() >= 0) ? true : false;
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

	protected function alterarImagensBancoDAO() {

		if(!empty($this->Conectar())) :

			try
			{

				$stms = $this->getCon()->prepare('UPDATE configuracao SET logo_site = :logo, favicon_site = :favicon LIMIT 1');
				$stms->bindValue(':logo', $this->configuracao->getFileLogo()->getNomeImagem(), \PDO::PARAM_STR);
				$stms->bindValue(':favicon', $this->configuracao->getFileFavicon()->getNomeImagem(), \PDO::PARAM_STR);

				if ($stms->execute())
					return ($stms->rowCount() >= 0) ? true : false;
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
				$stms = $this->getCon()->prepare('SELECT * FROM configuracao LIMIT 1');
				$stms->execute();
				$result = $stms->fetch();

				if (!empty($result)) {
					$this->configuracao->setNomeSite($result['nome_site']);
					$this->configuracao->setResumoSite($result['resumo_site']);
					$this->configuracao->getFileLogo()->setNomeImagem($result['logo_site']);
					$this->configuracao->getFileFavicon()->setNomeImagem($result['favicon_site']);

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

}