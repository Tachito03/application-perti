<?php
    class conexion{
        
        var $conn;

        function conexion(){
            //constructor
        }

        function conectarbd(){
            include ("config.php");

            $this->conn = mysqli_connect($server,$usuario,$password,$basededatos);
            if(!$this->conn){
                echo "Error en la conexion a la base de datos";
            }
        }

        function execute_query($conexion, $operacion){
           $cadena = mysqli_query($this->conn, $conexion); 

           if($operacion == 1){
               while($row = mysqli_fetch_array($cadena)){
                    $array_data[] = $row;
               }
           }else{
              $array_data[] = "";
           }

           $data = isset($array_data) ? $data:NULL;

           if($data){
               return $data;
           }
        }

        function closebd(){
            mysqli_close($this->conn);
        }
    }
?>