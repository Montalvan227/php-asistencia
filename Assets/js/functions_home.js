
$(document).ready(function() {
    

});



function initProductQuickView(idproducto) {
    let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Productos/getProducto/'+idProducto;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                let htmlImage = "";
                let objProducto = objData.data;
                let estadoProducto = objProducto.status == 1 ? 
                '<span class="badge badge-success">Activo</span>' : 
                '<span class="badge badge-danger">Inactivo</span>';

                document.querySelector("#celNombreProducto").innerHTML = objProducto.nombre;
                document.querySelector("#celDescripcion").innerHTML = objProducto.descripcion;
                document.querySelector("#celEspecificacion").innerHTML = objProducto.especificaciones;
                document.querySelector("#celCodigoBarras").innerHTML = objProducto.codigo;
                document.querySelector("#celSku").innerHTML = objProducto.sku;
                document.querySelector("#celPrecio").innerHTML = objProducto.precio;
                document.querySelector("#celPrecioOferta").innerHTML = objProducto.precio_oferta;
                document.querySelector("#celStock").innerHTML = objProducto.stock;
                document.querySelector("#celPeso").innerHTML = objProducto.peso;
                document.querySelector("#celCategoria").innerHTML = objProducto.categoria;
                document.querySelector("#celMarca").innerHTML = objProducto.marca;

                if(objProducto.images.length > 0){
                    let objProductos = objProducto.images;
                    for (let p = 0; p < objProductos.length; p++) {
                        htmlImage +=`<img src="${objProductos[p].url_image}"></img>`;
                    }
                }
                document.querySelector("#celFotos").innerHTML = htmlImage;
                $('#modalViewProducto').modal('show');

            }else{
                swal("Error", objData.msg , "error");
            }
        }
    } 

    if (btnSizeChart.length) {
        btnSizeChart.on('click', (event) => {
            event.preventDefault();
            event.stopPropagation();

            $body.addClass('quick-view-show');
        });

        btnClose.on('click', (event) => {
            event.preventDefault();
            event.stopPropagation();
            if ($body.hasClass('quick-view-show')) {
                $body.removeClass('quick-view-show');
            }
        });
    }
},