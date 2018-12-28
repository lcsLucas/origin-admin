$(document).ready(function() {

    $("#avatar").fileinput({
        overwriteInitial: true,
        maxFileSize: 1500,
        showCaption: false,
        showBrowse: false,
        showRemove: false,
        showUpload: false,
        browseOnZoneClick: true,
        language: "pt-BR",
        theme: "fa",
        defaultPreviewContent: '<img src="http://plugins.krajee.com/uploads/default_avatar_male.jpg" alt="Seu avatar">',
        allowedFileExtensions: ["jpeg", "jpg", "png"]
    });

});