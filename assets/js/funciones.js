
function iniciar(){
  window.location.href = "sesioniniciada.php";
}
function cartasAcciones(){
  var divi = document.getElementById("tcgs");
  divi.style.display = "block";
}
function ocultartcgs(){
  var divi = document.getElementById("tcgs");
  divi.style.display = "none";
}
function cerrarAccionesCartas(){
  var divi = document.getElementById("accionesCartas");
  divi.style.display = "none";
}
function mostrarAddC(){
  var divAñadir = document.getElementById("crudCartasAdd");
  divAñadir.style.display = "block";
}
function cerrarAñadir(){
  var divAñadir = document.getElementById("crudCartasAdd");
  divAñadir.style.display = "none";
}
function validarLetras(event) {
  var input = event.target;
  input.value = input.value.replace(/[^A-Za-z]/g, ''); // Eliminar todo excepto letras (mayúsculas y minúsculas)
} 
function validarNumeros(event) {
    var input = event.target;
    input.value = input.value.replace(/[^0-9]/g, ''); // Eliminar todo excepto números
}
function mostrarEditar(){
  var divAñadir = document.getElementById("editarCartas");
  divAñadir.style.display = "block";
}
function cerrarEditar(){
  var divAñadir = document.getElementById("editarCartas");
  divAñadir.style.display = "none";
}
function addUsua(){
  var divAñadir = document.getElementById("addUsu");
  divAñadir.style.display = "block";
}
function usuarioAcciones(){
  var mostrar = document.getElementById("botonesUsu");
  mostrar.style.display = "block";
}
function cerrarAddU(){
  var ocultar = document.getElementById("addUsu");
  ocultar.style.display = "none";
}
function cerrarAccionesUsu(){
  var ocultar = document.getElementById("botonesUsu");
  ocultar.style.display = "none";
}
function modificarUusario(){
  var mostrar = document.getElementById("modifiUsu");
  mostrar.style.display = "block";
}
function cerrarModusua(){
  var mostrar = document.getElementById("modifiUsu");
  mostrar.style.display = "none"
}
function mostrartcgs(){
  var mostrar = document.getElementById("nav_mtg");
  mostrar.style.display = "block";
}
function cerrarAccionesExp(){
  var mostrar = document.getElementById("btncloseExpan");
  mostrar.style.display = "none";
}
function cerrarAccionesExp(){
  var mostrar = document.getElementById("accionesExpansiones");
  mostrar.style.display = "none";
}
function mostrarAddEx(){
  var mostrar = document.getElementById("expansionesAdd");
  mostrar.style.display = "block";
}
function mostrarAddEx(){
  var mostrar = document.getElementById("expansionesAdd");
  mostrar.style.display = "block";
}
function cerrarAddEx(){
  var mostrar = document.getElementById("expansionesAdd");
  mostrar.style.display = "none";
}
function mostrarExpansiones(){
  var mostrar = document.getElementById("accionesExpansiones");
  mostrar.style.display = "block";
}
function cerrarEditEx(){
  var mostrar = document.getElementById("expansionesEdit");
  mostrar.style.display = "none";
}
function mostrarExpansionesEdit(){
  var mostrar = document.getElementById("expansionesEdit");
  mostrar.style.display = "block";
}
function mostrarCartas(){
  var divi = document.getElementById("accionesCartas");
  divi.style.display = "block";
}
function ocultarnav(){
  var mostrar = document.getElementById("nav_mtg");
  mostrar.style.display = "none";
}
/************************************************************************* POKEMON */
function mostrarPoke(){
  var mostrar = document.getElementById("nav_poke");
  mostrar.style.display = "block";
}

function ocultarnavP(){
  var mostrar = document.getElementById("nav_poke");
  mostrar.style.display = "none";
}

function mostrarCartasP(){
  var divi = document.getElementById("accionesCartasP");
  divi.style.display = "block";
}

function cerrarAccionesCartasP(){
  var divi = document.getElementById("accionesCartasP");
  divi.style.display = "none";
}

function mostrarAddP(){
  var divi = document.getElementById("crudCartasAddP");
  divi.style.display = "block";
}

function cerrarAñadirP(){
  var divi = document.getElementById("crudCartasAddP");
  divi.style.display = "none";
}

/************************************************************************************** YU GI OH*/
function mostrarYugi(){
  var mostrar = document.getElementById("nav_yugi");
  mostrar.style.display = "block";
}

function ocultarnavY(){
  var mostrar = document.getElementById("nav_yugi");
  mostrar.style.display = "none";
}

function mostrarCartasY(){
  var divi = document.getElementById("accionesCartasY");
  divi.style.display = "block";
}

function cerrarAccionesCartasY(){
  var divi = document.getElementById("accionesCartasY");
  divi.style.display = "none";
}

function mostrarAddY(){
  var divi = document.getElementById("crudCartasAddY");
  divi.style.display = "block";
}

function cerrarAñadirY(){
  var divi = document.getElementById("crudCartasAddY");
  divi.style.display = "none";
}

function mostrarEditarY(){
  var divi = document.getElementById("editarCartasY");
  divi.style.display = "block";
}

function cerrarEditarY(){
  var divi = document.getElementById("editarCartasY");
  divi.style.display = "none";
}

/************************************************************************************** LORCANA*/
function mostrarLorcana(){
  var mostrar = document.getElementById("nav_lorcana");
  mostrar.style.display = "block";
}

function ocultarnavL(){
  var mostrar = document.getElementById("nav_lorcana");
  mostrar.style.display = "none";
}

function mostrarCartasL(){
  var divi = document.getElementById("accionesCartasL");
  divi.style.display = "block";
}

function cerrarAccionesCartasL(){
  var divi = document.getElementById("accionesCartasL");
  divi.style.display = "none";
}

function mostrarAddL(){
  var divi = document.getElementById("crudCartasAddL");
  divi.style.display = "block";
}

function cerrarAñadirL(){
  var divi = document.getElementById("crudCartasAddL");
  divi.style.display = "none";
}

function mostrarEditarL(){
  var divi = document.getElementById("editarCartasL");
  divi.style.display = "block";
}

function cerrarEditarL(){
  var divi = document.getElementById("editarCartasL");
  divi.style.display = "none";
}

function mostrarExpansionesL(){
  var mostrar = document.getElementById("accionesExpansionesY");
  mostrar.style.display = "block";
}

function cerrarAccionesExpL(){
  var mostrar = document.getElementById("accionesExpansionesY");
  mostrar.style.display = "none";
}
 
function mostrarAddExL(){
 var mostrar = document.getElementById("expansionesAddLor");
 mostrar.style.display = "block";
}

function cerrarAddExL(){
 var divAñadir = document.getElementById("expansionesAddLor");
 divAñadir.style.display = "none";
}

function mostrarInventarioLor(){
  $.ajax({
    url: 'ajax_lorcana.php',
    type: 'POST',
    data: { 
        accion: 5 
    },beforeSend: function() {
      mostrarLoader();
  },success: function(data) {
        // Parse JSON data received from the server
        var jsonData = JSON.parse(data);
        // Create a table to display the inventory
        var tableHTML = '<table class="table table-striped table-hover" id="tablaLorcana">';
        tableHTML += '<thead><tr style="text-align: center;position: sticky; top: 0;"><th>ID_Carta</th><th>Nombre de la Carta</th><th>Expansión</th><th>Precio</th><th>Cantidad</th><th>Idioma</th></tr></thead>';
        tableHTML += '<tbody>';
        // Iterate through the data and populate the table rows
        for (var i = 0; i < jsonData.length; i++) {
            tableHTML += '<tr style="text-align: center;">';
            tableHTML += '<td>' + jsonData[i].ID_CARTA + '</td>';
            tableHTML += '<td>' + jsonData[i].NOM_CARTA + '</td>';
            tableHTML += '<td>' + jsonData[i].EXPANSION + '</td>';
            tableHTML += '<td>' + jsonData[i].PRECIO + '</td>';
            tableHTML += '<td>' + jsonData[i].CANTIDAD + '</td>';
            tableHTML += '<td>' + jsonData[i].IDIOMA + '</td>';
            tableHTML += '</tr>';
        }
        tableHTML += '</tbody></table>';
        // Update the HTML content of the div with the inventory table
        $('#tableContainerLorcana').html(tableHTML);
        // Show the div containing the inventory table
        $('#divInvLorcana').show();
        ocultarLoader();
    }
});
}

function cerrarInvLor(){
  $('#divInvLorcana').hide();
}

/************************************************************************************** ONE PIECE*/
function mostrarOneP(){
  var mostrar = document.getElementById("nav_onepiece");
  mostrar.style.display = "block";
}

function ocultarnavOp(){
  var mostrar = document.getElementById("nav_onepiece");
  mostrar.style.display = "none";
}

function mostrarCartasOp(){
  var divi = document.getElementById("accionesCartasL");
  divi.style.display = "block";
}

function cerrarAccionesCartasOp(){
  var divi = document.getElementById("accionesCartasL");
  divi.style.display = "none";
}

function mostrarAddOp(){
  var divi = document.getElementById("crudCartasAddL");
  divi.style.display = "block";
}

function cerrarAñadirOp(){
  var divi = document.getElementById("crudCartasAddL");
  divi.style.display = "none";
}

function mostrarEditarOp(){
  var divi = document.getElementById("editarCartasL");
  divi.style.display = "block";
}

function cerrarEditarOp(){
  var divi = document.getElementById("editarCartasL");
  divi.style.display = "none";
}

function mostrarExpansionesOp(){
  var mostrar = document.getElementById("accionesExpansionesY");
  mostrar.style.display = "block";
}

function cerrarAccionesExpOp(){
  var mostrar = document.getElementById("accionesExpansionesY");
  mostrar.style.display = "none";
}
 
function mostrarAddExOp(){
 var mostrar = document.getElementById("expansionesAddLor");
 mostrar.style.display = "block";
}

function cerrarAddExOp(){
 var divAñadir = document.getElementById("expansionesAddLor");
 divAñadir.style.display = "none";
}

function mostrarInventarioOp(){
  $.ajax({
    url: 'ajax_lorcana.php',
    type: 'POST',
    data: { 
        accion: 5 
    },beforeSend: function() {
      mostrarLoader();
  },success: function(data) {
        // Parse JSON data received from the server
        var jsonData = JSON.parse(data);
        // Create a table to display the inventory
        var tableHTML = '<table class="table table-striped table-hover" id="tablaLorcana">';
        tableHTML += '<thead><tr style="text-align: center;position: sticky; top: 0;"><th>ID_Carta</th><th>Nombre de la Carta</th><th>Expansión</th><th>Precio</th><th>Cantidad</th><th>Idioma</th></tr></thead>';
        tableHTML += '<tbody>';
        // Iterate through the data and populate the table rows
        for (var i = 0; i < jsonData.length; i++) {
            tableHTML += '<tr style="text-align: center;">';
            tableHTML += '<td>' + jsonData[i].ID_CARTA + '</td>';
            tableHTML += '<td>' + jsonData[i].NOM_CARTA + '</td>';
            tableHTML += '<td>' + jsonData[i].EXPANSION + '</td>';
            tableHTML += '<td>' + jsonData[i].PRECIO + '</td>';
            tableHTML += '<td>' + jsonData[i].CANTIDAD + '</td>';
            tableHTML += '<td>' + jsonData[i].IDIOMA + '</td>';
            tableHTML += '</tr>';
        }
        tableHTML += '</tbody></table>';
        // Update the HTML content of the div with the inventory table
        $('#tableContainerLorcana').html(tableHTML);
        // Show the div containing the inventory table
        $('#divInvLorcana').show();
        ocultarLoader();
    }
});
}

function cerrarInvOp(){
  $('#divInvLorcana').hide();
}

/*********************************************************************/


document.addEventListener("DOMContentLoaded", function() {
  $(document).ready(function(){
    $('#datepicker').datepicker({
        format: 'dd/mm/yyyy', // Puedes cambiar el formato de la fecha según tus necesidades
        autoclose: true,
        language: 'es' // Configura el idioma a español
    });
});
});

function limpiarCampos1(){
  document.getElementById("txtNomCarta").value = "";
  document.getElementById("cbExpansion").value = "0";
  document.getElementById("txtPrecio").value = "";
  document.getElementById("txtCantid").value = "";
  document.getElementById("tipoFoil").value = "0";
  document.getElementById("condi_carta").value = "0";
  document.getElementById("txtIdioma").value = "";
}

/*************************** petición ajax para guardar los datos de la carta en la bd mtg ***************************************/
function guardarCarta(){
  var nombre_carta = document.getElementById("txtNomCarta").value;
  var expansion =    document.getElementById("cbExpansion").value;
  var precio =       document.getElementById("txtPrecio").value;
  var cantidad =     document.getElementById("txtCantid").value;
  var foil =         document.getElementById("tipoFoil").value;
  var condicion =    document.getElementById("condi_carta").value;
  var idioma =       document.getElementById("txtIdioma").value;
  var numero_carta = document.getElementById("txtNumCol").value;


  if (nombre_carta === "" || expansion === "0" || precio === "" || cantidad === "" || foil === "0" || condicion === "0" || idioma === "" || numero_carta === "") {
    // Al menos un campo está vacío o no seleccionado, mostrar mensaje de error
    var mensajeError = "Por favor, completa los siguientes campos:\n";

    if (nombre_carta === "") mensajeError += "- Nombre de la carta\n";
    if (expansion === "0") mensajeError += "- Expansión\n";
    if (precio === "") mensajeError += "- Precio\n";
    if (cantidad === "") mensajeError += "- Cantidad\n";
    if (foil === "0") mensajeError += "- Foil\n";
    if (condicion === "0") mensajeError += "- Condición\n";
    if (idioma === "") mensajeError += "- Idioma\n";
    if (numero_carta === "") mensajeError += "- Número de carta\n";

    // Mostrar mensaje de error
    Swal.fire({
        title: 'Error',
        text: mensajeError,
        icon: 'error',
        confirmButtonText: 'Aceptar'
    });
} else {
  Swal.fire({
    title: "Deseas guardar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si"
  }).then((result) => {
    if (result.isConfirmed) {
      var datos = {
        nombre_carta: nombre_carta,
        expansion: expansion,
        precio: precio,
        cantidad: cantidad,
        foil: foil,
        condicion : condicion,
        idioma : idioma,
        numero_carta : numero_carta,
        accion : 1
    };
    // Enviar los datos al servidor usando AJAX
    fetch('ajax_mtg.php', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/x-www-form-urlencoded' // Cambia el tipo de contenido
      },
      body: new URLSearchParams(datos).toString() // Convierte los datos a formato de formulario
  })
  .then(response => response.text()) // Espera una respuesta de texto
  .then(data => {
      if(data == 'OK'){
        Swal.fire({
          title: "Datos guardados!",
          text: "Los datos de la carta han sido guardados correctamente!",
          icon: "success"
        });
        limpiarCampos1()
      }
  })
    }
  });
}
}
/*************** función para buscar coincidencias de cartas ***************/
$(document).ready(function() {
  $('#buscaCard').keyup(function() {
      var buscaCard = $(this).val();
      if (buscaCard != '') {
          $.ajax({
              url: 'ajax_mtg.php',
              type: 'POST',
              data: { 
                  buscaCard: buscaCard,
                  accion: 2 
              },
              success: function(data) {
                  $('#coincidencias').html(data);
              }
          });
      } else {
          $('#coincidencias').html('');
      }
  });
});

/************************* función para buscar coincidencias de expansiones mtg********************************************************/
$(document).ready(function() {
  $('#buscaExpan').keyup(function() {
      var buscaCard = $(this).val();
      if (buscaCard != '') {
          $.ajax({
              url: 'ajax_mtg.php',
              type: 'POST',
              data: { 
                  buscaCard: buscaCard,
                  accion: 8 
              },
              success: function(data) {
                  $('#coincidencias_expan').html(data);
              }
          });
      } else {
          $('#coincidencias_expan').html('');
      }
  });
});

