<?php
if (! defined('ABSPATH')){
    header("Location: /");
    exit();
}
?>
            <footer class="container" id="rodape">

            </footer>
        </div>

        <?php include_once PATH_VIEWS.'shared/carrega_scripts.php'; ?>
        <?= $this->renderJs(); //renderiza o js incorporado da pagina?>
    </body>
</html>