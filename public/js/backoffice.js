/**
 * Funcion de arranque
 */
function bootstrapper() {
  const boton_editar_linea = document.getElementById("editar_linea");

  if (boton_editar_linea)
    boton_editar_linea.addEventListener("click", agregarLinea);

  cargarFiltros();
}

bootstrapper();

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
    llenarServicios(data.data.servicios);
    llenarRutas(data.data.rutas);
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

function obtenerInputs() {
  const nombre = document.getElementById("nombre").value;
  const id_servicio = document.getElementById("servicios").value;
  const id_ruta = document.getElementById("rutas").value;
  const duracion = document.getElementById("duracion_viaje").value;
  const precio = document.getElementById("precio").value;

  return {
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
    mostrarError(undefined, "El campo nombre es obligatorio");
    return false;
  }

  if (!required(datos.id_servicio)) {
    mostrarError(undefined, "El campo servicio es obligatorio");
    return false;
  }

  if (!required(datos.id_ruta)) {
    mostrarError(undefined, "El campo ruta es obligatorio");
    return false;
  }

  if (!required(datos.duracion)) {
    mostrarError(undefined, "El campo duracion es obligatorio");
    return false;
  }

  if (!typeTime(datos.duracion)) {
    mostrarError(undefined, "El campo duracion debe tener el formato HH:mm:ss");
    return false;
  }

  if (!required(datos.precio)) {
    mostrarError(undefined, "El campo precio es obligatorio");
    return false;
  }

  if (!typeNumber(datos.precio)) {
    mostrarError(undefined, "El campo precio debe ser de tipo numerico");
    return false;
  }

  mostrarError(undefined, "");
  return true;
}

async function agregarLinea() {

  const datos = obtenerInputs();
  const formData = new FormData();

  Object.entries(datos).forEach(([key, value]) => {console.log(key);console.log(value);formData.append(key, value)});

  const fetch_url = BASE_URL+"?c=Backoffice&m=agregarLinea";
  const options = {method: "POST",body: formData};
  fetch(fetch_url, options)
  .then(response => 
  {
    if (response.ok) return response.json();
    else throw new Error("Error en la solicitud");
  })
  .then(data => 
  {
    console.log(data);
    if (data.status !== "success") throw response;
    else 
    {
      Swal.fire({icon: "success",title: "Se agrego la linea exitosamente"});
    }
    
  })
  .catch(error => {console.error(error)});
}
