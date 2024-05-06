
var tableGrados;

var divLoading = document.querySelector("#divloading");

document.addEventListener('DOMContentLoaded', function(){
	tableGrados = $('#tableGrados').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
            "url": " "+base_url+"/Assets/js/plugins/datatable/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Aulas/getAulas",
            "dataSrc":""
        },
        "columns":[
            {"data":"id_grado"},
            {"data":"nombre_grado"},
            {"data":"estado"},
            {"data":"options"}
        ],
        "responsive":"true",
        "bDestroy": true,
        "iDisplayLength": 25,
        "order":[[1,"asc"]]  
    });

    var formAula = document.querySelector("#formAula");

    formAula.onsubmit = function(e){
        e.preventDefault();

        var intIdGrado = document.querySelector('#idGrado').value;
        var strNombre = document.querySelector('#txtNombre').value;
        var intStatus = document.querySelector('#listStatus').value;
        if(strNombre == '' || intStatus == '')
        {
            swal("Atención", "Todos los campos son obligatorios." , "error");
            return false;
        }
        divLoading.style.display = "flex";
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Aulas/setAula';
        var formData = new FormData(formAula);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
            
            if(request.readyState == 4 && request.status == 200){
                
                var objData = JSON.parse(request.responseText);
                if(objData.status)
                {
                    $('#modalFormAula').modal("hide");
                    formAula.reset();
                    swal("Grados / Aulas", objData.msg ,"success");
                    tableGrados.api().ajax.reload(null, false);
                }else{
                    swal("Error", objData.msg , "error");
                }
            }
            
            divLoading.style.display = "none";
            return false;
    
        }

    }

});





/*$('#tableGrados').DataTable({
	responsive: true
});*/


function openModal(){

    document.querySelector('#idGrado').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nueva Aula";
    document.querySelector("#formAula").reset();
    $('#modalFormAula').modal('show');
    
}

function fntEditAula(idgrado){

    document.querySelector('#titleModal').innerHTML ="Actualizar Aula";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";

    var idgrado = idgrado;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl  = base_url+'/Aulas/getAula/'+idgrado;
    request.open("GET",ajaxUrl ,true);
    request.send();

    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);

            if(objData.status)
            {
                document.querySelector("#idGrado").value = objData.data.id_grado;
                document.querySelector("#txtNombre").value = objData.data.nombre_grado;

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
                $('#modalFormAula').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }

        }
    }
}

function fntDelAula(idgrado){
            
    var idgrado = idgrado;
    
    swal({
      title: "Eliminar Grado",
      text: "¿Realmente quiere eliminar el Grado?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {

      if (willDelete) {

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Aulas/delAula/';
        var strData = "idGrado="+idgrado;
        request.open("POST",ajaxUrl,true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send(strData);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var objData = JSON.parse(request.responseText);
                if(objData.status)
                {
                    swal("¡Eliminar!", objData.msg , "success");
                    tableGrados.api().ajax.reload(null, false);
                }else{
                    swal("¡Atención!", objData.msg , "error");
                }
            }
        }

      }

    });

}