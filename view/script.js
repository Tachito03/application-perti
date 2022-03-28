$(document).ready(function(){
    $("#registrouser").on('submit', function(e) {
         e.preventDefault();

         var nombre        = $("#nombre").val();
         var telefono      = $("#telefono").val();
         var email         = $("#email").val();
         var password      = $("#password").val();
         let rfc           = $("#rfc").val();
         var notas         = $("#notas").val();
         var param         = 'nombre=' + nombre + '&telefono=' + telefono + '&email=' +email + '&password='+ password + '&rfc='+rfc+'&notas='+notas;
         
         if(check_password()){
            if(check_rfc(rfc)){
                $.ajax({
                    type: "POST",
                    url: "?c=users&a=Insertar",
                    dataType: "json",
                    data: param,
                    success: function (data) {
                        console.log(data);
                        if(data.status == "OK"){
                            $('#registrouser')[0].reset();
                            $('.success-re').html(data.mensaje +' '+ '<strong><span><- Inicia sesión</span></strong>');
                            setTimeout(function() { 
                                $('.success-re').html('');
                            }, 8000);
                            $('.error-re').html();
                        }else{
                            
                            $('.error-re').html(data.mensaje);
                            setTimeout(function() { 
                                $('.error-re').html('');
                            }, 8000);
                            $('.success-re').html();
                        }
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
             }
         }
    });

    $("#update-user").on('submit', function(e) {
        e.preventDefault();
        var uuid          = $("#id").val();
        var nombre        = $("#nombre").val();
        var telefono      = $("#telefono").val();
        var password      = $("#password").val();
        let rfc           = $("#rfc").val();
        var param         = 'id='+ uuid + '&nombre=' + nombre + '&telefono=' + telefono +  '&password='+ password + '&rfc='+rfc;
        
        if(check_password()){
           if(check_rfc(rfc)){
               $.ajax({
                   type: "POST",
                   url: "?c=users&a=Update",
                   dataType: "json",
                   data: param,
                   success: function (data) {
                       if(data.status == "OK"){
                           $("#Modaleditar").modal('hide');
                           $('#update-user')[0].reset();
                           actualizar_tabla();
                           Swal.fire(
                            '¡Actualizado!',
                            'El registro se actualizó correctamente',
                            'success'
                            )
                       }else{
                           $('.update-user').html(data.mensaje);
                           setTimeout(function() { 
                            $('.update-user').html('');
                        }, 8000);
                       }
                   },
                   error: function (e) {
                   }
               });
            }
        }
   });

    $('.modal').on('hidden.bs.modal', function(){
        $('#update-user')[0].reset();
    });

    $("#loginuser").on('submit', function(e) {
        e.preventDefault();
        var email         = $("#usemail").val();
        var password      = $("#uspassword").val();
        
        var param         = 'email=' + email + '&password=' + password;
        $.ajax({
            type: "POST",
            url: "?c=users&a=check_user",
            dataType: "json",
            data: param,
                success: function (data) {
                    if(data.status == "OK"){
                        ruta = "?c=users&a=Dashboard";
                        window.location.href = ruta;

                    }else{
                        $('.log-error').html(data.status);
                        setTimeout(function() { 
                            $('.log-error').html('');
                        }, 5000);
                    }
                },
                error: function (e) {
                }
        });
    });

   $("#registrouser").hide();
   $('.sign-in').click(function(){
       $("#loginuser").show();
       $("#registrouser").hide();
       $('.sign-up').removeClass('btn-options-selected');
       $('.sign-up').addClass('btn-options');

       $('.sign-in').removeClass('btn-options');
       $('.sign-in').addClass('btn-options-selected');
   });

   $('.sign-up').click(function(){
       $("#registrouser").show();
       $("#loginuser").hide();
       $('.sign-in').removeClass('btn-options-selected');
       $('.sign-in').addClass('btn-options');

       $('.sign-up').removeClass('btn-options');
       $('.sign-up').addClass('btn-options-selected');
   })


   $("#telefono").keydown(function(event){
        if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105) && event.keyCode !==190  && event.keyCode !==110 && event.keyCode !==8 && event.keyCode !==9  ){
            return false;
        }
    });

   
})

function check_rfc(cadena_rfc) {
    //var get_rfc;
    //get_rfc = cadena_rfc;	
    if(cadena_rfc.length == 12){
        //para personas morales
        var carac_rfc = '^(([A-Z]|[a-z]){3})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))';
    }else{
        //para personas fisicas
        var carac_rfc = '^(([A-Z]|[a-z]|\s){1})(([A-Z]|[a-z]){3})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))';
    }

    var validar_rfc = new RegExp(carac_rfc);
    var matchArray  = cadena_rfc.match(validar_rfc);
    if (matchArray == null) {
        $('.span-rfc').text("El RFC que ingresó es incorrecto");
        return false;
    }
    else{
        $('.span-rfc').text("");
        return true;
    }
    
}

function check_password(){
    var password      = $("#password").val();
    var confirm_passw = $("#confirmpass").val();

    if(password != confirm_passw){
        $('.span-pw').text("Las contraseñas no coinciden, vuelve a intentar!");
        return false;
    }else{
        $('.span-pw').text("");
        return true;
    }
}

function checkPassword(password){
    var caracteres = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
    //return re.test(password);
    var valida_pass = new RegExp(caracteres);
    var matchArray  = password.match(valida_pass);
    if (matchArray == null) {
        $('.span-password').text("Debe tener al menos 8 caracteres, mayúsculas, minúsculas, numeros, caracteres especiales");
        return false;
    }
    else{
        $('.span-password').text("");
        return true;
    }

    if(password == ""){
        $('.span-password').text("");
    }
}

function valida_email(string_email){
    caracteres = /^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
	if(!caracteres.exec(string_email)){
        $('.span-email').text("El email no es válido");
        return false;
	}else{
        $('.span-email').text("");
        return true;
    }

    if(string_email == ""){
        $('.span-email').text("");
    }
}
