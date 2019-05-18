<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 07/04/2019
 * Time: 14:24
 */

namespace App\dao;

use App\model\Banco;
use App\model\SecaoMenu;
use App\model\Retorno;

if (! defined('ABSPATH')){
    header("Location: /");
    exit();
}

class SecaoMenuDao extends Banco
{
    private $secao;

    public function __construct()
    {
        parent::__construct();
    }

    protected function limiteRegistroDAO($inicio, $fim) {

        return array();

    }

    protected function totalRegistrosDAO() {

        return 0;

    }

}