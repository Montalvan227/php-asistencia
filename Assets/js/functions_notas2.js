
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
            "url": " "+base_url+"/Notas/verNotasGenerales",
            "dataSrc":""
        },
        "columns":[
            {"data":"nombre_completo"},
            {"data":"nombre_grado"},
            {"data":"nombre_curso"},
            {"data":"promedio"},
            {"data":"calificacion"}
        ],
        "responsive":"true",
        "bDestroy": true,
        "iDisplayLength": 25,
        "order":[[1,"asc"]]  
    });


});
