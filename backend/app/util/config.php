<?php

define('SUBDOMINIO', TRUE); // quando o site tem subdominio, obs: isso tbm serve para localhost que geramente os arquivos ficam em pasta a qual o acesso não é direto pela URL: EX:http://localhost/sistema_delivery/

if (SUBDOMINIO) {
    define('URI','painel_administrativo');
    define( 'ABSPATH', htmlspecialchars($_SERVER['DOCUMENT_ROOT']) . '/' . URI . '/');
} else {
    define( 'ABSPATH', htmlspecialchars($_SERVER['DOCUMENT_ROOT']) . '/');
}

define('LOCALHOST', true);
define('VERSAO', '1.0.0');
define( 'URL', htmlspecialchars($_SERVER['REQUEST_SCHEME']) . '://' . htmlspecialchars($_SERVER['SERVER_NAME']) .'/'. URI . '/');
define( 'URL_PUBLIC', URL .'public/');
define( 'URL_CSS', LOCALHOST ? 'http://localhost:9000/css/' : URL.'public/css/');
define( 'URL_IMG', URL.'public/img/');
define( 'URL_JS', LOCALHOST ? 'http://localhost:9000/js/' : URL.'public/js/');

define( 'PATH_VIEWS', ABSPATH .'public/views/');
define( 'PATH_IMG', ABSPATH .'public/img/');

define('DB_HOST','localhost');
define('DB_NAME','projeto_mvc');
define('DB_USER','root');
define('DB_PASSWORD','');
define('DB_CHARSET', 'utf8' );

define('RECAPTCHA_SITE_KEY', '6LcPJ7oUAAAAAJxe_WxBDzLdhvu6J7Q34QKiYW0K');
define('RECAPTCHA_SECRET_KEY', '6LcPJ7oUAAAAAF_u5hInxwYOCJWMeU-R1jMXXonM');

define('TOKEN_SESSAO', 'sitesmonkey_' . htmlspecialchars($_SERVER['REMOTE_ADDR']) . htmlspecialchars($_SERVER['HTTP_USER_AGENT']));

define('DEBUG', true );

require_once ABSPATH.'backend/app/util/loader.php';