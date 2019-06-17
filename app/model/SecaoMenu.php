<?php


namespace App\model;

use App\dao\SecaoMenuDao;

if (! defined('ABSPATH')){
    header("Location: /");
    exit();
}

class SecaoMenu extends SecaoMenuDao
{
    private $id;
    private $nome;
    private $ordem;
    private $ativo;

    /**
     * SecaoMenu constructor.
     * @param $nome
     * @param $ordem
     */
    public function __construct($nome='', $ordem=null, $ativo=0)
    {
        parent::__construct($this);
        $this->nome = $nome;
        $this->ordem = $ordem;
        $this->ativo = $ativo;
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
    public function setId($id): void
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
    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    /**
     * @return null
     */
    public function getOrdem()
    {
        return $this->ordem;
    }

    /**
     * @param null $ordem
     */
    public function setOrdem($ordem): void
    {
        $this->ordem = $ordem;
    }

    /**
     * @return int
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * @param int $ativo
     */
    public function setAtivo(int $ativo): void
    {
        $this->ativo = $ativo;
    }

    public function getRetorno() {
        return parent::getRetorno();
    }

    public  function paginacao($incio, $fim) {
        return $this->limiteRegistroDAO($incio, $fim);
    }

    public function totalRegistros() {
        return $this->totalRegistrosDAO();
    }

    public function cadastrar() {
        return $this->cadastrarDAO();
    }

    public function alterarStatus() {
		return $this->alterarStatusDAO();
	}

	public function carregar() {
    	return $this->carregarDAO();
	}

}