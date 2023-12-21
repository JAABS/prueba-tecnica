<?php

require_once "./api/v1/models/persona.model.php";

class PersonasController extends Persona{

    // Convertir el archivo personas.routes.php en el archivo index
    public function index(){
        include "./api/v1/routes/personas.routes.php";
    }

    // Controlador para las peticiones GET|POST|PUT|DELETE y con un pequeño manejador de errores
    // Mostrar todos los registros 
    public function mostrar_datos($tabla){
        if($tabla == "personas"){
            $datos = Persona::mostrar_datos_personas();

            header("Content-Type: application/json");
            echo json_encode($datos);
        }else{

            $json = array(
                "status"=> 400,
                "result"=> "Bad Request"
            );
            echo json_encode($json, http_response_code($json["status"]));
        }
        
    }
    // Mostrar un registro en especifico
    public function mostrar_un_dato($id){
            if(is_numeric($id)){
                
                $dato = array(Persona::mostrar_dato_persona($id));

                header("Content-Type: application/json");
                echo json_encode($dato);
            }else{
                $json = array(
                    "status"=> 400,
                    "result"=> "Bad Request"
                );
                echo json_encode($json, http_response_code($json["status"]));
            }
    }

    // Guardar registro
    // Se validan los datos para poder realizar la operacion
    public function guardar_registro($datos, $cabecera){
        if(is_string($datos->{"nombre"}) && is_numeric($datos->{"edad"}) && $cabecera == "application/json"){
            $registro = Persona::guardar_persona($datos);

            header("Content-Type: application/json");
            echo json_encode($json = array(
                "status"=> 201,
                "result"=> "Created",
                "data"=> $datos
            ), http_response_code($json["status"]));
            
        }else{
            $json = array(
                "status"=> 400,
                "result"=> "Bad Request"
            );
            echo json_encode($json, http_response_code($json["status"]));
        }
    }

    // Actualizar registro por medio de su (id)
    // Se validan los datos para poder realizar la operacion
    public function actualizar_registro($datos, $cabecera, $id){
        
        if(is_string($datos->{"nombre"}) && is_numeric($datos->{"edad"}) && $cabecera == "application/json" && is_numeric($id)){
            $registro = Persona::actualizar_registro_persona($datos, $id);

            header("Content-Type: application/json");
            echo json_encode($json = array(
                "status"=> 200,
                "result"=> "Update success",
                "data"=> $datos
            ), http_response_code($json["status"]));
        }else{
            $json = array(
                "status"=> 400,
                "result"=> "Bad Request"
            );
            echo json_encode($json, http_response_code($json["status"]));
        }
    }

    // Eliminar un registro por medio de su (id)
    public function eliminar_registro($id){
        if(is_numeric($id)){

            $registro = Persona::eliminar_registro_persona($id);

            header("Content-Type: application/json");
            echo json_encode($json = array(
                "status"=> 200,
                "result"=> "Success"
            ), http_response_code($json["status"]));
        }else{
            $json = array(
                "status"=> 400,
                "result"=> "Bad Request"
            );
            echo json_encode($json, http_response_code($json["status"]));
        }
    }
}


?>