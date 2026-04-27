<?php

session_start();
include('../db_connection.php');

// Definir carpeta destino
$target_dir = "C:/xampp/htdocs/magia/sellado/";

if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

// Verificar archivo
if (!isset($_FILES['fileToUpload_prod']) || $_FILES['fileToUpload_prod']['error'] !== 0) {
    die("No se recibió archivo o hubo un error al subirlo.");
}

$nombre_produc = $_POST['nombre_produc'] ?? '';
$idUsuario = $_SESSION['ID_USUARIO'] ?? 0;

// Buscamos el último registro insertado por ese usuario y nombre
$sql = "SELECT ID_PRODUCTO 
        FROM producto_sellado 
        WHERE NOMBRE_PRODUCTO = '$nombre_produc'
        ORDER BY ID_PRODUCTO DESC 
        LIMIT 1";

$result = $conn->query($sql);

if ($result && $row = $result->fetch_assoc()) {
    $idProducto = $row['ID_PRODUCTO'];
} else {
    die("No se encontró el producto recién insertado.");
}

// Obtener extensión
$tipoArchivo = strtolower(pathinfo($_FILES["fileToUpload_prod"]["name"], PATHINFO_EXTENSION));
$tiposPermitidos = ["jpg", "jpeg", "png", "gif", "webp"];

if (!in_array($tipoArchivo, $tiposPermitidos)) {
    die("Tipo de archivo no permitido.");
}

// Renombrar con el ID
$nuevoNombre = $idProducto . "." . $tipoArchivo;
$rutaDestino = $target_dir . $nuevoNombre;

// Mover el archivo
if (move_uploaded_file($_FILES["fileToUpload_prod"]["tmp_name"], $rutaDestino)) {
    // Guardamos la ruta relativa en la BD
    $rutaRelativa = "sellado/" . $nuevoNombre;
    $update = "UPDATE producto_sellado SET URL_IMAGEN = '$rutaRelativa' WHERE ID_PRODUCTO = $idProducto";
    $conn->query($update);

    echo "OK";
} else {
    echo "Error al mover el archivo.";
}
?>
