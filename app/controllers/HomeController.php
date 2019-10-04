<?php

namespace App\controllers;

use Curl\Curl;
use ProjetoMvc\render\Action;
use App\model\Usuario;
use App\model\Data_Validator;

if (! defined('ABSPATH'))
    die;

class HomeController extends Action
{
    public function __construct()
    {
        $this->autenticacao = false;
        parent::__construct();
        /**
         * caminho com o arquivo do layout padrão que todasas paginas dessa controller poderá usar
         */
        $this->layoutPadrao = PATH_VIEWS.'shared/layoutPadrao';
    }

    /**
     * Chama a view de tela principal.
     */
    public function pageIndex()
    {
        if (isset($_SESSION['_idusuario'])) :
            header('Location: '. URL .'dashboard');
        else :
            $this->dados->title = 'Página de login';
            header('Location: '. URL .'login');
        endif;
        exit();
    }

    /**
     * chama a view dashboard, passando o titulo da página
     * @return void
     */
    public function pageDashboard()
    {
        $this->dados->title = 'Dashboard';
        $this->render('dashboard.php');
    }

    /**
     * chama a view de pagina nao encontrada
     */
    public function pageError404()
    {
        $this->dados->title = 'Página Não Encontrada';
        http_response_code(404);
        $this->render('error404.html');
    }

    public function pageLogin() {

        if (isset($_SESSION['_idusuario'])) {
            header('Location: '. URL .'dashboard');
            exit();
        } elseif(filter_has_var(INPUT_COOKIE, '_usulogado')) {
        	$logado = filter_input(INPUT_COOKIE, '_usulogado', FILTER_SANITIZE_SPECIAL_CHARS);

        	if (!empty($logado)) {
        		$usu = new Usuario();

        		if (filter_var($logado, FILTER_VALIDATE_EMAIL))
					$usu->setEmail($logado);
        		else
					$usu->setLogin($logado);

        		if (!empty($usu->login_logado())) {
					header('Location: '. URL .'dashboard');
					exit();
				}

			}

		}

        $this->dados->title = 'Página de login';
        $this->render('login.php', false);

    }

