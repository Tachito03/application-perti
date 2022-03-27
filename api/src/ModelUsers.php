<?php 

namespace src;

use Database;
use Respuesta;
//require '/model/database.php';
//require './respuesta.php';

class ModelUsers{

    private $pdo;
    private $respuesta;

    public function __CONSTRUCT(){
        try{
            $this->pdo = Database::Conectar();
            $this->respuesta = new Respuesta();
        }catch(Exception $ex){
            die($ex-getMessage());
        }
    }

    public function Obtiene_users(){
        try{
            $data_user = array();

            $resultado = $this->db->prepare("SELECT * FROM tblusers");
            $resultado->execute();
            
            $this->respuesta->setResponse(true);
            $this->respuesta->data_user = $resultado->fetchAll();
            
            return $this->respuesta;
        }
        catch(Exception $e)
        {
            $this->respuesta->setResponse(false, $e->getMessage());
            return $this->respuesta;
        }
    }

}

?>