<?php
  headerAdmin($data);
  $arrAsistencias = $data['asistenciasXgrado'];
?>

            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-7">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Bienvenido <?php echo $_SESSION['userData']['nombres']. ' ' . $_SESSION['userData']['apellidos']; ?> 🎉</h5>
                          <p class="mb-4">
                          </p>
                        </div>
                      </div>
                      <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="<?php echo media(); ?>/img/illustrations/man-with-laptop-light.png"
                            height="140"
                            alt="View Badge User"
                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php if($_SESSION['permisosMod']['w']){ ?>
                <div class="col-lg-12 col-md-4 order-1">
                  <div class="row">
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="<?php echo media(); ?>/img/icons/unicons/chart-success.png"
                                alt="chart success"
                                class="rounded"
                              />
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1">Asistencias</span>
                          <h3 class="card-title mb-2"><?= $data['asistencia-hoy'][0]['total']; ?></h3>
                          <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i><?= date('Y-m-d'); ?></small>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="<?php echo media(); ?>/img/icons/unicons/wallet-info.png"
                                alt="Credit Card"
                                class="rounded"
                              />
                            </div>
                          </div>
                          <span>Total Alumnos</span>
                          <h3 class="card-title text-nowrap mb-1"><?= $data['total-alumnos'][0]['total']; ?></h3>
                          <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i></small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Añadir JavaScript después del bucle foreach -->
     
                <?php
                }
                ?>
              </div>
            </div>
            <!-- / Content -->
                <!--/ Alumnos Puntuales hoy -->

                <!-- Order Statistics -->
                <?php /*
                  if(count($data['totales-asistencias']) > 0){
                    $porct1 = number_format(intval($data['totales-asistencias'][0]['asistencias'])*100/intval($data['totales-asistencias'][0]['faltas']),0);
                    $porct2 = number_format(intval($data['totales-asistencias'][0]['tardanzas'])*100/intval($data['totales-asistencias'][0]['faltas']),0);
                    $porct3 = number_format((intval($data['totales-asistencias'][0]['faltas']) - intval($data['totales-asistencias'][0]['tardanzas']) - intval($data['totales-asistencias'][0]['asistencias']))*100/intval($data['totales-asistencias'][0]['faltas']),0);
                 ?>
                <div style="margin: 0 auto; width: 400px;" class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                      <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Asistencia Total</h5>
                        <small class="text-muted"><?= intval($data['totales-asistencias'][0]['tardanzas']) + intval($data['totales-asistencias'][0]['asistencias']); ?></small>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex flex-column align-items-center gap-1">
                          <h2 class="mb-2"><?= intval($data['totales-asistencias'][0]['faltas']) ?></h2>
                          <span>Alumnos Registrados</span>
                        </div>
                        <div id="estadisticasChart" data-atributo1="<?= $porct1; ?>" data-atributo2="<?= $porct2; ?>" data-atributo3="<?= $porct3; ?>"></div>
                      </div>
                      <ul class="p-0 m-0">
                        <li class="d-flex mb-4 pb-1">
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0">Asistencias</h6>
                            </div>
                            <div class="user-progress">
                              <small class="fw-semibold"><?= $data['totales-asistencias'][0]['asistencias']; ?></small>
                            </div>
                          </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0">Tardanzas</h6>
                            </div>
                            <div class="user-progress">
                              <small class="fw-semibold"><?= $data['totales-asistencias'][0]['tardanzas']; ?></small>
                            </div>
                          </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0">Faltas</h6>
                            </div>
                            <div class="user-progress">
                              <small class="fw-semibold"><?= intval($data['totales-asistencias'][0]['faltas']) - intval($data['totales-asistencias'][0]['tardanzas']) - intval($data['totales-asistencias'][0]['asistencias']); ?></small>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <?php 
                  }*/
                 ?>
                 <div class="container">
                 <div class="row">
                 <?php 
                 foreach ($arrAsistencias as $grados => $grado) {
                    $total = $grado['puntuales'] + $grado['tardanza'] + $grado['tardanza_justificada'] + $grado['falta'] + $grado['falta_justificada'];
                 ?>
                <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-center pb-0">
                      <div class="card-title mb-0">
                        <h5 class="m-0 me-2"><?= $grado['nombre_grado']; ?></h5>
                        <small class="text-muted"></small>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="d-flex justify-content-center align-items-center mb-3">
                        <div class="d-flex flex-column align-items-center gap-1">
                          <h2 class="mb-2"><?= $total; ?></h2>
                          <span>Alumnos Registrados</span>
                        </div>
                      </div>
                      <ul class="p-0 m-0">
                        <li class="d-flex mb-4 pb-1">
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0">Asistencias <span class="fw-semibold pl-5">(<?= $grado['puntuales']; ?>)</span></h6>
                            </div>
                            <div class="user-progress">
                              <p class="data-attributes">
                                <span data-peity='{ "fill": ["green", "#eeeeee"], "innerRadius": 10, "radius": 20 }'><?= $grado['puntuales']; ?>/<?= $total; ?></span>
                              </p>
                            </div>
                          </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0">Tardanzas <span class="fw-semibold pl-5">(<?= $grado['tardanza']; ?>)</span></h6>
                            </div>
                            <div class="user-progress">
                              <p class="data-attributes">
                                <span data-peity='{ "fill": ["yellow", "#eeeeee"], "innerRadius": 10, "radius": 20 }'><?= $grado['tardanza']; ?>/<?= $total; ?></span>
                              </p>
                            </div>
                          </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0">Faltas <span class="fw-semibold pl-5">(<?= $grado['tardanza_justificada']; ?>)</span></h6>
                            </div>
                            <div class="user-progress">
                              <p class="data-attributes">
                                <span data-peity='{ "fill": ["red", "#eeeeee"], "innerRadius": 10, "radius": 20 }'><?= $grado['tardanza_justificada']; ?>/<?= $total; ?></span>
                              </p>
                            </div>
                          </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0">Tardanzas Just. <span class="fw-semibold pl-5">(<?= $grado['falta']; ?>)</span></h6>
                            </div>
                            <div class="user-progress">
                              <p class="data-attributes">
                                <span data-peity='{ "fill": ["orange", "#eeeeee"], "innerRadius": 10, "radius": 20 }'><?= $grado['falta']; ?>/<?= $total; ?></span>
                              </p>
                            </div>
                          </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0">Faltas Just. <span class="fw-semibold pl-5">(<?= $grado['falta_justificada']; ?>)</span></h6>
                            </div>
                            <div class="user-progress">
                              <p class="data-attributes">
                                <span data-peity='{ "fill": ["Maroon", "#eeeeee"], "innerRadius": 10, "radius": 20 }'><?= $grado['falta_justificada']; ?>/<?= $total; ?></span>
                              </p>
                            </div>
                          </div>
                        </li>

                        <?php
                        // Obtener valores dinámicos
                        $totalAsistencias = $grado['puntuales'];
                        $totalTardanzas = $grado['tardanza'];
                        $totalFaltas = $grado['tardanza_justificada'];
                        $totalTardanzasJustificadas = $grado['falta'];
                        $totalFaltasJustificadas = $grado['falta_justificada'];
                        $total = $totalAsistencias + $totalTardanzas + $totalFaltas + $totalTardanzasJustificadas + $totalFaltasJustificadas;
                        $colors = ["green", "yellow", "red", "orange", "maroon"];
                        ?>

                        <script>
                        document.addEventListener("DOMContentLoaded", function() {
                          const combinedChart = document.getElementById("combined-chart");
                          const totalAsistencias = <?php echo $totalAsistencias; ?>;
                          const totalTardanzas = <?php echo $totalTardanzas; ?>;
                          const totalFaltas = <?php echo $totalFaltas; ?>;
                          const totalTardanzasJustificadas = <?php echo $totalTardanzasJustificadas; ?>;
                          const totalFaltasJustificadas = <?php echo $totalFaltasJustificadas; ?>;
                          const total = <?php echo $total; ?>;
                          const colors = <?php echo json_encode($colors); ?>;
                          
                          // Calcular los valores combinados
                          const combinedValues = [
                            totalAsistencias,
                            totalTardanzas,
                            totalFaltas,
                            totalTardanzasJustificadas,
                            totalFaltasJustificadas
                          ];
                          
                          // Crear el gráfico circular
                          new Chart(combinedChart, {
                            type: "doughnut",
                            data: {
                              labels: ["Asistencias", "Tardanzas", "Faltas", "Tardanzas Justificadas", "Faltas Justificadas"],
                              datasets: [{
                                data: combinedValues,
                                backgroundColor: colors
                              }]
                            },
                            options: {
                              responsive: false
                            }
                          });
                        });
                        </script>
                      </ul>
                    </div>
                  </div>
                </div>
                <?php 
                  }

                
                 ?>

                </div>
                </div>


                <?php

                /*

                foreach ($arrAsistencias as $grados => $grado) {
                
                ?>
                <div class="row">
                  <div class="col-md-1"></div>
                  <div class="col-md-10 mb-4">
                    <div class="card">
                      <div class="card-title" style="margin:0px;">
                        <h6 style="text-align: center;line-height:50px;margin:0px;"><?= $grado['nombre_grado']; ?></h6>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-1"></div>
                  <div class="col-lg-1 col-md-0"></div>
                  <div class="col-lg-2 col-md-4 col-2 mb-4 ml-2 mr-2">
                    <div class="card">
                      <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                          <div class="avatar flex-shrink-0">
                            <img
                              src="assets/img/icons/unicons/chart-success.png"
                              alt="chart success"
                              class="rounded"
                            />
                          </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Asistencias Puntuales</span>
                        <h3 class="card-title mb-2"><?= $grado['puntuales']; ?></h3>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-4 col-2 mb-4 ml-2 mr-2">
                    <div class="card">
                      <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                          <div class="avatar flex-shrink-0">
                            <img
                              src="assets/img/icons/unicons/chart-success.png"
                              alt="chart success"
                              class="rounded"
                            />
                          </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Tardanzas</span>
                        <h3 class="card-title mb-2"><?= $grado['tardanza']; ?></h3>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-4 col-2 mb-4 ml-2 mr-2">
                    <div class="card">
                      <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                          <div class="avatar flex-shrink-0">
                            <img
                              src="assets/img/icons/unicons/chart-success.png"
                              alt="chart success"
                              class="rounded"
                            />
                          </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Tardanzas Justificadas</span>
                        <h3 class="card-title mb-2"><?= $grado['tardanza_justificada']; ?></h3>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-4 col-2 mb-4 ml-2 mr-2">
                    <div class="card">
                      <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                          <div class="avatar flex-shrink-0">
                            <img
                              src="assets/img/icons/unicons/chart-success.png"
                              alt="chart success"
                              class="rounded"
                            />
                          </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Faltas Justificadas</span>
                        <h3 class="card-title mb-2"><?= $grado['falta_justificada']; ?></h3>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-4 col-2 mb-4 ml-2 mr-2">
                    <div class="card">
                      <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                          <div class="avatar flex-shrink-0">
                            <img
                              src="assets/img/icons/unicons/chart-success.png"
                              alt="chart success"
                              class="rounded"
                            />
                          </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Faltas</span>
                        <h3 class="card-title mb-2"><?= $grado['falta']; ?></h3>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-1 col-md-0"></div>
                </div>

              <?php }*/ ?>



            <!-- / Content -->

            <script type="text/javascript">
            </script>

<?php footerAdmin($data); ?>