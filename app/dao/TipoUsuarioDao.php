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
                $stms->bindValue(":data", $this->tipo_usuario->getDataCadastro());
                $stms->bindValue(":nome", $this->tipo_usuario->getNome());
                $stms->bindValue(":ativo", $this->tipo_usuario->getAtivo());
                $stms->bindValue(":adm", $this->tipo_usuario->getFlagAdm());

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

}