function agregarProducto(id,token){
        let url = '../funcionalidades/carrito.php';
        let formData = new FormData();
        FormData.append('id', id);
        FormData.append('token', token);


        fetch(url, {
            methot: 'POST',
            body: formData,
            mode : 'cors'

        }).then(response => response.json())
        .then(data => {
                if(data.ok){
                    let elemento = document.getElementById("num_cart");;
                    elemento.innerHTML = data.numero
                }
        })


}