<?php 
        headerAdmin($data); 
        getModal('modalPerfil',$data);
?>  

        <!-- Content -->
        
          <div class="container-xxl flex-grow-1 container-p-y">
            
            
            <h4 class="fw-bold py-3 mb-4">
              <span class="text-muted fw-light">User / View /</span> Account
            </h4>
            <div class="row">
              <!-- User Sidebar -->
              <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                <!-- User Card -->
                <div class="card mb-4">
                  <div class="card-body">
                    <div class="user-avatar-section">
                      <div class=" d-flex align-items-center flex-column">
                        <img class="img-fluid rounded my-4" src="<?= media(); ?>/img/avatars/1.png" height="110" width="110" alt="User avatar" />
                        <div class="user-info text-center">
                          <h4 class="mb-2"><?= $_SESSION['userData']['nombres'] ?></h4>
                          <span class="badge bg-label-secondary"><?= $_SESSION['userData']['nombrerol'] ?></span>
                        </div>
                      </div>
                    </div>
                    <div class="d-flex justify-content-around flex-wrap my-4 py-3">
                      <div class="d-flex align-items-start me-4 mt-3 gap-3">
                        <span class="badge bg-label-primary p-2 rounded"><i class='bx bx-check bx-sm'></i></span>
                        <div>
                          <h5 class="mb-0">1.23k</h5>
                          <span>Tasks Done</span>
                        </div>
                      </div>
                      <div class="d-flex align-items-start mt-3 gap-3">
                        <span class="badge bg-label-primary p-2 rounded"><i class='bx bx-customize bx-sm'></i></span>
                        <div>
                          <h5 class="mb-0">568</h5>
                          <span>Projects Done</span>
                        </div>
                      </div>
                    </div>
                    <h5 class="pb-2 border-bottom mb-4">Details</h5>
                    <div class="info-container">
                      <ul class="list-unstyled">
                        <li class="mb-3">
                          <span class="fw-bold me-2">Nombres y Apellidos:</span>
                          <span><?= $_SESSION['userData']['nombres'] . ' ' . $_SESSION['userData']['apellidos'] ?></span>
                        </li>
                        <li class="mb-3">
                          <span class="fw-bold me-2">Email:</span>
                          <span><?= $_SESSION['userData']['email_user'] ?></span>
                        </li>
                        <li class="mb-3">
                          <span class="fw-bold me-2">Estado:</span>
                          <?php
                            if ($_SESSION['userData']['status'] == "1") {
                              echo '<span class="badge bg-label-success">ACTIVO</span>';
                            }else if($_SESSION['userData']['status'] == "2") {
                              echo '<span class="badge bg-label-success">ACTIVO</span>';
                            } else {
                              echo '<span class="badge bg-label-success">ERROR DE DATOS</span>';
                            }
                            
                          ?>
                        </li>
                        <li class="mb-3">
                          <span class="fw-bold me-2">Rol:</span>
                          <span><?= $_SESSION['userData']['nombrerol'] ?></span>
                        </li>
                        <li class="mb-3">
                          <span class="fw-bold me-2">Telefono:</span>
                          <span><?= $_SESSION['userData']['telefono'] ?></span>
                        </li>
                        <li class="mb-3">
                          <span class="fw-bold me-2">Dirección:</span>
                          <span><?= $_SESSION['userData']['direccion'] ?></span>
                        </li>
                      </ul>
                      <div class="d-flex justify-content-center pt-3">
                        <a href="javascript:;" class="btn btn-primary me-3" data-bs-target="#modalFormPerfil" data-bs-toggle="modal" onclick="openModalPerfil();">Editar</a>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /User Card -->
              </div>
              <!--/ User Sidebar -->


              <!-- User Content -->
              <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                <!-- User Pills -->
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                  <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i>Cuenta</a></li>
                </ul>
                <!--/ User Pills -->

                <!-- Change Password -->
                <div class="card mb-4">
                  <h5 class="card-header">Cambiar Contraseña</h5>
                  <div class="card-body">
                    <div id="divloading">
                      <div>
                        <img src="<?php echo media(); ?>/img/loading/loading.svg">
                      </div>
                    </div>
                    <form id="formChangePassword" method="POST" onsubmit="return false">
                      <div class="alert alert-warning" role="alert">
                        <h6 class="alert-heading fw-bold mb-1">Ensure that these requirements are met</h6>
                        <span>Minimo 8 caracteres</span>
                      </div>
                      <div class="row">
                        <div class="mb-3 col-12 col-sm-6 form-password-toggle">
                          <label class="form-label" for="newPassword">Nueva Contraseña</label>
                          <div class="input-group input-group-merge">
                            <input class="form-control" type="password" id="newPassword" name="newPassword" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                          </div>
                        </div>

                        <div class="mb-3 col-12 col-sm-6 form-password-toggle">
                          <label class="form-label" for="confirmPassword">Confirmar Nueva Contraseña</label>
                          <div class="input-group input-group-merge">
                            <input class="form-control" type="password" name="confirmPassword" id="confirmPassword" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                          </div>
                        </div>
                        <div>
                          <button type="submit" class="btn btn-primary me-2">Cambiar Contraseña</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <!--/ Change Password -->
                <!-- Billing Address -->
                <div class="card card-action mb-4">
                  <div class="card-header align-items-center">
                    <h5 class="card-action-title mb-0">Billing Address</h5>
                    <div class="card-action-element">
                      <button class="btn btn-primary btn-sm edit-address" type="button" data-bs-toggle="modal" data-bs-target="#addNewAddress">Edit address</button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-xl-7 col-12">
                        <dl class="row mb-0">
                          <dt class="col-sm-4 fw-semibold mb-3 text-nowrap">Company Name:</dt>
                          <dd class="col-sm-8">Sneat</dd>

                          <dt class="col-sm-4 fw-semibold mb-3 text-nowrap">Billing Email:</dt>
                          <dd class="col-sm-8">user@ex.com</dd>

                          <dt class="col-sm-4 fw-semibold mb-3 text-nowrap">Tax ID:</dt>
                          <dd class="col-sm-8">TAX-357378</dd>

                          <dt class="col-sm-4 fw-semibold mb-3 text-nowrap">VAT Number:</dt>
                          <dd class="col-sm-8">SDF754K77</dd>

                          <dt class="col-sm-4 fw-semibold mb-3 text-nowrap">Billing Address:</dt>
                          <dd class="col-sm-8">100 Water Plant <br>Avenue, Building 1303<br> Wake Island</dd>
                        </dl>
                      </div>
                      <div class="col-xl-5 col-12">
                        <dl class="row mb-0">
                          <dt class="col-sm-4 fw-semibold mb-3 text-nowrap">Contact:</dt>
                          <dd class="col-sm-8">+1 (605) 977-32-65</dd>

                          <dt class="col-sm-4 fw-semibold mb-3 text-nowrap">Country:</dt>
                          <dd class="col-sm-8">Wake Island</dd>

                          <dt class="col-sm-4 fw-semibold mb-3 text-nowrap">State:</dt>
                          <dd class="col-sm-8">Capholim</dd>

                          <dt class="col-sm-4 fw-semibold mb-3 text-nowrap">Zipcode:</dt>
                          <dd class="col-sm-8">403114</dd>
                        </dl>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Billing Address -->
              </div>
              <!--/ User Content -->
            </div>

            
            
          </div>
          <!-- / Content -->

<?php footerAdmin($data); ?>