    public function login()
    {
        $usu = new Usuario();
        $validate = new Data_Validator();

        if (filter_has_var(INPUT_POST, 'btnLogar')) :
            $login = trim(filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS));
            $senha = trim(filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS));
            $token = trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_SPECIAL_CHARS));
            $resp_desafio = filter_input(INPUT_POST, 'resposta_desafio', FILTER_VALIDATE_INT);
			$logado = filter_has_var(INPUT_POST, 'ckLogado');
            $recaptcha = trim(filter_input(INPUT_POST, 'recaptcha_response', FILTER_SANITIZE_SPECIAL_CHARS));
            $ip = filter_input(INPUT_SERVER, 'REMOTE_ADDR');

            $validate->define_pattern('erro_');
            $validate
                ->set('login', $login)->is_required()
                ->set('senha', $senha)->is_required()
                ->set('token', $token)->is_required();
            /*
			$_SESSION['_tentativas'] = 6;
			unset($_SESSION['_bloqueio_login']);
			setcookie('_bloqueio_login', '', time() - 36000, '', '', false, true);
            var_dump($_SESSION['_tentativas']);
            */
            if (!empty($_SESSION['_bloqueio_login']) || filter_has_var(INPUT_COOKIE, '_bloqueio_login')) {

            	if (!empty($_SESSION['_bloqueio_login'])) {
            		$tempo_bloqueio = filter_var($_SESSION['_bloqueio_login'], FILTER_VALIDATE_INT);
				} else {
					$tempo_bloqueio = filter_input(INPUT_COOKIE, '_bloqueio_login', FILTER_VALIDATE_INT);
				}

            	if (!empty($tempo_bloqueio)) {
					$data_atual = new \DateTime();
					$data_bloqueio = new \DateTime();
					$data_bloqueio->setTimestamp($tempo_bloqueio);

					if ($data_atual->getTimestamp() < $data_bloqueio->getTimestamp()) {
						$this->setRetorno('Acesso bloqueado temporariamente até ás '. $data_bloqueio->format('H:i:s'), true, false);
					} else {
						$continuar_login = true;
					}

				} else {
					$this->setRetorno('Parametros inválidos, atualize a página e tente novamente', true, false);
				}

			} elseif (!empty($_SESSION['_tentativas']) && $_SESSION['_tentativas'] > 5) {
				$data = new \DateTime();
				$data->add(new \DateInterval('PT30M'));
				$stamp = $data->getTimestamp();

				unset($_SESSION['_tentativas']);
				$_SESSION['_bloqueio_login'] = $stamp;
				setcookie('_bloqueio_login', $stamp, $stamp, '', '', false, true); // 30 minutos para expirar

				$this->setRetorno('Acesso bloqueado temporariamente até ás '. $data->format('H:i:s'), true, false);

			} else if(!empty($_SESSION['_desafio'])) {

            	if (!empty($_SESSION['_resp_desafio'])) {

            		if ($_SESSION['_resp_desafio'] === $resp_desafio) {
            			$continuar_login = true;
					} else {
						$this->setRetorno('Resposta do desafio incorreto, tente novamente', true, false);
						$this->gerarDesafioLogin();
					}

				} else {
					$this->setRetorno('Não foi possível validar o login, atualize a página e tente novamente', true, false);
				}

			} else {
				$continuar_login = true;
			}

            if (!empty($continuar_login)) {

				if (!empty($recaptcha)) {

					$curl = new Curl();
					$curl->get(
						'https://www.google.com/recaptcha/api/siteverify',
						array(
							'secret' => RECAPTCHA_SECRET_KEY,
							'response' => $recaptcha,
							'remoteip' => $ip
						)
					);

					if (empty($curl->error)) {

						$response = $curl->response;

						if (!empty($response)) {

							if (!empty($response->success)) {

								if (!empty($response->score) && ($response->score > 0.9 || !empty($_SESSION['_resp_desafio']))) {

									if ($validate->validate()) {

										if (password_verify(TOKEN_SESSAO, $token)) {

											if (filter_var($login, FILTER_VALIDATE_EMAIL))
												$usu->setEmail($login);
											else
												$usu->setLogin($login);

											$usu->setSenha($senha);

											if (!empty($usu->login())) {
												if (!empty($_SESSION['tentativas']))
													unset($_SESSION['tentativas']);

												if (!empty($_SESSION['_resp_desafio']))
													unset($_SESSION['_resp_desafio']);

												if (!empty($_SESSION['_desafio']))
													unset($_SESSION['_desafio']);

												if (!empty($_SESSION['_bloqueio_login']))
													unset($_SESSION['_bloqueio_login']);

												$this->setRetorno('Logado com sucesso, aguarde estamos te direcionando...', true, true);
												$this->setExtra(
													array(
														'url_direcionar' => URL . 'dashboard'
													)
												);

												if (!empty($logado))
													setcookie('_usulogado', $login, (time()+60*60*24*30), '', '', false, true);

											} else if($usu->getRetorno()['exibir']) {
												$this->setRetorno($usu->getRetorno()['mensagem'], $usu->getRetorno()['exibir'], $usu->getRetorno()['status']);
											} else {
												$this->setRetorno('Não foi possível fazer o login', true, false);
											}

										} else {
											$this->setRetorno('Token de autenticação inválido', true, false);
										}

									} else {

										$array_erros = $validate->get_errors();
										$array_erro = array_shift($array_erros);
										$erro = array_shift($array_erro);
										$this->setRetorno($erro, true, false);
									}

								} else { //devolver o
									$this->setRetorno('Por favor responda ao desafio, para continuar', true, false);
									if (!$this->gerarDesafioLogin()) {
										$this->setRetorno('Não foi possível validar o login, atualize a página e tente novamente', true, false);
									}
								}

							} else
								$this->setRetorno('Token do reCAPTCHA inválido, atualize a página e tente novamente', true, false);

						} else
							$this->setRetorno('Não foi possível validar o token do reCAPTCHA, tente novamente', true, false);

					} else
						$this->setRetorno('Não foi possível validar o token do reCAPTCHA, tente novamente', true, false);

				} else
					$this->setRetorno('Token do reCAPTCHA inválido, atualize a página e tente novamente', true, false);

			}

            if (empty($this->getRetorno()['status'])) {
            	if (empty($_SESSION['_tentativas']))
					$_SESSION['_tentativas'] = 1;
            	else
					$_SESSION['_tentativas']++;
			}

            echo json_encode($this->getRetorno(), JSON_FORCE_OBJECT);

        else :
            header('Location: '. URL .'login');
            exit();
        endif;
    }

    public function logout()
    {
    	unset($_COOKIE['_usulogado']);
		setcookie('_usulogado', '', time() - 36000, '', '', false, true);
		session_destroy();

		header('Location: ' . URL);
		exit();
	}

	private function gerarDesafioLogin() {
    	$curl = new Curl();

		do {
			$num1 = mt_rand(0, 5);
			$num2 = mt_rand(0, 5);
		} while($num1 === $num2);

		$resposta = $num1 + $num2;

		$_SESSION['_desafio'] = true;
		$_SESSION['_resp_desafio'] = $resposta;

		$response_img = $curl->get('https://via.placeholder.com/360x150?text='. $num1 .'%2b' . $num2);

		if (empty($curl->error) && !empty($response_img)) {
			$imagem = base64_encode($response_img);
			$src_img = 'data: image/png;base64,'.$imagem;

			$this->setExtra(array(
				'desafio' => '1',
				'img_desafio' => $src_img
			));

			return true;
		}

    	return false;
	}

}
