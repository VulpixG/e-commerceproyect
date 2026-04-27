// Función para agregar productos al carrito y almacenarlos en localStorage
function agregarAlCarrito(costo, idProducto, nombreProducto, stock, idUsu,idioma,foil,condicion) {
    // Escapar las comillas simples y dobles
    nombreProducto = nombreProducto.replace(/['"]/g, function(match) {
        return '\\' + match; // Escapa tanto las comillas simples como dobles
    });

    // Obtener la cantidad seleccionada del select
    var cantidadSelect = document.getElementById("cantidad_" + idProducto);
    var cantidad = cantidadSelect.value;

    // Recuperar productos almacenados en localStorage, si hay alguno
    var productosEnCarrito = JSON.parse(localStorage.getItem("carrito")) || [];

    // Verificar si el producto ya está en el carrito por producto + vendedor
    var productoExistente = productosEnCarrito.find(function(producto) {
        return producto.idProducto === idProducto && producto.idUsu === idUsu;
    });

    if (productoExistente) {
        // Si el producto ya existe en el carrito, actualizar la cantidad
        productoExistente.cantidad = parseInt(cantidad);
    } else {
        // Si el producto no existe en el carrito, agregarlo
        productosEnCarrito.push({ 
            costo: costo, 
            idProducto: idProducto, 
            nombreProducto: nombreProducto, 
            cantidad: parseInt(cantidad), 
            stock: parseInt(stock),
            idUsu: idUsu, // importante para identificar por vendedor
            idioma : idioma,
            foil : foil,
            condi : condicion
        });
    }

    // Guardar el array actualizado en localStorage
    localStorage.setItem("carrito", JSON.stringify(productosEnCarrito));

    // Actualizar contador de productos en el carrito
    actualizarContadorCarrito(productosEnCarrito.length);

    // Actualizar contenido del modal del carrito
    actualizarModalCarrito(productosEnCarrito);

    // Mostrar notificación
    mostrarToast(nombreProducto);
}


function mostrarToast(producto){
    var toastEl = document.getElementById('liveToast');
    var mensajito = document.getElementById('mensajeToast');
    mensajito.innerHTML=producto+' añadido al carrito.'
        var toast = new bootstrap.Toast(toastEl, {
            delay: 2000,  // Tiempo en milisegundos
            autohide: true  // Se ocultará automáticamente
        });
        toast.show();

}

// Función para eliminar un producto del carrito
function eliminarDelCarrito(idProducto) {
    // Recuperar productos almacenados en localStorage
    var productosEnCarrito = JSON.parse(localStorage.getItem("carrito")) || [];

    // Filtrar el producto a eliminar
    productosEnCarrito = productosEnCarrito.filter(function(producto) {
        return producto.idProducto !== idProducto;
    });

    // Guardar el array actualizado en localStorage
    localStorage.setItem("carrito", JSON.stringify(productosEnCarrito));

    // Actualizar contador de productos en el carrito
    actualizarContadorCarrito(productosEnCarrito.length);

    // Actualizar contenido del modal del carrito
    actualizarModalCarrito(productosEnCarrito);
}

// Función para actualizar el contador de productos en el carrito
function actualizarContadorCarrito(cantidad) {
    var contadorCarrito = document.getElementById("contador-carrito");
    contadorCarrito.textContent = cantidad;
}

// Función para obtener los productos del carrito almacenados en localStorage al cargar la página
function obtenerProductosDelCarrito() {
    var productosEnCarrito = JSON.parse(localStorage.getItem("carrito")) || [];
    actualizarContadorCarrito(productosEnCarrito.length);
    actualizarModalCarrito(productosEnCarrito);
}

// Al cargar la página, obtener los productos del carrito almacenados en localStorage
window.onload = obtenerProductosDelCarrito;

