<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title><?= $data['page_title'] ?></title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= media(); ?>/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />


    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?= media(); ?>/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= media(); ?>/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= media(); ?>/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?= media(); ?>/css/demo.css" />
    <link rel="stylesheet" href="<?= media(); ?>/css/estilos.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?= media(); ?>/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="<?= media(); ?>/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="<?= media(); ?>/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?= media(); ?>/js/config.js"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
          <!-- Forgot Password -->
          <div class="card">
            <div class="card-body">
              <div id="divloading">
                <div>
                  <img src="<?php echo media(); ?>/img/loading/loading.svg">
                </div>
              </div>
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="index.html" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    <img src="<?php echo media(); ?>/img/favicon/favicon.png">
                  </span>
                  <span class="app-brand-text demo text-body fw-bolder">Ronald Web</span>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">¿Olvidaste tu Contraseña? 🔒</h4>
              <p class="mb-4">Ingresa tu Email, se enviaran instrucciones para cambiar su contraseña</p>
              <form id="formRecetPass" name="formRecetPass" class="mb-3" action="" method="POST">
                <div class="mb-3">
                  <label for="txtEmailReset" class="form-label">Email</label>
                  <input type="email" class="form-control" id="txtEmailReset" name="txtEmailReset" placeholder="Ingresa tu email" autofocus/>
                </div>
                <button class="btn btn-primary d-grid w-100" type="submit">Enviar Link</button>
              </form>
              <div class="text-center">
                <a href="<?= base_url(); ?>/Login" class="d-flex align-items-center justify-content-center">
                  <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                  Regresar al Inicio de Sesión
                </a>
              </div>
            </div>
          </div>
          <!-- /Forgot Password -->
        </div>
      </div>
    </div>

    <!-- / Content -->

    <script>
      const base_url = "<?= base_url(); ?>";
    </script>
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?= media(); ?>/vendor/libs/jquery/jquery.js"></script>
    <script src="<?= media(); ?>/vendor/libs/popper/popper.js"></script>
    <script src="<?= media(); ?>/vendor/js/bootstrap.js"></script>
    <script src="<?= media(); ?>/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="<?= media(); ?>/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- SweetAlert JS -->
    <script src="<?php echo media(); ?>/vendor/libs/sweetalert/sweetalert.min.js"></script>

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="<?= media(); ?>/js/main.js"></script>
    <script src="<?php echo media(); ?>/js/<?= $data['page_functions_js']; ?>"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
