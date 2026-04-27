<?php

session_start();
// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['ID_USUARIO'])) {
    // Si no ha iniciado sesión, redirige a la página de inicio de sesión
    header("Location: sesion.php");
    exit();
} 

$idUsuario = $_SESSION['ID_USUARIO'];
$nombreUsuario = $_SESSION['NOMBRE_USUARIO'];
$correoElectronico = $_SESSION['CORREO_ELEC'];
$tipo_usuario = $_SESSION['TIPO_USUARIO'];

?>
<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        
        <meta charset="utf-8" />
        <title>Bienvenido <?php echo $nombreUsuario?></title>
        <link rel="shortcut icon" type="image/x-icon" href="../assets/img/logomichi.png">
        <link rel="stylesheet" type="text/css" href="../assets/js/bootstrap_5.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" href="../assets/js/sweetalert2/dist/sweetalert2.css">
        <link rel="stylesheet" href="../assets/css/botones.css">
        <!-- Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
        <!-- Bootstrap-datepicker idioma español -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js"></script>
        <script src="../assets/js/funciones.js"></script>
        <script src="../assets/js/funciones_cliente.js"></script>
        <script src="../assets/js/funcionesPOS.js"></script>
        <script src="../assets/js/funciones_lorcana.js"></script>
        <script src="../assets/js/sweetalert2/dist/sweetalert2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>

    </head>
    <body>
        <?php
            if($tipo_usuario == 1){
                include('administrador.php');
            } elseif ($tipo_usuario == 3){
                include('cliente.php');
            } elseif($tipo_usuario == 5){
                include('vendedor.php');
            }
        ?>
    </body>
</html>