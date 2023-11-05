// CONSTANTES
const BASE_URL = "http://127.0.0.1:8000/viauy/index.php";
/**
 *
 * @param {string} controlador nombre del controlador sin el postfijo _Controller
 * @param {string} accion Nombre de la funcion del controlador
 */
function FetchRequest(controlador, accion) {
  this.url = `${BASE_URL}?c=${controlador}&m=${accion}`;

  /** @private */
  this.body = null;

  /** @private */
  this.headers = {
    "Access-Control-Allow-Origin": "*",
  };

  /** @private */
  this.method = "GET";

  this.agregarEncabezado = function (key, value) {
    this.headers[key] = value;
  };

  this.establecerPayload = function (body) {
    this.body = body;
  };

  this.establecerMetodo = function (method) {
    this.method = method;
  };

  this.request = function () {
    let data = this;
    return new Promise(function (resolve, reject) {
      fetch(data.url, {
        method: data.method,
        headers: data.headers,
        body: data.body,
      }).then(function (response) {
        response
          .json()
          .then(function (jsonResponse) {
            resolve(jsonResponse);
          })
          .catch(function (error) {
            reject(error);
          });
      });
    });
  };
}

//#region utilidades
const validaciones = {
  required: validarRequerido,
  typeNumber: validarNumero,
  typeTime: validarTiempo,
};

/**
 *
 * @param {string} valor
 * @returns {boolean} validacion
 */
function validarRequerido(valor) {
  if (valor === undefined || valor === null || valor === "") return false;
  return true;
}

function validarNumero(valor) {
  const regex = new RegExp(/^(\d){0,}$/, "g");

  return regex.test(valor);
}

function validarTiempo(valor) {
  const regex = new RegExp(/^(\d){2,2}:(\d){2,2}:(\d){2,2}$/, "g");

  return regex.test(valor);
}

/**
 *
 * @param {string} selector
 * @param {string} mensaje
 */
function mostrarError(selector, mensaje) {
  const texto_error = document.querySelector(selector);
  texto_error.innerHTML = mensaje;
}
//#endregion
