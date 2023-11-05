const USER = document.querySelector("#user_inp");
const PASS = document.querySelector("#pass_inp");


const login = (e)=>
{
    e.preventDefault();

    const data = {
        usuario: USER.value,
        pwd: PASS.value
    };
    
  const formData = new FormData();

  for (const key in data) {
    formData.append(key, data[key]);
  }
  

  const fetch_url = URL+"?c=Login&m=ingresar";
  

  const options = {
    method: "POST",
    body: formData 
  };
  
  
  fetch(fetch_url, options)
    .then(response => {
      if (response.ok) {
        return response.json();
      } else {
        throw new Error("Error en la solicitud");
      }
    })
    .then(data => {
      console.log(data);
    })
    .catch(error => {
      console.error(error);
    });
}