<?php

define("SUBDOMINIO", TRUE); // quando o site tem subdominio, obs: isso tbm serve para localhost que geramente os arquivos ficam em pasta a qual o acesso não é direto pela URL: EX:http://localhost/sistema_delivery/

if (SUBDOMINIO) {
    define("URI","projeto_mvc");
    define( 'ABSPATH', htmlspecialchars($_SERVER['DOCUMENT_ROOT']) . "/" . URI . "/");
} else {
    define( 'ABSPATH', htmlspecialchars($_SERVER['DOCUMENT_ROOT']) . "/");
}

define( 'PASTA_ADMIN', "admin");

define( 'URL', htmlspecialchars($_SERVER["REQUEST_SCHEME"]) . "://" . htmlspecialchars($_SERVER["SERVER_NAME"]) ."/". URI . "/");

define( 'PATH_VIEWS', ABSPATH ."public/views/");

define( 'PATH_IMG', ABSPATH ."public/img/");

define( 'URL_PUBLIC', URL ."public/");

define( 'URL_CSS', URL."public/css/");

define( 'URL_IMG', URL."public/img/");

define( 'URL_JS', URL."public/js/");

define('DB_HOST','localhost');

define('DB_NAME','projeto_mvc');

define('DB_USER','root');

define('DB_PASSWORD','');

define('DB_CHARSET', 'utf8' );

define('TOKEN_SESSAO', "seg_phpmvc_" . htmlspecialchars($_SERVER["REMOTE_ADDR"]) . htmlspecialchars($_SERVER["HTTP_USER_AGENT"]));

define('DEBUG', true );

require_once ABSPATH.'app/util/loader.php';