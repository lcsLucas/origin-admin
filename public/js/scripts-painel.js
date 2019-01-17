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