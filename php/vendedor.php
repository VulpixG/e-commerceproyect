<?php
    // Verifica si el usuario ha iniciado sesión
    if (!isset($_SESSION['ID_USUARIO'])) {
        // Si no ha iniciado sesión, redirige a la página de inicio de sesión
        header("Location: sesion.php");
        exit();
    } 

    $tipo_usuario = $_SESSION['TIPO_USUARIO'];
    $idUsuario = $_SESSION['ID_USUARIO'];

    if($idUsuario != 2){
        $display_styleData = "display: none;";
    } else{
        $display_styleData = "display: block;";
    }

    if ($tipo_usuario == 1 || $tipo_usuario == 4) {
        $display_style = "display: block;";
    } else {
        $display_style = "display: none;";
    }

    if($tipo_usuario == 1 || $tipo_usuario == 4 || $tipo_usuario == 5){
        $valida_cartas= "display: block;";
    } else{
        $valida_cartas= "display: block;";
    }

    include('../db_connection.php');
/**consulta para obtener las condiciones de las cartas */

    $sql = "SELECT * FROM CONDICIONES_CARTAS";
    $result = $conn->query($sql);
/**consulta para obtener las expansioes de las cartas **/

    $sqlExpa = "SELECT * FROM expansiones_mtg";
    $resultExpa = $conn->query($sqlExpa);

/** CONSULTA PARA TRAER LOS DATOS **/    
$sqlCli = "SELECT * FROM persona WHERE ID_USUARIO=".$_SESSION['ID_USUARIO'];
//echo $sqlCli;
$resultCli = $conn->query($sqlCli);

$alerta = 0;
if ($resultCli && $resultCli->num_rows > 0) {
    $rowUs = $resultCli->fetch_assoc();

    // Recorremos cada campo de la fila para verificar si algún valor es null o está vacío
    foreach ($rowUs as $campo => $valor) {
        if (is_null($valor) || $valor === '') {
            $alerta = 1;
            break; // Salimos del bucle si encontramos un campo null o vacío
        }
    }
}



$sqlVendedor = "SELECT TCG_VENTA FROM usuarios where ID_USUARIO=".$_SESSION['ID_USUARIO'];
//echo $sqlCli;
$resultVendedor = $conn->query($sqlVendedor);

if ($resultVendedor && $resultVendedor->num_rows > 0) {
    $rowVende = $resultVendedor->fetch_assoc();
}


if($rowVende['TCG_VENTA']== 1){
    $ocultosVendedorMtg= "display: block;";
} else{
    $ocultosVendedorMtg= "display: none;";
}

if($rowVende['TCG_VENTA']== 2){
    $ocultosVendedorPoke= "display: block;";
} else{
    $ocultosVendedorPoke= "display: none;";
}

if($rowVende['TCG_VENTA']== 3){
    $ocultosVendedorYu= "display: block;";
} else{
    $ocultosVendedorYu= "display: none;";
}

if($rowVende['TCG_VENTA']== 4){
    $ocultosVendedorLor= "display: block;";
} else{
    $ocultosVendedorLor= "display: none;";
}

if($rowVende['TCG_VENTA']== 5){
    $ocultosVendedorOp= "display: block;";
} else{
    $ocultosVendedorOp= "display: none;";
}
?>
<link rel="stylesheet" href="../assets/css/cliente.css">
<div class="container_header" style="margin-top: 15px;">
        <div>
        <button class="btn btn-outline-success button-flotante" type="button" onclick="dirije()" >
            <span style="background-image: url('../assets/img/hogar.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
            Inicio
        </button>
        </div>
        <div>
        <button id="btnDatos_usu" class="btn btn-outline-dark button-flotante" type="button" onclick="abre_usuario()" >
            <span style="background-image: url('../assets/img/grupo.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
            Mi Usuario
        </button>
        </div>
        <div>
        <button id="btnCartas" class="btn btn-outline-primary button-flotante" type="button" onclick="cartasAcciones()" style="<?php echo $valida_cartas; ?>">
            <span style="background-image: url('../assets/img/magic.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
            Cartas
        </button>
        </div>
        <div>
        <button id="btnCartas" class="btn btn-outline-dark button-flotante" type="button" onclick="decksAcciones()" style="<?php echo $display_style; ?>">
            <span style="background-image: url('../assets/img/decks.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
            Decks
        </button>
        </div>
        <div>
        <button id="btnUsuarios" class="btn btn-outline-warning button-flotante" type="button" onclick="ver_pedidosVendedor(<?php echo $tipo_usuario;?>)">
            <span style="background-image: url('../assets/img/pedido.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
            Pedidos
        </button>
        </div>
    <div>
    <button class="Btnsal" onclick="cerrarSesion()">
        <div class="sign"><svg viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path></svg></div>
        <div class="text">Salir</div>
    </button>
    </div>
    </div>
    <main>
    <?php if ($alerta == 1){?>
        <script>
            Swal.fire({
                title: '¡Alerta!',
                html: 'Actualiza tus datos desde el menú <b>Mi usuario</b>.',
                icon: 'warning',
                confirmButtonText: 'Aceptar'
            });
        </script>
        <?php }?>
<div class="mydict" id="tcgs" style="display: none;">
	<div>
		<label style="<?php echo $ocultosVendedorMtg; ?>">
			<input type="radio" name="radio" checked="" onclick="mostrartcgs()" >
			<span>Magic the gathering</span>
		</label>
		<label style="<?php echo $ocultosVendedorPoke; ?>">
			<input type="radio" name="radio" onclick="mostrarPoke()">
			<span>Pok&eacute;mon</span>
		</label>
		<label style="<?php echo $ocultosVendedorYu; ?>">
			<input type="radio" name="radio" onclick="mostrarYugi()">
			<span>Yu gi oh!</span>
		</label>
        <label style="<?php echo $ocultosVendedorLor; ?>">
			<input type="radio" name="radio" onclick="mostrarLorcana()">
			<span>Lorcana</span>
		</label>
        <label style="<?php echo $ocultosVendedorOp; ?>">
			<input type="radio" name="radio" onclick="mostrarOneP()">
			<span>One Piece</span>
		</label>
		<label>
			<input type="radio" name="radio" onclick="ocultartcgs()">
			<span>Cerrar</span>
		</label>
	</div>
</div>
<!-- SELECCIONAR OPCIONES ENTRE CARTAS, EXPANSIONES, ETC, RELACIONADO A LAS CARTAS MTG -->
<!-- mtg -->
<div class="mydict2" id="nav_mtg" style="display: none; background-image: url('../imagenes_tcg/magiasi.jpg'); background-size: 90px;"><!-- usar cover para abarcar todo el div -->
    <div class="badge bg-primary text-wrap" style="width: 6rem;">
        Menú MTG
    </div>
    <div>
        <label>
            <input type="radio" name="radio" checked="" onclick="mostrarCartas()">
            <span>CARTAS</span>
        </label>
        <label style="<?php echo $display_styleData; ?>">
            <input type="radio" name="radio" onclick="mostrarExpansiones()">
            <span>EXPANSIONES</span>
        </label>
        <label>
            <input type="radio" name="radio" onclick="ocultarnav()">
            <span>Cerrar</span>
        </label>
    </div>
</div>

<!-- poke -->
<div class="mydict2" id="nav_poke" style="display: none; background-image: url('../imagenes_tcg/pokesi.jpg'); background-size: 90px;"><!-- usar cover para abarcar todo el div -->
        <div class="badge bg-success text-wrap" style="width: 7rem;">
            Menú Pokémon
        </div>
	<div>
		<label>
			<input type="radio" name="radio" checked="" onclick="mostrarCartasP()">
			<span>CARTAS</span>
		</label>
		<label style="<?php echo $display_styleData; ?>">
			<input type="radio" name="radio" onclick="mostrarExpansionesP()">
			<span>EXPANSIONES</span>
		</label>
		<label>
			<input type="radio" name="radio" onclick="ocultarnavP()">
			<span>Cerrar</span>
		</label>
	</div>
</div>

<!-- yugi -->
<div class="mydict2" id="nav_yugi" style="display: none; background-image: url('../imagenes_tcg/yugisi.jpg'); background-size: 90px;"><!-- usar cover para abarcar todo el div -->
        <div class="badge bg-warning text-wrap" style="width: 7rem;">
            Menú Yugi Oh!
        </div>
	<div>
		<label>
			<input type="radio" name="radio" checked="" onclick="mostrarCartasY()">
			<span>CARTAS</span>
		</label>
		<label style="<?php echo $display_styleData; ?>">
			<input type="radio" name="radio" onclick="mostrarExpansionesY()">
			<span>EXPANSIONES</span>
		</label>
		<label>
			<input type="radio" name="radio" onclick="ocultarnavY()">
			<span>Cerrar</span>
		</label>
	</div>
</div>

<!-- lorcana -->
<div class="mydict2" id="nav_lorcana" style="display: none; background-image: url('../imagenes_tcg/lorcanaback.jpg'); background-size: 90px;"><!-- usar cover para abarcar todo el div -->
        <div class="badge bg-warning text-wrap" style="width: 7rem;">
            Menú Lorcana
        </div>
	<div>
		<label>
			<input type="radio" name="radio" checked="" onclick="mostrarCartasL()">
			<span>CARTAS</span>
		</label>
		<label style="<?php echo $display_styleData; ?>">
			<input type="radio" name="radio" onclick="mostrarExpansionesL()">
			<span>EXPANSIONES</span>
		</label>
		<label>
			<input type="radio" name="radio" onclick="ocultarnavL()">
			<span>Cerrar</span>
		</label>
	</div>
</div>

<!-- one piece -->
<div class="mydict2" id="nav_onepiece" style="display: none; background-image: url('../imagenes_tcg/opback.png'); background-size: 90px;"><!-- usar cover para abarcar todo el div -->
        <div class="badge bg-warning text-wrap" style="width: 7rem;">
            Menú One Piece
        </div>
	<div>
		<label>
			<input type="radio" name="radio" checked="" onclick="mostrarCartasOp()">
			<span>CARTAS</span>
		</label>
		<label style="<?php echo $display_styleData; ?>">
			<input type="radio" name="radio" onclick="mostrarExpansionesOp()">
			<span>EXPANSIONES</span>
		</label>
		<label>
			<input type="radio" name="radio" onclick="ocultarnavOp()">
			<span>Cerrar</span>
		</label>
	</div>
</div>
<!-- ACCIONES MTG -->
        <div id="accionesCartas" style="display: none;">
                <div style="margin-top: 10px">
                <button id="btnadd" class="btn btn-outline-success button-flotante" type="button" onclick="mostrarAddC()">
                    <span style="background-image: url('../assets/img/add.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                    A&ntilde;adir
                </button>
                <button id="btnadd" class="btn btn-outline-success button-flotante" type="button" onclick="agregaMasivo()">
                    <span style="background-image: url('../assets/img/add.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                    A&ntilde;adir x Bloque
                </button>
                <button id="btnedit" class="btn btn-outline-primary button-flotante" type="button" onclick="mostrarEditar()">
                    <span style="background-image: url('../assets/img/edit.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                    Editar
                </button>
                <button id="btnInventario" class="btn btn-outline-info button-flotante" type="button" onclick="mostrarInventarioMtg(<?php echo $_SESSION['ID_USUARIO'];?>)">
                    <span style="background-image: url('../assets/img/magic.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                    Inventario
                </button>
                <button id="btnclose" class="btn btn-outline-warning button-flotante" type="button" onclick="cerrarAccionesCartas()">
                    <span style="background-image: url('../assets/img/close.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                    Cerrar
                </button>
                </div>
        </div>
<!-- ACCIONES POKE -->
<div id="accionesCartasP" style="display: none;">
                <div style="margin-top: 10px">
                <button id="btnadd" class="btn btn-outline-success button-flotante" type="button" onclick="mostrarAddP()">
                    <span style="background-image: url('../assets/img/add.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                    A&ntilde;adir
                </button>
                <button id="btnedit" class="btn btn-outline-primary button-flotante" type="button" onclick="mostrarEditarP()">
                    <span style="background-image: url('../assets/img/edit.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                    Editar
                </button>
                <button id="btnInventario" class="btn btn-outline-info button-flotante" type="button" onclick="mostrarInventarioPoke(<?php echo $tipo_usuario;?>)">
                    <span style="background-image: url('../assets/img/magic.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                    Inventario
                </button>
                <button id="btnclose" class="btn btn-outline-warning button-flotante" type="button" onclick="cerrarAccionesCartasP()">
                    <span style="background-image: url('../assets/img/close.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                    Cerrar
                </button>
                </div>
        </div>
