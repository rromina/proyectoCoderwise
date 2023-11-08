/**
 * Funcion de arranque
 */
function bootstrapper() {
  const boton = document.getElementById("login_backoffice");
  boton.addEventListener("click", loginBackoffice);
}

bootstrapper();

/**
 *
 * @param {Record<string, any>} datos
 */
function validarDatos(datos) {
  const { required } = validaciones;

  if (!required(datos.email)) {
    mostrarError(".texto-error", "El campo email es obligatorio.");
    return false;
  }

  if (!required(datos.password)) {
    mostrarError(".texto-error", "El campo contraseña es obligatorio.");
    return false;
  }

  mostrarError(".texto-error", "");
  return true;
}

function obtenerDatos() {
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;

  return {
    email,
    password,
  };
}

async function loginBackoffice(evento) {
  evento.preventDefault();
  const datos = obtenerDatos();

  const es_valido = validarDatos(datos);

  if (!es_valido) return false;

  const formData = new FormData();
  formData.append('email', datos.email);
  formData.append('password', datos.password);

  const fetch_url = BASE_URL+"?c=Login&m=loginBackoffice";
  const options = {method: "POST",body: formData};


  fetch(fetch_url, options)
  .then(response => 
  {
    if (response.ok) return response.json();
    else throw new Error("Error en la solicitud");
  })
  .then(data => 
  {
    if(data.status === "success") window.location.href = `${BASE_URL}?c=Backoffice&m=backoffice_editar`;
  })
  .catch(error => {console.error(error)});

}