function carga_carta_encontrada(id_carta) {
  console.log(id_carta);
  $.ajax({
      url: 'ajax_mtg.php',
      type: 'POST',
      data: { 
          id_carta: id_carta,
          accion: 3 
      },
      dataType: 'json', // Especifica que esperas recibir datos JSON
      success: function(data) {
        //console.log(data);
        $('#id_carta_encontrada').val(data[0].ID_CARTA);
        $('#txtNomCartaEdit').val(data[0].NOM_CARTA);
        $('#txtPrecioEdit').val(data[0].PRECIO);
        $('#txtCantidEdit').val(data[0].CANTIDAD);
        $('#condi_carta_edit').val(data[0].CONDICION);
        $('#txtIdiomaEdit').val(data[0].IDIOMA);

        $('#div_encontradas').hide();
      },
      error: function(xhr, status, error) {
          // Maneja los errores de la solicitud AJAX
          console.error(xhr.responseText); // Muestra el mensaje de error en la consola
      }
  });
}

function carga_expan_encontrada(id_carta,expan,expan_corto,lanzamiento){
    $('#txtNomExpan_2').val(expan);
    $('#txtNomCorto_2').val(expan_corto);
    $('#datepicker_2').val(lanzamiento);
    $('#id_expansion_encontrada').val(id_carta);
}

function limpiarCampos2(){
  document.getElementById("id_carta_encontrada").value = "";
  document.getElementById("txtNomCartaEdit").value = "";
  document.getElementById("cbExpansionEdit").value = "0";
  document.getElementById("txtPrecioEdit").value = "";
  document.getElementById("txtCantidEdit").value = "";
  document.getElementById("tipoFoilEdit").value = "0";
  document.getElementById("condi_carta_edit").value = "0";
  document.getElementById("txtIdiomaEdit").value = "";
}

function actualizar_cartas(){
  var id_cartita = document.getElementById("id_carta_encontrada").value;
  var nombre_carta = document.getElementById("txtNomCartaEdit").value;
  var precio =       document.getElementById("txtPrecioEdit").value;
  var cantidad =     document.getElementById("txtCantidEdit").value;
  var condicion =    document.getElementById("condi_carta_edit").value;
  var idioma =       document.getElementById("txtIdiomaEdit").value;


  if (nombre_carta === "" || precio === "" || cantidad === "" || condicion === "0" || idioma === "") {
    // Al menos un campo está vacío o no seleccionado, mostrar mensaje de error
    var mensajeError = "Por favor, completa los siguientes campos:\n";

    if (nombre_carta === "") mensajeError += "- Nombre de la carta\n";
    if (precio === "") mensajeError += "- Precio\n";
    if (condicion === "0") mensajeError += "- Condición\n";
    if (idioma === "") mensajeError += "- Idioma\n";

    // Mostrar mensaje de error
    Swal.fire({
        title: 'Error',
        text: mensajeError,
        icon: 'error',
        confirmButtonText: 'Aceptar'
    });
} else {
  Swal.fire({
    title: "Deseas guardar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si"
  }).then((result) => {
    if (result.isConfirmed) {
      var datos = {
        nombre_carta: nombre_carta,
        precio: precio,
        cantidad: cantidad,
        condicion : condicion,
        idioma : idioma,
        id_cart : id_cartita,
        accion : 4
    };
    // Enviar los datos al servidor usando AJAX
    fetch('ajax_mtg.php', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/x-www-form-urlencoded' // Cambia el tipo de contenido
      },
      body: new URLSearchParams(datos).toString() // Convierte los datos a formato de formulario
  })
  .then(response => response.text()) // Espera una respuesta de texto
  .then(data => {
      if(data == 'OK'){
        Swal.fire({
          title: "Datos actualizados!",
          text: "Los datos de la carta han sido actualizados correctamente!",
          icon: "success"
        });
        limpiarCampos2()
      }
  })
  .catch(error => {
      console.error('Error al enviar los datos:', error);
  });
    }
  });
}
}

function mostrarInventarioMtg() {
  $.ajax({
      url: 'ajax_mtg.php',
      type: 'POST',
      data: { 
          accion: 5 
      },beforeSend: function() {
        mostrarLoader();
    },success: function(data) {
          // Parse JSON data received from the server
          var jsonData = JSON.parse(data);
          // Create a table to display the inventory
          var tableHTML = '<table class="table table-striped table-hover" id="tablaMtg">';
          tableHTML += `
          <thead>
            <tr style="text-align:center;">
              <th>ID_Carta</th>
              <th>Nombre de la Carta</th>
              <th>Expansión</th>
              <th>Rareza</th>
              <th>Precio</th>
              <th>Cantidad</th>
              <th>Idioma</th>
              <th>Foil</th>
            </tr>
          </thead>`;

          tableHTML += '<tbody>';
          // Iterate through the data and populate the table rows
          for (var i = 0; i < jsonData.length; i++) {
              tableHTML += '<tr style="text-align: center;">';
              tableHTML += '<td>' + jsonData[i].ID_CARTA + '</td>';
              tableHTML += '<td>' + jsonData[i].NOM_CARTA + '</td>';
              tableHTML += '<td>' + jsonData[i].EXPANSION + '</td>';
              tableHTML += '<td>' + jsonData[i].RAREZA + '</td>';
              tableHTML += `
              <td>
                  <input 
                      type="number" 
                      class="form-control form-control-sm input-precio"
                      data-id="${jsonData[i].ID_CARTA}"
                      data-idioma="${jsonData[i].IDIOMA}"
                      data-foil="${jsonData[i].FOIL}"
                      data-condicion="${jsonData[i].CONDICION}"
                      value="${jsonData[i].PRECIO}"
                  >
              </td>`;
              tableHTML += `
              <td>
                  <input 
                      type="number" 
                      class="form-control form-control-sm input-cantidad"
                      data-id="${jsonData[i].ID_CARTA}"
                      data-idioma="${jsonData[i].IDIOMA}"
                      data-foil="${jsonData[i].FOIL}"
                      data-condicion="${jsonData[i].CONDICION}"
                      value="${jsonData[i].CANTIDAD}"
                  >
              </td>`;
              tableHTML += '<td>' + jsonData[i].IDIOMA + '</td>';
              tableHTML += '<td>' + jsonData[i].FOIL + '</td>';
              tableHTML += '</tr>';
          }
          tableHTML += '</tbody></table>';
          // Update the HTML content of the div with the inventory table
          $('#tableContainerMTG').html(tableHTML);
          // Show the div containing the inventory table
          $('#divInvMtg').show();
          ocultarLoader();
      }
  });
}

$(document).on('change', '.input-precio, .input-cantidad', function() {

    var id = $(this).data('id');
    var idioma = $(this).data('idioma');
    var foil = $(this).data('foil');
    var condicion = $(this).data('condicion');

    var campo = $(this).hasClass('input-precio') ? "PRECIO" : "CANTIDAD";
    var valor = $(this).val();

    actualizarMtg(id, campo, valor, idioma, foil, condicion);
});

$(document).on('change', '.input-precios, .input-cantidads', function() {

    var id = $(this).data('id');

    var campo = $(this).hasClass('input-precio') ? "PRECIO" : "CANTIDAD";
    var valor = $(this).val();

    actualizarSellado(id, campo, valor);
});

function cerrarInv(){
  $('#divInvMtg').hide();
}

function exportarExcel(){
  // Obtener los datos de la tabla
  var tabla = document.getElementById('tablaMtg');
  var tablaDatos = [];
  var filas = tabla.rows;
  for (var i = 0; i < filas.length; i++) {
      var fila = [],
          celdas = filas[i].cells;
      for (var j = 0; j < celdas.length; j++) {
          fila.push(celdas[j].innerText);
      }
      tablaDatos.push(fila);
  }
  // Crear un objeto de libro de trabajo de Excel
  var libro = XLSX.utils.book_new();
  var hoja = XLSX.utils.aoa_to_sheet(tablaDatos);
  XLSX.utils.book_append_sheet(libro, hoja, 'Inventario MTG');
  // Guardar el archivo de Excel
  XLSX.writeFile(libro, 'inventario_mtg.xlsx');
}

function mostrarLoader() {
  Swal.fire({
    html: `
    <svg class="pl" width="240" height="240" viewBox="0 0 240 240">
      <circle class="pl__ring pl__ring--a" cx="120" cy="120" r="105" fill="none" stroke="#000" stroke-width="20" stroke-dasharray="0 660" stroke-dashoffset="-330" stroke-linecap="round"></circle>
      <circle class="pl__ring pl__ring--b" cx="120" cy="120" r="35" fill="none" stroke="#000" stroke-width="20" stroke-dasharray="0 220" stroke-dashoffset="-110" stroke-linecap="round"></circle>
      <circle class="pl__ring pl__ring--c" cx="85" cy="120" r="70" fill="none" stroke="#000" stroke-width="20" stroke-dasharray="0 440" stroke-linecap="round"></circle>
      <circle class="pl__ring pl__ring--d" cx="155" cy="120" r="70" fill="none" stroke="#000" stroke-width="20" stroke-dasharray="0 440" stroke-linecap="round"></circle>
    </svg>
    <p>CARGANDO CARTAS...</p>
    `,
    showCloseButton: false,
    showConfirmButton: false,
    customClass: {
      container: 'custom-modal-container',
      popup: 'custom-modal-popup',
      content: 'custom-modal-content',
  }
  });
}  
  // Oculta el loader cuando la llamada AJAX ha terminado
  function ocultarLoader() {
      Swal.close();
  }

function agregar_expan(){
  var nombre_largo = document.getElementById("txtNomExpan").value;
  var nombre_corto = document.getElementById("txtNomCorto").value;
  var fecha_lanz =   document.getElementById("datepicker").value;

  if (nombre_largo === "" || nombre_corto === "" || fecha_lanz === "") {
    // Al menos un campo está vacío o no seleccionado, mostrar mensaje de error
    var mensajeError = "Por favor, completa los siguientes campos:\n";

    if (nombre_largo === "") mensajeError += "- Nombre de la expansión\n";
    if (nombre_corto === "0") mensajeError += "- Nombre corto\n";
    if (fecha_lanz === "") mensajeError += "- Fecha de lanzamiento\n";

    // Mostrar mensaje de error
    Swal.fire({
        title: 'Error',
        text: mensajeError,
        icon: 'error',
        confirmButtonText: 'Aceptar'
    });
} else{
  Swal.fire({
    title: "Deseas guardar la expansión?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si"
  }).then((result) => {
    if (result.isConfirmed) {
      var datos = {
        expansion: nombre_largo,
        nom_corto: nombre_corto,
        fecha_lanzamiento: fecha_lanz,
        accion : 7
    };
    // Enviar los datos al servidor usando AJAX
    fetch('ajax_mtg.php', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/x-www-form-urlencoded' // Cambia el tipo de contenido
      },
      body: new URLSearchParams(datos).toString() // Convierte los datos a formato de formulario
  })
  .then(response => response.text()) // Espera una respuesta de texto
  .then(data => {
      if(data == 'OK'){
        Swal.fire({
          title: "Datos guardados!",
          text: "Los datos de la expansión han sido guardados correctamente!",
          icon: "success"
        });
        limpiarCampos3()
      }
  })
  .catch(error => {
      console.error('Error al enviar los datos:', error);
  });
    }
  });
}
}

function limpiarCampos3(){
  document.getElementById("txtNomExpan").value = "";
  document.getElementById("txtNomCorto").value = "";
  document.getElementById("datepicker").value= "";
}

function actualizar_expan(){
  var id_expan = document.getElementById("id_expansion_encontrada").value;
  var nombre_largo = document.getElementById("txtNomExpan_2").value;
  var nombre_corto = document.getElementById("txtNomCorto_2").value;
  var fecha_lanz =   document.getElementById("datepicker_2").value;


  Swal.fire({
    title: "Deseas actualizar la expansión?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si"
  }).then((result) => {
    if (result.isConfirmed) {
      var datos = {
        id_expan : id_expan,
        expansion: nombre_largo,
        nom_corto: nombre_corto,
        fecha_lanzamiento: fecha_lanz,
        accion : 9
    };
    // Enviar los datos al servidor usando AJAX
    fetch('ajax_mtg.php', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/x-www-form-urlencoded' // Cambia el tipo de contenido
      },
      body: new URLSearchParams(datos).toString() // Convierte los datos a formato de formulario
  })
  .then(response => response.text()) // Espera una respuesta de texto
  .then(data => {
      if(data == 'OK'){
        Swal.fire({
          title: "Datos guardados!",
          text: "Los datos de la expansión han sido actualizados correctamente!",
          icon: "success"
        });
        limpiarCampos4()
      }
  })
  .catch(error => {
      console.error('Error al enviar los datos:', error);
  });
    }
  });

}

function limpiarCampos4(){
  document.getElementById("txtNomExpan_2").value = "";
  document.getElementById("txtNomCorto_2").value = "";
  document.getElementById("datepicker_2").value= "";
}

function otros_productos_acciones(){
  var divi = document.getElementById("accionesProductos");
  divi.style.display = "block";
}

function cerrarProductos(){
  var divi = document.getElementById("productos_otros");
  divi.style.display = "none";
}

function guardarProducto(){
  var nombre_produc = document.getElementById("txtNomProd").value;
  var tipo_produc   = document.getElementById("cbTipo_prod").value;
  var cod_barras =    document.getElementById("juego_tcg").value;
  var precio_prod =   document.getElementById("txtPrecio_prod").value;
  var cantidad_prod = document.getElementById("txtCantid_prod").value;
  var descrip_prod =  document.getElementById("floatingTextarea2_prod").value;

  var imagen_prod = document.getElementById("fileToUpload_prod").files[0]; // Obtener el archivo de imagen

  if (nombre_produc === "" || tipo_produc === "0" || precio_prod === "" || cantidad_prod === "" || descrip_prod === "") {
    // Al menos un campo está vacío o no seleccionado, mostrar mensaje de error
    var mensajeError = "Por favor, completa los siguientes campos:\n";

    if (nombre_produc === "") mensajeError += "- Nombre del producto\n";
    if (tipo_produc === "0") mensajeError += "- Tipo de producto\n";
    if (precio_prod === "") mensajeError += "- Precio\n";
    if (cantidad_prod === "") mensajeError += "- Cantidad\n";
    if (descrip_prod === "") mensajeError += "- Descripcón\n";

    // Mostrar mensaje de error
    Swal.fire({
        title: 'Error',
        text: mensajeError,
        icon: 'error',
        confirmButtonText: 'Aceptar'
    });
} else {
  Swal.fire({
    title: "Deseas guardar el producto?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si"
  }).then((result) => {
    if (result.isConfirmed) {
      var datos = {
        nombre_produc: nombre_produc,
        tipo_produc: tipo_produc,
        cod_barras: cod_barras,
        precio_prod: precio_prod,
        cantidad_prod: cantidad_prod,
        descrip_prod: descrip_prod,
        accion : 1
    };
    // Enviar los datos al servidor usando AJAX
    fetch('ajax_prod.php', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/x-www-form-urlencoded' // Cambia el tipo de contenido
      },
      body: new URLSearchParams(datos).toString() // Convierte los datos a formato de formulario
  })
  .then(response => response.text()) // Espera una respuesta de texto
  .then(data => {
      if(data == 'OK'){
        var formData = new FormData();
    formData.append('fileToUpload_prod', imagen_prod);
    formData.append('nombre_produc', datos.nombre_produc);
    for (var key in datos) {
        formData.append(key, datos[key]);
    }
    // Enviar los datos al servidor usando AJAX
    fetch('upload_prod.php', {
        method: 'POST',
        body: formData,
        nombre_carta: nombre_produc,
    })
    .then(response => response.text())
    .then(data => {
        // Resto del código para manejar la respuesta del servidor
    })
    .catch(error => {
        console.error('Error al enviar los datos:', error);
    });
        Swal.fire({
          title: "Datos guardados!",
          text: "Los datos del producto han sido guardados correctamente!",
          icon: "success"
        });
        limpiarCampos5()
      }
  })
  .catch(error => {
      console.error('Error al enviar los datos:', error);
  });
    }
  });
}
}

function limpiarCampos5(){
  document.getElementById("txtNomProd").value = "";
  document.getElementById("cbTipo_prod").value = "0";
  document.getElementById("juego_tcg").value= "0";
  document.getElementById("txtPrecio_prod").value= "";
  document.getElementById("txtCantid_prod").value= "";
  document.getElementById("floatingTextarea2_prod").value= "";
  document.getElementById("fileToUpload_prod").value= "";
}

