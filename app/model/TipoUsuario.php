<?php
namespace App\model;

use App\dao\TipoUsuarioDao;

if (! defined('ABSPATH')){
    header("Location: /");
    exit();
}

class TipoUsuario extends TipoUsuarioDao{
    private $id;
    private $nome;
    private $data_cadastro;
    private $ativo;
    private $flag_adm;

    /**
     * TipoUsuario constructor.
     * @param $nome
     * @param $ativo
     */
    public function __construct($nome=null, $ativo='0')
    {
        parent::__construct();
        $this->nome = $nome;
        $this->ativo = $ativo;
        $this->flag_adm = '0';
        $this->data_cadastro = date("Y-m-d");
        $this->setTipoUsuario($this);
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome(string $nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getDataCadastro()
    {
        return $this->data_cadastro;
    }

    /**
     * @param mixed $data_cadastro
     */
    public function setDataCadastro($data_cadastro)
    {
        $this->data_cadastro = $data_cadastro;
    }

    /**
     * @return mixed
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * @param mixed $ativo
     */
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
    }

    /**
     * @return mixed
     */
    public function getFlagAdm()
    {
        return $this->flag_adm;
    }

    /**
     * @param mixed $flag_adm
     */
    public function setFlagAdm($flag_adm)
    {
        $this->flag_adm = $flag_adm;
    }

    public function getRetorno() {
        return parent::getRetorno();
    }

    public function cadastrar() {
        return $this->cadastrarDAO();
    }

    public  function paginacao($incio, $fim) {
        return $this->limiteRegistroDAO($incio, $fim);
    }

    public function totalRegistros() {
        return $this->totalRegistrosDAO();
    }

    public function carregar() {

        $result = $this->carregarDAO();

        if (!empty($result)) {

            $this->nome = $result["tip_nome"];
            return true;

        }

        return false;
    }

    public function alterar() {

        $retorno = $this->alterarDAO();

        if (!empty($retorno))
            return true;
        else if(intval($retorno) === 0)
            $this->setRetorno("Tipo de usuários não foi alterado, tente novamente", true, false);

        return false;
    }
    public function carregarTipoUsuario() {
        $retorno = $this->carregarTipoUsuarioDAO($_SESSION["_idusuario"]);
        return empty($retorno) ? 0 : $retorno["tip_id"];
    }

}