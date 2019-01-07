$(document).ready(function() {

    $("#avatar").fileinput({
        overwriteInitial: true,
        maxFileSize: 1500,
        showCaption: false,
        showBrowse: false,
        showRemove: false,
        showUpload: false,
        browseOnZoneClick: true,
        elErrorContainer: "#container-errors",
        msgErrorClass: 'alert alert-block alert-danger',
        language: "pt-BR",
        theme: "fa",
        defaultPreviewContent: '<img src="http://plugins.krajee.com/uploads/default_avatar_male.jpg" alt="Seu avatar">',
        allowedFileExtensions: ["jpeg", "gif", "png", "svg"]
    });

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
        submitHandler: function (form) {
            var dados = $(form).serialize();
            const input_form = $(form).find("input:enabled");

            $.ajax({
                type: 'POST',
                url: $(form).prop("action"),
                data: dados,
                dataType: 'json',
                beforeSend: function () {

                    input_form.prop("disabled", true);

                    $(form)
                        .find(".btn[type=submit]")
                        .html("Aguarde...")
                        .append($("<i>").addClass("fas fa-spinner fa-spin ml-4"))
                        .prop("disabled", true);
                }
            }).done(function (retorno) {

                $(form)
                    .find(".btn[type=submit]")
                    .html("Confirmar ")
                    .append($("<i>").addClass("fa fa-check"))
                    .prop("disabled", false);

                input_form.prop("disabled", false);

            }).fail(function () {

                $(form)
                    .find(".btn[type=submit]")
                    .html("Confirmar ")
                    .append($("<i>").addClass("fa fa-check"))
                    .prop("disabled", false);

                input_form.prop("disabled", false);
                
            });
            
        }
        
    });

});