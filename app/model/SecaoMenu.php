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

    /**
     * SecaoMenu constructor.
     * @param $nome
     * @param $ordem
     */
    public function __construct($nome='', $ordem=null)
    {
        $this->nome = $nome;
        $this->ordem = $ordem;
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

    public  function paginacao($incio, $fim) {
        return $this->limiteRegistroDAO($incio, $fim);
    }

    public function totalRegistros() {
        return $this->totalRegistrosDAO();
    }

}