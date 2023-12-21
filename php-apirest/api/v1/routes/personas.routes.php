<?php
// convierte en un arreglo las rutas de la url
$rutas_array = explode("/", $_SERVER["REQUEST_URI"]);
$rutas_array = array_filter($rutas_array);

require_once "./api/v1/controller/personas.controller.php";

// Cuando se hace una peticion ala api si la ruta final de la url es: /personas

if(count($rutas_array) == 4 && isset($_SERVER["REQUEST_METHOD"])){

     // Peticion GET al endpoint php-apirest/api/v1/personas?id={id}
     // verifica si se hace una peticion GET y comprueba si hay una variable llamada id en la url
     if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])){
        
        $registro = new PersonasController();
        $registro->mostrar_un_dato($_GET["id"]);
       
       return;
    }
    
    // Peticion GET al endpoint php-apirest/api/v1/personas
   if($_SERVER["REQUEST_METHOD"] == "GET"){
       $obtener_registros = new PersonasController();
       $obtener_registros->mostrar_datos($rutas_array[4]);
      
       return;
    }
   
    // Peticion POST al endpoint php-apirest/api/v1/personas
    // Se obtiene el body json y se deserializa y la cabecera Content-Type 
    // y se manda para validar
    if($_SERVER["REQUEST_METHOD"] == "POST"){ 
        $json = file_get_contents("php://input");
        $datos = json_decode($json);
        $cabecera = getallheaders();
        $registro = new PersonasController();
        $registro->guardar_registro($datos, $cabecera["Content-Type"]);
        return;
    }

    // Peticion PUT al endpoint php-apirest/api/v1/personas?id={id}
    // Se obtiene el id de la url, el body en json para deserializarlo y la cabecera Content-Type
    // y se manda para validar
    if($_SERVER["REQUEST_METHOD"] == "PUT"){
        $json = file_get_contents("php://input");
        $datos = json_decode($json);
        $cabecera = getallheaders();
        $registro = new PersonasController();
        $registro->actualizar_registro($datos, $cabecera["Content-Type"], $_GET["id"]);
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