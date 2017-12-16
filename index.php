<?php
/**
 * Autoload do Composer
 */
require_once 'vendor'.DIRECTORY_SEPARATOR.'autoload.php';
/*
 *Seta alguns configuraÃ§Ãµes do site
 */
require_once 'app'.DIRECTORY_SEPARATOR.'util'.DIRECTORY_SEPARATOR.'config.php';
/*
 * Instancia a aplicaÃ§Ã£o
 */
$init = new \App\init();
