<?php 
    require_once "model/usersModels.php";

    class usersController{

        private $model;

        public function __CONSTRUCT(){
            $this->model = new usersModels();
        }

        public function Index(){
            require_once 'view/users.php';
        }

        public function Insertar(){
            $users = new usersModels();
            $status = "";
            $mensaje  = "";
            $uuid = "";
            $encryp_password  = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $users->nombre    = $_POST['nombre'];
            $users->telefono  = $_POST['telefono'];
            $users->email     = $_POST['email'];
            $users->password  = $encryp_password;
            $users->rfc       = $_POST['rfc'];  
            $users->notes     = $_POST['notas']; 
            $users->ipaddress =  $_SERVER["REMOTE_ADDR"];  
            
            if($this->valida_rfc($_POST['rfc'])){
                $uuid = $this->model->Registrar($users);
                $status = "OK";
                $mensaje = "Usuario registrado con éxito";
            }else{
                $status  = "NUll";
                $mensaje = "El RFC que ingreso en inválido"; 
            }
           
            $data = array('id' => $uuid, 'status' => $status, 'msj' => $mensaje );

            echo json_encode($data, true);
        }

        public function Update(){
            $users = new usersModels();
            $error_rfc = "";
            $code_rfc  = "";
            $status = "";
            $encryp_password  = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $users->id         = $_POST['id'];
            $users->nombre    = $_POST['nombre'];
            $users->telefono  = $_POST['telefono'];
            $users->password  = $encryp_password;
            $users->rfc       = $_POST['rfc'];  
 
            
            if($this->valida_rfc($_POST['rfc'])){
                $status = $this->model->Actualizar($users);
            }else{
                $error_rfc = "El RFC es inválido";
                $code_rfc  = "1";
            }
           
            $data = array('msg_rfc' => $error_rfc, 'code_rfc' => $code_rfc, 'status' => $status);

            echo json_encode($data, true);
        }

        public function check_user(){
            $users = new usersModels();
           // $password_encript = password_hash(base64_encode(hash('sha256', $_POST['password'], true)),PASSWORD_DEFAULT);
            $msj = "";
            $users->email     = $_POST['email'];
            $users->password  = $_POST['password'];
            
            $data_user = $this->model->login_user($users);
            $nombre_us = $data_user['name'];
            $email_us  = $data_user['email'];
            $mensaje   = $data_user['msj'];

            if($mensaje == "OK"){
                $this->crea_session($nombre_us, $email_us);
                $msj = "OK";
            }else if($mensaje === "Invalid"){
                $msj = "Usuario y/o contraseñas inválidas";
            }else{
                $msj = "Usuario no existe en la base de datos";
            }

            $data_user = array('status' => $msj);
            echo json_encode($data_user, true);
        }


        public function Dashboard(){

            if(empty($_SESSION['name_us'])){
                header("Location: ./");
            }else{
                require_once 'view/dashboard_user.php';
            }
            
        }

        public function Get_data(){
            
            try{
                $array_info = $this->model->Listar();
                echo json_encode($array_info);

            }catch(Exception $ex){
                die($e->getMessage());
            }
        }

        public function crea_session($usuario, $email){
            //session_start();
            $_SESSION['name_us']  = $usuario;
            $_SESSION['email_us'] = $email;
        }

        public function cerrar_session(){
            session_unset();
            session_destroy();
            //require_once 'view/users.php';
            header("Location: ./");
        }



         function valida_rfc($valor){
            $valor = str_replace("-", "", $valor); 
            $parte4 = substr($valor, 3, 1);
            
        //RFC sin homoclave
            if(strlen($valor)==10){
                $obtiene_letras = substr($valor, 0, 4); 
                $obtiene_numeros = substr($valor, 4, 6);
                if (ctype_alpha($obtiene_letras) && ctype_digit($obtiene_numeros)) { 
                    return true;
                }
                return false;            
            }
        // Sólo la homoclave
            else if (strlen($valor) == 3) {
                $homoclave = $valor;
                if(ctype_alnum($homoclave)){
                    return true;
                }
                return false;
            }
        //RFC Persona Moral.
            else if (ctype_digit($parte4) && strlen($valor) == 12) { 
                $obtiene_letras = substr($valor, 0, 3); 
                $obtiene_numeros = substr($valor, 3, 6); 
                $homoclave = substr($valor, 9, 3); 
                if (ctype_alpha($obtiene_letras) && ctype_digit($obtiene_numeros) && ctype_alnum($homoclave)) { 
                    return true; 
                } 
                return false;
            //RFC Persona Física. 
            } else if (ctype_alpha($parte4) && strlen($valor) == 13) { 
            $obtiene_letras = substr($valor, 0, 4); 
            $obtiene_numeros = substr($valor, 4, 6);
            $homoclave = substr($valor, 10, 3); 
            if (ctype_alpha($obtiene_letras) && ctype_digit($obtiene_numeros) && ctype_alnum($homoclave)) { 
                return true; 
            }
                return false; 
            }else { 
                return false; 
            }  
        }
    }


    
?>