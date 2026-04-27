<?php

session_start();
// Archivo db_connection.php que contiene la conexión a la base de datos
include('../db_connection.php');
    
$idUsuario = isset($_SESSION['ID_USUARIO']) ? $_SESSION['ID_USUARIO'] : 0;
$usuario = isset($_SESSION['NOMBRE_USUARIO']) ? $_SESSION['NOMBRE_USUARIO'] : 0;

    $accion = $_POST['accion'];

//echo var_dump($_POST);exit;
    switch ($accion) {
        case 1:// Para mostrar los pedidos
            $sqlPedidos = "SELECT distinct
            ID_PEDIDO, 
            CASE TIPO_PEDIDO 
                WHEN 1 THEN 'RECOGER EN TIENDA' 
                WHEN 2 THEN 'ENVIO A DOMICILIO' 
            END AS PEDIDOT, 
            DIRECCION,
            ARTICULOS, 
            FECHA_PEDIDO, 
            CLIENTE,  
            CASE ESTATUS 
                WHEN 1 THEN 'PEDIDO PROCESO' 
                WHEN 2 THEN 'ENVIADO' 
                WHEN 3 THEN 'ENTREGADO EN TIENDA' 
                WHEN 4 THEN 'CANCELADO'
                WHEN 5 THEN 'PEDIDO CREADO'
            END AS ESTATUS_PED, 
            CORREO, 
            NUM_TEL,
            COMENTARIOS, 
            ESTATUS 
        FROM 
            pedidos 
        ORDER BY 
            FECHA_PEDIDO ASC";
            $stmt = $conn->prepare($sqlPedidos);
            $stmt->execute();
            $result = $stmt->get_result();
//echo $sqlPedidos;
            // Verificar si hay resultados
            if ($result->num_rows > 0) {
                // Convertir resultados a un arreglo asociativo y devolverlo como JSON
                $pedidos = $result->fetch_all(MYSQLI_ASSOC);
                header('Content-Type: application/json');

                echo json_encode($pedidos);
                //echo $json;
            } else {
                // No se encontraron pedidos
                echo json_encode([]);
            }
            $conn->close();
            break;
        case 2:// Para filtrar por estatus
            $filtrito = $_POST['filtro'];
            $filtro_estatus ="";

            if($filtrito == 0){
                $filtro_estatus ="";
            }else {
                $filtro_estatus ="WHERE ESTATUS =".$filtrito;
            }

            $sqlPedidos = "SELECT 
            ID_PEDIDO, 
            CASE TIPO_PEDIDO 
                WHEN 1 THEN 'RECOGER EN TIENDA' 
                WHEN 2 THEN 'ENVIO A DOMICILIO' 
            END AS PEDIDOT, 
            DIRECCION,
            ARTICULOS, 
            FECHA_PEDIDO, 
            CLIENTE,  
            CASE ESTATUS 
                WHEN 1 THEN 'EN PROCESO' 
                WHEN 2 THEN 'ENVIADO' 
                WHEN 3 THEN 'ENTREGADO EN TIENDA' 
                WHEN 4 THEN 'CANCELADO' 
            END AS ESTATUS_PED, 
            CORREO, 
            NUM_TEL,
            COMENTARIOS, 
            ESTATUS 
        FROM 
            pedidos 
        ".$filtro_estatus."
        ORDER BY 
            FECHA_PEDIDO ASC ";
            $stmt = $conn->prepare($sqlPedidos);
            //echo $sqlPedidos;exit();
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
        case 3://actualización de los pedidos
            // Obtener los datos recibidos
            $nuevoEstatus = $_POST['estatus'];
            $idPedido = $_POST['idPedido'];
            $guia = isset($_POST['numG']) ? $_POST['numG'] : '';
            $movimiento ="";

                // Preparar la consulta SQL
                // Consulta para actualizar el estado del pedido
                if($guia == ''){
                    $updatePedidos = "UPDATE pedidos SET ESTATUS = $nuevoEstatus WHERE ID_PEDIDO = $idPedido";
                } else{
                    $updatePedidos = "UPDATE pedidos SET ESTATUS = $nuevoEstatus, GUIA = '$guia' WHERE ID_PEDIDO = $idPedido";
                }

                // Definir el movimiento según el filtro
                if($nuevoEstatus == 1){
                    $movimiento ="EN PROCESO";
                } else if($nuevoEstatus == 2){
                    $movimiento ="ENVIADO";
                } else if($nuevoEstatus == 3){
                    $movimiento ="ENTREGADO EN TIENDA";
                }

                // Consulta para insertar en la bitácora
                $sqlBitacora = "INSERT INTO bitacora_pedidos (ID_PEDIDO,ACT_USUARIO, ACT_FECHA, MOVIMIENTO, TIPO_MOV) VALUES
                ($idPedido, $idUsuario, NOW(), '".$movimiento."', 2)";

                // Ejecutar la consulta para actualizar el estado del pedido
                if ($conn->query($updatePedidos) === TRUE) {
                    // Si la actualización es exitosa, insertar en la bitácora
                    if ($conn->query($sqlBitacora) === TRUE) {
                        // Si todo se ejecuta correctamente, devolver "OK"
                        echo "OK";
                    } else {
                        // Si hay un error en la inserción en la bitácora, mostrar un mensaje de error
                        echo "Error al ejecutar la consulta para el pedido $idPedido en la bitácora: " . $conn->error;
                    }
                } else {
                    // Si hay un error en la actualización del pedido, mostrar un mensaje de error
                    echo "Error al ejecutar la consulta para el pedido $idPedido: " . $conn->error;
                }

            
        $conn->close();
            break;
        case 4://para mostrar detalles del pedido:
            $id_pedido = $_POST['pedido_num'];

            $sqlPedidos = "SELECT b.ID_PEDIDO, b.ACT_FECHA, b.MOVIMIENTO, 
                        CASE b.TIPO_MOV 
                            WHEN 1 THEN 'PEDIDO CREADO' 
                            WHEN 2 THEN 'ACTUALIZACION' 
                        END AS MOVI, 
                        u.NOMBRE_USUARIO 
                        FROM bitacora_pedidos b 
                        LEFT JOIN usuarios u ON u.ID_USUARIO = b.ACT_USUARIO 
                        WHERE b.ID_PEDIDO = ?";

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
        case 5://agregar un usuario nuevo
            $nombre_usu = $_POST['nom_usu'];
            $correo_usu = $_POST['correo_usu'];
            $contra_usu = $_POST['contra_usu'];
            $tipo_usu = $_POST['tipo_usu'];

            $sqlUsuN = "INSERT INTO usuarios (NOMBRE_USUARIO,CORREO_ELEC, CONTRASENIA, FECHA_REGISTRO, TIPO_USUARIO, USU_STATUS) VALUES
                ('$nombre_usu', '$correo_usu', '$contra_usu',NOW(), $tipo_usu,1)";

            if ($conn->query($sqlUsuN) === TRUE) {
                // Si todo se ejecuta correctamente, devolver "OK"
                echo "OK";
            } else{
                echo "Error al ejecutar la consulta : " . $conn->error;
            }

            $conn->close();
            break;
        case 6://buscar usuario:
            $buscaUsu = $_POST['buscaUsu'];
            // Consulta SQL para buscar coincidencias de usuarios
            $sql = "SELECT * FROM usuarios WHERE NOMBRE_USUARIO LIKE '%" . $buscaUsu . "%'";
            $result = $conn->query($sql);
            // Mostrar las coincidencias encontradas
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div id="coincidencias_usuario" onclick="carga_usuario_encontrado(' . $row['ID_USUARIO'] . ', \'' . $row['NOMBRE_USUARIO'] . '\', \'' . $row['CORREO_ELEC'] . '\', \'' . $row['TIPO_USUARIO'] . '\', \'' . $row['CONTRASENIA'] . '\', \'' . $row['USU_STATUS'] . '\', \'' . $row['TCG_VENTA'] . '\')">' . $row['NOMBRE_USUARIO'] . '</div>';
                }
            } else {
                echo "No se encontraron usuarios.";
            }
            $conn->close();
            break;
        case 7://actualizar usuario
            $id_usuario = $_POST['id_usuario'];
            $nombre_usu = $_POST['nom_usu'];
            $correo_usu = $_POST['correo_usu'];
            $contra_usu = $_POST['contra_usu'];
            $tipo_usu = $_POST['tipo_usu'];
            $estatus_usu = $_POST['estatus_usuario'];

            $updateUsu = "UPDATE usuarios SET NOMBRE_USUARIO = '$nombre_usu', CORREO_ELEC = '$correo_usu', CONTRASENIA = '$contra_usu', TIPO_USUARIO = $tipo_usu, ESTATUS = $estatus_usu WHERE ID_USUARIO = $id_usuario";

            if ($conn->query($updateUsu) === TRUE) {
                // Si todo se ejecuta correctamente, devolver "OK"
                echo "OK";
            } else {
                // Si hay un error en la inserción en la bitácora, mostrar un mensaje de error
                echo "Error al ejecutar la consulta : " . $conn->error;
            }

            $conn->close();
            break;
        case 8://actualizar datos del usuario (personal)
            $nombre_cliente = isset($_POST['nombre_cliente']) ? $_POST['nombre_cliente'] : 0;
            $ape_pat = isset($_POST['apellidoPat']) ? $_POST['apellidoPat'] : 0;
            $ape_mat = isset($_POST['apellidoMat']) ? $_POST['apellidoMat'] : 0;
            $fecha_naci = isset($_POST['fecha_nac']) ? $_POST['fecha_nac'] : 0;
            $num_tel = isset($_POST['numerito']) ? $_POST['numerito'] : 0;
            $rfc = isset($_POST['rfc']) ? $_POST['rfc'] : 0;
            $banco = isset($_POST['banco']) ? $_POST['banco'] : 0;
            $num_cuenta = isset($_POST['cuenta']) ? $_POST['cuenta'] : 0;
            $calle = isset($_POST['calle']) ? $_POST['calle'] : 0;
            $numEx = isset($_POST['numEx']) ? $_POST['numEx'] : 0;
            $colonia = isset($_POST['colonia']) ? $_POST['colonia'] : 0;
            $cp = isset($_POST['cp']) ? $_POST['cp'] : 0;
            $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : 0;
            $pais = isset($_POST['pais']) ? $_POST['pais'] : 'México';
            $estado = isset($_POST['estado']) ? $_POST['estado'] : 0;
            $numInt = !empty($_POST['numInt']) ? $_POST['numInt'] : 0;

            $fecha_naci_mysql = date('Y-m-d', strtotime(str_replace('/', '-', $fecha_naci)));

            $sqlDatosCli = "UPDATE persona SET NOMBRE = '$nombre_cliente',APELLIDO_PAT = '$ape_pat',APELLIDO_MAT = '$ape_mat', 
            FECHA_NAC = '$fecha_naci_mysql', NUM_TELEFONO = '$num_tel', RFC = '$rfc', BANCO = '$banco' , NUM_CUENTA = '$num_cuenta',
            CALLE = '$calle', NUM_EXTERIOR = '$numEx', NUM_INTERIOR = $numInt, COLONIA = '$colonia', CODIGO_POSTAL = '$cp',
            CIUDAD = '$ciudad', PAIS = '$pais', ESTADO = $estado  WHERE ID_USUARIO =".$idUsuario;

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
        case 9://dar de alta un nuevo deck
            $deck = $_POST['nombre_deck'];
            $formato = $_POST['formato_deck'];
            $costo = $_POST['costo_deck'];
            $tcg_deck = $_POST['tcg_deck'];
            
            // Escapar los valores antes de insertarlos en la consulta SQL
            $deck = mysqli_real_escape_string($conn, $deck);
            $formato = mysqli_real_escape_string($conn, $formato);
            $costo = mysqli_real_escape_string($conn, $costo);
            $archivo = fopen($_FILES["lista_deck"]["tmp_name"], "r");
            
            $sqlDeck = "INSERT INTO decks (NOMBRE_DECK, FORMATO, COSTO, USUARIO, TCG) VALUES ('$deck', $formato, $costo, '$usuario',$tcg_deck)";

            //echo $sqlDeck;
            
            if ($conn->query($sqlDeck) === TRUE) {
                echo 'OK';
                // Obtener el id_deck recién insertado
                $id_deck = $conn->insert_id;
                //agregar cartas al la tabla decks_cartas
                if ($archivo) {
                   while (($linea = fgets($archivo)) !== false) {

                        // Procesar cada línea del archivo
                        $datos = explode(" ", $linea);
                        $cantidad = $datos[0];
                        $carta = implode(" ", array_slice($datos, 1, -2));

                        // Obtener expansión
                        $expansion_matches = [];
                        preg_match("/\(([^)]+)\)/", $datos[count($datos) - 2], $expansion_matches);
                        $expansion = isset($expansion_matches[1]) ? trim($expansion_matches[1]) : '';
                        $expansion = rtrim($expansion, "\r\n");

                        // Obtener número original
                        $numero_col = trim($datos[count($datos) - 1]);
                        $numero_col = rtrim($numero_col, "\r\n");

                        //dejar solo números (quita letras y guiones)
                        $numero_col = preg_replace('/\D/', '', $numero_col);

                        // Si queda vacío, poner 0 para evitar errores en SQL
                        if ($numero_col === '') {
                            $numero_col = 0;
                        }

                        // Escapar valores
                        $carta = mysqli_real_escape_string($conn, $carta);
                        $expansion = mysqli_real_escape_string($conn, $expansion);
                        $numero_col = mysqli_real_escape_string($conn, $numero_col);

                        // Insertar
                        $sql = "INSERT INTO decks_cartas (ID_DECK, CANTIDAD, CARTA, EXPANSION, NUM_COLECCION)
                                VALUES ($id_deck, $cantidad, '$carta', '$expansion', $numero_col)";

                        $conn->query($sql);
                    }
                    fclose($archivo);
                }
            } else {
                // Si hay un error en la inserción en la bitácora, mostrar un mensaje de error
                echo "Error al ejecutar la consulta : " . $conn->error;
            }
            $conn->close();
            break;
        case 10://buscar pedido por ID
            $pedido = $_POST['idPedido'];

            $sqlPedidos = "SELECT 
            ID_PEDIDO, 
            CASE TIPO_PEDIDO 
                WHEN 1 THEN 'RECOGER EN TIENDA' 
                WHEN 2 THEN 'ENVIO A DOMICILIO' 
            END AS PEDIDOT, 
            DIRECCION,
            ARTICULOS, 
            FECHA_PEDIDO, 
            CLIENTE,  
            CASE ESTATUS 
                WHEN 1 THEN 'EN PROCESO' 
                WHEN 2 THEN 'ENVIADO' 
                WHEN 3 THEN 'ENTREGADO EN TIENDA' 
                WHEN 4 THEN 'CANCELADO' 
            END AS ESTATUS_PED, 
            CORREO, 
            NUM_TEL,
            COMENTARIOS, 
            ESTATUS 
        FROM 
            pedidos 
        WHERE ID_PEDIDO = ".$pedido."
        ORDER BY 
            FECHA_PEDIDO ASC ";
            $stmt = $conn->prepare($sqlPedidos);
            //echo $sqlPedidos;exit();
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
        case 11://BUSQUEDA DE PEDIDOS POR USUARIO VENDEDOR
            $sqlPedidosporVendedor = "SELECT 
                p.ID_PEDIDO,
                GROUP_CONCAT(CONCAT(m.NOM_CARTA, ' - ', m.expansion, '-', m.num_carta, ' (', a.CANTIDAD, ')') ORDER BY m.NOM_CARTA SEPARATOR '|||') AS ARTICULOS,
                CASE p.TIPO_PEDIDO 
                    WHEN 1 THEN 'RECOGER EN TIENDA' 
                    WHEN 2 THEN 'ENVIO A DOMICILIO' 
                END AS PEDIDOT,
                p.DIRECCION, 
                p.CLIENTE, 
                p.FECHA_PEDIDO,
                CASE p.ESTATUS 
                    WHEN 1 THEN 'PEDIDO PROCESO' 
                    WHEN 2 THEN 'ENVIADO' 
                    WHEN 3 THEN 'ENTREGADO EN TIENDA' 
                    WHEN 4 THEN 'CANCELADO' 
                    WHEN 5 THEN 'PEDIDO CREADO' 
                END AS ESTATUS_PED,
                p.CORREO, 
                p.NUM_TEL, 
                p.COMENTARIOS, 
                p.ESTATUS
            FROM articulos_descompuestos a
            LEFT JOIN (
                SELECT NOM_CARTA, MIN(ID_CARTA) AS ID_REF
                FROM mtg
                GROUP BY NOM_CARTA
            ) mtg_clean ON a.NOMBRE_CARTA = mtg_clean.NOM_CARTA
            LEFT JOIN mtg m ON m.NOM_CARTA = mtg_clean.NOM_CARTA AND m.ID_CARTA = mtg_clean.ID_REF
            LEFT JOIN pedidos p ON a.ID_PEDIDO = p.ID_PEDIDO
            WHERE a.FK_ID_USUARIO = ".$idUsuario."
            GROUP BY p.ID_PEDIDO, p.TIPO_PEDIDO, p.CLIENTE, p.FECHA_PEDIDO
            ORDER BY p.ID_PEDIDO";
                //echo $sqlPedidosporVendedor;exit;
                $stmt = $conn->prepare($sqlPedidosporVendedor);
                $stmt->execute();
                $result = $stmt->get_result();
    
                //echo $result;exit;
                // Verificar si hay resultados
                if ($result->num_rows > 0) {
                    // Convertir resultados a un arreglo asociativo
                    $pedidosv = $result->fetch_all(MYSQLI_ASSOC);
                    
                    // Imprimir el JSON para depurar
                    $json = json_encode($pedidosv);
                    file_put_contents('debug_output.json', $json); // Guardar en archivo para depuración
                    
                    // Enviar la respuesta JSON
                    echo $json;
                } else {
                    echo json_encode([]);
                }
                
                $stmt->close();
                $conn->close();
            break;
        case 12:
            $filtrito = $_POST['filtro'];
            $filtro_estatus ="";

            if($filtrito == 0){
                $filtro_estatus ="";
            }else {
                $filtro_estatus =" AND p.ESTATUS =".$filtrito;
            }

            $sqlPedidos = "SELECT 
                p.ID_PEDIDO, 
                GROUP_CONCAT(CONCAT(m.NOM_CARTA, ' (', a.cantidad, ')') ORDER BY m.NOM_CARTA SEPARATOR ', ') AS ARTICULOS,
                CASE p.TIPO_PEDIDO 
                WHEN 1 THEN 'RECOGER EN TIENDA' 
                WHEN 2 THEN 'ENVIO A DOMICILIO' 
            END AS PEDIDOT, 
            p.DIRECCION,
                p.CLIENTE, 
                p.FECHA_PEDIDO,
                CASE p.ESTATUS 
                WHEN 1 THEN 'PEDIDO PROCESO' 
                WHEN 2 THEN 'ENVIADO' 
                WHEN 3 THEN 'ENTREGADO EN TIENDA' 
                WHEN 4 THEN 'CANCELADO'
                WHEN 5 THEN 'PEDIDO CREADO'
            END AS ESTATUS_PED,
            p.CORREO, 
            p.NUM_TEL,
            p.COMENTARIOS, 
            p.ESTATUS  
            FROM 
                articulos_descompuestos a
            LEFT JOIN 
                mtg m ON a.id_carta = m.ID_CARTA
            LEFT JOIN 
                pedidos p ON a.ID_PEDIDO = p.ID_PEDIDO
            WHERE 
                m.ACT_USUARIO = ".$idUsuario.$filtro_estatus."
            GROUP BY 
                p.ID_PEDIDO, p.TIPO_PEDIDO, p.CLIENTE, p.FECHA_PEDIDO
            ORDER BY
            p.FECHA_PEDIDO ASC ";
            $stmt = $conn->prepare($sqlPedidos);
            //echo $sqlPedidos;exit();
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
        case 13://carga datos de stripe

            $fechaD = DateTime::createFromFormat('d/m/Y', $_POST['fechaDel'])->format('Y-m-d');
            $fechaA = DateTime::createFromFormat('d/m/Y', $_POST['fechaAl'])->format('Y-m-d');

            $sql = "SELECT
                v.ID_VENTA,
                DATE_FORMAT(v.FECHA_VENTA, '%d/%m/%Y') AS FECHA_VENTA,
                v.MONTO_TOTAL,
                v.STRIPE_ID,
                CONCAT(
                IFNULL(p.NOMBRE, 'Publico'),
                ' ',
                IFNULL(p.APELLIDO_PAT, 'en'),
                ' ',
                IFNULL(p.APELLIDO_MAT, 'general')
            ) AS CLIENTE
            FROM
                ventas v
            LEFT JOIN usuarios u ON
                u.ID_USUARIO = v.ID_CLIENTE
            LEFT JOIN persona p ON
                p.ID_USUARIO = u.ID_USUARIO
            WHERE
                v.FECHA_VENTA BETWEEN '$fechaD' AND '$fechaA' ORDER BY v.ID_VENTA";

            $result = $conn->query($sql);

            $data = [];

                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }

                echo json_encode($data);

                $conn->close();

            break;
        default:
            // Acción no válida
            echo "Acción no válida";
    }
