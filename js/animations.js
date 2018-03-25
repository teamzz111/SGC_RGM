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
            type: 'POST',
            url: 'login/login.php',
            data: $('#formulario').serialize(),
            success: function (data) {
                $('main .cont .noti').fadeIn(1000);
                if (data == 'true') {
                    $('main .cont .noti').css('background', '#62E246');
                    $('main .cont .noti').html('Autenticación exitosa...');
                    setTimeout(function () {
                        $('#user').val("");
                        $('#pass').val("");

                    }, 1500);
                } else if (data == 'false') {
                    $('main .cont .noti').css('background', 'red');
                    $('main .cont .noti').html('Intente de nuevo.');
                    setTimeout(function () {
                        $('#pass').val("");
                        $('main .cont .noti').fadeOut(1000);
                    }, 1500);
                } else {
                    $('main .cont .noti').css('background', 'red');
                    $('main .cont .noti').html('La cuenta ' + $('#user').val() + ' no existe.');
                    setTimeout(function () {
                        $('#pass').val("");
                        $('main .cont .noti').fadeOut(1000);
                    }, 2200);
                }
            },
            error: function (data) {
                $('main .cont .noti').css('background', 'red');
                $('main .cont .noti').html('¡Lo sentimos! Tus datos se han quedado en el limbo, reinicia la página e intenta de nuevo.');
                $('main .cont .noti').css('display', 'block');
            }
        });
        e.preventDefault();
    });

});