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

    /**
     * Usuario constructor.
     * @param $data_cadastro
     * @param $nome
     * @param $login
     * @param $senha
     * @param $email
     * @param $ativo
     * @param $tipo
     */
    public function __construct($data_cadastro = null, $nome = null, $login = null, $senha = null, $email = null, $ativo = null, $tipo = null)
    {
        $this->data_cadastro = !empty($data_cadastro) ? $data_cadastro : date("Y-m-d");
        $this->nome = $nome;
        $this->login = $login;
        $this->senha = $senha;
        $this->email = $email;
        $this->ativo = $ativo;
        $this->tipo = $tipo;
        $this->setUsuario($this);
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

    public function Login()
    {
        $retono = $this->loginDAO($this);

        /*if (!empty($usu_retorno)) :
            if (password_verify($senha, $usu_retorno->getSenha())) :
                $_SESSION['usuario-codigo'] = $usu_retorno->getId();
                $_SESSION['usuario-nome'] = $usu_retorno->getNome();
                $_SESSION['usuario-status'] = $usu_retorno->getStatus();
                $_SESSION['usuario-token'] = password_hash($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'], PASSWORD_DEFAULT);

                return true;
            else :
                $this->setRetorno(0,3,"Informações Incorreta. Verifique o Login e Senha.");
            endif;
        else :
            if(!empty($usuDao->getRetorno())) :
                $this->setRetorno($usuDao->getRetorno()->getCodigo(),$usuDao->getRetorno()->getTipo(),$usuDao->getRetorno()->getMensagem());
            else :
                $this->setRetorno(0,3,"Informações Incorreta. Verifique o Login e Senha.");
            endif;
        endif;*/

    	return false;
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


}