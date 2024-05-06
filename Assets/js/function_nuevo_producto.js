
$(document).ready(function() {
    

    ClassicEditor
        .create( document.querySelector( '#txtEspecificacion' ), { 
        } )
        .then( editor => {
            window.editor = editor;
        } )
        .catch( err => {
            console.error( err.stack );
        } );


    $('.js-example-basic-multiple').select2();

    initailizeSelectCategoria();
    initailizeSelectMarca();
    camposVariantes();

    /*INICIALIZAR CAMPOS AL EDITAR Y CREAR*/
    let idProductoI = document.querySelector('#idProducto').value;
    if (idProductoI) {

    }else{
        document.querySelector("#divBarCode").classList.add("notblock");
        document.querySelector("#containerGallery").classList.add("notblock");
        document.querySelector("#containerImages").innerHTML = "";
        document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
        document.querySelector('#btnText').innerHTML ="Guardar";
        document.querySelector('#titleProduct').innerHTML = "Nuevo Producto";
        document.querySelector("#formProductos").reset();
    }

});


window.addEventListener('load', function() {
    if(document.querySelector("#formProductos")){
        let formProductos = document.querySelector("#formProductos");
        formProductos.onsubmit = function(e) {
            e.preventDefault();
            let strNombre = document.querySelector('#txtNombre').value;
            let intCodigo = document.querySelector('#txtCodigo').value;
            let strPrecio = parseFloat(document.querySelector('#txtPrecio').value);
            let strPrecioOferta = parseFloat(document.querySelector('#txtPrecioOferta').value);
            let intStock = document.querySelector('#txtStock').value;
            let intPeso = document.querySelector('#txtPeso').value;
            let listCategoria = document.querySelector('#listCategoria').value;
            let listMarca = document.querySelector('#listMarca').value;
            let intStatus = document.querySelector('#listStatus').value;


            if(strNombre == '' || intStock == '' || listCategoria == '' || listMarca == '' )
            {
                swal("Atención", "Todos los campos son obligatorios." , "error");
                return false;
            }
            if (strPrecio != null & strPrecio >= 0)
            {
                if (!validateDecimal2(strPrecio)) {
                    swal("Atención", "Prcio decimal no correcto" , "error");
                    return false;
                }
                if (strPrecioOferta != null & strPrecioOferta >= 0) {
                    if (!validateDecimal2(strPrecioOferta)) {
                        swal("Atención", "Prcio de Oferta decimal no correcto" , "error");
                        return false;
                    }
                    if (strPrecio < strPrecioOferta) {
                        swal("Atención", "El precio de Oferta no puede ser mayor." , "error");
                        return false;
                    }
                }else{
                    swal("Atención", "Precio de Oferta no correcto" , "error");
                    return false;
                }

            }else{
                swal("Atención", "Precio no correcto" , "error");
                return false;
            }
            if (intPeso != null & intPeso > 0 & validateDecimal(intPeso)) {
            }else{
                swal("Atención", "Peso no Correcto" , "error");
                return false;x
            }
            if(intCodigo != "" & intCodigo.length < 5){
                swal("Atención", "El código debe ser mayor que 5 dígitos." , "error");
                return false;
            }else{
                let codigoGenerado = fntGenerarCodigo();
                document.querySelector('#txtCodigo').value = codigoGenerado;
            }
            //divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? 
                            new XMLHttpRequest() : 
                            new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Productos/setProducto';
            let formData = new FormData(formProductos);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        //swal("", objData.msg ,"success");
                        document.querySelector("#idProducto").value = objData.idproducto;
                        //document.querySelector("#containerGallery").classList.remove("notblock");
                        //tableProductos.api().ajax.reload(null, false);
                        swal("Registro Guardado con Exito", {
                          buttons: {
                            catch: {
                              text: "Ver Productos",
                              value: "catch",
                            },
                            cancel: "Nuevo",
                            defeat: "Agregar Imagenes",
                          },
                        })
                        .then((value) => {
                          switch (value) {
 
                            case "defeat":
                              swal({
                                  title: "Producto Guardado con Exito",
                                  text: "Agregar Imagenes",
                                  icon: "success",
                                  button: "Ok",
                                });
                                document.querySelector("#idProducto").value = objData.idproducto;
                                document.querySelector("#containerGallery").classList.remove("notblock");
                                document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
                                document.querySelector('#btnText').innerHTML ="Actualizar";
                                document.querySelector('#titleProduct').innerHTML = "Actualizar Producto";
                              break;
                         
                            case "catch":
                              window.location = base_url + '/Productos';
                              break;
                         
                            default:
                              location.reload(true);
                          }
                        });
                    
                    }else{
                        swal("Error", objData.msg , "error");
                    }
                }
                //divLoading.style.display = "none";
                return false;
            }
        }
    }

    if(document.querySelector(".btnAddImage")){
       let btnAddImage =  document.querySelector(".btnAddImage");
       btnAddImage.onclick = function(e){
        let key = Date.now();
        let newElement = document.createElement("div");
        newElement.id= "div"+key;
        newElement.innerHTML = `
            <div class="prevImage"></div>
            <input type="file" name="foto" id="img${key}" class="inputUploadFile">
            <label for="img${key}" class="btnUploadFile"><span class="tf-icons bx bx-upload"></span></label>
            <button class="btnDeleteImage notblock" type="button" onclick="fntDelItem('#div${key}')"><span class="tf-icons bx bx-trash"></span></button>`;
        document.querySelector("#containerImages").appendChild(newElement);
        document.querySelector("#div"+key+" .btnUploadFile").click();
        fntInputFile();
       }
    }

    fntInputFile();
    /*fntCategorias();*/
}, false);

