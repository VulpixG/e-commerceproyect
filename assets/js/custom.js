// Función que realiza la búsqueda
$(document).ready(function() {
    $('#inputModalSearch').on('input', function() {
        var buscaCard = $(this).val(); // Obtener el valor del input
        if (buscaCard != '') {
            $.ajax({
                url: '././php/ajax_mtg.php',
                type: 'POST',
                data: { 
                    buscaCard: buscaCard,
                    accion: 6 
                },
                success: function(data) {
                    $('#coincidencias').html(data); // Mostrar resultados en el div de coincidencias
                }
            });
        } else {
            $('#coincidencias').html(''); // Vaciar el div de coincidencias si el input está vacío
        }
    });
});

function redirectToSearch(){
    var busqueda = document.getElementById("inputMobileSearch");
    var valorInput = busqueda.value;
    var dir = "././busqueda.php?&carta="+valorInput;
    window.location.href = dir;
}

function carga_carta_encontrada(id_cartaita){
    var dir = "././busqueda.php?&carta=" + encodeURIComponent(id_cartaita);
    window.location.href = dir;
}
    
function muestra_detalle_carta(id_carta){
    // Crear un formulario
    var form = document.createElement("form");
    form.setAttribute("method", "post");
    form.setAttribute("action", "shop-single.php");

    // Crear un campo de entrada para enviar el id_carta
    var hiddenField = document.createElement("input");
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", "carta");
    hiddenField.setAttribute("value", id_carta);
    
    // Agregar el campo de entrada al formulario
    form.appendChild(hiddenField);

    // Agregar el formulario al cuerpo del documento
    document.body.appendChild(form);

    // Enviar el formulario
    form.submit();
}

$(document).ready(function() {
    $('#openRegisterModalButton').on('click', function() {
        Swal.fire({
            title: 'Registro de Usuario',
            html:
                '<input id="username" class="swal2-input" placeholder="Nombre de Usuario">' +
                '<input id="email" class="swal2-input" placeholder="Correo Electrónico">' +
                '<input id="password" type="password" class="swal2-input" placeholder="Contraseña">',
            showCancelButton: true,
            confirmButtonText: 'Registrarse',
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                const username = Swal.getPopup().querySelector('#username').value.trim();
                const email = Swal.getPopup().querySelector('#email').value.trim();
                const password = Swal.getPopup().querySelector('#password').value;

                // --- VALIDACIÓN ---
                if (!username) {
                    Swal.showValidationMessage('El nombre de usuario es obligatorio');
                    return false;
                }

                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    Swal.showValidationMessage('Introduce un correo electrónico válido');
                    return false;
                }

                // Contraseña mínima 10 caracteres
                if (password.length < 10) {
                    Swal.showValidationMessage('La contraseña debe tener al menos 10 caracteres');
                    return false;
                }

                // --- ENVÍO AJAX ---
                return $.ajax({
                    type: 'POST',
                    url: 'process_register.php',
                    data: { username: username, usermail: email, password: password },
                }).then(response => {
                    const data = JSON.parse(response);
                    if (!data.success) {
                        Swal.showValidationMessage(`Error: ${data.message}`);
                    }
                    return data;
                }).catch(() => {
                    Swal.showValidationMessage('Hubo un error al procesar la solicitud');
                });
            }
        }).then((result) => {
            if (result.isConfirmed && result.value && result.value.success) {
                Swal.fire('Éxito', result.value.message, 'success');
            }
        });
    });
});


function registroVendedor(){
    var dir = "././vendedor.php";
    window.location.href = dir;
}

