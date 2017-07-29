<?php
if (! defined('ABSPATH')){
    header("Location: /");
    exit();
}
?>
<div class="panel panel-default">
    <div class="panel-body">
        <form action="#" name="formLogin" id="formLogin" method="post">
            <div class="form-group">
                <label class="control-label" for="txtEmail">Email:</label>
                <input class="form-control" title="Informe o Email" type="email" required name="txtEmail" id="txtEmail" autofocus/>
                <div role="alert"></div>
            </div>
            <div class="form-group">
                <label class="control-label" for="txtSenha">Senha:</label>
                <input class="form-control" title="Informe a Senha" type="password" required name="txtSenha" id="txtSenha" />
                <div role="alert"></div>
            </div>
            <div class="form-group">
                <input type="checkbox" id="ckLogado" name="ckLogado" />
                <label class="control-label" for="ckLogado">Permanecer Logado</label>
                <input type="submit" class="btn btn-primary pull-right btn-lg" id="btnLogar" name="btnLogar" value="Logar" />
            </div>
        </form>
    </div>
</div>
