<?php
$target_dir = "../imagenes_tcg/mtg/"; // Directorio donde se guardarán los archivos subidos
$nom_carta = $_POST['nombre_carta'];
$expan = $_POST['expansion'];
$num_carta = $_POST['num_carta'];

// Obtener la extensión del archivo subido
$file_extension = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);

// Generar un nuevo nombre de archivo usando el nombre de la carta y la extensión original
$new_filename_1 = $nom_carta . '_' . $expan .'_'. $num_carta . '.' . $file_extension;

// Ruta completa del primer archivo en el servidor
$target_file_1 = $target_dir . basename($new_filename_1);

// Verificar si se envió al menos un archivo
if (isset($_FILES["fileToUpload"])) {
    // Comprobar si el archivo ya existe
    if (file_exists($target_file_1)) {
        echo "El archivo " . htmlspecialchars($new_filename_1) . " ya existe. No se ha subido.";
    } else {
        // Mover y guardar el primer archivo
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file_1)) {
            echo "El archivo " . htmlspecialchars($new_filename_1) . " ha sido subido.<br>";
        } else {
            echo "Lo siento, hubo un error al subir tu archivo.<br>";
        }
    }

    // Verificar si se envió un segundo archivo y si $file_extension_2 no está vacío
    if (isset($_FILES["fileToUpload_2"])) {
        // Obtener la extensión del segundo archivo
        $file_extension_2 = pathinfo($_FILES["fileToUpload_2"]["name"], PATHINFO_EXTENSION);
        
        // Generar un nuevo nombre de archivo para el segundo archivo
        $new_filename_2 = $nom_carta . '_' . $expan .'_'. $num_carta . '_2.' . $file_extension_2;
        // Ruta completa del segundo archivo en el servidor
        $target_file_2 = $target_dir . basename($new_filename_2);

        // Comprobar si el segundo archivo ya existe
        if (file_exists($target_file_2)) {
            echo "El archivo " . htmlspecialchars($new_filename_2) . " ya existe. No se ha subido.";
        } else {
            // Mover y guardar el segundo archivo
            if (move_uploaded_file($_FILES["fileToUpload_2"]["tmp_name"], $target_file_2)) {
                echo "El archivo " . htmlspecialchars($new_filename_2) . " ha sido subido.";
            } else {
                echo "Lo siento, hubo un error al subir tu segundo archivo.";
            }
        }
    }
} else {
    echo "Por favor, selecciona al menos un archivo.";
}
?>
