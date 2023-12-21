
<?php

require_once "./api/v1/config/dbConnection.php";

class Persona extends Connection{

    // Mostrar todas las personas de la base de datos de la tabla personas
    public function mostrar_datos_personas(){
        try{
            $sql = "SELECT * FROM personas";
            $statememt = Connection::get_connection()->prepare($sql);
            $statememt->execute();
            $result = $statememt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }catch(PDOExecption $error){
            echo $error->getMessage();
        }
    }

    // Mostrar una persona por medio de su identificador unico (id) de la tabla personas
    public function mostrar_dato_persona($id){
        try{
            
            $sql = "SELECT * FROM personas WHERE persona_id = :id";
            $statememt = Connection::get_connection()->prepare($sql);
            $statememt->bindParam(":id", $id, PDO::PARAM_INT);
            $statememt->execute();
            $result = $statememt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOExecption $error){
            echo $error->getMessage();
        }
    }

    // Guardar los datos de una persona en la tabla personas
    public function guardar_persona($datos){
        try{
            $sql = "INSERT INTO personas (nombre, edad) VALUES(:nombre, :edad)";
            $statememt = Connection::get_connection()->prepare($sql);
            $statememt->bindParam(":nombre", $datos->{"nombre"}, PDO::PARAM_STR);
            $statememt->bindParam(":edad", $datos->{"edad"}, PDO::PARAM_INT);
            $statememt->execute();
            return true;
        }catch(PDOException $error){
            echo $error->getMessage();
        }
    }

    // Actualizar los datos de una persona en la tabla personas
    public function actualizar_registro_persona($datos, $id){
        try{
            $sql = "UPDATE personas SET nombre = :nombre, edad = :edad WHERE persona_id = :id";
            $statememt = Connection::get_connection()->prepare($sql);
            $statememt->bindParam(":nombre", $datos->{"nombre"}, PDO::PARAM_STR);
            $statememt->bindParam(":edad", $datos->{"edad"}, PDO::PARAM_INT);
            $statememt->bindParam(":id", $id, PDO::PARAM_INT);
            $statememt->execute();
            return true;
        }catch(PDOExeception $error){
            echo $error->getMessage();
        }
    }

    // Eliminar los datos de una persona en la tabla personas por medio de su (id)
    public function eliminar_registro_persona($id){
        try{
            $sql = "DELETE FROM personas WHERE persona_id = :id";
            $statememt = Connection::get_connection()->prepare($sql);
            $statememt->bindParam(":id", $id, PDO::PARAM_INT);
            $statememt->execute();
            return true;
        }catch(PDOExeception $error){
            echo $error->getMessage();
        }
    }

}


?>