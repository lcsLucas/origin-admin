<?php

define( 'ABSPATH', $_SERVER['DOCUMENT_ROOT']);

define( 'PATH_VIEWS', $_SERVER['DOCUMENT_ROOT']."/Public/Views/");

define( 'PATH_CSS', $_SERVER['DOCUMENT_ROOT']."/Public/css/");

define( 'PATH_JS', $_SERVER['DOCUMENT_ROOT']."/Public/js/");

define( 'PATH_IMG', $_SERVER['DOCUMENT_ROOT']."/Public/img/");

define('DB_HOST','');

define('DB_NAME','');

define('DB_USER','');

define('DB_PASSWORD','');

define('DB_CHARSET', 'utf8' );

define('DEBUG', true );

require_once ABSPATH.'/App/Util/loader.php';