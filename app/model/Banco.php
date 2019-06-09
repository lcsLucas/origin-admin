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

    public function __construct()
    {
        $this->retorno = new Retorno();
    }

    public function conectar($persist = false)
    {
        if(empty($this->getCon())) :

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
                $this->con->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

                return true;
            }
            catch(\PDOException $e)
            {
                $this->setRetorno("Erro Ao Conectar Com o Banco de Dados | ".$e->getMessage(), false, false);
                return null;
            }

        else :
            return true;

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

    /**
     * define o retorno da requisição
     * @param  string $mensagem = mensagem do retorno
     * @param  boolean $flag_exibir = flag que diz se é pra ser mostrado ao usuario a mensagem
     * @param  boolean $flag_status = flag que diz se o retono é um erro ou não
     * @return void
     */
    public function setRetorno($mensagem, $flag_exibir, $flag_status) {
        $this->retorno->setRetorno($mensagem, $flag_exibir, $flag_status);

        if (!$flag_exibir)
            error_log($mensagem."\n", 3, ABSPATH . "erros-sistema.log");
    }

    public function getRetorno() {
        return $this->retorno->getRetorno();
    }

}