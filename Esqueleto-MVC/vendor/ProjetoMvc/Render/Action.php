<?php
/**
 * Classe responsavel por renderizar a view chamada para utilizar no padrão MVC
 *
 * PHP version 7
 *
 * @category PHP
 * @package  PHP_ProjetoMVC
 * @author   Lucas S. Rosa <lucas.tarta@hotmail.com>
 */
namespace ProjetoMvc\Render;

if (! defined('ABSPATH')){
    header("Location: /");
    exit();
}

abstract class Action
{
    /**
     * propriedade responsavel por amarzenar dados da view
     * @var stdClass - classe genérica do PHP
     */
	protected $view;
    /**
     * A view que vai ser exibida
     * @var string
     */
    protected $layout;
    /**
     * Arquivo Css incorporado da pagina(Se necessário)
     * @var string
     */
    protected $css;
    /**
     * Arquivo JS incorporado da pagina(Se necessário)
     * @var string
     */
    protected $js;
    /**
     * estancia a classe genérica do PHP
     */
    public function __construct()
    {
        $this->view = new \stdClass;
    }

    /**
     * Renderiza o Layout que o controller solicitou.
     * @param  string $layout = layout a ser executado.
     * @param  boolean $template = caso true carrega o layoutpadrao,
     * senao apenas carrega o layout.
     * @return sem retorno.
     */
    public function render($layout, $template = true)
    {
        $this->layout = $layout;
        if($template && file_exists(PATH_VIEWS."Shared/layoutPadrao.php"))
            include_once PATH_VIEWS."Shared/layoutPadrao.php";
        else{
        	$this->content();
        }
    }
	/*Se for informado um css incorporado, é adicionado no arquivo.
	*/
    public function renderCss()
    {
        if (!empty($this->css) && file_exists(PATH_CSS.$this->css)) {
            include_once PATH_CSS.$this->css;
        }
    }

	/*Se for informado um js incorporado, é adicionado no arquivo.
	*/
    public function renderJS()
    {
        if (!empty($this->js) && file_exists(PATH_JS.$this->js)) {
            include_once PATH_JS.$this->js;
        }
    }

    /**
     * renderiza no layout o conteudo solicitado no metodo render.
     * @return [type] [description]
     */
    public function content()
    {
        /*pega a classe atual, com nomespace e a classe*/
        $classe_atual = get_class($this);
        /*pega apenas o nome da classe,
        depois do ultimo '\'*/
        $nomeClasse = substr($classe_atual, strripos($classe_atual,"\\")+1);
        /*remove a parte 'Controller da action'*/
        $nomeClasse = str_replace("Controller", "", $nomeClasse);

        /**
         * verifica se o arquivo existe na pasta views, senao inclui o arquivo
         * na pasta Admin dentro de View.
         */
        if (file_exists(PATH_VIEWS.$nomeClasse."/".$this->layout.".php")) :
            include_once PATH_VIEWS.$nomeClasse."/".$this->layout.".php";
        else :
            include_once PATH_VIEWS."Admin/".$nomeClasse."/".$this->layout.".php";
        endif;
    }
}