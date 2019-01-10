$(document).ready(function() {

    var functionSubmit = null;

    $("#avatar").fileinput({
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
        defaultPreviewContent: '<img src="http://plugins.krajee.com/uploads/default_avatar_male.jpg" alt="Seu avatar">',
        allowedFileExtensions: ["jpg", "jpeg", "gif", "png"]
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
        submitHandler: functionSubmit
        
    });

});