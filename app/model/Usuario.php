<?php
namespace App\model;

use App\dao\UsuarioDao;
use App\model\ManipulacaoImagem;

if (! defined('ABSPATH')){
    header("Location: /");
    exit();
}

class Usuario extends UsuarioDao{
    private $id;
    private $data_cadastro;
    private $nome;
    private $login;
    private $senha;
    private $email;
    private $ativo;
    private $tipo;
    private $apelido;
    private $imagem;

    /**
     * Usuario constructor.
     * @param $data_cadastro
     * @param $nome
     * @param $login
     * @param $senha
     * @param $email
     * @param $ativo
     * @param $tipo
     * @param $apelido
     */
    public function __construct($data_cadastro = null, $nome = null, $login = null, $senha = null, $email = null, $ativo = 0, $tipo = null, $apelido = null)
    {
        parent::__construct();
        $this->data_cadastro = !empty($data_cadastro) ? $data_cadastro : date("Y-m-d");
        $this->nome = $nome;
        $this->login = $login;
        $this->senha = $senha;
        $this->email = $email;
        $this->ativo = $ativo;
        $this->tipo = $tipo;
        $this->apelido = $apelido;
        $this->setUsuario($this);
        $this->imagem = new ManipulacaoImagem();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return filter_var($this->id, FILTER_VALIDATE_INT);
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return false|string
     */
    public function getDataCadastro()
    {
        return $this->data_cadastro;
    }

    /**
     * @param false|string $data_cadastro
     */
    public function setDataCadastro($data_cadastro)
    {
        $this->data_cadastro = $data_cadastro;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param mixed $senha
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * @param mixed $ativo
     */
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
    }

    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @return null
     */
    public function getApelido()
    {
        return $this->apelido;
    }

    /**
     * @param null $apelido
     */
    public function setApelido($apelido)
    {
        $this->apelido = $apelido;
    }

    /**
     * @return \App\model\ManipulacaoImagem
     */
    public function getImagem(): \App\model\ManipulacaoImagem
    {
        return $this->imagem;
    }

    /**
     * @param \App\model\ManipulacaoImagem $imagem
     */
    public function setImagem(\App\model\ManipulacaoImagem $imagem): void
    {
        $this->imagem = $imagem;
    }

    public function Login()
    {
        $result = $this->loginDAO();

        if (!empty($result)) {

            if (password_verify($this->senha, $result["usu_senha"])) {
                $this->id = $result["usu_id"];
                $this->UltimoAcessoDAO();
                $_SESSION["_idusuario"] = $result["usu_id"];
                $_SESSION["_logado"] = true;
                session_write_close();

                return true;

            } else {
                $this->setRetorno("usuário ou senha estão incorretos", true, false);
            }

        } elseif(empty($this->getRetorno()["exibir"])) {
            $this->setRetorno("Não foi possível fazer o login", true, false);
        }

    	return false;
    }

    public function alterarPerfil() {
        $result = false;

        if ($this->conectar()) {

            $this->beginTransaction();
            $result = $this->alterarPerfilDAO();

            if (!empty($result) && !empty($this->imagem->getFileImagem())) {

                if ($this->carregarAvatarDAO() && !empty($this->getImagem()->getNomeImagem())) {

                    if (file_exists(PATH_IMG . "usuarios/" . $this->getImagem()->getNomeImagem()))
                        unlink(PATH_IMG . "usuarios/" . $this->getImagem()->getNomeImagem());

                    if (file_exists(PATH_IMG . "usuarios/thumbs/" . $this->getImagem()->getNomeImagem()))
                        unlink(PATH_IMG . "usuarios/thumbs/" . $this->getImagem()->getNomeImagem());

                }

                $this->imagem->setNomeImagem($this->getId() . $this->imagem->getTipoImagem());
                $result = $this->alterarPerfilFotoDAO();

                if ($result)
                    $this->imagem->salvarImagem(PATH_IMG . 'usuarios/', 500, 500);
                    $this->imagem->salvarImagemDados(PATH_IMG . 'usuarios/thumbs/', 200, 200);
            }

            $this->commitar($result);
        }


        return $result;
    }

    public function carregarInformacoes() {
        return $this->carregarInformacoesDAO();
    }

    public function carregarInformacoes2()
    {
        return parent::carregarInformacoes2DAO(); // TODO: Change the autogenerated stub
    }

    public function alterarSenha($senha_atual) {
        $result = $this->obterSenha();

        if (!empty($result)) {

            if (password_verify($senha_atual, $result["usu_senha"])) {

                $this->senha = password_hash($this->senha, PASSWORD_DEFAULT);
                return $this->alterarSenhaDAO();

            } else
                $this->setRetorno("Senha atual informada está incorreta", true, false);

        }

        return false;
    }

    public function obterSenha() {
        return parent::obterSenha();
    }

    public function getRetorno() {
        return parent::getRetorno();
    }

    public  function paginacao($incio, $fim, $parametros) {
        return $this->limiteRegistroDAO($incio, $fim, $parametros);
    }

    public function totalRegistros($parametros) {
        return $this->totalRegistrosDAO($parametros);
    }

    public function inserir() {

        if (!$this->verificaEmailDAO()) {

            if (!$this->verificaUsuarioDAO()) {
                $this->senha = password_hash($this->senha, PASSWORD_DEFAULT);
                if ($this->inserirDAO())
                    return true;

            } else
                $this->setRetorno("O usuário informado já existe no sistema", true, false);

        } else
            $this->setRetorno("O email informado já existe no sistema", true, false);

        return false;
    }

    public function carregar() {

        $result = $this->carregarDAO();

        if (!empty($result)) {

            $this->nome = $result["usu_nome"];
            $this->login = $result["usu_login"];
            $this->email = $result["usu_email"];
            $this->tipo = $result["tip_id"];

            return true;
        }

        return false;
    }

    public function alterar() {
        $this->senha = password_hash($this->senha, PASSWORD_DEFAULT);
        return $this->alterarDAO();
    }

    public function alterarStatus() {
        return $this->alterarStatusDAO();
    }

    public function excluir() {

        $retorno = $this->excluirDAO();

        if (!empty($retorno))
            return true;

        return false;

    }

}