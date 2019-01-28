<?php
namespace App\model;

use App\dao\UsuarioDao;
use App\model\Retorno;
use WideImage\WideImage;

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
    private $img_avatar;
    private $file_avatar;

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
        $this->img_avatar = "";
        $this->file_avatar = "";
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
     * @return string
     */
    public function getImgAvatar(): string
    {
        return $this->img_avatar;
    }

    /**
     * @param string $img_avatar
     */
    public function setImgAvatar(string $img_avatar)
    {
        $this->img_avatar = $img_avatar;
    }

    /**
     * @param array $file_avatar
     */
    public function setFileAvatar(array $file_avatar)
    {
        $this->file_avatar = $file_avatar;
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

        $result = $this->alterarPerfilDAO();

        if (!empty($result) && !empty($this->file_avatar)) {

            if (file_exists(PATH_IMG . "usuarios/" . $this->getId() . ".jpg"))
                unlink(PATH_IMG . "usuarios/" . $this->getId() . ".jpg");
            elseif (file_exists(PATH_IMG . "usuarios/" . $this->getId() . ".jpeg"))
                unlink(PATH_IMG . "usuarios/" . $this->getId() . ".jpeg");
            elseif (file_exists(PATH_IMG . "usuarios/" . $this->getId() . ".png"))
                unlink(PATH_IMG . "usuarios/" . $this->getId() . ".png");
            elseif (file_exists(PATH_IMG . "usuarios/" . $this->getId() . ".gif"))
                unlink(PATH_IMG . "usuarios/" . $this->getId() . ".gif");

            $tipo = ".png";

            if (strcmp('image/jpeg',$this->file_avatar['type']) === 0)
                $tipo = ".jpg";
            elseif (strcmp('image/gif',$this->file_avatar['type']) === 0)
                $tipo = ".gif";
            elseif (strcmp('image/png',$this->file_avatar['type']) === 0)
                $tipo = ".png";

            $nome_file = $this->getId() . $tipo;

            $image = WideImage::loadFromFile($this->file_avatar["tmp_name"]);
            $resized = $image->resize(150, 150, 'inside');
            $resized->saveToFile( PATH_IMG . "usuarios/" . $nome_file);

        }

        return $result;
    }

    public function carregarInformacoes() {
        $result = $this->carregarInformacoesDAO();

        if (!empty($result)) {

            if (file_exists(PATH_IMG . "usuarios/" . $this->getId() . ".jpg"))
                $this->img_avatar = $this->getId() . ".jpg";
            elseif (file_exists(PATH_IMG . "usuarios/" . $this->getId() . ".jpeg"))
                $this->img_avatar = $this->getId() . ".jpeg";
            elseif (file_exists(PATH_IMG . "usuarios/" . $this->getId() . ".png"))
                $this->img_avatar = $this->getId() . ".png";
            elseif (file_exists(PATH_IMG . "usuarios/" . $this->getId() . ".gif"))
                $this->img_avatar = $this->getId() . ".gif";

        }

        return $result;
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

    public  function paginacao($incio, $fim) {
        return $this->limiteRegistroDAO($incio, $fim);
    }

    public function totalRegistros() {
        return $this->totalRegistrosDAO();
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

}