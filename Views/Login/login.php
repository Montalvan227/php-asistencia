<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Sistema Web - MJSB</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= media(); ?>/assets/img/favicon/favicon.ico" />

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
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
                    <img src="<?= media(); ?>/img/favicon/favicon.ico" style="transform: scale(0.8); margin-left: -15px">
                  </span>
                  <span class="app-brand-text demo text-body fw-bolder" style="text-transform: none; margin-left: -40px;">I.E.P "MJSB"</span>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2" style="text-align: center; margin-top: -35px">Bienvenido al SISTEMA 👋</h4>
              <p class="mb-4" style="text-align: center;">Ingresa a tu cuenta</p>

              <form class="mb-3" name="formLogin" id="formLogin" method="POST">
                <div class="mb-3">
                  <label for="email" class="form-label">Usuario</label>
                  <input
                    type="text"
                    class="form-control"
                    id="txtEmail"
                    name="txtEmail"
                    placeholder="Ingresa tu Correo o DNI"
                    autofocus
                  />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Contraseña</label>
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="txtPassword"
                      class="form-control"
                      name="txtPassword"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                <div class="mb-3" style="margin-top: 15px;">
                  <button class="btn btn-primary d-grid w-100" type="submit">Ingresar</button>
                </div>
                <audio id="userClickSound" style="display: none">
                  <source src="usuario.mp3" type="audio/mpeg">
                  Tu navegador no admite audio HTML5.
                </audio>
                <audio id="passwordClickSound" style="display: none">
                  <source src="contraseña.mp3" type="audio/mpeg">
                  Tu navegador no admite audio HTML5.
                </audio>
                <script>
                  $(document).ready(function() {
                    // Función para reproducir el sonido del usuario
                    function playUserClickSound() {
                      var audio = document.getElementById('userClickSound');
                      audio.play();
                    }

                    // Función para reproducir el sonido de la contraseña
                    function playPasswordClickSound() {
                      var audio = document.getElementById('passwordClickSound');
                      audio.play();
                    }

                    // Detectar clic en los campos de entrada de usuario y contraseña
                    $('#txtEmail').on('click', function() {
                      playUserClickSound();
                    });

                    $('#txtPassword').on('click', function() {
                      playPasswordClickSound();
                    });
                  });
                </script>
              </form>

            </div>
          </div>
          <!-- /Register -->
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