function fntInputFile(){
    let inputUploadfile = document.querySelectorAll(".inputUploadFile");
    inputUploadfile.forEach(function(inputUploadfile) {
        inputUploadfile.addEventListener('change', function(){
            let idProducto = document.querySelector("#idProducto").value;
            let parentId = this.parentNode.getAttribute("id");
            let idFile = this.getAttribute("id");            
            let uploadFoto = document.querySelector("#"+idFile).value;
            let fileimg = document.querySelector("#"+idFile).files;
            let prevImg = document.querySelector("#"+parentId+" .prevImage");
            let nav = window.URL || window.webkitURL;
            if(uploadFoto !=''){
                let type = fileimg[0].type;
                let name = fileimg[0].name;
                if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png'){
                    prevImg.innerHTML = "Archivo no válido";
                    uploadFoto.value = "";
                    return false;
                }else{
                    let objeto_url = nav.createObjectURL(this.files[0]);
                    prevImg.innerHTML = `<img class="loading" src="${base_url}/Assets/img/loading/loading.svg" >`;

                    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    let ajaxUrl = base_url+'/Productos/setImage';
                    let formData = new FormData();
                    formData.append('idproducto',idProducto);
                    formData.append("foto", this.files[0]);
                    request.open("POST",ajaxUrl,true);
                    request.send(formData);
                    request.onreadystatechange = function(){
                        if(request.readyState != 4) return;
                        if(request.status == 200){
                            let objData = JSON.parse(request.responseText);
                            if(objData.status){
                                prevImg.innerHTML = `<img src="${objeto_url}">`;
                                document.querySelector("#"+parentId+" .btnDeleteImage").setAttribute("imgname",objData.imgname);
                                document.querySelector("#"+parentId+" .btnUploadFile").classList.add("notblock");
                                document.querySelector("#"+parentId+" .btnDeleteImage").classList.remove("notblock");
                            }else{
                                swal("Error", objData.msg , "error");
                            }
                        }
                    }

                }
            }

        });
    });
}

