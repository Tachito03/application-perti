<?php 
  
   class Database{
      public static function Conectar(){
         //define('servidor', '127.0.0.1');
         //define('nombre_bd', 'perti-test');
         //define('usuario', 'root');
         //define('password', '');
 
         $data = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
 
         try{
             $cnn = new PDO('mysql:host=localhost;dbname=u509065391_ecommerce;charset=utf8', 'u509065391_baaeus', 'Baaeus032911_?');
        
             return $cnn;
         }catch(Exception $e){
             die('Error en la conexión: '. $e->getMessage());
         }
      }
   }
?>
