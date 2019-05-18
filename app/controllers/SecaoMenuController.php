<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 07/04/2019
 * Time: 14:25
 */

namespace App\controllers;

use App\model\SecaoMenu;
use ProjetoMvc\render\Action;
use App\model\Data_Validator;

if (! defined('ABSPATH')){
    header("Location: /");
    exit();
}

class SecaoMenuController extends Action
{
    public function __construct()
    {
        parent::__construct();
        /**
         * caminho com o arquivo do layout padrão que todas as paginas dessa controller poderá usar
         */
        $this->layoutPadrao = PATH_VIEWS."shared/layoutPadrao";
    }

    public function pageGerenciarSecoesMenus() {
        $secao = new SecaoMenu();

        $pagina_atual = filter_input(INPUT_GET, "page", FILTER_VALIDATE_INT);
        $pagina_atual = empty($pagina_atual) ? 1 : $pagina_atual;

        $qtde_registros = 5;

        /*definição de paginação*/

        // Constantes de configuração
        $this->dados->paginacao = new \stdClass;
        $this->dados->paginacao->registros_paginas = $qtde_registros;
        $this->dados->paginacao->pagina_atual = $pagina_atual;
        $this->dados->paginacao->range_paginas = 2; // quantas paginas será exibida ao redor da página atual

        // Calcula a linha inicial da consulta */
        $inicio_registro = ($pagina_atual -1) * $qtde_registros;


        // Consulta dos registros utilizando o LIMIT
        $this->dados->registros = $secao->paginacao($inicio_registro, $qtde_registros);
        // Total de registros
        $this->dados->paginacao->total_registros = $secao->totalRegistros();

        $this->dados->title = "Gerenciar Tipos de Usuarios";
        $this->dados->validation = true;
        $this->render('gerenciar-secoes-menus.php');

    }

}