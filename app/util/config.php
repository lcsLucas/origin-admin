<?php

define("SUBDOMINIO", TRUE); // quando o site tem subdominio, obs: isso tbm serve para localhost que geramente os arquivos ficam em pasta a qual o acesso não é direto pela URL: EX:http://localhost/sistema_delivery/

if (SUBDOMINIO) {
    define("URI","projeto_php_mvc");
    define( 'ABSPATH', $_SERVER['DOCUMENT_ROOT'] . "/" . URI . "/");
} else {
    define( 'ABSPATH', $_SERVER['DOCUMENT_ROOT'] . "/");
}

define( 'PASTA_ADMIN', "admin");

define( 'URL', filter_input(INPUT_SERVER, 'REQUEST_SCHEME') . "://" . filter_input(INPUT_SERVER, 'SERVER_NAME') ."/". URI . "/");

define( 'PATH_VIEWS', ABSPATH ."public/views/");

define( 'URL_PUBLIC', URL ."public/");

define( 'URL_CSS', URL."public/css/");

define( 'URL_JS', URL."public/js/");

define('DB_HOST','localhost');

define('DB_NAME','projeto_mvc');

define('DB_USER','root');

define('DB_PASSWORD','');

define('DB_CHARSET', 'utf8' );

define('TOKEN_SESSAO', password_hash("seg" . filter_input(INPUT_SERVER, 'REMOTE_ADDR') . filter_input(INPUT_SERVER, 'HTTP_USER_AGENT'), PASSWORD_DEFAULT));

define('DEBUG', true );

require_once ABSPATH.'app/util/loader.php';