/*paginacion en shop*/
$(document).ready(function(){
    var totalItems = 100; // Número total de elementos en tu conjunto de datos
    var itemsPerPage = 15; // Número de elementos por página
    var totalPages = Math.ceil(totalItems / itemsPerPage); // Número total de páginas

    // Generar la paginación
    var pagination = '';
    for (var i = 1; i <= totalPages; i++) {
      pagination += '<li class="page-item"><a class="page-link" href="#">' + i + '</a></li>';
    }
    $('#pagination').html(pagination);

    // Manejar el clic en los enlaces de página
    $('#pagination').on('click', 'a.page-link', function(e){
      e.preventDefault();
      var page = parseInt($(this).text()); // Número de página
      var startIndex = (page - 1) * itemsPerPage; // Índice de inicio de los elementos de la página
      var endIndex = startIndex + itemsPerPage - 1; // Índice de fin de los elementos de la página

      // Aquí puedes implementar la lógica para cargar los datos de la página correspondiente
      // startIndex y endIndex te darán el rango de elementos que necesitas mostrar

      // Por simplicidad, aquí solo mostramos un mensaje en la consola
      console.log('Cargar datos de la página', page, 'desde el índice', startIndex, 'hasta el índice', endIndex);
    });
  });

  function recuperaContra1(){
    Swal.fire({
        title: 'INGRESA TU CORREO PARA RECUPERAR TU CONTRASEÑA',
        html:
          '<input id="correo" class="form-control" placeholder="Correo"><br>',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        focusConfirm: false,
        preConfirm: () => {
          const input1 = Swal.getPopup().querySelector('#correo').value
    
          if(input1 != ''){
              $.ajax({
                type: "POST",
                url: "php/ajax_recuperacontra.php",
                data: {correo : input1, accion : 1},beforeSend: function() {
                    mostrarLoader();
                },
                success: function(response) {
                    if (response == 'OK') {
                        Swal.fire({
                            title: "Correo enviado!",
                            text: "Se ha enviado un correo con la recuperación de su contraseña!",
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
              text: "Debe escribir su correo!",
              icon: "error"
            });
          }
    
        }
      })
  }

  function abrirFormulario() {
    Swal.fire({
      title: 'Formulario de Vendedor',
      html:
        `<input type="text" id="nombre" class="form-control mb-2" placeholder="Nombre completo">
         <input type="email" id="correo" class="form-control mb-2" placeholder="Correo electrónico">
         <input type="text" id="telefono" class="form-control mb-2" placeholder="Teléfono de contacto">
         <input type="text" id="direccion" class="form-control mb-2" placeholder="Dirección de contacto (debe coincidir con tu identificación)">
         <input type="text" id="stripe" class="form-control mb-2" placeholder="ID de cuenta Stripe (opcional)">
         <textarea id="descripcion" class="form-control mb-2" rows="2" placeholder="Cuéntanos qué cartas venderás..."></textarea>
         <label class="form-label">Identificación oficial (INE, pasaporte, etc.):</label>
         <input type="file" id="identificacion" class="form-control" accept=".jpg,.jpeg,.png,.pdf">`,
      showCancelButton: true,
      confirmButtonText: 'Enviar solicitud',
      cancelButtonText: 'Cancelar',
      preConfirm: () => {
        const nombre = document.getElementById('nombre').value;
        const correo = document.getElementById('correo').value;
        const dir = document.getElementById('direccion').value;
        const tel = document.getElementById('telefono').value;
        const vent = document.getElementById('descripcion').value;
        const identificacion = document.getElementById('identificacion').files[0];

        if (!nombre || !correo || !dir || !tel || !vent) {
          Swal.showValidationMessage('Todos los campos son obligatorios');
          return false;
        }

        if (!identificacion) {
          Swal.showValidationMessage('Debes adjuntar una identificación oficial');
          return false;
        }

        return {
          nombre,
          correo,
          telefono: document.getElementById('telefono').value,
          stripe: document.getElementById('stripe').value,
          descripcion: document.getElementById('descripcion').value,
          identificacion
        };
      }
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire(
          '¡Enviado!',
          'Tu solicitud ha sido recibida. Te contactaremos pronto 📨',
          'success'
        );
        // Aquí podrías enviar los datos y archivo con AJAX/FormData si gustas
      }
    });
  }

function recuperaContra(token) {
    const password = document.getElementById("nuevaContra").value.trim();

    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{10,}$/;

    if (!regex.test(password)) {
        let message = "La contraseña debe cumplir con los siguientes requisitos:<br><br>";
        message += "• Al menos 10 caracteres<br>";
        message += "• Una letra mayúscula<br>";
        message += "• Una letra minúscula<br>";
        message += "• Un número<br>";

        Swal.fire({
            icon: "error",
            title: "Contraseña no válida",
            html: message,
            confirmButtonColor: "#d33",
        });
        return;
    }

    $.ajax({
        type: "POST",
        url: "php/ajax_recuperacontra.php",
        data: {
            token: token,
            password: password,
            accion: 2
        },
        beforeSend: function() {
            mostrarLoader();
        },
        success: function(response) {
            Swal.close(); // cerrar loader

            if (response.trim() === 'OK') {
                Swal.fire({
                    title: "Contraseña actualizada",
                    text: "Tu contraseña se cambió correctamente.",
                    icon: "success"
                }).then(() => {
                    window.location.href = "sesion.php";
                });
            } else {
                Swal.fire({
                    title: "Ups!",
                    text: "Algo salió mal: " + response,
                    icon: "error"
                });
            }
        },
        error: function() {
            Swal.close();
            Swal.fire({
                title: "Error de conexión",
                text: "No se pudo comunicar con el servidor.",
                icon: "error"
            });
        }
    });
}

function actualizaPrecio(id) {
    const select = document.getElementById(`variante_${id}`);
    const variante = JSON.parse(select.value);
    const precioElem = document.getElementById(`precio_${id}`);
    const cantidadSelect = document.getElementById(`cantidad_${id}`);
    const cantidadLabel = cantidadSelect.closest('li'); // el li que contiene el label y select

    // Botones existentes en PHP
    const botonAgregar = document.querySelector(`#boton_accion_${id} .btn-agregar`);
    const botonNotificar = document.querySelector(`#boton_accion_${id} .btn-notificar`);

    // 🔹 Recuperamos el título actual del onclick, para mantenerlo igual
    let nombreCartaActual = '';
    const onclickActual = botonAgregar.getAttribute('onclick');
    if (onclickActual) {
        const match = onclickActual.match(/'([^']+)'/g);
        if (match && match.length >= 3) {
            // El tercer valor entre comillas simples es el nombre de la carta
            nombreCartaActual = match[2].replace(/'/g, '');
        }
    }

    // Actualiza el precio
    precioElem.innerText = `$${variante.PRECIO}`;

    const max = parseInt(variante.CANTIDAD);

    // Actualiza cantidad
    cantidadSelect.innerHTML = '';
    if (max > 0) {
        cantidadLabel.style.display = 'block'; // muestra el select
        for (let i = 1; i <= max; i++) {
            const option = document.createElement('option');
            option.value = i;
            option.textContent = i;
            cantidadSelect.appendChild(option);
        }
        // Muestra botón añadir, oculta notificar
        botonAgregar.style.display = 'inline-block';
        botonNotificar.style.display = 'none';
    } else {
        cantidadLabel.style.display = 'none'; // oculta el select
        // Oculta botón añadir, muestra notificar
        botonAgregar.style.display = 'none';
        botonNotificar.style.display = 'inline-block';
    }

    // Efectos visuales (foil/no foil)
    const wrap = document.getElementById(`card_wrap_${id}`);
    if (wrap) variante.FOIL === "Foil" ? wrap.classList.add("foil-effect") : wrap.classList.remove("foil-effect");
    const flipCard = document.querySelector(`#card_img_front_${id}`)?.closest('.flip-card');
    if (flipCard) variante.FOIL === "Foil" ? flipCard.classList.add("foil-effect") : flipCard.classList.remove("foil-effect");

    botonAgregar.setAttribute(
        "onclick",
        `agregarAlCarrito(
            '${variante.PRECIO}',
            '${id}',
            '${nombreCartaActual.replace(/'/g, "\\'")}',
            '${variante.CANTIDAD}',
            '${botonAgregar.closest('.card-body').dataset.idUsuario || ''}',
            '${variante.IDIOMA}',
            '${variante.FOIL}',
            '${variante.CONDICION}'
        )`
    );
}

function muestraEventos(){
    var dir = "././eventos_mtg.php?";
    window.location.href = dir;
}

$(document).ready(function() {
    if (typeof cargaEventos === "function" && $("#contenedor_eventos").length > 0) {
        cargaEventos();
    }
});

function cargaEventos(){

    $.ajax({
        url: '././php/ajax_evento.php',
        type: 'POST',
        data: { accion: 2 },
        success: function(response) {
    let cont = $("#contenedor_eventos");
    cont.empty(); // limpiar

    let html = ``;
    
    if(response== '' || response == null){
        html += `         
            <div class="container my-5 d-flex flex-column justify-content-center align-items-center text-center" 
                id="contenedor_eventos" 
                style="min-height: 300px;">

            <img src="http://localhost/magia/assets/img/error-cat.png" class="mb-3" width="120" alt="Sin eventos">

            <div class="badge text-bg-primary text-wrap px-3 py-2" style="max-width: 300px;">
                Lo sentimos, por el momento no hay eventos disponibles.
            </div>

            </div>
            
        `;

        cont.append(html);
    }else{
 response.forEach(e => {

        html += `<div class="row">
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">

                    <div class="img-evento-wrapper">
                        <img src="imagenes_eventos/${e.IMAGEN_EVENTO}"
                            class="img-evento"
                            alt="${e.NOMBRE_EVENTO}">
                    </div>

                    <div class="card-body d-flex flex-column">

                        <h5 class="card-title">${e.NOMBRE_EVENTO}</h5>

                        <p class="card-text mb-1"><strong>TCG:</strong> ${e.TCG}</p>
                        <p class="card-text mb-1"><strong>Fecha:</strong> ${e.FECHA_EVENTO}</p>
                        <p class="card-text mb-1"><strong>Hora:</strong> ${e.HORA_EVENTO.substring(0,5)}</p>

                        <p class="card-text mt-auto"><strong>Costo:</strong> $${e.COSTO}</p>

                    </div>
                </div>
            </div>
        `;
    });

    html += `</div>`;

    cont.append(html);
    }

   

    },
    error: function(xhr, status, error) {
        console.log("Error AJAX:", error);
        console.log("Respuesta cruda:", xhr.responseText);
    }
});
}

function mostrarEventos(eventos) {
    let cont = $("#contenedor_eventos");
    cont.empty(); // limpiar

    let html = `<div class="row">`;

    eventos.forEach(e => {

        html += `
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">

                    <img src="${e.IMAGEN_EVENTO}" class="card-img-top" alt="${e.NOMBRE_EVENTO}" 
                         style="height: 220px; object-fit: cover;">

                    <div class="card-body d-flex flex-column">

                        <h5 class="card-title">${e.NOMBRE_EVENTO}</h5>

                        <p class="card-text mb-1"><strong>TCG:</strong> ${e.TCG}</p>
                        <p class="card-text mb-1"><strong>Fecha:</strong> ${e.FECHA_EVENTO}</p>
                        <p class="card-text mb-1"><strong>Hora:</strong> ${e.HORA_EVENTO.substring(0,5)}</p>

                        <p class="card-text mt-auto"><strong>Costo:</strong> $${e.COSTO}</p>

                    </div>
                </div>
            </div>
        `;
    });

    html += `</div>`;

    cont.append(html);
}

function mostrarLoader() {
  Swal.fire({
    html: `
      <div style="text-align:center;">
        <img src="http://localhost/magia/assets/img/transportador.gif" style="width:120px; margin-bottom:15px;">
        <p>CARGANDO...</p>
      </div>
    `,
    showCloseButton: false,
    showConfirmButton: false,
    allowOutsideClick: false,
    allowEscapeKey: false,
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
