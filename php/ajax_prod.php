<?php
session_start();

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
            $consulta = "INSERT INTO producto_sellado (NOMBRE_PRODUCTO, PRECIO, CANTIDAD, DESCRIPCION , ID_TCG ,TIPO_PRODUCTO ) 
            VALUES ('$nombre_produc', $precio_prod, $cantidad_prod, '$descrip_prod', $cod_barras,$tipo_produc)";
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
                $id = $_POST['id_cart'];
                $campo = $_POST['campo'];
                $valor = $_POST['valor'];

            if($campo == 'CANTIDAD'){
                $datita = "cantidad = $valor";
            }else{
                $datita = "precio = $valor";
            }

            // Escapar caracteres especiales para evitar la inyección de SQL
            $id = $conn->real_escape_string($id);

            // Construir y ejecutar la consulta SQL
            $sql = "UPDATE producto_sellado SET ".$datita." WHERE ID_PRODUCTO  = '$id'";
            $resultado = $conn->query($sql);

            // Verificar si la ejecución de la consulta fue exitosa
            echo $resultado ? "OK" : "Error al actualizar los datos: " . $conn->error;

            // Cerrar la conexión
            $conn->close();
            break;
        case 5://inventario de productos
                $consulta =  "SELECT
                    ID_PRODUCTO,
                    NOMBRE_PRODUCTO,
                    PRECIO,
                    CASE
                        ID_TCG WHEN 1 THEN 'MTG'
                        WHEN 2 THEN 'POKEMON'
                    END AS TCG,
                    CANTIDAD,
                    CASE
                        TIPO_PRODUCTO WHEN 2 THEN 'SELLADO'
                        WHEN 3 THEN 'MICAS'
                        WHEN 4 THEN 'DADOS'
                        WHEN 5 THEN 'JUEGO DE MESA'
                        WHEN 6 THEN 'CARPETAS'
                        WHEN 7 THEN 'DECKBOX'
                        WHEN 8 THEN 'PLAYMAT'
                    END AS PRODUCTO
                FROM
                    producto_sellado";
               
                $resultadoInv = $conn->query($consulta);
                $datos = array();
                while ($fila = $resultadoInv->fetch_assoc()) {
                    $datos[] = $fila;
                }
                echo json_encode($datos);

            break;
    }