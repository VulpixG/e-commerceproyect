// Iterar sobre cada elemento del array y convertir a UTF-8
foreach ($resultados as &$fila) {
    foreach ($fila as $clave => &$valor) {
        $valor = utf8_encode($valor);
    }
}
// Liberar la referencia a la última fila
unset($fila);
// Codificar como JSON
$datosCombinados = json_encode($resultados, JSON_UNESCAPED_UNICODE);
// Verificar si la codificación tuvo éxito
if ($datosCombinados !== false) {
    // Imprimir la respuesta como salida JSON
    echo $datosCombinados;
} else {
    // Imprimir un mensaje de error con información adicional
    echo json_encode(['error' => 'Error al codificar los datos como JSON: ' . json_last_error_msg()]);
}
} else {
    echo "nelson";
}