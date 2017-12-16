<?php
namespace App\model;

use App\dao\UsuarioDao;
use App\model\Retorno;

if (! defined('ABSPATH')){
    header("Location: /");
    exit();
}

class Usuario {
	private $id;
	private $dtCad;
	private $login;
	private $nome;
	private $senha;
	private $status;
	private $ativo;
	private $retorno;

	public function __construct($id = 0, $dtCad = null, $login = "", $nome = "", $senha = "", $status = "", $ativo = "")
	{
		$this->id = $id;
		$this->dtCad = $dtCad;
		$this->login = $login;
		$this->nome = $nome;
		$this->senha = $senha;
		$this->status = $status;
		$this->ativo = $ativo;
		$this->retorno = new Retorno();
	}

	public function getId(){
		return $this->id;
	}

	public function setId(int $id){
		$this->id = $id;
	}

	public function getDtCad(){
		return $this->dtCad;
	}

	public function setDtCad($dtCad){
		$this->dtCad = $dtCad;
	}

	public function getLogin(){
		return $this->login;
	}

	public function setLogin($login){
		$this->login = $login;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getSenha(){
		return $this->senha;
	}

	public function setSenha($senha){
		$this->senha = $senha;
	}

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
	}

	public function getAtivo(){
		return $this->ativo;
	}

	public function setAtivo($ativo){
		$this->ativo = $ativo;
	}

    public function getRetorno() {
        return $this->retorno;
    }

    public function setRetorno($codigo = 0, $tp = 0, $msg = ""){
        $this->retorno->setRetorno( $codigo , $tp , $msg );
    }

    public function Login($usuario, $senha, $token)
    {
    	$ok = false;

    	/*Validação das entradas*/
		if (!empty($usuario)) :
			if (!empty($senha)) :
				/*validando se o login está sendo feito pelo formulário*/
				if (password_verify($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'], $token)) :
                    $usuDao = new UsuarioDao();
                    $usu_retorno = $usuDao->login($usuario);

                    if (!empty($usu_retorno)) :
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
                    endif;
				else :
					$this->setRetorno(0,3,'Token de autenticação inválido.');
				endif;
			else :
				$this->setRetorno(0,3,"Senha não informada.");
			endif;
		else :
			$this->setRetorno(0,3,"Usuário não informado.");
		endif;

    	return false;
    }

    public function alterarSenha($token, $senhaAtual, $senhanova, $confSenha)
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
    }

    public function novoUsuario($nome, $login, $senha, $confSenha, $status, $token)
    {
        return false;
    }

    private function validaNovoUsuario($nome, $login, $senha, $confSenha, $status, $token)
    {
        if(strcmp($token, $_SESSION["token"]) === 0) ://Token do formulario, deve ser igual ao do usuário logado.
            if(!empty($nome)) :
                if(!empty($login)) :
                    $usuDAO = new UsuarioDAO();
                    $result = $usuDAO->verificaLoginUsuario($login);

                    if($result >= 0) :
                        if($result == 0 || $codigo != 0) :
                            if(!empty($senha) && ctype_alnum($senha)) :
                                if(strlen($nome) <= 50 && strlen($login) <= 50 && strlen($senha) <= 30) :
                                    if(strcasecmp($senha, $confSenha) == 0) :
                                        return true;
                                    else :
                                        $this->setRetorno(2,3,"Erro no envio dos Parametros. \"As senhas não são iguais\"");
                                    endif;
                                else :
                                    $this->setRetorno(2,3,"Ultrapassado o Limite de Caracteres do Nome e/ou Login e/ou Senha.");
                                endif;
                            else :
                                $this->setRetorno(2,3,"Erro no envio dos Parametros. \"Senha está Inválida\"");
                            endif;
                        else :
                            $this->setRetorno(2,3,"Esse Login Já está Cadastrado.");
                        endif;
                    else :
                        $this->setRetorno($usuDAO->getRetorno()->getCodigo(),$usuDAO->getRetorno()->getTipo(),$usuDAO->getRetorno()->getMensagem());
                    endif;
                else :
                    $this->setRetorno(2,3,"Erro no envio dos Parametros. \"Login não foi preenchido\"");
                endif;
            else :
                $this->setRetorno(2,3,"Erro no envio dos Parametros. \"Nome não foi preenchido\"");
            endif;
        else :
            $this->setRetorno(2,3,"Erro no envio dos Parametros. \"Falha na autenticação do Token\"");
        endif;
    }
}