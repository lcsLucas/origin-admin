<?php
/**
 * Autoload do Composer
 */
require_once 'backend/vendor/autoload.php';
/*
 * configurações do sistema
 */
require_once 'backend/app/util/config.php';
/*
 * Instancia a a aplicação
 */
$init = new \App\init();
