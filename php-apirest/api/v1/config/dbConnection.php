
<?php

// Conectar a la base de datos

class Connection{
    public $conn;
    

    public function get_connection(){
        try{
            $this->conn = new PDO("pgsql:host=localhost;port=5432;dbname=personas;user=postgres;password=programa85");
            //echo "conexion realizada";
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}


?>