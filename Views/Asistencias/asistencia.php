<?php 
        headerAdmin($data);
?>
                <div id="contentAjax"></div>
                <!-- Content -->

                <div class="container-xxl flex-grow-1 container-p-y">
                  <?php if(empty($_SESSION['permisosMod']['r'])){ ?>
                    <p>Acceso Restringido</p>
                  <?php }else{ ?>
                  <h4 class="fw-bold py-3 mb-4">
                    <?= $data['page_tag'] ?>
                    <?php //dep($_SESSION['permisosMod']); ?>
                  </h4>
                  <div class="row">

                    <div class="col-lg-12 mb-4 order-0">
                      <div class="card">
                        <div class="d-flex align-items-end row">
                            <div class="card-body">
                              <table id="tableRoles" class="table table-striped table-bordered" style="width:100%!important">
                                <thead style="width:100%!important">
                                    <tr style="width:100%!important">
                                        <th>Alumno</th>
                                        <th>Grado</th>
                                        <th>Día</th>
                                        <th>Hora Marcación</th>
                                        <th>Estado</th>
                                        <?php if (!empty($_SESSION['permisosMod']['w'])) { ?>
                                        <th>Acciones</th>
                                        <?php } else { ?>
                                        <th>-</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody style="width:100%!important">
                                </tbody>
                              </table>

                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php } ?>
                </div>
                

                <!-- / Content -->

<?php footerAdmin($data); ?>