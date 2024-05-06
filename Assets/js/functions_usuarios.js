let tableUsuarios;
var divLoading = document.querySelector("#divloading");
document.addEventListener('DOMContentLoaded', function(){

	tableUsuarios = $('#tableUsuarios').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": " "+base_url+"/Assets/js/plugins/datatable/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Usuarios/getUsuarios",
            "dataSrc":""
        },
        "columns":[
            {"data":"nombre_rol"},
            {"data":"n_documento"},
            {"data":"nombresApellidos"},
            {"data":"email"},
            {"data":"telefono"},
            {"data":"estado"},
            {"data":"options"}
        ],
        "responsive":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[2,"asc"]]
    });


	if(document.querySelector("#formUsuario")){
        let formUsuario = document.querySelector("#formUsuario");
        formUsuario.onsubmit = function(e) {
            e.preventDefault();
            let strIdentificacion = document.querySelector('#txtIdentificacion').value;
            let strNombre = document.querySelector('#txtNombre').value;
            let strApellido = document.querySelector('#txtApellido').value;
            let strEmail = document.querySelector('#txtEmail').value;
            let intTelefono = document.querySelector('#txtTelefono').value;
            let strDireccion = document.querySelector('#txtDireccion').value;
            let intTipousuario = document.querySelector('#listRolid').value;
            let strPassword = document.querySelector('#txtPassword').value;
            let intStatus = document.querySelector('#listStatus').value;

            if(strIdentificacion == '' || strApellido == '' & strNombre == '' || strEmail == '' || intTipousuario == '')
            {
                swal("Atención", "Completar los campos son obligatorios." , "error");
                return false;
            }

            if(parseInt(strIdentificacion) < 11111111){swal("Atención", "Identifiacion no Valida" , "error");return false;}
            //if(parseInt(intTelefono) < 11111){swal("Atención", "Telefono no Valida" , "error");return false;}

            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Personas/setPersona';
            let formData = new FormData(formUsuario);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {   
                        tableUsuarios.api().ajax.reload(null, false);
                        $('#modalFormUsuario').modal("hide");
                        formUsuario.reset();
                        swal("Usuarios", objData.msg ,"success");
                    }else{
                        swal("Error", objData.msg , "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }

        }
    };   

    if(document.querySelector("#formPerfil")){
        let formPerfil = document.querySelector("#formPerfil");
        formPerfil.onsubmit = function(e) {
            e.preventDefault();
            let strIdentificacion = document.querySelector('#txtIdentificacion').value;
            let strNombre = document.querySelector('#txtNombre').value;
            let strApellido = document.querySelector('#txtApellido').value;
            let intTelefono = document.querySelector('#txtTelefono').value;

            if(strIdentificacion == '' || strApellido == '' || strNombre == '' || intTelefono == '')
            {
                swal("Atención", "Completar los campos son obligatorios." , "error");
                return false;
            }

            if(parseInt(strIdentificacion) < 11111111){swal("Atención", "Identifiación no Valida" , "error");return false;}
            if(parseInt(intTelefono) < 11111){swal("Atención", "Telefono no Valida" , "error");return false;}
            
            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Usuarios/putPerfil'; 
            let formData = new FormData(formPerfil);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState != 4) return;
                if(request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        $('#modalFormPerfil').modal("hide");
                        swal({
                            title: "",
                            text: objData.msg,
                            icon: "success",
                            confirmButtonText: "Aceptar",
                            buttons: true,
                        })
                            .then((willDelete) => {

                              if (willDelete) {

                                location.reload();

                              }

                        });

                    }else{
                        swal("Error", objData.msg , "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }

        }
    };  

}, false);



$(document).ready(function() {
    $('.listRolid').select2({
        dropdownParent: $('#modalFormUsuario')
    });
});

$(document).ready(function() {
    $('.listGradoid').select2({
        dropdownParent: $('#modalFormUsuario')
    });
});

window.addEventListener('load', function() {
        fntRolesUsuario();
        fntGradosUsuario();
}, false);

function fntRolesUsuario(){
    if(document.querySelector('#listRolid')){
        let ajaxUrl = base_url+'/Roles/getSelectRoles';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                document.querySelector('#listRolid').innerHTML = request.responseText;
                $('#listRolid').trigger('change');
            }
        }
    }
}

function fntGradosUsuario(){
    if(document.querySelector('#listRolid')){
        let ajaxUrl = base_url+'/Aulas/getSelectAulas';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                document.querySelector('#listGradoid').innerHTML = request.responseText;
                $('#listGradoid').trigger('change');
            }
        }
    }
}


function fntViewUsuario(idpersona){
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Personas/getPersona/'+idpersona;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            let tipoDocumento;
            if(objData.status)
            {
               let estadoUsuario = objData.data.status == 1 ? 
                '<span class="badge bg-primary">Activo</span>' : 
                '<span class="badge bg-danger">Inactivo</span>';

                document.querySelector("#celIdentificacion").innerHTML = objData.data.n_documento;
                document.querySelector("#celNombre").innerHTML = objData.data.nombres;
                document.querySelector("#celApellido").innerHTML = objData.data.apellidos;
                document.querySelector("#celTelefono").innerHTML = objData.data.telefono;
                document.querySelector("#celEmail").innerHTML = objData.data.email;
                document.querySelector("#celTipoUsuario").innerHTML = objData.data.nombre_rol;
                document.querySelector("#celGradoUsuario").innerHTML = objData.data.nombre_grado;
                document.querySelector("#celDireccion").innerHTML = objData.data.direccion;
                document.querySelector("#celFechaRegistro").innerHTML = objData.data.fechaRegistro;             

                $('#modalViewUser').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }
}


function fntEditUsuario(element,idpersona){
    document.querySelector('#titleModal').innerHTML ="Actualizar Usuario";
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

                document.querySelector("#idUsuario").value = objData.data.id_persona;
                document.querySelector("#txtIdentificacion").value = objData.data.n_documento;
                document.querySelector("#txtNombre").value = objData.data.nombres;
                document.querySelector("#txtApellido").value = objData.data.apellidos;
                document.querySelector("#txtTelefono").value = objData.data.telefono;
                document.querySelector("#txtDireccion").value = objData.data.direccion;
                document.querySelector("#txtEmail").value = objData.data.email;
                document.querySelector("#listRolid").value =objData.data.id_rol;
                document.querySelector("#listGradoid").value =objData.data.id_grado;
                
                $('#listRolid').trigger('change');
                $('#listGradoid').trigger('change');

                if(objData.data.estado == 1){
                    document.querySelector("#listStatus").value = 1;
                }else{
                    document.querySelector("#listStatus").value = 2;
                }
            }
        }
    
        $('#modalFormUsuario').modal('show');
    }
}

function fntDelUsuario(idpersona){
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
                        tableUsuarios.api().ajax.reload(null, false);
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
    document.querySelector('#titleModal').innerHTML = "Nuevo Usuario";
    document.querySelector("#formUsuario").reset();
                
    $('#modalFormUsuario').modal('show');
}

function openModalPerfil(){
    $('#modalFormPerfil').modal('show');
}

$('#buscarIdentificacion').click(function(){
    buscarDocumento();
});
