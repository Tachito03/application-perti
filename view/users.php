<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Test Perti</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3-col-12"></div>
                <div class="col-lg-6 col-md-6-col-12">
                    <div class="container-form">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-6 text-center"><p class="btn-options-selected sign-in">Iniciar sesion</p></div>
                            <div class="col-lg-6 col-md-6 col-6 text-center"><p class="btn-options sign-up">Regístrarme</p></div>
                        </div>
                        <form action="" id="loginuser" method="post">
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-1"></div>
                                <div class="col-lg-8 col-md-8 col-10 text-center">
                                    <img src="/view/assets/images/account.png" alt="" class="img-fluid">
                                </div>
                                <div class="col-lg-2 col-md-2 col-1"></div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <input type="email" name="usemail" id="usemail"  placeholder="Correo electrónico" class="form-control" required onkeyup="valida_email(this.value)" required>
                                    <span class="span-email span-error"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mtop20">
                                    <input type="password" name="uspassword" id="uspassword"  placeholder="Contraseña" class="form-control" required onkeyup="checkPassword(this.value)" required>
                                    <span class="span-password span-error"></span>
                                </div>
                            </div>
                            <div class="row mtop20">
                                <div class="col-lg-3 col-md-2 col-12"></div>
                                <div class="col-lg-6 col-md-8 col-12">
                                    <input type="submit" value="Entrar" class="submit-form">
                                </div>
                                <div class="col-lg-3 col-md-2 col-12"></div>
                            </div>
                            <div class="row mtop20">
                                <div class="col-12 text-center">
                                    <span class="register-msj log-error"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="footer"></div>
                            </div>
                        </form>

                        <form action="" id="registrouser" method="post">
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-1"></div>
                                <div class="col-lg-8 col-md-8 col-10 text-center">
                                    <img src="/view/assets/images/user.png" alt="" class="img-fluid" style="width: 100px;">
                                </div>
                                <div class="col-lg-2 col-md-2 col-1"></div>
                            </div>
                            <div class="row mtop20">
                                <div class="col-12">
                                    <input type="text" name="nombre" id="nombre"  placeholder="Nombre" class="form-control" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mtop20">
                                    <input type="tel" name="telefono" id="telefono" placeholder="Teléfono" class="form-control" maxlength="12" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mtop20">
                                    <input type="email" name="email" id="email" placeholder="Correo electrónico" class="form-control" onkeyup="valida_email(this.value)" required>
                                    <span class="span-email span-error"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12 mtop20">
                                    <input type="password" name="password" id="password" placeholder="Contraseña" class="form-control" onkeyup="checkPassword(this.value)" required>
                                    <span class="span-password span-error"></span>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 mtop20">
                                    <input type="password" name="confirmpass" id="confirmpass" placeholder="Confirmar contraseña" class="form-control" onkeyup="check_password()" required>
                                    <span class="span-pw span-error"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mtop20">
                                    <input type="text" name="rfc" id="rfc" placeholder="RFC" class="form-control rfc" onkeyup="check_rfc(this.value);" required>
                                    <span class="span-rfc span-error"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mtop20">
                                    <input type="text" name="notas" id="notas" placeholder="Notas" class="form-control" required>
                                </div>
                            </div>
                            <div class="row mtop20">
                                <div class="col-lg-3 col-md-2 col-12"></div>
                                <div class="col-lg-6 col-md-8 col-12">
                                    <input type="submit" value="Registrarme" class="submit-form">
                                </div>
                                <div class="col-lg-3 col-md-2 col-12"></div>
                            </div>
                            <div class="row mtop20">
                                <div class="col-12 text-center">
                                    <span class="register-msj success-re"></span>
                                    <span class="register-msj error-re"></span>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            <div class="col-lg-3 col-md-3-col-12"></div>
        </div>
    </div>
    <link rel="stylesheet" href="/view/assets/css/style.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="/view/script.js"></script>
</body>
</html>


