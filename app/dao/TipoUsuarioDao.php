<?php
/**
 * Created by PhpStorm.
 * Date: 17/01/2019
 * Time: 13:58
 */

namespace App\dao;

use App\model\Banco;
use App\model\TipoUsuario;
use App\model\Retorno;

if (! defined('ABSPATH')){
    header("Location: /");
    exit();
}


class TipoUsuarioDao extends Banco
{
    private $tipo_usuario;

    public function __construct()
    {
        parent::__construct();
    }

    protected function setTipoUsuario(TipoUsuario $tipo) {
        $this->tipo_usuario = $tipo;
    }

    public function getRetorno() {
        return parent::getRetorno();
    }

}