<?php
    // Verifica si el usuario ha iniciado sesión
    if (!isset($_SESSION['ID_USUARIO'])) {
        // Si no ha iniciado sesión, redirige a la página de inicio de sesión
        header("Location: sesion.php");
        exit();
    } 

    $tipo_usuario = $_SESSION['TIPO_USUARIO'];

    if ($tipo_usuario == 1 || $tipo_usuario == 4) {
        $display_style = "display: block;";
    } else {
        $display_style = "display: none;";
    }

    include('../db_connection.php');
/**consulta para obtener las condiciones de las cartas */

    $sql = "SELECT * FROM CONDICIONES_CARTAS";
    $result = $conn->query($sql);
/**consulta para obtener las expansioes de las cartas **/

    $sqlExpa = "SELECT * FROM expansiones_mtg order by FECHA_LANZ desc";
    $resultExpa = $conn->query($sqlExpa);

    $sqlExpaP = "SELECT * FROM sets_poke order by FECHA_LANZ desc";
    $resultExpaP = $conn->query($sqlExpaP);

/** CONSULTA PARA TRAER LOS DATOS **/    
$sqlCli = "SELECT * FROM persona where ID_USUARIO=".$_SESSION['ID_USUARIO'];
//echo $sqlCli;
$resultCli = $conn->query($sqlCli);

$alerta = 0;
if ($resultCli && $resultCli->num_rows > 0) {
    $rowUs = $resultCli->fetch_assoc();
} else {
    $alerta = 1;    
}

$cajita = isset($_SESSION['ID_CAJA']) ? $_SESSION['ID_CAJA'] : 0;

$oculto = ($cajita == 0) ? ' style="display:none !important;"' : '';

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
        <button id="btnCartas" class="btn btn-outline-primary button-flotante" type="button" onclick="cartasAcciones()" style="<?php echo $display_style; ?>">
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
        <button id="btnUsuarios" class="btn btn-outline-secondary button-flotante" type="button" onclick="otros_productos_acciones()" style="<?php echo $display_style; ?>">
            <span style="background-image: url('../assets/img/productos.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
            Otros productos
        </button>
        </div>
        <div>
        <button id="btnUsuarios" class="btn btn-outline-warning button-flotante" type="button" onclick="ver_pedidos()" >
            <span style="background-image: url('../assets/img/pedido.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
            Pedidos
        </button>
        </div>
        <div>
        <button id="btnVenta" class="btn btn-outline-info button-flotante" type="button" onclick="mostrarPos()" >
            <span style="background-image: url('../assets/img/carrito.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
            Punto Venta
        </button>
        </div>
        <div>
        <button id="btnVenta" class="btn btn-outline-success button-flotante" type="button" onclick="mostrarEvento()" >
            <span style="background-image: url('../assets/img/calendario.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
            Eventos
        </button>
        </div>
        <div>
        <button id="btnVenta" class="btn btn-outline-dark button-flotante" type="button" onclick="mostrarPrev()" >
            <i class="bi bi-currency-dollar"></i>
            Preventas
        </button>
        </div>
        <div>
        <button id="btnVenta" class="btn btn-outline-primary button-flotante" type="button" onclick="mostrarStripe()" >
            <i class="bi bi-wallet2"></i>
            Ventas
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
		<label>
			<input type="radio" name="radio" checked="" onclick="mostrartcgs()">
			<span>Magic the gathering</span>
		</label>
		<label>
			<input type="radio" name="radio" onclick="mostrarPoke()">
			<span>Pok&eacute;mon</span>
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
        <label>
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
		<label>
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
		<label>
			<input type="radio" name="radio" onclick="mostrarExpansionesY()">
			<span>EXPANSIONES</span>
		</label>
		<label>
			<input type="radio" name="radio" onclick="ocultarnavY()">
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
                <!-- <button id="btnedit" class="btn btn-outline-primary button-flotante" type="button" onclick="mostrarEditar()">
                    <span style="background-image: url('../assets/img/edit.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                    Editar
                </button> -->
                <button id="btnInventario" class="btn btn-outline-info button-flotante" type="button" onclick="mostrarInventarioMtg(0)">
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
                <button id="btnInventario" class="btn btn-outline-info button-flotante" type="button" onclick="mostrarInventarioPoke(0)">
                    <span style="background-image: url('../assets/img/magic.png'); background-size: cover; display: inline-block; width: 20px; height: 20px;"></span>
                    Inventario
                </button>
                <button id="btnclose" class="btn btn-outline-warning button-flotante" type="button" onclick="cerrarAccionesCartasP()">
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
            <td>Número de carta</td>
        </tr>
        <tr>
            <td><input type="text" id="txtNomCarta" class="form-control"></td>
            <td>
            <select class="form-select" id="cbExpansion">
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
        <td><input type="text" id="txtNumCol" class="form-control" onkeyup="validarNumeros(event)"></td>
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
                        echo "<option value='" . $row['DECRIP_CORTO'] . "'>" . $row['DECRIP_CORTO'] . "</option>";
                    }
                }
                ?>
            </select>
            </td>
            <td>
                <select id="txtIdioma" class="form-control">
                    <option selected value="0">Seleccionar....</option>
                        <option value="EN">Inglés</option>
                        <option value="SP">Español</option>
                        <option value="JP">Japonés</option>
                        <option value="FR">Francés</option>
                        <option value="DE">Alemán</option>
                        <option value="IT">Italiano</option>
                        <option value="PT">Portugués</option>
                        <option value="CS">Chino Simplificado</option>
                        <option value="CT">Chino Tradicional</option>
                        <option value="KO">Coreano</option>
                        <option value="RU">Ruso</option>
                </select>
            </td>
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
    <h5 class="mb-0">Añadir Expansiones MTG</h5>
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
            <td><button type="button" class="btn btn-success" id="comodato" onclick="agregar_expan()">Agregar Expansión</button></td>
            <td><button type="button" class="btn btn-primary" id="compraventa" onclick=cerrarAddEx()>Cerrar</button></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    </table>