function limpiarCampos6(){
  document.getElementById("txtNomProd").value = "";
  document.getElementById("cbTipo_prod").value = "0";
  document.getElementById("txtColor").value= "";
  document.getElementById("txtBarras").value= "";
  document.getElementById("txtPrecio_prod").value= "";
  document.getElementById("txtCantid_prod").value= "";
  document.getElementById("floatingTextarea2_prod").value= "";
  document.getElementById("fileToUpload_prod").value= "";
}

function mostrarProductosAdd(){
  var divi = document.getElementById("productos_otros");
  divi.style.display = "block";
}

function ocultarnavProd(){
  var divi = document.getElementById("accionesProductos");
  divi.style.display = "none";
}

function mostrarInventarioProd() {
  $.ajax({
      url: 'ajax_prod.php',
      type: 'POST',
      data: { 
          accion: 5 
      },beforeSend: function() {
        mostrarLoader();
    },success: function(data) {
          // Parse JSON data received from the server
          var jsonData = JSON.parse(data);
          // Create a table to display the inventory
          var tableHTML = '<table class="table table-striped table-hover" id="tablaMtg">';
          tableHTML += '<thead><tr style="text-align: center;position: sticky; top: 0;"><th>ID Producto</th><th>Producto</th><th>Precio</th><th>Cantidad</th><th>TCG</th><th>Tipo</th></thead>';
          tableHTML += '<tbody>';
          // Iterate through the data and populate the table rows
          for (var i = 0; i < jsonData.length; i++) {
              tableHTML += '<tr style="text-align: center;">';
              tableHTML += '<td>' + jsonData[i].ID_PRODUCTO + '</td>';
              tableHTML += '<td>' + jsonData[i].NOMBRE_PRODUCTO + '</td>';
              tableHTML += `
              <td>
                  <input 
                      type="number" 
                      class="form-control form-control-sm input-precios"
                      data-id="${jsonData[i].ID_PRODUCTO}"
                      value="${jsonData[i].PRECIO}"
                  >
              </td>`;
              tableHTML += `
              <td>
                  <input 
                      type="number" 
                      class="form-control form-control-sm input-cantidads"
                      data-id="${jsonData[i].ID_PRODUCTO}"
                      value="${jsonData[i].CANTIDAD}"
                  >
              </td>`;
              tableHTML += '<td>' + jsonData[i].TCG + '</td>';
              tableHTML += '<td>' + jsonData[i].PRODUCTO + '</td>';
              tableHTML += '</tr>';
          }
          tableHTML += '</tbody></table>';
          // Update the HTML content of the div with the inventory table
          $('#tableContainerMTG').html(tableHTML);
          // Show the div containing the inventory table
          $('#divInvMtg').show();
          ocultarLoader();
      }
  });
}

function ver_pedidos(){
  $('#cuerpo_tabla_pedidos').empty();
  var divi = document.getElementById("pedidosAdmin");
  divi.style.display = "block";

  $.ajax({
    type: "POST",
    url: "ajax_admin.php",
    dataType: "json",
    data: {
        accion: 1
    },
    success: function(data) {
      console.log(data);
      // Iteramos sobre los datos recibidos
      $.each(data, function(index, pedido) {
        // Creamos una nueva fila para cada pedido
        var nuevaFila = $('<tr>');
        // Añadimos las celdas con los datos del pedido
        nuevaFila.append('<td>' + pedido.ID_PEDIDO + '</td>');
        nuevaFila.append('<td>' + pedido.PEDIDOT + '</td>');
        nuevaFila.append('<td>' + pedido.DIRECCION + '</td>');
        nuevaFila.append('<td>' + pedido.CLIENTE + '</td>');
        nuevaFila.append('<td>' + pedido.NUM_TEL + '</td>');
        nuevaFila.append('<td>' + pedido.COMENTARIOS + '</td>');
    
        // Creamos una lista para los artículos
        var listaArticulos = $('<ul>');
        $.each(JSON.parse(pedido.ARTICULOS), function(index, articulo) {
            console.log("Artículo:", articulo);
            var listItem = $('<li>').text(
                '' + articulo.nombreProducto +
                ', Condición: ' + articulo.condicion +
                ', Idioma: ' + articulo.idioma +
                ', Foil: ' + articulo.foil
            );
            listaArticulos.append(listItem);
        });
    
        // Agregamos la lista de artículos a la celda de ARTICULOS
        var celdaArticulos = $('<td>').append(listaArticulos);
        nuevaFila.append(celdaArticulos);
        nuevaFila.append('<td>' + pedido.FECHA_PEDIDO + '</td>');
        nuevaFila.append('<td>' + pedido.ESTATUS_PED + '</td>');
    
        // Creamos la lista desplegable con opciones
        var opciones = {
            1: 'En proceso',
            2: 'Enviado',
            3: 'Entregado en tienda',
            4: 'Cancelado',
            4: 'Pedido Creado'
        };
        var selectOptions = '';
        $.each(opciones, function(value, text) {
            var selected = '';
            if (value == pedido.ESTATUS) {
                selected = 'selected';
            }
            selectOptions += '<option value="' + value + '" ' + selected + '>' + text + '</option>';
        });
        var selectCombo = $('<select class="form-control" id="estatusPed">').append(selectOptions);

        var parametroAdicional = pedido.ID_PEDIDO;

        selectCombo.change(function(event) {
          var selectedValue = $(this).val(); // Obtener el valor seleccionado
          console.log("Valor seleccionado: " + selectedValue);
          actualizaPedido(selectedValue, parametroAdicional); // Llamar a la función con el parámetro adicional
      });
    
        // Agregamos la celda del combo select
        var celdaCombo = $('<td>').append(selectCombo);
        nuevaFila.append(celdaCombo);
    
        // Detenemos la propagación del evento click en el select
        celdaCombo.find('select').click(function(event){
          event.stopPropagation();
        });
        // Agregamos la nueva fila al cuerpo de la tabla
        $('#cuerpo_tabla_pedidos').append(nuevaFila);
    
        // Añadimos el evento onclick a la fila
        nuevaFila.click(function() {
            detallePedido(pedido.ID_PEDIDO);
        });
    });      
  },        
  error: function(xhr, textStatus, errorThrown) {
      console.error('Error al obtener los datos:', errorThrown);
  },
});
}

function ver_pedidosVendedor(){
  $('#cuerpo_tabla_pedidos').empty();
  var divi = document.getElementById("pedidosAdmin");
  divi.style.display = "block";

  $.ajax({
    type: "POST",
    url: "ajax_admin.php",
    dataType: "json",
    data: {
        accion: 11
    },
    success: function(data) {
      // Iteramos sobre los datos recibidos
      $.each(data, function(index, pedido) {
          // Creamos una nueva fila para cada pedido
          var nuevaFila = $('<tr>');
          // Añadimos las celdas con los datos del pedido
          nuevaFila.append('<td>' + pedido.ID_PEDIDO + '</td>');
          nuevaFila.append('<td>' + pedido.PEDIDOT + '</td>');
          nuevaFila.append('<td>' + pedido.DIRECCION + '</td>');
          nuevaFila.append('<td>' + pedido.CLIENTE + '</td>');
          nuevaFila.append('<td>' + pedido.NUM_TEL + '</td>');
          nuevaFila.append('<td>' + pedido.COMENTARIOS + '</td>');
  
          // Creamos una lista para los artículos
          var listaArticulos = $('<ul>');
          
          // Procesamos la cadena de ARTICULOS
          var articulos = pedido.ARTICULOS.split('|||');

          $.each(articulos, function(index, articulo) {
              var match = articulo.match(/(.+?) \((\d+)\)$/);
              if (match) {
                  var nombreArticulo = match[1];
                  var cantidad = match[2];
                  var listItem = $('<li>').text(nombreArticulo + ' (cantidad: ' + cantidad + ')');
                  listaArticulos.append(listItem);
              }
          });

          // Agregamos la lista de artículos a la celda de ARTICULOS
          var celdaArticulos = $('<td>').append(listaArticulos);
          nuevaFila.append(celdaArticulos);
          nuevaFila.append('<td>' + pedido.FECHA_PEDIDO + '</td>');
          nuevaFila.append('<td>' + pedido.ESTATUS_PED + '</td>');
  
          // Creamos la lista desplegable con opciones
          var opciones = {
              1: 'En proceso',
              2: 'Enviado',
              3: 'Entregado en tienda',
              4: 'Cancelado',
              5: 'Pedido Creado' // Corrige el valor del estado de pedido creado
          };
          var selectOptions = '';
          $.each(opciones, function(value, text) {
              var selected = '';
              if (value == pedido.ESTATUS) {
                  selected = 'selected';
              }
              selectOptions += '<option value="' + value + '" ' + selected + '>' + text + '</option>';
          });
          var selectCombo = $('<select class="form-control" id="estatusPed">').append(selectOptions);
  
          var parametroAdicional = pedido.ID_PEDIDO;
  
          selectCombo.change(function(event) {
              var selectedValue = $(this).val(); // Obtener el valor seleccionado
              console.log("Valor seleccionado: " + selectedValue);
              actualizaPedido(selectedValue, parametroAdicional); // Llamar a la función con el parámetro adicional
          });
  
          // Agregamos la celda del combo select
          var celdaCombo = $('<td>').append(selectCombo);
          nuevaFila.append(celdaCombo);
  
          // Detenemos la propagación del evento click en el select
          celdaCombo.find('select').click(function(event){
              event.stopPropagation();
          });
          // Agregamos la nueva fila al cuerpo de la tabla
          $('#cuerpo_tabla_pedidos').append(nuevaFila);
  
          // Añadimos el evento onclick a la fila
          nuevaFila.click(function() {
              detallePedido(pedido.ID_PEDIDO);
          });
      });      
  },         
    error: function(xhr, textStatus, errorThrown) {
        console.error('Error al obtener los datos:', errorThrown);
    }
});
}

function actualizaPedido(estatus, idPed){
  var estatusNew = estatus;
  var pedido = idPed;

  if(estatusNew == 2){
    Swal.fire({
      title: "Ingrese el número de guía",
      icon: "infp",
      html: `
        <div class="form-group">
          <input type="text" id="numeroGuia" class="form-control" placeholder="Número de guía">
        </div>
      `,
      showCancelButton: true,
      confirmButtonText: "Enviar",
      cancelButtonText: "Cancelar",
      preConfirm: () => {
        const numeroGuia = document.getElementById('numeroGuia').value;
        if (!numeroGuia) {
          Swal.showValidationMessage("Por favor, ingrese el número de guía");
        }
        return numeroGuia;
      }
    }).then((result) => {
      if (result.isConfirmed) {
        console.log("Número de guía ingresado: " + result.value);
        $.ajax({
          url: 'ajax_admin.php',
          type: 'POST',
          data: {numG : result.value,estatus : estatusNew, idPedido : pedido, accion : 3
          },
          success: function(response) {
              if(response == 'OK'){
                Swal.fire({
                  title: "Datos actualizados!",
                  text: "Los estatus de los pedidos han sido actualizados!",
                  icon: "success"
              });
              }
          },
          error: function(xhr, status, error) {
              // Manejar errores
              console.error(xhr.responseText);
          }
      });
      }
    });
  } else{
    $.ajax({
      url: 'ajax_admin.php',
      type: 'POST',
      data: {estatus : estatusNew, idPedido : pedido, accion : 3
      },
      success: function(response) {
          if(response == 'OK'){
            Swal.fire({
              title: "Datos actualizados!",
              text: "Los estatus de los pedidos han sido actualizados!",
              icon: "success"
          });
          }
      },
      error: function(xhr, status, error) {
          // Manejar errores
          console.error(xhr.responseText);
      }
  });
  }
}

function buscaPedido(){
var pedidoID = $("#buscaPedID").val();

  if(pedidoID == ''){
    Swal.fire({
      title: "Aviso!",
      text: "Debes ingresar el ID del pedido que quieres buscar!",
      icon: "error"
  });
  } else {
    $.ajax({
      url: 'ajax_admin.php',
      type: 'POST',
      data: { idPedido: pedidoID, accion: 10 },
      dataType: 'json', // Asegúrate de que el tipo de datos sea JSON
      success: function(data) {
          // Limpiar la tabla antes de agregar nuevas filas
          $('#cuerpo_tabla_pedidos').empty();
  
          // Iteramos sobre los datos recibidos
          $.each(data, function(index, pedido) {
              // Creamos una nueva fila para cada pedido
              var nuevaFila = $('<tr>');
  
              // Añadimos las celdas con los datos del pedido
              nuevaFila.append('<td>' + pedido.ID_PEDIDO + '</td>');
              nuevaFila.append('<td>' + pedido.PEDIDOT + '</td>');
              nuevaFila.append('<td>' + pedido.DIRECCION + '</td>');
              nuevaFila.append('<td>' + pedido.CLIENTE + '</td>');
              nuevaFila.append('<td>' + pedido.NUM_TEL + '</td>');
              nuevaFila.append('<td>' + pedido.COMENTARIOS + '</td>');
  
              // Creamos una lista para los artículos
              var listaArticulos = $('<ul>');
              $.each(JSON.parse(pedido.ARTICULOS), function(index, articulo) {
                  var listItem = $('<li>').text(articulo[0] + ' (cantidad: ' + articulo[1] + ')');
                  listaArticulos.append(listItem);
              });
  
              // Agregamos la lista de artículos a la celda de ARTICULOS
              var celdaArticulos = $('<td>').append(listaArticulos);
              nuevaFila.append(celdaArticulos);
              nuevaFila.append('<td>' + pedido.FECHA_PEDIDO + '</td>');
              nuevaFila.append('<td>' + pedido.ESTATUS_PED + '</td>');
  
              // Creamos la lista desplegable con opciones
              var opciones = {
                  1: 'En proceso',
                  2: 'Enviado',
                  3: 'Entregado en tienda',
                  4: 'Cancelado',
                  5: 'Pedido Creado' // Cambié el valor 4 a 5 para que sea único
              };
              var selectOptions = '';
              $.each(opciones, function(value, text) {
                  var selected = '';
                  if (value == pedido.ESTATUS) {
                      selected = 'selected';
                  }
                  selectOptions += '<option value="' + value + '" ' + selected + '>' + text + '</option>';
              });
              var selectCombo = $('<select class="form-control" id="estatusPed">').append(selectOptions);
  
              var parametroAdicional = pedido.ID_PEDIDO;
  
              selectCombo.change(function(event) {
                  var selectedValue = $(this).val(); // Obtener el valor seleccionado
                  console.log("Valor seleccionado: " + selectedValue);
                  actualizaPedido(selectedValue, parametroAdicional); // Llamar a la función con el parámetro adicional
              });
  
              // Agregamos la celda del combo select
              var celdaCombo = $('<td>').append(selectCombo);
              nuevaFila.append(celdaCombo);
  
              // Detenemos la propagación del evento click en el select
              celdaCombo.find('select').click(function(event){
                  event.stopPropagation();
              });
  
              // Agregamos la nueva fila al cuerpo de la tabla
              $('#cuerpo_tabla_pedidos').append(nuevaFila);
  
              // Añadimos el evento onclick a la fila
              nuevaFila.click(function() {
                  detallePedido(pedido.ID_PEDIDO);
              });
          });
      },
      error: function(xhr, status, error) {
          // Manejar errores
          console.error(xhr.responseText);
      }
  });  
  }
  }

  function buscaPedidoV(){
    var pedidoID = $("#buscaPedID").val();
    
      if(pedidoID == ''){
        Swal.fire({
          title: "Aviso!",
          text: "Debes ingresar el ID del pedido que quieres buscar!",
          icon: "error"
      });
      } else {
        $.ajax({
          url: 'ajax_admin.php',
          type: 'POST',
          data: { idPedido: pedidoID, accion: 10 },
          dataType: 'json', // Asegúrate de que el tipo de datos sea JSON
          success: function(data) {
              // Limpiar la tabla antes de agregar nuevas filas
              $('#cuerpo_tabla_pedidos').empty();
      
              // Iteramos sobre los datos recibidos
              $.each(data, function(index, pedido) {
                  // Creamos una nueva fila para cada pedido
                  var nuevaFila = $('<tr>');
      
                  // Añadimos las celdas con los datos del pedido
                  nuevaFila.append('<td>' + pedido.ID_PEDIDO + '</td>');
                  nuevaFila.append('<td>' + pedido.PEDIDOT + '</td>');
                  nuevaFila.append('<td>' + pedido.DIRECCION + '</td>');
                  nuevaFila.append('<td>' + pedido.CLIENTE + '</td>');
                  nuevaFila.append('<td>' + pedido.NUM_TEL + '</td>');
                  nuevaFila.append('<td>' + pedido.COMENTARIOS + '</td>');
      
                  // Creamos una lista para los artículos
                  var listaArticulos = $('<ul>');
                  $.each(JSON.parse(pedido.ARTICULOS), function(index, articulo) {
                      var listItem = $('<li>').text(articulo[0] + ' (cantidad: ' + articulo[1] + ')');
                      listaArticulos.append(listItem);
                  });
      
                  // Agregamos la lista de artículos a la celda de ARTICULOS
                  var celdaArticulos = $('<td>').append(listaArticulos);
                  nuevaFila.append(celdaArticulos);
                  nuevaFila.append('<td>' + pedido.FECHA_PEDIDO + '</td>');
                  nuevaFila.append('<td>' + pedido.ESTATUS_PED + '</td>');
      
                  // Creamos la lista desplegable con opciones
                  var opciones = {
                      1: 'En proceso',
                      2: 'Enviado',
                      3: 'Entregado en tienda',
                      4: 'Cancelado',
                      5: 'Pedido Creado' // Cambié el valor 4 a 5 para que sea único
                  };
                  var selectOptions = '';
                  $.each(opciones, function(value, text) {
                      var selected = '';
                      if (value == pedido.ESTATUS) {
                          selected = 'selected';
                      }
                      selectOptions += '<option value="' + value + '" ' + selected + '>' + text + '</option>';
                  });
                  var selectCombo = $('<select class="form-control" id="estatusPed">').append(selectOptions);
      
                  var parametroAdicional = pedido.ID_PEDIDO;
      
                  selectCombo.change(function(event) {
                      var selectedValue = $(this).val(); // Obtener el valor seleccionado
                      console.log("Valor seleccionado: " + selectedValue);
                      actualizaPedido(selectedValue, parametroAdicional); // Llamar a la función con el parámetro adicional
                  });
      
                  // Agregamos la celda del combo select
                  var celdaCombo = $('<td>').append(selectCombo);
                  nuevaFila.append(celdaCombo);
      
                  // Detenemos la propagación del evento click en el select
                  celdaCombo.find('select').click(function(event){
                      event.stopPropagation();
                  });
      
                  // Agregamos la nueva fila al cuerpo de la tabla
                  $('#cuerpo_tabla_pedidos').append(nuevaFila);
      
                  // Añadimos el evento onclick a la fila
                  nuevaFila.click(function() {
                      detallePedido(pedido.ID_PEDIDO);
                  });
              });
          },
          error: function(xhr, status, error) {
              // Manejar errores
              console.error(xhr.responseText);
          }
      });  
      }
      }

