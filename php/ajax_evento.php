<?php

session_start();
// Archivo db_connection.php que contiene la conexión a la base de datos
include('../db_connection.php');
require_once('../php-jwt-main/src/JWT.php');
require_once('../php-jwt-main/src/Key.php');
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
    
$idUsuario = isset($_SESSION['ID_USUARIO']) ? $_SESSION['ID_USUARIO'] : 0;

    $accion = $_POST['accion'];

    switch ($accion) {
        case 1: //Guardar nuevo evento
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $tcg = $_POST['tcg'];
    $costo = $_POST['costo'];
    $describe = $_POST['describe'];
    $hora = $_POST['hora'];
    $data = "";

    $fecha_objeto = DateTime::createFromFormat('d/m/Y', $fecha);
    $fecha_convertida = $fecha_objeto->format('Y/m/d');

    if ($tcg == 1) {
        $data = " MTG";
    } else if ($tcg == 2) {
        $data = " Pokémon";
    } 

    // ============================
    //  📌  SUBIR IMAGEN DEL EVENTO
    // ============================
    $rutaImagenBD = ""; // valor por defecto por si no hay imagen

    if (isset($_FILES['img_evento']) && $_FILES['img_evento']['error'] === 0) {

        // Nombre original
        $nombreImg = $_FILES['img_evento']['name'];
        $tmpImg = $_FILES['img_evento']['tmp_name'];

        // Crear carpeta si no existe
        $carpeta = "../imagenes_eventos/";
        if (!file_exists($carpeta)) {
            mkdir($carpeta, 0777, true);
        }

        // Renombrar archivo con fecha + nombre original (evita duplicados)
        $nuevoNombre = time() . "_" . basename($nombreImg);

        // Ruta completa en el servidor
        $rutaDestino = $carpeta . $nuevoNombre;

        // Mover archivo
        if (move_uploaded_file($tmpImg, $rutaDestino)) {
            // Ruta que se guardará en la base de datos
            $rutaImagenBD = $rutaDestino;
        } else {
            echo "Error al subir la imagen";
            exit;
        }
    }

    // ======================================
    //  📌 INSERTAR EVENTO CON RUTA DE IMAGEN
    // ======================================
    $consulta = "INSERT INTO eventos 
    (NOMBRE_EVENTO, FECHA_EVENTO, HORA_EVENTO, TCG_EVENTO, COSTO, DESCRIPCION, IMAGEN_EVENTO, FK_ID_USUARIO) 
    VALUES 
    ('$nombre', '$fecha_convertida', '$hora', $tcg, $costo, '$describe', '$rutaImagenBD', $idUsuario)";

    $resultado = $conn->query($consulta);

    if ($resultado === false) {
        die("Error al ejecutar la consulta: " . $conn->error);
    } else {
        $titulo = "Nuevo Evento Disponible en El Carton del Michi";
        $mensaje = "¡Se ha agregado un nuevo evento para ".$data."! En la fecha: ".$fecha." y Hora: ".$hora."";

        enviarNotificacionFCM($titulo, $mensaje);

        echo "OK";
    }

    $conn->close();
    break;
    case 2://consulta y muestra los eventos
            $sql="SELECT
            NOMBRE_EVENTO,
            DATE_FORMAT(FECHA_EVENTO, '%d/%m/%Y') AS FECHA_EVENTO,
            HORA_EVENTO,
            COSTO,
            IMAGEN_EVENTO,
            CASE TCG_EVENTO 
                WHEN 1 THEN 'MTG'
                WHEN 2 THEN 'Pokémon'
            END AS TCG
        FROM
            eventos
        WHERE
            FECHA_EVENTO >= NOW()
            ORDER BY FECHA_EVENTO ASC";
            $result = $conn->query($sql);

            $data = array();

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        // Indicar que la respuesta es JSON
        header('Content-Type: application/json');

        // Enviar los datos como JSON
        echo json_encode($data);

         $conn->close();
         exit;

        break;
    }

    function enviarNotificacionFCM($titulo, $mensaje) {
    $serviceAccountFile =  '../michitcg-d9e15-firebase-adminsdk-fbsvc-550fa7e0d6.json';
    $projectId = 'michitcg-d9e15';

    $serviceAccount = json_decode(file_get_contents($serviceAccountFile), true);

    $now = time();
    $header = [
        'alg' => 'RS256',
        'typ' => 'JWT'
    ];

    $payload = [
        'iss' => $serviceAccount['client_email'],
        'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
        'aud' => 'https://oauth2.googleapis.com/token',
        'iat' => $now,
        'exp' => $now + 3600
    ];

    $privateKey = $serviceAccount['private_key'];
    $jwt = JWT::encode($payload, $privateKey, 'RS256');

    // Intercambio JWT por access_token
    $token_url = 'https://oauth2.googleapis.com/token';

    $token_post_data = [
        'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
        'assertion' => $jwt
    ];

    $ch = curl_init($token_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($token_post_data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
    $token_response = curl_exec($ch);
    curl_close($ch);

    $token_data = json_decode($token_response, true);
    if (!isset($token_data['access_token'])) {
        return 'Error al obtener el token: ' . $token_response;
    }

    $accessToken = $token_data['access_token'];

    // Preparar notificación
    $url = "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send";

    $headers = [
        "Authorization: Bearer {$accessToken}",
        "Content-Type: application/json"
    ];

    $data = [
        "message" => [
            "topic" => "eventos",
            "notification" => [
                "title" => $titulo,
                "body" => $mensaje
            ]
        ]
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}