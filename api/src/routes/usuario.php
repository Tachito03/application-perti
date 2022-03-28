<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//$config = ['settings' => ['displayErrorDetails' => true]]; 
$app = new \Slim\App();

//GET obtenemos los registros
$app->get('/v1/user', function(Request $request, Response $response){
    $sql = "SELECT id, nameus as name, phone,email,rfc,notes,ipaddress,date_created FROM tblusers";
    $data_user = "";
    
    try{
        $pdo = new Database();
        $pdo = $pdo->Conectar();
        $resultado = $pdo->prepare($sql);
        $resultado->execute();
            if($resultado->rowCount() > 0){
                $data_user = $resultado->fetchAll(PDO::FETCH_OBJ);
            }else{
                $data_user = "Aún no existen datos de usuarios";
            }
        }
        catch(Exception $ex){
            $data_user = $ex->getMessage();
        }

    echo json_encode($data_user,JSON_UNESCAPED_UNICODE);

});

//PUT crear un nuevo usuario
$app->put('/v1/user/add', function(Request $request, Response $response){
    
    //variables que obtenemos por POST
    $nameus          = $request->getParam('name');
    $phone           = $request->getParam('phone'); 
    $email           = $request->getParam('email'); 
    $passwordus      = $request->getParam('password'); 
    $rfc             = $request->getParam('rfc');
    $notes           = $request->getParam('notes');
    $ipaddress       = $_SERVER["REMOTE_ADDR"];
    $mensaje         = "";
    $uuid            = "";
    $cadena = "INSERT INTO tblusers(nameus,phone,email,passwordus,rfc,notes,ipaddress) 
                VALUES(:nameus,:phone,:email,:passwordus,:rfc,:notes,:ipaddress)";
    
    try{
        $pdo = new Database();
        $pdo = $pdo->Conectar();
        $resultado = $pdo->prepare($cadena);
        
        if(preg_match("/^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/", $passwordus)){
            if(preg_match("/^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/", $email)){
                if(preg_match("/^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/", $rfc)){
                    if(is_numeric($phone) && strlen($phone) == '10' || strlen($phone) == '12'){
                        $password_encry = password_hash($passwordus, PASSWORD_DEFAULT);
                        $resultado->bindParam(':nameus', $nameus);
                        $resultado->bindParam(':phone', $phone);
                        $resultado->bindParam(':email', $email);
                        $resultado->bindParam(':passwordus', $password_encry);
                        $resultado->bindParam(':rfc', $rfc);
                        $resultado->bindParam(':notes', $notes);
                        $resultado->bindParam(':ipaddress', $ipaddress);

                        if($resultado->execute()){
                            $uuid = $pdo->lastInsertId();
                            $mensaje = array('uuid' => $uuid, 'status' => 'OK', 'mensaje'=>'Usuario agregado correctamente');
                        }else{
                            $mensaje = array('status' => 'Error', 'mensaje' => 'Error en la estructura del Json');
                        }
                        
                    }else{
                        $mensaje = array('status' => 'Error', 'mensaje' => 'El número de teléfono es incorrecto');
                    }
                    
                }else{
                    $mensaje = array('status' => 'Error', 'mensaje' => 'El RFC que ingresó es inválido');
                }
            }else{
                $mensaje = array('status' => 'Error', 'mensaje' => 'El email es inválido');
            }
        }else{
            $mensaje = array('status' => 'Error', 'mensaje' => 'La contraseña debe contener al menos 8 carácteres');
        }
 
        }
        catch(Exception $ex){
            $mensaje = $ex->getMessage();
        }

    echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);

});


$app->post('/v1/user/update/{id}', function(Request $request, Response $response){
    
    //variables que obtenemos por POST
    $uuid            = $request->getAttribute('id');
    $nameus          = $request->getParam('name');
    $phone           = $request->getParam('phone'); 
    $email           = $request->getParam('email'); 
    $passwordus      = $request->getParam('password'); 
    $rfc             = $request->getParam('rfc');
    $notes           = $request->getParam('notes');
    $ipaddress       = $_SERVER["REMOTE_ADDR"];
    $mensaje         = "";
    $cadena = "UPDATE tblusers SET nameus = :nameus, phone = :phone,email=:email,passwordus=:passwordus,
                                   rfc=:rfc,notes=:notes,ipaddress=:ipaddress
                                   WHERE id = $uuid";
    
    try{
        $pdo = new Database();
        $pdo = $pdo->Conectar();
        $resultado = $pdo->prepare($cadena);
        
        if(preg_match("/^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/", $passwordus)){
            if(preg_match("/^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/", $email)){
                if(preg_match("/^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/", $rfc)){
                    if(is_numeric($phone) && strlen($phone) == '10' || strlen($phone) == '12'){
                        $password_encry = password_hash($passwordus, PASSWORD_DEFAULT);
                        $resultado->bindParam(':nameus', $nameus);
                        $resultado->bindParam(':phone', $phone);
                        $resultado->bindParam(':email', $email);
                        $resultado->bindParam(':passwordus', $password_encry);
                        $resultado->bindParam(':rfc', $rfc);
                        $resultado->bindParam(':notes', $notes);
                        $resultado->bindParam(':ipaddress', $ipaddress);
                        $resultado->execute();
                        if($resultado->rowCount()){
                            
                            $mensaje = array('status' => 'OK', 'mensaje'=> 'Usuario actualizado');
                        }else{
                            $mensaje = array('status' => 'Error', 'mensaje' => 'Error en la estructura del Json');
                        }
                        
                    }else{
                        $mensaje = array('status' => 'Error', 'mensaje' => 'El número de teléfono es incorrecto');
                    }
                    
                }else{
                    $mensaje = array('status' => 'Error', 'mensaje' => 'El RFC que ingresó es inválido');
                }
            }else{
                $mensaje = array('status' => 'Error', 'mensaje' => 'El email es inválido');
            }
        }else{
            $mensaje = array('status' => 'Error', 'mensaje' => 'La contraseña debe contener al menos 8 carácteres');
        }
 
        }
        catch(Exception $ex){
            $mensaje = $ex->getMessage();
        }

    echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);

});

?>