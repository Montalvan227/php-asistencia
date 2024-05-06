
function controlTag(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; 
    else if (tecla==0||tecla==9)  return true;
    patron =/[0-9\s]/;
    n = String.fromCharCode(tecla);
    return patron.test(n); 
}

function testText(txtString){
    var stringText = new RegExp(/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/);
    if(stringText.test(txtString)){
        return true;
    }else{
        return false;
    }
}

function testEntero(intCant){
    var intCantidad = new RegExp(/^([0-9])*$/);
    if(intCantidad.test(intCant)){
        return true;
    }else{
        return false;
    }
}

/*VALIDAR UN DECIMAL*/
function validateDecimal(valor) {
    var RE = /^\d*\.?\d*$/;
    if (RE.test(valor)) {
        return true;
    } else {
        return false;
    }
}

/*VALIDAR UN DECIMAL CON DOS DIGITOS*/
function validateDecimal2(valor) {
    var RE = /^\d*(\.\d{1})?\d{0,1}$/;
    if (RE.test(valor)) {
        return true;
    } else {
        return false;
    }
}

function fntEmailValidate(email){
    var stringEmail = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})$/);
    if (stringEmail.test(email) == false){
        return false;
    }else{
        return true;
    }
}

function fntGenerarCodigo(){
    var cod = new Date().getTime();
    return cod;
}



function fntValidText(){
	let validText = document.querySelectorAll(".validText");
    validText.forEach(function(validText) {
        validText.addEventListener('keyup', function(){
			let inputValue = this.value;
			if(!testText(inputValue)){
				this.classList.add('is-invalid');
			}else{
				this.classList.remove('is-invalid');
			}				
		});
	});
}

function fntValidNumber(){
	let validNumber = document.querySelectorAll(".validNumber");
    validNumber.forEach(function(validNumber) {
        validNumber.addEventListener('keyup', function(){
			let inputValue = this.value;
			if(!testEntero(inputValue)){
				this.classList.add('is-invalid');
			}else{
				this.classList.remove('is-invalid');
			}				
		});
	});
}

function fntValidEmail(){
	let validEmail = document.querySelectorAll(".validEmail");
    validEmail.forEach(function(validEmail) {
        validEmail.addEventListener('keyup', function(){
			let inputValue = this.value;
			if(!fntEmailValidate(inputValue)){
				this.classList.add('is-invalid');
			}else{
				this.classList.remove('is-invalid');
			}				
		});
	});
}


// Obtiene todos los elementos input con la clase "inputNumerico"
var inputsNumericos = document.querySelectorAll(".inputNumerico");

// Función para validar y limitar la entrada numérica
function validarInputNumerico(input) {
    input.addEventListener("input", function() {
        // Reemplaza cualquier caracter que no sea un número por una cadena vacía
        this.value = this.value.replace(/\D/g, "");

        // Limita la longitud del campo al valor máximo (en este caso, 10 caracteres)
        var maxLength = parseInt(this.getAttribute("maxlength"));
        if (this.value.length > maxLength) {
            this.value = this.value.slice(0, maxLength);
        }
    });
}

// Aplica la función a todos los campos de entrada con la clase "inputNumerico"
inputsNumericos.forEach(function(input) {
    validarInputNumerico(input);
});


// Obtiene todos los elementos input con la clase "inputTexto"
var inputsTexto = document.querySelectorAll(".inputTexto");

// Función para validar y limitar la entrada de texto
function validarInputTexto(input) {
    input.addEventListener("input", function() {
        // Reemplaza cualquier caracter que no sea una letra por una cadena vacía
        this.value = this.value.replace(/[^a-zA-Z]/g, "");

        // Limita la longitud del campo al valor máximo (en este caso, 20 caracteres)
        var maxLength = parseInt(this.getAttribute("maxlength"));
        if (this.value.length > maxLength) {
            this.value = this.value.slice(0, maxLength);
        }
    });
}


// Obtiene todos los elementos con la clase "inputAlfanumerico"
var inputsAlfanumericos = document.querySelectorAll(".inputAlfanumerico");

// Agrega un evento de entrada a todos los elementos con la clase "inputAlfanumerico"
inputsAlfanumericos.forEach(function(input) {
    input.addEventListener("input", function() {
        // Reemplaza caracteres que no sean letras ni números por una cadena vacía
        this.value = this.value.replace(/[^a-zA-Z0-9]/g, "");

        // Limita la longitud del campo al valor máximo especificado (en este caso, 10 caracteres)
        var maxLength = parseInt(this.getAttribute("maxlength"));
        if (this.value.length > maxLength) {
            this.value = this.value.slice(0, maxLength);
        }
    });
});
// Aplica la función a todos los campos de entrada con la clase "inputTexto"
inputsTexto.forEach(function(input) {
    validarInputTexto(input);
});

if (document.getElementById("listTDocumento")) {

    // Obtiene el select y los divs por su ID
    var select = document.getElementById("listTDocumento");
    var divOpcion1 = document.getElementById("txtIdentificacion");

    // Agrega un evento de cambio al select
    select.addEventListener("change", function() {
        // Obtiene el valor seleccionado
        var seleccion = select.value;

        // Cambia el valor de maxLength a 20
        divOpcion1.value = "";
        divOpcion1.maxLength = 8;


        // Muestra el div correspondiente según la opción seleccionada
        if (seleccion === "1") {
            divOpcion1.maxLength = 8;
        } else if (seleccion === "2") {
            divOpcion1.maxLength = 11;
        }
    });
}



//NUSCAR POR DNI Y RUC
function buscarDocumento(){
    let tDocumento = document.querySelector('#listTDocumento').value;
    let nDocumento = document.querySelector('#txtIdentificacion').value;
    if (tDocumento == "1") {
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url+'/Personas/buscarPorDni';
        let strData = "nDocumento="+nDocumento;
        request.open("POST",ajaxUrl,true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send(strData);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                let objData = JSON.parse(request.responseText);
                if(objData.status)
                {
                    if (objData.data.error) {
                        swal("Error", objData.data.error , "error");
                    } else {
                        document.querySelector("#txtNombre").value = objData.data.nombres;
                        document.querySelector("#txtApellido").value = objData.data.apellidoPaterno + ' ' + objData.data.apellidoMaterno;
                        document.querySelector("#txtDireccion").value = '';
                        document.querySelector("#txtNombreCompleto").value = objData.data.nombres + ' ' + objData.data.apellidoPaterno + ' ' + objData.data.apellidoMaterno;
                    }

                    
                }else{
                    swal("Error", objData.msg , "error");
                }
            }
        }    
    }else if (tDocumento == "4") {
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url+'/Personas/buscarPorRuc';
        let strData = "nDocumento="+nDocumento;
        request.open("POST",ajaxUrl,true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send(strData);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){

                let objData = JSON.parse(request.responseText);
                if(objData.status)
                {
                    if (objData.data.error) {
                        swal("Error", objData.data.error , "error");
                    } else {
                    
                        document.querySelector("#txtNombre").value = '';
                        document.querySelector("#txtApellido").value = '';
                        document.querySelector("#txtDireccion").value = objData.data.direccion;
                        document.querySelector("#txtNombreCompleto").value = objData.data.nombre;

                    }

                }else{
                    swal("Error", objData.msg , "error");
                }

            }
        }    
    }else{
        swal("Atención", "Solo se Busca Por DNI y RUC" , "warning");
    }
}



window.addEventListener('load', function() {
	fntValidText();
	fntValidEmail(); 
	fntValidNumber();
}, false);
