<?php

include '../config.php';

// Se encarga de recibir los datos enviados por un formulario y guardarlos en una base de datos MySQL
function guardarDatosFormulario(){

    $conexion = obtenerConexion();
    
    // Verifica si la conexión fue exitosa
    if (!$conexion) {
        die("Conexión fallida: " . mysqli_connect_error());
    }
    
    // Obtiene los datos enviados por el formulario
    $nombre = $_POST['nombre'];
    $alias = $_POST['alias'];
    $rut = $_POST['rut'];
    $email = $_POST['email'];
    $region = $_POST['region'];
    $comuna = $_POST['comuna'];
    $candidato = $_POST['candidato'];
    $motivo = implode(",", $_POST['motivo']);


    // Se verifica si el rut ingresado ya existe en la tabla de votos de la base de datos
    $verificar_rut = "SELECT COUNT(*) AS total FROM votos WHERE rut_votante = '$rut'";
    $resultado = mysqli_query($conexion, $verificar_rut);
    $datos = mysqli_fetch_assoc($resultado);

    if ($datos['total'] > 0) {
        echo "El rut ya existe en la base de datos.";
    }else{

        // Se procede a insertar los datos del votante en la tabla de votos
        $insertar_voto = "INSERT INTO votos (nombre_votante, alias_votante, rut_votante, email_votante, region_id, comuna_id, candidato_id, motivo) 
        VALUES ('$nombre', '$alias', '$rut', '$email', '$region', '$comuna', '$candidato', '$motivo')";
        
        $ejecutar = mysqli_query($conexion, $insertar_voto);

        if (!$ejecutar) {
            die("Error al guardar voto: " . mysqli_connect_error());
        }

        mysqli_close($conexion);
        echo 'Voto guardado';
    }

}

guardarDatosFormulario();

?>

