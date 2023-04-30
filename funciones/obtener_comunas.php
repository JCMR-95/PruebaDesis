<?php

include '../config.php';

// Se encarga de obtener las comunas correspondientes a la región seleccionada y devolverlos en formato JSON
function obtenerComunas(){

    $conexion = obtenerConexion();
    
    // Verifica si la conexión fue exitosa
    if (!$conexion) {
        die("Conexión fallida: " . mysqli_connect_error());
    }
    
    $id_region = $_POST["id_region"];

    // Consultar las comunas correspondientes a la región seleccionada
    $query = "SELECT id, nombre_comuna FROM comunas WHERE region_id = $id_region";
    $result = $conexion->query($query);

    // Crear un arreglo con los resultados
    $comunas = array();
    while ($row = $result->fetch_assoc()) {
        $comunas[] = array(
            "id" => $row["id"],
            "nombre_comuna" => $row["nombre_comuna"]
        );
    }

    // Devolver los resultados como JSON
    header("Content-Type: application/json");
    echo json_encode($comunas);
    
    mysqli_close($conexion);

}

obtenerComunas();

?>

