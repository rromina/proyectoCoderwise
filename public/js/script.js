/* Header */

let menu = document.querySelector ('#menu');
let nav = document.querySelector ('nav');
let icons = document.querySelector ('.icons-box');
let iconMain = document.querySelector ('#link-icon-main')
let iconMovil = document.querySelector ('#icon-main-movil')

menu.onclick = () => {
    nav.classList.toggle('open');
    icons.classList.toggle('open');
    menu.classList.toggle('fa-xmark');
    iconMain.classList.toggle('open')
    iconMovil.classList.toggle('open')
}




/* Inicio seccion comprar pasaje */

const back = document.getElementById('back');
const go = document.getElementById('go');
const dayBack = document.getElementById('day-back');


back.onclick = () =>{
  dayBack.style.display='block';
}

go.onclick = () => {
    dayBack.style.display = 'none';
};




/* Register */


function validarInput(event) {
  let input = event.target;
  let valor = input.value;
  let regex = /^[A-Za-záéíóúÁÉÍÓÚ\s]+$/;
  
  if (!regex.test(valor)) {
    input.value = valor.replace(/[^A-Za-záéíóúÁÉÍÓÚ\s]+/g, '');
  }
}



/* Contraseñas validacion*/

function validarPassword(event) {
  let input = event.target;
  let valor = input.value;
  let regex = /[0-9!@#$%^&*(),.?":{}|<>]/;
  let password = document.getElementById('password').value
  let warningLength = document.getElementById('warning-length');
  let register = document.getElementById('register');
  
  let hasSpecialChars = regex.test(valor);
  let hasMinLength = password.length >= 6;
  
  if (!hasSpecialChars || !hasMinLength) {
    warningLength.style.opacity = '1'
    register.setAttribute('onsubmit', 'event.preventDefault();');
  } else {
    warningLength.style.opacity = '0'
    register.removeAttribute('onsubmit');
  }
}



function validarConfirmacion() {
  let password = document.getElementById('password').value;
  let confirmPassword = document.getElementById('confirm-password').value;
  let matchMessage = document.getElementById('match-message');
  let warningLength = document.getElementById('warning-length');
  let register = document.getElementById('register');
  
  if (password !== confirmPassword) {
    matchMessage.style.opacity = '1';
    register.setAttribute('onsubmit', 'event.preventDefault();');
  } else {
    matchMessage.style.opacity = '0';
    if (password.length < 6) {
      warningLength.style.opacity = '1';
      register.setAttribute('onsubmit', 'event.preventDefault();');
    } else {
      warningLength.style.opacity = '0';
      register.removeAttribute('onsubmit');
    }
  }
}

document.getElementById('password').addEventListener('input', validarConfirmacion);
document.getElementById('confirm-password').addEventListener('input', validarConfirmacion);

/***************************************  ***************************************/