<!-- ACCIONES YUGI -->
<div id="accionesCartasY" style="display: none;">
                <div style="margin-top: 10px">
                <button id="btnadd" class="btn btn-outline-success button-flotante" type="button" onclick="mostrarAddY()">
                    <span style="background-image: url('../assets/img/add.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                    A&ntilde;adir
                </button>
                <button id="btnedit" class="btn btn-outline-primary button-flotante" type="button" onclick="mostrarEditarY()">
                    <span style="background-image: url('../assets/img/edit.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                    Editar
                </button>
                <button id="btnInventario" class="btn btn-outline-info button-flotante" type="button" onclick="mostrarInventarioYug(<?php echo $_SESSION['ID_USUARIO'];?>)">
                    <span style="background-image: url('../assets/img/magic.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                    Inventario
                </button>
                <button id="btnclose" class="btn btn-outline-warning button-flotante" type="button" onclick="cerrarAccionesCartasY()">
                    <span style="background-image: url('../assets/img/close.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                    Cerrar
                </button>
                </div>
</div>
<!-- ACCIONES LORCANA -->
<div id="accionesCartasL" style="display: none;">
                <div style="margin-top: 10px">
                <button id="btnadd" class="btn btn-outline-success button-flotante" type="button" onclick="mostrarAddL()">
                    <span style="background-image: url('../assets/img/add.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                    A&ntilde;adir
                </button>
                <button id="btnedit" class="btn btn-outline-primary button-flotante" type="button" onclick="mostrarEditarL()">
                    <span style="background-image: url('../assets/img/edit.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                    Editar
                </button>
                <button id="btnInventario" class="btn btn-outline-info button-flotante" type="button" onclick="mostrarInventarioLor(<?php echo $_SESSION['ID_USUARIO'];?>)">
                    <span style="background-image: url('../assets/img/magic.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                    Inventario
                </button>
                <button id="btnclose" class="btn btn-outline-warning button-flotante" type="button" onclick="cerrarAccionesCartasL()">
                    <span style="background-image: url('../assets/img/close.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                    Cerrar
                </button>
                </div>
</div>
<!-- ACCIONES ONE PIECE -->
<div id="accionesCartasOp" style="display: none;">
                <div style="margin-top: 10px">
                <button id="btnadd" class="btn btn-outline-success button-flotante" type="button" onclick="mostrarAddOp()">
                    <span style="background-image: url('../assets/img/add.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                    A&ntilde;adir
                </button>
                <button id="btnedit" class="btn btn-outline-primary button-flotante" type="button" onclick="mostrarEditarOp()">
                    <span style="background-image: url('../assets/img/edit.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                    Editar
                </button>
                <button id="btnInventario" class="btn btn-outline-info button-flotante" type="button" onclick="mostrarInventarioOp(<?php echo $_SESSION['ID_USUARIO'];?>)">
                    <span style="background-image: url('../assets/img/magic.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                    Inventario
                </button>
                <button id="btnclose" class="btn btn-outline-warning button-flotante" type="button" onclick="cerrarAccionesCartasOp()">
                    <span style="background-image: url('../assets/img/close.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                    Cerrar
                </button>
                </div>
