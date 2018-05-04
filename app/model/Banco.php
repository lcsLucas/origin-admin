<?php

namespace App\model;

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

    public function conectar($persist = false)
    {
        if(empty($this->getCon())) :
            $this->retorno = null;
            try
            {
                // verifica se a conexao deve ser persistente ou nao. Util quando deve ser feito varias operações
                // em uma mesma conexao aberta. Ex: varias transações de uma fez e uma entrelaçada na outra
                if ($persist) :
                    $this->con = new \PDO( $this->dsn, $this->usuario, $this->senha, array(\PDO::ATTR_PERSISTENT => TRUE));
                else :
                    $this->con = new \PDO( $this->dsn, $this->usuario, $this->senha);
                endif;

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

    public function getLastInsertId()
    {
        return $this->con->lastInsertId();
    }

    public function commitar($resp)
    {
        if ($resp) {
            return $this->con->commit();
        } else {
            return $this->con->rollBack();
        }        
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