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
  