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

    public function __construct(Usuario $usuario)
    {
        parent::__construct();
        $this->usuario = $usuario;
    }

    protected function loginDAO()
	{
	    $result = false;

		if (!empty($this->conectar())) {
            try {
                $stms = $this->getCon()->prepare("SELECT usu_id, usu_senha FROM usuario u INNER JOIN tipo_usuario tu ON u.tip_id = tu.tip_id WHERE usu_login = :login AND usu_ativo = '1' AND tip_ativo = '1' LIMIT 1");
                $stms->bindValue(':login', $this->usuario->getLogin(), \PDO::PARAM_STR);
                $stms->execute();
                $result = $stms->fetch();

                if (empty($result)) {
                    $stms = $this->getCon()->prepare("SELECT usu_id, usu_senha FROM usuario u INNER JOIN tipo_usuario tu ON u.tip_id = tu.tip_id WHERE usu_email = :email AND usu_ativo = '1' AND tip_ativo = '1' LIMIT 1");
                    $stms->bindValue(':email', $this->usuario->getEmail(), \PDO::PARAM_STR);
                    $stms->execute();
                    $result = $stms->fetch();
                }

                if (empty($result)) {
                    $this->setRetorno("usuario não encontrado", true, false);
                }

            } catch (\PDOException $e) {
                $result = false;
                $this->setRetorno("Erro Ao Fazer a Consulta No Banco de Dados | " . $e->getMessage(), false, false);
            }
        }

		return $result;
	}

	protected function alterarPerfilDAO() {

        $result = false;

        if (!empty($this->conectar())) {

            try {
                $stms = $this->getCon()->prepare("UPDATE usuario SET usu_nome = :nome, usu_apelido = :apelido WHERE usu_id = :id LIMIT 1");
                $stms->bindValue(':nome', $this->usuario->getNome(), \PDO::PARAM_STR);
                $stms->bindValue(':apelido', $this->usuario->getApelido(), \PDO::PARAM_STR);
                $stms->bindValue(':id', $this->usuario->getId(), \PDO::PARAM_INT);

                $result = $stms->execute();


            } catch (\PDOException $e) {
                $result = false;
                $this->setRetorno("Erro Ao Fazer a Consulta No Banco de Dados | " . $e->getMessage(), false, false);
            }

        }

        return $result;
    }

    protected function alterarPerfilFotoDAO() {

        $result = false;

        if (!empty($this->conectar())) {

            try {
                $stms = $this->getCon()->prepare("UPDATE usuario SET usu_avatar = :avatar, usu_avatar_dados = :dados WHERE usu_id = :id LIMIT 1");
                $stms->bindValue(':avatar', $this->usuario->getImagem()->getNomeImagem(), \PDO::PARAM_STR);
                $stms->bindValue(':dados', json_encode($this->usuario->getImagem()->getDadosImagem(), JSON_FORCE_OBJECT), \PDO::PARAM_STR);
                $stms->bindValue(':id', $this->usuario->getId(), \PDO::PARAM_INT);

                $result = $stms->execute();

            } catch (\PDOException $e) {
                $result = false;
                $this->setRetorno("Erro Ao Fazer a Consulta No Banco de Dados | " . $e->getMessage(), false, false);
            }

        }

        return $result;
    }

	protected function carregarInformacoesDAO() {

        if (!empty($this->conectar())) {

            $stms = $this->getCon()->prepare("SELECT usu_nome, usu_email, usu_login, usu_apelido, usu_avatar, usu_avatar_dados FROM usuario WHERE usu_id = :codigo LIMIT 1");
            $stms->bindValue(":codigo", $this->usuario->getId(), \PDO::PARAM_INT);

            if ($stms->execute()) {

                $result = $stms->fetch();

                if (!empty($result)) {

                    $this->usuario->setNome($result["usu_nome"]);
                    $this->usuario->setEmail($result["usu_email"]);
                    $this->usuario->setLogin($result["usu_login"]);
                    $this->usuario->setApelido($result["usu_apelido"]);
                    $this->usuario->getImagem()->setNomeImagem($result["usu_avatar"]);
                    $this->usuario->getImagem()->setDadosImagem($result['usu_avatar_dados']);

                    return true;

                }

            }

        }

        return false;
    }

    protected function carregarInformacoes2DAO() {

        if (!empty($this->conectar())) {

            $stms = $this->getCon()->prepare("SELECT usu_nome, usu_avatar, usu_avatar_dados FROM usuario WHERE usu_id = :codigo LIMIT 1");
            $stms->bindValue(":codigo", $this->usuario->getId(), \PDO::PARAM_INT);

            if ($stms->execute()) {

                $result = $stms->fetch();

                if (!empty($result)) {

                    $this->usuario->setNome($result["usu_nome"]);
                    $this->usuario->getImagem()->setNomeImagem($result["usu_avatar"]);
                    $this->usuario->getImagem()->setDadosImagem($result['usu_avatar_dados']);

                    return true;

                }

            }

        }

        return false;
    }

    protected function carregarAvatarDAO() {
        if (!empty($this->conectar())) {

            $stms = $this->getCon()->prepare("SELECT usu_avatar FROM usuario WHERE usu_id = :codigo LIMIT 1");
            $stms->bindValue(":codigo", $this->usuario->getId(), \PDO::PARAM_INT);

            if ($stms->execute()) {

                $result = $stms->fetch();

                if (!empty($result)) {

                    $this->usuario->getImagem()->setNomeImagem($result["usu_avatar"]);

                    return true;

                }

            }

        }

        return false;
    }

    protected function obterSenha()
    {
      if(!empty($this->Conectar())) :
          try
          {
            $stms = $this->getCon()->prepare("SELECT usu_senha FROM usuario WHERE usu_id = :codigo LIMIT 1");
            $stms->bindValue(":codigo", $this->usuario->getId(), \PDO::PARAM_INT);
            $stms->execute();
            return $stms->fetch();
          }
          catch(\PDOException $e)
          {
              $this->setRetorno("Erro Ao Fazer a Consulta No Banco de Dados | ".$e->getMessage(), false, false);
          }
      endif;
      return false;
    }

    protected function alterarSenhaDAO() {

        if(!empty($this->Conectar())) :

            try
            {

                $stms = $this->getCon()->prepare("UPDATE usuario SET usu_senha = :senha WHERE usu_id = :codigo LIMIT 1");
                $stms->bindValue(":senha", $this->usuario->getSenha(), \PDO::PARAM_STR);
                $stms->bindValue(":codigo", $this->usuario->getId(), \PDO::PARAM_INT);

                return $stms->execute();

            }
            catch(\PDOException $e)
            {
                $this->setRetorno("Erro Ao Fazer a Consulta No Banco de Dados | ".$e->getMessage(), false, false);
            }

        endif;

        return false;
    }

    public function getRetorno() {
        return parent::getRetorno();
    }

    protected function UltimoAcessoDAO() {

        if(!empty($this->Conectar())) :

            try
            {

                $stms = $this->getCon()->prepare("UPDATE usuario SET usu_ultimoAcesso = :acesso WHERE usu_id = :codigo LIMIT 1");
                $stms->bindValue(":acesso", date("Y-m-d H:i:00"), \PDO::PARAM_STR);
                $stms->bindValue(":codigo", $this->usuario->getId(), \PDO::PARAM_INT);

                return $stms->execute();

            }
            catch(\PDOException $e)
            {
                $this->setRetorno("Erro Ao Fazer a Consulta No Banco de Dados | ".$e->getMessage(), false, false);
            }

        endif;

        return false;

    }

    protected function limiteRegistroDAO($inicio, $fim, $parametros) {
        $sql = 'SELECT usu_id, usu_dtCad, usu_nome, tu.tip_id, tip_nome, tip_administrador, usu_email, usu_ativo, usu_avatar FROM usuario u INNER JOIN tipo_usuario tu ON u.tip_id = tu.tip_id WHERE u.usu_id > 1 ';

        if(!empty($this->Conectar())) :

            try
            {

                if (!empty($parametros['filtro'])) {

                    if (!empty($parametros['tipo'])) {
                        if($parametros['tipo'] === 2)
                            $sql .= ' AND usu_email like :filtro '; // filtrar pelo email
                        elseif($parametros['tipo'] === 3)
                            $sql .= ' AND usu_login like :filtro '; // filtrar pelo login
                    }
                    else
                        $sql .= ' AND usu_nome like :filtro '; //filtrar pelo nome
                }

                $sql .= ' ORDER BY usu_nome LIMIT :inicio,:fim ';
                $stms = $this->getCon()->prepare($sql);

                if (!empty($parametros['filtro']))
                    $stms->bindValue(":filtro", '%'.$parametros['filtro'].'%', \PDO::PARAM_STR);

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

    protected function totalRegistrosDAO($parametros) {
        $sql = 'SELECT COUNT(*) total FROM usuario WHERE usu_id > 1 ';

        if(!empty($this->Conectar())) :

            try
            {

                if (!empty($parametros['filtro'])) {

                    if (!empty($parametros['tipo'])) {
                        if($parametros['tipo'] === 2)
                            $sql .= ' AND usu_email like :filtro '; // filtrar pelo email
                        elseif($parametros['tipo'] === 3)
                            $sql .= ' AND usu_login like :filtro '; // filtrar pelo login
                    }
                    else
                        $sql .= ' AND usu_nome like :filtro '; //filtrar pelo nome
                }

                $stms = $this->getCon()->prepare($sql);

                if (!empty($parametros['filtro']))
                    $stms->bindValue(":filtro", '%'.$parametros['filtro'].'%', \PDO::PARAM_STR);

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

    protected function verificaEmailDAO() {
        if(!empty($this->Conectar())) :

            try
            {

                $stms = $this->getCon()->prepare("SELECT COUNT(*) total FROM usuario WHERE usu_email = :email LIMIT 1");
                $stms->bindValue(":email", $this->usuario->getEmail(), \PDO::PARAM_STR);
                $stms->execute();
                $result = $stms->fetch(\PDO::FETCH_ASSOC);

                if (!empty($result))
                    return !empty($result["total"]) ? true : false;


            }
            catch(\PDOException $e)
            {
                $this->setRetorno("Erro Ao Fazer a Consulta No Banco de Dados | ".$e->getMessage(), false, false);
            }

        endif;

        return false;
    }

    protected function verificaUsuarioDAO() {
        if(!empty($this->Conectar())) :

            try
            {

                $stms = $this->getCon()->prepare("SELECT COUNT(*) total FROM usuario WHERE usu_login = :login LIMIT 1");
                $stms->bindValue(":login", $this->usuario->getLogin(), \PDO::PARAM_STR);
                $stms->execute();
                $result = $stms->fetch(\PDO::FETCH_ASSOC);

                if (!empty($result))
                    return !empty($result["total"]) ? true : false;


            }
            catch(\PDOException $e)
            {
                $this->setRetorno("Erro Ao Fazer a Consulta No Banco de Dados | ".$e->getMessage(), false, false);
            }

        endif;

        return false;
    }

    public function inserirDAO() {

        if(!empty($this->Conectar())) :

            try
            {

                $stms = $this->getCon()->prepare("INSERT INTO usuario(usu_dtCad, usu_nome, usu_login, usu_senha, usu_email, usu_ativo, tip_id) VALUES(:data, :nome, :login, :senha, :email, :ativo, :tipo)");
                $stms->bindValue(":data", $this->usuario->getDataCadastro(), \PDO::PARAM_STR);
                $stms->bindValue(":nome", $this->usuario->getNome(), \PDO::PARAM_STR);
                $stms->bindValue(":login", $this->usuario->getLogin(), \PDO::PARAM_STR);
                $stms->bindValue(":senha", $this->usuario->getSenha(), \PDO::PARAM_STR);
                $stms->bindValue(":email", $this->usuario->getEmail(), \PDO::PARAM_STR);
                $stms->bindValue(":ativo", $this->usuario->getAtivo(), \PDO::PARAM_STR);
                $stms->bindValue(":tipo", $this->usuario->getTipo(), \PDO::PARAM_INT);

                return $stms->execute();

            }
            catch(\PDOException $e)
            {
                $this->setRetorno("Erro Ao Fazer a Consulta No Banco de Dados | ".$e->getMessage(), false, false);
            }

        endif;

        return false;

    }

    protected function alterarDAO() {

        if(!empty($this->Conectar())) :

            try
            {

                $stms = $this->getCon()->prepare("UPDATE usuario SET usu_nome = :nome, usu_senha = :senha, tip_id = :tipo WHERE usu_id = :id");
                $stms->bindValue(":nome", $this->usuario->getNome(), \PDO::PARAM_STR);
                $stms->bindValue(":senha", $this->usuario->getSenha(), \PDO::PARAM_STR);
                $stms->bindValue(":tipo", $this->usuario->getTipo(), \PDO::PARAM_INT);
                $stms->bindValue(":id", $this->usuario->getId(), \PDO::PARAM_INT);

				return $stms->execute();

            }
            catch(\PDOException $e)
            {
                $this->setRetorno("Erro Ao Fazer a Consulta No Banco de Dados | ".$e->getMessage(), false, false);
            }

        endif;

        return false;

    }

    protected function carregarDAO() {

        if(!empty($this->Conectar())) :

            try
            {

                $stms = $this->getCon()->prepare("SELECT usu_nome, usu_login, usu_email, tip_id FROM usuario WHERE usu_id = :id LIMIT 1");
                $stms->bindValue(":id", $this->usuario->getId(), \PDO::PARAM_INT);

                $stms->execute();
                return $stms->fetch();

            }
            catch(\PDOException $e)
            {
                $this->setRetorno("Erro Ao Fazer a Consulta No Banco de Dados | ".$e->getMessage(), false, false);
            }

        endif;

        return null;

    }

    protected function alterarStatusDAO() {

        if(!empty($this->Conectar())) :

            try
            {

                $stms = $this->getCon()->prepare("UPDATE usuario SET usu_ativo = :status WHERE usu_id = :id AND usu_id > 1 LIMIT 1");
                $stms->bindValue(":status", $this->usuario->getAtivo(), \PDO::PARAM_STR);
                $stms->bindValue(":id", $this->usuario->getId(), \PDO::PARAM_INT);
                if ($stms->execute())
                    return ($stms->rowCount() > 0) ? true : false;
                else
                    return false;

            }
            catch(\PDOException $e)
            {
                $this->setRetorno("Erro Ao Fazer a Consulta No Banco de Dados | ".$e->getMessage(), false, false);
            }

        endif;

        return false;

    }

    protected function excluirDAO() {

        if(!empty($this->Conectar())) :

            try
            {

                $stms = $this->getCon()->prepare("DELETE FROM usuario WHERE usu_id = :id AND usu_id > 1");
                $stms->bindValue(":id", $this->usuario->getId(), \PDO::PARAM_INT);
                if ($stms->execute())
                    return $stms->rowCount();
                else
                    return false;

            }
            catch(\PDOException $e)
            {
                $this->setRetorno("Erro Ao Fazer a Consulta No Banco de Dados | ".$e->getMessage(), false, false);
            }

        endif;

        return false;

    }

}