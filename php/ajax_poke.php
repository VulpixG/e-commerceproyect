<?php

session_start();
// Archivo db_connection.php que contiene la conexión a la base de datos
include('../db_connection.php');
    
$idUsuario = isset($_SESSION['ID_USUARIO']) ? $_SESSION['ID_USUARIO'] : 0;
$tipo_usuario = $_SESSION['TIPO_USUARIO'];

    $accion = $_POST['accion'];

    switch ($accion) {
        case 1://Guardar una carta nueva
            $nombre_carta = $_POST['nombre_carta'];
            $expansion = $_POST['expansion'];
            $precio = $_POST['precio'];
            $cantidad = $_POST['cantidad'];
            $foil = $_POST['foil'];
            $condicion = $_POST['condicion'];
            $idioma = $_POST['idioma'];
            $numero_carta = $_POST['numerocol'];

            $id_tcg = 2;

            // Escapar caracteres especiales para evitar la inyección de SQL
            $nombre_carta = $conn->real_escape_string($nombre_carta);
            $expansion = $conn->real_escape_string($expansion);
            $precio = $conn->real_escape_string($precio);
            $cantidad = $conn->real_escape_string($cantidad);
            $foil = $conn->real_escape_string($foil);
            $condicion = $conn->real_escape_string($condicion);
            $idioma = $conn->real_escape_string($idioma);
            $numero_carta = $conn->real_escape_string($numero_carta);

            $busca_carta= "SELECT ID_CARTA FROM mtg WHERE EXPANSION = '".$expansion."' AND NOM_CARTA LIKE '%".$nombre_carta."%' AND NUM_CARTA= ".$numero_carta;
            
            $resultadoCarta = $conn->query($busca_carta);
            if ($resultadoCarta && $resultadoCarta->num_rows > 0) {
                $fila = $resultadoCarta->fetch_assoc(); // Extrae la primera fila
                $cartita = $fila['ID_CARTA']; // Ahora sí puedes acceder al campo
            }

            $consulta = "INSERT INTO inventario_usuario (FK_ID_USUARIO, FK_ID_CARTA, PRECIO, CONDICION, FOIL, CANTIDAD, IDIOMA) 
            VALUES ($idUsuario, '".$cartita."', $precio,'$condicion', '$foil', $cantidad, '$idioma')";

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
            if($tipo_usuario == 5){
                $and = " AND ACT_USUARIO = ".$idUsuario;
            }
            // Consulta SQL para buscar coincidencias en la tabla 'mtg'
            $sql = "select m.NOM_CARTA,m.ID_CARTA,i.FOIL,i.IDIOMA, i.CONDICION from inventario_usuario i left join mtg m on i.FK_ID_CARTA = m.ID_CARTA where i.fk_id_usuario = $idUsuario and m.id_tcg = 2 and m.NOM_CARTA LIKE '%" . $buscaCard . "%'";
            $result = $conn->query($sql);
            // Mostrar las coincidencias encontradas
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div id="div_encontradas" onclick=carga_carta_encontradaP(\'' . $row['ID_CARTA'] . '\')>' . $row['NOM_CARTA'].'-'.$row['CONDICION'].'-'.$row['FOIL'] . '</div>';
                }
            } else {
                echo "No se encontraron cartas.";
            }
            $conn->close();
            break;
        case 3://se usa esta parte para la busqueda de cartas mtg
            $id_Carta = $_POST['id_carta'];
            $sqlCartaEncontrada = "SELECT i.FK_ID_CARTA AS ID_CARTA,i.PRECIO, i.CANTIDAD, i.IDIOMA, i.CONDICION, m.NOM_CARTA,i.FOIL FROM inventario_usuario i left join mtg m on i.FK_ID_CARTA = m.ID_CARTA WHERE i.FK_ID_USUARIO = $idUsuario AND i.FK_ID_CARTA = '".$id_Carta."'";
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
            $precio = $_POST['precio'];
            $cantidad = $_POST['cantidad'];
            $foil = $_POST['foil'];
            $condicion = $_POST['condicion'];
            $idioma = $_POST['idioma'];

            // Escapar caracteres especiales para evitar la inyección de SQL
            $id = $conn->real_escape_string($id);
            $nombre_carta = $conn->real_escape_string($nombre_carta);
            $foil = $conn->real_escape_string($foil);
            $condicion = $conn->real_escape_string($condicion);
            $idioma = $conn->real_escape_string($idioma);

            // Construir y ejecutar la consulta SQL
            $sql = "UPDATE inventario_usuario SET precio = $precio, cantidad = $cantidad, condicion = '$condicion', idioma = '$idioma' WHERE FK_ID_CARTA = '$id' AND FK_ID_USUARIO = $idUsuario";
            $resultado = $conn->query($sql);

            // Verificar si la ejecución de la consulta fue exitosa
            echo $resultado ? "OK" : "Error al actualizar los datos: " . $conn->error;

            // Cerrar la conexión
            $conn->close();

            break;
        case 5://consultar el inventario
            $usuario = $_POST['tipo_usu'];
            $and = "";
            if($usuario == 5){
                $and = " AND ACT_USUARIO =".$idUsuario;
            } else{
                $and = "";
            }

            $sqlInvMtg = "SELECT i.FK_ID_CARTA AS ID_CARTA, m.NOM_CARTA, m.EXPANSION, m.RAREZA, i.PRECIO, i.CANTIDAD, i.IDIOMA, i.FOIL, i.CONDICION FROM mtg m LEFT JOIN inventario_usuario i ON i.FK_ID_CARTA = m.ID_CARTA where m.id_tcg=2 and i.FK_ID_USUARIO = $idUsuario";
            
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

            $sqlExpan = "INSERT INTO sets_poke (NOMBRE_SET, NOMBRE_CORTO, FECHA_LANZ) VALUES (?, ?, ?)";
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
            $sql = "SELECT * FROM sets_poke WHERE nombre_set LIKE '%" . $buscaCard . "%'";
            $result = $conn->query($sql);
            // Mostrar las coincidencias encontradas
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $fecha_lanzamiento_formateada = date('Y/m/d', strtotime($row['FECHA_LANZ']));
                    echo '<div id="div_encontradas" onclick="carga_expan_encontradaP(' . $row['ID_SET'] . ', \'' . htmlspecialchars($row['NOMBRE_SET']) . '\', \'' . htmlspecialchars($row['NOMBRE_CORTO']) . '\', \'' . htmlspecialchars($fecha_lanzamiento_formateada) . '\')">' . $row['NOMBRE_SET'] . '</div>';
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
        $updateExpan = "UPDATE sets_poke SET NOMBRE_SET = ?, NOMBRE_CORTO = ?, FECHA_LANZ = ? WHERE ID_SET = $idExpansion";

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
