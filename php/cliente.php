<?php
include('../db_connection.php');

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['ID_USUARIO'])) {
    header("Location: sesion.php");
    exit();
} 

$nombreUsu = $_SESSION['NOMBRE_USUARIO'];
$idUsuario = $_SESSION['ID_USUARIO'];

$sqlCli = "SELECT * FROM persona where ID_USUARIO=".$_SESSION['ID_USUARIO'];
$resultCli = $conn->query($sqlCli);

$alerta = 0;
if ($resultCli && $resultCli->num_rows > 0) {
    $row = $resultCli->fetch_assoc();
    if (
        $row['NOMBRE'] == '' || $row['APELLIDO_PAT'] == '' || $row['APELLIDO_MAT'] == '' ||
        $row['NUM_TELEFONO'] == '' || $row['CALLE'] == '' || $row['NUM_EXTERIOR'] == '' ||
        $row['COLONIA'] == '' || $row['CIUDAD'] == '' || $row['ESTADO'] == '' ||
        $row['PAIS'] == '' || $row['CODIGO_POSTAL'] == '' || $row['FECHA_NAC'] == ''
    ) {
        $alerta = 1;
    }
} else {
    $alerta = 1;
}

$fecha_nacimiento = $row['FECHA_NAC'] ?? '';
$fecha_actual = date('Y-m-d'); 
$mes_dia_nac = date('m-d', strtotime($fecha_nacimiento));
$mes_dia_actual = date('m-d', strtotime($fecha_actual));

if ($mes_dia_nac == $mes_dia_actual) {
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script src='https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '¡Feliz cumpleaños ".$nombreUsu."! 🎂',
                text: 'Que tu día esté lleno de magia y alegría ✨',
                imageUrl: '../assets/img/cumpleanos.png',
                imageWidth: 200,
                imageHeight: 200,
                confirmButtonText: '¡Gracias! 🥳',
                background: '#fffef8'
            });
        });
    </script>
    ";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio</title>

    <link rel="stylesheet" href="../assets/js/sweetalert2/dist/sweetalert2.css">
    <link rel="stylesheet" href="../assets/css/cliente.css">
    <link rel="stylesheet" href="../assets/css/botones.css">
    <link rel="stylesheet" href="../assets/css/linea_pedido.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../assets/js/funciones_cliente.js"></script>
    <script src="../assets/js/sweetalert2/dist/sweetalert2.min.js"></script>

    <style>
        .button-flotante { margin: 5px; }
    </style>
</head>

<body class="bg-light">

<!-- ENCABEZADO -->
<div class="container mt-3">
    <div class="row align-items-center text-center text-md-left">

        <!-- INICIO -->
        <div class="col-6 col-md-auto mb-2">
            <button class="btn btn-outline-success btn-sm btn-block" onclick="inicio()">
                <img src="../assets/img/hogar.png" width="20" height="20" class="mr-1"> Inicio
            </button>
        </div>

        <!-- MIS PEDIDOS -->
        <div class="col-6 col-md-auto mb-2">
            <button class="btn btn-outline-primary btn-sm btn-block" onclick="mostrarPedidos()">
                <img src="../assets/img/pedido.png" width="20" height="20" class="mr-1"> Mis Pedidos
            </button>
        </div>

        <!-- MI USUARIO -->
        <div class="col-6 col-md-auto mb-2">
            <button class="btn btn-outline-secondary btn-sm btn-block" onclick="usuarioAcciones()">
                <img src="../assets/img/user.png" width="20" height="20" class="mr-1"> Mi Usuario
            </button>
        </div>

        <!-- BIENVENIDA + GATO -->
        <div class="col-12 col-md text-center text-md-left py-2">
            <strong>Bienvenido/a <?= $nombreUsu ?></strong>
            <img src="../assets/img/gato_b.png" width="45">
        </div>

        <!-- SALIR -->
        <div class="col-12 col-md-auto mt-2 text-center">
            <button class="btn btn-outline-danger" onclick="cerrarSesion()">
                <i class="bi bi-escape"></i> Salir
            </button>
        </div>
    </div>

</div>

<!-- ALERTA DE DATOS INCOMPLETOS -->
<?php if ($alerta == 1): ?>
<script>
    Swal.fire({
        title: '¡Alerta!',
        html: 'Actualiza tus datos desde el menú <b>Mi usuario</b>.',
        icon: 'warning',
        confirmButtonText: 'Aceptar'
    });
</script>
<?php endif; ?>


