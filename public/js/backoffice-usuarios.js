document.addEventListener('DOMContentLoaded', ()=>
{
    const contenedor_reservas = document.querySelector("#cont_reservas");
    
    const formData = new FormData();
    const fetch_url = BASE_URL+"?c=Backoffice&m=obtenerUsuarios";
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
        const encabezados = ["IDUsuario", "Nombre", "Apellido", "CI", "Email"];

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

            const celdas = [reserva.IDUsuario, reserva.Nombre, reserva.Apellido, reserva.Edad, reserva.Email];

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