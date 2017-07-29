<?php

namespace App\Util;

use App\model\Retorno;

if (! defined('ABSPATH')){
    header("Location: /");
    exit();
}
/**
 * Classe responsavel pela coneção com o banco de dados, utilizando o PDO
 */
class Banco{
    /**
     * constantes definida no config.php, carregado no inicio.
     */
    private $dsn = 'mysql:host='.DB_HOST.';port=3306;dbname='.DB_NAME.';charset='.DB_CHARSET;
    private $usuario = DB_USER;
    private $senha = DB_PASSWORD;
    private $retorno;

    private $con;

    public function Conectar()
    {
        if(empty($this->getCon())) :
            $this->retorno = null;
            try
            {
                $this->con = new \PDO( $this->dsn, $this->usuario, $this->senha );
                $this->con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                return true;
            }
            catch(\PDOException $e)
            {
                $this->setRetorno($e->getCode(),2,"Erro Ao Conectar Com o Banco de Dados | ".$e->getMessage());
                return null;
            }
        endif;
    }

    public function getCon()
    {
        return $this->con;
    }

    public function beginTransaction()
    {
        $this->con->beginTransaction();
    }

    public function rollBack()
    {
        $this->con->rollBack();
    }

    public function getLastInsertId()
    {
        return $this->con->lastInsertId();
    }

    public function commit()
    {
        $this->con->commit();
    }

    public function desconectar()
    {
        return $this->con = null;
    }

    public function getRetorno()
    {
        return $this->retorno;
    }

    public function setRetorno($codigo = 0, $tp = 0, $msg = "")
    {
        $this->retorno = new Retorno();
        $this->retorno->setRetorno( $codigo , $tp , $msg );
    }
}