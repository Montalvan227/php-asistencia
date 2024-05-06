
var divLoading = document.querySelector("#divloading");

document.addEventListener('DOMContentLoaded', function(){

    var formRol = document.querySelector("#formAsistencia");

    formRol.onsubmit = function(e){
        e.preventDefault();

        var nDocuemnto = document.querySelector('#dni_asistencia').value;
        if(nDocuemnto == '')
        {
            swal("Atención", "Campo Obligatorio." , "error");
            return false;
        }
        divLoading.style.display = "flex";
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl  = base_url+'/Asistencias/setAsistencia';
        var formData = new FormData(formRol);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
            
            if(request.readyState == 4 && request.status == 200){
                
                var objData = JSON.parse(request.responseText);
                if(objData.status)
                {
                    document.querySelector("#info-asistencia-unica").style.display = 'block';
                    document.querySelector("#dni_asistencia").value = '';
                    document.querySelector("#incorecta-asistencia").style.display = 'none';
                    document.querySelector("#datos-asistencia").style.display = 'block';   
                    document.querySelector("#nombre-asistencia").innerHTML = objData.msg.nombres;
                    document.querySelector("#apellido-asistencia").innerHTML = objData.msg.apellidos;
                    document.querySelector("#grado-asistencia").innerHTML = objData.msg.nombre_grado;
                    document.querySelector("#fecha-asistencia").innerHTML = objData.msg.fecha_asistencia;
                    if (objData.msg.t_asistencia == "1") {
                        document.querySelector("#corecta-asistencia").style.display = 'block';                 
                        document.querySelector("#correcta-asistencia-tardanza").style.display = 'none';                
                    }else{
                        document.querySelector("#corecta-asistencia").style.display = 'none';                 
                        document.querySelector("#correcta-asistencia-tardanza").style.display = 'block';                
                    }

                }else{
                    document.querySelector("#info-asistencia-unica").style.display = 'block';
                    document.querySelector("#dni_asistencia").value = '';
                    document.querySelector("#corecta-asistencia").style.display = 'none';         
                    document.querySelector("#correcta-asistencia-tardanza").style.display = 'none';
                    document.querySelector("#incorecta-asistencia").style.display = 'block';
                    document.querySelector("#datos-asistencia").style.display = 'none';
                    document.querySelector("#nombre-asistencia").innerHTML = "";
                    document.querySelector("#apellido-asistencia").innerHTML = "";
                    document.querySelector("#grado-asistencia").innerHTML = "";
                    document.querySelector("#fecha-asistencia").innerHTML = "";
                    swal("Advertencia", objData.msg , "warning");
                }
            }
            
            divLoading.style.display = "none";
            return false;
    
        }

    }

});