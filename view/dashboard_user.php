<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Users</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    
    <style>
        body{
            background: none!important;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="menu-horizontal">
            <div class="row padding-menu">
                <div class="col-lg-7 col-md-7 col-12"></div>
                <div class="col-lg-5 col-md-5 col-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-6">
                            <h4 class="user-log"><strong>Bienvenido: </strong></h4>
                        </div>
                        <div class="col-lg-8 col-md-6 col-6">
                            <h5 class="user-log">
                                <?php echo $_SESSION['name_us'] ?> 
                            </h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6"><p class="user-log"><strong>Email:</strong> <?php echo $_SESSION['email_us'] ?></p></div>
                        <div class="col-lg-6 text-right"><p class="user-log"><a href="?c=users&a=cerrar_session" style="color: #fff; text-decoration: none;">Salir</a></p></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mtoptable">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
            <table id="user_data" class="table  table-striped  table-hover table-responsive" style="width: 100%;">
                    <thead>
                        <tr>
                            <th width="10%">Nombre</th>
                            <th width="35%">Teléfono</th>
                            <th width="35%">Email</th>
                            <th width="10%">RFC</th>
                            <th width="10%">Notas</th>
                            <th width="10%">Dirección</th>
                            <th width="10%" class="not-export-column">Opciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="col-lg-1"></div>
        </div>
    </div>
    <!-- Modal para editar -->
    <!-- Modal -->
    <div class="modal fade" id="Modaleditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header" style="background: #0069d9; ">
            <h5 class="modal-title" id="exampleModalLongTitle">Actualizar datos</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="" id="update-user" method="post">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-12">
                        <label><strong>Nombre:</strong></label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-12">
                        <input type="text" id="nombre" class="form-control" placeholder="Nombre" required>
                        <input type="hidden" id="id" class="form-control">
                    </div>
                </div>
                <div class="row mtop20">
                    <div class="col-lg-3 col-md-3 col-12">
                        <label><strong>Teléfono:</strong></label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-12">
                        <input type="tel" id="telefono" class="form-control" placeholder="Teléfono" maxlength="12" required>
                    </div>
                </div>
                <div class="row mtop20">
                    <div class="col-lg-3 col-md-3 col-12">
                        <label><strong>Nueva contraseña:</strong></label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-12">
                        <input type="password" id="password" class="form-control" placeholder="Nueva contraseña" onkeyup="checkPassword(this.value)" required>
                        <span class="span-password span-error"></span>
                    </div>
                </div>
                <div class="row mtop20">
                    <div class="col-lg-3 col-md-3 col-12">
                        <label><strong>Confirmar Contraseña:</strong></label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-12">
                        <input type="password" id="confirmpass" class="form-control" placeholder="Confirmar contraseña" onkeyup="check_password()">
                        <span class="span-pw span-error"></span>
                    </div>
                </div>
                <div class="row mtop20">
                    <div class="col-lg-3 col-md-3 col-12">
                        <label><strong>RFC:</strong></label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-12">
                        <input type="text" id="rfc" class=" rfc form-control" placeholder="Ingrese el RFC" onkeyup="check_rfc(this.value)"; required>
                        <span class="span-rfc span-error"></span>
                    </div>
                </div>
                <div class="row mtop20">
                    <div class="col-lg-7 col-md-7 col-12">  
                    </div>
                    <div class="col-lg-5 col-md-5 col-12">
                        <input type="submit" class="submit-form" value="Actualizar">
                    </div>
                </div>
                <div class="row mtop20">
                    <div class="col-12 text-center">
                        <span class="update-user error-re"></span>
                    </div>
                </div>
                
            </form>
        </div>
        </div>
    </div>
    </div>
    <link rel="stylesheet" href="/view/assets/css/style.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js" integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script src="/view/script.js"></script>
    <script>
        $(document).ready(function(){
            actualizar_tabla();
        });

        var actualizar_tabla = function(){
            var tabla_usuario = $('#user_data').DataTable({
                "ajax":{
                    "method": "POST",
                    "url": "?c=users&a=Get_data"
                },
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                },
                {       
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                }],
                paging: true,
                pageLength: 50,
                searching: true,
                "order": [[ 3, "desc" ]],
                "columns":[
                    {"data":"nameus"},
                    {"data":"phone"},
                    {"data":"email"},
                    {"data":"rfc"},
                    {"data":"notes"},
                    {"data":"ipaddress"},
                    {"defaultContent":"<button type='button' class='editar-user btn btn-primary' data-toggle='modal' data-target='#Modaleditar'>Editar</button>"}
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                stateSave: true,
                "bDestroy": true,
                'iDisplayLength': 50,
                fixedHeader: true,
                responsive: true,
            }); 

            obtener_informacion_user("#user_data tbody", tabla_usuario);
        }

        let obtener_informacion_user = function(tbody, tabla_usuario){
            $(tbody).on("click", "button.editar-user", function (){
                var data = tabla_usuario.row($(this).parents("tr")).data();
                $('#id').val(data.id);
                $('#nombre').val(data.nameus);
                $('#telefono').val(data.phone);
                $('#rfc').val(data.rfc);
            });
        }
    </script>
</body>
</html>


