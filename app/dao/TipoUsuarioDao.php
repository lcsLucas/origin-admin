<?php
/**
 * Created by PhpStorm.
 * Date: 17/01/2019
 * Time: 13:58
 */

namespace App\dao;

use App\model\Banco;
use App\model\TipoUsuario;
use App\model\Retorno;

if (! defined('ABSPATH')){
    header("Location: /");
    exit();
}


class TipoUsuarioDao extends Banco
{
    private $tipo_usuario;

    public function __construct()
    {
        parent::__construct();
    }

    protected function setTipoUsuario(TipoUsuario $tipo) {
        $this->tipo_usuario = $tipo;
    }

    public function getRetorno() {
        return parent::getRetorno();
    }

    protected function cadastrarDAO() {

        if(!empty($this->Conectar())) :

            try
            {

                $stms = $this->getCon()->prepare("INSERT INTO tipo_usuario(tip_dtCad, tip_nome, tip_ativo, tip_administrador) VALUES(:data, :nome, :ativo, :adm)");
                $stms->bindValue(":data", $this->tipo_usuario->getDataCadastro(), \PDO::PARAM_STR);
                $stms->bindValue(":nome", $this->tipo_usuario->getNome(), \PDO::PARAM_STR);
                $stms->bindValue(":ativo", $this->tipo_usuario->getAtivo(), \PDO::PARAM_STR);
                $stms->bindValue(":adm", $this->tipo_usuario->getFlagAdm(), \PDO::PARAM_STR);

                return $stms->execute();

            }
            catch(\PDOException $e)
            {
                $this->setRetorno("Erro Ao Fazer a Consulta No Banco de Dados | ".$e->getMessage(), false, false);
            }

        endif;

        return false;
    }

    protected function limiteRegistroDAO($inicio, $fim) {

        if(!empty($this->Conectar())) :

            try
            {

                $stms = $this->getCon()->prepare("SELECT * FROM tipo_usuario ORDER BY tip_nome LIMIT :inicio,:fim");
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

                $stms = $this->getCon()->prepare("SELECT COUNT(*) total FROM tipo_usuario");
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

    protected function carregarDAO() {

        if(!empty($this->Conectar())) :

            try
            {

                $stms = $this->getCon()->prepare("SELECT tip_nome FROM tipo_usuario WHERE tip_id = :id LIMIT 1");
                $stms->bindValue(":id", $this->tipo_usuario->getId(), \PDO::PARAM_INT);

                $stms->execute();
                return $stms->fetch();

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

                $stms = $this->getCon()->prepare("UPDATE tipo_usuario SET tip_nome = :nome WHERE tip_id = :id");
                $stms->bindValue(":nome", $this->tipo_usuario->getNome(), \PDO::PARAM_STR);
                $stms->bindValue(":id", $this->tipo_usuario->getId(), \PDO::PARAM_INT);
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

    protected function carregarTipoUsuarioDAO($idusuario) {

        if(!empty($this->Conectar())) :
            try
            {
                $stms = $this->getCon()->prepare("SELECT t.tip_id, t.tip_administrador FROM usuario u INNEr JOIN tipo_usuario t ON t.tip_id = u.tip_id WHERE u.usu_id = :codigo LIMIT 1");
                $stms->bindValue(":codigo", $idusuario, \PDO::PARAM_INT);
                $stms->execute();
                return $stms->fetch();
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

                $stms = $this->getCon()->prepare("UPDATE tipo_usuario SET tip_ativo = :status WHERE tip_id = :id AND tip_id <> 1 LIMIT 1");
                $stms->bindValue(":status", $this->tipo_usuario->getAtivo(), \PDO::PARAM_STR);
                $stms->bindValue(":id", $this->tipo_usuario->getId(), \PDO::PARAM_INT);
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

    protected function excluirDAO() {

        if(!empty($this->Conectar())) :

            try
            {

                $stms = $this->getCon()->prepare("DELETE FROM tipo_usuario WHERE tip_id = :id AND tip_id <> 1");
                $stms->bindValue(":id", $this->tipo_usuario->getId(), \PDO::PARAM_INT);
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

    protected function listarTodosDAO() {

        if(!empty($this->Conectar())) :
            try
            {
                $stms = $this->getCon()->prepare("SELECT tip_id, tip_nome FROM tipo_usuario WHERE tip_ativo = '1' ORDER BY tip_nome");
                $stms->execute();
                return $stms->fetchAll();
            }
            catch(\PDOException $e)
            {
                $this->setRetorno("Erro Ao Fazer a Consulta No Banco de Dados | ".$e->getMessage(), false, false);
            }
        endif;
        return null;

    }

}