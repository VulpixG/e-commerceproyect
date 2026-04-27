<?php

session_start();

include('../db_connection.php');
    
$idUsuario = isset($_SESSION['ID_USUARIO']) ? $_SESSION['ID_USUARIO'] : 0;
$nombreUsuario = $_SESSION['NOMBRE_USUARIO'];

$accion = $_POST['accion'];


    switch ($accion) {
        case 1://para reservar un deck:
            $fecha = $_POST['fecha'];
            $hora = $_POST['hora'];
            $id_deck = $_POST['id_deck'];
            $nombreUsuario = $_SESSION['NOMBRE_USUARIO'];
            
            // Eliminar la parte de la zona horaria y convertir a formato de fecha
            $fecha = substr($fecha, 0, 15); // Obtiene solo los primeros 15 caracteres
            $fecha_ok = date('Y-m-d', strtotime($fecha));
            
            // Convertir la hora al formato 'HH:MM:SS'
            $hora_ok = date('H:i:s', strtotime($hora));
            
            $verifica_reserva = "SELECT ESTATUS FROM reserva_deck WHERE FECHA = STR_TO_DATE('".$fecha_ok."', '%Y-%m-%d') AND ID_DECK = ".$id_deck;
            $resultado_reserva = $conn->query($verifica_reserva);

            $fila = $resultado_reserva->fetch_assoc();
        if ($resultado_reserva->num_rows > 0) {
            if(in_array($fila['ESTATUS'], [1, 5])){
                $estado = '';
                if($fila['ESTATUS'] == 1){
                    $estado = 'RESERVADO';
                }elseif($fila['ESTATUS'] == 5){
                    $estado = 'EN USO';
                }
                echo "Lo sentimos, la reserva para el día ".$fecha_ok." y hora ".$hora_ok." se encuentra en estatus ".$estado.". Por favor intenta con otra hora y/o fecha.";
            } else{
                // Preparar la consulta SQL
                $sqlReserva = "INSERT INTO reserva_deck (ID_DECK, FECHA, HORA, USUARIO, ESTATUS, TIPO_RESERVA) VALUES ($id_deck, '$fecha_ok', '$hora_ok', '$nombreUsuario',1,1)";
                
                //echo $sqlReserva;exit();

                $resultado = $conn->query($sqlReserva);

                // Verificar si la ejecución de la consulta fue exitosa
                if ($resultado === false) {
                    die("Error al ejecutar la consulta: " . $conn->error);
                } else {
                    echo "OK";
                }
            }
        }else{
            // Preparar la consulta SQL
            $sqlReserva = "INSERT INTO reserva_deck (ID_DECK, FECHA, HORA, USUARIO, ESTATUS, TIPO_RESERVA) VALUES ($id_deck, '$fecha_ok', '$hora_ok', '$nombreUsuario',1,1)";
                
            //echo $sqlReserva;exit();

            $resultado = $conn->query($sqlReserva);

            // Verificar si la ejecución de la consulta fue exitosa
            if ($resultado === false) {
                die("Error al ejecutar la consulta: " . $conn->error);
            } else {
                echo "OK";
            }
        }
            // Cerrar la conexión
            $conn->close();
        break;
        case 2:
            $buscaCard = $_POST['buscaCard'];
            // Consulta SQL para buscar coincidencias en la tabla 'mtg'
            $sql = "SELECT * FROM decks WHERE NOMBRE_DECK LIKE '%" . $buscaCard . "%' and USUARIO ='".$nombreUsuario."'";//solo el usuario que lo cargo lo puede editar
            $result = $conn->query($sql);
            // Mostrar las coincidencias encontradas
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div id="div_encontradas" onclick=carga_deck_encontrado('.$row['ID_DECK'].')>' . $row['NOMBRE_DECK'] . '</div>';
                }
            } else {
                echo "No se encontraron deckcitos.";
            }
            $conn->close();
        break;
        case 3:
            $deckcito = $_POST['id_deck'];

            $sql = "SELECT * FROM decks_cartas d WHERE d.ID_DECK = ".$deckcito;
            $resultado  = $conn->query($sql);

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
        case 4:
            $sqlInvMtg = "SELECT r.ID_RESERVA, r.ID_DECK,r.FECHA, r.HORA, r.USUARIO, r.ESTATUS,d.NOMBRE_DECK FROM reserva_deck r left join decks d on r.ID_DECK = d.ID_DECK where tipo_reserva=1";

            $resultadoInv = $conn->query($sqlInvMtg);
            $datos = array();
            while ($fila = $resultadoInv->fetch_assoc()) {
                $datos[] = $fila;
            }
            echo json_encode($datos);
            $conn->close();
        break;
        case 5:
            $deckcito = $_POST['deck'];
            $nombreCarta = $_POST['nomCarta'];
            $cantidad = $_POST['cantidad'];
            $numColeccion = $_POST['coleccion'];
            $expansion = $_POST['expansion'];
            $cartaAnterior = $_POST['cartaAnt'];

            $updateDeck = "UPDATE decks_cartas SET CANTIDAD=".$cantidad.", CARTA= '".$nombreCarta."', EXPANSION ='".$expansion."', NUM_COLECCION=".$numColeccion." WHERE ID_DECK = ".$deckcito." AND CARTA = '".$cartaAnterior."'";

            $resultadoActDeck = $conn->query($updateDeck);

            if ($resultadoActDeck === false) {
                die("Error al ejecutar la consulta: " . $conn->error);
            } else {
                echo "OK";
            }
            $conn->close();
        break;
        case 6:
            $deckcito = $_POST['deck'];
            $cartaAnterior = $_POST['cartaAnt'];

            $updateDeckE = "DELETE FROM decks_cartas  WHERE ID_DECK = ".$deckcito." AND CARTA = '".str_replace("'", "''", $cartaAnterior)."'";
            //echo $updateDeckE;
            $resultadoActDeckE = $conn->query($updateDeckE);

            if ($resultadoActDeckE === false) {
                die("Error al ejecutar la consulta: " . $conn->error);
            } else {
                echo "OK";
            }
            $conn->close();
        break;
        case 7:
            $deckcito = $_POST['deck'];
            $nombreCarta = $_POST['nomCarta'];
            $cantidad = $_POST['cantidad'];
            $numColeccion = $_POST['coleccion'];
            $expansion = $_POST['expansion'];

            $insertaCartaN = "INSERT INTO decks_cartas (ID_DECK, CANTIDAD, CARTA, EXPANSION, NUM_COLECCION) VALUES (".$deckcito.",".$cantidad.",'".$nombreCarta."','".$expansion."',".$numColeccion.")";
            //echo $insertaCartaN;
            $resultadoCartaN = $conn->query($insertaCartaN);

            if ($resultadoCartaN === false) {
                die("Error al ejecutar la consulta: " . $conn->error);
            } else {
                echo "OK";
            }
            $conn->close();
        case 8://para cambiar el status de un deck en renta
                $id_serva = $_POST['reserva'];
                $estatus_nuevo = $_POST['estatusN'];
    
                $actualizaStatDeck = "UPDATE reserva_deck SET ESTATUS = ".$estatus_nuevo." WHERE ID_RESERVA = ".$id_serva;
                //echo $insertaCartaN;
                $resultadoCartaN = $conn->query($actualizaStatDeck);
    
                if ($resultadoCartaN === false) {
                    die("Error al ejecutar la consulta: " . $conn->error);
                } else {
                    echo "OK";
                }
                $conn->close();
        break;
    }