
function mostrarPedidos() {
    var divi = document.getElementById("pedidosCliente");
    divi.style.display = "block";

    $('#cuerpo_tabla_pedidos').empty();

    $.ajax({
        type: "POST",
        url: "ajax_cliente.php",
        dataType: "json",
        data: {
            accion: 1
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
                nuevaFila.append('<td>' + pedido.guia + '</td>');
                if (pedido.ESTATUS_PED != 'CANCELADO' && pedido.ESTATUS_PED != 'ENTREGADO EN TIENDA') {
                    $("#botoncitoC").hide();
                    var botonCancelar = $('<button>', {
                        type: 'button',
                        class: 'btn btn-outline-danger',
                        onclick: 'cancelar_pedido(' + pedido.ID_PEDIDO + ')',
                        text: 'Cancelar'
                    });
                    var celdaBoton = $('<td>').append(botonCancelar);
                    nuevaFila.append(celdaBoton);
                    // Detener la propagación del evento del clic en el botón
                    botonCancelar.click(function(event) {
                        event.stopPropagation();
                    });
                } 
                if(pedido.ESTATUS_PED != 'CANCELADO' && pedido.RFC){
                  $("#botoncitoC").hide();
                    var botonCancelar = $('<button>', {
                        type: 'button',
                        class: 'btn btn-outline-success',
                        onclick: 'solicitar_factura(' + pedido.ID_PEDIDO + ')',
                        text: 'Facturar'
                    });
                    var celdaBoton = $('<td>').append(botonCancelar);
                    nuevaFila.append(celdaBoton);
                    // Detener la propagación del evento del clic en el botón
                    botonCancelar.click(function(event) {
                        event.stopPropagation();
                    });
                }
            
                // Agregamos la nueva fila al cuerpo de la tabla
                $('#cuerpo_tabla_pedidos').append(nuevaFila);
            
                // Añadimos el evento onclick a la fila
                nuevaFila.click(function() {
                    detallePedido(pedido.ID_PEDIDO);
                });
            });
            
            // Hacer la tabla responsiva
            $('#pedidosCliente').addClass('table-responsive');
        },        
        error: function(xhr, textStatus, errorThrown) {
            console.error('Error al obtener los datos:', errorThrown);
        }
    });
}


