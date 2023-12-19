
<?php
// Convertimos el archivo personas.routes.php en el archivo principal
require_once "api/v1/controller/personas.controller.php";

$index = new PersonasController();
$index->index();



?>