// Función para actualizar el contenido del modal del carrito
function actualizarModalCarrito(productosEnCarrito) {
    const contadorCarrito = document.getElementById("contador-carrito");
    const carritoBody = document.getElementById("carrito-body");
    carritoBody.innerHTML = ""; // limpiar tabla
    
    let total = 0;
    const totalElemento = document.getElementById("total");

    // Función auxiliar: recalcula el total completo
    function recalcularTotal() {
        const productos = JSON.parse(localStorage.getItem("carrito")) || [];
        let nuevoTotal = 0;
        productos.forEach(p => {
            nuevoTotal += p.costo * p.cantidad;
        });
        totalElemento.textContent = nuevoTotal.toFixed(2);
    }

    productosEnCarrito.forEach(function(producto) {
        const fila = document.createElement("tr");

        // Nombre
        const columnaNombre = document.createElement("td");
        columnaNombre.textContent = producto.nombreProducto;

        // Cantidad
        const columnaCantidad = document.createElement("td");
        columnaCantidad.style.padding = "35px";
        columnaCantidad.className = "d-flex justify-content-center align-items-center";

        // Botón +
        const botonIncrementar = document.createElement("button");
        botonIncrementar.className = "btn btn-outline-secondary btn-sm rounded-circle";
        botonIncrementar.innerHTML = '<i class="bi bi-plus" style="font-size: 0.8rem;"></i>';

        // Mostrar cantidad
        const cantidad = document.createElement("span");
        cantidad.textContent = producto.cantidad;

        // Botón -
        const botonDecrementar = document.createElement("button");
        botonDecrementar.className = "btn btn-outline-secondary btn-sm rounded-circle";
        botonDecrementar.innerHTML = '<i class="bi bi-dash" style="font-size: 0.8rem;"></i>';

        // Precio unitario
        const columnaPrecioUnitario = document.createElement("td");
        columnaPrecioUnitario.textContent = "$" + producto.costo;

        // Total por producto
        const columnaTotal = document.createElement("td");
        let totalProducto = producto.costo * producto.cantidad;
        columnaTotal.textContent = "$" + totalProducto.toFixed(2);

        // Campo oculto ID
        const campoIdProducto = document.createElement("input");
        campoIdProducto.type = "hidden";
        campoIdProducto.value = producto.idProducto;
        campoIdProducto.id = "producto_id_" + producto.idProducto;

        // Eventos de botones
        botonIncrementar.addEventListener("click", function() {
            if (producto.cantidad < producto.stock) {
                producto.cantidad++;
                cantidad.textContent = producto.cantidad;
                columnaTotal.textContent = "$" + (producto.costo * producto.cantidad).toFixed(2);

                // Actualiza localStorage
                const carrito = JSON.parse(localStorage.getItem("carrito")) || [];
                const prod = carrito.find(p => p.idProducto === producto.idProducto);
                if (prod) prod.cantidad = producto.cantidad;
                localStorage.setItem("carrito", JSON.stringify(carrito));

                // Recalcula el total general
                recalcularTotal();
            } else {
                Swal.fire("Aviso!", "No hay suficiente stock!", "error");
            }
        });

        botonDecrementar.addEventListener("click", function() {
            if (producto.cantidad > 1) {
                producto.cantidad--;
                cantidad.textContent = producto.cantidad;
                columnaTotal.textContent = "$" + (producto.costo * producto.cantidad).toFixed(2);

                const carrito = JSON.parse(localStorage.getItem("carrito")) || [];
                const prod = carrito.find(p => p.idProducto === producto.idProducto);
                if (prod) prod.cantidad = producto.cantidad;
                localStorage.setItem("carrito", JSON.stringify(carrito));

                recalcularTotal();
            } else {
                // Si llega a 1 y baja a 0, eliminar
                const carrito = JSON.parse(localStorage.getItem("carrito")) || [];
                const index = carrito.findIndex(p => p.idProducto === producto.idProducto);
                if (index !== -1) carrito.splice(index, 1);
                localStorage.setItem("carrito", JSON.stringify(carrito));

                fila.remove();
                contadorCarrito.textContent = carrito.length;
                recalcularTotal();
            }
        });

        // Armar columnas
        columnaCantidad.appendChild(botonDecrementar);
        columnaCantidad.appendChild(cantidad);
        columnaCantidad.appendChild(botonIncrementar);

        fila.appendChild(columnaNombre);
        fila.appendChild(columnaCantidad);
        fila.appendChild(columnaPrecioUnitario);
        fila.appendChild(columnaTotal);
        fila.appendChild(campoIdProducto);
        carritoBody.appendChild(fila);

        total += totalProducto;
    });

    totalElemento.textContent = total.toFixed(2);
}


