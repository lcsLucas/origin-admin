<?php

namespace App;

use ProjetoMvc\init\Bootstrap;

if (! defined('ABSPATH'))
    die;

/**
 * Classe de inicio do sistema, onde é inicializado as rotas que o site tem.
 */
class Init extends Bootstrap
{
    /**
     * metodo que inicia todas as rotas pré definidas do site
     *'exp_reg' = expressão regular que compatibilize com a rota passada
     *'method' = metodo da onde a rota virá, podendo ser 'GET' ou 'POST'.
     *'controller' = controller que atenderá a rota recebida.
     *'action' = Action dessa controller que será executada.
     *'param' = os parametros passado na URL, junto com a rota.
     */
    protected function initRoutes()
    {
        //Rotas de Home
        $array['_'][] = array(
            'exp_reg' => '/^$/',
            'method' => 'GET',
            'controller' => 'home',
            'action' => 'pageIndex'
        );
        
        $array['_'][] = array(
            'exp_reg' => '/^login\/?$/',
            'method' => 'GET',
            'controller' => 'home',
            'action' => 'pageLogin'
        );

        $array['_'][] = array(
            'exp_reg' => '/^fazer_login\/?$/',
            'method' => 'POST',
            'controller' => 'home',
            'action' => 'login'
        );

        $array['_'][] = array(
            'exp_reg' => '/^dashboard\/?$/',
            'method' => 'GET',
            'controller' => 'home',
            'action' => 'pageDashboard'
        );

        $array['_'][] = array(
            'exp_reg' => '/^logout\/?$/',
            'method' => 'GET',
            'controller' => 'home',
            'action' => 'logout'
        );

        $array['_'][] = array(
            'exp_reg' => '/^alterar-perfil\/?$/',
            'method' => 'GET',
            'controller' => 'usuario',
            'action' => 'pageAlterarPerfil'
        );

        $array['_'][] = array(
            'exp_reg' => '/^alterar-perfil\/?$/',
            'method' => 'POST',
            'controller' => 'usuario',
            'action' => 'requestAlterarPerfil'
        );

        $array['_'][] = array(
            'exp_reg' => '/^alterar-senha\/?$/',
            'method' => 'GET',
            'controller' => 'usuario',
            'action' => 'pageAlterarSenha'
        );

        $array['_'][] = array(
            'exp_reg' => '/^alterar-senha\/?$/',
            'method' => 'POST',
            'controller' => 'usuario',
            'action' => 'requestAlterarSenha'
        );

        $array['usuarios'][] = array(
            'exp_reg' => '/^usuarios\/gerenciar-tipos-usuarios\/?$/',
            'method' => 'GET',
            'controller' => 'TipoUsuario',
            'action' => 'pageTiposUsuarios'
        );

        $array['usuarios'][] = array(
            'exp_reg' => '/^usuarios\/gerenciar-tipos-usuarios\/?$/',
            'method' => 'POST',
            'controller' => 'TipoUsuario',
            'action' => 'requestTiposUsuarios'
        );

        $array['usuarios'][] = array(
            'exp_reg' => '/^usuarios\/gerenciar-tipos-usuarios\/edit\/([0-9]+)\/?$/',
            'method' => 'GET',
            'controller' => 'TipoUsuario',
            'action' => 'pageTiposUsuariosEdit'
        );

        $array['usuarios'][] = array(
            'exp_reg' => '/^usuarios\/gerenciar-tipos-usuarios\/edit\/([0-9]+)\/?$/',
            'method' => 'POST',
            'controller' => 'TipoUsuario',
            'action' => 'requestTiposUsuariosEdit'
        );

        $array['usuarios'][] = array(
            'exp_reg' => '/^usuarios\/gerenciar-tipos-usuarios\/alterar-status\/?$/',
            'method' => 'POST',
            'controller' => 'TipoUsuario',
            'action' => 'requestAlterarStatus'
        );

        $array['usuarios'][] = array(
            'exp_reg' => '/^usuarios\/gerenciar-tipos-usuarios\/deletar\/?$/',
            'method' => 'POST',
            'controller' => 'TipoUsuario',
            'action' => 'requestDeletar'
        );

        $array['usuarios'][] = array(
            'exp_reg' => '/^usuarios\/gerenciar-tipos-usuarios\/deletar\/?$/',
            'method' => 'GET',
            'controller' => 'TipoUsuario',
            'action' => 'pageTiposUsuarios'
        );

        $array['usuarios'][] = array(
            'exp_reg' => '/^usuarios\/gerenciar-usuarios\/?$/',
            'method' => 'GET',
            'controller' => 'Usuario',
            'action' => 'pageGerenciarUsuarios'
        );

        $array['usuarios'][] = array(
            'exp_reg' => '/^usuarios\/gerenciar-usuarios\/?$/',
            'method' => 'POST',
            'controller' => 'Usuario',
            'action' => 'requestNovoUsuario'
        );

        $array['usuarios'][] = array(
            'exp_reg' => '/^usuarios\/gerenciar-usuarios\/edit\/([0-9]+)\/?$/',
            'method' => 'GET',
            'controller' => 'Usuario',
            'action' => 'pageUsuariosEdit'
        );

        $array['usuarios'][] = array(
            'exp_reg' => '/^usuarios\/gerenciar-usuarios\/edit\/([0-9]+)\/?$/',
            'method' => 'POST',
            'controller' => 'Usuario',
            'action' => 'requestUsuariosEdit'
        );

        $array['usuarios'][] = array(
            'exp_reg' => '/^usuarios\/gerenciar-usuarios\/alterar-status\/?$/',
            'method' => 'POST',
            'controller' => 'Usuario',
            'action' => 'requestAlterarStatus'
        );

        $array['usuarios'][] = array(
            'exp_reg' => '/^usuarios\/gerenciar-usuarios\/deletar\/?$/',
            'method' => 'GET',
            'controller' => 'Usuario',
            'action' => 'pageGerenciarUsuarios'
        );

        $array['usuarios'][] = array(
            'exp_reg' => '/^usuarios\/gerenciar-usuarios\/deletar\/?$/',
            'method' => 'POST',
            'controller' => 'Usuario',
            'action' => 'requestDeletar'
        );

        /*--Secao Menu--*/

        $array['permissoes'][] = array(
            'exp_reg' => '/^permissoes\/gerenciar-secoes-menus\/?$/',
            'method' => 'GET',
            'controller' => 'SecaoMenu',
            'action' => 'pageGerenciarSecoesMenus'
        );

        $array['permissoes'][] = array(
            'exp_reg' => '/^permissoes\/gerenciar-secoes-menus\/?$/',
            'method' => 'POST',
            'controller' => 'SecaoMenu',
            'action' => 'requestNovaSecao'
        );

		$array['permissoes'][] = array(
			'exp_reg' => '/^permissoes\/gerenciar-secoes-menus\/alterar-status\/?$/',
			'method' => 'POST',
			'controller' => 'SecaoMenu',
			'action' => 'requestAlterarStatus'
		);

		$array['permissoes'][] = array(
			'exp_reg' => '/^permissoes\/gerenciar-secoes-menus\/edit\/([0-9]+)\/?$/',
			'method' => 'GET',
			'controller' => 'SecaoMenu',
			'action' => 'pageSecoesMenusEdit'
		);

		$array['permissoes'][] = array(
			'exp_reg' => '/^permissoes\/gerenciar-secoes-menus\/edit\/([0-9]+)\/?$/',
			'method' => 'POST',
			'controller' => 'SecaoMenu',
			'action' => 'requestSecoesMenusEdit'
		);

		$array['permissoes'][] = array(
			'exp_reg' => '/^permissoes\/gerenciar-secoes-menus\/deletar\/?$/',
			'method' => 'POST',
			'controller' => 'SecaoMenu',
			'action' => 'requestSecoesMenusDeletar'
		);

		$array['permissoes'][] = array(
			'exp_reg' => '/^permissoes\/gerenciar-secoes-menus\/alterar-ordem\/?$/',
			'method' => 'POST',
			'controller' => 'SecaoMenu',
			'action' => 'requestAlterarOrdem'
		);

		$array['permissoes'][] = array(
			'exp_reg' => '/^permissoes\/gerenciar-menus\/?$/',
			'method' => 'GET',
			'controller' => 'Menu',
			'action' => 'pageGerenciarMenus'
		);

		$array['permissoes'][] = array(
			'exp_reg' => '/^permissoes\/gerenciar-menus\/?$/',
			'method' => 'POST',
			'controller' => 'Menu',
			'action' => 'requestGerenciarMenus'
		);

		$array['permissoes'][] = array(
			'exp_reg' => '/^permissoes\/gerenciar-menus\/alterar-status\/?$/',
			'method' => 'POST',
			'controller' => 'Menu',
			'action' => 'requestAlterarStatus'
		);

		$array['permissoes'][] = array(
			'exp_reg' => '/^permissoes\/gerenciar-menus\/edit\/([0-9]+)\/?$/',
			'method' => 'GET',
			'controller' => 'Menu',
			'action' => 'pageMenusEdit'
		);

		$array['permissoes'][] = array(
			'exp_reg' => '/^permissoes\/gerenciar-menus\/edit\/([0-9]+)\/?$/',
			'method' => 'POST',
			'controller' => 'Menu',
			'action' => 'requestMenusEdit'
		);

        /*--------------*/

        /*Setando na propriedades as rotas definidas à cima.*/
        $this->setRoutes($array);
    }
}