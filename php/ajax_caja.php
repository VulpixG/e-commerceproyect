<?php

session_start();

// Archivo db_connection.php que contiene la conexión a la base de datos
include('../db_connection.php');

    $accion = $_POST['accion'];

    switch ($accion) {
        case 1://buscar PRODUCTO:
            $busprod = $_POST['busprod'];
            // Consulta SQL para buscar coincidencias en la tabla 'mtg'
            $sql = "SELECT m.ID_CARTA,m.NOM_CARTA,i.CANTIDAD,i.PRECIO,i.CONDICION,i.FOIL FROM inventario_usuario i left join mtg m on m.id_carta = i.FK_ID_CARTA WHERE m.NOM_CARTA LIKE '%" . $busprod . "%' AND i.CANTIDAD >0 AND i.FK_ID_USUARIO = 1";
            $result = $conn->query($sql);
            // Mostrar las coincidencias encontradas
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div id="coincidencias_usuario" onclick="carga_producto_encontrado('
                    . htmlspecialchars(json_encode($row['ID_CARTA']), ENT_QUOTES) . ', '
                    . '\'' . htmlspecialchars($row['NOM_CARTA'], ENT_QUOTES) . '\', '
                    . '\'' . htmlspecialchars($row['PRECIO'], ENT_QUOTES) . '\', '
                    . '\'' . htmlspecialchars($row['FOIL'], ENT_QUOTES) . '\', '
                    . '\'' . htmlspecialchars($row['CANTIDAD'], ENT_QUOTES) . '\')">'
                    . htmlspecialchars($row['NOM_CARTA']).'-'.$row['PRECIO'].'-'.$row['CONDICION'].'-'.$row['FOIL'].'</div>';
                }
            } else {
                echo "No se encontraron productos.";
            }
            $conn->close();
            break;
        case 2://cobrar, actualizar datos de la bd e ingresar los datos en la tabla caja para posterior cierre
            $ventas = json_decode($_POST['ventas'], true);

            if (!isset($_SESSION['ID_CAJA'])) {
                echo 'NO HAY CAJA ABIERTA';exit;
            }

            $pagoCliente = $_POST['pago'];
            $usuarioLog = $_SESSION['ID_USUARIO'];
            
            $usuario = "SELECT NOMBRE, APELLIDO_PAT, APELLIDO_MAT FROM persona WHERE ID_USUARIO = ".$usuarioLog;
            $resultUs = $conn->query($usuario);
            
            if ($resultUs && $resultUs->num_rows > 0) {
                // Obtener los datos de la fila
                $fila = $resultUs->fetch_assoc();
            
                // Acceder a los datos individualmente
                $nombre = $fila['NOMBRE'];
                $apellidoPaterno = $fila['APELLIDO_PAT'];
                $apellidoMaterno = $fila['APELLIDO_MAT'];
            
                $atendio = $nombre.' '.$apellidoPaterno.' '.$apellidoMaterno;
            } else{
                $atendio = 'EL MICHI';
            }
            
            // Inicializar el total de la venta
            $totalVenta = 0;
            
            // Construir el ticket de venta como una tabla HTML
            $ticket = '<table cellpadding="5" cellspacing="0" style="border-collapse: collapse;">';
            $ticket .= '<tr><th colspan="4" style="text-align: center; font-size: 15px;"><b>NOMBRE DE LA TIENDA</b></th></tr>';
            $ticket .= '<tr><th colspan="4" style="text-align: center; font-size: 15px;"><b>RFC: </b>DOJG951101EI2</th></tr>';
            $ticket .= '<tr><th colspan="4" style="text-align: center; font-size: 18px;">Ticket de Venta</th></tr>';
            $ticket .='<tr><td colspan="4" style="text-align: center; font-size: 15px;"><b>Fecha:</b>' . date("d/m/Y H:i:s") . '</td></tr>';
            $ticket .='<tr><td colspan="4" style="text-align: center; font-size: 15px;"><b>Le atendió:</b>' . $atendio . '</td></tr>';
            $ticket .= '<tr><th>Nombre</th><th>Cantidad</th><th style="text-align: center;">Precio unitario</th><th>Subtotal</th></tr>';
            
            foreach ($ventas as $venta) {
                if (isset($venta['ID'], $venta['nombre'], $venta['cantidad'], $venta['precio'], $venta['subtotal'])) {
                    $nombre = $venta['nombre'];
                    $cantidad = $venta['cantidad'];
                    $precio = $venta['precio'];
                    $subtotal = $venta['subtotal'];
                    $id_prod = $venta['ID'];
            
                    // Consultar la cantidad actual del producto en la base de datos
                    $consultaCantidadActual = "SELECT CANTIDAD FROM inventario_usuario WHERE FK_ID_CARTA = '".$venta['ID']."' AND FK_ID_USUARIO = 1";
                    $resultCantidadActual = $conn->query($consultaCantidadActual);
            
                    if ($resultCantidadActual->num_rows > 0) {
                        $row = $resultCantidadActual->fetch_assoc();
                        $cantidadActual = $row['CANTIDAD'];
            
                        // Validar que la cantidad actual sea mayor o igual a la cantidad a restar y que la cantidad a restar sea mayor que 0
                        if ($cantidadActual >= $cantidad && $cantidad > 0) {
                            // Consulta de actualización para restar la cantidad vendida del inventario
                            $actualizaCantidades = "UPDATE inventario_usuario SET CANTIDAD = CANTIDAD - ".$cantidad." WHERE FK_ID_CARTA= '".$venta['ID']."' AND FK_ID_USUARIO = 1 AND FOIL = '".$venta['foil']."' ";
                            //echo $actualizaCantidades;exit;
                            $resultCanti = $conn->query($actualizaCantidades);
            
                            // Consulta para insertar en la tabla de corte de caja
                            $cajita = "INSERT INTO corte_caja (ID_CARTA, NOMBRE, CANTIDAD,PRECIO, SUBTOTAL, FECHA_VENTA, USUARIO,ID_CAJA)
                            VALUES ('$id_prod','$nombre', $cantidad, $precio, $subtotal, NOW(),$usuarioLog, ".$_SESSION['ID_CAJA'].")";
                            $resultCajita2 =$conn->query($cajita);

                            $cajita2 = "INSERT INTO ventas (FECHA_VENTA, MONTO_TOTAL, ID_CLIENTE,ESTADO_VENTA)
                            VALUES (NOW(),$subtotal, 2, 1)";
                            $resultCajita =$conn->query($cajita2);
            
                            // Calcular el subtotal y sumarlo al total de la venta
                            $totalVenta += $subtotal;
            
                            // Agregar detalles de la venta como filas de la tabla
                            $ticket .= "<tr><td>$nombre</td><td>$cantidad</td><td>$precio</td><td>$subtotal</td></tr>";
                        } else {
                            // Si la cantidad actual es menor que la cantidad a restar o la cantidad a restar es menor o igual a 0, mostrar un mensaje de error
                            $ticket .= "<tr><td colspan='4'>Error: No se puede actualizar la cantidad para el producto $nombre.</td></tr>";
                        }
                    } else {
                        // Si no se encuentra el producto en la base de datos, mostrar un mensaje de error
                        $ticket .= "<tr><td colspan='4'>Error: El producto $nombre no se encontró en la base de datos.</td></tr>";
                    }
                } else {
                    // Ignorar los datos
                }
            }
            
            $cambio = $pagoCliente - $totalVenta;
            // Agregar el total de la venta al ticket
            $ticket .= '<tr><td colspan="3" style="text-align: right;">Total de la venta:</td><td>' . $totalVenta . '</td></tr>';
            $ticket .= '<tr><td colspan="3" style="text-align: right;">Su pago:</td><td>' . $pagoCliente . '</td></tr>';
            $ticket .= '<tr><td colspan="3" style="text-align: right;">Su cambio:</td><td>' . $cambio . '</td></tr>';
            $ticket .= '<tr><td colspan="4" style="text-align: center;">¡Gracias por tu compra!</td></tr>';
            $ticket .= '<tr><td colspan="4" style="text-align: center;">¡Vuelve pronto!</td></tr>';
            
            $ticket .= '</table>';
            
            // Imprimir el ticket de venta
            echo $ticket;
            
            $conn->close();
            
                break;
        case 3://para el corte de caja
            $fecha_actual = date("Y-m-d");
            $datos_cierre = "SELECT * FROM corte_caja WHERE FECHA_VENTA = '".$fecha_actual."'";
            //echo $datos_cierre;
            $resultCajitaData =$conn->query($datos_cierre);

            $sqlUpdate = "UPDATE caja SET ESTADO = 2 WHERE ID_CAJA  =".$_SESSION['ID_CAJA'];
            $cierraCajas =$conn->query($sqlUpdate);

            unset($_SESSION['ID_CAJA']);
            if ($resultCajitaData->num_rows > 0) {
                // Inicializa un array para almacenar los datos
                $datos = array();
            
                // Recorre los resultados y almacena cada fila en el array
                while ($row = $resultCajitaData->fetch_assoc()) {
                    $datos[] = $row;
                }
            
                // Convierte el array a formato JSON
                $datos_json = json_encode($datos);
            
                // Imprime los datos JSON para que JavaScript pueda procesarlos
                echo $datos_json;
            } else {
                echo "NO";
            }

            break;
        case 4://para abrir la caja
            $fondo = $_POST['fondo_inicial'];
            $idUsuario = isset($_SESSION['ID_USUARIO']) ? $_SESSION['ID_USUARIO'] : 0;

            $sqlComprueba = "SELECT COUNT(*) EXISTE FROM caja WHERE estado = 1"; 
            $result  = $conn->query($sqlComprueba);
            $row = $result->fetch_assoc();

            $data = $row['EXISTE'];

            if($data == 0){

            $sql = "INSERT INTO caja (id_usuario, fecha_apertura, fondo_inicial, estado) 
            VALUES ($idUsuario, NOW(), $fondo, 1)";

            if ($conn->query($sql)) {

                $idCaja = $conn->insert_id;  // <-- ID que necesitamos

                $_SESSION['ID_CAJA'] = $idCaja; // <-- AQUÍ LA GUARDAS

                echo json_encode([
                    "status" => "ok",
                    "id_caja" => $idCaja
                ]);

            } else {
                echo json_encode([
                    "status" => "error",
                    "msg" => $conn->error
                ]);
            }
        }else{
            echo json_encode([
                    "status" => "error",
                    "msg" => "Ya hay una caja abierta."
                ]);
        }
            break;
        default:
            // Acción no válida
            echo "Acción no válida";
    }
