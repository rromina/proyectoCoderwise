const mostrarPago = document.getElementById('mostrarPago');

mostrarPago.addEventListener('click', function() {
    const asientosSeleccionados = document.querySelectorAll(".asiento.seleccionado");

    if (asientosSeleccionados.length > 0) {
        mostrarOverlay()
    } else {
        alert("Seleccione sus asientos");
    }
});



function mostrarOverlay() {
    document.getElementById('overlay').style.display = 'block';
}

function ocultarOverlay() {
    document.getElementById('overlay').style.display = 'none';
}

function detenerPropagacion(event) {
    event.stopPropagation();
}

document.addEventListener('click', function (event) {
    if (event.target === document.getElementById('cerrar')) {
        ocultarOverlay();
    }
});

