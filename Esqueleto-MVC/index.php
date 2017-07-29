<?php
/**
 * Autoload do Composer
 */
require_once 'vendor/autoload.php';
/*
 *Seta alguns configurações do site
 */
require_once 'App/Util/config.php';
/*
 * Instancia a aplicação
 */
$init = new \App\Init();
