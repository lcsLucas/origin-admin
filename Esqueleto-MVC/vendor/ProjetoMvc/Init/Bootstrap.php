<?php
/**
 * Classe que da suporte ao projeto para utilizar no padrão MVC
 *
 * PHP version 7
 *
 * @category PHP
 * @package  PHP_ProjetoMVC
 * @author   Lucas S. Rosa <lucas.tarta@hotmail.com>
 */
namespace ProjetoMVC\Init;
/**
 * Classe Abstrata para o padrão MVC
 */

if (! defined('ABSPATH')){
    header("Location: /");
    exit();
}
abstract class Bootstrap
{
    /**
     * propriedade privada que contém todas as rotas do site.
     * @var array
     */
    private $routes;

    /**
     * Chama a função initRoutes que define
     * as rotas do site e chama o metodo Run
     */
    public function __construct()
    {
        $this->initRoutes();
        $this->run($this->getUrl());
    }

    /**
     * Descrição: Define todas as rotas que o site terá,
     * e seta na propriedade $routes da classe.
     */
    abstract protected function initRoutes();

    /**
     * Seta a propriedade $routes da classe
     * @param array $routes [Recebe um array de rotas]
     * @return  nothing
     */
    protected function SetRoutes(array $routes)
    {
        $this->routes = $routes;
    }

    /**
     * Captura a URL que o usuário acessou no site.
     * @return [string] [retorna o caminho da url, com excessão do dominío]
     */
    protected function getUrl()
    {
        return filter_var(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), FILTER_SANITIZE_SPECIAL_CHARS);
    }

    /**
     * Procura no array de rotas do site, se a url acessada existe,
     * caso encontre instancia a classe controller responsavel dessa rota
     * @param  string $url caminho da url
     */
    protected function run($url)
    {
        //a funcção trim(), removerá espaços e/ou '/'
        // no começo ou final da url, deixando só o nome da rota
        $url = trim($url,'/');
        $rota['controller'] = 'home';
        $rota['action'] = 'error404';

        foreach ($this->routes as $key => $value) {
            if ($url == $value['route']) :
                $rota['controller'] = $value['controller'];
                $rota['action'] = $value['action'];
            endif;
        }

        /*Instancia a ccontroller da rota, e chama a action passada*/
        $class = "App\\Controllers\\"
        .ucfirst($rota['controller']."Controller");
        $rota['controller'] = new $class;
        $action = $rota['action'];
        $rota['controller']->$action();
    }
}