<?php

namespace App\model;

if (! defined('ABSPATH')){
    header("Location: /");
    exit();
}

class Retorno {
    /*private $codigo;
    private $tipo;//tipo 1 = Sucesso, tipo 2 = Banco, tipo 3 = Erro Usuario
    private $mensagem;*/

    private $mensagem;
    private $exibir;
    private $status;
    private $extra;

    /**
     * Retorno constructor.
     * @param $mensagem
     * @param $exibir
     * @param $status
     * @param $extra
     */
    public function __construct($mensagem="", $exibir=false, $status=false, $extra = array())
    {
        $this->mensagem = $mensagem;
        $this->exibir = $exibir;
        $this->status = $status;
        $this->extra = $extra;
    }


    public function setRetorno($mensagem, $exibir, $status, $extra=array()){
        $this->mensagem = $mensagem;
        $this->exibir = $exibir;
        $this->status = $status;
        $this->extra = $extra;
    }

    public function setExtra($nome, $extra) {
        $this->extra = array($nome => $extra);
    }

    public function getRetorno(){

        return array(
            "status" => $this->status,
            "mensagem" => $this->mensagem,
            "exibir" => $this->exibir,
            "extra" => json_encode($this->extra)
        );

    }

}
