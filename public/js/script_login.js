window.onload = function() {

    window.onbeforeunload = function() {
        $(".loader-wrap").fadeIn();

    };

    $(".loader-wrap").fadeOut();
    $("body").css("overflow", "auto");

    $("#wrapper-login").find(".wrapper-float input").focus(function(){
        $(this).parents(".wrapper-float").addClass("focus");
    }).blur(function () {
        $(this).parents(".wrapper-float").removeClass("focus");
    });

    $("#wrapper-login").find(".wrapper-float input")[0].focus();


    $(".form-validate").validate({
        language: "pt-BR",
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'label',
        errorClass: 'error',
        errorPlacement: function(error, element) {
            if(element.parents('.form-group').length) {
                element.parents('.form-group').append(error);
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            $(form).find("button").html("Aguarde...").append(
                $("<i>").addClass("fas fa-spinner fa-spin ml-4")
            ).prop("disabled", true)
            $('#btnEnviarUsu').prop("disabled",true);

            grecaptcha.execute(RECAPTCHA_SITE_KEY, {action: 'login_sistema'}).then(function(token) {
                document.getElementById('recaptcha-response').value = token;
                var dados = $(form).serialize();
                fazer_login(form, dados);
            });

            return false;
        }
    });

};

function fazer_login(form, dados) {
    $.ajax({
        type: 'POST',
        url: $(form).prop("action"),
        data: dados,
        dataType: 'json',
    }).done(function (retorno) {
        const alert = $("#retorno-erro");
        alert.removeClass("alert-danger alert-success");

        if(retorno.status) {
            const extra = JSON.parse(retorno.extra);
            location.href = extra.url_direcionar;
        } else {
            var wrapper_desafio = $('#wrapper-desafio');
            wrapper_desafio.html('');

            if (retorno.extra) {
                var extra = JSON.parse(retorno.extra);

                if (extra.desafio) {

                    wrapper_desafio.append(
                        '<label for="">Por favor, responda ao desafio abaixo:</label>\n' +
                        '                    <img src="'+ extra.img_desafio +'" alt="" class="img-fluid d-block w-100">\n' +
                        '                    <span class="d-block my-3 text-center">=</span>\n' +
                        '                    <input type="number" min="0" max="10" class="form-control" required title="O desafio precisa ser respondido" name="resposta_desafio">'
                    ).removeClass('d-none');
                }

            }

            alert.addClass("alert-danger");
            alert.html(retorno.mensagem);
            $(form).find("button").html("ENTRAR").prop("disabled",false);
        }

    }).fail(function () {
        $(form).find("button").html("ENTRAR").prop("disabled",false);
    });
}