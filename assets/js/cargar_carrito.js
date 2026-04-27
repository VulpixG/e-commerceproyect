// Función que muestra productos y agrega fila de envío si está seleccionado
function mostrarProductosEnCarrito() {
    //console.log("mostrarProductosEnCarrito() llamada");
    var carritoTableBody = document.getElementById("carrito-table");
    if (!carritoTableBody) {
        console.error("No existe el elemento #carrito-table en el DOM");
        return;
    }

    // Recuperar carrito
    var carritoData = localStorage.getItem('carrito');
    var productosEnCarrito = carritoData ? JSON.parse(carritoData) : [];

    var totalCarrito = 0;

    if (productosEnCarrito.length > 0) {
        var tablaHtml = "<table border='1' class='table'><thead><tr><th>Producto</th><th>Cantidad</th><th>Precio</th><th>Total</th></tr></thead><tbody>";

        productosEnCarrito.forEach(function(producto) {
            // Asegurarse de convertir a número
            var costo = parseFloat(producto.costo) || 0;
            var cantidad = parseFloat(producto.cantidad) || 0;
            var totalProducto = costo * cantidad;
            totalCarrito += totalProducto;

            tablaHtml += "<tr><td>" + escapeHtml(producto.nombreProducto) + "</td><td>" + cantidad + "</td><td>$" + costo.toFixed(2) + "</td><td>$" + totalProducto.toFixed(2) + "</td></tr>";
        });

        // Buscar el radio por name y value (más robusto que usar solo id)
        var envioRadio = document.querySelector('input[name="inlineRadioOptions"][value="2"]');
        var envioSeleccionado = envioRadio ? envioRadio.checked : false;

        console.log("envioRadio encontrado:", !!envioRadio, "checked:", envioSeleccionado);

        if (envioSeleccionado) {
            var costoEnvio = 190;
            totalCarrito += costoEnvio;
            tablaHtml += "<tr id='fila-envio'><td>Envío a domicilio (2 días)</td><td>1</td><td>$" + costoEnvio.toFixed(2) + "</td><td>$" + costoEnvio.toFixed(2) + "</td></tr>";
        }

        tablaHtml += "</tbody></table>";
        tablaHtml += "<p id='totalTexto'><strong>Total: $" + totalCarrito.toFixed(2) + "</strong></p>";
        tablaHtml += "<input type='hidden' id='total_pagar_si' value='" + totalCarrito.toFixed(2) + "'>";

        carritoTableBody.innerHTML = tablaHtml;
    } else {
        carritoTableBody.innerHTML = "<p>No hay productos en el carrito.</p>";
    }
}

