<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 07/04/2019
 * Time: 14:24
 */

namespace App\dao;

use App\model\Banco;
use App\model\SecaoMenu;

if (! defined('ABSPATH')){
    header("Location: /");
    exit();
}

class SecaoMenuDao extends Banco
{
    private $secao;

    public function __construct(SecaoMenu $secao)
    {
        parent::__construct();
        $this->secao = $secao;
    }

    public function getRetorno() {
        return parent::getRetorno();
    }

    protected function limiteRegistroDAO($inicio, $fim) {

        if(!empty($this->Conectar())) :

            try
            {

                $stms = $this->getCon()->prepare("SELECT * FROM secao_menu ORDER BY ordem LIMIT :inicio,:fim");
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

                $stms = $this->getCon()->prepare("SELECT COUNT(*) total FROM secao_menu");
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
        $ordem = 1;
        if(!empty($this->Conectar())) :

            try
            {

                $result = $this->getCon()->query('SELECT MAX(ordem) + 1 as ordem FROM secao_menu');

                foreach ($result->fetch() as $result_ordem)
                    if ((int) $result_ordem)
                        $ordem = (int) $result_ordem;

                $stms = $this->getCon()->prepare("INSERT INTO secao_menu(nome, ativo, ordem) VALUES(:nome, :ativo, :ordem)");
                $stms->bindValue(":nome", $this->secao->getNome(), \PDO::PARAM_STR);
                $stms->bindValue(":ativo", $this->secao->getAtivo(), \PDO::PARAM_STR);
                $stms->bindValue(":ordem", $ordem, \PDO::PARAM_INT);

                return $stms->execute();

            }
            catch(\PDOException $e)
            {
                $this->setRetorno("Erro Ao Fazer a Consulta No Banco de Dados | ".$e->getMessage(), false, false);
            }

        endif;

        return false;
    }

    protected function alterarStatusDAO() {

		if(!empty($this->Conectar())) :

			try
			{

				$stms = $this->getCon()->prepare("UPDATE secao_menu SET ativo = :status WHERE idsecao_menu = :id LIMIT 1");
				$stms->bindValue(":status", $this->secao->getAtivo(), \PDO::PARAM_STR);
				$stms->bindValue(":id", $this->secao->getId(), \PDO::PARAM_INT);
				if ($stms->execute())
					return ($stms->rowCount() > 0) ? true : false;
				else
					return false;

			}
			catch(\PDOException $e)
			{
				$this->setRetorno("Erro Ao Fazer a Consulta No Banco de Dados | ".$e->getMessage(), false, false);
			}

		endif;

		return false;

	}

	protected function carregarDAO() {

		if(!empty($this->Conectar())) :

			try
			{

				$stms = $this->getCon()->prepare("SELECT nome FROM secao_menu WHERE idsecao_menu = :id LIMIT 1");
				$stms->bindValue(":id", $this->secao->getId(), \PDO::PARAM_INT);

				$stms->execute();

				$result = $stms->fetch();

				if (!empty($result)) {
					$this->secao->setNome($result['nome']);
					return true;
				}

			}
			catch(\PDOException $e)
			{
				$this->setRetorno("Erro Ao Fazer a Consulta No Banco de Dados | ".$e->getMessage(), false, false);
			}

		endif;

		return null;

	}

	protected function alterarDAO() {

		if(!empty($this->Conectar())) :

			try
			{

				$stms = $this->getCon()->prepare("UPDATE secao_menu SET nome = :nome WHERE idsecao_menu = :id LIMIT 1");
				$stms->bindValue(":nome", $this->secao->getNome(), \PDO::PARAM_STR);
				$stms->bindValue(":id", $this->secao->getId(), \PDO::PARAM_INT);

				if ($stms->execute())
					return $stms->rowCount();
				else
					return false;

			}
			catch(\PDOException $e)
			{
				$this->setRetorno("Erro Ao Fazer a Consulta No Banco de Dados | ".$e->getMessage(), false, false);
			}

		endif;

		return false;
	}

	protected function excluirDAO() {

		if(!empty($this->Conectar())) :

			try
			{

				$stms = $this->getCon()->prepare("DELETE FROM secao_menu WHERE idsecao_menu = :id");
				$stms->bindValue(":id", $this->secao->getId(), \PDO::PARAM_INT);
				if ($stms->execute())
					return $stms->rowCount();
				else
					return false;

			}
			catch(\PDOException $e)
			{
				$this->setRetorno("Erro Ao Fazer a Consulta No Banco de Dados | ".$e->getMessage(), false, false);
			}

		endif;

		return false;
	}

	protected function alterarOrdemAnteriorDAO() {
		$array_retorno = array();

		if(!empty($this->Conectar())) :

			try
			{
				$this->beginTransaction();

				$stms = $this->getCon()->prepare("SELECT idsecao_menu, nome, ordem, ativo FROM secao_menu WHERE idsecao_menu = :id LIMIT 1");
				$stms->bindValue(":id", $this->secao->getId(), \PDO::PARAM_INT);
				$stms->execute();
				$result = $stms->fetch();

				$stms = $this->getCon()->prepare("SELECT idsecao_menu, nome, ordem, ativo FROM secao_menu WHERE ordem < :ordem ORDER BY ordem DESC LIMIT 1");
				$stms->bindValue(":ordem", (int)$result['ordem'], \PDO::PARAM_INT);
				$stms->execute();
				$result2 = $stms->fetch();

				if (!empty($result) && !empty($result2)) {

					$stms = $this->getCon()->prepare("UPDATE secao_menu SET ordem = :ordem WHERE idsecao_menu = :id");
					$stms->bindValue(":ordem", (int)$result2['ordem'], \PDO::PARAM_INT);
					$stms->bindValue(":id", $result['idsecao_menu'], \PDO::PARAM_INT);
					$stms->execute();

					$stms = $this->getCon()->prepare("UPDATE secao_menu SET ordem = :ordem WHERE idsecao_menu = :id");
					$stms->bindValue(":ordem", (int)$result['ordem'], \PDO::PARAM_INT);
					$stms->bindValue(":id", $result2['idsecao_menu'], \PDO::PARAM_INT);
					$stms->execute();

					//$array_retorno['atual'] = $result;
					$array_retorno['anterior'] = $result2;

				}

				$this->commitar(!empty($array_retorno));
				return $array_retorno;
			}
			catch(\PDOException $e)
			{
				$this->setRetorno("Erro Ao Fazer a Consulta No Banco de Dados | ".$e->getMessage(), false, false);
			}

		endif;

		return $array_retorno;
	}

	protected function alterarOrdemProximoDAO() {
    	$array_retorno = array();

		if(!empty($this->Conectar())) :

			try
			{
				$this->beginTransaction();

				$stms = $this->getCon()->prepare("SELECT idsecao_menu, nome, ordem, ativo FROM secao_menu WHERE idsecao_menu = :id LIMIT 1");
				$stms->bindValue(":id", $this->secao->getId(), \PDO::PARAM_INT);
				$stms->execute();
				$result = $stms->fetch();

				$stms = $this->getCon()->prepare("SELECT idsecao_menu, nome, ordem, ativo FROM secao_menu WHERE ordem > :ordem ORDER BY ordem LIMIT 1");
				$stms->bindValue(":ordem", (int)$result['ordem'], \PDO::PARAM_INT);
				$stms->execute();
				$result2 = $stms->fetch();

				if (!empty($result) && !empty($result2)) {

					$stms = $this->getCon()->prepare("UPDATE secao_menu SET ordem = :ordem WHERE idsecao_menu = :id");
					$stms->bindValue(":ordem", (int)$result2['ordem'], \PDO::PARAM_INT);
					$stms->bindValue(":id", $result['idsecao_menu'], \PDO::PARAM_INT);
					$stms->execute();

					$stms = $this->getCon()->prepare("UPDATE secao_menu SET ordem = :ordem WHERE idsecao_menu = :id");
					$stms->bindValue(":ordem", (int)$result['ordem'], \PDO::PARAM_INT);
					$stms->bindValue(":id", $result2['idsecao_menu'], \PDO::PARAM_INT);
					$stms->execute();

					//$array_retorno['atual'] = $result;
					$array_retorno['proximo'] = $result2;

				}

				$this->commitar(!empty($array_retorno));
				return $array_retorno;

			}
			catch(\PDOException $e)
			{
				$this->setRetorno("Erro Ao Fazer a Consulta No Banco de Dados | ".$e->getMessage(), false, false);
			}

		endif;

		return $array_retorno;

	}

	protected function listarTodasDAO() {

		if(!empty($this->Conectar())) :

			try
			{

				$stms = $this->getCon()->prepare("SELECT idsecao_menu, nome FROM secao_menu ORDER BY ordem");

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

}