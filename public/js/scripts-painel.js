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
    var cropper;
    const modalFoto = $('#modalFoto');
    var container_img;

    if (input_avatar.length) {

        var img_avatar = $('#img_avatar').val();

        if (!img_avatar)
            img_avatar = '<div id="preview-photo"><i class="fas fa-camera-retro"></i>Adicione uma foto de perfil</div>';
        else
            img_avatar = '<img src="'+ img_avatar +'" class="img-fluid" />';

        input_avatar.fileinput({
            overwriteInitial: true,
            autoOrientImage: false,
            maxFileSize: 1500,
            showCaption: false,
            showBrowse: false,
            showRemove: false,
            showUpload: false,
            browseOnZoneClick: true,
            elErrorContainer: "#erro-file-input",
            msgErrorClass: 'alert alert-block alert-danger',
            cancelClass: 'text-danger',
            language: "pt-BR",
            theme: "fa",
            defaultPreviewContent: img_avatar,
            allowedFileExtensions: ["jpg", "jpeg", "gif", "png"]
        }).on('fileloaded', function(event, file, previewId, index, reader) {
            container_img = document.getElementById(previewId);
            var image = container_img.querySelector('img').cloneNode();
            image.classList= 'img-fluid';
            var modal = document.getElementById('modalFoto');

            $(modal).find('#wrapper-img-crop').html(image);
            $(modal).modal('show');

            console.log(previewId);

            $(previewId).parents('.file-preview').children('.fileinput-remove').css('opacity', '1');

        }).on('filecleared', function(event) {
            $('.file-preview .fileinput-remove').css('opacity', 0);
        });

        modalFoto.on('shown.bs.modal', function (e) {
            $('body').css('overflow', 'hidden');
            var image = document.getElementById('modalFoto').querySelector('#wrapper-img-crop').querySelector('img');

            cropper = new Cropper(image, {
                viewMode: 1,
                dragMode: 'crop',
                aspectRatio: 1,
                autoCropArea: 1,
                responsive: true,
                zoomable: true,
                movable: true,
                scalable: true,
                background: false,
                ready() {

                    modalFoto.find('#confirmaFoto').html('Confirmar <i class="fa fa-fw fa-check"></i>').prop('disabled', false).on('click', function () {

                        cropper.getCroppedCanvas().toBlob((blob) => {
                            var modal = document.getElementById('modalFoto');
                            const blobUrl = URL.createObjectURL(blob);
                            var image = container_img.querySelector('img');
                            image.src = blobUrl;

                            var input_data = $('<input>')
                                .prop({
                                   'type': 'hidden',
                                   'name': 'dados_imagem',
                                   'value': JSON.stringify(cropper.getData())
                                });

                            input_data.insertAfter($(image));
                            $(modal).modal('hide');
                        });
                    });

                }
            });

        });

        modalFoto.on('hidden.bs.modal', function (e) {
            $('body').css('overflow', 'auto');
            console.log(cropper);
            cropper.destroy();
        });

        $('#cancelaFoto').click(function () {
            input_avatar.fileinput('clear');
            $('#modalFoto').modal('hide');
        });

    }

    if ($("#formAlterarSenha, #formUsuario").length) {

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

    $("#conteudo").find(".desativar-usuarios").click(function () {
        var $this = $(this);
        const status = $(this).prop("checked");
        var texto = "";

        if (!status)
            texto = "Você está preste a desativar um usuário, deseja realmente desativá-lo?";
        else
            texto = "Você está preste a ativar um usuário, deseja realmente ativá-lo?";

        Swal.fire({
            title: 'ATENÇÃO!',
            text: texto,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            reverseButtons: true,
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

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    if (retorno["erro"]) {
                        Toast.fire({
                            type: 'error',
                            title: retorno['msg']
                        });
                    } else {
                        Toast.fire({
                            type: 'success',
                            title: 'Status alterado com sucesso'
                        });
                    }

                }).fail(function () {

                    load.remove();
                    pai.removeClass("d-none");

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    Toast.fire({
                        type: 'error',
                        title: 'Não foi possível alterar status'
                    });

                });
            }

        });

        return false;

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
            reverseButtons: true,
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

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    if (retorno["erro"]) {
                        Toast.fire({
                            type: 'error',
                            title: retorno['msg']
                        });
                    } else {
                        Toast.fire({
                            type: 'success',
                            title: 'Status alterado com sucesso'
                        });
                    }

                }).fail(function () {

                    load.remove();
                    pai.removeClass("d-none");

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    Toast.fire({
                        type: 'error',
                        title: 'Não foi possível alterar status'
                    });

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
            reverseButtons: true,
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

    $(".deletar-usuario").click(function () {
        var $this = $(this);

        Swal.fire({
            title: 'Atenção',
            type: 'warning',
            strong: 'Informe sua senha',
            input: 'password',
            reverseButtons: true,
            html: 'Tem certeza que desaja excluir esse usuário? Todas as suas referências com outros cadastros também seram deletadas, informe sua <b class="text-danger">senha</b> e confirme<br><br><b class="d-block text-left">Sua senha</b>',
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

    $(".desativar").click(function () {
        var $this = $(this);
        const status = $(this).prop("checked");
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

            $this.prop("checked", retorno["status"]);

            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 600000
            });

            if (retorno["erro"]) {
                Toast.fire({
                    title: '<i class="fas fa-times-circle mr-2"></i> ' + retorno['msg'],
                    customClass: {
                        popup: 'btn-danger active mr-3',
                        title: 'text-white p-2 font-weight-normal'
                    }
                });
            } else {
                Toast.fire({
                    title: '<i class="fas fa-check-circle mr-2"></i> Status alterado com sucesso',
                    customClass: {
                        popup: 'btn-success active mr-3',
                        title: 'text-white p-2 font-weight-normal'
                    }
                });
            }

        }).fail(function () {

            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000
            });

            Toast.fire({
                type: 'error',
                title: 'Não foi possível alterar status',
            });

        }).always(function () {

            load.remove();
            pai.removeClass("d-none");

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