// Escape básico para evitar inyectar HTML si el nombre viene del localStorage
function escapeHtml(text) {
    if (typeof text !== 'string') return text;
    return text.replace(/[&<>"']/g, function (m) { return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m]; });
}

// Inicializar: llamar al cargar la página y añadir listeners a los radios
document.addEventListener('DOMContentLoaded', function() {
    // Mostrar al cargar
    mostrarProductosEnCarrito();

    // Añadir listener a todos los radios del grupo para refrescar la tabla al cambiar
    var radios = document.querySelectorAll('input[name="inlineRadioOptions"]');
    radios.forEach(function(r) {
        r.addEventListener('change', function() {
            //console.log("radio cambiado:", r.value, "checked:", r.checked);
            mostrarProductosEnCarrito();
        });
    });
});

// Llamar a la función para mostrar los productos en el carrito cuando se carga la página
window.onload = function() {
    mostrarProductosEnCarrito();
};
/************************************  PARA PROCESAR EL PAGO **************************************/
function procesarPagoConStripe() {

  var envio = 0;
  var radio = document.getElementById("domi");
  var radioTienda = document.getElementById("tienda");

  if (!radio.checked && !radioTienda.checked){
    Swal.fire({
    title: "Espera!",
    text: "Debes seleccionar envio a domicilio o recoger en tienda!",
    icon: "error"
  });
  }else{
    if(radioTienda.checked){
      envio = 190;
    }
  // Inicializar Stripe con tu clave pública
  const stripe = Stripe('pk_test_51OkFOKBy1HoNaFtGNvRsqPKQKJrMRGQVOT4pu1j0KA0vw8nNm8BbUkg3rIfUYy5ii0RWRqlAMeWTGhMlJKUpuO1J00OMSkIGQv');

  // Crear un objeto de elementos de Stripe
  const elements = stripe.elements();

  // Crear un elemento de tarjeta de crédito
  const card = elements.create('card');

  // Montar el elemento de tarjeta de crédito en un contenedor
  card.mount('#elemento-tarjeta');

  // Crear el botón "Pagar"
  const botonPagar = document.createElement('button');
  botonPagar.textContent = 'Pagar';
  botonPagar.className = 'btn btn-primary';
  botonPagar.style.marginTop = '15px'; // Agregar margen superior de 15px
  botonPagar.addEventListener('click', function(event) {
    event.preventDefault();
    
    var tiendaChecked = document.getElementById("tienda").checked;
    var envioDomiChecked = document.getElementById("domi").checked;
    
    // Validar si todos los campos están completos
    if (envioDomiChecked) {
        // Realizar validación adicional si el envío a domicilio está seleccionado
        var cliente = document.getElementById("txtNomCliente");
        var apellidos = document.getElementById("txtApeCliente");
        var telefono = document.getElementById("txtNumTel");
        var direccion = document.getElementById("txtDir");
        var ciudad = document.getElementById("txtCiudad");
        var pais = document.getElementById("txtPais");
        var estado = document.getElementById("txtEstado");
        var cp = document.getElementById("txtCp");

        if (
            cliente.value !== "" &&
            apellidos.value !== "" &&
            telefono.value !== "" &&
            direccion.value !== "" &&
            ciudad.value !== "" &&
            pais.value !== "" &&
            estado.value !== "" &&
            cp.value !== ""
        ) {
            // Si todos los campos están completos, proceder con el pago
            stripe.createPaymentMethod({
                type: 'card',
                card: card
            }).then(function(result) {
                if (result.error) {
                    // Manejar errores de validación de tarjeta
                    console.error(result.error.message);
                } else {
                    // Envía el PaymentMethod al servidor para procesar el pago
                    const total = parseFloat(document.getElementById('total_pagar_si').value);
                    enviarPaymentMethodAlServidor(result.paymentMethod, total,1);
                }
            });
        } else {
            // Si falta algún campo, mostrar un mensaje de error
            let camposFaltantes = [];
            if (cliente.value === "") camposFaltantes.push("Nombre del cliente");
            if (apellidos.value === "") camposFaltantes.push("Apellidos del cliente");
            if (telefono.value === "") camposFaltantes.push("Número de teléfono");
            if (direccion.value === "") camposFaltantes.push("Dirección");
            if (ciudad.value === "") camposFaltantes.push("Ciudad");
            if (pais.value === "") camposFaltantes.push("País");
            if (estado.value === "") camposFaltantes.push("Estado");
            if (cp.value === "") camposFaltantes.push("Código postal");

            let mensaje = "Por favor, completa los siguientes campos antes de continuar:\n" + camposFaltantes.join("\n");

            Swal.fire({
                icon: 'error',
                title: 'Campos faltantes',
                text: mensaje
            });
        }
    } else {
        // Si no se necesita envío a domicilio, proceder con el pago directamente
        stripe.createPaymentMethod({
            type: 'card',
            card: card
        }).then(function(result) {
            if (result.error) {
                // Manejar errores de validación de tarjeta
                console.error(result.error.message);
            } else {
                // Envía el PaymentMethod al servidor para procesar el pago
                const total = parseFloat(document.getElementById('total_pagar_si').value);
                enviarPaymentMethodAlServidor(result.paymentMethod, total,2);
            }
        });
    }
});

  // Agregar el botón "Pagar" al contenedor del elemento de tarjeta de crédito
  const contenedorTarjeta = document.getElementById('elemento-tarjeta');
  contenedorTarjeta.appendChild(botonPagar);
  }

  
}

// Función para enviar el PaymentMethod al servidor
function enviarPaymentMethodAlServidor(paymentMethod, total, tipo) {
  mostrarLoader();

  try {

    // ==============================
    // 1. VALIDAR CARRITO
    // ==============================
    const carritoData = localStorage.getItem('carrito');

    if (!carritoData) {
      throw new Error("El carrito está vacío.");
    }

    const carrito = JSON.parse(carritoData);

    if (!carrito || carrito.length === 0) {
      throw new Error("El carrito está vacío.");
    }

    // ==============================
    // 2. VALIDAR DATOS DE ENVÍO
    // ==============================
    const domi = $("#domi");
    const esDomicilio = domi.is(":checked");

    const datosCliente = {
      cliente: document.getElementById("txtNomCliente").value.trim(),
      apellidos: document.getElementById("txtApeCliente").value.trim(),
      telefono: document.getElementById("txtNumTel").value.trim(),
      direccion: document.getElementById("txtDir").value.trim(),
      ciudad: document.getElementById("txtCiudad").value.trim(),
      pais: document.getElementById("txtPais").value.trim(),
      estado: document.getElementById("txtEstado").value.trim(),
      cp: document.getElementById("txtCp").value.trim(),
      comentarios: document.getElementById("txtComentarios").value.trim(),
      tipo_pedido: esDomicilio ? 2 : 1
    };

    if (esDomicilio) {
      for (let key in datosCliente) {
        if (key !== "tipo_pedido" && datosCliente[key] === "") {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Por favor, llena todos los campos para el envío a domicilio!',
          });
          //ocultarLoader();
          return;
        }
      }
    }

    // ==============================
    // 3. PREPARAR PRODUCTOS
    // ==============================
    const articulosPago = carrito.map(producto => ({
      nombreProducto: producto.nombreProducto,
      cantidad: producto.cantidad,
      idProducto: producto.idProducto,
      precio: producto.costo,
      usuario: producto.idUsu,
      idioma: producto.idioma,
      foil: producto.foil,
      condicion: producto.condi
    }));

    // ==============================
    // 4. OBJETO FINAL AL SERVIDOR
    // ==============================
    const datosCombinados = {
      paymentMethodId: paymentMethod.id,
      tipo: tipo,
      articulos: articulosPago,
      cliente: datosCliente,
      total_front: total // solo informativo
    };

    // ==============================
    // 5. ENVIAR TODO AL SERVIDOR
    // ==============================
    fetch('pagina_pago_tarjeta.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(datosCombinados)
    })
    .then(response => response.json())
    .then(data => {

      //ocultarLoader();

      if (!data.success) {
        throw new Error(data.error || "No se pudo procesar el pago.");
      }

      // ==============================
      // 6. MENSAJE FINAL
      // ==============================
      let mensajeFinal = "¡Su pedido se ha realizado de manera correcta!";

      if (data.cartasFaltantes && data.cartasFaltantes.length > 0) {
        mensajeFinal += "\n\nSin embargo, los siguientes productos no estaban en stock:\n";
        mensajeFinal += data.cartasFaltantes
          .map(carta => "- " + carta.nombreProducto)
          .join("\n");
      }

      Swal.fire({
        title: "Pago Exitoso!",
        text: mensajeFinal,
        icon: "success",
        showConfirmButton: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,
      }).then(() => {
        vaciarCarrito();
        window.location.href = 'index.php';
      });

    })
    .catch(error => {

      //ocultarLoader();

      console.error('Error:', error);

      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: error.message || 'Hubo un problema al procesar el pago. Inténtalo nuevamente.',
      });
    });

  } catch (error) {

    //ocultarLoader();

    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: error.message
    });
  }
}

