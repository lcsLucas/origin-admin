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
            'route' => 'teste',
            'method' => 'GET',
            'controller' => 'home',
            'action' => 'pageTeste',
            'param' => ["id","nome"]
        );
        
        /*Setando na propriedades as rotas definidas à cima.*/
        $this->setRoutes($array);
    }
}