$(document).ready(function () {

    $lateral = 0;
    $contenido = 1;
    inici();

    setInterval(inici, 12000);
    function inici(){
        $tiempo = setTimeout(function(){
            better('#e2,#e3,#e4','#e1','#e1 .nav .c2','#e1 .nav .c1');
            tiempo = setTimeout(function(){
                better('#e1,#e2,#e4','#e3','#e3 .nav .c3','#e3 .nav .c1');
                tiempo = setTimeout(function(){
                    better('#e3,#e2,#e1','#e4','#e4 .nav .c4','#e4 .nav .c1');              
                    tiempo = setTimeout(function(){
                        better('#e4,#e3,#e1','#e2','#e4 .nav .c4','#e4 .nav .c1'); 
                        clearTimeout(tiempo);      
                    },4000);
                },4000);
            },4000);
        },4000);
    }
    function better(element1, element2,element3,element4, color1, color2){
        $(element1).css("display","none");
        $(element2).css("display","block");
        $(element3).css("color","black");
        $(element4).css("color","white");
    }

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
            url: 'login/login.php?auth=1',
            data: $('#formulario').serialize(),
            success: function (data) {
                $('main .cont .noti').fadeIn(2000);
                if (data == 'true') {
                    $('main .cont .noti').css('background', '#62E246');
                    $('main .cont .noti').html('Autenticación exitosa...');
                    setTimeout(function () {
                        $('#user').val("");
                        $('#pass').val("");
                        location.href = "gui/gui/dist/index.html";
                    }, 1500);
                } else if (data == 'false') {
                    $('main .cont .noti').css('background', 'red');
                    $('main .cont .noti').html('Intente de nuevo.');
                    setTimeout(function () {
                        $('#pass').val("");
                        $('main .cont .noti').fadeOut(1000);
                    }, 1500);
                } else {
                    alert(data);
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
  
    $('#formulario2').submit(function (e) {
        $.ajax({
            type: 'POST',
            url: '../login/email.php',
            data: $('#formulario2').serialize(),
            success: function (data) {
                $('#contacto .contenedor .padre .cont .alert').fadeIn(500);
                if (data == 'true') {
                    $('#contacto .contenedor .padre .cont .alert').css('background', '#62E246');
                    $('#contacto .contenedor .padre .cont .alert').html('¡El mensaje se ha ido a viajar a nuestro servidor! Gracias.');
                    setTimeout(function () {
                        $('#nombre').val("");
                        $('#correo').val("");
                        $('#mensaje').val("");
                        $('#contacto .contenedor .padre .cont .alert').css('display', 'none');

                    }, 6500);
                } else if (data == 'false') {
                    $('#contacto .contenedor .padre .cont .alert').css('background', 'red');
                    $('#contacto .contenedor .padre .cont .alert').html('Se ha encontrado un terrible error en el área 52 de nuestro código ¡Lo sentimos!');
                }
            },
            error: function (data) {
                $('#contacto .contenedor .padre .cont .alert').css('background', 'red');
                $('#contacto .contenedor .padre .cont .alert').html('¡Lo sentimos! Tus datos se han quedado en el limbo, reinicia la página e intenta de nuevo.');
                $('#contacto .contenedor .padre .cont .alert').css('display', 'block');
            }
        });
        e.preventDefault();
    });
});


