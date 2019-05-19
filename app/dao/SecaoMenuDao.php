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
        if(!empty($this->Conectar())) :

            try
            {
                $stms = $this->getCon()->prepare("INSERT INTO secao_menu(nome, ativo) VALUES(:nome, :ativo)");
                $stms->bindValue(":nome", $this->secao->getNome(), \PDO::PARAM_STR);
                $stms->bindValue(":ativo", $this->secao->getAtivo(), \PDO::PARAM_STR);

                return $stms->execute();

            }
            catch(\PDOException $e)
            {
                $this->setRetorno("Erro Ao Fazer a Consulta No Banco de Dados | ".$e->getMessage(), false, false);
            }

        endif;

        return false;
    }

}