function cerrarPedidos2(){
  var divi = document.getElementById("pedidosAdmin");
  divi.style.display = "none";
}

//bitacora pedidos
function detallePedido(idpedido) {
  $.ajax({
      type: "POST",
      url: "ajax_admin.php",
      dataType: "json",
      data: {
          pedido_num: idpedido,
          accion: 4
      },
      success: function(data) {
          console.log(data); // Verifica los datos en la consola del navegador

          // Crear una variable para almacenar el contenido de la tabla
          var tabla = '';

          if (data.length > 0) {
              // Construir la tabla con los nuevos datos si hay registros
              tabla += '<table class="table table-striped-columns table-hover" style="width: 700px;">';
              tabla += '<thead>';
              tabla += '<tr class="table-warning">';
              tabla += '<th>No. PEDIDO</th>';
              tabla += '<th>FECHA</th>';
              tabla += '<th>MOVIMIENTO</th>';
              tabla += '<th>NOMBRE USUARIO</th>';
              tabla += '</tr>';
              tabla += '</thead>';
              tabla += '<tbody>';
              
              // Iterar sobre los datos obtenidos y construir filas de la tabla
              $.each(data, function(index, pedido) {
                  tabla += '<tr>';
                  tabla += '<td>' + pedido.ID_PEDIDO + '</td>';
                  tabla += '<td>' + pedido.ACT_FECHA + '</td>';
                  tabla += '<td>' + pedido.MOVI + '</td>'; // Usar el campo 'MOVI'
                  tabla += '<td>' + pedido.NOMBRE_USUARIO + '</td>';
                  tabla += '</tr>';
              });

              tabla += '</tbody>';
              tabla += '</table>';
          } else {
              // Si no hay registros, mostrar un mensaje
              tabla = '<p>No se encontraron detalles para este pedido.</p>';
          }

          // Mostrar la tabla (o el mensaje) dentro del modal
          Swal.fire({
              title: "DETALLES DEL PEDIDO",
              html: tabla,
              customClass: {
                  popup: 'modal-custom-style'
              }
          });
      },
      error: function(xhr, textStatus, errorThrown) {
          console.error('Error al obtener los datos:', errorThrown);
      }
  });
}

function filtrarPedidos(){
  var filtro = document.getElementById("filtroPedidosA").value;
  $.ajax({
    type: "POST",
    url: "ajax_admin.php",
    dataType: "json",
    data: {
        filtro : filtro,
        accion: 2
    },
    success: function(data) {
      $('#cuerpo_tabla_pedidos').empty();
        // Iteramos sobre los datos recibidos
        $.each(data, function(index, pedido) {
          // Creamos una nueva fila para cada pedido
          var nuevaFila = $('<tr>');
          // Añadimos las celdas con los datos del pedido
          nuevaFila.append('<td>' + pedido.ID_PEDIDO + '</td>');
          nuevaFila.append('<td>' + pedido.PEDIDOT + '</td>');
          nuevaFila.append('<td>' + pedido.DIRECCION + '</td>');
          nuevaFila.append('<td>' + pedido.CLIENTE + '</td>');
          nuevaFila.append('<td>' + pedido.NUM_TEL + '</td>');
          nuevaFila.append('<td>' + pedido.COMENTARIOS + '</td>');
      
          // Creamos una lista para los artículos
          var listaArticulos = $('<ul>');
                $.each(JSON.parse(pedido.ARTICULOS), function(index, articulo) {
                    console.log("Artículo:", articulo);
                    var listItem = $('<li>').text(
                        '' + articulo.nombreProducto +
                        ', Condición: ' + articulo.condicion +
                        ', Idioma: ' + articulo.idioma +
                        ', Foil: ' + articulo.foil
                    );
                    listaArticulos.append(listItem);
                });
      
          // Agregamos la lista de artículos a la celda de ARTICULOS
          var celdaArticulos = $('<td>').append(listaArticulos);
          nuevaFila.append(celdaArticulos);
          nuevaFila.append('<td>' + pedido.FECHA_PEDIDO + '</td>');
          nuevaFila.append('<td>' + pedido.ESTATUS_PED + '</td>');
      
          // Creamos la lista desplegable con opciones
          var opciones = {
              1: 'En proceso',
              2: 'Enviado',
              3: 'Entregado en tienda',
              4: 'Cancelado',
              5: 'Pedido creado'
          };
          var selectOptions = '';
          $.each(opciones, function(value, text) {
              var selected = '';
              if (value == pedido.ESTATUS) {
                  selected = 'selected';
              }
              selectOptions += '<option value="' + value + '" ' + selected + '>' + text + '</option>';
          });
          var selectCombo = $('<select class="form-control" id="estatusPed">').append(selectOptions);
      
          // Agregamos la celda del combo select
          var celdaCombo = $('<td>').append(selectCombo);
          nuevaFila.append(celdaCombo);
      
          // Agregamos la nueva fila al cuerpo de la tabla
          $('#cuerpo_tabla_pedidos').append(nuevaFila);
      
          // Añadimos el evento onclick a la fila
          nuevaFila.click(function() {
              detallePedido(pedido.ID_PEDIDO);
          });
      });      
    },        
    error: function(xhr, textStatus, errorThrown) {
        console.error('Error al obtener los datos:', errorThrown);
    }
});
}

function filtrarPedidosVendedor(){
  var filtro = document.getElementById("filtroPedidos").value;
  $.ajax({
    type: "POST",
    url: "ajax_admin.php",
    dataType: "json",
    data: {
        filtro : filtro,
        accion: 12
    },
    success: function(data) {
      $('#cuerpo_tabla_pedidos').empty();
      // Iteramos sobre los datos recibidos
      $.each(data, function(index, pedido) {
          // Creamos una nueva fila para cada pedido
          var nuevaFila = $('<tr>');
          // Añadimos las celdas con los datos del pedido
          nuevaFila.append('<td>' + pedido.ID_PEDIDO + '</td>');
          nuevaFila.append('<td>' + pedido.PEDIDOT + '</td>');
          nuevaFila.append('<td>' + pedido.DIRECCION + '</td>');
          nuevaFila.append('<td>' + pedido.CLIENTE + '</td>');
          nuevaFila.append('<td>' + pedido.NUM_TEL + '</td>');
          nuevaFila.append('<td>' + pedido.COMENTARIOS + '</td>');
  
          // Creamos una lista para los artículos
          var listaArticulos = $('<ul>');
          
          // Procesamos la cadena de ARTICULOS
          var articulos = pedido.ARTICULOS.split(', ');
          $.each(articulos, function(index, articulo) {
              // Extraemos el nombre del artículo y la cantidad
              var match = articulo.match(/(.+?) \((\d+)\)$/);
              if (match) {
                  var nombreArticulo = match[1];
                  var cantidad = match[2];
                  var listItem = $('<li>').text(nombreArticulo + ' (cantidad: ' + cantidad + ')');
                  listaArticulos.append(listItem);
              }
          });
  
          // Agregamos la lista de artículos a la celda de ARTICULOS
          var celdaArticulos = $('<td>').append(listaArticulos);
          nuevaFila.append(celdaArticulos);
          nuevaFila.append('<td>' + pedido.FECHA_PEDIDO + '</td>');
          nuevaFila.append('<td>' + pedido.ESTATUS_PED + '</td>');
  
          // Creamos la lista desplegable con opciones
          var opciones = {
              1: 'En proceso',
              2: 'Enviado',
              3: 'Entregado en tienda',
              4: 'Cancelado',
              5: 'Pedido Creado' // Corrige el valor del estado de pedido creado
          };
          var selectOptions = '';
          $.each(opciones, function(value, text) {
              var selected = '';
              if (value == pedido.ESTATUS) {
                  selected = 'selected';
              }
              selectOptions += '<option value="' + value + '" ' + selected + '>' + text + '</option>';
          });
          var selectCombo = $('<select class="form-control" id="estatusPed">').append(selectOptions);
  
          var parametroAdicional = pedido.ID_PEDIDO;
  
          selectCombo.change(function(event) {
              var selectedValue = $(this).val(); // Obtener el valor seleccionado
              console.log("Valor seleccionado: " + selectedValue);
              actualizaPedido(selectedValue, parametroAdicional); // Llamar a la función con el parámetro adicional
          });
  
          // Agregamos la celda del combo select
          var celdaCombo = $('<td>').append(selectCombo);
          nuevaFila.append(celdaCombo);
  
          // Detenemos la propagación del evento click en el select
          celdaCombo.find('select').click(function(event){
              event.stopPropagation();
          });
          // Agregamos la nueva fila al cuerpo de la tabla
          $('#cuerpo_tabla_pedidos').append(nuevaFila);
  
          // Añadimos el evento onclick a la fila
          nuevaFila.click(function() {
              detallePedido(pedido.ID_PEDIDO);
          });
      });      
  },         
    error: function(xhr, textStatus, errorThrown) {
        console.error('Error al obtener los datos:', errorThrown);
    }
});
}

//para actualizar masivamente los pedidos
function actualizarPedidos(){
    var checkboxesMarcados = [];
  $('#tabla_pedidos input[type="checkbox"]:checked').each(function() {
      checkboxesMarcados.push($(this).attr('id'));
  });

  var estatusNuevo = $('#estatusPed').val();

  var numero = $('#estatusPed').val();

  // Objeto con los datos a enviar
  var datos = {
      checkboxes: checkboxesMarcados,
      filtro: estatusNuevo
  };

  $.ajax({
    url: 'ajax_admin.php',
    type: 'POST',
    data: {datos, accion : 3
    },
    success: function(response) {
        if(response == 'OK'){
          Swal.fire({
            title: "Datos actualizados!",
            text: "Los estatus de los pedidos han sido actualizados!",
            icon: "success"
        });
        }
    },
    error: function(xhr, status, error) {
        // Manejar errores
        console.error(xhr.responseText);
    }
});
}

function addUsuarioN(){
  var nombre_usuario =   document.getElementById("txtNomUsA").value;
  var correo_usuario =   document.getElementById("txtcorreoA").value;
  var password_usuario = document.getElementById("txtPasswA").value;
  var tipo_usuario =     document.getElementById("tipo_usuA").value;

  $.ajax({
    url: 'ajax_admin.php',
    type: 'POST',
    data: {
      nom_usu : nombre_usuario,
      correo_usu :  correo_usuario,
      contra_usu : password_usuario,
      tipo_usu : tipo_usuario,
      accion : 5
    },
    success: function(response) {
        if(response == 'OK'){
          Swal.fire({
            title: "Usuario añadido!",
            icon: "success"
        });
        }
    },
    error: function(xhr, status, error) {
        // Manejar errores
        console.error(xhr.responseText);
    }
});
}

function limpiarCamposU(){
  document.getElementById("txtNomUsA").value="";
  document.getElementById("txtcorreoA").value="";
  document.getElementById("txtPasswA").value="";
  document.getElementById("tipo_usuA").value="0";
}
/********************* PARA BUSCAR USUARIOS **************************/
$(document).ready(function() {
  $('#buscaUsu').keyup(function() {
      var buscaUsu = $(this).val();
      if (buscaUsu != '') {
          $.ajax({
              url: 'ajax_admin.php',
              type: 'POST',
              data: { 
                  buscaUsu: buscaUsu,
                  accion: 6
              },
              success: function(data) {
                  $('#coincidencias_usuario').html(data);
              }
          });
      } else {
          $('#coincidencias_usuario').html('');
      }
  });
});
/*********** CARGAR EL USUARIO ENCONTRADO ************/
function carga_usuario_encontrado(id_usuario, nombre_usuario, correo, tipo,pass,estatus,venta){
  document.getElementById("txtId_usE").value=id_usuario;
  document.getElementById("txtNomUsE").value=nombre_usuario;
  document.getElementById("txtCorreoE").value=correo;
  document.getElementById("txtPasswE").value=pass;
  document.getElementById("tipo_usuE").value= tipo;
  document.getElementById("estatus_EditUsu").value = estatus;
  document.getElementById("tcg_venta_edit").value = venta;
}

function guardarDataUsu(){
  var id_usuario =       document.getElementById("txtId_usE").value;
  var nombre_usuario =   document.getElementById("txtNomUsE").value;
  var correo_usuario =   document.getElementById("txtCorreoE").value;
  var password_usuario = document.getElementById("txtPasswE").value;
  var tipo_usuario =     document.getElementById("tipo_usuE").value;
  var estatus_usuario =     document.getElementById("estatus_EditUsu").value;

  $.ajax({
    url: 'ajax_admin.php',
    type: 'POST',
    data: {
      id_usuario : id_usuario,
      nom_usu : nombre_usuario,
      correo_usu :  correo_usuario,
      contra_usu : password_usuario,
      tipo_usu : tipo_usuario,
      estatus_usuario: estatus_usuario,
      accion : 7
    },
    success: function(response) {
        if(response == 'OK'){
          limpiarCamposEditU();
          Swal.fire({
            title: "Usuario modificado!",
            icon: "success"
        });
        }
    },
    error: function(xhr, status, error) {
        // Manejar errores
        console.error(xhr.responseText);
    }
});
}

function limpiarCamposEditU(){
  document.getElementById("txtId_usE").value ="";
  document.getElementById("txtNomUsE").value="";
  document.getElementById("txtCorreoE").value="";
  document.getElementById("txtPasswE").value="";
  document.getElementById("tipo_usuE").value="0";
}

function abre_usuario(){
  var datosU = document.getElementById("datosUsuario");
  datosU.style.display = "block";
}

function cierra_usuario(){
  var datosU = document.getElementById("datosUsuario");
  datosU.style.display = "none";
}