// Función para vaciar el carrito
function vaciarCarrito() {
    // Vaciar el objeto productosEnCarrito
    productosEnCarrito = [];

    // Limpiar contenido del modal del carrito
    var carritoBody = document.getElementById("carrito-body");
    carritoBody.innerHTML = "";

    // Actualizar contador de productos en el carrito a cero
    var contadorCarrito = document.getElementById("contador-carrito");
    contadorCarrito.textContent = "0";

    // Actualizar el total a cero
    var totalElemento = document.getElementById("total");
    totalElemento.textContent = "0";

    // Limpiar la cookie
    document.cookie = "carrito=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";

    // Limpiar localStorage
    localStorage.removeItem("carrito");
}

function pagar_carrito() {
    window.location.href = "././checkout.php";
}

function comprarDeck(id_deck, precio, nombre) {
    Swal.fire({
        title: "Confirmar compra",
        html: `
            <p>¿Deseas comprar el deck <b>${nombre}</b>?</p>
            <h3><b>$${precio}</b> MXN</h3>
            <br>
            <div id="stripe-card-element" style="padding:10px; border:1px solid #ccc; border-radius:6px;"></div>
            <div id="stripe-card-errors" style="color:red; margin-top:10px;"></div>
            <button id="btnPagarStripe" class="btn btn-primary" style="margin-top:15px; width:100%;">Pagar ahora</button>
        `,
        willOpen: () => {

            const stripe = Stripe('pk_test_51OkFOKBy1HoNaFtGNvRsqPKQKJrMRGQVOT4pu1j0KA0vw8nNm8BbUkg3rIfUYy5ii0RWRqlAMeWTGhMlJKUpuO1J00OMSkIGQv');
            
            const elements = stripe.elements();
            const cardElement = elements.create('card');
            cardElement.mount('#stripe-card-element');

            document.getElementById("btnPagarStripe").addEventListener("click", function () {
                this.disabled = true;
                this.innerHTML = "Procesando...";

                stripe.createPaymentMethod({
                    type: 'card',
                    card: cardElement
                }).then(result => {

                    if (result.error) {
                        document.getElementById("stripe-card-errors").textContent = result.error.message;

                        this.disabled = false;
                        this.innerHTML = "Pagar ahora";
                        return;
                    }

                    enviarPaymentMethodDeck(
                        result.paymentMethod.id,
                        precio,
                        id_deck,
                        nombre
                    );

                });
            });

        },
        showConfirmButton: false,
        showCancelButton: true,
        cancelButtonText: "Cancelar"
    });
}

function enviarPaymentMethodDeck(paymentMethodId, precio, id_deck, nombre) {

    fetch("pagar_deck.php", {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify({
            payment_method: paymentMethodId,
            monto: precio,
            deck: id_deck,
            nombre: nombre
        })
    })
    .then(r => r.json())
    .then(data => {
        if (data.status === "success") {
            Swal.fire("Pago realizado", "Tu deck fue comprado exitosamente", "success");
        } else {
            Swal.fire("Error", data.message, "error");
        }
    });
}

function sinStock(nombre){
    Swal.fire({
        title: '¡Lo sentimos!',
        text: 'No se tenemos stock para la carta ' + nombre +'.',
        imageUrl: 'assets/img/triste.png',
        imageWidth: 120,
        imageHeight: 120,
    });
}