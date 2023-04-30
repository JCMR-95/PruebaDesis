<?php

include '../config.php';

// Se encarga de obtener los datos de la tabla "candidatos" de la base de datos y devolverlos en formato JSON
function obtenerCandidatos(){

    $conexion = obtenerConexion();

    // Verifica si la conexión fue exitosa
    if (!$conexion) {
        die("Conexión fallida: " . mysqli_connect_error());
    }
    
    // Ejecutar una consulta para obtener los datos de la tabla "candidatos"
    $resultado = mysqli_query($conexion, "SELECT * FROM candidatos");

    // Crear un array vacío para almacenar los datos
    $candidatos = array();

    // Recorrer los resultados y agregarlos al array
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $candidatos[] = $fila;
    }

    echo json_encode($candidatos);
    
    mysqli_close($conexion);

}

obtenerCandidatos();

?>

