$(document).ready(function(){

    $lateral = 0;

   
    $('#lat').click(function(){
        
        if($lateral == 0){
            $('.fors').css("marginLeft","0");
            $lateral = 1;
        }
        else{
            $('.fors').css("marginLeft","-100%");
            $lateral = 0;
        }
    });

});