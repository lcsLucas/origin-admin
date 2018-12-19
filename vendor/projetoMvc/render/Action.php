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
namespace ProjetoMvc\render;

use App\model\Retorno;

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
    protected $dados;
    /**
     * A view que vai ser exibida
     * @var string
     */
    protected $layout;
	/**
	*variavel que contem todos os parametros passado por url
	*@var Array
	*/
    protected $param;
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

    /*
    *Arquivo para renderizar o layout padrao da pagina, caso não seja informado nenhum,
    * é renderizado o layout padrao default
    */
    protected $layoutPadrao;

    protected $retorno;

    /**
     * estancia a classe genérica do PHP para a propriedade dados
     * propriedade 'param' recebe os parametros passados pela url(se houver).
     */
    public function __construct()
    {
        $this->dados = new \stdClass;
        $this->param = [];
        $this->retorno = new Retorno();
    }

    /**
     * Renderiza o Layout que o controller solicitou.
     * @param  string $layout = layout a ser executado.
     * @param  boolean $template = caso true carrega o layoutpadrao,
     * senao apenas carrega o layout.
     *@param layoutPadrao = caso seja diferente de false, carrega o layout que foi informado para essa página.
     * @return sem retorno.
     */
    public function render($layout, $template = true, $layoutPadrao = false)
    {
        $this->layout = $layout;
        if($template && !$layoutPadrao && file_exists($this->layoutPadrao.".php"))
            include_once $this->layoutPadrao.".php";
        else {
            $this->content();
        }
    }

    /**
     * define o retorno da requisição
     * @param  string $mensagem = mensagem do retorno
     * @param  boolean $flag_exibir = flag que diz se é pra ser mostrado ao usuario a mensagem
     * @param  boolean $flag_status = flag que diz se o retono é um erro ou não
     * @return sem retorno.
     */
    public function setRetorno($mensagem, $flag_exibir, $flag_status) {
        $this->retorno->setRetorno($mensagem, $flag_exibir, $flag_status);
    }

    /**
     * @return array
     */
    public function getRetorno() {
        return $this->retorno->getRetorno();
    }

    public function setExtra($extra) {
        $this->retorno->setExtra($extra);
    }

    /*
    *metodo responsavel por renderizar o css "incorporado" da página
    */
    public function renderCss()
    {
        if (!empty($this->css) && file_exists(URL_CSS.$this->css.".css")) {
            echo "<style type=\"text/css\">";
            include_once URL_CSS.$this->css.".css";
            echo "</style>";
        }
    }

    /*
    *metodo responsavel por renderizar o javascript "incorporado" da página
    */
    public function renderJS()
    {
        if (!empty($this->js) && file_exists(URL_JS.$this->js.".js")) {
            echo "<script type=\"text/javascript\">";
            include_once URL_JS.$this->js.".js";
            echo "</script>";
        }
    }

    /**
     * renderiza no layout o conteudo solicitado no metodo render.
     * @return void
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
        if (file_exists(PATH_VIEWS.strtolower($nomeClasse.DIRECTORY_SEPARATOR.$this->layout))) :
            include_once PATH_VIEWS.strtolower($nomeClasse.DIRECTORY_SEPARATOR.$this->layout);
        elseif (file_exists(PATH_VIEWS.PASTA_ADMIN.strtolower($nomeClasse.DIRECTORY_SEPARATOR.$this->layout))) :
            include_once PATH_VIEWS.PASTA_ADMIN.strtolower($nomeClasse.DIRECTORY_SEPARATOR.$this->layout);
        endif;
    }
}