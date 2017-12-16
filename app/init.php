<?php

namespace App;

use ProjetoMvc\init\Bootstrap;

if (! defined('ABSPATH'))
    header("Location: /");
/**
 * Classe de inicio do sistema, onde é inicializado as rotas que o site tem.
 */
class Init extends Bootstrap
{
    /**
     * metodo que inicia todas as rotas pré definidas do site
     *'route' = rota esperada.
     *'method' = metodo da onde a rota virá, podendo ser 'GET' ou 'POST'.
     *'controller' = controller que atenderá a rota recebida.
     *'action' = Action dessa controller que será executada.
     *'param' = os parametros passado na URL, junto com a rota.
     */
    protected function initRoutes()
    {
        //Rotas de Home
        $array[] = array(
            'route' => '',
            'method' => 'GET',
            'controller' => 'home',
            'action' => 'pageIndex',
            'param' => []
        );
        $array[] = array(
            'route' => 'Area-Administrativa/Fazer-Login/',
            'method' => 'GET',
            'controller' => 'home',
            'action' => 'pageLogin',
            'param' => []
        );
        $array[] = array(
            'route' => 'Login/',
            'method' => 'POST',
            'controller' => 'home',
            'action' => 'login',
            'param' => []
        );
        $array[] = array(
            'route' => 'Area-Administrativa/Dashboard/',
            'method' => 'GET',
            'controller' => 'home',
            'action' => 'pageDashboard',
            'param' => []
        );
        $array[] = array(
            'route' => 'Logout/',
            'method' => 'GET',
            'controller' => 'home',
            'action' => 'logout',
            'param' => []
        );
        $array[] = array(
            'route' => 'Recuperar-Senha/',
            'method' => 'GET',
            'controller' => 'home',
            'action' => 'pageRecuperarSenha',
            'param' => []
        );

        //Rotas de Usuario
        $array[] = array(
            'route' => 'Area-Administrativa/Usuario/Alterar-Informacoes/',
            'method' => 'GET',
            'controller' => 'usuario',
            'action' => 'pageAlterarInformacoes',
            'param' => []
        );
        $array[] = array(
            'route' => 'Area-Administrativa/Usuario/Alterar-Senha/',
            'method' => 'GET',
            'controller' => 'usuario',
            'action' => 'pageAlterarSenha',
            'param' => []
        );
        $array[] = array(
            'route' => 'Area-Administrativa/Usuario/Novo-Usuario/',
            'method' => 'GET',
            'controller' => 'usuario',
            'action' => 'pageNovoUsuario',
            'param' => []
        );
        $array[] = array(
            'route' => 'Area-Administrativa/Usuario/Listar-Usuarios/',
            'method' => 'GET',
            'controller' => 'usuario',
            'action' => 'pageListarUsuarios',
            'param' => []
        );

        // Rotas de Postagem
        $array[] = array(
            'route' => 'Area-Administrativa/Postagem/Nova-Postagem/',
            'method' => 'GET',
            'controller' => 'postagem',
            'action' => 'pageNovaPostagem',
            'param' => []
        );
        $array[] = array(
            'route' => 'Area-Administrativa/Postagem/Listar-Postagens/',
            'method' => 'GET',
            'controller' => 'postagem',
            'action' => 'pageListarPostagens',
            'param' => []
        );

        // Rotas de Eventos
        $array[] = array(
            'route' => 'Area-Administrativa/Evento/Novo-Evento/',
            'method' => 'GET',
            'controller' => 'evento',
            'action' => 'pageNovoEvento',
            'param' => []
        );
        $array[] = array(
            'route' => 'Area-Administrativa/Evento/Listar-Eventos/',
            'method' => 'GET',
            'controller' => 'evento',
            'action' => 'pageListarEventos',
            'param' => []
        );

        // Rotas de Legislação
        $array[] = array(
            'route' => 'Area-Administrativa/Legislacao/Nova-Citacao/',
            'method' => 'GET',
            'controller' => 'legislacao',
            'action' => 'pageNovaCitacao',
            'param' => []
        );
        $array[] = array(
            'route' => 'Area-Administrativa/Legislacao/Listar-Citacoes/',
            'method' => 'GET',
            'controller' => 'legislacao',
            'action' => 'pageListarCitacoes',
            'param' => []
        );

        // Rotas Institucional
        $array[] = array(
            'route' => 'Area-Administrativa/Institucional/Coordenadoria/Alterar-Informacoes/',
            'method' => 'GET',
            'controller' => 'Institucional',
            'action' => 'pageInfCoordenadoria',
            'param' => []
        );

        /*Setando na propriedades as rotas definidas à cima.*/
        $this->setRoutes($array);
    }
}