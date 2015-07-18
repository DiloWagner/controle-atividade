$(document).ready( function() {
    var formChanged = false;

    $('form :input').change(function(){
        formChanged = true;
    });

    window.onbeforeunload = function (evt) {
        if(formChanged){
            var message = 'As alteraçõs ainda não foram salvas!';
            if (typeof evt == 'undefined') {
                evt = window.event;
            }
            if (evt) {
                evt.returnValue = message;
            }
            return message;
        }
    };

    //bootstrap tolltips
    $('.tool_tip').tooltip({
        placement: 'left',
    });

    $('#save').click(function() {
        formChanged = false;
        $('form[name="atividade"]').submit();
    });

    $('form[name="atividade"]').submit(function() {

    }).validate({
        ignore: '',
        // Define as regras
        rules:{
            titulo:{
                required: true,
                minlength: 2
            },
            descricao: {
                required: true
            }
        },
        // Define as mensagens de erro para cada regra
        messages:{
            titulo: {
                required: "O titulo deve ser preenchido!",
                minlength: "O titulo deve conter no mínimo 2 caracteres!"
            },
            descricao: {
                required: "A descrição deve ser preenchida!"
            }
        },
        highlight: function(element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
        },

        success: function(element) {
            element
                .text('OK!').addClass('valid')
                .closest('.control-group').removeClass('error').addClass('success');
        }

    });

});// document.read