$(document).ready(function(){
  // Inicializa el datepicker de Bootstrap
  $('#datepicker_cli').datepicker({
      format: 'yyyy-mm-dd', // Formato de fecha
      autoclose: true // Cierra automáticamente después de seleccionar la fecha
      // Otros opciones de configuración si las necesitas
  });
});

function guardarDatosUsu(tipoUsu){

  if(tipoUsu==1){
    var nombre_cliente = document.getElementById("txtNomCliente").value;
    var apellidoPat =    document.getElementById("txtApePat").value;
    var apellidoMat =   document.getElementById("txtApeMat").value;
    var fecha_nac =   document.getElementById("datepicker_cli").value;
    var num_tel =   document.getElementById("txtNumCliente").value;
  } else{
    var nombre_cliente = document.getElementById("txtNomCliente").value;
    var apellidoPat =    document.getElementById("txtApePat").value;
    var apellidoMat =   document.getElementById("txtApeMat").value;
    var fecha_nac =   document.getElementById("datepicker_cli").value;
    var num_tel =   document.getElementById("txtNumCliente").value;
    var rfc =   document.getElementById("txtRfc").value;
    var banco =   document.getElementById("txtBancoCliente").value;
    var num_cuenta =   document.getElementById("txtNumCCuenta").value;
    var calle = document.getElementById("txtCalle").value;
    var numEx = document.getElementById("txtNumEx").value;
    var numInt = document.getElementById("txtNumInt").value;
    var colonia = document.getElementById("txtColonia").value;
    var cp = document.getElementById("txtCp").value;
    var ciudad = document.getElementById("txtCiudad").value;
    var pais = document.getElementById("txtPais").value;
    var estado = document.getElementById("cboEstado").value;
  }

    

    // Array para almacenar los nombres de los campos faltantes
    var camposFaltantes = [];

    // Verificar cada campo y agregar al array si está vacío
    if (nombre_cliente === "") camposFaltantes.push("Nombre");
    if (apellidoPat === "") camposFaltantes.push("Apellido Paterno");
    if (apellidoMat === "") camposFaltantes.push("Apellido Materno");
    if (fecha_nac === "") camposFaltantes.push("Fecha de Nacimiento");
    if (num_tel === "") camposFaltantes.push("Numero de telefono");
    if (rfc === "") camposFaltantes.push("RFC");
    if (banco === "") camposFaltantes.push("Banco");
    if (num_cuenta === "") camposFaltantes.push("Numero de cuenta");
    if (calle === "") camposFaltantes.push("Calle");
    if (numEx === "") camposFaltantes.push("Calle");
    if (colonia === "") camposFaltantes.push("Calle");
    if (cp === "") camposFaltantes.push("Calle");
    if (ciudad === "") camposFaltantes.push("Calle");
    if (pais === "") camposFaltantes.push("Calle");
    if (estado === "") camposFaltantes.push("Calle");

    // Si hay campos faltantes, mostrar mensaje con SweetAlert2
    if (camposFaltantes.length > 0) {
    var mensaje = "Faltan los siguientes datos:\n\n";
    for (var i = 0; i < camposFaltantes.length; i++) {
        mensaje += camposFaltantes[i] + "\n";
    }

    Swal.fire({
        title: 'Faltan Datos',
        text: mensaje,
        icon: 'warning',
        confirmButtonText: 'Entendido'
    });
    } else {

      $.ajax({
          type: "POST",
          url: "ajax_admin.php",
          dataType: "json",
          data: {
              nombre_cliente : nombre_cliente,
              apellidoPat : apellidoPat,
              apellidoMat : apellidoMat,
              fecha_nac : fecha_nac,
              numerito : num_tel,
              rfc : rfc,
              banco : banco,
              cuenta : num_cuenta,
              calle : calle,
              numEx : numEx,
              colonia : colonia,
              cp : cp,
              ciudad : ciudad,
              pais : pais,
              estado : estado,
              numInt : numInt,
              accion: 8
          },
          success: function(response) {
              if (response.message === "OK") {
                  Swal.fire({
                      title: "Datos actualizados!",
                      text: "Tus datos han sido actualizados de manera correcta!",
                      icon: "success"
                  });
              } else {
                  Swal.fire({
                      title: "Ups!",
                      text: "Algo salió mal, intentalo de nuevo o ponte en contacto con nosotros!",
                      icon: "error"
                  });
              }
          },  
          error: function(xhr, textStatus, errorThrown) {
              
          }
      });
    }
}
/*************************************** FUNCIONES PARA LOS DECKS *****************************************************************/
function decksAcciones(){
  var datosU = document.getElementById("accionesDecks");
  datosU.style.display = "block";
}

function accionesDecks(){
  var datosU = document.getElementById("accionesDecks");
  datosU.style.display = "none";
}

function mostrarAddDeck(){
  var datosU = document.getElementById("agregarDeck");
  datosU.style.display = "block";
}

function cerrar_decksAcciones(){
  var datosU = document.getElementById("agregarDeck");
  datosU.style.display = "none";
}

function mostrarEditarDecks(){
  var datosU = document.getElementById("editarDeck");
  datosU.style.display = "block";
}

function cerrarEditarDecks(){
  var datosU = document.getElementById("editarDeck");
  datosU.style.display = "none";
}

function cerrarAccionesDecks(){
  var datosU = document.getElementById("accionesDecks");
  datosU.style.display = "none";
}

$(document).ready(function() {
  $('#buscaDeck').keyup(function() {
      var buscaCard = $(this).val();
      if (buscaCard != '') {
          $.ajax({
              url: 'ajax_decks.php',
              type: 'POST',
              data: { 
                  buscaCard: buscaCard,
                  accion: 2 
              },
              success: function(data) {
                  $('#coincidencias_decks').html(data);
              }
          });
      } else {
          $('#coincidencias_decks').html('');
      }
  });
});

function carga_deck_encontrado(deck){
  $.ajax({
    url: 'ajax_decks.php',
    type: 'POST',
    data: { 
        id_deck: deck,
        accion: 3 
    },
    dataType: 'json', // Especifica que esperas recibir datos JSON
    success: function(data) {
      // Ocultar el div de cartas encontradas
      $('#div_encontradas').hide();
    
      // Crear una nueva fila para las cartas
      var row = $('<div class="row"></div>');
    
      // Iterar sobre cada dato en data
      data.forEach(function(dato) {
        // Crear una nueva columna para la card
        var col = $('<div class="col-md-4"></div>'); // Utilizamos col-md-4 para que cada card ocupe 1/3 del ancho en dispositivos medianos y grandes
    
        // Crear la card
        var card = $('<div class="card mb-3"></div>'); // Añadimos la clase mb-3 para agregar un margen inferior a las cards
    
        // Añadir la imagen 
        //card.append('<img src="../../imagenes_tcg/mtg/'+dato.CARTA+'_'+dato.EXPANSION+'_'+dato.NUM_COLECCION+'.jpg" class="card-img-top" width="190px;" height="260px;">');
        
        // Añadir el contenido de la card
        var cardBody = $('<div class="card-body"></div>');
        if (dato.CARTA) {
          cardBody.append('<h5 class="card-title">' + dato.CARTA + '</h5>');
        }
        if (dato.CANTIDAD) {
          cardBody.append('<p class="card-text">Cantidad: ' + dato.CANTIDAD + '</p>');
        }
        if (dato.NUM_COLECCION) {
          cardBody.append('<p class="card-text">Num Colección: ' + dato.NUM_COLECCION + '</p>');
        }
        if (dato.EXPANSION) {
          cardBody.append('<p class="card-text">Expansión: ' + dato.EXPANSION + '</p>');
        }

        cardBody.append('<button type="button" class="btn btn-outline-primary" onclick="editaCarta(\'' + dato.CARTA.replace("'", "\\'") + '\', \'' + dato.ID_DECK + '\')">Editar</button>&nbsp;');

        cardBody.append('<button type="button" class="btn btn-outline-danger" onclick="eliminaCarta(\'' + dato.CARTA.replace("'", "\\'") + '\', \'' + dato.ID_DECK + '\')">Eliminar</button>');        

        // Agregar el cuerpo de la card a la card
        card.append(cardBody);
    
        // Agregar la card a la columna
        col.append(card);
    
        // Agregar la columna a la fila
        row.append(col);
      });
      var botoncin = '<button type="button" class="btn btn-primary float-end" onclick="addCartaDeck('+deck+')">Agregar Carta</button>';

      $('#botonAgCdeck').append(botoncin);
      // Agregar la fila con todas las cartas al contenedor
      $('#cartasDeck').append(row);
    },
    
    error: function(xhr, status, error) {
        // Maneja los errores de la solicitud AJAX
        console.error(xhr.responseText); // Muestra el mensaje de error en la consola
    }
});
}

function editaCarta(nomCarta,decksito){
  Swal.fire({
    title: 'Actualiza datos de '+nomCarta,
    html:
      '<input id="nombreCarta" class="form-control" placeholder="Nombre de la carta"><br>' +
      '<input id="cantidad" class="form-control" placeholder="Cantidad"><br>' +
      '<input id="numColeccion" class="form-control" placeholder="Num Coleccion"><br>' +
      '<input id="expansion" class="form-control" placeholder="Expansión"><br>',
    showCancelButton: true,
    confirmButtonText: 'Aceptar',
    cancelButtonText: 'Cancelar',
    focusConfirm: false,
    preConfirm: () => {
      const input1 = Swal.getPopup().querySelector('#nombreCarta').value
      const input2 = Swal.getPopup().querySelector('#cantidad').value
      const input3 = Swal.getPopup().querySelector('#numColeccion').value
      const input4 = Swal.getPopup().querySelector('#expansion').value

      if(input1 != '' && input2 != '' && input3 != '' && input4 != ''){
        //petición ajax para actualizar la carta:
        
          $.ajax({
            type: "POST",
            url: "ajax_decks.php",
            data: {nomCarta : input1, cantidad: input2, coleccion : input3, expansion:input4, accion : 5, deck: decksito, cartaAnt :  nomCarta},
            success: function(response) {
                if (response == 'OK') {
                    Swal.fire({
                        title: "Carta Actualizada!",
                        text: "La carta ha sido actualizada de manera correcta!",
                        icon: "success"
                    });
                } else {
                    Swal.fire({
                        title: "Ups!",
                        text: "Algo salió mal!"+response,
                        icon: "error"
                    });
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                // Manejo de errores
            }
          });
      }else{
        Swal.fire({
          title: "Error!",
          text: "Completa todos los campos!",
          icon: "error"
        });
      }

    }
  })
}

function eliminaCarta(nomCarta,decksito){
  $.ajax({
    type: "POST",
    url: "ajax_decks.php",
    data: {accion : 6, deck: decksito, cartaAnt :  nomCarta},
    success: function(response) {
        if (response == 'OK') {
            Swal.fire({
                title: "Carta Eliminada!",
                text: "La carta ha sido eliminada de manera correcta!",
                icon: "success"
            });
        } else {
            Swal.fire({
                title: "Ups!",
                text: "Algo salió mal!"+response,
                icon: "error"
            });
        }
    },
    error: function(xhr, textStatus, errorThrown) {
        // Manejo de errores
    }
  });
}

function addCartaDeck(decksito){
  Swal.fire({
    title: 'Agrega nueva carta ',
    html:
      '<input id="nombreCarta" class="form-control" placeholder="Nombre de la carta"><br>' +
      '<input id="cantidad" class="form-control" placeholder="Cantidad"><br>' +
      '<input id="numColeccion" class="form-control" placeholder="Num Coleccion"><br>' +
      '<input id="expansion" class="form-control" placeholder="Expansión"><br>',
    showCancelButton: true,
    confirmButtonText: 'Aceptar',
    cancelButtonText: 'Cancelar',
    focusConfirm: false,
    preConfirm: () => {
      const input1 = Swal.getPopup().querySelector('#nombreCarta').value
      const input2 = Swal.getPopup().querySelector('#cantidad').value
      const input3 = Swal.getPopup().querySelector('#numColeccion').value
      const input4 = Swal.getPopup().querySelector('#expansion').value

      if(input1 != '' && input2 != '' && input3 != '' && input4 != ''){
        //petición ajax para actualizar la carta:
        
          $.ajax({
            type: "POST",
            url: "ajax_decks.php",
            data: {nomCarta : input1, cantidad: input2, coleccion : input3, expansion:input4, accion : 7, deck: decksito},
            success: function(response) {
                if (response == 'OK') {
                    Swal.fire({
                        title: "Carta Agregada!",
                        text: "La carta ha sido agregada de manera correcta!",
                        icon: "success"
                    });
                } else {
                    Swal.fire({
                        title: "Ups!",
                        text: "Algo salió mal! "+response,
                        icon: "error"
                    });
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                // Manejo de errores
            }
          });
      }else{
        Swal.fire({
          title: "Error!",
          text: "Completa todos los campos!",
          icon: "error"
        });
      }

    }
  })
}

function addDeck(){
  var nombre_deck = document.getElementById("nom_deck").value;
  var formato_deck = document.getElementById("formato_deck").value;
  var costo_deck = document.getElementById("costo_deck").value;
  var tcg_deck = document.getElementById("tcg_deck").value;
  var lista_deck = document.getElementById("lista_deck").files[0]; // Obtener el archivo

  var camposFaltantes = [];

  // Verificar cada campo y agregar al array si está vacío
  if (nombre_deck === "") camposFaltantes.push("Nombre del deck");
  if (formato_deck === "") camposFaltantes.push("Formato");

  // Si hay campos faltantes, mostrar mensaje con SweetAlert2
  if (camposFaltantes.length > 0) {
      var mensaje = "Faltan los siguientes datos:\n\n";
      for (var i = 0; i < camposFaltantes.length; i++) {
          mensaje += camposFaltantes[i] + "\n";
      }

      Swal.fire({
          title: 'Faltan Datos',
          text: mensaje,
          icon: 'warning',
          confirmButtonText: 'Entendido'
      });
  } else {
      var formData = new FormData();
      formData.append("nombre_deck", nombre_deck);
      formData.append("formato_deck", formato_deck);
      formData.append("costo_deck", costo_deck);
      formData.append("tcg_deck", tcg_deck);
      formData.append("lista_deck", lista_deck); // Adjuntar el archivo al FormData
      formData.append("accion", 9); // Agregar la acción

      $.ajax({
          type: "POST",
          url: "ajax_admin.php",
          data: formData, // Usar el objeto FormData que hemos creado
          processData: false, // Evitar que JQuery procese los datos
          contentType: false, // Evitar que JQuery configure el contentType
          success: function(response) {
              if (response == 'OK') {
                  Swal.fire({
                      title: "Deck agregado!",
                      text: "El deck ha sido agregado de manera correcta!",
                      icon: "success"
                  });
              } else {
                  Swal.fire({
                      title: "Ups!",
                      text: "Algo salió mal!"+response,
                      icon: "error"
                  });
              }
          },
          error: function(xhr, textStatus, errorThrown) {
              // Manejo de errores
          }
      });
  }
}

function ActualizaDecks(){
  var datos = [];

// Iterar sobre cada fila de la tabla
$("#deckEdit tbody tr").each(function(){
    var fila = {};
    
    // Obtener el valor de cada input en la fila
    fila.cantidad = $(this).find("input:eq(0)").val(); // Obtener el valor del primer input en la fila
    fila.carta = $(this).find("input:eq(1)").val();    // Obtener el valor del segundo input en la fila
    fila.expansion = $(this).find("input:eq(2)").val(); // Obtener el valor del tercer input en la fila
    fila.num_coleccion = $(this).find("input:eq(3)").val(); // Obtener el valor del cuarto input en la fila
    
    // Agregar los datos al array
    datos.push(fila);
});

// Enviar los datos mediante AJAX
$.ajax({
    url: "ajax_modifica_decks.php",
    type: "POST",
    data: JSON.stringify(datos),
    contentType: "application/json; charset=utf-8",
    dataType: "json",
    success: function(response){
        // Manejar la respuesta del servidor si es necesario
        console.log(response);
    },
    error: function(xhr, status, error){
        // Manejar errores
        console.error(xhr.responseText);
    }
});
}

function mostrarReservas(){
  $.ajax({
    url: 'ajax_decks.php',
    type: 'POST',
    data: { 
        accion: 4 
    },beforeSend: function() {
      mostrarLoader();
  },success: function(data) {
        // Parse JSON data received from the server
        var jsonData = JSON.parse(data);
        // Create a table to display the inventory
        var tableHTML = '<table class="table table-striped table-hover" id="tablaReservasDeck">';
        tableHTML += '<thead><tr style="text-align: center;position: sticky; top: 0;"><th>ID RESERVA</th><th>DECK RESERVA</th><th>FECHA</th><th>HORA</th><th>USUARIO</th><th>ESTATUS</th></tr></thead>';
        tableHTML += '<tbody>';
        // Iterate through the data and populate the table rows
        for (var i = 0; i < jsonData.length; i++) {
            tableHTML += '<tr style="text-align: center;">';
            tableHTML += '<td>' + jsonData[i].ID_RESERVA + '</td>';
            tableHTML += '<td>' + jsonData[i].NOMBRE_DECK + '</td>';
            tableHTML += '<td>' + jsonData[i].FECHA + '</td>';
            tableHTML += '<td>' + jsonData[i].HORA + '</td>';
            tableHTML += '<td>' + jsonData[i].USUARIO + '</td>';
            tableHTML += '<td><select class="form-control" id="reserva'+jsonData[i].ID_RESERVA+'" onchange="cambiaStatusDeck('+jsonData[i].ID_RESERVA+')">';
        tableHTML += '<option value="1"' + (jsonData[i].ESTATUS === '1' ? ' selected' : '') + '>RESERVADO</option>';
        tableHTML += '<option value="2"' + (jsonData[i].ESTATUS === '2' ? ' selected' : '') + '>RETRASO</option>';
        tableHTML += '<option value="3"' + (jsonData[i].ESTATUS === '3' ? ' selected' : '') + '>CANCELADO</option>';
        tableHTML += '<option value="4"' + (jsonData[i].ESTATUS === '4' ? ' selected' : '') + '>DISPONIBLE</option>';
        tableHTML += '<option value="5"' + (jsonData[i].ESTATUS === '5' ? ' selected' : '') + '>EN USO</option>';
        tableHTML += '</select>';
            tableHTML += '</tr>';
        }
        tableHTML += '</tbody></table>';
        // Update the HTML content of the div with the inventory table
        $('#tableContainerReservas').html(tableHTML);
        // Show the div containing the inventory table
        $('#divReservas').show();
        ocultarLoader();
    }
});
}

//función para cambiar el estatus del deck
function cambiaStatusDeck(idReservita){
  var id_reserva = document.getElementById("reserva"+idReservita).value;

  $.ajax({
    url: 'ajax_decks.php',
    type: 'POST',
    data: { 
        reserva : idReservita,
        estatusN : id_reserva,
        accion: 8 
    },
    success: function(response) {
      if(response == 'OK'){
        Swal.fire({
          title: "Datos actualizados!",
          text: "Se ha guardado el estatus del deck!",
          icon: "success"
      });
      }
    },
    error: function(xhr, status, error) {
      Swal.fire({
        title: "Santos bacalaos!",
        text: "Se produjo un error! "+xhr.responseText,
        icon: "error"
    });
    }
});
}

function cerrarReservas(){
  $('#divReservas').hide();
}
 /******************************** FUNCIONES POKE *******************************/
function guardarCartaP(){
  var nombre_carta = document.getElementById("txtNomCartaP").value;
  var expansion =    document.getElementById("cbExpansionP").value;
  var precio =       document.getElementById("txtPrecioP").value;
  var cantidad =     document.getElementById("txtCantidP").value;
  var foil =         document.getElementById("tipoFoilP").value;
  var condicion =    document.getElementById("condi_cartaP").value;
  var idioma =       document.getElementById("txtIdiomaP").value;
  var numero_carta = document.getElementById("txtNumColP").value;

  if (nombre_carta === "" || expansion === "0" || precio === "" || cantidad === "" || foil === "0" || condicion === "0" || idioma === ""|| numero_carta === "") {
    // Al menos un campo está vacío o no seleccionado, mostrar mensaje de error
    var mensajeError = "Por favor, completa los siguientes campos:\n";

    if (nombre_carta === "") mensajeError += "- Nombre de la carta\n";
    if (expansion === "0") mensajeError += "- Expansión\n";
    if (precio === "") mensajeError += "- Precio\n";
    if (cantidad === "") mensajeError += "- Cantidad\n";
    if (foil === "0") mensajeError += "- Foil\n";
    if (condicion === "0") mensajeError += "- Condición\n";
    if (idioma === "") mensajeError += "- Idioma\n";
    if (!numero_carta) mensajeError += "- Número\n";

    // Mostrar mensaje de error
    Swal.fire({
        title: 'Error',
        text: mensajeError,
        icon: 'error',
        confirmButtonText: 'Aceptar'
    });
} else {
  Swal.fire({
    title: "Deseas guardar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si"
  }).then((result) => {
    if (result.isConfirmed) {
      var datos = {
        nombre_carta: nombre_carta,
        expansion: expansion,
        precio: precio,
        cantidad: cantidad,
        foil: foil,
        condicion : condicion,
        idioma : idioma,
        numerocol : numero_carta,
        accion : 1
    };
    // Enviar los datos al servidor usando AJAX
    fetch('ajax_poke.php', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/x-www-form-urlencoded' // Cambia el tipo de contenido
      },
      body: new URLSearchParams(datos).toString() // Convierte los datos a formato de formulario
  })
  .then(response => response.text()) // Espera una respuesta de texto
  .then(data => {
      if(data == 'OK'){
        Swal.fire({
          title: "Datos guardados!",
          text: "Los datos de la carta han sido guardados correctamente!",
          icon: "success"
        });
        limpiarCamposP()
      }
  })
    }
  });
}
}

