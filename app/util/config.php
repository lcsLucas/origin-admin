<?php

define( 'ABSPATH', $_SERVER['DOCUMENT_ROOT']);

define( 'PATH_VIEWS', $_SERVER['DOCUMENT_ROOT']."/public/views/");

define( 'PATH_CSS', $_SERVER['DOCUMENT_ROOT']."/public/css/");

define( 'PATH_JS', $_SERVER['DOCUMENT_ROOT']."/public/js/");

define('DB_HOST','localhost');

define('DB_NAME','inclusao');

define('DB_USER','root');

define('DB_PASSWORD','');

define('DB_CHARSET', 'utf8' );

define('DEBUG', true );

require_once ABSPATH.'/app/util/loader.php';