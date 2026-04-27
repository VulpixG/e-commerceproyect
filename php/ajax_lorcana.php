<?php

session_start();
// Archivo db_connection.php que contiene la conexión a la base de datos
include('../db_connection.php');
    
$idUsuario = isset($_SESSION['ID_USUARIO']) ? $_SESSION['ID_USUARIO'] : 0;

    $accion = $_POST['accion'];

    switch ($accion) {
        case 1://Guardar una carta nueva
            $nombre_carta = $_POST['nombre_carta'];
            $expansion = $_POST['expansion'];
            $precio = $_POST['precio'];
            $cantidad = $_POST['cantidad'];
            $artista = $_POST['artista'];
            $foil = $_POST['foil'];
            $condicion = $_POST['condicion'];
            $idioma = $_POST['idioma'];
            $numero_carta = $_POST['numerocol'];
            $rareza = $_POST['rareza'];
            $texto_carta = $_POST['texto_carta'];

            $id_tcg = 4;

            // Escapar caracteres especiales para evitar la inyección de SQL
            $nombre_carta = $conn->real_escape_string($nombre_carta);
            $expansion = $conn->real_escape_string($expansion);
            $precio = $conn->real_escape_string($precio);
            $cantidad = $conn->real_escape_string($cantidad);
            $artista = $conn->real_escape_string($artista);
            $foil = $conn->real_escape_string($foil);
            $condicion = $conn->real_escape_string($condicion);
            $idioma = $conn->real_escape_string($idioma);
            $numero_carta = $conn->real_escape_string($numero_carta);
            $rareza = $conn->real_escape_string($rareza);
            $texto_carta = $conn->real_escape_string($texto_carta);

            // Construir la consulta SQL
            $consulta = "INSERT INTO mtg (NOM_CARTA, EXPANSION, PRECIO, CANTIDAD, ARTISTA, FOIL, ACT_USUARIO, ID_TCG, CONDICION, IDIOMA, NUM_CARTA, TIPO_PRODUCTO, RAREZA, TEXTO_CARTA) 
            VALUES ('$nombre_carta', '$expansion', $precio, $cantidad, '$artista', '$foil', $idUsuario, $id_tcg, '$condicion', '$idioma', $numero_carta,1, '$rareza', '$texto_carta')";

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
        case 2://buscar una carta para actualizarla
            $buscaCard = $_POST['buscaCard'];
            $andCo = "";
            if($idUsuario != 2){
                $andCo = " AND ACT_USUARIO =".$idUsuario;
            }
            // Consulta SQL para buscar coincidencias en la tabla 'mtg'
            $sql = "SELECT * FROM mtg WHERE id_tcg=4 and nom_carta LIKE '%" . $buscaCard . "%'".$andCo;
            $result = $conn->query($sql);
            // Mostrar las coincidencias encontradas
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div id="div_encontradas" onclick=carga_carta_encontradaL('.$row['ID_CARTA'].')>' . $row['NOM_CARTA'] . '</div>';
                }
            } else {
                echo "No se encontraron cartas.";
            }
            $conn->close();
            break;
        case 3://se usa esta parte para la busqueda de cartas mtg
            $id_Carta = $_POST['id_carta'];
            $sqlCartaEncontrada = "SELECT * FROM mtg WHERE ID_CARTA = ".$id_Carta;
            $resultado  = $conn->query($sqlCartaEncontrada);

            if ($resultado->num_rows > 0) {
                // Crear un array para almacenar los resultados
                $datos = array();
        
                // Iterar sobre los resultados y agregarlos al array
                while ($fila = $resultado->fetch_assoc()) {
                    $datos[] = $fila;
                }
        
                // Codificar los datos como JSON y enviarlos de vuelta
                echo json_encode($datos);
            } else {
                // Si no hay resultados, enviar un mensaje de error o un array vacío según tu preferencia
                echo json_encode(array('error' => 'No se encontraron resultados'));
            }
            $conn->close();
            break;
        case 4://para actualizar las cartas poke
            $id = $_POST['id_cart'];
            $nombre_carta = $_POST['nombre_carta'];
            $expansion = $_POST['expansion'];
            $precio = $_POST['precio'];
            $cantidad = $_POST['cantidad'];
            $artista = $_POST['artista'];
            $foil = $_POST['foil'];
            $condicion = $_POST['condicion'];
            $idioma = $_POST['idioma'];
            $rareza = $_POST['rareza'];
            $texto_carta = $_POST['texto'];

            // Escapar caracteres especiales para evitar la inyección de SQL
            $id = $conn->real_escape_string($id);
            $nombre_carta = $conn->real_escape_string($nombre_carta);
            $expansion = $conn->real_escape_string($expansion);
            $artista = $conn->real_escape_string($artista);
            $foil = $conn->real_escape_string($foil);
            $condicion = $conn->real_escape_string($condicion);
            $idioma = $conn->real_escape_string($idioma);
            $rareza = $conn->real_escape_string($rareza);
            $texto_carta = $conn->real_escape_string($texto_carta);

            // Construir y ejecutar la consulta SQL
            $sql = "UPDATE mtg SET rareza = '$rareza', texto_carta = '$texto_carta', nom_carta = '$nombre_carta', expansion = '$expansion', precio = $precio, cantidad = $cantidad, artista = '$artista', foil = '$foil', condicion = '$condicion', idioma = '$idioma' WHERE id_carta = $id";
            $resultado = $conn->query($sql);

            // Verificar si la ejecución de la consulta fue exitosa
            echo $resultado ? "OK" : "Error al actualizar los datos: " . $conn->error;

            // Cerrar la conexión
            $conn->close();

            break;
        case 5://consultar el inventario
            $id = isset($_POST['idUsuario']) ? $_POST['idUsuario'] : 0;
            $and= "";
            if($id != 0){
                $and = " AND ACT_USUARIO = ".$id;
            }
            $sqlInvMtg = "SELECT * FROM mtg where id_tcg = 4".$and;

            $resultadoInv = $conn->query($sqlInvMtg);
            $datos = array();
            while ($fila = $resultadoInv->fetch_assoc()) {
                $datos[] = $fila;
            }
            echo json_encode($datos);

            break;
        case 6://busca cartas en index
                $buscaCard = $_POST['buscaCard'];
                // Consulta SQL para buscar coincidencias en la tabla 'mtg'
                $sql = "SELECT DISTINCT NOM_CARTA FROM mtg WHERE nom_carta LIKE '%" . $buscaCard . "%'";
                $result = $conn->query($sql);
                // Mostrar las coincidencias encontradas
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div id="div_encontradas" onclick="carga_carta_encontrada(\''.$row['NOM_CARTA'].'\')">' . $row['NOM_CARTA'] . '</div>';
                    }
                } else {
                    echo "No se encontraron cartas.";
                }
                $conn->close();
                break;
        case 7: //Guarda una nueva expansión
            $expansion = $_POST['expansion'];
            $nombre_corto = $_POST['nom_corto'];
            $fecha_lanza = $_POST['fecha_lanzamiento'];
            $fecha_lanza_mysql = date('Y-m-d', strtotime(str_replace('/', '-', $fecha_lanza)));

            $sqlExpan = "INSERT INTO sets_lorcana (NOMBRE_SET, NOMBRE_CORTO, FECHA_LANZ) VALUES (?, ?, ?)";
            // Preparar la sentencia SQL
            $sentencia = $conn->prepare($sqlExpan);
            // Verificar si la preparación de la sentencia fue exitosa
            if ($sentencia === false) {
                die("Error al preparar la consulta: " . $conn->error);
            }
            // Vincular parámetros a la sentencia SQL
            $sentencia->bind_param("sss", $expansion, $nombre_corto, $fecha_lanza_mysql);
            // Ejecutar la sentencia SQL
            $resultado = $sentencia->execute();
            // Verificar si la ejecución de la sentencia fue exitosa
            if ($resultado === false) {
                die("Error al ejecutar la consulta: " . $sentencia->error);
            } else {
                echo "OK";
            }
            // Cerrar la conexión
            $conn->close();
            break;
        case 8: //busca una expansion para actualizarla
            $buscaCard = $_POST['buscaCard'];
            // Consulta SQL para buscar coincidencias en la tabla 'expansiones_mtg'
            $sql = "SELECT * FROM sets_lorcana WHERE nombre_set LIKE '%" . $buscaCard . "%'";
            $result = $conn->query($sql);
            // Mostrar las coincidencias encontradas
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $fecha_lanzamiento_formateada = date('Y/m/d', strtotime($row['FECHA_LANZ']));
                    echo '<div id="div_encontradas" onclick="carga_expan_encontradaL(' . $row['ID_SET'] . ', \'' . htmlspecialchars($row['NOMBRE_SET']) . '\', \'' . htmlspecialchars($row['NOMBRE_CORTO']) . '\', \'' . htmlspecialchars($fecha_lanzamiento_formateada) . '\')">' . $row['NOMBRE_SET'] . '</div>';
                }
            } else {
                echo "No se encontraron cartas.";
            }
            $conn->close();
            break;
        case 9://actualizar la expansion
            $idExpansion = $_POST["id_expan"];
            $nombre = $_POST["expansion"];
            $nom_corto = $_POST["nom_corto"];
            $fecha = $_POST["fecha_lanzamiento"];
            
            // Convertir la fecha al formato reconocido (DD/MM/YYYY -> YYYY-MM-DD)
            $fecha_converted = implode('-', array_reverse(explode('/', $fecha)));

            // Formatear la fecha
            $fecha_formateada = date('Y-m-d', strtotime($fecha_converted));

        // Preparar la consulta
        $updateExpan = "UPDATE sets_lorcana SET NOMBRE_SET = ?, NOMBRE_CORTO = ?, FECHA_LANZ = ? WHERE ID_SET = $idExpansion";

        $statement = $conn->prepare($updateExpan);

        if (!$statement) {
            die("Error al preparar la consulta: " . $conn->error);
        }

        // Vincular parámetros
        $statement->bind_param("sss", $nombre, $nom_corto, $fecha);

        // Ejecutar la consulta
        if ($statement->execute()) {
            echo "OK";
        } else {
            echo "Error al actualizar: " . $statement->error;
        }

        // Cerrar la declaración
        $statement->close();
            break;
        // Agregar más casos según sea necesario
        default:
            // Enviar una respuesta JSON al cliente indicando que la acción es desconocida o no válida
            echo json_encode(['success' => false, 'mensaje' => 'Acción desconocida']);
    }