function detallePedido(id_pedido){
    $.ajax({
        type: "POST",
        url: "ajax_cliente.php",
        dataType: "json",
        data: {
            pedido_num : id_pedido,
            accion: 2
        },
        success: function(data) {
            // Ordenamos por fecha por si no vienen en orden
            data.sort(function(a, b) {
                return new Date(a.ACT_FECHA) - new Date(b.ACT_FECHA);
            });

            // Armamos el timeline
            var timeline = '<ul class="timeline">';

            $.each(data, function(index, pedido) {
                var isLast = (index === data.length - 1) ? ' active' : '';
                timeline += '<li class="timeline-item' + isLast + '">';
                timeline += '<strong>' + pedido.MOVIMIENTO + '</strong>';
                timeline += '<span class="date">' + pedido.ACT_FECHA + '</span>';
                timeline += '</li>';
            });

            timeline += '</ul>';

            Swal.fire({
                title: 'Seguimiento del Pedido con ID ' + data[0].ID_PEDIDO,
                html: timeline,
                width: '600px',
                showConfirmButton: false,
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

function cerrarPedidos(){
    var divi = document.getElementById("pedidosCliente");
    divi.style.display = "none";
}

document.addEventListener("DOMContentLoaded", function() {
    $(document).ready(function(){
      $('#datepicker_cli').datepicker({
          format: 'dd/mm/yyyy', // Puedes cambiar el formato de la fecha según tus necesidades
          autoclose: true,
          language: 'es' // Configura el idioma a español
      });
  });
  });

function usuarioAcciones(){
    var divis = document.getElementById("datosCliente");
    divis.style.display = "block";
}

function cerrarDatoscliente(){
    var divis = document.getElementById("datosCliente");
    divis.style.display = "none";
}

function guardarDatosCliente(){
    var nombre_cliente = document.getElementById("txtNomCliente").value;
    var apellidoPat = document.getElementById("txtApePat").value;
    var apellidoMat = document.getElementById("txtApeMat").value;
    var fecha_nac = document.getElementById("datepicker_cli").value;
    var numTel = document.getElementById("txtTel").value;
    var calle = document.getElementById("txtCalle").value;
    var num_ext = document.getElementById("txtNumEx").value;
    var num_int = document.getElementById("txtNumInt").value;
    var colonia = document.getElementById("txtColonia").value;
    var cod_pos = document.getElementById("txtCp").value;
    var ciudad = document.getElementById("txtCiudad").value;
    var estado = document.getElementById("txtEstado").value;
    var pais = document.getElementById("txtPais").value;

    // Array para almacenar los nombres de los campos faltantes
    var camposFaltantes = [];

    // Verificar cada campo y agregar al array si está vacío
    if (nombre_cliente === "") camposFaltantes.push("Nombre");
    if (apellidoPat === "") camposFaltantes.push("Apellido Paterno");
    if (apellidoMat === "") camposFaltantes.push("Apellido Materno");
    if (fecha_nac === "") camposFaltantes.push("Fecha de Nacimiento");
    if (numTel === "") camposFaltantes.push("Número de Teléfono");
    if (calle === "") camposFaltantes.push("Calle");
    if (num_ext === "") camposFaltantes.push("Número Exterior");
    if (colonia === "") camposFaltantes.push("Colonia");
    if (cod_pos === "") camposFaltantes.push("Código Postal");
    if (ciudad === "") camposFaltantes.push("Ciudad");
    if (estado === "") camposFaltantes.push("Estado");
    if (pais === "") camposFaltantes.push("País");

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
            url: "ajax_cliente.php",
            dataType: "json",
            data: {
                nombre_cliente : nombre_cliente,
                apellidoPat : apellidoPat,
                apellidoMat : apellidoMat,
                fecha_nac : fecha_nac,
                numTel : numTel,
                calle : calle,
                num_ext : num_ext,
                num_int : num_int,
                colonia : colonia,
                cod_pos : cod_pos,
                ciudad : ciudad,
                estado : estado,
                pais : pais,
                accion: 3
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

function cancelar_pedido(idpedido){
    Swal.fire({
        title: "Aviso!",
        text: "¿Deseas cancelar este pedido?",
        icon: "warning",
        showCancelButton: true, // Mostrar el botón de cancelar
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, cancelar pedido',
        cancelButtonText: 'No, mantener pedido'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: "ajax_cliente.php",
                dataType: "json",
                data: {
                    pedido : idpedido,
                    accion: 4
                },
                success: function(response) {
                    if (response.message == "OK") {
                        Swal.fire({
                            title: "Pedido cancelado!",
                            text: "Tu pedido ha sido cancelado, consulta términos y condiciones para obtener información sobre reembolsos.",
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
                    //console.error('Error al obtener los datos:', errorThrown);
                }
            });
        } else {
        }
    });
}

function inicio(){
    window.location.href = '../index.php';
}

function modalDatosFac(usuario) {
  // Primero pedimos los datos existentes
  $.ajax({
    url: 'ajax_cliente.php',
    type: 'POST',
    dataType: 'json',
    data: { accion: 6, idUsuario: usuario },
    success: function(data) {
      // Abrir el modal con los valores cargados
      Swal.fire({
        title: '💼 Datos para Facturación CFDI 4.0',
        html: `
          <div style="text-align:left; max-height:65vh; overflow-y:auto; padding-right:8px;">

            <h4 style="margin-top:10px; color:#2c3e50;">👤 Datos del Receptor</h4>
            <div class="swal2-input-group">
              <label>RFC:</label>
              <input id="rfc" class="swal2-input" placeholder="Ej. ABCD123456XYZ" value="${data.rfc || ''}">
            </div>
            <div class="swal2-input-group">
              <label>Nombre o Razón Social:</label>
              <input id="nombre" class="swal2-input" placeholder="Ej. Empresa S.A. de C.V." value="${data.razon_soc || ''}">
            </div>
            <div class="swal2-input-group">
              <label>Régimen Fiscal:</label>
              <input id="regimen" class="swal2-input" placeholder="Ej. 601 - General de Ley Personas Morales" value="${data.regimen || ''}">
            </div>
            <div class="swal2-input-group">
              <label>Código Postal:</label>
              <input id="cp" class="swal2-input" maxlength="5" placeholder="Ej. 06000" value="${data.cp || ''}">
            </div>
            <div class="swal2-input-group">
              <label>Uso del CFDI:</label>
              <select id="usoCfdi" class="swal2-select">
                <option value="G01" ${data.uso_cfdi==='G01'?'selected':''}>G01 - Adquisición de mercancías</option>
                <option value="G03" ${data.uso_cfdi==='G03'?'selected':''}>G03 - Gastos en general</option>
                <option value="P01" ${data.uso_cfdi==='P01'?'selected':''}>P01 - Por definir</option>
              </select>
            </div>
          </div>
        `,
        width: 600,
        background: '#f8fafc',
        color: '#2c3e50',
        showCancelButton: true,
        confirmButtonText: '✅ Enviar datos',
        cancelButtonText: '❌ Cancelar',
        confirmButtonColor: '#27ae60',
        cancelButtonColor: '#e74c3c',
        focusConfirm: false,
        scrollbarPadding: false,
        preConfirm: () => {
          const rfc = document.getElementById('rfc').value.trim();
          const nombre = document.getElementById('nombre').value.trim();
          const regimen = document.getElementById('regimen').value.trim();
          const cp = document.getElementById('cp').value.trim();
          const usoCfdi = document.getElementById('usoCfdi').value;

          if (!rfc || !nombre || !regimen || !cp) {
            Swal.showValidationMessage('Todos los campos son obligatorios.');
            return false;
          }

          return { rfc, nombre, regimen, cp, usoCfdi };
        }
      }).then((result) => {
        if (result.isConfirmed) {
          const datos = result.value;

          $.ajax({
            url: 'ajax_cliente.php',
            type: 'POST',
            data: {
              accion: 5, 
              idUsuario: usuario,
              rfc: datos.rfc,
              nombre: datos.nombre,
              regimen: datos.regimen,
              cp: datos.cp,
              usoCfdi: datos.usoCfdi
            },
            success: function(respuesta) {
              try {
                const dataResp = JSON.parse(respuesta);

                if (dataResp.message === "OK") {
                  Swal.fire({
                    icon: 'success',
                    title: '✅ Datos Actualizados',
                    text: 'Los datos fueron guardados correctamente.',
                    confirmButtonColor: '#27ae60'
                  });
                } else {
                  Swal.fire({
                    icon: 'warning',
                    title: '⚠️ Respuesta inesperada',
                    text: 'El servidor respondió: ' + respuesta
                  });
                }
              } catch (e) {
                Swal.fire({
                  icon: 'error',
                  title: '😿 Error de formato',
                  text: 'El servidor devolvió una respuesta no válida.'
                });
                console.error('Respuesta no JSON:', respuesta);
              }
            },
            error: function(xhr, status, error) {
              Swal.fire({
                icon: 'error',
                title: '❌ Error al enviar',
                text: 'Ocurrió un problema al enviar los datos al servidor.'
              });
              console.error('Error AJAX:', error);
            }
          });
        }
      });
    },
    error: function() {
      Swal.fire({
        icon: 'error',
        title: '😿 Error al cargar',
        text: 'No se pudieron cargar los datos existentes,intentalo de nuevo o ponte en contacto con nosotros.'
      });
    }
  });
}

function solicitar_factura(pedido){
  Swal.fire({
        title: "Aviso!",
        text: "¿Deseas solicitar facruta de este pedido?",
        icon: "warning",
        showCancelButton: true, // Mostrar el botón de cancelar
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: "ajax_cliente.php",
                dataType: "json",
                data: {
                    pedido : pedido,
                    accion: 7
                },
                success: function(response) {
                    if (response.message == "OK") {
                        Swal.fire({
                            title: "Factura solicitada!",
                            text: "Tu factura ha sido solicitada de manera correcta.",
                            icon: "success"
                          });
                    } else if(response.message == "YA"){
                      Swal.fire({
                            title: "Aviso!",
                            text: "Solo se puede solicitar una factura por pedido.",
                            icon: "warning"
                          });
                    }else{
                        Swal.fire({
                            title: "Ups!",
                            text: "Algo salió mal, intentalo de nuevo o ponte en contacto con nosotros!",
                            icon: "error"
                          });
                    }
                },        
                error: function(xhr, textStatus, errorThrown) {
                    //console.error('Error al obtener los datos:', errorThrown);
                }
            });
        } else {
        }
    });
}

/* document.addEventListener('DOMContentLoaded', () => {
    const inforIcon = document.getElementById('infor');

    const tooltip = document.createElement('div');
    tooltip.style.position = 'absolute';
    tooltip.style.background = '#333';
    tooltip.style.color = '#fff';
    tooltip.style.padding = '5px 10px';
    tooltip.style.borderRadius = '5px';
    tooltip.style.fontSize = '0.8rem';
    tooltip.style.pointerEvents = 'none';
    tooltip.style.opacity = '0';
    tooltip.style.transition = 'opacity 0.2s';
    document.body.appendChild(tooltip);

    inforIcon.addEventListener('mouseover', (e) => {
      tooltip.textContent = 'Recuerda tener actualizada tu información fiscal desde el apartado Mi Usuario.';
      const rect = inforIcon.getBoundingClientRect();
      tooltip.style.left = rect.left + window.scrollX + 'px';
      tooltip.style.top = rect.top + window.scrollY - rect.height - 10 + 'px';
      tooltip.style.opacity = '1';
    });

    inforIcon.addEventListener('mouseout', () => {
      tooltip.style.opacity = '0';
    });
  }); */