</div>
      </div>
        </div>
        <!--FIN DEL DIV = AGREGAR CARTAS-->
    <!--INICIO DEL DIV = EDITAR CARTAS-->
 <!--    <div id="editarCartas" style="display: none;">
        <div class="card mx-auto" style="width: 86rem; margin-top:80px;" id="tcgs">
            <div class="card-header d-flex justify-content-between">
                <h5 class="mb-0" style="display: inline-block;">Actualizar Cartas</h5>
            </div>
            <div id="comodatoCompra">
                <table id="">

                </table>
                <hr>
                <table id="tablaAcciones" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
                    <tr>
                        <td>
                            <button type="button" class="btn btn-primary" id="compraventa" onclick="cerrarEditar()">
                                Cerrar
                            </button>
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                </table>
            </div>
        </div>
    </div> -->
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
            <td>Número de carta</td>
        </tr>
        <tr>
            <td><input type="text" id="txtNomCartaP" class="form-control"></td>
            <td><select class="form-select" id="cbExpansionP">
                    <option value="0" selected>Seleccionar...</option>
                    <?php
                    // Verifica si hay resultados
                    if ($resultExpaP && $resultExpaP->num_rows > 0) {
                        // Itera sobre los resultados y genera las opciones
                        while($row = $resultExpaP->fetch_assoc()) {
                            echo "<option value='" . $row['NOMBRE_CORTO'] . "'>" . $row['NOMBRE_SET'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </td>
            <td><input type="text" id="txtNumColP" class="form-control" onkeyup="validarNumeros(event)"></td>
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
            <td style="display:none;" id="venta_container2">TCG A VENDER</td>
        </tr>
        <tr>
            <td><input type="text" id="txtNomUsA" class="form-control"></td>
            <td><input type="text" id="txtcorreoA" class="form-control"></td>
            <td><input type="password" id="txtPasswA" class="form-control"></td>
            <td>
                <select class="form-select" id="tipo_usuA" onchange="muestraV()">
                    <option value="0">Seleccionar...</option>
                    <option value="2">EMPLEADO</option>
                    <option value="3">CLIENTE</option>
                    <option value="4">ADMINISTRADOR</option>
                    <option value="5">VENDEDOR</option>
                </select>
            </td>
            <td style="display:none;" id="venta_container">
                <select class="form-select" id="tcg_venta">
                    <option value="0">Seleccionar...</option>
                    <option value="1">MAGIC THE GATHERING</option>
                    <option value="2">POKÉMON</option>
                    <option value="3">YU GI OH!</option>
                    <option value="4">LORCANA</option>
                    <option value="5">ONE PIECE</option>
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
            <td>TCG A VENDER</td>
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
                    <option value="5">VENDEDOR</option>
                </select>
            </td>
            <td>
                <select class="form-select" id="estatus_EditUsu">
                    <option value="0">Seleccionar...</option>
                    <option value="1">ACTIVO</option>
                    <option value="2">INACTIVO</option>
                </select>
            </td>
            <td>
                <select class="form-select" id="tcg_venta_edit">
                    <option value="0">Seleccionar...</option>
                    <option value="1">MAGIC THE GATHERING</option>
                    <option value="2">POKÉMON</option>
                    <option value="3">YU GI OH!</option>
                    <option value="4">LORCANA</option>
                    <option value="5">ONE PIECE</option>
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
                    <input type="file" name="fileToUpload_prod" id="fileToUpload_prod" class="form-control" accept=".jpg, .jpeg">
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
        <select id="filtroPedidosA" class="form-control" onchange="filtrarPedidos()">
            <option value="0">Todos</option>
            <option value="1">En proceso</option>
            <option value="2">Enviado</option>
            <option value="3">Entregado en tienda</option>
            <option value="4">Cancelado</option>
        </select>
    </div>
    
    <!-- Búsqueda de pedidos -->
    <div class="d-flex align-items-center">
        <label for="buscaPedID" class="mr-2 mb-0">Buscar pedido:</label>
        <div class="input-group">
            <input type="text" name="buscaPedID" id="buscaPedID" class="form-control" placeholder="Buscar pedido por ID...">
            <div class="input-group-append">
                <button type="button" class="btn btn-warning" onclick="buscaPedido()"><i class="bi bi-search"></i></button>
            </div>
        </div>
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
    <!-- PARA AGREGAR EVENTOS -->
         <div id="div_eventos" style="display: none;">
        <div class="card mx-auto" style="width: 86rem; margin-top:80px;" id="tcgs" style="display: none;">
    <div class="card-header d-flex justify-content-between">
    <h5 class="mb-0">Crear Nuevo Evento</h5>
  </div>
        <div>
    <table cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>NOMBRE DEL EVENTO</td>
            <td>FECHA DEL EVENTO</td>
            <td>HORA DEL EVENTO</td>
            <td>JUEGO TCG</td>
            <td>COSTO</td>
        </tr>
        <tr>
            <td><input type="text" id="nom_evento" class="form-control"></td>
            <td><input type="text" id="datepickerEvento" class="form-control"></td>
            <td><input type="time" id="horaEvento" class="form-control"></td>
            <td>
                <select name="tcg_evento" id="tcg_evento" class="form-control">
                    <option value="0" selected>Seleccionar...</option>
                    <option value="1">MTG</option>
                    <option value="2">Pokémon</option>
                </select>
            </td>
            <td><input type="text" class="form-control" id="txtPrecio_evento" onkeyup="validarNumeros(event)"></td>
        </tr>
    </table>
    <hr>
    <table id="tablaDesc" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td>DESCRIPCIÓN</td>
            <td>IMÁGEN</td>
        </tr>
        <tr>
            <td><textarea class="form-control" placeholder="Descipción del evento" id="floatingTextarea2_evento" style="height: 100px"></textarea></td>
            <td><input type="file" id="img_evento" class="form-control"></td>
        </tr>
    </table>
    <hr>
    <table id="tablaAcciones" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td><button type="button" class="btn btn-success" id="addProdBtn" onclick="guardarEvento()">Agregar Evento</button></td>
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
            <td><button type="button" class="btn btn-primary" id="productosC" onclick=cierraEvento()>Cerrar</button></td>
            <td>&nbsp;</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    </table>
</div>
      </div>
        </div>

        <!-- PARA Reporte STRIPE -->
<div id="div_Stripe" style="display: none;">
    <div class="card mx-auto mt-4" style="width: 60rem;">
        
        <div class="card-header py-2 d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Consultar Ventas por Mes</h6>
        </div>

        <div class="card-body py-3">

            <div class="row g-2 mb-2">
                <div class="col-md-6">
                    <label for="datepickerStripeDel" class="form-label mb-1">Del</label>
                    <input type="text" id="datepickerStripeDel" class="form-control form-control-sm">
                </div>

                <div class="col-md-6">
                    <label for="datepickerStripeAl" class="form-label mb-1">Al</label>
                    <input type="text" id="datepickerStripeAl" class="form-control form-control-sm">
                </div>
            </div>

            <div class="d-flex gap-2 mt-2">
                <button class="btn btn-primary btn-sm" id="btnFiltrarStripe" onclick="muestraDatosStripe()">
                   <i class="bi bi-search"></i> Filtrar
                </button>

                <button class="btn btn-warning btn-sm" onclick="ocultarStripe()">
                   <i class="bi bi-x-circle"></i> Cerrar
                </button>

                <button class="btn btn-success btn-sm" onclick="exportaStripe()">
                  <i class="bi bi-file-earmark-spreadsheet"></i>  Exportar
                </button>
            </div>
            
            <div id="dataStripe" style="display: none;">
                    <table class="table table-hover" id="dataVentas">
                        <thead class="table-info sticky-top">
                            <th scope="col">ID VENTA</th>
                            <th scope="col">FECHA VENTA</th>
                            <th scope="col">MONTO TOTAL</th>
                            <th scope="col">ID STRIPE</th>
                            <th scope="col">CLIENTE</th>
                            </tr>
                        </thead>
                        <tbody id="cuerpo_stripe">
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <th colspan="2">TOTAL</th>
                                <th id="total_monto">$0.00</th>
                                <th colspan="2" id="total_ventas">0 ventas</th>
                            </tr>
                        </tfoot>                            
                    </table>
            </div>

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
            <td><input type="text" id="txtNomCliente" class="form-control" value="<?=isset($rowUs['NOMBRE']) ? $rowUs['NOMBRE'] : '';?>"></td>
            <td><input type="text" id="txtApePat" class="form-control" value="<?=isset($rowUs['APELLIDO_PAT']) ? $rowUs['APELLIDO_PAT'] : '';?>"></td>
            <td><input type="text" id="txtApeMat" class="form-control" value="<?=isset($rowUs['APELLIDO_MATERNO']) ? $rowUs['APELLIDO_MATERNO'] : '';?>"></td>
            <td><input type="text" id="datepicker_cli" class="form-control" value="<?=isset($rowUs['FECHA_NAC']) ? $rowUs['FECHA_NAC'] : '';?>"></td>
        </tr>
    </table>
    <table cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
      <div class="card-header d-flex justify-content-between">
      </div>
        <tr>
            <td>NUM TELEFONO</td>
        </tr>
        <tr>
            <td><input type="text" onkeyup="validarNumeros(event)" id="txtNumCliente" class="form-control" value="<?=isset($rowUs['NUM_TELEFONO']) ? $rowUs['NUM_TELEFONO'] : '';?>"></td>
        </tr>
    </table>
    <hr>
    <table id="tablaAcciones" cellpadding="0" cellspacing="0" width="100%" border="0" style="text-align: center;">
        <tr>
            <td><button type="button" class="btn btn-success" id="guardarDatos" onclick="guardarDatosUsu(1)">Actualizar Datos</button></td>
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
            <td>COSTO</td>
            <td>LISTA CARTAS</td>
            <td>TCG</td>
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
                    <option value="9">Expanded</option>
                    <option value="10">GLC</option>
                </select>
            </td>
             <td><input type="number" id="costo_deck" class="form-control"></td>
            <td><input type="file" id="lista_deck" class="form-control"></td>
            <td><select class="form-select" id="tcg_deck">
                    <option value="0">Seleccionar...</option>
                    <option value="1">MTG</option>
                    <option value="2">Pokémon</option>
                </select>
            </td>
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
<div id="divPOS" class="mt-3" style="display: none;">
    <div class="container">
        <div class="row g-2 align-items-center">
            <!-- Barra de búsqueda -->
            <div class="col-12 col-md-4">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar producto..." id="busprod" name="busprod">
                </div>
                <div id="coincidencias_producto"></div>
            </div>

            <!-- Botones -->
            <div class="col-12 col-md-4 d-flex flex-column flex-md-row justify-content-md-end gap-2 mt-2 mt-md-0">

                <button id="btnCobrar" class="btn btn-outline-warning btn-sm d-flex align-items-center gap-1 p-2 rounded-3" type="button" onclick="cobrar()" <?php echo $oculto; ?>>
                    <span class="d-inline-block" style="background-image:url('../assets/img/pago.png'); background-size:cover; width:20px; height:20px;"></span>
                    Cobrar
                </button>

                <button id="btnAbrir" class="btn btn-outline-success btn-sm d-flex align-items-center gap-1 p-2 rounded-3" type="button" onclick="abre_cajita()">
                    <span class="d-inline-block" style="background-image:url('../assets/img/abre_caja.png'); background-size:cover; width:20px; height:20px;"></span>
                    Abrir caja
                </button>

                <button id="btnCierre" class="btn btn-outline-primary btn-sm d-flex align-items-center gap-1 p-2 rounded-3" type="button" onclick="cierre_cajita()" <?php echo $oculto; ?>>
                    <span class="d-inline-block" style="background-image:url('../assets/img/caja.png'); background-size:cover; width:20px; height:20px;"></span>
                    Cierre de caja
                </button>

                <button id="btnCerrar" class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1 p-2 rounded-3" type="button" onclick="cerrarPos()">
                    <span class="d-inline-block" style="background-image:url('../assets/img/close.png'); background-size:cover; width:20px; height:20px;"></span>
                    Cerrar
                </button>

            </div>
        </div>
    </div>

    <div class="container mt-4">
        <!-- Tabla de detalles de la transacción -->
        <div class="table-responsive table-sm">
            <table class="table table-hover" id="tabla_caja">
                <thead class="table-light sticky-top">
                    <tr>
                        <th>CLAVE DEL PRODUCTO</th>
                        <th>NOMBRE DEL PRODUCTO</th>
                        <th>CANTIDAD</th>
                        <th>FOIL</th>
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