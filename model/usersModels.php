<?php 
    class usersModels{

        private $pdo;
        public $id;
        public $nombre;
        public $telefono;
        public $email;
        public $password;
        public $rfc;
        public $notes;
        public $ipaddress;
        
        //constructor
        public function __CONSTRUCT(){
            try{
                $this->pdo = Database::Conectar();
            }catch(Exception $ex){
                die($ex-getMessage());
            }
        }

        public function Registrar(usersModels $data){
            $uuid = "";
            try{
                $sql = "INSERT INTO tblusers(nameus,phone,email,passwordus,rfc,notes,ipaddress) VALUES(?,?,?,?,?,?,?)";
                $this->pdo->prepare($sql)->execute(
                    array($data->nombre,
                          $data->telefono, 
                          $data->email,
                          $data->password,
                          $data->rfc,
                          $data->notes,
                          $data->ipaddress)
                );

                $uuid = $this->pdo->lastInsertId();
            }catch(Exception $ex){
                die($ex->getMessage());
            }
            return $uuid;
        }

        public function Actualizar(usersModels $data){
            $msj = "";
            try{
                $sql = "UPDATE tblusers SET nameus = ?, phone = ?, passwordus = ?, rfc = ? WHERE id = ?";
                $cadena = $this->pdo->prepare($sql);
                $cadena->execute(
                        array($data->nombre,
                            $data->telefono, 
                            $data->password,
                            $data->rfc,
                            $data->id)
                        );

                if($cadena->rowCount()){
                   $msj = "OK";
                }else{
                    $msj = "Error";
                }
                
            }catch(Exception $ex){
                die($ex->getMessage());
            }
            return $msj;
        }

        public function login_user(usersModels $data){
           $data_user = [];
           // $row = "";
           $mensaje = "";
            try{
                $sql = "SELECT nameus,email,passwordus FROM tblusers WHERE email = ?";
                $result = $this->pdo->prepare($sql);
			    $result->execute(array($data->email));
                $row = $result->fetch(PDO::FETCH_ASSOC);
                $num = $result->rowCount();
               
                  if($num === 1){ 
                       //$password_bd = $row['passwordus'];
                     
                    if(password_verify($data->password,$row["passwordus"])){
                        $mensaje = "OK";            
                        $data_user = array('name' => $row['nameus'], 'email' => $row['email'], 'msj'=>$mensaje);
                    }else{
                        $mensaje = "Invalid";
                        $data_user = array('name' => null, 'email' => null, 'msj'=>$mensaje);
                    }
                        
                  }else{
                      $mensaje = "Not found";
                      $data_user = array('name' => null, 'email' => null, 'msj'=>$mensaje);
                  }

                  return $data_user;
			   
            }catch(Exception $ex){
                die($ex->getMessage());
            }
        }

        public function Listar(){
            try
            {
                //$data_info = array();
                $sql = $this->pdo->prepare("SELECT * FROM tblusers");
                $sql->execute();

                while($info = $sql->fetchAll(PDO::FETCH_ASSOC)){
                    $data_info['data'] = $info;
                }
    
                return $data_info;
            }
            catch(Exception $e)
            {
                die($e->getMessage());
            }
        }
     
    }
?>