<?php
if (!defined('ABSPATH'))
    die;
?>

</main>
<footer class="c-footer">
    <div class="mx-auto">&copy; <?= date('Y') ?> <a target="_blank" rel="nofollow norefer" href="https://origin.com.br">Origin</a>. Todos os direitos resevados.</div>
</footer>
</div>
</div>

<link rel="stylesheet" href="<?= URL_PUBLIC ?>vendors/font-awesome/css/all.min.css">
<!-- CoreUI and necessary plugins-->
<script src="<?= URL_PUBLIC ?>vendors/jquery/dist/jquery.min.js"></script>
<script src="<?= URL_PUBLIC ?>vendors/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>

<?php

if (!empty($this->dados->input_drop)) {
?>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/plugins/purify.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/fileinput.min.js"></script>
    <!-- optionally if you need a theme like font awesome theme you can include it as mentioned below -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/themes/fa/theme.js"></script>
    <!-- optionally if you need translation for your language then include  locale file as mentioned below -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/locales/pt-BR.js"></script>

<?php
}

?>

<?php

if (!empty($this->dados->validation)) {
?>

    <script src="<?= URL_PUBLIC ?>vendors/jquery-validate/jquery.validate.min.js"></script>
    <script src="<?= URL_PUBLIC ?>vendors/jquery-validate/localization/messages_pt_PT.js"></script>

<?php
}

?>

<?php

if (!empty($this->dados->alert)) {
?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<?php
}

?>

<?php

if (!empty($this->dados->cropjs)) {
?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.1/cropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.1/cropper.min.js"></script>
<?php
}

?>

<?php

if (!empty($this->dados->sortablejs)) {
?>
    <script src="<?= URL_PUBLIC ?>vendors/sortablejs/Sortable.min.js"></script>
<?php
}
?>

<script>
    const url_images = '<?= URL_IMG ?>';
    const URL = '<?= URL ?>';
</script>

<script src="<?= URL_JS ?>script-painel<?= !LOCALHOST ? '.min' : '' ?>.js<?= VERSAO ? '?versao=' . VERSAO : '' ?>"></script>
<script src="<?= URL_PUBLIC ?>js/scripts-painel<?= !LOCALHOST ? '.min' : '' ?>.js<?= VERSAO ? '?versao=' . VERSAO : '' ?>"></script>
</body>

</html>