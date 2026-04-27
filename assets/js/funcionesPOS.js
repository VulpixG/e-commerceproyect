function mostrarPos(){
  var mostrar = document.getElementById("divPOS");
  mostrar.style.display = "block";
}
function validarNumero(input) {
  // Elimina cualquier caracter que no sea un número (0-9)
  input.value = input.value.replace(/[^0-9]/g, '');
}

function cerrarSesion() {
    $.ajax({
        type: "POST",
        url: "http://localhost/magia/cerrar_sesion.php",
        dataType: "json",
        xhrFields: { withCredentials: true }, // 🔥 importante
        success: function(response) {
            console.log("Respuesta del servidor:", response);

            if (response.success) {
                window.location.href = "http://localhost/magia/index.php";
            } else {
                console.warn("No se pudo cerrar la sesión correctamente.");
            }
        },
        error: function(error) {
            console.error("Error al cerrar sesión:", error);
        }
    });
}


function cerrarPos()
{
  var mostrar = document.getElementById("divPOS");
  mostrar.style.display = "none";
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
    <p>CARGANDO...</p>
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
/********************* PARA BUSCAR PRODUCTOS **************************/
$(document).ready(function() {
  $('#busprod').keyup(function() {
      var busprod = $(this).val();
      if (busprod != '') {
          $.ajax({
              url: 'ajax_caja.php',
              type: 'POST',
              data: { 
                  busprod: busprod,
                  accion: 1
              },
              success: function(data) {
                  $('#coincidencias_producto').html(data);
              }
          });
      } else {
          $('#coincidencias_producto').html('');
      }
  });
});
/** PARA IR AGREGANDO LOS PRODUCTOS A LA TABLA **/
function carga_producto_encontrado(id_carta, nom_carta, precio, foil,cantidad) {
  // Obtener la referencia del cuerpo de la tabla
  $('#busprod').val('');
  var tbody = $('#tabla_caja tbody');


  // Crear una nueva fila con la clase de Bootstrap 'table-light' para darle un estilo de fondo claro
  var fila = $('<tr>').addClass('table-light');

  // Crear celdas para la fila
  var celdaID = $('<td>').addClass('fw-bold').text(id_carta);//id_carta

  var celdaNombre = $('<td>').addClass('fw-bold').text(nom_carta); // Agregar la clase 'fw-bold' para texto en negrita

  var celdaFoil = $('<td>').addClass('fw-bold').text(foil);

  // Crear el combo select para la cantidad con la clase de Bootstrap 'form-select'
  var selectCantidad = $('<select>').addClass('form-select');
  for (var i = 1; i <= cantidad; i++) {
      var option = $('<option>').text(i).val(i);
      selectCantidad.append(option);
  }
  // Establecer el valor inicial en 1
  selectCantidad.val(1);

  // Evento para actualizar el subtotal cuando cambie la cantidad
  selectCantidad.on('change', function() {
      var cantidadSeleccionada = parseInt($(this).val());
      var subtotal = cantidadSeleccionada * precio;
      $(this).closest('tr').find('.celdaSubtotal').text(subtotal);
      calcularTotal(); // Llamar a calcularTotal() para actualizar el total
  });

  // Crear celda para el precio con la clase de Bootstrap 'text-success' para texto verde
  var celdaPrecio = $('<td>').addClass('text-success').text(precio);

  // Celda para el subtotal, inicialmente será igual al precio
  var celdaSubtotal = $('<td>').text(precio).addClass('celdaSubtotal');

  // Crear el botón para eliminar la fila con la clase de Bootstrap 'btn btn-danger'
  var botonEliminar = $('<button>').addClass('btn btn-danger').text('Eliminar').click(function() {
      fila.remove();
      calcularTotal(); // Llamar a calcularTotal() para actualizar el total
  });

  // Crear la celda para el botón de eliminar
  var celdaEliminar = $('<td>').append(botonEliminar);

  // Agregar las celdas a la fila
  fila.append(celdaID);
  fila.append(celdaNombre);
  fila.append($('<td>').append(selectCantidad));
  fila.append(celdaFoil);
  fila.append(celdaPrecio);
  fila.append(celdaSubtotal);
  fila.append(celdaEliminar); // Agregar la celda del botón eliminar

  // Agregar la fila al cuerpo de la tabla
  tbody.append(fila);
$('#coincidencias_producto').empty();
  // Calcular el total inicial
  calcularTotal();
}

// Función para calcular el total de los subtotales
function calcularTotal() {
  var total = 0;
  $('#tabla_caja tbody tr').each(function() {
      var subtotal = parseFloat($(this).find('.celdaSubtotal').text()); // Parsear el subtotal como un número de punto flotante
      if (!isNaN(subtotal)) { // Verificar si el subtotal es un número válido
          total += subtotal;
      }
  });

  // Eliminar la fila anterior del total si existe
  $('#total_row').remove();

  // Agregar la fila del total al final de la tabla
  var filaTotal = $('<tr id="total_row">').addClass('table-dark');
  filaTotal.append($('<td>').text('Total').attr('colspan', 5).addClass('fw-bold'));
  filaTotal.append($('<td>').text(total.toFixed(2)).addClass('fw-bold'));
  $('#tabla_caja tbody').append(filaTotal);
}

function cobrar(){
  var total = 0;

    $('#tabla_caja tbody tr').each(function() {
        var subtotal = parseFloat($(this).find('td:eq(4)').text());
        if (!isNaN(subtotal)) {
            total += subtotal;
        }
    });

    Swal.fire({
      title: 'Pago del cliente',
      html:
          '<div>Total: $' + total.toFixed(2) + '</div>' +
          '<input id="swal-input1" class="swal2-input" placeholder="Cantidad recibida" onkeypress="return event.charCode >= 48 && event.charCode <= 57" title="Solo se permiten números">',
      focusConfirm: false,
      preConfirm: () => {
          const cantidadRecibida = parseFloat(document.getElementById('swal-input1').value);
          if (isNaN(cantidadRecibida)) {
              Swal.showValidationMessage('Por favor, ingresa una cantidad válida');
          }
          return cantidadRecibida;
      }
  }).then((result) => {
      if (result.isConfirmed) {
          const cantidadRecibida = result.value;
          let cambio = cantidadRecibida - total;
          if (cambio < 0) {
              Swal.fire('Error', 'La cantidad recibida es menor que el total', 'error');
          } else {
              Swal.fire('Cambio', 'El cambio es: $' + cambio.toFixed(2), 'success');
              enviarDatosphp(cantidadRecibida);
          }
      }
  });
}

function enviarDatosphp(pagoCli){
  var datos = [];

    $('#tabla_caja tbody tr').each(function() {
        var fila = {};
        fila.ID = $(this).find('td:eq(0)').text();
        fila.nombre = $(this).find('td:eq(1)').text();
        fila.cantidad = $(this).find('td:eq(2) select').val();
        fila.foil = $(this).find('td:eq(3)').text();
        fila.precio = $(this).find('td:eq(4)').text();
        fila.subtotal = $(this).find('td:eq(5)').text();
        datos.push(fila);
    });

    // Enviar los datos a PHP utilizando AJAX
    $.ajax({
        url: 'ajax_caja.php',
        type: 'POST',
        data: { ventas: JSON.stringify(datos), pago : pagoCli ,accion : 2 },
        success: function(response) {
          // Obtener el iframe
          var iframe = document.getElementById('ticketFrame');
          
          // Abrir el documento del iframe para escribir el contenido del ticket
          var doc = iframe.contentWindow.document;
          doc.open();
          doc.write(response);
          doc.close();
          
          // Esperar un momento para asegurarse de que el contenido se cargue completamente en el iframe
          setTimeout(function() {
              // Imprimir el contenido del iframe
              iframe.contentWindow.print();
          }, 500); // Esperar 500 milisegundos (ajusta según sea necesario)
          //Se limpia el cuerpo de la tabla, y el campo de busqueda:
          $('#busprod').val('');
          var tbody = $('#tabla_caja tbody');
            tbody.empty();
        },
        error: function(xhr, status, error) {
            // Manejar errores si es necesario
            console.error(error);
        }
    });
}

function cierre_cajita() {
    $.ajax({
        url: 'ajax_caja.php',
        type: 'POST',
        data: { accion: 3 },
        success: function(response) {
            if(response == 'NO'){
                Swal.fire({
                    title: '¡Ups!',
                    text: 'No se encontraron ventas para el día de hoy.',
                    imageUrl: '../assets/img/triste.png',
                    imageWidth: 120,
                    imageHeight: 120,
                    });
                    location.reload();
            }else{

            // Parsea la respuesta JSON a un objeto JavaScript
            var datos = JSON.parse(response);

            // Construye la tabla HTML con los datos recibidos
            var tablaHTML = '<table id="cierre_caja" style="width: 700px;">';
            tablaHTML += '<thead style="text-align: center;"><tr><th>ID Carta</th><th>Nombre</th><th>Cantidad</th><th>Precio</th><th>Subtotal</th><th>Fecha Venta</th></tr></thead>';
            tablaHTML += '<tbody>';
            var subtotal = 0; // Inicializa el subtotal
            datos.forEach(function(row) {
                tablaHTML += '<tr>';
                tablaHTML += '<td style="width: 200px; text-align: center;">' + row.ID_CARTA + '</td>';
                tablaHTML += '<td style="width: 100px; text-align: center;">' + row.NOMBRE + '</td>';
                tablaHTML += '<td style="width: 100px; text-align: center;">' + row.CANTIDAD + '</td>';
                tablaHTML += '<td style="width: 100px; text-align: center;">' + row.PRECIO + '</td>';
                tablaHTML += '<td style="width: 100px; text-align: center;">' + row.SUBTOTAL + '</td>';
                tablaHTML += '<td style="width: 100px; text-align: center;">' + row.FECHA_VENTA + '</td>';
                tablaHTML += '</tr>';

                // Suma el subtotal
                subtotal += parseFloat(row.SUBTOTAL);
            });
            tablaHTML += '</tbody>';
            tablaHTML += '<tfoot><tr><td colspan="4" style="text-align:right"><b>Total:</b></td><td>' + subtotal + '</td><td></td></tr></tfoot>';
            tablaHTML += '</table>';

            // Muestra la tabla en un modal de SweetAlert2
            Swal.fire({
                title: 'Datos de corte de caja',
                html: tablaHTML,
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: 'Exportar a Excel',
                cancelButtonText: 'Cerrar',
                width: '800px'
            }).then((result) => {
                if (result.isConfirmed) {
                    exportarExcel();
                }
            });
        }
        },
        error: function(xhr, status, error) {
            // Manejar errores si es necesario
            console.error(error);
        }
    });
}

function exportarExcel(){
    var fechaActual = new Date();
    var año = fechaActual.getFullYear();
    var mes = ('0' + (fechaActual.getMonth() + 1)).slice(-2); 
    var día = ('0' + fechaActual.getDate()).slice(-2);
    var fechaFormateada = año + '-' + mes + '-' + día;
    var tabla = document.getElementById('cierre_caja');
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
    XLSX.writeFile(libro, 'cierre_caja_'+fechaFormateada+'.xlsx');
  }

function abre_cajita() {
    Swal.fire({
        title: "Abrir caja",
        input: "number",
        inputLabel: "Fondo inicial",
        inputAttributes: { min: 0, step: 0.01 },
        confirmButtonText: "Abrir"
    }).then(result => {

        if (!result.isConfirmed) return;

        let fondo = result.value;

        // VALIDACIÓN ANTI-SIMIOS 🐒
        if (fondo === "" || fondo === null || isNaN(fondo) || Number(fondo) < 0) {
            Swal.fire({
                icon: "error",
                title: "Importe inválido",
                text: "Ingresa un monto válido para abrir la caja."
            });
            return;
        }

        $.ajax({
            url: 'ajax_caja.php',
            type: 'POST',
            data: { 
                fondo_inicial: fondo, 
                accion: 4 
            },
            success: function(response) {
                console.log("Respuesta cruda:", response);

                // Convertir JSON a objeto JS
                let data = JSON.parse(response);

                if (data.status === "ok") {

                    Swal.fire({
                        icon: "success",
                        title: "Caja abierta",
                        text: "ID de caja: " + data.id_caja
                    });
                    location.reload();

                } else if (data.status === "error") {

                    Swal.fire({
                        icon: "error",
                        title: "No se puede abrir la caja",
                        text: data.msg
                    });

                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
}


