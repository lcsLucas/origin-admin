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
	public function login($login)
	{
		if (!empty($this->conectar())) :
			try
			{
				$stms = $this->getCon()->prepare("SELECT usu_id, usu_nome, usu_senha, usu_status FROM usuario WHERE usu_login = :login AND usu_ativo = '1' LIMIT 1");
				$stms->bindValue(':login', $login, \PDO::PARAM_STR);
				$stms->execute();
				return $this->convertToObject($stms->fetch());
			}
			catch (\PDOException $e)
			{
				$this->setRetorno($e->getCode(),2,"Erro Ao Fazer a Consulta No Banco de Dados | ".$e->getMessage());
			}
		endif;

		return null;
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

	private function convertToObject($registro)
	{
		$usu = null;
/*$id = 0, $dtCad = null, $login = "", $nome = "", $senha = "", $status = "", $ativo = ""*/
		if (!empty($registro)) :
			$usu = new Usuario(
				(!empty($registro['usu_id'])) ? $registro['usu_id'] : 0,
				(!empty($registro['usu_dtCad'])) ? ($registro['usu_dtCad']) : null,
				(!empty($registro['usu_login'])) ? ($registro['usu_login']) : "",
				(!empty($registro['usu_nome'])) ? ($registro['usu_nome']) : "",
				(!empty($registro['usu_senha'])) ? ($registro['usu_senha']) : "",
				(!empty($registro['usu_status'])) ? ($registro['usu_status']) : "",
				(!empty($registro['usu_ativo'])) ? ($registro['usu_ativo']) : ""
			);
		endif;

		return $usu;
	}
}