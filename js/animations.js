$(document).ready(function () {

    $lateral = 0;


    $('#lat').click(function () {

        if ($lateral == 0) {
            $('.fors').css("marginLeft", "0");
            $lateral = 1;
        } else {
            $('.fors').css("marginLeft", "-100%");
            $lateral = 0;
        }
    });

    $('#formulario').submit(function (e) {
        $.ajax({
            type: "POST",
            url: "login/login.php",
            data: $('#formulario').serialize(),
            success: function (data) {
                if (data != 'false') {
                    $('main .cont .noti').css('background', '#62E246', 'display', 'none');
                    $('main .cont .noti').html('Autenticación exitosa...');

                }
            }
        });
    });

});