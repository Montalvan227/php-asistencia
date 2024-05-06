<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
    <meta name="description" content="<?= $data['page_title'] ?>"/>
    <meta name="author" content="MJSB">
    <meta name="theme-color" content="#696cff">

    <title>Sistema Web - MJSB</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= media(); ?>/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet"/>

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?= media(); ?>/vendor/fonts/boxicons.css"/>

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= media(); ?>/vendor/css/core.css" class="template-customizer-core-css"/>
    <link rel="stylesheet" href="<?= media(); ?>/vendor/css/theme-default.css" class="template-customizer-theme-css"/>
    <link rel="stylesheet" href="<?= media(); ?>/css/demo.css"/>

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?= media(); ?>/vendor/libs/perfect-scrollbar/perfect-scrollbar.css"/>

    <link rel="stylesheet" href="<?= media(); ?>/vendor/libs/apex-charts/apex-charts.css"/>

    <!--Datatables CSS-->
    <link rel="stylesheet" href="<?= media(); ?>/vendor/libs/datatables/datatables.min.css"/>
    <!--<link rel="stylesheet" href="<?= media(); ?>/vendor/libs/datatables/select.dataTables.min.css"/>-->

    <!-- BOotstrap Select CSS -->
    <link rel="stylesheet" href="<?= media(); ?>/vendor/libs/select2-develop/select2.css"/>

    <!-- Mis CSS -->
    <link rel="stylesheet" href="<?= media(); ?>/css/estilos.css"/>
    <link rel="stylesheet" href="<?= media(); ?>/css/user-view.css"/>

    <!-- Helpers -->
    <script src="<?= media(); ?>/vendor/js/helpers.js"></script>

    <!--JS configuración-->
    <script src="<?= media(); ?>/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo" style="margin-left: -15px">
            <a href="<?= base_url(); ?>/dashboard" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img src="<?= media(); ?>/img/favicon/favicon.ico" style="max-width: 60px;">
              </span>
              <span class="app-brand-text demo menu-text fw-bolder ms-2" style="text-transform: none;">I.E.P MJSB</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <?php if(!empty($_SESSION['permisos'][1]['r'])){ ?>
            <!-- Dashboard -->
            <li class="menu-item active">
              <a href="<?= base_url(); ?>/dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboard">Dashboard</div>
              </a>
            </li>
            <?php } ?>

            <?php if(!empty($_SESSION['permisos'][1]['r'])){ ?>
            <!-- Web -->
            <li class="menu-item">
              <a href="<?= base_url(); ?>/inicio.html" class="menu-link">
                <i class="menu-icon tf-icons bx bx-window-alt"></i>
                <div data-i18n="Web">Pagina de la Institución</div>
              </a>
            </li>
            <?php } ?>

            <?php if(!empty($_SESSION['permisos'][3]['r'])){ ?>
            <li class="menu-item">
              <a href="<?= base_url(); ?>/Alumnos" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-circle"></i>
                <div data-i18n="Alumnos">Alumnos</div>
              </a>
            </li>
            <?php } ?>

            <?php if(!empty($_SESSION['permisos'][4]['r'])){ ?>
            <li class="menu-item">
              <a href="<?= base_url(); ?>/Docentes" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-voice"></i>
                <div data-i18n="Docentes">Docentes</div>
              </a>
            </li>
            <?php } ?>


            <?php if(!empty($_SESSION['permisos'][5]['r'])){ ?>
            <li class="menu-item">
              <a href="<?= base_url(); ?>/Aulas" class="menu-link">
                <i class="menu-icon tf-icons bx bx-buildings"></i>
                <div data-i18n="Aulas">Grados</div>
              </a>
            </li>
            <?php } ?>

            <?php if(!empty($_SESSION['permisos'][5]['r'])){ ?>
            <li class="menu-item">
              <a href="<?= base_url(); ?>/Cursos" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Cursos">Cursos</div>
              </a>
            </li>
            <?php } ?>

            <?php if(!empty($_SESSION['permisos'][7]['r'])){ ?>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user-check"></i>
                <div data-i18n="Asistencias">Asistencia</div>
              </a>

              <ul class="menu-sub">
                <?php if(!empty($_SESSION['permisos'][7]['w'])){ ?>
                <li class="menu-item">
                  <a href="<?= base_url(); ?>/Asistencias" class="menu-link">
                    <div data-i18n="Asistencias">Tomar Asistencia</div>
                  </a>
                </li>
                <?php } ?>
                <li class="menu-item">
                  <a href="<?= base_url(); ?>/Asistencias/verAsistencias" class="menu-link">
                    <div data-i18n="verAsistencias">Visualizar</div>
                  </a>
                </li>
              </ul>
            </li>
            <?php } ?>

            <?php if(!empty($_SESSION['permisos'][8]['r'])){ ?>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-spreadsheet"></i>
                <div data-i18n="Notas">Promedios</div>
              </a>

              <ul class="menu-sub">
                <?php if(!empty($_SESSION['permisos'][8]['w'])){ ?>
                <li class="menu-item">
                  <a href="<?= base_url(); ?>/Notas" class="menu-link">
                    <div data-i18n="Notas">Ingresar Promedios</div>
                  </a>
                </li>
                <?php } ?>
                <li class="menu-item">
                  <a href="<?= base_url(); ?>/Notas/verNotas" class="menu-link">
                    <div data-i18n="verNotas">Revisar</div>
                  </a>
                </li>
              </ul>
            </li>
            <?php } ?>

            <?php if(!empty($_SESSION['permisos'][2]['r'])){ ?>
            <!-- Layouts -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user-pin"></i>
                <div data-i18n="Usuarios">Usuarios</div>
              </a>

              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="<?= base_url(); ?>/Usuarios" class="menu-link">
                    <div data-i18n="Usuario">Usuarios</div>
                  </a>
                </li>
                <?php if(!empty($_SESSION['permisos'][12]['r'])){ ?>
                <li class="menu-item">
                  <a href="<?= base_url(); ?>/Roles" class="menu-link">
                    <div data-i18n="Roles">Roles</div>
                  </a>
                </li>
                <?php } ?>
              </ul>
            </li>
            <?php } ?>


          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
  <?php require_once("nav_admin.php"); ?>