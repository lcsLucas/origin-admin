<?php

namespace App;

use ProjetoMvc\Init\Bootstrap;

if (! defined('ABSPATH'))
    header("Location: /");

class Init extends Bootstrap
{
	/*
	* Metodo onde deve ser definido todas as rotas do site
	*/
	protected function initRoutes()
	{
		//Rotas de Home
		$array["home"] = array('route' => '', 'controller' => 'home', 'action' => 'index');
		$array["Login"] = array('route' => 'Login', 'controller' => 'home', 'action' => 'login');

		$this->SetRoutes($array);
	}
}