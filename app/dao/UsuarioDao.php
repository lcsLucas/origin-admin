<?php
namespace App\dao;

use App\model\Banco;
use App\model\Usuario;
use App\model\Retorno;

if (! defined('ABSPATH')){
    header("Location: /");
    exit();
}

class UsuarioDao extends Banco
{
    private $usuario;

    public function setUsuario(Usuario $usuario) {
        $this->usuario = $usuario;
    }

	public function loginDAO()
	{
	    $result = false;

		if (!empty($this->conectar())) :
			try
			{
				$stms = $this->getCon()->prepare("SELECT usu_senha FROM usuario WHERE usu_login = :login AND usu_ativo = '1' LIMIT 1");
				$stms->bindValue(':login', $this->usuario->getLogin(), \PDO::PARAM_STR);
				$stms->execute();
                $result = $stms->fetch();

                if (empty($result)){
                    $stms = $this->getCon()->prepare("SELECT usu_senha FROM usuario WHERE usu_email = :email AND usu_ativo = '1' LIMIT 1");
                    $stms->bindValue(':email', $this->usuario->getEmail(), \PDO::PARAM_STR);
                    $stms->execute();
                    $result = $stms->fetch();
                }

			}
			catch (\PDOException $e)
			{
                $result = false;
				$this->setRetorno($e->getCode(),2,"Erro Ao Fazer a Consulta No Banco de Dados | ".$e->getMessage());
			}
		endif;

		return $result;
	}

    function obterSenha($codigo)
    {
      if(!empty($this->Conectar())) :
          try
          {
            $stms = $this->getCon()->prepare("SELECT usu_senha FROM usuario WHERE usu_id = :codigo");
            $stms->bindValue(":codigo", $codigo);
            $stms->execute();
            return $this->convertToObject($stms->fetch());
          }
          catch(\PDOException $e)
          {
              $this->setRetorno($e->getCode(),2,"Erro Ao Fazer a Consulta No Banco de Dados | ".$e->getMessage());
          }
      endif;
      return false;
    }

    function alterarSenha($codigo, $senha)
    {
      if(!empty($this->Conectar())) :
        try
        {
          $stms = $this->getCon()->prepare("update usuario set usu_senha = :senha where usu_id = :codigo");
          $stms->bindValue(":codigo", intval($codigo), \PDO::PARAM_INT);
          $stms->bindValue(":senha", $senha, \PDO::PARAM_STR);

          return $stms->execute();
        }
        catch(\PDOException $e)
        {
          $this->setRetorno($e->getCode(),2,"Erro Ao Executar o Comando No Banco de Dados | ".$e->getMessage());
        }
      endif;
      return false;
    }

}