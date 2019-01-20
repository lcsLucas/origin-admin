<?php

namespace App\controllers;

use ProjetoMvc\render\Action;
use App\model\TipoUsuario;
use App\model\Data_Validator;

if (! defined('ABSPATH')){
    header("Location: /");
    exit();
}

class TipoUsuarioController extends Action
{

    public function __construct()
    {
        parent::__construct();
        /**
         * caminho com o arquivo do layout padrão que todas as paginas dessa controller poderá usar
         */
        $this->layoutPadrao = PATH_VIEWS."shared/layoutPadrao";
    }

    public function pageTiposUsuarios() {
        $tipo = new TipoUsuario();

        $pagina_atual = filter_input(INPUT_GET, "page", FILTER_VALIDATE_INT);
        $pagina_atual = empty($pagina_atual) ? 1 : $pagina_atual;

        $qtde_registros = 1;

        /*definição de paginação*/

        // Constantes de configuração
            $this->dados->paginacao = new \stdClass;
            $this->dados->paginacao->registros_paginas = $qtde_registros;
            $this->dados->paginacao->pagina_atual = $pagina_atual;
            $this->dados->paginacao->range_paginas = 2; // quantas paginas será exibida ao redor da página atual

        // Calcula a linha inicial da consulta */
            $inicio_registro = ($pagina_atual -1) * $qtde_registros;


        // Consulta dos registros utilizando o LIMIT
            $this->dados->registros = $tipo->paginacao($inicio_registro, $qtde_registros);
        // Total de registros
            $this->dados->paginacao->total_registros = $tipo->totalRegistros();

        /***/

        $this->dados->title = "Gerenciar Tipos de Usuarios";
        $this->dados->validation = true;
        $this->render('gerenciar-tipos-usuarios.php');
    }

    public function requestTiposUsuarios() {

        $validate = new Data_Validator();
        $tipo = new TipoUsuario();

        $nome = trim(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS));
        $token = trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_SPECIAL_CHARS));

        $validate->define_pattern('erro_');
        $validate
            ->set("nome", $nome)->is_required();

        if ($validate->validate()) {

            if (password_verify(TOKEN_SESSAO, $token)) {

                $tipo->setNome($nome);

                if ($tipo->cadastrar())
                    $this->setRetorno("Novo tipo de usuário foi cadastrado com sucesso", true, true);
                else if($tipo->getRetorno()["exibir"])
                    $this->setRetorno($tipo->getRetorno()["mensagem"], $tipo->getRetorno()["exibir"], $tipo->getRetorno()["status"]);
                else
                    $this->setRetorno("Não foi possível cadastrar o novo tipo de usuário, tente novamente", true, false);

            } else
                $this->setRetorno("Token de autenticação inválido, recarregue a página e tente novamente", true, false);

        } else {
            $array_erros = $validate->get_errors();
            $array_erro = array_shift($array_erros);
            $erro = array_shift($array_erro);
            $this->setRetorno($erro, true, false);
        }

        $this->dados->retorno = $this->getRetorno();
        $this->pageTiposUsuarios();
    }

}