<?php

session_start();
// Archivo db_connection.php que contiene la conexión a la base de datos
include('../db_connection.php');
    
$idUsuario = isset($_SESSION['ID_USUARIO']) ? $_SESSION['ID_USUARIO'] : 0;


    $accion = $_POST['accion'];

    switch ($accion) {
        case 1:// Para mostrar los pedidos
            // Usamos consultas preparadas para evitar inyección SQL
            $sqlPedidos = "SELECT 
                p.ID_PEDIDO, 
                CASE p.TIPO_PEDIDO 
                    WHEN 1 THEN 'RECOGER EN TIENDA' 
                    WHEN 2 THEN 'ENVIO A DOMICILIO' 
                END AS PEDIDOT, 
                p.DIRECCION,
                p.ARTICULOS, 
                p.FECHA_PEDIDO, 
                p.ESTATUS, 
                CASE p.ESTATUS 
                    WHEN 1 THEN 'EN PROCESO' 
                    WHEN 2 THEN 'ENVIADO' 
                    WHEN 3 THEN 'ENTREGADO EN TIENDA' 
                    WHEN 4 THEN 'CANCELADO' 
                END AS ESTATUS_PED,
                pp.RFC,pp.razon_soc,pp.regimen,pp.uso_cfdi,
                CASE 
                    WHEN p.guia IS NULL OR p.guia = '' THEN 'SIN GUIA'
                    ELSE p.guia
                END AS guia
            FROM pedidos p
            LEFT JOIN persona pp ON pp.ID_USUARIO = p.ID_CLIENTE
            WHERE p.ID_CLIENTE = ? ORDER BY p.ID_PEDIDO DESC";
            //echo $sqlPedidos;exit;
            $stmt = $conn->prepare($sqlPedidos);
            $stmt->bind_param("i", $idUsuario);
            $stmt->execute();
            $result = $stmt->get_result();

            // Verificar si hay resultados
            if ($result->num_rows > 0) {
                // Convertir resultados a un arreglo asociativo y devolverlo como JSON
                $pedidos = $result->fetch_all(MYSQLI_ASSOC);
                header('Content-Type: application/json');

                echo json_encode($pedidos);
            } else {
                // No se encontraron pedidos
                echo json_encode([]);
            }
            $conn->close();
            break;
        case 2:// Para mostrar los detalles del pedido
            $id_pedido = $_POST['pedido_num'];
            $sqlPedidos = "SELECT b.ID_PEDIDO, DATE_FORMAT(b.ACT_FECHA,'%d/%m/%Y %H:%i:%s') as ACT_FECHA, b.MOVIMIENTO, case b.TIPO_MOV when 1 then 'PEDIDO CREADO' WHEN 2 THEN 'ACTUALIZACION' END AS MOVI, u.NOMBRE_USUARIO FROM bitacora_pedidos b LEFT join usuarios u on u.ID_USUARIO= b.ACT_USUARIO WHERE ID_PEDIDO = ?";
            $stmt = $conn->prepare($sqlPedidos);
            $stmt->bind_param("i", $id_pedido);
            $stmt->execute();
            $result = $stmt->get_result();

            // Verificar si hay resultados
            if ($result->num_rows > 0) {
                // Convertir resultados a un arreglo asociativo y devolverlo como JSON
                $pedidos = $result->fetch_all(MYSQLI_ASSOC);
                header('Content-Type: application/json');

                echo json_encode($pedidos);
            } else {
                // No se encontraron pedidos
                echo json_encode([]);
            }
            $conn->close();
            break;
        case 3://para guardar los datos del cliente
            $nombre_cliente = isset($_POST['nombre_cliente']) ? $_POST['nombre_cliente'] : 0;
            $ape_pat = isset($_POST['apellidoPat']) ? $_POST['apellidoPat'] : 0;
            $ape_mat = isset($_POST['apellidoMat']) ? $_POST['apellidoMat'] : 0;
            $fecha_naci = isset($_POST['fecha_nac']) ? $_POST['fecha_nac'] : 0;
            $numTel = isset($_POST['numTel']) ? $_POST['numTel'] : 0;
            $calle = isset($_POST['calle']) ? $_POST['calle'] : 0;
            $numero_ex = isset($_POST['num_ext']) ? $_POST['num_ext'] : 0;
            $numero_int = isset($_POST['num_int']) && $_POST['num_int'] !== '' ? "'" . $_POST['num_int'] . "'" : "NULL";
            $colonia = isset($_POST['colonia']) ? $_POST['colonia'] : 0;
            $codigo_p = isset($_POST['cod_pos']) ? $_POST['cod_pos'] : 0;
            $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : 0;
            $estado = isset($_POST['estado']) ? $_POST['estado'] : 0;
            $pais = isset($_POST['pais']) ? $_POST['pais'] : 0;

            // Convertir la fecha al formato requerido por MySQL
            $fecha_naci_mysql = date('Y-m-d', strtotime(str_replace('/', '-', $fecha_naci)));

            $sqlDatosCli = "UPDATE persona SET NOMBRE = '$nombre_cliente',APELLIDO_PAT = '$ape_pat',APELLIDO_MAT = '$ape_mat',
            CALLE = '$calle', NUM_EXTERIOR= '$numero_ex', NUM_INTERIOR = $numero_int, COLONIA = '$colonia',CIUDAD = '$ciudad', ESTADO = '$estado', PAIS = '$pais',
            CODIGO_POSTAL = $codigo_p, FECHA_NAC = '$fecha_naci_mysql', NUM_TELEFONO = '$numTel' WHERE ID_USUARIO =".$idUsuario;

            $resultado = $conn->query($sqlDatosCli);

            // Verificar si la ejecución de la consulta fue exitosa
            if ($resultado === false) {
                die("Error al ejecutar la consulta: " . $conn->error);
            } else {
                // Construir un objeto JSON para devolver al cliente
                $response = array("message" => "OK");
                echo json_encode($response);
            }

            // Cerrar la conexión
            $conn->close();

            break;
        case 4://cancelar pedido, lado cliente
            $pedidoCan = $_POST['pedido'];
            $sqlCanPedi = "UPDATE pedidos SET ESTATUS = 4 WHERE ID_PEDIDO=".$pedidoCan;
            $sqlBitacora = "INSERT INTO bitacora_pedidos (ID_PEDIDO,ACT_USUARIO, ACT_FECHA, MOVIMIENTO, TIPO_MOV) VALUES
            ($pedidoCan, $idUsuario, NOW(), 'CANCELACION DE PEDIDO POR CLIENTE', 2)";

            // Ejecutar la primera consulta
            $resultado1 = $conn->query($sqlCanPedi);

            // Verificar si la ejecución de la primera consulta fue exitosa
            if ($resultado1 === false) {
                die("Error al ejecutar la consulta de actualización: " . $conn->error);
            } else {
                // Ejecutar la segunda consulta solo si la primera se realizó con éxito
                $resultado2 = $conn->query($sqlBitacora);
                
                // Verificar si la ejecución de la segunda consulta fue exitosa
                if ($resultado2 === false) {
                    die("Error al ejecutar la consulta de inserción en la bitácora: " . $conn->error);
                } else {
                    // Construir un objeto JSON para devolver al cliente
                    $response = array("message" => "OK");
                    echo json_encode($response);
                }
            }

            // Cerrar la conexión
            $conn->close();


            break;
        case 5://actualiza datos fiscales
                $rfc = $_POST['rfc'];
                $nombre = $_POST['nombre'];
                $regimen = $_POST['regimen'];
                $cp = $_POST['cp'];
                $cfdi = $_POST['usoCfdi'];

                $sql="UPDATE PERSONA SET RFC = '$rfc', CODIGO_POSTAL = $cp ,razon_soc = '$nombre', regimen = '$regimen', uso_cfdi = '$cfdi' WHERE ID_USUARIO =".$idUsuario;

                $resultado = $conn->query($sql);

                // Verificar si la ejecución de la consulta fue exitosa
                if ($resultado === false) {
                    die("Error al ejecutar la consulta: " . $conn->error);
                } else {
                    // Construir un objeto JSON para devolver al cliente
                    $response = array("message" => "OK");
                    echo json_encode($response);
                }

                // Cerrar la conexión
                $conn->close();

            break;
        case 6://obtiene datos fiscales
                $usuario = $_POST['idUsuario'];

                // Preparar la consulta con placeholder para seguridad
                $sqlDatos = "SELECT rfc, CODIGO_POSTAL as cp, razon_soc, regimen, uso_cfdi 
                            FROM PERSONA 
                            WHERE ID_USUARIO = ?";

                $stmt = $conn->prepare($sqlDatos);
                $stmt->bind_param("i", $usuario); // "i" = entero
                $stmt->execute();

                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $datos = $result->fetch_assoc(); // solo un registro
                    header('Content-Type: application/json');
                    echo json_encode($datos);
                } else {
                    echo json_encode([]); // no se encontró usuario
                }

                $stmt->close();
                $conn->close();
            break;
        case 7://solicita facturacion
                $venta = $_POST['pedido'];

                // Verificar si ya existe
                $stmt = $conn->prepare("SELECT count(*) as total FROM facturas WHERE ID_VENTA = ?");
                $stmt->bind_param("i", $venta);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if ($row['total'] >= 1) {
                    echo json_encode(array("message" => "YA"));
                    exit;
                }

                // Insertar nueva factura
                $stmt = $conn->prepare("INSERT INTO facturas (ID_VENTA, FECHA_SOLI) VALUES (?, NOW())");
                $stmt->bind_param("i", $venta);
                if ($stmt->execute()) {
                    echo json_encode(array("message" => "OK"));
                } else {
                    echo json_encode(array("message" => "ERROR", "error" => $conn->error));
                }

            break;
        default:
            // Acción no válida
            echo "Acción no válida";
    }
