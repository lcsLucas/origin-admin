<?php

namespace App\model;

if (! defined('ABSPATH')){
    header("Location: /");
    exit();
}

class Retorno {
    private $codigo;
    private $tipo;//tipo 1 = Sucesso, tipo 2 = Banco, tipo 3 = Erro Usuario
    private $mensagem;

    public function Retorno(){
        $this->codigo = 0;
        $this->tipo = 0;
        $this->mensagem = "";
    }

    public function setRetorno($cod = 0, $tp, $msg){
        $this->Retorno();
        $this->codigo = $cod;
        $this->tipo = $tp;
        $this->mensagem = $msg;
    }

    public function toArray(){
        return [
            'Codigo' => $this->codigo,
            'Tipo' => $this->tipo,
            'Mensagem' => $this->mensagem
        ];
    }

    public function getCodigo(){
        return $this->codigo;
    }

    public function setCodigo($valor){
        $this->codigo = $valor;
    }

    public function getMensagem(){
        return $this->mensagem;
    }

    public function setMensagem($valor){
        $this->mensagem = $valor;
    }

    public function getTipo(){
        return $this->tipo;
    }

    public function setTipo($valor){
        $this->tipo = $valor;
    }
}
