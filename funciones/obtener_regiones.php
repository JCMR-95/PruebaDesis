<?php

include '../config.php';

// Se encarga de obtener los datos de la tabla "regiones" de la base de datos y devolverlos en formato JSON
function obtenerRegiones(){

    $conexion = obtenerConexion();
    
    // Verifica si la conexión fue exitosa
    if (!$conexion) {
        die("Conexión fallida: " . mysqli_connect_error());
    }
    
    // Ejecutar una consulta para obtener los datos de la tabla "regiones"
    $resultado = mysqli_query($conexion, "SELECT * FROM regiones");

    // Crear un array vacío para almacenar los datos
    $regiones = array();

    // Recorrer los resultados y agregarlos al array
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $regiones[] = $fila;
    }

    echo json_encode($regiones);
    
    mysqli_close($conexion);

}

obtenerRegiones();

?>