function fntEditInfo(element,idProducto){
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";
    document.querySelector('#titleProduct').innerHTML = "Actualizar Producto";
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
                document.querySelector("#idProducto").value = objProducto.idproducto;
                document.querySelector("#txtNombre").value = objProducto.nombre;
                document.querySelector("#txtDescripcion").value = objProducto.descripcion;
                document.querySelector("#txtCodigo").value = objProducto.codigo;
                document.querySelector("#txtPrecio").value = objProducto.precio;
                document.querySelector("#txtStock").value = objProducto.stock;
                document.querySelector("#listCategoria").value = objProducto.categoriaid;
                document.querySelector("#listStatus").value = objProducto.status;
                $('#listCategoria').trigger('change');
                $('#listStatus').trigger('change');
                fntBarcode();

                if(objProducto.images.length > 0){
                    let objProductos = objProducto.images;
                    for (let p = 0; p < objProductos.length; p++) {
                        let key = Date.now()+p;
                        htmlImage +=`<div id="div${key}">
                            <div class="prevImage">
                            <img src="${objProductos[p].url_image}"></img>
                            </div>
                            <button type="button" class="btnDeleteImage" onclick="fntDelItem('#div${key}')" imgname="${objProductos[p].img}">
                            <i class="fas fa-trash-alt"></i></button></div>`;
                    }
                }
                document.querySelector("#containerImages").innerHTML = htmlImage; 
                document.querySelector("#divBarCode").classList.remove("notblock");
                document.querySelector("#containerGallery").classList.remove("notblock");           
                $('#modalFormProductos').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }
}


function fntDelItem(element){
    let nameImg = document.querySelector(element+' .btnDeleteImage').getAttribute("imgname");
    let idProducto = document.querySelector("#idProducto").value;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Productos/delFile'; 

    let formData = new FormData();
    formData.append('idproducto',idProducto);
    formData.append("file",nameImg);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function(){
        if(request.readyState != 4) return;
        if(request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                let itemRemove = document.querySelector(element);
                itemRemove.parentNode.removeChild(itemRemove);
            }else{
                swal("", objData.msg , "error");
            }
        }
    }
}




/*if(document.querySelector("#txtCodigo")){
    let inputCodigo = document.querySelector("#txtCodigo");
    inputCodigo.onkeyup = function() {
        if(inputCodigo.value.length >= 5){
            document.querySelector('#divBarCode').classList.remove("notblock");
            fntBarcode();
       }else{
            document.querySelector('#divBarCode').classList.add("notblock");
       }
    };
}*/



function fntBarcode(){
    let codigo = document.querySelector("#txtCodigo").value;
    JsBarcode("#barcode", codigo);
}


function fntPrintBarcode(area){
    let elemntArea = document.querySelector(area);
    let vprint = window.open(' ', 'popimpr', 'height=400,width=600');
    vprint.document.write(elemntArea.innerHTML );
    vprint.document.close();
    vprint.print();
    vprint.close();
}

function camposVariantes(){
    $('#listTProducto').change(function(){
        let tProducto = document.querySelector('#listTProducto').value;
        if (tProducto == "1") {
            $('.campos-variantes').css("display", "none");
        }else if (tProducto == "2") {
            $('.campos-variantes').css("display", "block");
        }else{
            swal("Atención", "Error de Datos" , "error");
        }
    });
}


function initailizeSelectCategoria(){
    $('#listCategoria').select2({
        //dropdownParent: $('#modalFormCategorias'),
        ajax: {
            url: base_url+'/Categorias/getSelectCategorias',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    palabraClave: params.term // search term
                };
            },
            processResults: function (response) {
                return {
                    results: response
                };
            },
        cache: true
        }
    });
}

function initailizeSelectMarca(){
    $('#listMarca').select2({
        //dropdownParent: $('#modalFormCategorias'),
        ajax: {
            url: base_url+'/Marcas/getSelectMarcas',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    palabraClave: params.term // search term
                };
            },
            processResults: function (response) {
                return {
                    results: response
                };
            },
        cache: true
        }
    });
}
