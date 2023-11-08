/**
 * Funcion de arranque
 */
function bootstrapper() {
  cargarTabla();
}

bootstrapper();

/**
 *
 * @param {Array<Record<string, any>>} lineas
 */
function llenarTabla(lineas) {
  const cuerpo_tabla = document.querySelector("#tabla_lineas tbody");
  // Se eliminan los anteriores datos
  cuerpo_tabla.innerHTML = "";
  console.log(lineas);

  lineas.forEach((linea) => {
    const fila = document.createElement("tr");
    Object.entries(linea).forEach(([key, value], index) => {
      if (index === 0) return false;

      const celda = document.createElement("td");
      celda.innerText = value;

      fila.appendChild(celda);
    });

    const acciones = document.createElement("td");
    acciones.classList.add("action-column");

    const accion_editar = document.createElement("span");
    const accion_eliminar = document.createElement("span");

    accion_editar.classList.add("fa-solid", "fa-pen-to-square");
    accion_eliminar.classList.add("fa-solid", "fa-xmark");

    // Eventos de acciones
    accion_editar.addEventListener("click", () => verDetalleLinea(linea.IDlinea));
    accion_eliminar.addEventListener("click", () =>
      confirmarEliminacion(linea.IDlinea)
    );

    acciones.append(accion_editar, accion_eliminar);

    fila.appendChild(acciones);
    cuerpo_tabla.appendChild(fila);
  });
}

/**
 *
 * @param {number} id
 */
function verDetalleLinea(id) {
  window.location.href = `${BASE_URL}?c=Backoffice&m=backoffice_detalle_linea&id=${id}`;
}

/**
 *
 * @param {number} id
 */
function confirmarEliminacion(id) {
  Swal.fire({
    icon: "warning",
    title: "¿Esta seguro de eliminar la linea?",
    showCancelButton: true,
    confirmButtonText: "Si",
    cancelButtonText: "No",
  }).then((respuesta) => {
    if (respuesta.isConfirmed) eliminarLinea(id);
  });
}

/**
 *
 * @param {number} id
 */
async function eliminarLinea(id) {

  const formData = new FormData();
  formData.append("id", id);

  const fetch_url = BASE_URL+"?c=Backoffice&m=eliminarLinea";
  const options = {method: "POST",body: formData};
  fetch(fetch_url, options)
  .then(response => 
  {
    if (response.ok) return response.json();
    else throw new Error("Error en la solicitud");
  })
  .then(data => 
  {
    Swal.fire({icon: "success",title: "La linea se ha eliminado exitosamente"});
    cargarTabla();
  })
  .catch(error => {console.error(error)});
}

async function cargarTabla() {
  const formData = new FormData();
  const fetch_url = BASE_URL+"?c=Backoffice&m=cargarTabla";
  const options = {method: "POST",body: formData};
  fetch(fetch_url, options)
  .then(response => 
  {
    if (response.ok) return response.json();
    else throw new Error("Error en la solicitud");
  })
  .then(data => 
  {
    llenarTabla(data.data);
  })
  .catch(error => {console.error(error)});
}
