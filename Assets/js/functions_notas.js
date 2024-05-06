
var tableRoles;

var divLoading = document.querySelector("#divloading");

document.addEventListener('DOMContentLoaded', function(){
	tableRoles = $('#tableRoles').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
            "url": " "+base_url+"/Assets/js/plugins/datatable/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Notas/getRegistros",
            "dataSrc":""
        },
        "columns":[
            {"data":"nombre_grado"},
            {"data":"nombre_curso"},
            {"data":"options"}
        ],
        "responsive":"true",
        "bDestroy": true,
        "iDisplayLength": 25,
        "order":[[1,"asc"]]  
    });


});



function fntAgregarNotas(idgc){
            
    var idgc = idgc;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Notas/getNotasAlumnos/'+idgc;
    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            document.querySelector('#contentAjax').innerHTML = request.responseText;
            $('.modalNotasAlumnos').modal('show');
            document.querySelector('#formNotasAlumnos').addEventListener('submit',fntSaveNotas,false);
        }
    }

}


function fntSaveNotas(evnet){
    evnet.preventDefault();
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Notas/setNotasAlumnos';
    var formElement = document.querySelector("#formNotasAlumnos");
    var formData = new FormData(formElement);
    request.open("POST",ajaxUrl,true);
    request.send(formData);

    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                $('.modalNotasAlumnos').modal("hide");
                swal("Notas Actualizadas correctamente", objData.msg ,"success");
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }
    
}