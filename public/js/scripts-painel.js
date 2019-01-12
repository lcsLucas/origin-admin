$(document).ready(function() {

    var functionSubmit = null;

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

    if($(".form-validate").length)
    $(".form-validate").validate({
        language: "pt-BR",
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

});

function exibiSenha(target) {
    const input_group = target.closest(".input-group");
    var input = input_group.querySelector("input[type=password],input[type=text]");
    
    if (input.getAttribute("type") === "password")
        input.setAttribute("type", "text");
    else
        input.setAttribute("type", "password");

    input.focus();

    return false;
}