<!-- CONTENIDO PRINCIPAL -->
<main class="container mt-4">

    <!-- SECCIÓN: MIS PEDIDOS -->
    <div id="pedidosCliente" style="display:none;">
        <div class="text-right mb-3">
            <button class="btn btn-outline-warning" onclick="cerrarPedidos()">
                <span style="background-image:url('../assets/img/close.png'); background-size:cover; width:20px; height:20px; display:inline-block;"></span>
                Cerrar
            </button>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Mis Pedidos</h5> <i class="bi bi-info-circle"></i> Para solicitar Factura, recuerda tener actualizados tus datos fiscales.
            </div>

            <div class="table-responsive-sm p-3">
                <table class="table table-hover table-striped-columns" id="tabla_pedidos">
                    <thead class="table-primary">
                        <tr>
                            <th>No. Pedido</th>
                            <th>Tipo</th>
                            <th>Dirección</th>
                            <th>Artículos</th>
                            <th>Fecha</th>
                            <th>Estatus</th>
                            <th>Guía</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody id="cuerpo_tabla_pedidos"></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- SECCIÓN: ACTUALIZAR DATOS -->
    <div id="datosCliente" style="display:none;">
        <div class="card">
            <div class="card-header">
                <h4>Actualizar Datos</h4>
            </div>

            <div class="card-body">

                <!-- DATOS PERSONALES -->
                <h5 class="mb-3">Datos Personales</h5>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>NOMBRE</label>
                        <input type="text" class="form-control" id="txtNomCliente" value="<?= $row['NOMBRE'] ?? '' ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label>APELLIDO PATERNO</label>
                        <input type="text" class="form-control" id="txtApePat" value="<?= $row['APELLIDO_PAT'] ?? '' ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label>APELLIDO MATERNO</label>
                        <input type="text" class="form-control" id="txtApeMat" value="<?= $row['APELLIDO_MAT'] ?? '' ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>FECHA DE NACIMIENTO</label>
                        <input type="text" class="form-control" id="datepicker_cli" value="<?= $row['FECHA_NAC'] ?? '' ?>">
                    </div>

                    <div class="form-group col-md-6">
                        <label>NÚMERO DE TELÉFONO</label>
                        <input type="text" class="form-control" id="txtTel" value="<?= $row['NUM_TELEFONO'] ?? '' ?>">
                    </div>
                </div>

                <hr>

                <!-- DIRECCIÓN -->
                <h5 class="mb-3">Dirección</h5>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>CALLE</label>
                        <input type="text" class="form-control" id="txtCalle" value="<?= $row['CALLE'] ?? '' ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label>NÚMERO EXTERIOR</label>
                        <input type="number" class="form-control" id="txtNumEx" value="<?= $row['NUM_EXTERIOR'] ?? '' ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label>NÚMERO INTERIOR</label>
                        <input type="text" class="form-control" id="txtNumInt" value="<?= $row['NUM_INTERIOR'] ?? '' ?>">
                    </div>
                </div>

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label>COLONIA</label>
                        <input type="text" class="form-control" id="txtColonia" value="<?= $row['COLONIA'] ?? '' ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label>CÓDIGO POSTAL</label>
                        <input type="text" class="form-control" id="txtCp" value="<?= $row['CODIGO_POSTAL'] ?? '' ?>">
                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label>CIUDAD</label>
                        <input type="text" class="form-control" id="txtCiudad" value="<?= $row['CIUDAD'] ?? '' ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label>PAÍS</label>
                        <input type="text" class="form-control" id="txtPais" value="<?= $row['PAIS'] ?? 'México' ?>" readonly>
                    </div>

                    <div class="form-group col-md-4">
                        <label>ESTADO</label>
                        <select id="txtEstado" class="form-control">
                            <option value="0">Seleccionar...</option>
                            <?php
                            $sqlExpa = "SELECT * FROM estados";
                            $resultExpa = $conn->query($sqlExpa);

                            if ($resultExpa && $resultExpa->num_rows > 0) {
                                while($rowE = $resultExpa->fetch_assoc()) {
                                    $selected = ($rowE['id'] == $row['nombre']) ? 'selected' : '';
                                    echo "<option value='".$rowE['id']."' $selected>".$rowE['nombre']."</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                </div>

                <hr>

                <!-- BOTONES -->
                <div class="d-flex justify-content-between flex-column flex-sm-row mt-4">

                    <button class="btn btn-success mb-2" onclick="guardarDatosCliente()">
                        Actualizar Datos
                    </button>

                    <button class="btn btn-info mb-2" onclick="modalDatosFac(<?= $idUsuario ?>)">
                        Datos para facturación
                    </button>

                    <button class="btn btn-primary mb-2" onclick="cerrarDatoscliente()">
                        Cerrar
                    </button>

                </div>

            </div>
        </div>
    </div>
</main>

</body>
</html>
