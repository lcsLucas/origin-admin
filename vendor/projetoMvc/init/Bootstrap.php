<?php
/**
 * PHP version 7
 *
 * @category PHP
 * @package  PHP_ProjetoMVC
 * @author   Lucas S. Rosa <lucas.tarta@hotmail.com>
 */
namespace ProjetoMVC\init;

if (! defined('ABSPATH')){
    header("Location: /");
    exit();
}

/**
 * Classe responsavel pelo funcionanmento do padrão MVC
 * Captura todas as urls passadas e define quem deve chamar para responder a requisição, e qual Action
 * que deve chamar para ser executada.
 */
abstract class Bootstrap
{
    /**
     * propriedade privada
     * @var array -> contém todas as rotas do site.
     */
    private $routes;

    /**
     * Chama a função initRoutes que define
     * as rotas do site e chama o metodo 'Run', que define a Controller e a Action a ser executada.
     */
    public function __construct()
    {
        $this->initRoutes();
        $this->run($this->getUrl());
    }

    /**
     * Descrição: Define todas as rotas que o site terá,
     * e seta na propriedade 'routes' da classe.
     */
    abstract protected function initRoutes();

    /**
     * Seta a propriedade 'routes' da classe
     * @param array 'routes' [Recebe um array de rotas]
     * @return  void
     */
    protected function setRoutes(array $routes)
    {
        $this->routes = $routes;
    }

    /**
     * Captura a URL que o usuário acessou no site.
     * @return [string] [retorna o caminho da URI, com excessão do dominío]
     */
    protected function getUrl()
    {
        return filter_var(parse_url(filter_input(INPUT_SERVER, 'REQUEST_URI'), PHP_URL_PATH), FILTER_SANITIZE_URL);
    }

    /**
     * Procura no array de rotas do site, se a url acessada existe,
     * caso encontre, instancia a classe controller responsavel
     *dessa rota e executa a Action responsavel pela requisição.
     *
     * @param  string $url caminho da url
     */
    protected function run($url)
    {        
        $vet_param = [];
        $achou = false;
        $tam = count($this->routes);
        //a função 'trim', removerá espaços e/ou '/'
        // no começo da url, deixando só o nome da rota
        $url = trim($url,'/');
        if(SUBDOMINIO)
            $url = trim(substr($url, strlen(URI)),"/");
        /**
         * Se por acaso não encontrar nenhuma rota no site, que corresponde ao que o usuário passou,
         * então já é definido que será instanciado a controller 'home', e será chamado a Action 'pageError404'
         * a qual exibe a página de error 404, que é de página não encontrada.
         */
        $rota['controller'] = 'home';
        $rota['action'] = 'pageError404';

        //busca a rota informada pela url no array de rotas do site
        for($i = 0; $i < $tam && !$achou; $i++) {
            $urlaux = substr($url, 0, strlen($this->routes[$i]['route']));
            if (strcmp($urlaux, $this->routes[$i]['route']) === 0) :
                if (strcmp($this->routes[$i]['method'], filter_input(INPUT_SERVER, 'REQUEST_METHOD')) === 0) :  
                    $urlaux = substr($url, strlen($this->routes[$i]['route']));
                    $urlaux = trim($urlaux,"/");
                    $url_param = array_filter(explode("/", $urlaux));
                    if (count($this->routes[$i]['param']) === count($url_param)) :
                        foreach ($this->routes[$i]['param'] as $key => $parametro) {
                            $vet_param[$this->routes[$i]['param'][$key]] =  $url_param[$key];
                        }
                        
                        $rota['controller'] = $this->routes[$i]['controller'];
                        $rota['action'] = $this->routes[$i]['action'];
                        $achou = true;
                    endif;
                endif;
            endif;
        }

        /*Instancia a controller da rota, e chama a action passada*/
        /*obs: caso nao tenha encontrado nehuma rota, chama a action da página 'error404'
        da controller 'home', a qual foi definido lá em cima.
        */
        $class = "App\\controllers\\"
        .ucfirst($rota['controller']."Controller");
        $rota['controller'] = new $class($vet_param);
        $action = $rota['action'];
        $rota['controller']->$action();
    }
}
