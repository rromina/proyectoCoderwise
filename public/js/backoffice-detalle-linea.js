// Variables globales
let id_detalle = null;
/**
 * Funcion de arranque
 */
function bootstrapper() {
  obtenerId();

  cargarFiltros();

  // Eventos
  const boton_editar = document.getElementById("editar_linea");
  boton_editar.addEventListener("click", confirmarEdicion);
}

bootstrapper();

function obtenerId() {
  const query_params = new URLSearchParams(window.location.href);

  id_detalle = query_params.get("id");
}

async function cargarFiltros() {

  const formData = new FormData();
  const fetch_url = BASE_URL+"?c=Backoffice&m=obtenerFiltros";
  const options = {method: "POST",body: formData};
  fetch(fetch_url, options)
  .then(response => 
  {
    if (response.ok) return response.json();
    else throw new Error("Error en la solicitud");
  })
  .then(data => 
  {
    console.log(data.data);
    llenarServicios(data.data.servicios);
    llenarRutas(data.data.rutas);
    cargarDatosDetalle();
  })
  .catch(error => {console.error(error)});

}

function llenarRutas(rutas) {
  if (!rutas) return false;

  const selector_rutas = document.getElementById("rutas");
  selector_rutas.innerHTML = "<option value=''>SELECCIONAR</option>";

  rutas.forEach(function (ruta) {
    const opcion_nueva = document.createElement("option");
    opcion_nueva.value = ruta.id;
    opcion_nueva.innerText = ruta.nombre;

    selector_rutas.appendChild(opcion_nueva);
  });
}

function llenarServicios(servicios) {
  if (!servicios) return false;

  const selector_servicio = document.getElementById("servicios");
  selector_servicio.innerHTML = "<option value=''>SELECCIONAR</option>";

  servicios.forEach(function (servicio) {
    const opcion_nueva = document.createElement("option");
    opcion_nueva.value = servicio.id;
    opcion_nueva.innerText = servicio.nombre;

    selector_servicio.appendChild(opcion_nueva);
  });
}

async function cargarDatosDetalle() {
  const peticion = new FetchRequest("Backoffice", "verDetalle");

  const payload = new FormData();
  payload.append("id", id_detalle);
  try {
    peticion.establecerMetodo("POST");
    peticion.establecerPayload(payload);

    const respuesta = await peticion.request();

    if (respuesta.status !== "success") return false;

    llenarDetalle(respuesta.data);
  } catch (error) {
    console.error(error);
  }
}

/**
 *
 * @param {Record<string, any>} datos
 */
function llenarDetalle(datos) {
  const nombre = document.getElementById("nombre");
  nombre.value = datos.nombre;

  const evento = new Event("change");

  const servicios = document.getElementById("servicios");
  servicios.value = datos.id_servicio;
  servicios.dispatchEvent(evento);

  const rutas = document.getElementById("rutas");
  rutas.value = datos.id_ruta;
  rutas.dispatchEvent(evento);

  const duracion_viaje = document.getElementById("duracion_viaje");
  duracion_viaje.value = datos.duracion_viaje;

  const precio = document.getElementById("precio");
  precio.value = Number(datos.precio);
}

function obtenerInputs() {
  const nombre = document.getElementById("nombre").value;
  const id_servicio = document.getElementById("servicios").value;
  const id_ruta = document.getElementById("rutas").value;
  const duracion = document.getElementById("duracion_viaje").value;
  const precio = document.getElementById("precio").value;

  return {
    id: id_detalle,
    nombre,
    id_servicio,
    id_ruta,
    duracion,
    precio,
  };
}

/**
 *
 * @param {Record<string, any>} datos
 */
function validarDatos(datos) {
  const { required, typeNumber, typeTime } = validaciones;

  if (!required(datos.nombre)) {
    mostrarError(".texto-error", "El campo nombre es obligatorio");
    return false;
  }

  if (!required(datos.id_servicio)) {
    mostrarError(".texto-error", "El campo servicio es obligatorio");
    return false;
  }

  if (!required(datos.id_ruta)) {
    mostrarError(".texto-error", "El campo ruta es obligatorio");
    return false;
  }

  if (!required(datos.duracion)) {
    mostrarError(".texto-error", "El campo duracion es obligatorio");
    return false;
  }

  if (!typeTime(datos.duracion)) {
    mostrarError(
      ".texto-error",
      "El campo duracion debe tener el formato HH:mm:ss"
    );
    return false;
  }

  if (!required(datos.precio)) {
    mostrarError(".texto-error", "El campo precio es obligatorio");
    return false;
  }

  if (!typeNumber(datos.precio)) {
    mostrarError(".texto-error", "El campo precio debe ser de tipo numerico");
    return false;
  }

  mostrarError(".texto-error", "");
  return true;
}

function confirmarEdicion() {
  Swal.fire({
    icon: "warning",
    title: "¿Esta seguro de editar la linea?",
    showCancelButton: true,
    confirmButtonText: "Si",
    cancelButtonText: "No",
  }).then((respuesta) => {
    if (respuesta.isConfirmed) actualizarLinea();
  });
}

async function actualizarLinea() 
{

  const datos = obtenerInputs();

  const formData = new FormData();
  Object.entries(datos).forEach(([key, value]) => {console.log(key);console.log(value);formData.append(key, value)});

  const fetch_url = BASE_URL+"?c=Backoffice&m=editarLinea";
  const options = {method: "POST",body: formData};
  fetch(fetch_url, options)
  .then(response => 
  {
    if (response.ok) return response.json();
    else throw new Error("Error en la solicitud");
  })
  .then(data => 
  {
    if (data.status !== "success") throw data;
    else 
    {
      Swal.fire({title: "Se edito la linea exitosamente",icon: "success"});
    }
  })
  .catch(error => {console.error(error);Swal.fire({
    title: "Ha ocurrido un error al editar la linea",
    icon: "error",
  });});
}
