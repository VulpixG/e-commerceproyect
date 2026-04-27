  /******************************** FUNCIONES LORCANA *******************************/

  $(document).ready(function() {
    $('#buscaCardL').keyup(function() {
        var buscaCard = $(this).val();
        if (buscaCard != '') {
            $.ajax({
                url: 'ajax_lorcana.php',
                type: 'POST',
                data: { 
                    buscaCard: buscaCard,
                    accion: 2
                },
                success: function(data) {
                    $('#coincidenciasL').html(data);
                }
            });
        } else {
            $('#coincidenciasL').html('');
        }
    });
  });

  function guardarCartaL(){
    var nombre_carta = document.getElementById("txtNomCartaL").value;
   var expansion =    document.getElementById("cbExpansionL").value;
   var precio =       document.getElementById("txtPrecioL").value;
   var rareza =       document.getElementById("cboRarezaL").value;
   var cantidad =     document.getElementById("txtCantidL").value;
   var artista =      document.getElementById("txtArtistaL").value;
   var foil =         document.getElementById("tipoFoilL").value;
   var condicion =    document.getElementById("condi_cartaL").value;
   var idioma =       document.getElementById("txtIdiomaL").value;
   var numero_carta = document.getElementById("txtNumColL").value;
   var texto = document.getElementById("floatingTextareaL").value;
 
   var imagen = document.getElementById("fileToUploadL").files[0]; // Obtener el archivo de imagen
 
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
     fetch('ajax_lorcana.php', {
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
         limpiarCamposL()
       }
   })
   .catch(error => {
       console.error('Error al enviar los datos:', error);
   });
     }
   });
 }
 }

 function limpiarCamposL(){
  document.getElementById("txtNomCartaL").value = "";
  document.getElementById("cbExpansionL").value = "0";
  document.getElementById("txtPrecioL").value= "";
  document.getElementById("cboRarezaL").value= "0";
  document.getElementById("txtCantidL").value= "";
  document.getElementById("txtArtistaL").value= "";
  document.getElementById("tipoFoilL").value= "0";
  document.getElementById("condi_cartaL").value= "";
  document.getElementById("txtIdiomaL").value= "";
  document.getElementById("txtNumColL").value= "";
  document.getElementById("floatingTextareaL").value= "";
  document.getElementById("fileToUploadL").value= "";
}
 
 function mostrarEditarL(){
   var divAñadir = document.getElementById("editarCartasL");
   divAñadir.style.display = "block";
 }
 
 function cerrarEditarL(){
   var divAñadir = document.getElementById("editarCartasL");
   divAñadir.style.display = "none";
 }

 function actualizar_cartasL(){
   var id_cartita =   document.getElementById("id_carta_encontradaL").value;
   var nombre_carta = document.getElementById("txtNomCartaEditL").value;
   var expansion =    document.getElementById("cbExpansionEditL").value;
   var rareza =       document.getElementById("rarezaEditL").value;
   var precio =       document.getElementById("txtPrecioEditL").value;
   var cantidad =     document.getElementById("txtCantidEditL").value;
   var artista =      document.getElementById("txtArtistaEditL").value;
   var foil =         document.getElementById("tipoFoilEditL").value;
   var condicion =    document.getElementById("condi_carta_editL").value;
   var texto =        document.getElementById("floatingTextareaEditL").value;
   var idioma =       document.getElementById("txtIdiomaEditL").value;
 
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
     fetch('ajax_lorcana.php', {
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
         limpiarCamposL2()
       }
   })
   .catch(error => {
       console.error('Error al enviar los datos:', error);
   });
     }
   });
 }
 }

 function limpiarCamposL2(){
  document.getElementById("id_carta_encontradaL").value = "";
  document.getElementById("txtNomCartaEditL").value = "";
  document.getElementById("cbExpansionEditL").value= "0";
  document.getElementById("rarezaEditL").value= "0";
  document.getElementById("txtPrecioEditL").value= "";
  document.getElementById("txtCantidEditL").value= "";
  document.getElementById("txtArtistaEditL").value= "";
  document.getElementById("tipoFoilEditL").value= "0";
  document.getElementById("condi_carta_editL").value= "";
  document.getElementById("floatingTextareaEditL").value= "";
  document.getElementById("txtIdiomaEditL").value= "";
}
 
 function carga_carta_encontradaL(id_carta) {
   $.ajax({
       url: 'ajax_lorcana.php',
       type: 'POST',
       data: { 
           id_carta: id_carta,
           accion: 3 
       },
       dataType: 'json', // Especifica que esperas recibir datos JSON
       success: function(data) {
         //console.log(data);
         $('#id_carta_encontradaL').val(data[0].ID_CARTA);
         $('#txtNomCartaEditL').val(data[0].NOM_CARTA);
         $('#cbExpansionEditL').val(data[0].EXPANSION);
         $('#txtPrecioEditL').val(data[0].PRECIO);
         $('#txtCantidEditL').val(data[0].CANTIDAD);
         $('#txtArtistaEditL').val(data[0].ARTISTA);
         $('#tipoFoilEditL').val(data[0].FOIL);
         $('#condi_carta_editL').val(data[0].CONDICION);
         $('#txtIdiomaEditL').val(data[0].IDIOMA);
         $('#rarezaEditL').val(data[0].RAREZA);
         $('#floatingTextareaEditL').val(data[0].TEXTO_CARTA);
 
         $('#div_encontradasL').hide();
       },
       error: function(xhr, status, error) {
           // Maneja los errores de la solicitud AJAX
           console.error(xhr.responseText); // Muestra el mensaje de error en la consola
       }
   });
 }
 
 function mostrarInventarioLor(idUsuario){
  console.log(idUsuario);
  if(idUsuario == 0){
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
          var tableHTML = '<table class="table table-striped table-hover" id="tablaLor">';
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
  } else{
    $.ajax({
      url: 'ajax_lorcana.php',
      type: 'POST',
      data: { 
          accion: 5, idUsuario : idUsuario
      },beforeSend: function() {
        mostrarLoader();
    },success: function(data) {
          // Parse JSON data received from the server
          var jsonData = JSON.parse(data);
          // Create a table to display the inventory
          var tableHTML = '<table class="table table-striped table-hover" id="tablaLor">';
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

 }
 
 function exportarExcelLor(){
   // Obtener los datos de la tabla
   var tabla = document.getElementById('tablaLor');
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
   XLSX.utils.book_append_sheet(libro, hoja, 'Inventario Lorcana');
   // Guardar el archivo de Excel
   XLSX.writeFile(libro, 'inventario_lorcana.xlsx');
 }
 
 function cerrarInvYugi(){
   $('#divInvLorcana').hide();
 }
 
 document.addEventListener("DOMContentLoaded", function() {
   $(document).ready(function(){
     $('#datepickerL').datepicker({
         format: 'dd/mm/yyyy', // Puedes cambiar el formato de la fecha según tus necesidades
         autoclose: true,
         language: 'es' // Configura el idioma a español
     });
 });
 });
 
 
 function agregar_expanL(){
   var nombre_largo = document.getElementById("txtNomExpanL").value;
   var nombre_corto = document.getElementById("txtNomCortoL").value;
   var fecha_lanz =   document.getElementById("datepickerL").value;
 
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
     fetch('ajax_lorcana.php', {
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
 
 function mostrarExpansionesL(){
   var mostrar = document.getElementById("accionesExpansionesL");
   mostrar.style.display = "block";
 }
 
 function cerrarAccionesExpL(){
   var mostrar = document.getElementById("accionesExpansionesL");
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
 /************************* función para buscar coincidencias de expansiones lorcana********************************************************/
 $(document).ready(function() {
   $('#buscaExpanL').keyup(function() {
       var buscaCard = $(this).val();
       if (buscaCard != '') {
           $.ajax({
               url: 'ajax_lorcana.php',
               type: 'POST',
               data: { 
                   buscaCard: buscaCard,
                   accion: 8 
               },
               success: function(data) {
                   $('#coincidencias_expanL').html(data);
               }
           });
       } else {
           $('#coincidencias_expanL').html('');
       }
   });
 });
 
 function mostrarExpansionesEditL(){
   var mostrar = document.getElementById("expansionesEditLor");
   mostrar.style.display = "block";
 }
 
 function cerrarEditExL(){
   var mostrar = document.getElementById("expansionesEditLor");
   mostrar.style.display = "none";
 }
 
 function carga_expan_encontradaL(id_carta,expan,expan_corto,lanzamiento){
   $('#txtNomExpan_2L').val(expan);
   $('#txtNomCorto_2L').val(expan_corto);
   $('#datepicker_2').val(lanzamiento);
   $('#id_expansion_encontradaL').val(id_carta);
 }
 
 function actualizar_expanL(){
   var id_expan = document.getElementById("id_expansion_encontradaL").value;
   var nombre_largo = document.getElementById("txtNomExpan_2L").value;
   var nombre_corto = document.getElementById("txtNomCorto_2L").value;
   var fecha_lanz =   document.getElementById("datepicker_2L").value;
 
 
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
     fetch('ajax_lorcana.php', {
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