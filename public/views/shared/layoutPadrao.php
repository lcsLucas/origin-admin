<?php
if (! defined('ABSPATH')){
    header("Location: /");
    exit();
}

include_once PATH_VIEWS.'shared/cabecalho.php';

$this->content();

include_once PATH_VIEWS.'shared/rodape.php';

?>