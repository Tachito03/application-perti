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
            $data  = "";

            $mensaje = "";
            $status  = "";
            $uuid    = "";

            $encryp_password  = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $users->nombre    = $_POST['nombre'];
            $users->telefono  = $_POST['telefono'];
            $users->email     = $_POST['email'];
            $users->password  = $encryp_password;
            $users->rfc       = $_POST['rfc'];  
            $users->notes     = $_POST['notas']; 
            $users->ipaddress =  $_SERVER["REMOTE_ADDR"];

            try{
                if(preg_match("/^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/", $_POST['password'])){
                    if(preg_match("/^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/", $_POST['email'])){
                        if(preg_match("/^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/",$_POST['rfc'])){
                            if(is_numeric($_POST['telefono']) && strlen($_POST['telefono']) == '10' || strlen($_POST['telefono']) == '12'){
                                $uuid = $this->model->Registrar($users);
                                $status = "OK";
                                $mensaje = "Usuario registrado con éxito";
                            }else{
                                $status = "Error";
                                $mensaje = "El número de teléfono es incorrecto";
                            } 
                        }else{
                            $status = "Error";
                            $mensaje = "El RFC que ingresó es inválido";
                        }
                    }else{
                        $status = "Error";
                        $mensaje = "El email es inválido";
                    }
                }else{
                    $status = "Error";
                    $mensaje = "La contraseña debe contener al menos 8 carácteres";
                }
            } catch(Exception $ex){
                die($ex->getMessage());
            }
            $data = array('uuid' => $uuid, 'status' => $status, 'mensaje'=> $mensaje);
            echo json_encode($data, true);
        }

        public function Update(){
            $users = new usersModels();
    
            $status  = "";
            $mensaje = "";
            $encryp_password  = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $users->id         = $_POST['id'];
            $users->nombre    = $_POST['nombre'];
            $users->telefono  = $_POST['telefono'];
            $users->password  = $encryp_password;
            $users->rfc       = $_POST['rfc'];  
            
            try{
                if(preg_match("/^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/", $_POST['password'])){
                    if(preg_match("/^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/",$_POST['rfc'])){
                        if(is_numeric($_POST['telefono']) && strlen($_POST['telefono']) == '10' || strlen($_POST['telefono']) == '12'){
                                $status  = $this->model->Actualizar($users);
                                $mensaje = "Usuario actualizado con éxito";
                        }else{
                                $status = "Error";
                                $mensaje = "El número de teléfono es incorrecto";
                        } 
                    }else{
                        $status = "Error";
                        $mensaje = "El RFC que ingresó es inválido";
                    }
                }else{
                    $status = "Error";
                    $mensaje = "La contraseña debe contener al menos 8 carácteres";
                }
            } catch(Exception $ex){
                die($ex->getMessage());
            }
           
            $data = array('status' => $status, 'mensaje'=> $mensaje);
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

    }    
?>