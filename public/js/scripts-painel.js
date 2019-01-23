window.onload = function() {
    window.onbeforeunload = function() {
        $(".loader-wrap").fadeIn();

    };

    $(".loader-wrap").fadeOut();
    $("body").css("overflow", "auto");

    var functionSubmit = null;
    var rulesForm = {};
    var rulesMessages = {};

    const input_avatar = $("#avatar");

    if (input_avatar.length) {

        var img_avatar = "http://plugins.krajee.com/uploads/default_avatar_male.jpg";

        if (input_avatar.data("avatar"))
            img_avatar = input_avatar.data("avatar");

        input_avatar.fileinput({
            overwriteInitial: true,
            maxFileSize: 1500,
            showCaption: false,
            showBrowse: false,
            showRemove: false,
            showUpload: false,
            browseOnZoneClick: true,
            elErrorContainer: "#erro-file-input",
            msgErrorClass: 'alert alert-block alert-danger',
            language: "pt-BR",
            theme: "fa",
            defaultPreviewContent: '<img src="'+ img_avatar +'" alt="Seu avatar">',
            allowedFileExtensions: ["jpg", "jpeg", "gif", "png"]
        });

    }

    if ($("#formAlterarSenha").length) {

        rulesForm = {
            senha_nova2: {
                equalTo: "#senha_nova"
            }
        };

        rulesMessages = {
            senha_nova2: {
                equalTo: "As senhas informadas não batem"
            }
        };

    }

    if($(".form-validate").length)
    $(".form-validate").validate({
        language: "pt-BR",
        rules: rulesForm,
        messages: rulesMessages,
        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'label',
        errorClass: 'error',
        errorPlacement: function (error, element) {

            if (element.parents(".input-group").length)
                error.insertAfter(element.parent());
            else if (element.parents(".form-group").length)
                element.parents(".form-group").append(error);
            else
                error.insertAfter(element);
        },
        submitHandler: functionSubmit
        
    });

    $(".form-validate").find(".form-control").focus(function(){
        $(this).parents(".input-group").addClass("focus");
    }).blur(function () {
        $(this).parents(".input-group").removeClass("focus");
    });

    $("#conteudo").find(".desativar-tipo-usuarios").click(function () {
        var $this = $(this);
        const status = $(this).prop("checked");
        var texto = "";

        if (!status)
            texto = "Você está preste a desativar um tipo de usuários, caso confirme todos os usuários que pertencem a esse tipo não teram mais acesso ao sistema, deseja desativar?";
        else
            texto = "Você está preste a ativar um tipo de usuários, caso confirme todos os usuários que pertencem a esse tipo teram acesso ao sistema, deseja mesmo ativar?";


        Swal.fire({
            title: 'ATENÇÃO!',
            text: texto,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: (status) ? 'SIM, ativar!' : 'SIM, desativar!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.value) {
                var pai = $this.parent();
                var load = $("<i>").addClass("fas fa-spinner fa-spin text-dark");
                var form = $this.parents("form");

                $.ajax({
                    type: 'POST',
                    url: form.attr("action"),
                    data: form.serialize(),
                    dataType: 'json',
                    beforeSend: function(){

                        pai.after(load);
                        pai.addClass("d-none");

                    }
                }).done(function (retorno) {

                    load.remove();
                    pai.removeClass("d-none");
                    $this.prop("checked", retorno["status"]);

                    if (retorno["erro"])
                        alert(retorno["msg"]);

                }).fail(function () {

                    load.remove();
                    pai.removeClass("d-none");

                });
            }

        });

        return false;
    });

    $(".deletar-tipo").click(function () {
        var $this = $(this);

        Swal.fire({
            title: 'Atenção',
            type: 'warning',
            label: 'Informe sua senha',
            input: 'password',
            html: 'Tem certeza que desaja excluir esse tipo? Seus usuários também seram deletados, informe sua <b class="text-danger">senha</b> e confirme<br><br><b class="d-block text-left">Sua senha</b>',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar',
            showLoaderOnConfirm: true,
            preConfirm: (senha) => {

                if (senha === "")
                    Swal.showValidationMessage(
                        `Informe sua senha`
                    )
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {

            if (result.value) {
                var form = $this.parents("form");
                form.append($("<input>").val(result.value).prop("name", "senha"));
                $this.parents("form").submit();

            }

        });

        return false;
    });

};

function exibiSenha(target) {
    const input_group = target.closest(".input-group");
    const input = input_group.querySelector("input[type=password],input[type=text]");
    const icone = target.querySelector("i");
    
    if (input.getAttribute("type") === "password") {
        input.setAttribute("type", "text");
        icone.classList.remove("fa-eye-slash");
        icone.classList.remove("text-muted");
        icone.classList.add("fa-eye");
    } else {
        input.setAttribute("type", "password");
        icone.classList.remove("fa-eye");
        icone.classList.add("fa-eye-slash");
        icone.classList.add("text-muted");
    }

    input.focus();

    return false;
}