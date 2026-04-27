<?php
session_start();
// Archivo db_connection.php que contiene la conexión a la base de datos
include('../db_connection.php');
    
$idUsuario = isset($_SESSION['ID_USUARIO']) ? $_SESSION['ID_USUARIO'] : 0;

    $accion = $_POST['accion'];

    switch ($accion) {
        case 1://GUARDAR PRODUCTO NUEVO
            $nombre_produc = $_POST['nombre_produc'];
            $tipo_produc = $_POST['tipo_produc'];
            $cod_barras = $_POST['cod_barras'];//juego 1-mtg, 2-poke, 3-yugi
            $precio_prod = $_POST['precio_prod'];
            $cantidad_prod = $_POST['cantidad_prod'];
            $descrip_prod = $_POST['descrip_prod'];

            // Escapar caracteres especiales para evitar la inyección de SQL
            $nombre_produc = $conn->real_escape_string($nombre_produc);
            $tipo_produc = $conn->real_escape_string($tipo_produc);
            $cod_barras = $conn->real_escape_string($cod_barras);
            $precio_prod = $conn->real_escape_string($precio_prod);
            $cantidad_prod = $conn->real_escape_string($cantidad_prod);
            $descrip_prod = $conn->real_escape_string($descrip_prod);

            // Construir la consulta SQL
            $consulta = "INSERT INTO mtg (NOM_CARTA, PRECIO, CANTIDAD, TEXTO_CARTA, ACT_USUARIO, ID_TCG,  TIPO_PRODUCTO) 
            VALUES ('$nombre_produc', $precio_prod, $cantidad_prod, '$descrip_prod', $idUsuario, $cod_barras,$tipo_produc)";
            //echo $consulta;exit();
            // Ejecutar la consulta SQL
            $resultado = $conn->query($consulta);

            // Verificar si la ejecución de la consulta fue exitosa
            if ($resultado === false) {
                die("Error al ejecutar la consulta: " . $conn->error);
            } else {
                echo "OK";
            }

            // Cerrar la conexión
            $conn->close();

            break;
        case 2://PARA MODIFICAR UN PRODUCTO

            break;
    }