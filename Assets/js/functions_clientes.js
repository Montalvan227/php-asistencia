let tableClientes;
let divLoading = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function(){

    tableClientes = $('#tableClientes').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": " "+base_url+"/Assets/js/plugins/datatable/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Clientes/getClientes",
            "dataSrc":""
        },
        "columns":[
            {"data":"tipo_persona"},
            {"data":"identificacion"},
            {"data":"nombrefiscal"},
            {"data":"email_user"},
            {"data":"telefono"},
            {"data":"options"}
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]
    });

	if(document.querySelector("#formCliente")){
        let formCliente = document.querySelector("#formCliente");
        formCliente.onsubmit = function(e) {
            e.preventDefault();
            let strTipoPersona = document.querySelector('#listTPersona').value;
            let intTipoDocumento = document.querySelector('#listTDocumento').value;
            let strIdentificacion = document.querySelector('#txtIdentificacion').value;
            let strNombre = document.querySelector('#txtNombre').value;
            let strApellido = document.querySelector('#txtApellido').value;
            let strNombreCompleto = '';
            let strEmail = document.querySelector('#txtEmail').value;
            let intTelefono = document.querySelector('#txtTelefono').value;
            let strDireccion = document.querySelector('#txtDireccion').value;
            let intTipousuario = document.querySelector('#listRolid').value;
            let strPassword = document.querySelector('#txtPassword').value;
            let intStatus = document.querySelector('#listStatus').value;
            let es_empleado = document.querySelector('#chkEs_empleado').value;
            let es_cliente = document.querySelector('#chkEs_cliente').value;
            let es_proveedor = document.querySelector('#chkEs_proveedor').value;

            if (strTipoPersona=="Natural") {
                strNombreCompleto = strNombre + ' ' + strApellido;
            } else {
                strNombreCompleto = document.querySelector('#txtNombreCompleto').value;
            }

            if(strIdentificacion == '' || strTipoPersona == '' || intTipoDocumento == '' || strApellido == '' & strNombre == '' & strNombreCompleto == '' || strEmail == '' || intTipousuario == '')
            {
                swal("Atención", "Completar los campos son obligatorios." , "error");
                return false;
            }

            if(parseInt(strIdentificacion) < 11111111){swal("Atención", "Identifiacion no Valida" , "error");return false;}
            if(parseInt(intTelefono) < 11111){swal("Atención", "Telefono no Valida" , "error");return false;}

            //divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Personas/setPersona'; 
            let formData = new FormData(formCliente);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        tableClientes.api().ajax.reload(null, false);
                        $('#modalFormCliente').modal("hide");
                        formCliente.reset();
                        swal("Clientes", objData.msg ,"success");
                    }else{
                        swal("Error", objData.msg , "error");
                    }
                }
                //divLoading.style.display = "none";
                return false;
            }
        }
    }


}, false);


function fntViewInfo(idpersona){
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Personas/getPersona/'+idpersona;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                document.querySelector("#celIdentificacion").innerHTML = objData.data.identificacion;
                document.querySelector("#celNombre").innerHTML = objData.data.nombres;
                document.querySelector("#celApellido").innerHTML = objData.data.apellidos;
                document.querySelector("#celNombreCompleto").innerHTML = objData.data.nombrefiscal;
                document.querySelector("#celTelefono").innerHTML = objData.data.telefono;
                document.querySelector("#celEmail").innerHTML = objData.data.email_user;
                document.querySelector("#celTPersona").innerHTML = objData.data.tipo_persona;
                document.querySelector("#celTipoUsuario").innerHTML = objData.data.nombrerol;
                document.querySelector("#celDireccion").innerHTML = objData.data.direccion;
                document.querySelector("#celFechaRegistro").innerHTML = objData.data.fechaRegistro; 

                if (objData.data.tipo_persona == "Natural") {
                    $('.celNombreCompleto').css("display", "none");
                    $('.celNombreApellido').css("display", "block");
                } else {
                    $('.celNombreCompleto').css("display", "block");
                    $('.celNombreApellido').css("display", "none");
                }

                if (objData.data.tipo_documento == "1") {document.querySelector("#celTDocumento").innerHTML = "DNI";}
                else if (objData.data.tipo_documento == "2") {document.querySelector("#celTDocumento").innerHTML = "Carnet de Extranjería";}
                else if (objData.data.tipo_documento == "3") {document.querySelector("#celTDocumento").innerHTML = "Pasaporte";}
                else if (objData.data.tipo_documento == "4") {document.querySelector("#celTDocumento").innerHTML = "RUC";}
                else {document.querySelector("#celTDocumento").innerHTML = "Error de Documento";}                

                $('#modalViewCliente').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }
}

