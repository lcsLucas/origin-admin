$(document).ready(function() {

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
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            var dados = $(form).serialize();

            $.ajax({
                type: 'POST',
                url: $(form).prop("action"),
                data: dados,
                dataType: 'json',
                beforeSend: function(){
                    $(form).find("button").html("Aguarde...").append(
                        $("<i>").addClass("fas fa-spinner fa-spin ml-4")
                    ).prop("disabled", true)
                    $('#btnEnviarUsu').prop("disabled",true);
                }
            }).done(function (retorno) {

                const alert = $("#retorno-erro");

                alert.removeClass("alert-danger alert-success");

                if(retorno.status) {

                } else {
                    alert.addClass("alert-danger");
                    alert.html(retorno.mensagem);

                    $(form).find("button").html("ENTRAR").prop("disabled",false);
                }

            }).fail(function () {
                $(form).find("button").html("ENTRAR").prop("disabled",false);
            });

            return false;
        }
    });

});