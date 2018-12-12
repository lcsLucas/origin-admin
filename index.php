<?php
/**
 * Autoload do Composer
 */
require_once 'vendor'.DIRECTORY_SEPARATOR.'autoload.php';
/*
 * configurações do sistema
 */
require_once 'app'.DIRECTORY_SEPARATOR.'util'.DIRECTORY_SEPARATOR.'config.php';
/*
 * Instancia a a aplicação
 */
$init = new \App\init();
