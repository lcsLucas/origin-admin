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

            //$(previewId).parents('.file-preview').children('.fileinput-remove').css('opacity', '1');

        }).on('filecleared', function(event) {
            //$('.file-preview .fileinput-remove').css('opacity', 0);
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
                background: true,
                ready() {

                    modalFoto.find('#confirmaFoto').html('Confirmar <i class="fa fa-fw fa-check"></i>').prop('disabled', false).on('click', function () {

                        cropper.getCroppedCanvas().toBlob((blob) => {
                            var modal = document.getElementById('modalFoto');
                            const blobUrl = window.URL.createObjectURL(blob);
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
                            title: '<i class="fas fa-times-circle mr-2"></i> ' + retorno['msg'],
                            customClass: {
                                popup: 'btn-danger active mr-3',
                                title: 'text-white p-2 font-weight-normal align-items-center'
                            }
                        });
                    } else {
                        Toast.fire({
                            title: '<i class="fas fa-check-circle mr-2"></i> Status alterado com sucesso',
                            customClass: {
                                popup: 'btn-success active mr-3',
                                title: 'text-white p-2 font-weight-normal align-items-center'
                            }
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
                        title: '<i class="fas fa-times-circle mr-2"></i> Não foi possível alterar status',
                        customClass: {
                            popup: 'btn-danger active mr-3',
                            title: 'text-white p-2 font-weight-normal align-items-center'
                        }
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
                            title: '<i class="fas fa-times-circle mr-2"></i> ' + retorno['msg'],
                            customClass: {
                                popup: 'btn-danger active mr-3',
                                title: 'text-white p-2 font-weight-normal align-items-center'
                            }
                        });
                    } else {
                        Toast.fire({
                            title: '<i class="fas fa-check-circle mr-2"></i> Status alterado com sucesso',
                            customClass: {
                                popup: 'btn-success active mr-3',
                                title: 'text-white p-2 font-weight-normal align-items-center'
                            }
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
                        title: '<i class="fas fa-times-circle mr-2"></i> Não foi possível alterar status',
                        customClass: {
                            popup: 'btn-danger active mr-3',
                            title: 'text-white p-2 font-weight-normal align-items-center'
                        }
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
            html: 'Tem certeza que deseja excluir esse tipo? Seus usuários também seram deletados, informe sua <b class="text-danger">senha</b> e confirme<br><br><b class="d-block text-left">Sua senha</b>',
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
                form.submit();

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
            html: 'Tem certeza que deseja excluir esse usuário? Todas as suas referências com outros cadastros também seram deletadas, informe sua <b class="text-danger">senha</b> e confirme<br><br><b class="d-block text-left">Sua senha</b>',
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
                form.submit();

            }

        });

        return false;
    });

    $(".deletar").click(function () {
        var $this = $(this);

        Swal.fire({
            title: 'Atenção',
            type: 'warning',
            reverseButtons: true,
            html: 'você está preste a excluir um registro, caso confirme ele não estará mais disponível no sistema. Clique em "Confirmar" para continuar',
            showCancelButton: true,
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar',
        }).then((result) => {

            if (result.value) {
                var form = $this.parents("form");
                form.submit();

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
                timer: 3000
            });

            if (retorno["erro"]) {
                Toast.fire({
                    title: '<i class="fas fa-times-circle mr-2"></i> ' + retorno['msg'],
                    customClass: {
                        popup: 'btn-danger active mr-3',
                        title: 'text-white p-2 font-weight-normal align-items-center'
                    }
                });
            } else {
                Toast.fire({
                    title: '<i class="fas fa-check-circle mr-2"></i> Status alterado com sucesso',
                    customClass: {
                        popup: 'btn-success active mr-3',
                        title: 'text-white p-2 font-weight-normal align-items-center'
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
                title: '<i class="fas fa-times-circle mr-2"></i> Não foi possível alterar status',
                customClass: {
                    popup: 'btn-danger active mr-3',
                    title: 'text-white p-2 font-weight-normal align-items-center'
                }
            });

        }).always(function () {

            load.remove();
            pai.removeClass("d-none");

        });

        return false;
    });

    $(".alterar-ordem, .alterar-ordem-banner").click(function () {
        var $this = $(this);
        var parent_form = $this.parents('form');

        $.ajax({
            type: 'POST',
            url: parent_form.attr("action"),
            data: parent_form.serialize(),
            dataType: 'json',
            beforeSend: function () {

            }
        }).done(function (retorno) {

            if (!retorno.erro && Object.keys(retorno.registros).length) {

                var parent_tr = parent_form.parents('tr');

                if (retorno.registros.proximo) {
                    var sibling_tr = parent_tr.next();

                    if (sibling_tr.length) {
                        var clone_tr = parent_tr.clone(true);

                        parent_tr.remove();
                        clone_tr.insertAfter(sibling_tr);
                    } else {
                        var status = (retorno.registros.proximo.ativo === '1');
                        parent_tr.find('input[name="alterar-status"]').prop('checked', status);

                        parent_tr.find('.editar').prop('href', retorno.registros.proximo.url_editar);
                        parent_tr.find('input[name="codigo-acao"]').val(retorno.registros.proximo.id);

                        if ($this.hasClass('alterar-ordem')) {
                            parent_tr.children('td').first().html(retorno.registros.proximo.nome);
                        } else {
                            parent_tr.children('td').first().html(retorno.registros.proximo.titulo);
                            parent_tr.children('td').eq(1).children('img').prop('src', retorno.registros.proximo.img_mobile);
                        }
                    }
                } else {
                    var sibling_tr = parent_tr.prev();

                    if (sibling_tr.length) {
                        var clone_tr = parent_tr.clone(true);

                        parent_tr.remove();
                        clone_tr.insertBefore(sibling_tr);
                    } else {
                        var status = (retorno.registros.anterior.ativo === '1');
                        parent_tr.find('input[name="alterar-status"]').prop('checked', status);

                        parent_tr.find('.editar').prop('href', retorno.registros.anterior.url_editar);
                        parent_tr.find('input[name="codigo-acao"]').val(retorno.registros.anterior.id);

                        if ($this.hasClass('alterar-ordem')) {
                            parent_tr.children('td').first().html(retorno.registros.anterior.nome);
                        } else {
                            parent_tr.children('td').first().html(retorno.registros.anterior.titulo);
                            parent_tr.children('td').eq(1).children('img').prop('src', retorno.registros.anterior.img_mobile);
                        }
                    }
                }
            }

        }).fail(function () {
            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000
            });

            Toast.fire({
                title: '<i class="fas fa-times-circle mr-2"></i> Não foi possível alterar a ordem',
                customClass: {
                    popup: 'btn-danger active mr-3',
                    title: 'text-white p-2 font-weight-normal align-items-center'
                }
            });
        }).always(function () {

        });

        return false;
    });

    $('#controle-acesso').on('change', 'input[type="checkbox"]', function () {
        var $this = $(this);
        var icone = $this.siblings('i');
        var parent = $this.parent();
        var uncle = parent.siblings('ul');

        if ($this.prop('checked'))
            icone.removeClass('far fa-square text-danger').addClass('fas fa-check text-success');
        else
            icone.removeClass('fas fa-check text-success').addClass('far fa-square text-danger');

        if (uncle.length) {

            if ($this.prop('checked')) {
                uncle.find('input[type="checkbox"]').prop('checked', true);
                uncle.find('i').removeClass('far fa-square text-danger').addClass('fas fa-check text-success');

            } else {
                uncle.find('input[type="checkbox"]').prop('checked', false);
                uncle.find('i').removeClass('fas fa-check text-success').addClass('far fa-square text-danger');
            }

        } else {

            var parent_ul = $this.parents('ul');

            if (parent_ul.length) {
                var input_parent = parent_ul.siblings('label').children('input[type="checkbox"]');
                var icone_parent = input_parent.siblings('i');

                if ($this.prop('checked') && !input_parent.prop('checked')) {
                    input_parent.prop('checked', true);
                    icone_parent.removeClass('far fa-square text-danger').addClass('fas fa-check text-success');
                }

            }
        }

    });

    const input_file = $('.file-input-bootstrap');

    if (input_file.length) {
        const modalEditorFoto = $('#modalEditorFoto');
        var input_target = null;
        var container_cropimg = null;
        var id_container = null;

        input_file.each(function (i, obj) {

            var data_src = $(obj).data('preview');
            var image_preview = '<img class="d-block w-100 img-fluid" src="'+data_src+'" />';
            var required = $(obj).hasClass('required');

            $(obj).fileinput({
                overwriteInitial: true,
                autoOrientImage: false,
                maxFileSize: 2500,
                showCaption: false,
                showBrowse: false,
                showRemove: false,
                showUpload: false,
                browseOnZoneClick: true,
                required: required,
                msgErrorClass: 'alert alert-block alert-danger',
                cancelClass: 'text-danger',
                language: "pt-BR",
                theme: "fa",
                defaultPreviewContent: image_preview,
                allowedFileExtensions: ["jpg", "jpeg", "png"]
            }).on('fileloaded', function(event, file, previewId, index, reader) {
                const seletor = '#' + previewId;

                $(seletor).children('.kv-file-content').prepend(
                    $('<a href>')
                        .addClass('btn-crop-foto')
                        .html($('<i>').addClass('fas fa-fw fa-crop-alt'))
                        .data('id-container', previewId)
                        .data('target', $(obj).prop('name'))
                );
            });

        });

        $('body').on('click', '.btn-crop-foto', function () {
            var $this = $(this);
            id_container = $this.data('id-container');
            input_target = $this.data('target');
            container_cropimg = document.getElementById(id_container);
            var image_target = container_cropimg.querySelector('img');
            var image_clone = image_target.cloneNode();
            image_clone.classList= 'img-fluid';

            var target_image = $('#' + 'img-' + id_container);

            if (target_image.length) {
                image_clone.setAttribute('src', target_image.val());

            } else {
                var input_img_original = $('<input>').prop({
                    'type': 'hidden',
                    'value': image_target.getAttribute('src'),
                    'id': 'img-' + id_container
                });

                input_img_original.insertAfter(image_target);

            }

            var target_input = $('#' + 'dados-' + id_container);
            var obj_data = null;
            var flag_autoCrop = false;

            if (target_input.length) {
                obj_data = JSON.parse(target_input.val());

                if (obj_data.width && obj_data.height)
                    flag_autoCrop = true;
            }

            modalEditorFoto.children('#modal-body').html(image_clone);

            modalEditorFoto.find('a').removeClass('active');
            modalEditorFoto.find('.crop-cortar').addClass('active');

            cropper = new Cropper(image_clone, {
                viewMode: '1',
                autoCrop: flag_autoCrop,
                autoCropArea: '.9',
                background: false,
                responsive: true,
                zoomable: true,
                movable: true,
                scalable: true,
                data: obj_data
            });

            $('body').css('overflow', 'hidden');
            modalEditorFoto.fadeIn();

            return false;
        });

        modalEditorFoto.find('.btn-confirmar-crop').html('Confirmar <small><i class="fa fa-fw fa-check"></i></small>').prop('disabled', false).on('click', function () {

            cropper.getCroppedCanvas().toBlob((blob) => {
                //var modal = document.getElementById('modalFoto');
                const blobUrl = window.URL.createObjectURL(blob);
                var image = container_cropimg.querySelector('img');
                image.src = blobUrl;

                var target_input = $('#' + 'dados-' + id_container);

                if (target_input.length)
                    target_input.val(JSON.stringify(cropper.getData()));
                else {
                    var input_data = $('<input>')
                        .prop({
                            'id': 'dados-' + id_container,
                            'type': 'hidden',
                            'name': 'dados_' + input_target,
                            'value': JSON.stringify(cropper.getData())
                        });

                    input_data.insertAfter($(image));
                }

                cropper.destroy();
                delete cropper.toggleScaleH;
                delete cropper.toggleScaleV;
                modalEditorFoto.children('#modal-body').html('');
                modalEditorFoto.fadeOut();
                $('body').css('overflow', 'auto');
            });
        });

        modalEditorFoto.on('click', '.btn-close-crop', function () {
            cropper.destroy();
            delete cropper.toggleScaleH;
            delete cropper.toggleScaleV;
            modalEditorFoto.children('#modal-body').html('');
            modalEditorFoto.fadeOut();
            $('body').css('overflow', 'auto');
        });

        modalEditorFoto.on('click', '.crop-mover', function () {
            cropper.setDragMode('move');
            modalEditorFoto.find('a').removeClass('active');
            $(this).addClass('active');
            return false;
        });

        modalEditorFoto.on('click', '.crop-cortar', function () {
            cropper.setDragMode('crop');
            modalEditorFoto.find('a').removeClass('active');
            $(this).addClass('active');
            return false;
        });

        modalEditorFoto.on('click', '.crop-zoomup', function () {
            cropper.zoom(0.1);
            return false;
        });

        modalEditorFoto.on('click', '.crop-zoomdown', function () {
            cropper.zoom(-0.1);
            return false;
        });

        modalEditorFoto.on('click', '.crop-rotaesquerda', function () {
            cropper.rotate(-90);
            return false;
        });

        modalEditorFoto.on('click', '.crop-rotadireita', function () {
            cropper.rotate(90);
            return false;
        });

        modalEditorFoto.on('click', '.crop-iverter-h', function () {

            if(!cropper.toggleScaleH && !cropper.toggleScaleV) {
                cropper.toggleScaleH = 1;
                cropper.scale(-1, 1); // Flip horizontal
            } else if(cropper.toggleScaleH && !cropper.toggleScaleV) {
                cropper.toggleScaleH = 0;
                cropper.scale(1, 1); // Flip horizontal
            } else if(!cropper.toggleScaleH && cropper.toggleScaleV) {
                cropper.toggleScaleH = 1;
                cropper.scale(-1, -1); // Flip horizontal
            } else if (cropper.toggleScaleH && cropper.toggleScaleV) {
                cropper.toggleScaleH = 0;
                cropper.scale(1, -1); // Flip horizontal
            }

            return false;
        });

        modalEditorFoto.on('click', '.crop-iverter-v', function () {

            if(!cropper.toggleScaleH && !cropper.toggleScaleV) {
                cropper.toggleScaleV = 1;
                cropper.scale(1, -1); // Flip horizontal
            } else if(cropper.toggleScaleH && !cropper.toggleScaleV) {
                cropper.toggleScaleV = 1;
                cropper.scale(-1, -1); // Flip horizontal
            } else if(!cropper.toggleScaleH && cropper.toggleScaleV) {
                cropper.toggleScaleV = 0;
                cropper.scale(1, 1); // Flip horizontal
            } else if (cropper.toggleScaleH && cropper.toggleScaleV) {
                cropper.toggleScaleV = 0;
                cropper.scale(-1, 1); // Flip horizontal
            }

            return false;
        });

        modalEditorFoto.on('click', '.btn-confirmar-crop', function () {
            
        });

    }
    
    $('.toggle-menu').click(function () {
        var $this = $(this);
        $this.parent().siblings('ul').fadeToggle(function () {
            if ($(this).is(':visible')) {
                $this.children('i').removeClass('fa-plus').addClass('fa-minus text-danger');
            } else {
                $this.children('i').removeClass('fa-minus text-danger').addClass('fa-plus');
            }
        });

        return false;
    });

    var sortable_menu = $('#sortable-menu');

    if (sortable_menu.length) {
        var ul_sortable = sortable_menu.find('ul:has(li)');

        for (var i = 0; i < ul_sortable.length; i++) {
            new Sortable(ul_sortable[i], {
                animation: 150,
                fallbackOnBody: true,
                ghostClass: "bg-dark",  // Class name for the drop placeholder
                swapThreshold: 0.65,
                onEnd: function (event) {
                    var $this = this;
                    var parent = $(event.item).parent();

                    $.ajax({
                        type: 'POST',
                        url: URL + 'permissoes/ordernar-menus',
                        dataType: 'json',
                        data: parent.children('li').children('input[name="men_id[]"]'),
                        beforeSend: function () {
                            $this.option("disabled", true );
                            parent.children('li').children('div').children('span').children('i.fas').removeClass('fa-arrows-alt-v').addClass('fa-spinner fa-spin');
                        }
                    }).done(function (retorno) {

                        if (retorno) {
                            parent.children('li').prop('title', 'Operação realizada com sucesso');
                            parent.children('li').children('div').children('span').children('i.fas').removeClass('fa-spinner fa-spin text-muted fa-exclamation-circle text-danger').addClass('fa-check-circle text-success');
                        } else {
                            parent.children('li').prop('title', 'Não foi possível fazer a operação');
                            parent.children('li').children('div').children('span').children('i.fas').removeClass('fa-spinner fa-spin text-muted fa-check-circle text-success').addClass('fa-exclamation-circle text-danger');
                        }

                    }).fail(function () {
                        parent.children('li').prop('title', 'Não foi possível fazer a operação');
                        parent.children('li').children('div').children('span').children('i.fas').removeClass('fa-spinner fa-spin text-muted fa-check-circle text-success').addClass('fa-exclamation-circle text-danger');
                    }).always(function () {
                        $this.option("disabled", false );
                    });

                }
            });
        }
    }

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