function limpiarCamposP(){
  document.getElementById("txtNomCartaP").value = "";
  document.getElementById("cbExpansionP").value = "0";
  document.getElementById("txtPrecioP").value= "";
  document.getElementById("txtCantidP").value= "";
  document.getElementById("tipoFoilP").value= "0";
  document.getElementById("condi_cartaP").value= "";
  document.getElementById("txtIdiomaP").value= "";
  document.getElementById("txtNumColP").value= "";
}

$(document).ready(function() {
  $('#buscaCardP').keyup(function() {
      var buscaCard = $(this).val();
      if (buscaCard != '') {
          $.ajax({
              url: 'ajax_poke.php',
              type: 'POST',
              data: { 
                  buscaCard: buscaCard,
                  accion: 2 
              },
              success: function(data) {
                  $('#coincidenciasPoke').html(data);
              }
          });
      } else {
          $('#coincidenciasPoke').html('');
      }
  });
});

function actualizar_cartasP(){
  var id_cartita = document.getElementById("id_carta_encontradaP").value;
  var nombre_carta = document.getElementById("txtNomCartaEditP").value;
  var precio =       document.getElementById("txtPrecioEditP").value;
  var cantidad =     document.getElementById("txtCantidEditP").value;
  var foil =         document.getElementById("tipoFoilEditP").value;
  var condicion =    document.getElementById("condi_carta_editP").value;
  var idioma =       document.getElementById("txtIdiomaEditP").value;

  if (nombre_carta === "" ||  precio === "" || cantidad === "" || foil === "0" || condicion === "0" || idioma === "") {
    // Al menos un campo está vacío o no seleccionado, mostrar mensaje de error
    var mensajeError = "Por favor, completa los siguientes campos:\n";

    if (nombre_carta === "") mensajeError += "- Nombre de la carta\n";
    if (precio === "") mensajeError += "- Precio\n";
    if (cantidad === "") mensajeError += "- Cantidad\n";
    if (foil === "0") mensajeError += "- Foil\n";
    if (condicion === "0") mensajeError += "- Condición\n";
    if (idioma === "") mensajeError += "- Idioma\n";

    // Mostrar mensaje de error
    Swal.fire({
        title: 'Error',
        text: mensajeError,
        icon: 'error',
        confirmButtonText: 'Aceptar'
    });
} else {
  Swal.fire({
    title: "Deseas guardar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si"
  }).then((result) => {
    if (result.isConfirmed) {
      var datos = {
        nombre_carta: nombre_carta,
        precio: precio,
        cantidad: cantidad,
        foil: foil,
        condicion : condicion,
        idioma : idioma,
        id_cart : id_cartita,
        accion : 4
    };
    // Enviar los datos al servidor usando AJAX
    fetch('ajax_poke.php', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/x-www-form-urlencoded' // Cambia el tipo de contenido
      },
      body: new URLSearchParams(datos).toString() // Convierte los datos a formato de formulario
  })
  .then(response => response.text()) // Espera una respuesta de texto
  .then(data => {
      if(data == 'OK'){
        Swal.fire({
          title: "Datos actualizados!",
          text: "Los datos de la carta han sido actualizados correctamente!",
          icon: "success"
        });
        limpiarCamposP2()
      }
  })
  .catch(error => {
      console.error('Error al enviar los datos:', error);
  });
    }
  });
}
}

function limpiarCamposP2(){
  document.getElementById("id_carta_encontradaP").value = "";
  document.getElementById("txtNomCartaEditP").value = "";
  document.getElementById("cbExpansionEditP").value= "0";
  document.getElementById("txtPrecioEditP").value= "";
  document.getElementById("txtCantidEditP").value= "";
  document.getElementById("txtArtistaEditP").value= "";
  document.getElementById("tipoFoilEditP").value= "0";
  document.getElementById("condi_carta_editP").value= "";
  document.getElementById("txtIdiomaEditP").value= "";
}

function carga_carta_encontradaP(id_carta) {
  $.ajax({
      url: 'ajax_poke.php',
      type: 'POST',
      data: { 
          id_carta: id_carta,
          accion: 3 
      },
      dataType: 'json', // Especifica que esperas recibir datos JSON
      success: function(data) {
        //console.log(data);
        $('#id_carta_encontradaP').val(data[0].ID_CARTA);
        $('#txtNomCartaEditP').val(data[0].NOM_CARTA);
        $('#txtPrecioEditP').val(data[0].PRECIO);
        $('#txtCantidEditP').val(data[0].CANTIDAD);
        $('#condi_carta_editP').val(data[0].CONDICION);
        $('#txtIdiomaEditP').val(data[0].IDIOMA);
        $('#tipoFoilEditP').val(data[0].FOIL);

        $('#div_encontradas').hide();
      },
      error: function(xhr, status, error) {
          // Maneja los errores de la solicitud AJAX
          console.error(xhr.responseText); // Muestra el mensaje de error en la consola
      }
  });
}

function mostrarInventarioPoke(tipo_usuario){
  $.ajax({
    url: 'ajax_poke.php',
    type: 'POST',
    data: { 
        accion: 5,
        tipo_usu : tipo_usuario
    },beforeSend: function() {
      mostrarLoader();
  },success: function(data) {
        // Parse JSON data received from the server
        var jsonData = JSON.parse(data);
        // Create a table to display the inventory
        var tableHTML = '<table class="table table-striped table-hover" id="tablaPoke">';
        tableHTML += '<thead><tr style="text-align: center;position: sticky; top: 0;"><th>ID_Carta</th><th>Nombre de la Carta</th><th>Expansión</th><th>Precio</th><th>Cantidad</th><th>Idioma</th><th>Condición</th><th>Foil</th></tr></thead>';
        tableHTML += '<tbody>';
        // Iterate through the data and populate the table rows
        for (var i = 0; i < jsonData.length; i++) {
            tableHTML += '<tr style="text-align: center;">';
            tableHTML += '<td>' + jsonData[i].ID_CARTA + '</td>';
            tableHTML += '<td>' + jsonData[i].NOM_CARTA + '</td>';
            tableHTML += '<td>' + jsonData[i].EXPANSION + '</td>';
            tableHTML += `
              <td>
                  <input 
                      type="number" 
                      class="form-control form-control-sm input-precio"
                      data-id="${jsonData[i].ID_CARTA}"
                      data-idioma="${jsonData[i].IDIOMA}"
                      data-foil="${jsonData[i].FOIL}"
                      data-condicion="${jsonData[i].CONDICION}"
                      value="${jsonData[i].PRECIO}"
                  >
              </td>`;
              tableHTML += `
              <td>
                  <input 
                      type="number" 
                      class="form-control form-control-sm input-cantidad"
                      data-id="${jsonData[i].ID_CARTA}"
                      data-idioma="${jsonData[i].IDIOMA}"
                      data-foil="${jsonData[i].FOIL}"
                      data-condicion="${jsonData[i].CONDICION}"
                      value="${jsonData[i].CANTIDAD}"
                  >
              </td>`;
            tableHTML += '<td>' + jsonData[i].IDIOMA + '</td>';
            tableHTML += '<td>' + jsonData[i].CONDICION + '</td>';
            tableHTML += '<td>' + jsonData[i].FOIL + '</td>';
            tableHTML += '</tr>';
        }
        tableHTML += '</tbody></table>';
        // Update the HTML content of the div with the inventory table
        $('#tableContainerPOKE').html(tableHTML);
        // Show the div containing the inventory table
        $('#divInvPoke').show();
        ocultarLoader();
    }
});
}

function exportarExcelPoke(){
  // Obtener los datos de la tabla
  var tabla = document.getElementById('tablaPoke');
  var tablaDatos = [];
  var filas = tabla.rows;
  for (var i = 0; i < filas.length; i++) {
      var fila = [],
          celdas = filas[i].cells;
      for (var j = 0; j < celdas.length; j++) {
          fila.push(celdas[j].innerText);
      }
      tablaDatos.push(fila);
  }
  // Crear un objeto de libro de trabajo de Excel
  var libro = XLSX.utils.book_new();
  var hoja = XLSX.utils.aoa_to_sheet(tablaDatos);
  XLSX.utils.book_append_sheet(libro, hoja, 'Inventario MTG');
  // Guardar el archivo de Excel
  XLSX.writeFile(libro, 'inventario_mtg.xlsx');
}

function cerrarInvPoke(){
  $('#divInvPoke').hide();
}

function mostrarExpansionesP(){
  var divAñadir = document.getElementById("expansionesAddP");
  divAñadir.style.display = "block";
}

function cerrarAddExP(){
  var divAñadir = document.getElementById("expansionesAddP");
  divAñadir.style.display = "none";
}

document.addEventListener("DOMContentLoaded", function() {
  $(document).ready(function(){
    $('#datepickerP').datepicker({
        format: 'dd/mm/yyyy', // Puedes cambiar el formato de la fecha según tus necesidades
        autoclose: true,
        language: 'es' // Configura el idioma a español
    });
});
});

function agregar_expanP(){
  var nombre_largo = document.getElementById("txtNomExpanP").value;
  var nombre_corto = document.getElementById("txtNomCortoP").value;
  var fecha_lanz =   document.getElementById("datepickerP").value;

  if (nombre_largo === "" || nombre_corto === "" || fecha_lanz === "") {
    // Al menos un campo está vacío o no seleccionado, mostrar mensaje de error
    var mensajeError = "Por favor, completa los siguientes campos:\n";

    if (nombre_largo === "") mensajeError += "- Nombre de la expansión\n";
    if (nombre_corto === "0") mensajeError += "- Nombre corto\n";
    if (fecha_lanz === "") mensajeError += "- Fecha de lanzamiento\n";

    // Mostrar mensaje de error
    Swal.fire({
        title: 'Error',
        text: mensajeError,
        icon: 'error',
        confirmButtonText: 'Aceptar'
    });
} else{
  Swal.fire({
    title: "Deseas guardar la expansión?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si"
  }).then((result) => {
    if (result.isConfirmed) {
      var datos = {
        expansion: nombre_largo,
        nom_corto: nombre_corto,
        fecha_lanzamiento: fecha_lanz,
        accion : 7
    };
    // Enviar los datos al servidor usando AJAX
    fetch('ajax_poke.php', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/x-www-form-urlencoded' // Cambia el tipo de contenido
      },
      body: new URLSearchParams(datos).toString() // Convierte los datos a formato de formulario
  })
  .then(response => response.text()) // Espera una respuesta de texto
  .then(data => {
      if(data == 'OK'){
        Swal.fire({
          title: "Datos guardados!",
          text: "Los datos de la expansión han sido guardados correctamente!",
          icon: "success"
        });
        limpiarCampos3()
      }
  })
  .catch(error => {
      console.error('Error al enviar los datos:', error);
  });
    }
  });
}
}

function mostrarExpansionesP(){
  var mostrar = document.getElementById("accionesExpansionesP");
  mostrar.style.display = "block";
}

