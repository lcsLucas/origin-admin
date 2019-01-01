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

});