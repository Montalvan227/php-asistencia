<?php 
        headerAdmin($data); 
        getModal('modalAlumnos',$data);
?>  
                <!-- Content -->

                <div class="container-xxl flex-grow-1 container-p-y">
                  <?php if(empty($_SESSION['permisosMod']['r'])){ ?>
                    <p>Acceso Restringido</p>
                  <?php }else{ ?>
                  <h4 class="fw-bold py-3 mb-4">
                    <?php if($_SESSION['permisosMod']['w']){ ?>
                    <?= $data['page_tag'] ?> &nbsp; &nbsp;<button type="button" onclick="openModal();" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalFormUsuario">Nuevo Alumno</button>
                    <?php } ?>
                    <?php //dep($_SESSION['permisosMod']); ?>
                  </h4>
                  <div class="row">

                    <div class="col-lg-12 mb-4 order-0">
                      <div class="card">
                        <div class="d-flex align-items-end row">
                          <div class="card-header border-bottom">
                            <div class="card-body">
                              <table id="tableUsuarios" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Estado</th>
                                        <th>Identificación</th>
                                        <th>Grado</th>
                                        <th>Nombres</th>
                                        <th>Apoderado</th>
                                        <th>Telefono</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
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