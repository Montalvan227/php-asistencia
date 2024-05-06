
var tableCursos;

var divLoading = document.querySelector("#divloading");

document.addEventListener('DOMContentLoaded', function(){
    tableCursos = $('#tableCursos').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": " "+base_url+"/Assets/js/plugins/datatable/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Cursos/getCursos",
            "dataSrc":""
        },
        "columns":[
            {"data":"id_curso"},
            {"data":"nombre_curso"},
            {"data":"estado"},
            {"data":"options"}
        ],
        "responsive":"true",
        "bDestroy": true,
        "iDisplayLength": 25,
        "order":[[1,"asc"]]  
    });

    var formCurso = document.querySelector("#formCurso");

    formCurso.onsubmit = function(e){
        e.preventDefault();

        var intIdCurso = document.querySelector('#idCurso').value;
        var strNombre = document.querySelector('#txtNombre').value;
        var intStatus = document.querySelector('#listStatus').value;
        if(strNombre == '' || intStatus == '')
        {
            swal("Atención", "Todos los campos son obligatorios." , "error");
            return false;
        }
        divLoading.style.display = "flex";
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Cursos/setCurso';
        var formData = new FormData(formCurso);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
            
            if(request.readyState == 4 && request.status == 200){
                
                var objData = JSON.parse(request.responseText);
                if(objData.status)
                {
                    $('#modalFormCurso').modal("hide");
                    formCurso.reset();
                    swal("Curso", objData.msg ,"success");
                    tableCursos.api().ajax.reload(null, false);
                }else{
                    swal("Error", objData.msg , "error");
                }
            }
            
            divLoading.style.display = "none";
            return false;
    
        }

    }

});

function openModal(){

    document.querySelector('#idCurso').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Curso";
    document.querySelector("#formCurso").reset();
    $('#modalFormCurso').modal('show');
    
}

function fntEditCurso(idcurso){

    document.querySelector('#titleModal').innerHTML ="Actualizar Curso";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";

    var idcurso = idcurso;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl  = base_url+'/Cursos/getCurso/'+idcurso;
    request.open("GET",ajaxUrl ,true);
    request.send();

    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);

            if(objData.status)
            {
                document.querySelector("#idCurso").value = objData.data.id_curso;
                document.querySelector("#txtNombre").value = objData.data.nombre_curso;

                if(objData.data.estado == 1)
                {
                    var optionSelect = '<option value="1" selected class="notBlock">Activo</option>';
                }else{
                    var optionSelect = '<option value="2" selected class="notBlock">Inactivo</option>';
                }
                var htmlSelect = `${optionSelect}
                                  <option value="1">Activo</option>
                                  <option value="2">Inactivo</option>
                                `;
                document.querySelector("#listStatus").innerHTML = htmlSelect;
                $('#modalFormCurso').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }

        }
    }
}

function fntDelCurso(idcurso){
            
    var idcurso = idcurso;
    
    swal({
      title: "Eliminar Curso",
      text: "¿Realmente quiere eliminar el Curso?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {

      if (willDelete) {

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Cursos/delCurso/';
        var strData = "idCurso="+idcurso;
        request.open("POST",ajaxUrl,true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send(strData);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var objData = JSON.parse(request.responseText);
                if(objData.status)
                {
                    swal("¡Eliminar!", objData.msg , "success");
                    tableCursos.api().ajax.reload(null, false);
                }else{
                    swal("¡Atención!", objData.msg , "error");
                }
            }
        }

      }

    });

}

function fntCursosGrados(idcurso){
            
    var idcurso = idcurso;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Cursos/getCursosGrado/'+idcurso;
    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            document.querySelector('#contentAjax').innerHTML = request.responseText;
            $('.listDocenteId').select2({
                dropdownParent: $('#modalCursosGrado')
            });
            fntCursosDocente();
            $('.modalCursosGrado').modal('show');
            document.querySelector('#formCursosGrado').addEventListener('submit',fntSaveCursosGrado,false);
        }
    }

}


function fntSaveCursosGrado(evnet){
    evnet.preventDefault();
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Cursos/setCursosGrado';
    var formElement = document.querySelector("#formCursosGrado");
    var formData = new FormData(formElement);
    request.open("POST",ajaxUrl,true);
    request.send(formData);

    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                $('#modalCursosGrado').modal("hide");
                swal("Docente y Grado", objData.msg ,"success");
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }
    
}


function fntCursosDocente(){
    // Obtén todos los elementos con la clase 'selectGradosUsuario'
    let selects = document.querySelectorAll('.selectGradosUsuario');
    
    // Verifica si hay algún elemento con la clase 'selectGradosUsuario'
    if(selects.length > 0){
        let ajaxUrl = base_url+'/Cursos/getSelectDocentesCursos';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET", ajaxUrl, true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                // Itera a través de todos los selects y carga la información en cada uno de ellos
                selects.forEach(function(select) {
                    select.innerHTML += request.responseText;
                    $('.listDocenteId').trigger('change');
                    // Puedes activar un evento 'change' si es necesario
                    // select.dispatchEvent(new Event('change'));
                });
            }
        }
    }
}