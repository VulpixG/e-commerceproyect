/** PARA RESERVAR UN DECK**/
function reserva_deck(id_deck,usi){
    if(usi == 0){
        Swal.fire({
            title: "Oops!",
            text: "Debes iniciar sesión para reservar un deck!",
            icon: "error"
          });
    } else{
        Swal.fire({
            title: "Reserva de Deck",
            text: "Reserva el deck seleccionado, solamente ingresa la fecha y hora para cuando quieras jugar!",
            showCancelButton: true,
            confirmButtonText: "Reservar",
            cancelButtonText: "Cancelar",
            onBeforeOpen: function(modalElement) {
                modalElement.querySelector('.swal2-confirm').addEventListener('click', function() {
                    // Obtener el valor del datepicker y timepicker
                    var fechaSeleccionada = $('#datepicker').datepicker('getDate');
                    var horaSeleccionada = $('#timepicker').val();
                    // Verificar si el datepicker está vacío
                    if (!fechaSeleccionada || !horaSeleccionada) {
                        // Si el datepicker está vacío, muestra un mensaje de error
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Por favor, selecciona una fecha y hora para la reserva.'
                        });
                    } else {
                        $.ajax({
                            type: "POST",
                            url: "php/ajax_decks.php",
                            data: {
                                fecha: fechaSeleccionada,
                                hora: horaSeleccionada,
                                id_deck: id_deck,
                                accion: 1
                            },
                            success: function(response) {
                                console.log(response);
                                if (response === "OK") {
                                    Swal.fire({
                                        title: "Deck reservado!",
                                        text: "El deck ha sido reservado para la fecha " + fechaSeleccionada + " a las " + horaSeleccionada,
                                        icon: "success"
                                    });
                                } else {
                                    Swal.fire({
                                        title: "Ups!",
                                        text: "Algo salió mal! " + response,
                                        icon: "error"
                                    });
                                }
                            },
                            error: function(xhr, textStatus, errorThrown) {
                                // Manejo de errores
                            }
                        });                                        
                    }
                });
            },
            onOpen: function() {
                // Agrega el datepicker y el timepicker al modal
                $('<input type="text" class="form-control" id="datepicker" readonly>').appendTo('.swal2-content');
                $('<input type="text" class="form-control" id="timepicker">').appendTo('.swal2-content');
            
                // Obtener la fecha actual en formato DD/MM/YYYY
                var fechaActual = new Date();
                var dia = fechaActual.getDate();
                var mes = fechaActual.getMonth() + 1; // Los meses en JavaScript son base 0
                var año = fechaActual.getFullYear();
                // Formatea la fecha en el formato esperado por el datepicker (DD/MM/YYYY)
                var fechaFormateada = (dia < 10 ? '0' : '') + dia + '/' + (mes < 10 ? '0' : '') + mes + '/' + año;
            
                // Configurar el datepicker con la fecha mínima
                $('#datepicker').datepicker({
                    language: 'es', // Establece el idioma en español
                    autoclose: true, // Cierra el datepicker automáticamente al seleccionar una fecha
                    startDate: fechaFormateada // Establece la fecha mínima
                });
            
                // Configurar el timepicker
                $('#timepicker').timepicker({
                    timeFormat: 'HH:mm', // Formato de 24 horas
                    dropdown: true,
                    scrollbar: true
                });
            
                // Ajuste para obtener la hora seleccionada correctamente
                $('#timepicker').on('changeTime', function() {
                    horaSeleccionada = $(this).val();
                });
            }
        });
    }
}

/*para ver la lista de cartas del deck:*/
function ver_lista(id_deck){
    window.open('deck_list.php?id_deck=' + id_deck, '_blank');
}

$(document).ready(function() {
    // Asignar evento de mouseenter a las filas
    $("tbody tr").mouseenter(function() {
        // Obtener la URL de la imagen de la fila actual
        var imagenURL = $(this).find('img').attr('src');
        // Mostrar la imagen en el elemento <img> con el ID "product-detail"
        $("#product-detail").attr("src", imagenURL);
    });
});
