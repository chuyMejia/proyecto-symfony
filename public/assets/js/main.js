$(document).ready(function() {


    
    // Manejar el cambio de estado del checkbox
    $('#cb3-8').change(function() {
        if ($(this).is(':checked')) {
            // Si el checkbox está activado
            console.log('Checkbox está activado');
            // Puedes realizar acciones adicionales aquí, como mostrar u ocultar elementos


            $('.complete').hide('slow');
            $('.no-complete').show('slow');
            
           
        } else {
            // Si el checkbox está desactivado
            console.log('Checkbox está desactivado');
            $('.complete').show('slow');
            $('.no-complete').hide('slow');
            // Puedes realizar acciones adicionales aquí, como mostrar u ocultar elementos
           
        }
    });
});