function mostrarAddExP(){
  var mostrar = document.getElementById("expansionesAddP");
  mostrar.style.display = "block";
}

function cerrarAccionesExpP(){
  var mostrar = document.getElementById("accionesExpansionesP");
  mostrar.style.display = "none";
}

/************************* función para buscar coincidencias de expansiones poke********************************************************/
$(document).ready(function() {
  $('#buscaExpanP').keyup(function() {
      var buscaCard = $(this).val();
      if (buscaCard != '') {
          $.ajax({
              url: 'ajax_poke.php',
              type: 'POST',
              data: { 
                  buscaCard: buscaCard,
                  accion: 8 
              },
              success: function(data) {
                  $('#coincidencias_expanP').html(data);
              }
          });
      } else {
          $('#coincidencias_expanP').html('');
      }
  });
});

function mostrarExpansionesEditP(){
  var mostrar = document.getElementById("expansionesEditP");
  mostrar.style.display = "block";
}

function cerrarEditExP(){
  var mostrar = document.getElementById("expansionesEditP");
  mostrar.style.display = "none";
}

function carga_expan_encontradaP(id_carta,expan,expan_corto,lanzamiento){
  $('#txtNomExpan_2P').val(expan);
  $('#txtNomCorto_2P').val(expan_corto);
  $('#datepicker_2P').val(lanzamiento);
  $('#id_expansion_encontradaP').val(id_carta);
}

function actualizar_expanP(){
  var id_expan = document.getElementById("id_expansion_encontradaP").value;
  var nombre_largo = document.getElementById("txtNomExpan_2P").value;
  var nombre_corto = document.getElementById("txtNomCorto_2P").value;
  var fecha_lanz =   document.getElementById("datepicker_2P").value;


  Swal.fire({
    title: "Deseas actualizar la expansión?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si"
  }).then((result) => {
    if (result.isConfirmed) {
      var datos = {
        id_expan : id_expan,
        expansion: nombre_largo,
        nom_corto: nombre_corto,
        fecha_lanzamiento: fecha_lanz,
        accion : 9
    };
    // Enviar los datos al servidor usando AJAX
    fetch('ajax_poke.php', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/x-www-form-urlencoded' // Cambia el tipo de contenido
      },
      body: new URLSearchParams(datos).toString() // Convierte los datos a formato de formulario
  })
  .then(response => response.text()) // Espera una respuesta de texto
  .then(data => {
      if(data == 'OK'){
        Swal.fire({
          title: "Datos guardados!",
          text: "Los datos de la expansión han sido actualizados correctamente!",
          icon: "success"
        });
        limpiarCampos4()
      }
  })
  .catch(error => {
      console.error('Error al enviar los datos:', error);
  });
    }
  });
}
 /******************************** FIN FUNCIONES POKE *******************************/
  /******************************** FUNCIONES YUGI *******************************/
  function guardarCartaY(){
    var nombre_carta = document.getElementById("txtNomCartaY").value;
   var expansion =    document.getElementById("cbExpansionY").value;
   var precio =       document.getElementById("txtPrecioY").value;
   var rareza =       document.getElementById("cboRarezaY").value;
   var cantidad =     document.getElementById("txtCantidY").value;
   var artista =      document.getElementById("txtArtistaY").value;
   var foil =         document.getElementById("tipoFoilY").value;
   var condicion =    document.getElementById("condi_cartaY").value;
   var idioma =       document.getElementById("txtIdiomaY").value;
   var numero_carta = document.getElementById("txtNumColY").value;
   var texto = document.getElementById("floatingTextareaY").value;
 
   var imagen = document.getElementById("fileToUploadY").files[0]; // Obtener el archivo de imagen
 
   if (nombre_carta === "" || expansion === "0" || rareza === "0" || precio === "" || texto === "" || cantidad === "" || artista === "" || foil === "0" || condicion === "0" || idioma === "" || !imagen || numero_carta === "") {
     // Al menos un campo está vacío o no seleccionado, mostrar mensaje de error
     var mensajeError = "Por favor, completa los siguientes campos:\n";
 
     if (nombre_carta === "") mensajeError += "- Nombre de la carta\n";
     if (expansion === "0") mensajeError += "- Expansión\n";
     if (precio === "") mensajeError += "- Precio\n";
     if (cantidad === "") mensajeError += "- Cantidad\n";
     if (artista === "") mensajeError += "- Artista\n";
     if (foil === "0") mensajeError += "- Foil\n";
     if (condicion === "0") mensajeError += "- Condición\n";
     if (rareza === "0") mensajeError += "- Rareza\n";
     if (idioma === "") mensajeError += "- Idioma\n";
     if (texto === "") mensajeError += "- Texto\n";
     if (!imagen) mensajeError += "- Imagen\n";
     if (!numero_carta) mensajeError += "- Número\n";
 
     // Mostrar mensaje de error
     Swal.fire({
         title: 'Error',
         text: mensajeError,
         icon: 'error',
         confirmButtonText: 'Aceptar'
     });
 } else {
   Swal.fire({
     title: "Deseas guardar?",
     icon: "warning",
     showCancelButton: true,
     confirmButtonColor: "#3085d6",
     cancelButtonColor: "#d33",
     confirmButtonText: "Si"
   }).then((result) => {
     if (result.isConfirmed) {
       var datos = {
         nombre_carta: nombre_carta,
         expansion: expansion,
         precio: precio,
         cantidad: cantidad,
         artista: artista,
         foil: foil,
         condicion : condicion,
         idioma : idioma,
         numerocol : numero_carta,
         texto_carta : texto,
         rareza : rareza,
         accion : 1
     };
     // Enviar los datos al servidor usando AJAX
     fetch('ajax_yugi.php', {
       method: 'POST',
       headers: {
           'Content-Type': 'application/x-www-form-urlencoded' // Cambia el tipo de contenido
       },
       body: new URLSearchParams(datos).toString() // Convierte los datos a formato de formulario
   })
   .then(response => response.text()) // Espera una respuesta de texto
   .then(data => {
       if(data == 'OK'){
         var formData = new FormData();
     formData.append('fileToUpload', imagen);
     formData.append('nombre_carta', datos.nombre_carta);
     formData.append('expansion', datos.expansion);
     formData.append('num_carta', datos.numerocol);
     for (var key in datos) {
         formData.append(key, datos[key]);
     }
     // Enviar los datos al servidor usando AJAX
     fetch('upload_poke.php', {
         method: 'POST',
         body: formData,
         nombre_carta: nombre_carta,
         num_carta: datos.numerocol,
         expansion: expansion,
     })
     .then(response => response.text())
     .then(data => {
         // Resto del código para manejar la respuesta del servidor
     })
     .catch(error => {
         console.error('Error al enviar los datos:', error);
     });
         Swal.fire({
           title: "Datos guardados!",
           text: "Los datos de la carta han sido guardados correctamente!",
           icon: "success"
         });
         limpiarCamposY()
       }
   })
   .catch(error => {
       console.error('Error al enviar los datos:', error);
   });
     }
   });
 }
 }

 function limpiarCamposY(){
  document.getElementById("txtNomCartaY").value = "";
  document.getElementById("cbExpansionY").value = "0";
  document.getElementById("txtPrecioY").value= "";
  document.getElementById("cboRarezaY").value= "0";
  document.getElementById("txtCantidY").value= "";
  document.getElementById("txtArtistaY").value= "";
  document.getElementById("tipoFoilY").value= "0";
  document.getElementById("condi_cartaY").value= "";
  document.getElementById("txtIdiomaY").value= "";
  document.getElementById("txtNumColY").value= "";
  document.getElementById("floatingTextareaY").value= "";
  document.getElementById("fileToUploadY").value= "";
}
 
 function mostrarEditarY(){
   var divAñadir = document.getElementById("editarCartasY");
   divAñadir.style.display = "block";
 }
 
 function cerrarEditarY(){
   var divAñadir = document.getElementById("editarCartasY");
   divAñadir.style.display = "none";
 }
 
 $(document).ready(function() {
   $('#buscaCardY').keyup(function() {
       var buscaCard = $(this).val();
       if (buscaCard != '') {
           $.ajax({
               url: 'ajax_yugi.php',
               type: 'POST',
               data: { 
                   buscaCard: buscaCard,
                   accion: 2 
               },
               success: function(data) {
                   $('#coincidenciasY').html(data);
               }
           });
       } else {
           $('#coincidenciasY').html('');
       }
   });
 });
 
 function actualizar_cartasY(){
   var id_cartita =   document.getElementById("id_carta_encontradaY").value;
   var nombre_carta = document.getElementById("txtNomCartaEditY").value;
   var expansion =    document.getElementById("cbExpansionEditY").value;
   var rareza =       document.getElementById("rarezaEditY").value;
   var precio =       document.getElementById("txtPrecioEditY").value;
   var cantidad =     document.getElementById("txtCantidEditY").value;
   var artista =      document.getElementById("txtArtistaEditY").value;
   var foil =         document.getElementById("tipoFoilEditY").value;
   var condicion =    document.getElementById("condi_carta_editY").value;
   var texto =        document.getElementById("floatingTextareaEditY").value;
   var idioma =       document.getElementById("txtIdiomaEditY").value;
 
   if (nombre_carta === "" || expansion === "0"  || rareza === "0" || precio === "" || cantidad === "" || artista === "" || foil === "0" || texto === "" || condicion === "0" || idioma === "") {
     // Al menos un campo está vacío o no seleccionado, mostrar mensaje de error
     var mensajeError = "Por favor, completa los siguientes campos:\n";
 
     if (nombre_carta === "") mensajeError += "- Nombre de la carta\n";
     if (expansion === "0") mensajeError += "- Expansión\n";
     if (precio === "") mensajeError += "- Precio\n";
     if (cantidad === "") mensajeError += "- Cantidad\n";
     if (artista === "") mensajeError += "- Artista\n";
     if (foil === "0") mensajeError += "- Foil\n";
     if (condicion === "0") mensajeError += "- Condición\n";
     if (idioma === "") mensajeError += "- Idioma\n";
     if (texto === "") mensajeError += "- Texto\n";
     if (rareza === "") mensajeError += "- Rareza\n";
 
     // Mostrar mensaje de error
     Swal.fire({
         title: 'Error',
         text: mensajeError,
         icon: 'error',
         confirmButtonText: 'Aceptar'
     });
 } else {
   Swal.fire({
     title: "Deseas guardar?",
     icon: "warning",
     showCancelButton: true,
     confirmButtonColor: "#3085d6",
     cancelButtonColor: "#d33",
     confirmButtonText: "Si"
   }).then((result) => {
     if (result.isConfirmed) {
       var datos = {
         nombre_carta: nombre_carta,
         expansion: expansion,
         precio: precio,
         cantidad: cantidad,
         artista: artista,
         foil: foil,
         condicion : condicion,
         idioma : idioma,
         id_cart : id_cartita,
         rareza : rareza,
         texto : texto,
         accion : 4
     };
     // Enviar los datos al servidor usando AJAX
     fetch('ajax_yugi.php', {
       method: 'POST',
       headers: {
           'Content-Type': 'application/x-www-form-urlencoded' // Cambia el tipo de contenido
       },
       body: new URLSearchParams(datos).toString() // Convierte los datos a formato de formulario
   })
   .then(response => response.text()) // Espera una respuesta de texto
   .then(data => {
       if(data == 'OK'){
         Swal.fire({
           title: "Datos actualizados!",
           text: "Los datos de la carta han sido actualizados correctamente!",
           icon: "success"
         });
         limpiarCamposY2()
       }
   })
   .catch(error => {
       console.error('Error al enviar los datos:', error);
   });
     }
   });
 }
 }

 function limpiarCamposY2(){
  document.getElementById("id_carta_encontradaY").value = "";
  document.getElementById("txtNomCartaEditY").value = "";
  document.getElementById("cbExpansionEditY").value= "0";
  document.getElementById("rarezaEditY").value= "0";
  document.getElementById("txtPrecioEditY").value= "";
  document.getElementById("txtCantidEditY").value= "";
  document.getElementById("txtArtistaEditY").value= "";
  document.getElementById("tipoFoilEditY").value= "0";
  document.getElementById("condi_carta_editY").value= "";
  document.getElementById("floatingTextareaEditY").value= "";
  document.getElementById("txtIdiomaEditY").value= "";
}
 
 function carga_carta_encontradaY(id_carta) {
   $.ajax({
       url: 'ajax_yugi.php',
       type: 'POST',
       data: { 
           id_carta: id_carta,
           accion: 3 
       },
       dataType: 'json', // Especifica que esperas recibir datos JSON
       success: function(data) {
         //console.log(data);
         $('#id_carta_encontradaY').val(data[0].ID_CARTA);
         $('#txtNomCartaEditY').val(data[0].NOM_CARTA);
         $('#cbExpansionEditY').val(data[0].EXPANSION);
         $('#txtPrecioEditY').val(data[0].PRECIO);
         $('#txtCantidEditY').val(data[0].CANTIDAD);
         $('#txtArtistaEditY').val(data[0].ARTISTA);
         $('#tipoFoilEditY').val(data[0].FOIL);
         $('#condi_carta_editY').val(data[0].CONDICION);
         $('#txtIdiomaEditY').val(data[0].IDIOMA);
         $('#rarezaEditY').val(data[0].RAREZA);
         $('#floatingTextareaEditY').val(data[0].TEXTO_CARTA);
 
         $('#div_encontradasY').hide();
       },
       error: function(xhr, status, error) {
           // Maneja los errores de la solicitud AJAX
           console.error(xhr.responseText); // Muestra el mensaje de error en la consola
       }
   });
 }
 
 function mostrarInventarioYug(){
   $.ajax({
     url: 'ajax_yugi.php',
     type: 'POST',
     data: { 
         accion: 5 
     },beforeSend: function() {
       mostrarLoader();
   },success: function(data) {
         // Parse JSON data received from the server
         var jsonData = JSON.parse(data);
         // Create a table to display the inventory
         var tableHTML = '<table class="table table-striped table-hover" id="tablaYugi">';
         tableHTML += '<thead><tr style="text-align: center;position: sticky; top: 0;"><th>ID_Carta</th><th>Nombre de la Carta</th><th>Expansión</th><th>Precio</th><th>Cantidad</th><th>Idioma</th></tr></thead>';
         tableHTML += '<tbody>';
         // Iterate through the data and populate the table rows
         for (var i = 0; i < jsonData.length; i++) {
             tableHTML += '<tr style="text-align: center;">';
             tableHTML += '<td>' + jsonData[i].ID_CARTA + '</td>';
             tableHTML += '<td>' + jsonData[i].NOM_CARTA + '</td>';
             tableHTML += '<td>' + jsonData[i].EXPANSION + '</td>';
             tableHTML += '<td>' + jsonData[i].PRECIO + '</td>';
             tableHTML += '<td>' + jsonData[i].CANTIDAD + '</td>';
             tableHTML += '<td>' + jsonData[i].IDIOMA + '</td>';
             tableHTML += '</tr>';
         }
         tableHTML += '</tbody></table>';
         // Update the HTML content of the div with the inventory table
         $('#tableContainerYugi').html(tableHTML);
         // Show the div containing the inventory table
         $('#divInvYugi').show();
         ocultarLoader();
     }
 });
 }
 
 function exportarExcelYugi(){
   // Obtener los datos de la tabla
   var tabla = document.getElementById('tablaYugi');
   var tablaDatos = [];
   var filas = tabla.rows;
   for (var i = 0; i < filas.length; i++) {
       var fila = [],
           celdas = filas[i].cells;
       for (var j = 0; j < celdas.length; j++) {
           fila.push(celdas[j].innerText);
       }
       tablaDatos.push(fila);
   }
   // Crear un objeto de libro de trabajo de Excel
   var libro = XLSX.utils.book_new();
   var hoja = XLSX.utils.aoa_to_sheet(tablaDatos);
   XLSX.utils.book_append_sheet(libro, hoja, 'Inventario MTG');
   // Guardar el archivo de Excel
   XLSX.writeFile(libro, 'inventario_mtg.xlsx');
 }
 
 function cerrarInvYugi(){
   $('#divInvYugi').hide();
 }
 
 document.addEventListener("DOMContentLoaded", function() {
   $(document).ready(function(){
     $('#datepickerY').datepicker({
         format: 'dd/mm/yyyy', // Puedes cambiar el formato de la fecha según tus necesidades
         autoclose: true,
         language: 'es' // Configura el idioma a español
     });
 });
 });
 
 function agregar_expanY(){
   var nombre_largo = document.getElementById("txtNomExpanY").value;
   var nombre_corto = document.getElementById("txtNomCortoY").value;
   var fecha_lanz =   document.getElementById("datepickerY").value;
 
   if (nombre_largo === "" || nombre_corto === "" || fecha_lanz === "") {
     // Al menos un campo está vacío o no seleccionado, mostrar mensaje de error
     var mensajeError = "Por favor, completa los siguientes campos:\n";
 
     if (nombre_largo === "") mensajeError += "- Nombre de la expansión\n";
     if (nombre_corto === "0") mensajeError += "- Nombre corto\n";
     if (fecha_lanz === "") mensajeError += "- Fecha de lanzamiento\n";
 
     // Mostrar mensaje de error
     Swal.fire({
         title: 'Error',
         text: mensajeError,
         icon: 'error',
         confirmButtonText: 'Aceptar'
     });
 } else{
   Swal.fire({
     title: "Deseas guardar la expansión?",
     icon: "warning",
     showCancelButton: true,
     confirmButtonColor: "#3085d6",
     cancelButtonColor: "#d33",
     confirmButtonText: "Si"
   }).then((result) => {
     if (result.isConfirmed) {
       var datos = {
         expansion: nombre_largo,
         nom_corto: nombre_corto,
         fecha_lanzamiento: fecha_lanz,
         accion : 7
     };
     // Enviar los datos al servidor usando AJAX
     fetch('ajax_yugi.php', {
       method: 'POST',
       headers: {
           'Content-Type': 'application/x-www-form-urlencoded' // Cambia el tipo de contenido
       },
       body: new URLSearchParams(datos).toString() // Convierte los datos a formato de formulario
   })
   .then(response => response.text()) // Espera una respuesta de texto
   .then(data => {
       if(data == 'OK'){
         Swal.fire({
           title: "Datos guardados!",
           text: "Los datos de la expansión han sido guardados correctamente!",
           icon: "success"
         });
         limpiarCampos3()
       }
   })
   .catch(error => {
       console.error('Error al enviar los datos:', error);
   });
     }
   });
 }
 }
 
 function mostrarExpansionesY(){
   var mostrar = document.getElementById("accionesExpansionesY");
   mostrar.style.display = "block";
 }
 
 function cerrarAccionesExpY(){
   var mostrar = document.getElementById("accionesExpansionesY");
   mostrar.style.display = "none";
 }
  
 function mostrarAddExY(){
  var mostrar = document.getElementById("expansionesAddYug");
  mostrar.style.display = "block";
}

