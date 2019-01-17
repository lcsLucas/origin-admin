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

    /**
     * TipoUsuario constructor.
     * @param $nome
     */
    public function __construct($nome = null)
    {
        $this->nome = $nome;
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

    public function getRetorno() {
        return parent::getRetorno();
    }

}