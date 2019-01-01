<?php
namespace App\model;

use App\dao\UsuarioDao;
use App\model\Retorno;

if (! defined('ABSPATH')){
    header("Location: /");
    exit();
}

class Usuario extends UsuarioDao{
    private $id;
    private $data_cadastro;
    private $nome;
    private $login;
    private $senha;
    private $email;
    private $ativo;
    private $tipo;
    private $apelido;

    /**
     * Usuario constructor.
     * @param $data_cadastro
     * @param $nome
     * @param $login
     * @param $senha
     * @param $email
     * @param $ativo
     * @param $tipo
     * @param $apelido
     */
    public function __construct($data_cadastro = null, $nome = null, $login = null, $senha = null, $email = null, $ativo = null, $tipo = null, $apelido = null)
    {
        parent::__construct();
        $this->data_cadastro = !empty($data_cadastro) ? $data_cadastro : date("Y-m-d");
        $this->nome = $nome;
        $this->login = $login;
        $this->senha = $senha;
        $this->email = $email;
        $this->ativo = $ativo;
        $this->tipo = $tipo;
        $this->apelido = $apelido;
        $this->setUsuario($this);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return filter_var($this->id, FILTER_VALIDATE_INT);
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return false|string
     */
    public function getDataCadastro()
    {
        return $this->data_cadastro;
    }

    /**
     * @param false|string $data_cadastro
     */
    public function setDataCadastro($data_cadastro)
    {
        $this->data_cadastro = $data_cadastro;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param mixed $senha
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
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
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @return null
     */
    public function getApelido()
    {
        return $this->apelido;
    }

    /**
     * @param null $apelido
     */
    public function setApelido($apelido)
    {
        $this->apelido = $apelido;
    }

    public function Login()
    {
        $result = $this->loginDAO();

        if (!empty($result)) {

            if (password_verify($this->senha, $result["usu_senha"])) {

                $_SESSION["_idusuario"] = $result["usu_id"];
                $_SESSION["_logado"] = true;
                session_write_close();

                return true;

            } else {
                $this->setRetorno("usuário ou senha estão incorretos", true, false);
            }

        } elseif(empty($this->getRetorno()["exibir"])) {
            $this->setRetorno("Não foi possível fazer o login", true, false);
        }

    	return false;
    }

    public function carregarInformacoes() {
        return $this->carregarInformacoesDAO();
    }

    /*public function alterarSenha($token, $senhaAtual, $senhanova, $confSenha)
    {
        $usuDAO = new UsuarioDAO();
        if(!empty($senhaAtual) && !empty($senhanova) && !empty($confSenha)) :
            if(strcmp($token, $_SESSION["usuario-token"]) === 0) :
                $usu_retorno = $usuDAO->obterSenha($_SESSION["usuario-codigo"]);
                //verifica se a senha passada é a mesma que a do banco de dados
                if(password_verify($senhaAtual, $usu_retorno->getSenha())) :
                    if(strcmp($senhanova, $confSenha) === 0) :
                        $usuDAO->desconectar();
                        if(!empty($usuDAO->alterarSenha($_SESSION["usuario-codigo"], password_hash($senhanova, PASSWORD_DEFAULT)))) :
                            return true;
                        else :
                            $this->setRetorno($usuDAO->getRetorno()->getCodigo(),$usuDAO->getRetorno()->getTipo(),$usuDAO->getRetorno()->getMensagem());
                        endif;
                    else :
                        $this->setRetorno(0,3,"Valores informados nos Campos para Nova Senha estão Diferentes.");
                    endif;
                else :
                    $this->setRetorno(0,3,"Senha Atual Incorreta");
                endif;
            else :
                $this->setRetorno(0,3,"Token de Autenticação Inválido");
            endif;
        else :
            $this->setRetorno(0,3,"Todos os Campos Devem ser Preenchidos");
        endif;
        return false;
    }*/

    public function getRetorno() {
        return parent::getRetorno();
    }

}