<?php 
        headerAdmin($data); 
        getModal('modalCursos',$data);
?>
                <div id="contentAjax"></div>
                <!-- Content -->

                <div class="container-xxl flex-grow-1 container-p-y">
                  <?php if(empty($_SESSION['permisosMod']['r'])){ ?>
                    <p>Acceso Restringido</p>
                  <?php }else{ ?>
                  <h4 class="fw-bold py-3 mb-4">
                    <?php if($_SESSION['permisosMod']['w']){ ?>
                    <?= $data['page_tag'] ?> &nbsp; &nbsp;<button type="button" onclick="openModal();" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalFormCurso">Nuevo Curso</button>
                    <?php } ?>
                    <?php //dep($_SESSION['permisosMod']); ?>
                  </h4>
                  <div class="row">

                    <div class="col-lg-12 mb-4 order-0">
                      <div class="card">
                        <div class="d-flex align-items-end row">
                            <div class="card-body">
                              
                              <table id="tableCursos" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Curso</th>
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