</div>
        <!-- EXPANSIONES MTG -->
        <div id="accionesExpansiones" style="display: none;">
            <div style="margin-top: 10px">
            <button id="btnadd" class="btn btn-outline-success button-flotante" type="button" onclick="mostrarAddEx()">
                <span style="background-image: url('../assets/img/add.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                A&ntilde;adir
            </button>
            <button id="btnedit" class="btn btn-outline-primary button-flotante" type="button" onclick="mostrarExpansionesEdit()">
                <span style="background-image: url('../assets/img/edit.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                Editar
            </button>
            <button id="btncloseExpan" class="btn btn-outline-warning button-flotante" type="button" onclick="cerrarAccionesExp()">
                <span style="background-image: url('../assets/img/close.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                Cerrar
            </button>
            </div>
        </div>
                <!-- EXPANSIONES POKE -->
                <div id="accionesExpansionesP" style="display: none;">
            <div style="margin-top: 10px">
            <button id="btnadd" class="btn btn-outline-success button-flotante" type="button" onclick="mostrarAddExP()">
                <span style="background-image: url('../assets/img/add.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                A&ntilde;adir
            </button>
            <button id="btnedit" class="btn btn-outline-primary button-flotante" type="button" onclick="mostrarExpansionesEditP()">
                <span style="background-image: url('../assets/img/edit.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                Editar
            </button>
            <button id="btncloseExpan" class="btn btn-outline-warning button-flotante" type="button" onclick="cerrarAccionesExpP()">
                <span style="background-image: url('../assets/img/close.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                Cerrar
            </button>
            </div>
        </div>
                        <!-- EXPANSIONES Yugi -->
        <div id="accionesExpansionesY" style="display: none;">
            <div style="margin-top: 10px">
            <button id="btnadd" class="btn btn-outline-success button-flotante" type="button" onclick="mostrarAddExY()">
                <span style="background-image: url('../assets/img/add.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                A&ntilde;adir
            </button>
            <button id="btnedit" class="btn btn-outline-primary button-flotante" type="button" onclick="mostrarExpansionesEditY()">
                <span style="background-image: url('../assets/img/edit.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                Editar
            </button>
            <button id="btncloseExpan" class="btn btn-outline-warning button-flotante" type="button" onclick="cerrarAccionesExpY()">
                <span style="background-image: url('../assets/img/close.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                Cerrar
            </button>
            </div>
        </div>
                        <!-- EXPANSIONES LORCANA -->
        <div id="accionesExpansionesL" style="display: none;">
            <div style="margin-top: 10px">
            <button id="btnadd" class="btn btn-outline-success button-flotante" type="button" onclick="mostrarAddExL()">
                <span style="background-image: url('../assets/img/add.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                A&ntilde;adir
            </button>
            <button id="btnedit" class="btn btn-outline-primary button-flotante" type="button" onclick="mostrarExpansionesEditL()">
                <span style="background-image: url('../assets/img/edit.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                Editar
            </button>
            <button id="btncloseExpan" class="btn btn-outline-warning button-flotante" type="button" onclick="cerrarAccionesExpL()">
                <span style="background-image: url('../assets/img/close.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                Cerrar
            </button>
            </div>
        </div>
        <!--INICIO DEL DIV = AGREGAR CARTAS MTG -->
        <div id="crudCartasAdd" style="margin-top: 10px; display: none;">
        <div class="card mx-auto" style="width: 86rem; margin-top:80px;" id="tcgs" style="display: none;">
    <div class="card-header d-flex justify-content-between">
    <h5 class="mb-0">Añadir Cartas</h5>
  </div>
        <div id="comodatoCompra">
    <table id="tablaDatosUnidad" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>CARTA</td>
            <td>EXPANSIÓN</td>
        </tr>
        <tr>
            <td><input type="text" id="txtNomCarta" class="form-control"></td>
            <td>
                <select name="cbExpansion" id="cbExpansion" class="form-control">
                    <option value="0" selected>Seleccionar...</option>
                    <?php
                    // Verifica si hay resultados
                    if ($resultExpa && $resultExpa->num_rows > 0) {
                        // Itera sobre los resultados y genera las opciones
                        while($row = $resultExpa->fetch_assoc()) {
                            echo "<option value='" . $row['NOMBRE_CORTO'] . "'>" . $row['NOMBRE_SET'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
    </table>
    <hr>
    <table id="tablaDesc" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>PRECIO</td>
            <td>CANTIDAD</td>
            <td>FOIL</td>
        </tr>
        <tr>
            <td><input type="text" class="form-control" id="txtPrecio" onkeyup="validarNumeros(event)"></td>
            <td><input type="number" class="form-control" id="txtCantid" onkeyup="validarNumeros(event)"></td>
            <td>
                <select id="tipoFoil" class="form-control">
                <option selected value="0">Seleccionar....</option>
                    <option value="F">FOIL</option>
                    <option value="N">NO FOIL</option>
                </select>
            </td>
        </tr>
    </table>
    <hr>
    <table id="tablaDatosSocio2" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>CONDICIÓN</td>
            <td>IDIOMA</td>
        </tr>
        <tr>
            <td>
            <select class="form-select" id="condi_carta">
                <option value="0" selected>Seleccionar...</option>
                <?php
                // Verifica si hay resultados
                if ($result && $result->num_rows > 0) {
                    // Itera sobre los resultados y genera las opciones
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['DECRIP_CORTO'] . "'>" . $row['DESCRIPCION'] . "</option>";
                    }
                }
                ?>
            </select>
            </td>
            <td><input type="text" id="txtIdioma" class="form-control"></td>
        </tr>
    </table>
    <hr>
    <table id="tablaAcciones" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td><button type="button" class="btn btn-success" id="addCartaBtn" onclick="guardarCarta()">Agregar Carta</button></td>
            <td><button type="button" class="btn btn-warning" id="camposL" onclick="limpiarCampos1()">Limpiar campos</button></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><button type="button" class="btn btn-primary" id="compraventa" onclick=cerrarAñadir()>Cerrar</button></td>
            <td>&nbsp;</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    </table>
</div>
      </div>
        </div>
        <!-- DIV PARA AGREGAR EXPANSIONES -->
        <div id="expansionesAdd" style="margin-top: 20px; display: none;">
        <div class="card mx-auto" style="width: 86rem; margin-top:80px;" id="tcgs" style="display: none;">
    <div class="card-header d-flex justify-content-between">
    <h5 class="mb-0">Añadir Expansiones</h5>
  </div>
        <div id="comodatoCompra">
    <table id="tablaDatosUnidad" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>NOMBRE EXPANSIÓN</td>
            <td>NOMBRE CORTO</td>
            <td>FECHA DE LANZAMIENTO</td>
        </tr>
        <tr>
            <td><input type="text" id="txtNomExpan" class="form-control"></td>
            <td><input type="text" id="txtNomCorto" class="form-control" maxlength="3"></td>
            <td><input type="text" id="datepicker" class="form-control" readonly></td>
        </tr>
    </table>
    <hr>
    <table id="tablaAcciones" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td><button type="button" class="btn btn-success" id="comodato" onclick="agregar_expanP()">Agregar Expansión</button></td>
            <td><button type="button" class="btn btn-primary" id="compraventa" onclick=cerrarAddEx()>Cerrar</button></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    </table>
</div>
      </div>
        </div>
        <!--FIN DEL DIV = AGREGAR CARTAS-->
    <!--INICIO DEL DIV = EDITAR CARTAS-->
    <div id="editarCartas" style="display: none;">
    <div class="card mx-auto" style="width: 86rem; margin-top:80px;" id="tcgs" style="display: none;">
    <div class="card-header d-flex justify-content-between">
    <h5 class="mb-0" style="display: inline-block;">Actualizar Cartas</h5>
    <div class="input-container" style="margin-left: 600px; display: inline-block;">
        <input type="text" name="buscaCard" id="buscaCard" class="input" placeholder="Buscar carta...">
        <div id="coincidencias"></div>
        <span class="icon"> 
            <svg width="19px" height="19px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="1" d="M14 5H20" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="1" d="M14 8H17" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M21 11.5C21 16.75 16.75 21 11.5 21C6.25 21 2 16.75 2 11.5C2 6.25 6.25 2 11.5 2" stroke="#000" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="1" d="M22 22L20 20" stroke="#000" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
        </span>
    </div>
  </div>
        <div id="comodatoCompra">
    <table id="tablaDatosUnidad" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>CARTA</td>
            <td>PRECIO</td>
            <td>CANTIDAD</td>
        </tr>
        <tr>
        <input type="hidden" id="id_carta_encontrada" class="form-control">
            <td><input type="text" id="txtNomCartaEdit" class="form-control"></td>
            <td><input type="text" class="form-control" id="txtPrecioEdit" onkeyup="validarNumeros(event)"></td>
            <td><input type="number" class="form-control" id="txtCantidEdit" onkeyup="validarNumeros(event)"></td>
        </tr>
    </table>
    <hr>
    <table id="tablaDatosSocio2" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>CONDICIÓN</td>
            <td>IDIOMA</td>
        </tr>
        <tr>
            <td>
            <select class="form-select" id="condi_carta_edit">
                <option value="0" selected>Seleccionar...</option>
                <?php
                $sql = "SELECT * FROM CONDICIONES_CARTAS";
                $result = $conn->query($sql);
                // Verifica si hay resultados
                if ($result && $result->num_rows > 0) {
                    // Itera sobre los resultados y genera las opciones
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['DECRIP_CORTO'] . "'>" . $row['DESCRIPCION'] . "</option>";
                    }
                }
                ?>
            </select>
            </td>
            <td><input type="text" id="txtIdiomaEdit" class="form-control"></td>
        </tr>
    </table>
    <hr>
    <table id="tablaAcciones" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td><button type="button" class="btn btn-success" id="comodato" onclick="actualizar_cartas()">Actualizar Carta</button></td>
            <td><button type="button" class="btn btn-warning" id="comodatoNuevo" onclick="limpiarCampos2()">Limpiar campos</button></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><button type="button" class="btn btn-primary" id="compraventa" onclick=cerrarEditar()>Cerrar</button></td>
            <td>&nbsp;</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    </table>
</div>
      </div>
    </div>
    <!-- Div para editar las expansiones -->
    <div id="expansionesEdit" style="margin-top: 20px; display: none;">
        <div class="card mx-auto" style="width: 86rem; margin-top:80px;" id="tcgs" style="display: none;">
    <div class="card-header d-flex justify-content-between">
    <h5 class="mb-0">Editar Expansiones</h5>
    <div class="input-container" style="margin-left: 600px; display: inline-block;">
        <input type="text" name="buscaExpan" id="buscaExpan" class="input" placeholder="Buscar expansión...">
        <div id="coincidencias_expan"></div>
        <span class="icon"> 
            <svg width="19px" height="19px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="1" d="M14 5H20" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="1" d="M14 8H17" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M21 11.5C21 16.75 16.75 21 11.5 21C6.25 21 2 16.75 2 11.5C2 6.25 6.25 2 11.5 2" stroke="#000" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="1" d="M22 22L20 20" stroke="#000" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
        </span>
    </div>
  </div>
        <div id="comodatoCompra">
    <table id="tablaDatosUnidad" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>NOMBRE EXPANSIÓN</td>
            <td>NOMBRE CORTO</td>
            <td>FECHA DE LANZAMIENTO</td>
        </tr>
        <tr>
        <input type="hidden" id="id_expansion_encontrada" class="form-control">
            <td><input type="text" id="txtNomExpan_2" class="form-control"></td>
            <td><input type="text" id="txtNomCorto_2" class="form-control" maxlength="3"></td>
            <td><input type="text" id="datepicker_2" class="form-control"></td>
        </tr>
    </table>
    <hr>
    <table id="tablaAcciones" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td><button type="button" class="btn btn-warning" id="comodato" onclick="actualizar_expan()">Actualizar Expansión</button></td>
            <td><button type="button" class="btn btn-primary" id="compraventa" onclick=cerrarEditEx()>Cerrar</button></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    </table>
</div>
      </div>
        </div>
<!-- fin del div para editar expansiones -->
            <div id="botonesUsu" style="display: none;">
    <button id="btnadd" class="btn btn-outline-success button-flotante" type="button" onclick="addUsua()">
            <span style="background-image: url('../assets/img/add.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
            A&ntilde;adir
        </button>
        <button id="btneditUsua" class="btn btn-outline-primary button-flotante" type="button" onclick="modificarUusario()">
            <span style="background-image: url('../assets/img/edit.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
            Editar
        </button>
        <button id="btnclose" class="btn btn-outline-warning button-flotante" type="button" onclick="cerrarAccionesUsu()">
            <span style="background-image: url('../assets/img/close.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
            Cerrar
        </button>
        </div>
    <!-- EMPIEZA POKE -->
                <!-- AGREGAR CARTAS DE POKE -->
    <div id="crudCartasAddP" style="margin-top: 5px; display: none;">
        <div class="card mx-auto" style="width: 86rem; margin-top:30px;" id="tcgs" style="display: none;">
    <div class="card-header d-flex justify-content-between">
    <h5 class="mb-0">Añadir Cartas</h5>
    </div>
        <div id="comodatoCompra">
    <table id="tablaDatosUnidad" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>CARTA</td>
            <td>EXPANSIÓN</td>
        </tr>
        <tr>
            <td><input type="text" id="txtNomCartaP" class="form-control"></td>
            <td>
                <select name="cbExpansionP" id="cbExpansionP" class="form-control">
                    <option value="0" selected>Seleccionar...</option>
                    <?php
                    $sql = "SELECT * FROM sets_poke order by FECHA_LANZ DESC";
                    $result = $conn->query($sql);
                    // Verifica si hay resultados
                    if ($result && $result->num_rows > 0) {
                        // Itera sobre los resultados y genera las opciones
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['NOMBRE_CORTO'] . "'>" . $row['NOMBRE_SET'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
    </table>
    <hr>
    <table id="tablaDesc" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>PRECIO</td>
            <td>CANTIDAD</td>
            <td>FOIL</td>
        </tr>
        <tr>
            <td><input type="text" class="form-control" id="txtPrecioP" onkeyup="validarNumeros(event)"></td>
            <td><input type="number" class="form-control" id="txtCantidP" onkeyup="validarNumeros(event)"></td>
            <td>
                <select id="tipoFoilP" class="form-control">
                <option selected value="0">Seleccionar....</option>
                    <option value="F">FOIL</option>
                    <option value="N">NO FOIL</option>
                </select>
            </td>
        </tr>
    </table>
    <hr>
    <table id="tablaDatosSocio2" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>CONDICIÓN</td>
            <td>IDIOMA</td>
            <td>NÚMERO COLECCIÓN</td>
        </tr>
        <tr>
            <td>
            <select class="form-select" id="condi_cartaP">
                <option value="0" selected>Seleccionar...</option>
                <?php
                $sql = "SELECT * FROM CONDICIONES_CARTAS";
                $result = $conn->query($sql);
                // Verifica si hay resultados
                if ($result && $result->num_rows > 0) {
                    // Itera sobre los resultados y genera las opciones
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['DECRIP_CORTO'] . "'>" . $row['DESCRIPCION'] . "</option>";
                    }
                }
                ?>
            </select>
            </td>
            <td><input type="text" id="txtIdiomaP" class="form-control"></td>
            <td><input type="number" id="txtNumColP" class="form-control" onkeyup="validarNumeros(event)"></td>
        </tr>
    </table>
    <hr>
    <table id="tablaAcciones" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td><button type="button" class="btn btn-success" id="addCartaBtn" onclick="guardarCartaP()">Agregar Carta</button></td>
            <td><button type="button" class="btn btn-warning" id="camposL" onclick="limpiarCamposP()">Limpiar campos</button></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><button type="button" class="btn btn-primary" id="compraventa" onclick=cerrarAñadirP()>Cerrar</button></td>
            <td>&nbsp;</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    </table>
</div>
      </div>
        </div>
    <!-- editar CARTAS DE POKE -->
<!--INICIO DEL DIV = EDITAR CARTAS-->
<div id="editarCartasP" style="display: none;">
    <div class="card mx-auto" style="width: 86rem; margin-top:80px;" id="tcgs" style="display: none;">
    <div class="card-header d-flex justify-content-between">
    <h5 class="mb-0" style="display: inline-block;">Actualizar Cartas</h5>
    <div class="input-container" style="margin-left: 600px; display: inline-block;">
        <input type="text" name="buscaCardP" id="buscaCardP" class="input" placeholder="Buscar carta...">
        <div id="coincidenciasPoke"></div>
        <span class="icon"> 
            <svg width="19px" height="19px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="1" d="M14 5H20" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="1" d="M14 8H17" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M21 11.5C21 16.75 16.75 21 11.5 21C6.25 21 2 16.75 2 11.5C2 6.25 6.25 2 11.5 2" stroke="#000" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="1" d="M22 22L20 20" stroke="#000" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
        </span>
    </div>
  </div>
        <div id="comodatoCompra">
    <table id="tablaDatosUnidad" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>CARTA</td>
        </tr>
        <tr>
        <input type="hidden" id="id_carta_encontradaP" class="form-control">
            <td><input type="text" id="txtNomCartaEditP" class="form-control" readonly></td>
        </tr>
    </table>
    <hr>
    <table id="tablaDesc" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>PRECIO</td>
            <td>CANTIDAD</td>
        </tr>
        <tr>
        <tr>
            <td><input type="text" class="form-control" id="txtPrecioEditP" onkeyup="validarNumeros(event)"></td>
            <td><input type="number" class="form-control" id="txtCantidEditP" onkeyup="validarNumeros(event)"></td>
        </tr>
    </table>
    <hr>
    <table id="tablaDatosSocio2" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>CONDICIÓN</td>
            <td>IDIOMA</td>
        </tr>
        <tr>
            <td>
            <select class="form-select" id="condi_carta_editP">
                <option value="0" selected>Seleccionar...</option>
                <?php
                $sql = "SELECT * FROM CONDICIONES_CARTAS";
                $result = $conn->query($sql);
                // Verifica si hay resultados
                if ($result && $result->num_rows > 0) {
                    // Itera sobre los resultados y genera las opciones
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['DECRIP_CORTO'] . "'>" . $row['DESCRIPCION'] . "</option>";
                    }
                }
                ?>
            </select>
            </td>
            <td><input type="text" id="txtIdiomaEditP" class="form-control"></td>
        </tr>
    </table>
    <hr>
    <table id="tablaAcciones" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td><button type="button" class="btn btn-success" id="comodato" onclick="actualizar_cartasP()">Actualizar Carta</button></td>
            <td><button type="button" class="btn btn-warning" id="comodatoNuevo" onclick="limpiarCamposP2()">Limpiar campos</button></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><button type="button" class="btn btn-primary" id="compraventa" onclick=cerrarEditarP()>Cerrar</button></td>
            <td>&nbsp;</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    </table>
</div>
      </div>
    </div>
        <!-- DIV PARA AGREGAR EXPANSIONES -->
        <div id="expansionesAddP" style="display: none;">
        <div class="card mx-auto" style="width: 86rem; margin-top:80px;" id="tcgs" style="display: none;">
    <div class="card-header d-flex justify-content-between">
    <h5 class="mb-0">Añadir Expansiones</h5>
  </div>
        <div id="comodatoCompra">
    <table id="tablaDatosUnidad" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>NOMBRE EXPANSIÓN</td>
            <td>NOMBRE CORTO</td>
            <td>FECHA DE LANZAMIENTO</td>
        </tr>
        <tr>
            <td><input type="text" id="txtNomExpanP" class="form-control"></td>
            <td><input type="text" id="txtNomCortoP" class="form-control" maxlength="3"></td>
            <td><input type="text" id="datepickerP" class="form-control" readonly></td>
        </tr>
    </table>
    <hr>
    <table id="tablaAcciones" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td><button type="button" class="btn btn-success" id="comodato" onclick="agregar_expanP()">Agregar Expansión</button></td>
            <td><button type="button" class="btn btn-primary" id="compraventa" onclick=cerrarAddExP()>Cerrar</button></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    </table>
</div>
      </div>
        </div>

            <!-- Div para editar las expansiones -->
    <div id="expansionesEditP" style="margin-top: 20px; display: none;">
        <div class="card mx-auto" style="width: 86rem; margin-top:80px;" id="tcgs" style="display: none;">
    <div class="card-header d-flex justify-content-between">
    <h5 class="mb-0">Editar Expansiones Poke</h5>
    <div class="input-container" style="margin-left: 600px; display: inline-block;">
        <input type="text" name="buscaExpanP" id="buscaExpanP" class="input" placeholder="Buscar expansión...">
        <div id="coincidencias_expanP"></div>
        <span class="icon"> 
            <svg width="19px" height="19px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="1" d="M14 5H20" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="1" d="M14 8H17" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M21 11.5C21 16.75 16.75 21 11.5 21C6.25 21 2 16.75 2 11.5C2 6.25 6.25 2 11.5 2" stroke="#000" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="1" d="M22 22L20 20" stroke="#000" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
        </span>
    </div>
  </div>
        <div id="comodatoCompra">
    <table id="tablaDatosUnidad" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>NOMBRE EXPANSIÓN</td>
            <td>NOMBRE CORTO</td>
            <td>FECHA DE LANZAMIENTO</td>
        </tr>
        <tr>
        <input type="hidden" id="id_expansion_encontradaP" class="form-control">
            <td><input type="text" id="txtNomExpan_2P" class="form-control"></td>
            <td><input type="text" id="txtNomCorto_2P" class="form-control" maxlength="3"></td>
            <td><input type="text" id="datepicker_2P" class="form-control"></td>
        </tr>
    </table>
    <hr>
    <table id="tablaAcciones" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td><button type="button" class="btn btn-warning" id="comodato" onclick="actualizar_expanP()">Actualizar Expansión</button></td>
            <td><button type="button" class="btn btn-primary" id="compraventa" onclick=cerrarEditExP()>Cerrar</button></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    </table>
</div>
      </div>
        </div>
        <!-- TERMINA POKIMON -->
           <!-- EMPIEZA YUGI -->
                <!-- AGREGAR CARTAS DE YUGI -->
    <div id="crudCartasAddY" style="margin-top: 5px; display: none;">
        <div class="card mx-auto" style="width: 86rem; margin-top:30px;" id="tcgsY" style="display: none;">
    <div class="card-header d-flex justify-content-between">
    <h5 class="mb-0">Añadir Cartas</h5>
    </div>
        <div id="comodatoCompra">
    <table id="tablaDatosUnidad" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>CARTA</td>
            <td>EXPANSIÓN</td>
            <td>RAREZA</td>
        </tr>
        <tr>
            <td><input type="text" id="txtNomCartaY" class="form-control"></td>
            <td>
                <select name="cbExpansionY" id="cbExpansionY" class="form-control">
                    <option value="0" selected>Seleccionar...</option>
                    <?php
                    $sql = "SELECT * FROM sets_yugi";
                    $result = $conn->query($sql);
                    // Verifica si hay resultados
                    if ($result && $result->num_rows > 0) {
                        // Itera sobre los resultados y genera las opciones
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['NOMBRE_CORTO'] . "'>" . $row['NOMBRE_SET'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </td>
            <td>
                <select class="form-select" id="cboRarezaY">
                    <option value="0">Seleccionar...</option>
                    <option value="C">COMMON</option>
                    <option value="R">RARE</option>
                    <option value="S">SUPER RARE</option>
                    <option value="U">ULTIMATE RARE</option>
                    <option value="P">PARALLEL RARE</option>
                </select>
            </td>
        </tr>
    </table>
    <hr>
    <table id="tablaDesc" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>PRECIO</td>
            <td>CANTIDAD</td>
            <td>ARTISTA</td>
            <td>FOIL</td>
            <td>IMAGEN</td>
        </tr>
        <tr>
            <td><input type="text" class="form-control" id="txtPrecioY" onkeyup="validarNumeros(event)"></td>
            <td><input type="number" class="form-control" id="txtCantidY" onkeyup="validarNumeros(event)"></td>
            <td><input type="text" id="txtArtistaY" class="form-control"></td>
            <td>
                <select id="tipoFoilY" class="form-control">
                <option selected value="0">Seleccionar....</option>
                    <option value="F">FOIL</option>
                    <option value="N">NO FOIL</option>
                </select>
            </td>
            <td>
                <form id="fileUploadFormY" enctype="multipart/form-data" style="margin-top: 15px;">
                    <input type="file" name="fileToUploadY" id="fileToUploadY" class="form-control">
                </form>
            </td>
        </tr>
    </table>
    <hr>
    <table id="tablaDatosSocio2" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>CONDICIÓN</td>
            <td>IDIOMA</td>
            <td>NÚMERO COLECCIÓN</td>
            <td>TEXTO CARTA</td>
        </tr>
        <tr>
            <td>
            <select class="form-select" id="condi_cartaY">
                <option value="0" selected>Seleccionar...</option>
                <?php
                $sql = "SELECT * FROM CONDICIONES_CARTAS";
                $result = $conn->query($sql);
                // Verifica si hay resultados
                if ($result && $result->num_rows > 0) {
                    // Itera sobre los resultados y genera las opciones
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['DECRIP_CORTO'] . "'>" . $row['DESCRIPCION'] . "</option>";
                    }
                }
                ?>
            </select>
            </td>
            <td><input type="text" id="txtIdiomaY" class="form-control"></td>
            <td><input type="number" id="txtNumColY" class="form-control" onkeyup="validarNumeros(event)"></td>
            <td>
                <textarea class="form-control" placeholder="Texto de la Carta" id="floatingTextareaY" style="height: 100px"></textarea>
            </td>
        </tr>
    </table>
    <hr>
    <table id="tablaAcciones" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td><button type="button" class="btn btn-success" id="addCartaBtn" onclick="guardarCartaY()">Agregar Carta</button></td>
            <td><button type="button" class="btn btn-warning" id="camposL" onclick="limpiarCamposY()">Limpiar campos</button></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><button type="button" class="btn btn-primary" id="compraventa" onclick=cerrarAñadirY()>Cerrar</button></td>
            <td>&nbsp;</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    </table>
</div>
      </div>
        </div>
    <!-- editar CARTAS DE YUGI -->
<!--INICIO DEL DIV = EDITAR CARTAS-->
<div id="editarCartasY" style="display: none;">
    <div class="card mx-auto" style="width: 86rem; margin-top:80px;" id="tcgs" style="display: none;">
    <div class="card-header d-flex justify-content-between">
    <h5 class="mb-0" style="display: inline-block;">Actualizar Cartas</h5>
    <div class="input-container" style="margin-left: 600px; display: inline-block;">
        <input type="text" name="buscaCardY" id="buscaCardY" class="input" placeholder="Buscar carta...">
        <div id="coincidenciasY"></div>
        <span class="icon"> 
            <svg width="19px" height="19px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="1" d="M14 5H20" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="1" d="M14 8H17" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M21 11.5C21 16.75 16.75 21 11.5 21C6.25 21 2 16.75 2 11.5C2 6.25 6.25 2 11.5 2" stroke="#000" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="1" d="M22 22L20 20" stroke="#000" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
        </span>
    </div>
  </div>
        <div id="comodatoCompra">
    <table id="tablaDatosUnidad" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>CARTA</td>
            <td>EXPANSIÓN</td>
            <td>RAREZA</td>
        </tr>
        <tr>
        <input type="hidden" id="id_carta_encontradaY" class="form-control">
            <td><input type="text" id="txtNomCartaEditY" class="form-control"></td>
            <td>
                <select name="cbExpansion" id="cbExpansionEditY" class="form-control">
                <option value="0" selected>Seleccionar...</option>
                    <?php
                    $sqlExpa = "SELECT * FROM sets_yugi";
                    $resultExpa = $conn->query($sqlExpa);
                    // Verifica si hay resultados
                    if ($resultExpa && $resultExpa->num_rows > 0) {
                        // Itera sobre los resultados y genera las opciones
                        while($row = $resultExpa->fetch_assoc()) {
                            echo "<option value='" . $row['NOMBRE_CORTO'] . "'>" . $row['NOMBRE_SET'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </td>
            <td>
                <select class="form-select" id="rarezaEditY">
                    <option value="0">Seleccionar...</option>
                    <option value="C">COMMON</option>
                    <option value="R">RARE</option>
                    <option value="S">SUPER RARE</option>
                    <option value="U">ULTIMATE RARE</option>
                    <option value="P">PARALLEL RARE</option>
                </select>
            </td>
        </tr>
    </table>
    <hr>
    <table id="tablaDesc" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>PRECIO</td>
            <td>CANTIDAD</td>
            <td>ARTISTA</td>
            <td>FOIL</td>
        </tr>
        <tr>
        <tr>
            <td><input type="text" class="form-control" id="txtPrecioEditY" onkeyup="validarNumeros(event)"></td>
            <td><input type="number" class="form-control" id="txtCantidEditY" onkeyup="validarNumeros(event)"></td>
            <td><input type="text" id="txtArtistaEditY" class="form-control"></td>
            <td>
                <select id="tipoFoilEditY" class="form-control">
                <option selected value="0">Seleccionar....</option>
                    <option value="F">FOIL</option>
                    <option value="N">NO FOIL</option>
                </select>
            </td>
        </tr>
    </table>
    <hr>
    <table id="tablaDatosSocio2" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>CONDICIÓN</td>
            <td>IDIOMA</td>
            <td>TEXTO</td>
        </tr>
        <tr>
            <td>
            <select class="form-select" id="condi_carta_editY">
                <option value="0" selected>Seleccionar...</option>
                <?php
                $sql = "SELECT * FROM CONDICIONES_CARTAS";
                $result = $conn->query($sql);
                // Verifica si hay resultados
                if ($result && $result->num_rows > 0) {
                    // Itera sobre los resultados y genera las opciones
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['DECRIP_CORTO'] . "'>" . $row['DESCRIPCION'] . "</option>";
                    }
                }
                ?>
            </select>
            </td>
            <td><input type="text" id="txtIdiomaEditY" class="form-control"></td>
            <td>
                <textarea class="form-control" placeholder="Texto de la Carta" id="floatingTextareaEditY" style="height: 100px"></textarea>
            </td>
        </tr>
    </table>
    <hr>
    <table id="tablaAcciones" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td><button type="button" class="btn btn-success" id="comodato" onclick="actualizar_cartasY()">Actualizar Carta</button></td>
            <td><button type="button" class="btn btn-warning" id="comodatoNuevo" onclick="limpiarCamposY2()">Limpiar campos</button></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><button type="button" class="btn btn-primary" id="compraventa" onclick=cerrarEditarY()>Cerrar</button></td>
            <td>&nbsp;</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    </table>
</div>
      </div>
    </div>
        <!-- DIV PARA AGREGAR EXPANSIONES -->
        <div id="expansionesAddYug" style="display: none;">
        <div class="card mx-auto" style="width: 86rem; margin-top:80px;" id="tcgs" style="display: none;">
    <div class="card-header d-flex justify-content-between">
    <h5 class="mb-0">Añadir Expansiones</h5>
  </div>
        <div id="comodatoCompra">
    <table id="tablaDatosUnidad" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>NOMBRE EXPANSIÓN</td>
            <td>NOMBRE CORTO</td>
            <td>FECHA DE LANZAMIENTO</td>
        </tr>
        <tr>
            <td><input type="text" id="txtNomExpanY" class="form-control"></td>
            <td><input type="text" id="txtNomCortoY" class="form-control" maxlength="3"></td>
            <td><input type="text" id="datepickerY" class="form-control" readonly></td>
        </tr>
    </table>
    <hr>
    <table id="tablaAcciones" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td><button type="button" class="btn btn-success" id="comodato" onclick="agregar_expanY()">Agregar Expansión</button></td>
            <td><button type="button" class="btn btn-primary" id="compraventa" onclick=cerrarAddExY()>Cerrar</button></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    </table>
</div>
      </div>
        </div>

            <!-- Div para editar las expansiones -->
    <div id="expansionesEditY" style="margin-top: 20px; display: none;">
        <div class="card mx-auto" style="width: 86rem; margin-top:80px;" id="tcgs" style="display: none;">
    <div class="card-header d-flex justify-content-between">
    <h5 class="mb-0">Editar Expansiones</h5>
    <div class="input-container" style="margin-left: 600px; display: inline-block;">
        <input type="text" name="buscaExpanY" id="buscaExpanY" class="input" placeholder="Buscar expansión...">
        <div id="coincidencias_expanY"></div>
        <span class="icon"> 
            <svg width="19px" height="19px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="1" d="M14 5H20" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="1" d="M14 8H17" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M21 11.5C21 16.75 16.75 21 11.5 21C6.25 21 2 16.75 2 11.5C2 6.25 6.25 2 11.5 2" stroke="#000" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="1" d="M22 22L20 20" stroke="#000" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
        </span>
    </div>
  </div>
        <div id="comodatoCompra">
    <table id="tablaDatosUnidad" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>NOMBRE EXPANSIÓN</td>
            <td>NOMBRE CORTO</td>
            <td>FECHA DE LANZAMIENTO</td>
        </tr>
        <tr>
        <input type="hidden" id="id_expansion_encontradaY" class="form-control">
            <td><input type="text" id="txtNomExpan_2Y" class="form-control"></td>
            <td><input type="text" id="txtNomCorto_2Y" class="form-control" maxlength="3"></td>
            <td><input type="text" id="datepicker_2Y" class="form-control"></td>
        </tr>
    </table>
    <hr>
    <table id="tablaAcciones" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td><button type="button" class="btn btn-warning" id="comodato" onclick="actualizar_expanY()">Actualizar Expansión</button></td>
            <td><button type="button" class="btn btn-primary" id="compraventa" onclick=cerrarEditExY()>Cerrar</button></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    </table>
</div>
      </div>
        </div>
        <!-- TERMINA YUGI -->
                    <!-- EMPIEZA LORCANA -->
                <!-- AGREGAR CARTAS DE LORCANA -->
    <div id="crudCartasAddL" style="margin-top: 5px; display: none;">
        <div class="card mx-auto" style="width: 86rem; margin-top:30px;" id="tcgsL" style="display: none;">
    <div class="card-header d-flex justify-content-between">
    <h5 class="mb-0">Añadir Cartas</h5>
    </div>
        <div id="comodatoCompra">
    <table id="tablaDatosUnidad" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>CARTA</td>
            <td>EXPANSIÓN</td>
            <td>RAREZA</td>
        </tr>
        <tr>
            <td><input type="text" id="txtNomCartaL" class="form-control"></td>
            <td>
                <select name="cbExpansionY" id="cbExpansionL" class="form-control">
                    <option value="0" selected>Seleccionar...</option>
                    <?php
                    $sql = "SELECT * FROM sets_lorcana";
                    $result = $conn->query($sql);
                    // Verifica si hay resultados
                    if ($result && $result->num_rows > 0) {
                        // Itera sobre los resultados y genera las opciones
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['NOMBRE_CORTO'] . "'>" . $row['NOMBRE_SET'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </td>
            <td>
                <select class="form-select" id="cboRarezaL">
                    <option value="0">Seleccionar...</option>
                    <option value="C">COMMON</option>
                    <option value="U">UNCOMMON</option>
                    <option value="R">RARE</option>
                    <option value="S">SUPER RARE</option>
                    <option value="L">LEGENDARY</option>
                    <option value="E">ENCHANTED</option>
                    <option value="P">PROMO</option>
                </select>
            </td>
        </tr>
    </table>
    <hr>
    <table id="tablaDesc" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>PRECIO</td>
            <td>CANTIDAD</td>
            <td>ARTISTA</td>
            <td>FOIL</td>
            <td>IMAGEN</td>
        </tr>
        <tr>
            <td><input type="text" class="form-control" id="txtPrecioL" onkeyup="validarNumeros(event)"></td>
            <td><input type="number" class="form-control" id="txtCantidL" onkeyup="validarNumeros(event)"></td>
            <td><input type="text" id="txtArtistaL" class="form-control"></td>
            <td>
                <select id="tipoFoilL" class="form-control">
                <option selected value="0">Seleccionar....</option>
                    <option value="F">FOIL</option>
                    <option value="N">NO FOIL</option>
                </select>
            </td>
            <td>
                <form id="fileUploadFormL" enctype="multipart/form-data" style="margin-top: 15px;">
                    <input type="file" name="fileToUploadL" id="fileToUploadL" class="form-control">
                </form>
            </td>
        </tr>
    </table>
    <hr>
    <table id="tablaDatosSocio2" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>CONDICIÓN</td>
            <td>IDIOMA</td>
            <td>NÚMERO COLECCIÓN</td>
            <td>TEXTO CARTA</td>
        </tr>
        <tr>
            <td>
            <select class="form-select" id="condi_cartaL">
                <option value="0" selected>Seleccionar...</option>
                <?php
                $sql = "SELECT * FROM CONDICIONES_CARTAS";
                $result = $conn->query($sql);
                // Verifica si hay resultados
                if ($result && $result->num_rows > 0) {
                    // Itera sobre los resultados y genera las opciones
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['DECRIP_CORTO'] . "'>" . $row['DESCRIPCION'] . "</option>";
                    }
                }
                ?>
            </select>
            </td>
            <td><input type="text" id="txtIdiomaL" class="form-control"></td>
            <td><input type="number" id="txtNumColL" class="form-control" onkeyup="validarNumeros(event)"></td>
            <td>
                <textarea class="form-control" placeholder="Texto de la Carta" id="floatingTextareaL" style="height: 100px"></textarea>
            </td>
        </tr>
    </table>
    <hr>
    <table id="tablaAcciones" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td><button type="button" class="btn btn-success" id="addCartaBtn" onclick="guardarCartaL()">Agregar Carta</button></td>
            <td><button type="button" class="btn btn-warning" id="camposL" onclick="limpiarCamposL()">Limpiar campos</button></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><button type="button" class="btn btn-primary" id="compraventa" onclick=cerrarAñadirL()>Cerrar</button></td>
            <td>&nbsp;</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    </table>
</div>
      </div>
        </div>
    <!-- editar CARTAS DE lorcana -->
<!--INICIO DEL DIV = EDITAR CARTAS-->
<div id="editarCartasL" style="display: none;">
    <div class="card mx-auto" style="width: 86rem; margin-top:80px;" id="tcgs" style="display: none;">
    <div class="card-header d-flex justify-content-between">
    <h5 class="mb-0" style="display: inline-block;">Actualizar Cartas</h5>
    <div class="input-container" style="margin-left: 600px; display: inline-block;">
        <input type="text" name="buscaCardL" id="buscaCardL" class="input" placeholder="Buscar carta...">
        <div id="coincidenciasL"></div>
        <span class="icon"> 
            <svg width="19px" height="19px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="1" d="M14 5H20" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="1" d="M14 8H17" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M21 11.5C21 16.75 16.75 21 11.5 21C6.25 21 2 16.75 2 11.5C2 6.25 6.25 2 11.5 2" stroke="#000" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="1" d="M22 22L20 20" stroke="#000" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
        </span>
    </div>
  </div>
        <div id="comodatoCompra">
    <table id="tablaDatosUnidad" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>CARTA</td>
            <td>EXPANSIÓN</td>
            <td>RAREZA</td>
        </tr>
        <tr>
        <input type="hidden" id="id_carta_encontradaL" class="form-control">
            <td><input type="text" id="txtNomCartaEditL" class="form-control"></td>
            <td>
                <select name="cbExpansion" id="cbExpansionEditL" class="form-control">
                <option value="0" selected>Seleccionar...</option>
                    <?php
                    $sqlExpa = "SELECT * FROM sets_lorcana";
                    $resultExpa = $conn->query($sqlExpa);
                    // Verifica si hay resultados
                    if ($resultExpa && $resultExpa->num_rows > 0) {
                        // Itera sobre los resultados y genera las opciones
                        while($row = $resultExpa->fetch_assoc()) {
                            echo "<option value='" . $row['NOMBRE_CORTO'] . "'>" . $row['NOMBRE_SET'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </td>
            <td>
                <select class="form-select" id="rarezaEditL">
                    <option value="0">Seleccionar...</option>
                    <option value="C">COMMON</option>
                    <option value="U">UNCOMMON</option>
                    <option value="R">RARE</option>
                    <option value="S">SUPER RARE</option>
                    <option value="L">LEGENDARY</option>
                    <option value="E">ENCHANTED</option>
                    <option value="P">PROMO</option>
                </select>
            </td>
        </tr>
    </table>
    <hr>
    <table id="tablaDesc" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>PRECIO</td>
            <td>CANTIDAD</td>
            <td>ARTISTA</td>
            <td>FOIL</td>
        </tr>
        <tr>
        <tr>
            <td><input type="text" class="form-control" id="txtPrecioEditL" onkeyup="validarNumeros(event)"></td>
            <td><input type="number" class="form-control" id="txtCantidEditL" onkeyup="validarNumeros(event)"></td>
            <td><input type="text" id="txtArtistaEditL" class="form-control"></td>
            <td>
                <select id="tipoFoilEditL" class="form-control">
                <option selected value="0">Seleccionar....</option>
                    <option value="F">FOIL</option>
                    <option value="N">NO FOIL</option>
                </select>
            </td>
        </tr>
    </table>
    <hr>
    <table id="tablaDatosSocio2" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>CONDICIÓN</td>
            <td>IDIOMA</td>
            <td>TEXTO</td>
        </tr>
        <tr>
            <td>
            <select class="form-select" id="condi_carta_editL">
                <option value="0" selected>Seleccionar...</option>
                <?php
                $sql = "SELECT * FROM CONDICIONES_CARTAS";
                $result = $conn->query($sql);
                // Verifica si hay resultados
                if ($result && $result->num_rows > 0) {
                    // Itera sobre los resultados y genera las opciones
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['DECRIP_CORTO'] . "'>" . $row['DESCRIPCION'] . "</option>";
                    }
                }
                ?>
            </select>
            </td>
            <td><input type="text" id="txtIdiomaEditL" class="form-control"></td>
            <td>
                <textarea class="form-control" placeholder="Texto de la Carta" id="floatingTextareaEditL" style="height: 100px"></textarea>
            </td>
        </tr>
    </table>
    <hr>
    <table id="tablaAcciones" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td><button type="button" class="btn btn-success" id="comodato" onclick="actualizar_cartasL()">Actualizar Carta</button></td>
            <td><button type="button" class="btn btn-warning" id="comodatoNuevo" onclick="limpiarCamposL2()">Limpiar campos</button></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><button type="button" class="btn btn-primary" id="compraventa" onclick=cerrarEditarL()>Cerrar</button></td>
            <td>&nbsp;</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    </table>
</div>
      </div>
    </div>
        <!-- DIV PARA AGREGAR EXPANSIONES -->
        <div id="expansionesAddLor" style="display: none;">
        <div class="card mx-auto" style="width: 86rem; margin-top:80px;" id="tcgs" style="display: none;">
    <div class="card-header d-flex justify-content-between">
    <h5 class="mb-0">Añadir Expansiones</h5>
  </div>
        <div id="comodatoCompra">
    <table id="tablaDatosUnidad" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>NOMBRE EXPANSIÓN</td>
            <td>NOMBRE CORTO</td>
            <td>FECHA DE LANZAMIENTO</td>
        </tr>
        <tr>
            <td><input type="text" id="txtNomExpanL" class="form-control"></td>
            <td><input type="text" id="txtNomCortoL" class="form-control" maxlength="3"></td>
            <td><input type="text" id="datepickerL" class="form-control" readonly></td>
        </tr>
    </table>
    <hr>
    <table id="tablaAcciones" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td><button type="button" class="btn btn-success" id="lorcanaEx" onclick="agregar_expanL()">Agregar Expansión</button></td>
            <td><button type="button" class="btn btn-primary" id="compraventa" onclick=cerrarAddExL()>Cerrar</button></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    </table>
</div>
      </div>
        </div>

            <!-- Div para editar las expansiones -->
    <div id="expansionesEditLor" style="margin-top: 20px; display: none;">
        <div class="card mx-auto" style="width: 86rem; margin-top:80px;" id="tcgs" style="display: none;">
    <div class="card-header d-flex justify-content-between">
    <h5 class="mb-0">Editar Expansiones</h5>
    <div class="input-container" style="margin-left: 600px; display: inline-block;">
        <input type="text" name="buscaExpanL" id="buscaExpanL" class="input" placeholder="Buscar expansión...">
        <div id="coincidencias_expanL"></div>
        <span class="icon"> 
            <svg width="19px" height="19px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="1" d="M14 5H20" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="1" d="M14 8H17" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M21 11.5C21 16.75 16.75 21 11.5 21C6.25 21 2 16.75 2 11.5C2 6.25 6.25 2 11.5 2" stroke="#000" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="1" d="M22 22L20 20" stroke="#000" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
        </span>
    </div>
  </div>
        <div id="comodatoCompra">
    <table id="tablaDatosUnidad" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>NOMBRE EXPANSIÓN</td>
            <td>NOMBRE CORTO</td>
            <td>FECHA DE LANZAMIENTO</td>
        </tr>
        <tr>
        <input type="hidden" id="id_expansion_encontradaL" class="form-control">
            <td><input type="text" id="txtNomExpan_2L" class="form-control"></td>
            <td><input type="text" id="txtNomCorto_2L" class="form-control" maxlength="3"></td>
            <td><input type="text" id="datepicker_2L" class="form-control"></td>
        </tr>
    </table>
    <hr>
    <table id="tablaAcciones" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td><button type="button" class="btn btn-warning" id="comodato" onclick="actualizar_expanL()">Actualizar Expansión</button></td>
            <td><button type="button" class="btn btn-primary" id="compraventa" onclick=cerrarEditExL()>Cerrar</button></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    </table>
</div>
      </div>
        </div>
        <!-- TERMINA lorcana -->
         <!-- EMPIEZA OP -->
                <!-- AGREGAR CARTAS DE OP -->
    <div id="crudCartasAddOP" style="margin-top: 5px; display: none;">
        <div class="card mx-auto" style="width: 86rem; margin-top:30px;" id="tcgsL" style="display: none;">
    <div class="card-header d-flex justify-content-between">
    <h5 class="mb-0">Añadir Cartas</h5>
    </div>
        <div id="comodatoCompra">
    <table id="tablaDatosUnidad" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>CARTA</td>
            <td>EXPANSIÓN</td>
            <td>RAREZA</td>
        </tr>
        <tr>
            <td><input type="text" id="txtNomCartaOP" class="form-control"></td>
            <td>
                <select name="cbExpansionOp" id="cbExpansionOp" class="form-control">
                    <option value="0" selected>Seleccionar...</option>
                    <?php
                    $sql = "SELECT * FROM sets_lorcana";
                    $result = $conn->query($sql);
                    // Verifica si hay resultados
                    if ($result && $result->num_rows > 0) {
                        // Itera sobre los resultados y genera las opciones
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['NOMBRE_CORTO'] . "'>" . $row['NOMBRE_SET'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </td>
            <td>
                <select class="form-select" id="cboRarezaOp">
                    <option value="0">Seleccionar...</option>
                    <option value="C">COMMON</option>
                    <option value="U">UNCOMMON</option>
                    <option value="R">RARE</option>
                    <option value="S">SUPER RARE</option>
                    <option value="L">LEGENDARY</option>
                    <option value="E">ENCHANTED</option>
                    <option value="P">PROMO</option>
                </select>
            </td>
        </tr>
    </table>
    <hr>
    <table id="tablaDesc" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>PRECIO</td>
            <td>CANTIDAD</td>
            <td>ARTISTA</td>
            <td>FOIL</td>
            <td>IMAGEN</td>
        </tr>
        <tr>
            <td><input type="text" class="form-control" id="txtPrecioOp" onkeyup="validarNumeros(event)"></td>
            <td><input type="number" class="form-control" id="txtCantidOp" onkeyup="validarNumeros(event)"></td>
            <td><input type="text" id="txtArtistaOp" class="form-control"></td>
            <td>
                <select id="tipoFoilOp" class="form-control">
                <option selected value="0">Seleccionar....</option>
                    <option value="F">FOIL</option>
                    <option value="N">NO FOIL</option>
                </select>
            </td>
            <td>
                <form id="fileUploadFormOp" enctype="multipart/form-data" style="margin-top: 15px;">
                    <input type="file" name="fileToUploadL" id="fileToUploadL" class="form-control">
                </form>
            </td>
        </tr>
    </table>
    <hr>
    <table id="tablaDatosSocio2" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>CONDICIÓN</td>
            <td>IDIOMA</td>
            <td>NÚMERO COLECCIÓN</td>
            <td>TEXTO CARTA</td>
        </tr>
        <tr>
            <td>
            <select class="form-select" id="condi_cartaOp">
                <option value="0" selected>Seleccionar...</option>
                <?php
                $sql = "SELECT * FROM CONDICIONES_CARTAS";
                $result = $conn->query($sql);
                // Verifica si hay resultados
                if ($result && $result->num_rows > 0) {
                    // Itera sobre los resultados y genera las opciones
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['DECRIP_CORTO'] . "'>" . $row['DESCRIPCION'] . "</option>";
                    }
                }
                ?>
            </select>
            </td>
            <td><input type="text" id="txtIdiomaOp" class="form-control"></td>
            <td><input type="number" id="txtNumColOp" class="form-control" onkeyup="validarNumeros(event)"></td>
            <td>
                <textarea class="form-control" placeholder="Texto de la Carta" id="floatingTextareaOp" style="height: 100px"></textarea>
            </td>
        </tr>
    </table>
    <hr>
    <table id="tablaAcciones" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td><button type="button" class="btn btn-success" id="addCartaBtn" onclick="guardarCartaOp()">Agregar Carta</button></td>
            <td><button type="button" class="btn btn-warning" id="camposL" onclick="limpiarCamposOp()">Limpiar campos</button></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><button type="button" class="btn btn-primary" id="compraventa" onclick=cerrarAñadirOp()>Cerrar</button></td>
            <td>&nbsp;</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    </table>
</div>
      </div>
        </div>
    <!-- editar CARTAS DE One Piece -->
<!--INICIO DEL DIV = EDITAR CARTAS-->
<div id="editarCartasOp" style="display: none;">
    <div class="card mx-auto" style="width: 86rem; margin-top:80px;" id="tcgs" style="display: none;">
    <div class="card-header d-flex justify-content-between">
    <h5 class="mb-0" style="display: inline-block;">Actualizar Cartas</h5>
    <div class="input-container" style="margin-left: 600px; display: inline-block;">
        <input type="text" name="buscaCardOp" id="buscaCardL" class="input" placeholder="Buscar carta...">
        <div id="coincidenciasOp"></div>
        <span class="icon"> 
            <svg width="19px" height="19px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="1" d="M14 5H20" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="1" d="M14 8H17" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M21 11.5C21 16.75 16.75 21 11.5 21C6.25 21 2 16.75 2 11.5C2 6.25 6.25 2 11.5 2" stroke="#000" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="1" d="M22 22L20 20" stroke="#000" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
        </span>
    </div>
  </div>
        <div id="comodatoCompra">
    <table id="tablaDatosUnidad" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>CARTA</td>
            <td>EXPANSIÓN</td>
            <td>RAREZA</td>
        </tr>
        <tr>
        <input type="hidden" id="id_carta_encontradaOp" class="form-control">
            <td><input type="text" id="txtNomCartaEditOp" class="form-control"></td>
            <td>
                <select name="cbExpansion" id="cbExpansionEditOp" class="form-control">
                <option value="0" selected>Seleccionar...</option>
                    <?php
                    $sqlExpa = "SELECT * FROM sets_lorcana";
                    $resultExpa = $conn->query($sqlExpa);
                    // Verifica si hay resultados
                    if ($resultExpa && $resultExpa->num_rows > 0) {
                        // Itera sobre los resultados y genera las opciones
                        while($row = $resultExpa->fetch_assoc()) {
                            echo "<option value='" . $row['NOMBRE_CORTO'] . "'>" . $row['NOMBRE_SET'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </td>
            <td>
                <select class="form-select" id="rarezaEditOp">
                    <option value="0">Seleccionar...</option>
                    <option value="C">COMMON</option>
                    <option value="U">UNCOMMON</option>
                    <option value="R">RARE</option>
                    <option value="S">SUPER RARE</option>
                    <option value="L">LEGENDARY</option>
                    <option value="E">ENCHANTED</option>
                    <option value="P">PROMO</option>
                </select>
            </td>
        </tr>
    </table>
    <hr>
    <table id="tablaDesc" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>PRECIO</td>
            <td>CANTIDAD</td>
            <td>ARTISTA</td>
            <td>FOIL</td>
        </tr>
        <tr>
        <tr>
            <td><input type="text" class="form-control" id="txtPrecioEditOp" onkeyup="validarNumeros(event)"></td>
            <td><input type="number" class="form-control" id="txtCantidEditOp" onkeyup="validarNumeros(event)"></td>
            <td><input type="text" id="txtArtistaEditOp" class="form-control"></td>
            <td>
                <select id="tipoFoilEditOp" class="form-control">
                <option selected value="0">Seleccionar....</option>
                    <option value="F">FOIL</option>
                    <option value="N">NO FOIL</option>
                </select>
            </td>
        </tr>
    </table>
    <hr>
    <table cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>CONDICIÓN</td>
            <td>IDIOMA</td>
            <td>TEXTO</td>
        </tr>
        <tr>
            <td>
            <select class="form-select" id="condi_carta_editOp">
                <option value="0" selected>Seleccionar...</option>
                <?php
                $sql = "SELECT * FROM CONDICIONES_CARTAS";
                $result = $conn->query($sql);
                // Verifica si hay resultados
                if ($result && $result->num_rows > 0) {
                    // Itera sobre los resultados y genera las opciones
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['DECRIP_CORTO'] . "'>" . $row['DESCRIPCION'] . "</option>";
                    }
                }
                ?>
            </select>
            </td>
            <td><input type="text" id="txtIdiomaEditOp" class="form-control"></td>
            <td>
                <textarea class="form-control" placeholder="Texto de la Carta" id="floatingTextareaEditOp" style="height: 100px"></textarea>
            </td>
        </tr>
    </table>
    <hr>
    <table id="tablaAcciones" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td><button type="button" class="btn btn-success" id="comodato" onclick="actualizar_cartasOp()">Actualizar Carta</button></td>
            <td><button type="button" class="btn btn-warning" id="comodatoNuevo" onclick="limpiarCamposLOp()">Limpiar campos</button></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><button type="button" class="btn btn-primary" id="compraventa" onclick=cerrarEditarOp()>Cerrar</button></td>
            <td>&nbsp;</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    </table>
</div>
      </div>
    </div>
        <!-- DIV PARA AGREGAR EXPANSIONES -->
        <div id="expansionesAddOp" style="display: none;">
        <div class="card mx-auto" style="width: 86rem; margin-top:80px;" id="tcgs" style="display: none;">
    <div class="card-header d-flex justify-content-between">
    <h5 class="mb-0">Añadir Expansiones</h5>
  </div>
        <div>
    <table cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>NOMBRE EXPANSIÓN</td>
            <td>NOMBRE CORTO</td>
            <td>FECHA DE LANZAMIENTO</td>
        </tr>
        <tr>
            <td><input type="text" id="txtNomExpanOp" class="form-control"></td>
            <td><input type="text" id="txtNomCortoOp" class="form-control" maxlength="3"></td>
            <td><input type="text" id="datepickerOp" class="form-control" readonly></td>
        </tr>
    </table>
    <hr>
    <table id="tablaAcciones" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td><button type="button" class="btn btn-success" id="lorcanaEx" onclick="agregar_expanOp()">Agregar Expansión</button></td>
            <td><button type="button" class="btn btn-primary" id="compraventa" onclick=cerrarAddExOp()>Cerrar</button></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    </table>
</div>
      </div>
        </div>

            <!-- Div para editar las expansiones -->
    <div id="expansionesEditOp" style="margin-top: 20px; display: none;">
        <div class="card mx-auto" style="width: 86rem; margin-top:80px;" id="tcgs" style="display: none;">
    <div class="card-header d-flex justify-content-between">
    <h5 class="mb-0">Editar Expansiones</h5>
    <div class="input-container" style="margin-left: 600px; display: inline-block;">
        <input type="text" name="buscaExpanOp" id="buscaExpanL" class="input" placeholder="Buscar expansión...">
        <div id="coincidencias_expanOp"></div>
        <span class="icon"> 
            <svg width="19px" height="19px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="1" d="M14 5H20" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="1" d="M14 8H17" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M21 11.5C21 16.75 16.75 21 11.5 21C6.25 21 2 16.75 2 11.5C2 6.25 6.25 2 11.5 2" stroke="#000" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="1" d="M22 22L20 20" stroke="#000" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
        </span>
    </div>
  </div>
        <div id="comodatoCompra">
    <table id="tablaDatosUnidad" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>NOMBRE EXPANSIÓN</td>
            <td>NOMBRE CORTO</td>
            <td>FECHA DE LANZAMIENTO</td>
        </tr>
        <tr>
        <input type="hidden" id="id_expansion_encontradaOp" class="form-control">
            <td><input type="text" id="txtNomExpan_2Op" class="form-control"></td>
            <td><input type="text" id="txtNomCorto_2Op" class="form-control" maxlength="3"></td>
            <td><input type="text" id="datepicker_2Op" class="form-control"></td>
        </tr>
    </table>
    <hr>
    <table id="tablaAcciones" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td><button type="button" class="btn btn-warning" id="comodato" onclick="actualizar_expanOp()">Actualizar Expansión</button></td>
            <td><button type="button" class="btn btn-primary" id="compraventa" onclick=cerrarEditExOp()>Cerrar</button></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    </table>
</div>
      </div>
        </div>
        <!-- TERMINA OP -->
    <!--DIV PARA AGREGAR USUARIOS-->
    <div id="addUsu" style="display: none;">
    <div class="card mx-auto" style="width: 86rem; margin-top:80px;" id="tcgs" style="display: none;">
    <div class="card-header d-flex justify-content-between">
    <h5 class="mb-0" style="display: inline-block;">Añadir Usuario</h5>
    </div>
        <div id="comodatoCompra">
    <table id="tablaDatosUnidad" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>NOMBRE</td>
            <td>CORREO</td>
            <td>CONTRASEÑA</td>
            <td>TIPO DE USUARIO</td>
        </tr>
        <tr>
            <td><input type="text" id="txtNomUsA" class="form-control"></td>
            <td><input type="text" id="txtcorreoA" class="form-control"></td>
            <td><input type="password" id="txtPasswA" class="form-control"></td>
            <td>
                <select class="form-select" id="tipo_usuA">
                    <option value="0">Seleccionar...</option>
                    <option value="2">EMPLEADO</option>
                    <option value="3">CLIENTE</option>
                    <option value="4">ADMINISTRADOR</option>
                </select>
            </td>
        </tr>
    </table>
    <hr>
    <table id="tablaAcciones" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td><button type="button" class="btn btn-success" id="agregar_usuario" onclick="addUsuarioN()">Agregar Usuario</button></td>
            <td><button type="button" class="btn btn-warning" id="limpiar" onclick="limpiarCamposU()">Limpiar campos</button></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><button type="button" class="btn btn-primary" id="compraventa" onclick=cerrarAddU()>Cerrar</button></td>
            <td>&nbsp;</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    </table>
</div>
      </div>
    </div>
    <!-- FIN PARA LAS ACCIONES DE POKE -->
    <!--DIV PARA MODIFICAR LOS DATOS DEL USUARIO-->
    <div id="modifiUsu" style="display: none;">
    <div class="card mx-auto" style="width: 86rem; margin-top:80px;" id="tcgs" style="display: none;">
    <div class="card-header d-flex justify-content-between">
    <h5 class="mb-0" style="display: inline-block;">Modificar Usuario</h5>
    <div class="input-container" style="margin-left: 600px; display: inline-block;">
        <input type="text" name="text" class="input" name="buscaUsu" id="buscaUsu" placeholder="Buscar usuario...">
        <div id="coincidencias_usuario"></div>
        <span class="icon"> 
            <svg width="19px" height="19px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="1" d="M14 5H20" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="1" d="M14 8H17" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M21 11.5C21 16.75 16.75 21 11.5 21C6.25 21 2 16.75 2 11.5C2 6.25 6.25 2 11.5 2" stroke="#000" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="1" d="M22 22L20 20" stroke="#000" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
        </span>
    </div>
  </div>
        <div id="comodatoCompra">
        <table id="tablaDatosUnidad" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>ID_USUARIO</td>
            <td>NOMBRE</td>
            <td>CORREO</td>
            <td>CONTRASEÑA</td>
            <td>TIPO DE USUARIO</td>
            <td>ESTATUS</td>
        </tr>
        <tr>
            <td><input type="text" id="txtId_usE" class="form-control" readonly></td>
            <td><input type="text" id="txtNomUsE" class="form-control"></td>
            <td><input type="text" id="txtCorreoE" class="form-control"></td>
            <td><input type="text" id="txtPasswE" class="form-control"></td>
            <td>
                <select class="form-select" id="tipo_usuE">
                    <option value="0">Seleccionar...</option>
                    <option value="2">EMPLEADO</option>
                    <option value="3">CLIENTE</option>
                    <option value="4">ADMINISTRADOR</option>
                </select>
            </td>
            <td>
                <select class="form-select" id="estatus_EditUsu">
                    <option value="0">Seleccionar...</option>
                    <option value="1">ACTIVO</option>
                    <option value="2">INACTIVO</option>
                </select>
            </td>
        </tr>
    </table>
    <hr>
    <table id="tablaAcciones" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td><button type="button" class="btn btn-success" id="comodato" onclick="guardarDataUsu()">Modificar Usuario</button></td>
            <td><button type="button" class="btn btn-warning" id="comodatoNuevo" onclick="limpiarCamposEditU()">Limpiar campos</button></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><button type="button" class="btn btn-primary" id="compraventa" onclick=cerrarModusua()>Cerrar</button></td>
            <td>&nbsp;</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    </table>
    </div>
      </div>
    </div>
    <!-- BOTONES PARA OTROS PRODUCTOS: -->
    <div id="accionesProductos" style="display: none;">
                <div style="margin-top: 10px">
                <button id="btnadd" class="btn btn-outline-success button-flotante" type="button" onclick="mostrarProductosAdd()">
                    <span style="background-image: url('../assets/img/add.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                    A&ntilde;adir
                </button>
                <button id="btnedit" class="btn btn-outline-primary button-flotante" type="button" onclick="mostrarProductosEdd()">
                    <span style="background-image: url('../assets/img/edit.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                    Editar
                </button>
                <button id="btnInventario" class="btn btn-outline-info button-flotante" type="button" onclick="mostrarInventarioProd()">
                    <span style="background-image: url('../assets/img/magic.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                    Inventario
                </button>
                <button id="btnclose" class="btn btn-outline-warning button-flotante" type="button" onclick="ocultarnavProd()">
                    <span style="background-image: url('../assets/img/close.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                    Cerrar
                </button>
                </div>
        </div>
<!-- FIN BOTONES -->
    <!-- PARA AÑADIR OTROS PRODUCTOS -->
    <div id="productos_otros" style="display: none;">
        <div class="card mx-auto" style="width: 86rem; margin-top:80px;" id="tcgs" style="display: none;">
    <div class="card-header d-flex justify-content-between">
    <h5 class="mb-0">Añadir Otros Productos</h5>
  </div>
        <div id="comodatoCompra">
    <table id="tablaDatosUnidad" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>NOMBRE DEL PRODUCTO</td>
            <td>TIPO DE PRODUCTO</td>
            <td>JUEGO TCG</td>
        </tr>
        <tr>
            <td><input type="text" id="txtNomProd" class="form-control"></td>
            <td><!-- SE LLENA CON TIPO DE PRODUCTOS -->
                <select name="cbTipo_prod" id="cbTipo_prod" class="form-control">
                    <option value="0" selected>Seleccionar...</option>
                    <option value="2">Sellado</option>
                    <option value="3">Micas</option>
                    <option value="4">Dados</option>
                    <option value="5">Juego de mesa</option>
                    <option value="6">Carpetas</option>
                    <option value="7">Deckbox</option>
                    <option value="8">Playmath</option>
                </select>
            </td>
            <td>
                <select name="juego_tcg" id="juego_tcg" class="form-control">
                    <option value="0" selected>Seleccionar...</option>
                    <option value="99">Sin TCG</option>
                    <option value="1">MTG</option>
                    <option value="2">Pokémon</option>
                    <option value="3">Yu gi oh!</option>
                </select>
            </td>
        </tr>
    </table>
    <hr>
    <table id="tablaDesc" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>PRECIO</td>
            <td>CANTIDAD</td>
            <td>IMAGEN</td>
            <td>DESCRIPCIÓN</td>
        </tr>
        <tr>
            <td><input type="text" class="form-control" id="txtPrecio_prod" onkeyup="validarNumeros(event)"></td>
            <td><input type="number" class="form-control" id="txtCantid_prod" onkeyup="validarNumeros(event)"></td>
            <td>
                <form id="fileUploadForm" enctype="multipart/form-data" style="margin-top: 15px;">
                    <input type="file" name="fileToUpload_prod" id="fileToUpload_prod" class="form-control">
                </form>
            </td>
            <td><textarea class="form-control" placeholder="Descipción del Producto" id="floatingTextarea2_prod" style="height: 100px"></textarea></td>
        </tr>
    </table>
    <hr>
    <table id="tablaAcciones" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td><button type="button" class="btn btn-success" id="addProdBtn" onclick="guardarProducto()">Agregar Producto</button></td>
            <td><button type="button" class="btn btn-warning" id="camposProd" onclick="limpiarCampos5()">Limpiar campos</button></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><button type="button" class="btn btn-primary" id="productosC" onclick=cerrarProductos()>Cerrar</button></td>
            <td>&nbsp;</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    </table>
</div>
      </div>
        </div>
        <!-- FIN -> PARA AÑADIR OTROS PRODUCTOS -->
        <!-- INICIO -> PARA EDITAR OTROS PRODUCTOS -->
        <div id="productos_otros_editar" style="display: none;">
        <div class="card mx-auto" style="width: 86rem; margin-top:80px;" id="tcgs" style="display: none;">
    <div class="card-header d-flex justify-content-between">
    <h5 class="mb-0">Actualizar Productos</h5>
    <div class="input-container" style="margin-left: 600px; display: inline-block;">
        <input type="text" name="buscaProd" id="buscaProd" class="input" placeholder="Buscar producto...">
        <div id="coincidencias_prod"></div>
        <span class="icon"> 
            <svg width="19px" height="19px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="1" d="M14 5H20" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="1" d="M14 8H17" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M21 11.5C21 16.75 16.75 21 11.5 21C6.25 21 2 16.75 2 11.5C2 6.25 6.25 2 11.5 2" stroke="#000" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="1" d="M22 22L20 20" stroke="#000" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
        </span>
    </div>
  </div>
        <div id="comodatoCompra">
    <table id="tablaDatosUnidad" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>NOMBRE DEL PRODUCTO</td>
            <td>TIPO DE PRODUCTO</td>
            <td>COLOR</td>
            <td>CÓDIGO DE BARRAS</td>
        </tr>
        <tr>
            <td><input type="text" id="txtNomProd2" class="form-control"></td>
            <td><!-- SE LLENA CON TIPO DE PRODUCTOS -->
                <select name="cbTipo_prod" id="cbTipo_prod2" class="form-control">
                    <option value="0" selected>Seleccionar...</option>
                    <?php
                    
                    // Verifica si hay resultados
                    if ($resultExpa && $resultExpa->num_rows > 0) {
                        // Itera sobre los resultados y genera las opciones
                        while($row = $resultExpa->fetch_assoc()) {
                            echo "<option value='" . $row['NOMBRE_CORTO'] . "'>" . $row['NOMBRE_EXP'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </td>
            <td><input type="text" id="txtColor2" class="form-control"></td>
            <td><input type="text" id="txtBarras2" class="form-control"></td>
        </tr>
    </table>
    <hr>
    <table id="tablaDesc" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>PRECIO</td>
            <td>CANTIDAD</td>
            <td>DESCRIPCIÓN</td>
        </tr>
        <tr>
            <td><input type="text" class="form-control" id="txtPrecio_prod2" onkeyup="validarNumeros(event)"></td>
            <td><input type="number" class="form-control" id="txtCantid_prod2" onkeyup="validarNumeros(event)"></td>
            <td><textarea class="form-control" placeholder="Descipción del Producto" id="floatingTextarea2_prod2" style="height: 100px"></textarea></td>
        </tr>
    </table>
    <hr>
    <table id="tablaAcciones" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td><button type="button" class="btn btn-success" id="addProdBtn" onclick="editarProducto()">Editar Producto</button></td>
            <td><button type="button" class="btn btn-warning" id="camposProd" onclick="limpiarCampos6()">Limpiar campos</button></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><button type="button" class="btn btn-primary" id="productosC" onclick=cerrarProductos2()>Cerrar</button></td>
            <td>&nbsp;</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    </table>
</div>
      </div>
        </div>
        <!-- FIN -> PARA EDITAR OTROS PRODUCTOS -->
        <!-- INICIO PARA VER LOS PEDIDOS Y ACTUALIZARLOS -->
        <div id="pedidosAdmin" style="display: none;">
        <div>
                <div style="margin-top: 10px">
                <button id="btnclose" class="btn btn-outline-warning button-flotante" type="button" onclick="cerrarPedidos2()">
                    <span style="background-image: url('../assets/img/close.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                    Cerrar
                </button>
                </div>
        </div>
    <div class="card mx-auto" style="width: 94rem; margin-top:20px;" id="pedidos_todos">
    <div class="card-header d-flex justify-content-between align-items-center">
    <!-- Título de la tarjeta -->
    <h5 class="mb-0">Pedidos</h5>
    
    <!-- Contenedor de filtros y búsqueda -->
<div class="d-flex ml-auto">
    <!-- Filtro de pedidos -->
    <div class="d-flex align-items-center mr-4"> <!-- Ajuste del margen aquí -->
        <label for="filtroPedidos" class="mr-2 mb-0">Filtrar por:</label>
        <select id="filtroPedidos" class="form-control" onchange="filtrarPedidosVendedor()">
            <option value="0">Todos</option>
            <option value="1">En proceso</option>
            <option value="2">Enviado</option>
            <option value="3">Entregado en tienda</option>
            <option value="4">Cancelado</option>
        </select>
    </div>
    
</div>

</div>

        <div id="datos_pedidos">
        <table id="tabla_pedidos" class="table table-striped-columns table-hover">
            <thead>
                <tr class="table-primary">
                    <th>No. PEDIDO</th>
                    <th>TIPO DE PEDIDO</th>
                    <th>DIRECCIÓN</th>
                    <th>CLIENTE</th>
                    <th>NUM TEL</th>
                    <th>COMENTARIOS</th>
                    <th>ARTICULOS</th>
                    <th>FECHA</th>
                    <th>ESTATUS</th>
                    <th>ACTUALIZAR</th>
                </tr>
            </thead>
            <tbody id="cuerpo_tabla_pedidos">
                <!-- Aquí se generará el cuerpo de la tabla dinámicamente -->
            </tbody>
        </table>
        </div>
      </div>
    </div>
    <!-- PARA ACTUALIZAR LOS DATOS DEL USUARIO -->
    <div id="datosUsuario" style="display: none;">
        <div class="card mx-auto" style="width: 86rem; margin-top:80px;" id="tcgs" style="display: none;">
    <div class="card-header d-flex justify-content-between">
    <h4 class="mb-0">Actualizar Datos</h4>
    </div>
        <div id="comodatoCompra">
    <table cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
      <div class="card-header d-flex justify-content-between">
        <h5 class="mb-0">Datos personales</h5>
      </div>
        <tr>
            <td>NOMBRE</td>
            <td>APELLIDO PATERNO</td>
            <td>APELLIDO MATERNO</td>
            <td>FECHA DE NACIMIENTO</td>
        </tr>
        <tr>
            <td><input type="text" id="txtNomCliente" class="form-control"  maxlength="150" value="<?=isset($rowUs['NOMBRE']) ? $rowUs['NOMBRE'] : '';?>"></td>
            <td><input type="text" id="txtApePat" class="form-control"  maxlength="100" value="<?=isset($rowUs['APELLIDO_PATERNO']) ? $rowUs['APELLIDO_PATERNO'] : '';?>"></td>
            <td><input type="text" id="txtApeMat" class="form-control"  maxlength="100" value="<?=isset($rowUs['APELLIDO_MATERNO']) ? $rowUs['APELLIDO_MATERNO'] : '';?>"></td>
            <td><input type="text" id="datepicker_cli" class="form-control" value="<?=isset($rowUs['FECHA_NAC']) ? $rowUs['FECHA_NAC'] : '';?>"></td>
        </tr>
    </table>
    <table cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
      <div class="card-header d-flex justify-content-between">
      </div>
        <tr>
            <td>NUM TELEFONO</td>
            <td>RFC</td>
            <td>BANCO</td>
            <td>NUM CUENTA</td>
        </tr>
        <tr>
            
        <td><input type="text" onkeyup="validarNumeros(event)" id="txtNumCliente"  maxlength="30" class="form-control" value="<?=isset($rowUs['NUM_TELEFONO']) ? $rowUs['NUM_TELEFONO'] : '';?>"></td>
        <td><input type="text" maxlength="15" id="txtRfc" class="form-control" value="<?=isset($rowUs['RFC']) ? $rowUs['RFC'] : '';?>"></td>
        <td><input type="text" id="txtBancoCliente"  maxlength="100" class="form-control" value="<?=isset($rowUs['BANCO']) ? $rowUs['BANCO'] : '';?>"></td>
        <td><input type="text" maxlength="16" onkeyup="validarNumeros(event)" id="txtNumCCuenta" class="form-control" value="<?=isset($rowUs['NUM_CUENTA']) ? $rowUs['NUM_CUENTA'] : '';?>"></td>
        </tr>
    </table>
    <hr>
    <hr>
                <table id="tablaDesc" cellpadding="0" cellspacing="0" width="100%" border="0">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="mb-0">Dirección</h5>
                    </div>
                    <tr>
                        <td>CALLE</td>
                        <td>NÚMERO EXTERIOR</td>
                        <td>NÚMERO INTERIOR</td>
                        <td>COLONIA</td>
                        <td>CÓDIGO POSTAL</td>
                    </tr>
                    <tr>
                        <td><input  maxlength="100" type="text" class="form-control" id="txtCalle" value="<?= isset($rowUs['CALLE']) ? $rowUs['CALLE'] : ''; ?>"></td>
                        <td><input  maxlength="10" type="number" class="form-control" id="txtNumEx" value="<?= isset($rowUs['NUM_EXTERIOR']) ? $rowUs['NUM_EXTERIOR'] : ''; ?>"></td>
                        <td><input  maxlength="5" type="text" id="txtNumInt" class="form-control" placeholder="Opcional" value="<?= isset($rowUs['NUM_INTERIOR']) ? $rowUs['NUM_INTERIOR'] : ''; ?>"></td>
                        <td><input  maxlength="100" type="text" id="txtColonia" class="form-control" value="<?= isset($rowUs['COLONIA']) ? $rowUs['COLONIA'] : ''; ?>"></td>
                        <td><input  maxlength="5" type="text" id="txtCp" class="form-control" value="<?= isset($rowUs['CODIGO_POSTAL']) ? $rowUs['CODIGO_POSTAL'] : ''; ?>"></td>
                    </tr>
                </table>
                <hr>
                <table id="tablaDesc" cellpadding="0" cellspacing="0" width="100%" border="0">
                    <tr>
                        <td>&nbsp;</td>
                        <td>CIUDAD</td>
                        <td>PAÍS</td>
                        <td>ESTADO</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="text"  maxlength="100" class="form-control" id="txtCiudad" value="<?= isset($rowUs['CIUDAD']) ? $rowUs['CIUDAD'] : ''; ?>"></td>
                        <td><input type="text" id="txtPais" value="México" readonly class="form-control" value="<?= isset($rowUs['PAIS']) ? $rowUs['PAIS'] : ''; ?>"></td>
                        <td>
                            <select name="cbExpansion" id="cboEstado" class="form-control">
                                <option value="0" selected>Seleccionar...</option>
                                <?php
                                    $sqlExpa = "SELECT * FROM estados";
                                    $resultExpa = $conn->query($sqlExpa);

                                    // Verifica si hay resultados
                                    if ($resultExpa && $resultExpa->num_rows > 0) {
                                        // Itera sobre los resultados y genera las opciones
                                        while($row = $resultExpa->fetch_assoc()) {
                                            // Verifica si el estado actual coincide con el valor en $rowUs['ESTADO']
                                            $selected = ($row['ID_ESTADO'] == $rowUs['ESTADO']) ? 'selected' : '';
                                            
                                            echo "<option value='" . $row['ID_ESTADO'] . "' $selected>" . $row['NOMBRE_ESTADO'] . "</option>";
                                        }
                                    }
                                    ?>
                            </select>
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                </table>
                <hr>
    <table id="tablaAcciones" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td><button type="button" class="btn btn-success" id="guardarDatos" onclick="guardarDatosUsu()">Actualizar Datos</button></td>
            <td><button type="button" class="btn btn-primary" onclick=cierra_usuario()>Cerrar</button></td>
            <td>&nbsp;</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    </table>
</div>
      </div>
        </div>
<!-- Acciones para los decks -->  
        <div id="accionesDecks" style="display: none;">
                <div style="margin-top: 10px">
                <button id="btnadd" class="btn btn-outline-success button-flotante" type="button" onclick="mostrarAddDeck()">
                    <span style="background-image: url('../assets/img/add.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                    A&ntilde;adir
                </button>
                <button id="btnedit" class="btn btn-outline-primary button-flotante" type="button" onclick="mostrarEditarDecks()">
                    <span style="background-image: url('../assets/img/edit.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                    Editar
                </button>
                <button id="btnInventario" class="btn btn-outline-info button-flotante" type="button" onclick="mostrarReservas()">
                    <span style="background-image: url('../assets/img/magic.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                    Reservas
                </button>
                <button id="btnclose" class="btn btn-outline-warning button-flotante" type="button" onclick="cerrarAccionesDecks()">
                    <span style="background-image: url('../assets/img/close.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                    Cerrar
                </button>
                </div>
        </div>
<!-- Para cargar un nuevo deck -->
<div id="agregarDeck" style="margin-top: 20px; display: none;">
        <div class="card mx-auto" style="width: 86rem; margin-top:80px;" id="tcgs" style="display: none;">
    <div class="card-header d-flex justify-content-between">
    <h5 class="mb-0">Agregar Deck</h5>
  </div>
        <div id="comodatoCompra">
    <table id="tablaDatosUnidad" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>NOMBRE DECK</td>
            <td>FORMATO</td>
            <td>LISTA CARTAS</td>
        </tr>
        <tr>
            <td><input type="text" id="nom_deck" class="form-control"></td>
            <td>
            <select class="form-select" id="formato_deck">
                    <option value="0">Seleccionar...</option>
                    <option value="1">Standard</option>
                    <option value="2">Modern</option>
                    <option value="3">Vintage</option>
                    <option value="4">Commander</option>
                    <option value="5">Pauper</option>
                    <option value="6">Brawl</option>
                    <option value="7">Peasant</option>
                    <option value="8">Old School</option>
                </select>
            </td>
            <td><input type="file" id="lista_deck" class="form-control"></td>
        </tr>
    </table>
    <hr>
    <table id="tablaAcciones" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td><button type="button" class="btn btn-warning" id="comodato" onclick="addDeck()">Agregar Deck</button></td>
            <td><button type="button" class="btn btn-primary" id="compraventa" onclick=cerrar_decksAcciones()>Cerrar</button></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    </table>
</div>
      </div>
        </div>
        <!-- fin para cargar un nuevo deck -->
<!-- Para editar un deck -->
<div id="editarDeck" style="margin-top: 20px; display: none;">
        <div class="card mx-auto" style="width: 86rem; margin-top:10px;" style="display: none;">
    <div class="card-header d-flex justify-content-between">
    <h5 class="mb-0">Editar Deck</h5> 
    <div class="col-md-8">
            <!-- Barra de búsqueda -->
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Buscar deck..." id="buscaDeck" name="buscaDeck">
            </div>
            <div id="coincidencias_decks"></div>
        </div>
        <div id="botonAgCdeck"></div>
    <button type="button" class="btn btn-warning float-end" onclick="cerrarEditarDecks()">Cerrar</button>
  </div>
        <div id="cartasDeck"><!-- para poner la deck list a editar -->
        </div>
      </div>
</div>
        <!-- fin de editar decks -->
    </main>
    <!--PARA EL POS-->
    <div id="divPOS" style="display: none;margin-top: 20px;">
    <div class="container mt-4">
    <div class="row">
        <div class="col-md-8">
            <!-- Barra de búsqueda -->
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Buscar producto..." id="busprod" name="busprod">
            </div>
            <div id="coincidencias_producto"></div>
        </div>
        <div class="col-md-4 mt-2 mt-md-0 text-md-right">
        <button id="cerrarPos" class="btn btn-outline-success" type="button" onclick="cobrar()">
                <span style="background-image: url('../assets/img/pago.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                Cobrar
            </button>
            <button id="cerrarPos" class="btn btn-outline-primary" type="button" onclick="cierre_cajita()">
                <span style="background-image: url('../assets/img/caja.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                Cierre de caja
            </button>
            <button id="cerrarPos" class="btn btn-outline-warning button-flotante" type="button" onclick="cerrarPos()">
                <span style="background-image: url('../assets/img/close.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                Cerrar
            </button>
        </div>
    </div>
    </div>

<div class="container mt-4">
    <!-- Tabla de detalles de la transacción -->
    <div class="table-responsive">
        <table class="table" id="tabla_caja">
            <thead>
                <tr>
                    <th>CLAVE DEL PRODUCTO</th>
                    <th>NOMBRE DEL PRODUCTO</th>
                    <th>CANTIDAD</th>
                    <th>PRECIO</th>
                    <th>SUBTOTAL</th>
                </tr>
            </thead>
            <tbody>
                <!-- FILAS AÑADIDAS DINÁMICAMENTE -->
            </tbody>
        </table>
    </div>
</div>
<iframe id="ticketFrame" style="display:none;"></iframe><!-- para el ticket -->

    </div>
<!-- PARA EL INVENTARIO MTG -->
    <div id="divInvMtg" style="display: none;margin-top: 20px;">
            <button type="button" class="btn btn-warning float-end" onclick="cerrarInv()">Cerrar</button>
            <button type="button" class="btn btn-success float-end mx-2" onclick="exportarExcel()">Exportar</button>
        <div id="tableContainerMTG" class="container-fluid mt-3"></div>
    </div>

    <!-- PARA EL INVENTARIO POKE -->
    <div id="divInvPoke" style="display: none;margin-top: 20px;">
            <button type="button" class="btn btn-warning float-end" onclick="cerrarInvPoke()">Cerrar</button>
            <button type="button" class="btn btn-success float-end mx-2" onclick="exportarExcelPoke()">Exportar</button>
        <div id="tableContainerPOKE" class="container-fluid mt-3"></div>
    </div>

        <!-- PARA EL INVENTARIO Yugi -->
        <div id="divInvYugi" style="display: none;margin-top: 20px;">
            <button type="button" class="btn btn-warning float-end" onclick="cerrarInvYugi()">Cerrar</button>
            <button type="button" class="btn btn-success float-end mx-2" onclick="exportarExcelYugi()">Exportar</button>
        <div id="tableContainerYugi" class="container-fluid mt-3"></div>
    </div>

    <!-- PARA EL INVENTARIO lorcana -->
    <div id="divInvLorcana" style="display: none;margin-top: 20px;">
            <button type="button" class="btn btn-warning float-end" onclick="cerrarInvLor()">Cerrar</button>
            <button type="button" class="btn btn-success float-end mx-2" onclick="exportarExcelLor()">Exportar</button>
        <div id="tableContainerLorcana" class="container-fluid mt-3"></div>
    </div>

            <!-- PARA LAS RESERVAS DE DECKS -->
            <div id="divReservas" style="display: none;margin-top: 20px;">
                <button type="button" class="btn btn-warning float-end" onclick="cerrarReservas()">Cerrar</button>
                <div id="tableContainerReservas" class="container-fluid mt-3"></div>
            </div>