<?php

namespace App\model;

use WideImage\WideImage;

if (! defined('ABSPATH'))
    die;

class ManipulacaoImagem
{
    private $file_imagem;
    private $nome_imagem;
    private $dados_imagem;
    private $parametro_imagem;
    private $tipo_imagem;
    private $objetoWide;
    private $retorno;

    /**
     * ManipulacaoImagem constructor.
     * @param $file_imagem
     * @param $nome_imagem
     * @param $dados_imagem
     */
    public function __construct($file_imagem=null, $nome_imagem=null, $dados_imagem=null, $parametro_imagem = null, $tipo_imagem = null)
    {
        $this->file_imagem = $file_imagem;
        $this->nome_imagem = $nome_imagem;
        $this->dados_imagem = $dados_imagem;
        $this->parametro_imagem = $parametro_imagem;
        $this->tipo_imagem = $tipo_imagem;
        $this->retorno = new Retorno();
        $this->objetoWide = null;
    }

    /**
     * @return null
     */
    public function getFileImagem()
    {
        return $this->file_imagem;
    }

    /**
     * @param null $file_imagem
     */
    public function setFileImagem($file_imagem): void
    {
        $this->file_imagem = $file_imagem;
    }

    /**
     * @return null
     */
    public function getNomeImagem()
    {
        return $this->nome_imagem;
    }

    /**
     * @param null $nome_imagem
     */
    public function setNomeImagem($nome_imagem): void
    {
        $this->nome_imagem = $nome_imagem;
    }

    /**
     * @return null
     */
    public function getDadosImagem()
    {
        return $this->dados_imagem;
    }

    /**
     * @param null $dados_imagem
     */
    public function setDadosImagem($dados_imagem)
    {
        $this->dados_imagem = $dados_imagem;
    }

    /**
     * @return null
     */
    public function getTipoImagem()
    {
        return $this->tipo_imagem;
    }

    /**
     * @param null $tipo_imagem
     */
    public function setTipoImagem($tipo_imagem): void
    {
        $this->tipo_imagem = $tipo_imagem;
    }

    /**
     * verifica o tamnho e o tipo da uma imagem enviada atraves do parametro
     * @param  array $restricoes = restricoes da imagem enviada, [0] => tamanho maximo da imagem enviada, [1] => tipos permitido da imagem
     * @return boolean.
     */
    public function verificaImagem($restricoes) {
        $erro_img = false;
        $tamanho_maximo = filter_var($restricoes[0], FILTER_VALIDATE_INT);
        $tipos_permitidos = filter_var_array($restricoes[1], FILTER_SANITIZE_STRING);

        $tamanho_maximo = !empty($tamanho_maximo) ? $tamanho_maximo : 1572864;

        if (!empty($this->file_imagem['error']) && $this->file_imagem['error'] !== 4) {

            if ($this->file_imagem['error'] === 1 || $this->file_imagem['error'] === 2)
                $this->setRetorno('O arquivo \''. $this->file_imagem['name'] .'\' excede o tamanho máximo permitido no servidor.', true, false);
            elseif($this->file_imagem['error'] === 3)
                $this->setRetorno('Não foi possível fazer o upload completo do arquivo, tente novamente', true, false);
            elseif($this->file_imagem['error'] === 6)
                $this->setRetorno('Não foi possível fazer o upload do arquivo (pasta temporária ausente)', true, false);
            else
                $this->setRetorno('Erro inesperável no upload do arquivo, tente novamente', true, false);

            $erro_img = true;
        } else if($this->file_imagem['size'] > $tamanho_maximo) {
            $this->setRetorno('O arquivo \'' . $this->file_imagem['name'] . '\' excede o tamanho máximo permitido de 1,5MB.', true, false);
            $erro_img = true;
        }

        if (!$erro_img) {

            $this->tipo_imagem = '.jpg';
            $this->parametro_imagem = null;

            $ind_img = array_search($this->getFileImagem()['type'], $tipos_permitidos);

            if (intval($ind_img) >= 0) {

                $tipo_arquivo = $tipos_permitidos[$ind_img];
                $tipo_arquivo = str_replace('image/','', $tipo_arquivo);

                $this->tipo_imagem = '.' . $tipo_arquivo;

                if ($this->tipo_imagem === '.png') {
                    $this->parametro_imagem = 9;
                } elseif ($this->tipo_imagem === '.jpg' || $this->tipo_imagem === '.jpeg') {
                    $this->parametro_imagem = 90;
                }

            } else {
                $erro_img = true;
                $this->setRetorno('O Tipo do arquivo enviado é inválido. Por favor, envie um arquivo do tipo \''. implode(', ', $tipos_permitidos) .'\'', true, false);
            }

        }

        return $erro_img;
    }

    /**
     * define o retorno da requisição
     * @param  string $mensagem = mensagem do retorno
     * @param  boolean $flag_exibir = flag que diz se é pra ser mostrado ao usuario a mensagem
     * @param  boolean $flag_status = flag que diz se o retono é um erro ou não
     * @return void.
     */
    public function setRetorno($mensagem, $flag_exibir, $flag_status) {
        $this->retorno->setRetorno($mensagem, $flag_exibir, $flag_status);
    }

    public function getRetorno() {
        return $this->retorno->getRetorno();
    }

    private function loadImage() {
        if (empty($this->objetoWide)) {

        	try {
				$this->objetoWide = WideImage::loadFromFile($this->file_imagem['tmp_name']);
				return true;
			} catch(\Exception $e) {
				$this->setRetorno($e->getMessage(), true, false);
			}
		} else
			return true;

        return false;
    }

    public function salvarImagem($pasta, $width, $height) {

        if($this->loadImage()) {
			try {
				$resized = $this->objetoWide->resize($width, $height, 'inside','down');
				$resized->saveToFile( $pasta . $this->nome_imagem, $this->parametro_imagem);
				return true;
			} catch(\Exception $e) {
				$this->setRetorno($e->getMessage(), true, false);
			}

		}

        return false;
    }

    public function salvarImagemDados($pasta, $width, $height) {

    	if($this->loadImage()) {

			try {

				if (!empty($this->dados_imagem)) {

					$resized2 = $this->objetoWide
						->crop
						(
							$this->dados_imagem['x'],
							$this->dados_imagem['y'],
							$this->dados_imagem['width'],
							$this->dados_imagem['height']
						)
						->resize
						(
							$width,
							$height,
							'inside',
							'down'
						);
					$resized2->saveToFile( $pasta . $this->nome_imagem, $this->parametro_imagem);
				} else {

					$resized2 = $this->objetoWide
						->resize
						(
							$width,
							$height,
							'inside',
							'down'
						);
					$resized2->saveToFile( $pasta . $this->nome_imagem, $this->parametro_imagem);

				}

				return true;
			} catch(\Exception $e) {
				$this->setRetorno($e->getMessage(), true, false);
			}

		}

        return false;
    }

}