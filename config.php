<?php

function obtenerConexion(){

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "prueba_desis";

    // Crea una conexión a la base de datos
    $conexion = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conexion) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    return $conexion;
}

?>