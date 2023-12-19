<?php

$rutas_array = explode("/", $_SERVER["REQUEST_URI"]);
$rutas_array = array_filter($rutas_array);
//$id = explode("?", $rutas_array[4]);
//$id = array_filter($id)[1];

// Cuando no se hace una peticion en la api manda un 404
if(count($rutas_array) == 1){
    $json = array(
        "status"=> 404,
        "result"=> "Not found"
    );
    echo json_encode($json, http_response_code($json["status"]));
    return;
}

require_once "./api/v1/controller/personas.controller.php";

// Cuando se hace una peticion ala api
if(count($rutas_array) == 4 && isset($_SERVER["REQUEST_METHOD"])){

     // Peticion GET al endpoint php-apirest/api/v1/personas?id={id}
     if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])){
        
        $id = $_GET["id"];
        $registro = new PersonasController();
        $registro->mostrar_un_dato($id);
       
       return;
    }
    
    // Peticion GET al endpoint php-apirest/api/v1/personas
   if($_SERVER["REQUEST_METHOD"] == "GET"){
       $obtener_registros = new PersonasController();
       
       $obtener_registros->mostrar_datos($rutas_array[4]);
      
       return;
    }
   

    // Peticion POST al endpoint php-apirest/api/v1/personas
    if($_SERVER["REQUEST_METHOD"] == "POST"){ 
        $registro = new PersonasController();
        $registro->guardar_registro([$_POST["nombre"], $_POST["edad"]]);
        return;
    }

    // Peticion PUT al endpoint php-apirest/api/v1/personas?id={id}
    if($_SERVER["REQUEST_METHOD"] == "PUT"){
        $datos = array();
        parse_str(file_get_contents("php://input"), $datos);
        
        $registro = new PersonasController();
        $registro->actualizar_registro([$datos["nombre"], intval($datos["edad"])],$_GET["id"]);
        return;
    }

    // Peticion DELETE al endpoint php-apirest/api/v1/personas?id={id}
    if($_SERVER["REQUEST_METHOD"] == "DELETE"){
       $registro = new PersonasController();
       $registro->eliminar_registro($_GET["id"]);
        return;
    }
}


?>