/************************ mostrar el div para envio a domicilio *************************/
function mostrarDiv(tipo) {
  var div = document.getElementById("envio_domi");
  var radio = document.getElementById("domi");
  var radioTienda = document.getElementById("tienda");

 if(tipo == 1){
      if(radioTienda.checked){
        document.getElementById("botoncito_pago").disabled = false;
    } else {
      document.getElementById("botoncito_pago").disabled = true;
    }
 } else{
  if (radio.checked) {
    div.style.display = "block"; // Muestra el div si el radio button "Enviar a domicilio" está seleccionado
  } else {
    div.style.display = "none"; // Oculta el div si el radio button "Enviar a domicilio" no está seleccionado
  }
}
}

function mostrarLoader() {
  Swal.fire({
    html: `
    <img src="./assets/img/gatocorriendo.gif" width="150" height="150">
    <p>Procesando Pago...</p>
    `,
    showCloseButton: false,
    showConfirmButton: false,
    allowOutsideClick: false, // No permite cerrar al hacer clic fuera
    allowEscapeKey: false,    // No permite cerrar con la tecla 'Esc'
    allowEnterKey: false,     // No permite cerrar con la tecla 'Enter'
    customClass: {
      container: 'custom-modal-container',
      popup: 'custom-modal-popup',
      content: 'custom-modal-content',
    }
  });
}


function vaciarCarrito() {
  // Vaciar el objeto productosEnCarrito
  localStorage.removeItem("carrito");
}
