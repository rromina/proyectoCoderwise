document.addEventListener('DOMContentLoaded', ()=>
{
    const contenedor_reservas = document.querySelector("#cont_reservas");
    
    const formData = new FormData();
    const fetch_url = BASE_URL+"?c=Backoffice&m=cargarNoticias";
    const options = {method: "POST",body: formData};
    fetch(fetch_url, options)
    .then(response => 
    {
        if (response.ok) return response.json();
        else throw new Error("Error en la solicitud");
    })
    .then(data => 
    {
       // Crear una tabla HTML
        const tabla = document.createElement("table");
        tabla.classList.add("tabla-reservas"); // Agrega una clase a la tabla para aplicar estilos

        // Crear la cabecera de la tabla
        const cabecera = tabla.createTHead();
        const filaCabecera = cabecera.insertRow();
        const encabezados = ["NumeroNoticia", "Titulo", "Descripcion", "Imagen", "Fecha", "ID_Adm"];

        // Agregar encabezados a la fila de cabecera
        encabezados.forEach(textoEncabezado => 
        {
            const th = document.createElement("th");
            th.textContent = textoEncabezado;
            filaCabecera.appendChild(th);
        });

        // Crear el cuerpo de la tabla
        const cuerpo = tabla.createTBody();

        // Iterar a través de las reservas y agregarlas a la tabla
        data.forEach(reserva => 
        {
            const fila = cuerpo.insertRow();

            const celdas = [reserva.NumeroNoticia, reserva.Titulo, reserva.Descripcion, reserva.Imagen, reserva.Fecha, reserva.ID_Adm];

            celdas.forEach(valor => {
                const celda = fila.insertCell();
                celda.textContent = valor;
            });
        });

        // Agregar la tabla al contenedor
        contenedor_reservas.appendChild(tabla);
    })
    .catch(error => {console.error(error)});

})

function crearNoticia() {
    const form = document.getElementById('crearNoticiaForm');
    
    const fechaActual = new Date();
    const fechaFormateada = fechaActual.toISOString().split('T')[0];
    document.getElementById('Fecha').value = fechaFormateada;

    const formData = new FormData(form);

    const fetch_url = BASE_URL + "?c=Backoffice&m=crearNoticia";

    fetch(fetch_url, {
        method: 'POST',
        body: formData,
    })
    .then(response => response.text())
    .then(data => {
        let timerInterval;
        Swal.fire({
        title: "noticia creada con exito!",
        html: "Se redireccionara en <b></b> milliseconds.",
        timer: 2000,
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading();
            const timer = Swal.getPopup().querySelector("b");
            timerInterval = setInterval(() => {
            timer.textContent = `${Swal.getTimerLeft()}`;
            }, 100);
        },
        willClose: () => {
            clearInterval(timerInterval);
        }
        }).then((result) => {
        if (result.dismiss === Swal.DismissReason.timer) {
            location.reload();
        }
        });
        
    })
    .catch(error => {
        console.error('Error al crear noticia:', error);
    });
}
