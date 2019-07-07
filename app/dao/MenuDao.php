<?php


	namespace App\dao;

	use App\model\Banco;
	use App\model\Menu;

    if (! defined('ABSPATH'))
        die;


	class MenuDao extends Banco
	{
		private $menu;

		public function __construct(Menu $menu)
		{
			parent::__construct();
			$this->menu = $menu;
		}

		public function getRetorno() {
			return parent::getRetorno();
		}

		protected function limiteRegistroDAO($inicio, $fim) {

			if(!empty($this->Conectar())) :

				try
				{

					$stms = $this->getCon()->prepare('SELECT * FROM menu m WHERE menu_pai IS NULL ORDER BY ordem LIMIT :inicio,:fim');
					$stms->bindValue(':inicio', $inicio, \PDO::PARAM_INT);
					$stms->bindValue(':fim', $fim, \PDO::PARAM_INT);

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

		protected function limiteRegistroDAO2($inicio, $fim) {

			if(!empty($this->Conectar())) :

				try
				{

					$stms = $this->getCon()->prepare("SELECT * FROM menu m WHERE menu_pai IS NOT NULL ORDER BY nome LIMIT :inicio,:fim");
					$stms->bindValue(":inicio", $inicio, \PDO::PARAM_INT);
					$stms->bindValue(":fim", $fim, \PDO::PARAM_INT);

					$stms->execute();
					return $stms->fetchAll();

				}
				catch(\PDOException $e)
				{
					$this->setRetorno('Erro Ao Fazer a Consulta No Banco de Dados | '.$e->getMessage(), false, false);
				}

			endif;

			return array();
		}

		protected function totalRegistrosDAO() {

			if(!empty($this->Conectar())) :

				try
				{

					$stms = $this->getCon()->prepare('SELECT COUNT(*) total FROM menu WHERE menu_pai IS NULL');
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

		protected function totalRegistrosDAO2() {

			if(!empty($this->Conectar())) :

				try
				{

					$stms = $this->getCon()->prepare("SELECT COUNT(*) total FROM menu WHERE menu_pai IS NOT NULL");
					$stms->execute();
					$result = $stms->fetch(\PDO::FETCH_ASSOC);

					if (!empty($result))
						return $result['total'];

				}
				catch(\PDOException $e)
				{
					$this->setRetorno('Erro Ao Fazer a Consulta No Banco de Dados | '.$e->getMessage(), false, false);
				}

			endif;

			return 0;
		}

		protected function cadastrarDAO() {
			$ordem = 1;
			if(!empty($this->Conectar())) :

				try
				{

					$result = $this->getCon()->query('SELECT MAX(ordem) + 1 as ordem FROM menu');

					foreach ($result->fetch() as $result_ordem)
						if ((int) $result_ordem)
							$ordem = (int) $result_ordem;

					$stms = $this->getCon()->prepare('INSERT INTO menu(nome, url, icone, menu_pai, idsecao_menu, ordem) VALUES(:nome, :url, :icone, :pai, :secao, :ordem)');
					$stms->bindValue(':nome', $this->menu->getNome(), \PDO::PARAM_STR);
					$stms->bindValue(':url', $this->menu->getUrl(), \PDO::PARAM_STR);
					$stms->bindValue(':icone', $this->menu->getIcone(), \PDO::PARAM_STR);
					$stms->bindValue(':pai', $this->menu->getMenuPai(), \PDO::PARAM_INT);
					$stms->bindValue(':secao', $this->menu->getSecaoMenu(), \PDO::PARAM_INT);
					$stms->bindValue(':ordem', $ordem, \PDO::PARAM_INT);

					return $stms->execute();

				}
				catch(\PDOException $e)
				{
					$this->setRetorno('Erro Ao Fazer a Consulta No Banco de Dados | '.$e->getMessage(), false, false);
				}

			endif;

			return false;
		}

		protected function alterarStatusDAO() {

			if(!empty($this->Conectar())) :

				try
				{

					$stms = $this->getCon()->prepare('UPDATE menu SET ativo = :status WHERE id = :id LIMIT 1');
					$stms->bindValue(':status', $this->menu->getAtivo(), \PDO::PARAM_STR);
					$stms->bindValue(':id', $this->menu->getId(), \PDO::PARAM_INT);
					if ($stms->execute())
						return ($stms->rowCount() > 0) ? true : false;
					else
						return false;

				}
				catch(\PDOException $e)
				{
					$this->setRetorno('Erro Ao Fazer a Consulta No Banco de Dados | '.$e->getMessage(), false, false);
				}

			endif;

			return false;

		}

		protected function carregarDAO() {

			if(!empty($this->Conectar())) :

				try
				{
					$stms = $this->getCon()->prepare('SELECT id, nome, url, idsecao_menu, icone, menu_pai FROM menu WHERE id = :id LIMIT 1');
					$stms->bindValue(':id', $this->menu->getId(), \PDO::PARAM_INT);

					$stms->execute();

					$result = $stms->fetch();

					if (!empty($result)) {
						$this->menu->setNome($result['nome']);
						$this->menu->setUrl($result['url']);
						$this->menu->setSecaoMenu((int) $result['idsecao_menu']);
						$this->menu->setIcone($result['icone']);
						$this->menu->setMenuPai((int) $result['menu_pai']);
						return true;
					}

				}
				catch(\PDOException $e)
				{
					$this->setRetorno('Erro Ao Fazer a Consulta No Banco de Dados | '.$e->getMessage(), false, false);
				}

			endif;

			return null;
		}

		protected function alterarDAO() {

			if(!empty($this->Conectar())) :

				try
				{

					$stms = $this->getCon()->prepare('UPDATE menu SET nome = :nome, url = :url, idsecao_menu = :secao, icone = :icone, menu_pai = :pai WHERE id = :id');
					$stms->bindValue(':nome', $this->menu->getNome(), \PDO::PARAM_STR);
					$stms->bindValue(':url', $this->menu->getUrl(), \PDO::PARAM_STR);
					$stms->bindValue(':secao', $this->menu->getSecaoMenu(), \PDO::PARAM_INT);
					$stms->bindValue(':icone', $this->menu->getIcone(), \PDO::PARAM_STR);
					$stms->bindValue(':pai', $this->menu->getMenuPai(), \PDO::PARAM_INT);
					$stms->bindValue(':id', $this->menu->getId(), \PDO::PARAM_INT);

					return $stms->execute();

				}
				catch(\PDOException $e)
				{
					$this->setRetorno('Erro Ao Fazer a Consulta No Banco de Dados | '.$e->getMessage(), false, false);
				}

			endif;

			return false;
		}

		protected function excluirDAO() {

			if(!empty($this->Conectar())) :

				try
				{

					$stms = $this->getCon()->prepare("DELETE FROM menu WHERE id = :id");
					$stms->bindValue(":id", $this->menu->getId(), \PDO::PARAM_INT);
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

		protected function listarTodosMenusDAO() {

			if(!empty($this->Conectar())) :

				try
				{
					$stms = $this->getCon()->prepare("SELECT id, nome FROM menu WHERE menu_pai IS NULL ORDER BY nome");
					$stms->execute();
					return $stms->fetchAll();

				}
				catch(\PDOException $e)
				{
					$this->setRetorno("Erro Ao Fazer a Consulta No Banco de Dados | ".$e->getMessage(), false, false);
				}

			endif;

			return null;
		}

		protected function listarTodosMenusPermissaoDAO() {

			if(!empty($this->Conectar())) :

				try
				{
					$stms = $this->getCon()->prepare("SELECT id, nome, '0' as status FROM menu WHERE menu_pai IS NULL AND ativo = '1' ORDER BY nome");
					$stms->execute();
					return $stms->fetchAll();

				}
				catch(\PDOException $e)
				{
					$this->setRetorno("Erro Ao Fazer a Consulta No Banco de Dados | ".$e->getMessage(), false, false);
				}

			endif;

			return null;
		}

		protected function carregarMenusTipoUsuarioDAO($id) {
			if(!empty($this->Conectar())) :

				try
				{
					$stms = $this->getCon()->prepare("SELECT mp.id, mp.nome, IF ((SELECT COUNT(*) FROM menu_has_tipo_usuario mu WHERE mu.menu_id = mp.id AND mu.tip_id = :id) > 0, 1, 0) as status FROM menu mp WHERE menu_pai IS NULL AND mp.ativo = '1' ORDER BY mp.nome");
					$stms->bindValue(":id", $id, \PDO::PARAM_INT);

					$stms->execute();
					return $stms->fetchAll();

				}
				catch(\PDOException $e)
				{
					$this->setRetorno("Erro Ao Fazer a Consulta No Banco de Dados | ".$e->getMessage(), false, false);
				}

			endif;

			return null;
		}

		protected function carregarSubMenusTipoUsuarioDAO($idmenu, $idtipo) {
			if(!empty($this->Conectar())) :

				try
				{
					$stms = $this->getCon()->prepare("SELECT mp.id, mp.nome, IF ((SELECT COUNT(*) FROM menu_has_tipo_usuario mu WHERE mu.menu_id = mp.id AND mu.tip_id = :idtipo) > 0, 1, 0) as ativo FROM menu mp WHERE menu_pai = :idmenu AND mp.ativo = '1' ORDER BY mp.nome");
					$stms->bindValue(":idtipo", $idtipo, \PDO::PARAM_INT);
					$stms->bindValue(":idmenu", $idmenu, \PDO::PARAM_INT);

					$stms->execute();
					return $stms->fetchAll();

				}
				catch(\PDOException $e)
				{
					$this->setRetorno("Erro Ao Fazer a Consulta No Banco de Dados | ".$e->getMessage(), false, false);
				}

			endif;

			return null;
		}

		protected function listarTodosSubMenusPermissaoDAO($idmenu) {

			if(!empty($this->Conectar())) :

				try
				{
					$stms = $this->getCon()->prepare("SELECT m.id, m.nome, '0' ativo FROM menu m WHERE m.menu_pai = :pai AND m.ativo = '1' ORDER BY m.nome");
					$stms->bindValue(":pai", $idmenu, \PDO::PARAM_INT);

					$stms->execute();
					return $stms->fetchAll();

				}
				catch(\PDOException $e)
				{
					$this->setRetorno("Erro Ao Fazer a Consulta No Banco de Dados | ".$e->getMessage(), false, false);
				}

			endif;

			return null;
		}

		protected function carregarMenusUsuarioDAO($idtipo) {

			if(!empty($this->Conectar())) :

				try
				{
					$stms = $this->getCon()->prepare('SELECT sm.idsecao_menu as id_secao, sm.nome as nome_secao, m.id, m.nome, m.url, m.icone FROM menu m INNER JOIN menu_has_tipo_usuario mt ON m.id = mt.menu_id LEFT JOIN secao_menu sm ON m.idsecao_menu = sm.idsecao_menu WHERE m.menu_pai IS NULL AND mt.tip_id = :tipo AND ((m.idsecao_menu IS NOT NULL AND sm.ativo = \'1\') OR m.idsecao_menu IS NULL) AND m.ativo =\'1\' ORDER BY sm.ordem IS NULL, sm.ordem, m.ordem, m.nome');
                    $stms->bindValue(":tipo", $idtipo, \PDO::PARAM_INT);
					$stms->execute();
					return $stms->fetchAll();

				}
				catch(\PDOException $e)
				{
					$this->setRetorno("Erro Ao Fazer a Consulta No Banco de Dados | ".$e->getMessage(), false, false);
				}

			endif;

			return null;
		}

		protected function carregarSubMenusUsuario($idusuario, $idmenu) {

			if(!empty($this->Conectar())) :

				try
				{
					$stms = $this->getCon()->prepare('SELECT m.id, m.nome, m.url, m.icone FROM menu m INNER JOIN menu_has_tipo_usuario mt ON m.id = mt.menu_id WHERE m.menu_pai = :id AND mt.tip_id = :tipo AND m.ativo = \'1\' ORDER BY m.ordem');
					$stms->bindValue(":id", $idmenu, \PDO::PARAM_INT);
					$stms->bindValue(":tipo", $idusuario, \PDO::PARAM_INT);
					$stms->execute();
					return $stms->fetchAll();

				}
				catch(\PDOException $e)
				{
					$this->setRetorno("Erro Ao Fazer a Consulta No Banco de Dados | ".$e->getMessage(), false, false);
				}

			endif;

			return null;
		}

	}