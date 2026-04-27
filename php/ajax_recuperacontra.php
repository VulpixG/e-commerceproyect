<?php
include('../db_connection.php');

    $accion = $_POST['accion'];

    switch($accion){
        case 1://recupera contraseña, envia correos
            $correo = $_POST['correo'];

            $stmt = $conn->prepare("SELECT CORREO_ELEC FROM usuarios WHERE CORREO_ELEC = ?");
            $stmt->bind_param("s", $correo);
            $stmt->execute();
            $result = $stmt->get_result();

        if($result->num_rows > 0){
            $fila = $result->fetch_assoc();
            
            // Genera un token seguro para restablecer contraseña
            $token = bin2hex(random_bytes(16));
            
            // Guardar token en la DB con fecha de expiración (opcional)
            $expira = date("Y-m-d H:i:s", strtotime("+1 hour"));
            $update = $conn->prepare("UPDATE usuarios SET token_reset = ?, token_expira = ? WHERE CORREO_ELEC = ?");
            $update->bind_param("sss", $token, $expira, $correo);
            $update->execute();

            // Armar correo
            require_once '../enviar_correo.php';

            recuperarContraseña(
                $correo,
                $token
            );

            if(recuperarContraseña($correo, $token)){
                echo "OK";
            } else {
                echo "Hubo un problema al enviar el correo.";
            }

        } else {
            echo "El correo no está registrado";
        }

        $stmt->close();
        $conn->close();

        break;
    case 2://ya el usuario cambia su contraseña
        
        $token = $_POST['token'];
        $password = $_POST['password'];

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("
            SELECT ID_USUARIO 
            FROM usuarios 
            WHERE token_reset = ? 
            AND token_expira > NOW()
        ");
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {

    $update = $conn->prepare("
            UPDATE usuarios 
            SET CONTRASENIA = ?, 
                token_reset = NULL, 
                token_expira = NULL
            WHERE token_reset = ?
        ");

        $update->bind_param("ss", $passwordHash, $token);
        $update->execute();

        echo "OK";

        } else {
            echo "Token inválido o expirado, solicite uno nuevo.";
        }


        break;
    }