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
    accion_editar.addEventListener("click", () => verDetalleLinea(linea.id));
    accion_eliminar.addEventListener("click", () =>
      confirmarEliminacion(linea.id)
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
  const peticion = new FetchRequest("Backoffice", "eliminarLinea");

  const payload = new FormData();
  payload.append("id", id);

  try {
    peticion.establecerMetodo("POST");
    peticion.establecerPayload(payload);

    const respuesta = await peticion.request();

    if (respuesta.status !== "success") return false;

    Swal.fire({
      icon: "success",
      title: "La linea se ha eliminado exitosamente",
    });

    cargarTabla();
  } catch (error) {
    console.error(error);
  }
}

async function cargarTabla() {
  const peticion = new FetchRequest("Backoffice", "cargarTabla");

  try {
    const respuesta = await peticion.request();

    llenarTabla(respuesta.data);
  } catch (error) {
    console.error(error);
  }
}