function cerrarAddExY(){
  var divAñadir = document.getElementById("expansionesAddYug");
  divAñadir.style.display = "none";
}
 /************************* función para buscar coincidencias de expansiones yugi********************************************************/
 $(document).ready(function() {
   $('#buscaExpanY').keyup(function() {
       var buscaCard = $(this).val();
       if (buscaCard != '') {
           $.ajax({
               url: 'ajax_yugi.php',
               type: 'POST',
               data: { 
                   buscaCard: buscaCard,
                   accion: 8 
               },
               success: function(data) {
                   $('#coincidencias_expanY').html(data);
               }
           });
       } else {
           $('#coincidencias_expanY').html('');
       }
   });
 });
 
 function mostrarExpansionesEditY(){
   var mostrar = document.getElementById("expansionesEditY");
   mostrar.style.display = "block";
 }
 
 function cerrarEditExY(){
   var mostrar = document.getElementById("expansionesEditY");
   mostrar.style.display = "none";
 }
 
 function carga_expan_encontradaY(id_carta,expan,expan_corto,lanzamiento){
   $('#txtNomExpan_2Y').val(expan);
   $('#txtNomCorto_2Y').val(expan_corto);
   $('#datepicker_2Y').val(lanzamiento);
   $('#id_expansion_encontradaY').val(id_carta);
 }
 
 function actualizar_expanY(){
   var id_expan = document.getElementById("id_expansion_encontradaY").value;
   var nombre_largo = document.getElementById("txtNomExpan_2Y").value;
   var nombre_corto = document.getElementById("txtNomCorto_2Y").value;
   var fecha_lanz =   document.getElementById("datepicker_2Y").value;
 
 
   Swal.fire({
     title: "Deseas actualizar la expansión?",
     icon: "warning",
     showCancelButton: true,
     confirmButtonColor: "#3085d6",
     cancelButtonColor: "#d33",
     confirmButtonText: "Si"
   }).then((result) => {
     if (result.isConfirmed) {
       var datos = {
         id_expan : id_expan,
         expansion: nombre_largo,
         nom_corto: nombre_corto,
         fecha_lanzamiento: fecha_lanz,
         accion : 9
     };
     // Enviar los datos al servidor usando AJAX
     fetch('ajax_yugi.php', {
       method: 'POST',
       headers: {
           'Content-Type': 'application/x-www-form-urlencoded' // Cambia el tipo de contenido
       },
       body: new URLSearchParams(datos).toString() // Convierte los datos a formato de formulario
   })
   .then(response => response.text()) // Espera una respuesta de texto
   .then(data => {
       if(data == 'OK'){
         Swal.fire({
           title: "Datos guardados!",
           text: "Los datos de la expansión han sido actualizados correctamente!",
           icon: "success"
         });
         limpiarCampos4()
       }
   })
   .catch(error => {
       console.error('Error al enviar los datos:', error);
   });
     }
   });
 }

 function dirije(){
  window.location.href = '../index.php';
 }

 function muestraV() {
  var ventaContainer = document.getElementById("venta_container");
  var ventaContainer2 = document.getElementById("venta_container2");
  var tipo = document.getElementById("tipo_usuA").value;

  if (tipo == 5) {
    ventaContainer.style.display = "table-cell"; // Cambia display a table-cell para mostrar el td
    ventaContainer2.style.display = "table-cell"; // Cambia display a table-cell para mostrar el td
  } else {
    ventaContainer.style.display = "none"; // Opcional, para ocultar el td si el tipo no es 5
    ventaContainer2.style.display = "none"; // Opcional, para ocultar el td si el tipo no es 5
  }
}

function mostrarEvento(){
  var divi = document.getElementById("div_eventos");
  divi.style.display = "block";
}

function cierraEvento(){
  var divi = document.getElementById("div_eventos");
  divi.style.display = "none";
}

function mostrarStripe(){
  var divi = document.getElementById("div_Stripe");
  divi.style.display = "block";
}

function ocultarStripe(){
  var divi = document.getElementById("div_Stripe");
  divi.style.display = "none";
}

function guardarEvento(){

    var nombreEvento =  $("#nom_evento").val();
    var fechaevento =  $("#datepickerEvento").val();
    var tcgDestino =  $("#tcg_evento").val();
    var costoEvento =  $("#txtPrecio_evento").val();
    var DescrioEvento =  $("#floatingTextarea2_evento").val();
    var horaEvento = $("#horaEvento").val();
    var img_evento = document.getElementById("img_evento").files[0];

    // 📌 Crear objeto FormData
    var formData = new FormData();
    formData.append("accion", 1);
    formData.append("nombre", nombreEvento);
    formData.append("fecha", fechaevento);
    formData.append("tcg", tcgDestino);
    formData.append("costo", costoEvento);
    formData.append("describe", DescrioEvento);
    formData.append("hora", horaEvento);
    
    // 📌 Agregar la imagen (muy importante)
    formData.append("img_evento", img_evento);

    $.ajax({
        url: 'ajax_evento.php',
        type: 'POST',
        data: formData,

        // ⚠️ Requerido para enviar archivos
        processData: false,
        contentType: false,
        
        beforeSend: function() {
            mostrarLoader();
        },

        success: function(data) {
            if(data == "OK"){
                Swal.fire({
                    title: "Guardado!",
                    text: "El evento se guardó correctamente",
                    icon: "success"
                });
            } else {
                Swal.fire("Error", data, "error");
            }

            limpiaCamposEvento();
            ocultarLoader();
        }
    });
}


document.addEventListener("DOMContentLoaded", function() {
  $(document).ready(function(){
    $('#datepickerEvento').datepicker({
        format: 'dd/mm/yyyy', // Puedes cambiar el formato de la fecha según tus necesidades
        autoclose: true,
        language: 'es' // Configura el idioma a español
    });
});
});

function limpiaCamposEvento(){
    var nombreEvento =  $("#nom_evento").val();
    var fechaevento =  $("#datepickerEvento").val();
    var tcgDestino =  $("#tcg_evento").val();
    var costoEvento =  $("#txtPrecio_evento").val();
    var DescrioEvento =  $("#floatingTextarea2_evento").val();
    var horaEvento = $("#horaEvento").val();

    document.getElementById("nom_evento").value = "";
    document.getElementById("datepickerEvento").value = "";
    document.getElementById("tcg_evento").value = "0";
    document.getElementById("txtPrecio_evento").value = "";
    document.getElementById("floatingTextarea2_evento").value = "";
    document.getElementById("horaEvento").value = "";

}

function agregaMasivo() {
  Swal.fire({
  title: 'Carga masiva de cartas',
  width: '550px',
  html: `
    <div style="text-align:center;">
      <input type="file" id="archivoExcel" class="swal2-input" accept=".xls,.xlsx,.csv">
      <br>
      <a href="../formatos/carga_masiva.csv" 
         download 
         class="btn btn-success" 
         style="margin-top:10px;">
        Descargar plantilla
      </a>
    </div>
  `,
  confirmButtonText: 'Subir archivo',
  showCancelButton: true,
  cancelButtonText: 'Cancelar',
    preConfirm: () => {
      const archivo = document.getElementById('archivoExcel').files[0];

      if (!archivo) {
        Swal.showValidationMessage('Por favor selecciona un archivo');
        return false;
      }

      const nombre = archivo.name.toLowerCase();
      if (!nombre.endsWith('.xls') && !nombre.endsWith('.xlsx') && !nombre.endsWith('.csv')) {
        Swal.showValidationMessage('El archivo debe ser un Excel (.xls , .xlsx o .csv)');
        return false;
      }

      return archivo;
    }
  }).then((result) => {
    if (result.isConfirmed) {
     const archivo = result.value;

      const formData = new FormData();
      formData.append('accion', 10);
      formData.append('archivoExcel', archivo);

      Swal.fire({
        title: 'Cargando datos de archivo...',
        text: 'Por favor espera mientras se procesan los datos.',
        allowOutsideClick: false,
        didOpen: () => {
          Swal.showLoading();
        }
      });

      $.ajax({
        url: 'ajax_mtg.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          // Si el PHP devuelve algo como "OK" o "NOC"
          if (response.trim() === 'OK') {
            Swal.fire({
              icon: 'success',
              title: 'Carga completada',
              text: 'El archivo se procesó correctamente.',
            });
          } else if (response.trim() === 'NOC') {
            Swal.fire({
              icon: 'warning',
              title: 'Algunas cartas no se encontraron',
              text: 'Se insertaron las disponibles, pero algunas no coincidieron.',
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error en el servidor',
              text: response,
            });
          }
        },
        error: function (xhr, status, error) {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Ocurrió un error al subir el archivo: ' + error,
          });
        }
      });
    }
  });
}

document.addEventListener("DOMContentLoaded", function() {
  $(document).ready(function(){
    $('#datepickerStripeDel').datepicker({
        format: 'dd/mm/yyyy', // Puedes cambiar el formato de la fecha según tus necesidades
        autoclose: true,
        language: 'es' // Configura el idioma a español
    });
});
});

document.addEventListener("DOMContentLoaded", function() {
  $(document).ready(function(){
    $('#datepickerStripeAl').datepicker({
        format: 'dd/mm/yyyy', // Puedes cambiar el formato de la fecha según tus necesidades
        autoclose: true,
        language: 'es' // Configura el idioma a español
    });
});
});

function muestraDatosStripe(){

  var fechadel =  $("#datepickerStripeDel").val();
  var fechaal =  $("#datepickerStripeAl").val();


$.ajax({
    url: 'ajax_admin.php',
    type: 'POST',
    data: {
        accion: 13,
        fechaDel: fechadel,
        fechaAl: fechaal
    },
    dataType: "json",
    success: function (response) {

        // Validar respuesta
        if (!response || response.length === 0) {
            Swal.fire({
                icon: 'info',
                title: 'Sin resultados',
                text: 'No se encontraron ventas en ese rango.'
            });
            return;
        }

        // LIMPIAR tabla antes de volver a llenarla
        $("#cuerpo_stripe").empty();

        let totalVentas = 0;
        let montoTotal = 0;

        // Construir filas
        response.forEach(row => {
            let monto = parseFloat(row.MONTO_TOTAL);
            totalVentas++;
            montoTotal += monto;

            let tr = `
                <tr>
                    <td>${row.ID_VENTA}</td>
                    <td>${row.FECHA_VENTA}</td>
                    <td>${monto.toLocaleString('es-MX', {style: 'currency', currency: 'MXN'})}</td>
                    <td>${row.STRIPE_ID}</td>
                    <td>${row.CLIENTE}</td>
                </tr>
            `;
            $("#cuerpo_stripe").append(tr);
        });

        // Actualizar footer
        $("#total_monto").text(montoTotal.toLocaleString('es-MX', {style: 'currency', currency: 'MXN'}));
        $("#total_ventas").text(totalVentas + (totalVentas === 1 ? " venta" : " ventas"));

        // Mostrar div (si estaba oculto)
        $("#dataStripe").fadeIn();
    },
    error: function (xhr, status, error) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Ocurrió un error al procesar la consulta: ' + error,
        });
    }
});
}

function exportaStripe(){

  var fechadel =  $("#datepickerStripeDel").val();
  var fechaal =  $("#datepickerStripeAl").val();

  // Obtener los datos de la tabla
  var tabla = document.getElementById('dataVentas');
  var tablaDatos = [];
  var filas = tabla.rows;
  for (var i = 0; i < filas.length; i++) {
      var fila = [],
          celdas = filas[i].cells;
      for (var j = 0; j < celdas.length; j++) {
          fila.push(celdas[j].innerText);
      }
      tablaDatos.push(fila);
  }
  // Crear un objeto de libro de trabajo de Excel
  var libro = XLSX.utils.book_new();
  var hoja = XLSX.utils.aoa_to_sheet(tablaDatos);
  XLSX.utils.book_append_sheet(libro, hoja, 'Inventario MTG');
  // Guardar el archivo de Excel
  XLSX.writeFile(libro, 'ventas_'+fechadel+'_al_'+fechaal+'.xlsx');
}

function actualizarMtg(id, campo, valor, idioma, foil, condicion) {
    $.ajax({
        url: 'ajax_mtg.php',
        type: 'POST',
        data: {
            accion: 4,
            id_cart: id,
            campo: campo,
            valor: valor,
            idioma: idioma,
            foil: foil,
            condicion: condicion
        },
        success: function(response) {
            if(response == 'OK'){
              Swal.fire({
            title: "Dato actualizado!",
            text: campo+" actualizado de manera correcta! Recarga la página cuando termines de actualizar para ver reflejados los cambios.",
            icon: "success"
          });
            }
        }
    });
}

function actualizarSellado(id, campo, valor){
  $.ajax({
        url: 'ajax_prod.php',
        type: 'POST',
        data: {
            accion: 2,
            id_cart: id,
            campo: campo,
            valor: valor
        },
        success: function(response) {
            if(response == 'OK'){
              Swal.fire({
            title: "Dato actualizado!",
            text: campo+" actualizado de manera correcta! Recarga la página cuando termines de actualizar para ver reflejados los cambios.",
            icon: "success"
          });
            }
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const delInput = document.getElementById('datepickerStripeDel');
    const alInput = document.getElementById('datepickerStripeAl');

    const hoy = new Date();
    const primerDia = new Date(hoy.getFullYear(), hoy.getMonth(), 1); // primer día del mes

    // Función para formatear fecha como DD/MM/YYYY
    function formatearFecha(fecha) {
        const dd = String(fecha.getDate()).padStart(2, '0');
        const mm = String(fecha.getMonth() + 1).padStart(2, '0'); // mes empieza en 0
        const yyyy = fecha.getFullYear();
        return `${dd}/${mm}/${yyyy}`;
    }

    delInput.value = formatearFecha(primerDia);
    alInput.value = formatearFecha(hoy);
});