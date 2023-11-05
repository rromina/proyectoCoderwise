const reserva = (URL, nombre_user, id_servicio)=>
{
    
    let fecha = new Date();
    
    const data = {
        nombre_user: nombre_user,
        id_servicio: id_servicio,
        fecha_reserva: fecha.getTime()
    }

    const formData = new FormData();

    for (const key in data) {
        formData.append(key, data[key]);
    }
    const fetch_url = URL+"?c=Reserva&m=reserva";
        

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
                if(data.mensaje=="exito")
                {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'reserva generada con exito.',
                        showConfirmButton: false,
                        timer: 1500
                      })
                }
            })
            .catch(error => {
                Swal.fire({
                    title: 'Error!',
                    text: 'Hubo algun error en su reserva de pasaje.',
                    icon: 'error',
                    confirmButtonText: 'Cool'
                  })
            });
    
}