function fntEditInfo(element, idpersona){
    document.querySelector('#titleModal').innerHTML ="Actualizar Cliente";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Personas/getPersona/'+idpersona;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                document.querySelector("#idUsuario").value = objData.data.idpersona;
                document.querySelector("#txtIdentificacion").value = objData.data.identificacion;
                document.querySelector("#txtNombre").value = objData.data.nombres;
                document.querySelector("#txtApellido").value = objData.data.apellidos;
                document.querySelector("#txtNombreCompleto").value = objData.data.nombrefiscal;
                document.querySelector("#txtTelefono").value = objData.data.telefono;
                document.querySelector("#txtDireccion").value = objData.data.direccion;
                document.querySelector("#txtEmail").value = objData.data.email_user;
                document.querySelector("#listRolid").value =objData.data.idrol;
                //CHECKED A LOS CHECKBOX
                if (objData.data.es_cliente == 1) {document.querySelector("#chkEs_cliente").setAttribute("checked", "");}else{document.querySelector("#chkEs_cliente").removeAttribute("checked");}
                if (objData.data.es_empleado == 1) {document.querySelector("#chkEs_empleado").setAttribute("checked", "");}else{document.querySelector("#chkEs_empleado").removeAttribute("checked");}
                if (objData.data.es_proveedor == 1) {document.querySelector("#chkEs_proveedor").setAttribute("checked", "");}else{document.querySelector("#chkEs_proveedor").removeAttribute("checked");}
                
                document.querySelector('#listTPersona').value = objData.data.tipo_persona;
                $('#listTPersona').trigger('change');
                document.querySelector('#listTDocumento').value = objData.data.tipo_documento;
                $('#listTDocumento').trigger('change');

            }
        }
        $('#modalFormCliente').modal('show');
    }
}

function fntDelInfo(idpersona){
    swal({
        title: "Eliminar Usuario",
        text: "¿Realmente quiere eliminar el Usuario?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {

          if (willDelete) {
            
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Personas/delPersona';
            let strData = "idUsuario="+idpersona;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableClientes.api().ajax.reload(null, false);
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });

}

function openModal()
{
    document.querySelector('#idUsuario').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Cliente";
    document.querySelector("#formCliente").reset();
    document.querySelector('#listTPersona').value ="Natural";
    document.querySelector("#chkEs_empleado").removeAttribute("checked");
    document.querySelector("#chkEs_cliente").setAttribute("checked", "");
    document.querySelector("#chkEs_proveedor").removeAttribute("checked");

    $('#modalFormCliente').modal('show');
}


$('#buscarIdentificacion').click(function(){
    buscarDocumento();
});

$('#listTPersona').change(function(){
    verificarTPersona();
});

function verificarTPersona(){
    let tPersona = document.querySelector('#listTPersona').value;
    let tDocumento = document.querySelector('#listTDocumento').value;
    if (tPersona == "Natural") {
        $('#listTDocumento').html('<option value="1">DNI</option><option value="2">Carnet de Extranjería</option><option value="3">Pasaporte</option>');
        $('.nombreApellido').css("display", "flex");
        $('.nombreFiscal').css("display", "none");
    }else if (tPersona == "Jurídica") {
        $('#listTDocumento').html('<option value="4">RUC</option>');
        $('.nombreApellido').css("display", "none");
        $('.nombreFiscal').css("display", "flex");
    }else{
        swal("Atención", "Error de Datos" , "error");
    }
}
