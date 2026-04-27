<?php

session_start();

include('../db_connection.php');
    
$idUsuario = isset($_SESSION['ID_USUARIO']) ? $_SESSION['ID_USUARIO'] : 0;
$nombreUsuario = $_SESSION['NOMBRE_USUARIO'];

$data = json_decode(file_get_contents("php://input"), true);

            // Aquí puedes procesar los datos como desees
            // Por ejemplo, puedes iterar sobre los datos y guardarlos en una base de datos
            foreach ($data as $fila) {
                $cantidad = $fila['cantidad'];
                $carta = $fila['carta'];
                $expansion = $fila['expansion'];
                $num_coleccion = $fila['num_coleccion'];
                
                // Aquí podrías insertar estos datos en tu base de datos
                // Ejemplo:
                // $query = "INSERT INTO tu_tabla (cantidad, carta, expansion, num_coleccion) VALUES ('$cantidad', '$carta', '$expansion', '$num_coleccion')";
                // mysqli_query($conexion, $query);
            }

            // Responder al cliente
            echo json_encode(array("success" => true));