<?php 
        headerAdmin($data);
?>  	
                <!-- Content -->
                <div id="contentAjax"></div>

                <div class="container-xxl flex-grow-1 container-p-y">
                  <?php if(empty($_SESSION['permisosMod']['r'])){ ?>
                    <p>Acceso Restringido</p>
                  <?php }else{ ?>
                  <h4 class="fw-bold py-3 mb-4">
                    <a href="<?= base_url(); ?>/dashboard" class="btn btn-primary btn-sm" style="margin-right:50px;"><i class='bx bx-caret-left'></i> Salir</a><?= $data['page_tag'] ?>
                    <?php //dep($_SESSION['permisosMod']); ?>
                  </h4>
                  <div class="row">

                    <div class="col-lg-12 mb-4 order-0">
                      <div class="card">
                        <div class="d-flex align-items-end row">
                          <form id="formAsistencia" name="formAsistencia" class="modal-content" style="padding:0px">
                            <div id="divloading">
                              <div>
                                <img src="<?php echo media(); ?>/img/loading/loading.svg">
                              </div>
                            </div>
                            <div class="input-group">
                              <span class="input-group-text" id="basic-addon13">COD. BARRAS/VOZ</span>
                              <input type="number" class="form-control" placeholder="Escaneé el Codigo de Barras o Dicte su Número de DNI" aria-label="Escaneé el Codigo de Barras o Dicte su Número de DNI" aria-describedby="basic-addon13" id="dni_asistencia" name="dni_asistencia" min="10000000" max="99999999">
                              <img alt="comienzo" class="start_img" id="start_DNI" src="./imagenes/mic.gif">
                            </div>
                            <script type="text/javascript">
                                var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;
                                var SpeechGrammarList = SpeechGrammarList || webkitSpeechGrammarList;
                                var SpeechRecognitionEvent = SpeechRecognitionEvent || webkitSpeechRecognitionEvent;

                                var recognition; // Variable para almacenar la instancia de reconocimiento de voz
                                var inputDNI = document.getElementById("dni_asistencia");
                                var maxNumbers = 8; // Límite máximo de números
                                var minNumbers = 8; // Límite máximo de números

                                document.addEventListener("DOMContentLoaded", function () {
                                    var startImg = document.getElementById("start_DNI");

                                    var digitCounter = 0; // Contador de dígitos

                                    startImg.addEventListener("click", function () {
                                        // Comprueba si el navegador admite el reconocimiento de voz
                                        if (SpeechRecognition) {
                                            recognition = new SpeechRecognition();
                                            recognition.lang = 'es-PE'; // Establece el idioma según tus necesidades
                                            recognition.interimResults = false;
                                            recognition.maxAlternatives = 1;

                                            recognition.onresult = function (event) {
                                                var result = event.results[0][0].transcript;
                                                var numbers = result.match(/\d+/g); // Extrae solo números usando una expresión regular
                                                if (numbers && numbers.length > 0) {
                                                    var concatenatedNumbers = numbers.join(""); // Combina los números sin espacios
                                                    var numDigits = concatenatedNumbers.length;
                                                    if (numDigits > 0) {
                                                        // Actualiza el campo de entrada con los números
                                                        inputDNI.value = concatenatedNumbers;

                                                        // Actualiza el contador de dígitos
                                                        digitCounter = numDigits;

                                                        // Si se alcanza el límite máximo de 8 dígitos, simula la pulsación de 'Enter'
                                                        if (digitCounter === maxNumbers) {
                                                            var enterEvent = new KeyboardEvent("keydown", { key: "Enter" });
                                                            inputDNI.dispatchEvent(enterEvent);
                                                        }
                                                    }
                                                }
                                            };

                                            recognition.onend = function () {
                                                recognition.stop();
                                                startImg.src = './imagenes/mic.gif'; // Restaura la imagen del micrófono
                                            };

                                            recognition.start();
                                            startImg.src = './imagenes/mic-animate.gif'; // Cambia la imagen del micrófono para indicar que está escuchando
                                        } else {
                                            alert("Tu navegador no admite el reconocimiento de voz.");
                                        }
                                    });

                                    // Agregar un evento de entrada para actualizar el contador de dígitos
                                    inputDNI.addEventListener("input", function () {
                                        digitCounter = inputDNI.value.length;

                                        // Si se alcanza el límite máximo de 8 dígitos, simula la pulsación de 'Enter'
                                        if (digitCounter === maxNumbers) {
                                            var enterEvent = new KeyboardEvent("keydown", { key: "Enter" });
                                            inputDNI.dispatchEvent(enterEvent);
                                        }
                                    });
                                });
                            </script>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-12 mb-4 order-0">
                      <div class="card">
                        <div class="d-flex align-items-end row">
                          <div class="card-header border-bottom">
                            <div class="card-body">
                              <div id="info-asistencia-unica" style="display:none;">
                                <div class="bg-primary" style="border-radius:15px;padding:10px;margin:10px 0 20px 0;color:#fff;font-size:1.4rem;text-align:center;display:none;" id="corecta-asistencia">Asistencia Correcta</div>
                                <div class="bg-warning" style="border-radius:15px;padding:10px;margin:10px 0 20px 0;color:#fff;font-size:1.4rem;text-align:center;;display:none" id="correcta-asistencia-tardanza">Tardanza Registrada</div>
                                <div class="bg-danger" style="border-radius:15px;padding:10px;margin:10px 0 20px 0;color:#fff;font-size:1.4rem;text-align:center;;display:none" id="correcta-asistencia-falta">Falta Registrada</div>
                                <div class="bg-danger" style="border-radius:15px;padding:10px;margin:10px 0 20px 0;color:#fff;font-size:1.4rem;text-align:center;;display:none" id="incorecta-asistencia">Asistencia Incorrecta</div>
                                <div id="datos-asistencia">
                                  <h4 class="tasis">Nombre: <span id="nombre-asistencia"></span></h4>
                                  <h4 class="tasis">Apellido: <span id="apellido-asistencia"></span></h4>
                                  <h4 class="tasis">Grado: <span id="grado-asistencia"></span></h4>
                                  <h4 class="tasis">Fecha y Hora de Asistencia: <span id="fecha-asistencia"></span></h4>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                  </div>
                  <style type="text/css">
                    .tasis{
                      color: rgba(80, 80, 80, 1);
                      font-size: 1.5rem;
                    }
                    .tasis span{
                      color: rgba(0, 0, 0, 1);
                      font-size: 1.4rem;
                    }
                  </style>
                

                <!-- / Content -->

<?php footerAdmin($data); ?>