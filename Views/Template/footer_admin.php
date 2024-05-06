
            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , Maria José Sime Barbadillo Todos los derechos reservados
                  <a href="www.mariajosesimebarbadillo.edu.pe" target="_blank" class="footer-link fw-bolder"></a>
                </div>
                <div>
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script>
      const base_url = "<?= base_url(); ?>";
    </script>
    <script src="<?php echo media(); ?>/vendor/libs/jquery/jquery.js"></script>
    <script src="<?php echo media(); ?>/vendor/libs/popper/popper.js"></script>
    <script src="<?php echo media(); ?>/vendor/js/bootstrap.js"></script>
    <script src="<?php echo media(); ?>/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    
    <!--https://codepen.io/mistaj/pen/xRwaby-->
    <script src="<?php echo media(); ?>/js/plugins/jquery.inputmask.bundle.min.js"></script>

    <script src="<?php echo media(); ?>/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- SweetAlert JS -->
    <script src="<?php echo media(); ?>/vendor/libs/sweetalert/sweetalert.min.js"></script>

    <!-- SweetAlert JS -->
    <script src="<?php echo media(); ?>/vendor/libs/ckeditor5/ckeditor.js"></script>

    <!-- Vendors JS -->
    <script src="<?php echo media(); ?>/vendor/libs/apex-charts/apexcharts.js"></script>


    <!-- Vendors JS -->
    <script src="<?php echo media(); ?>/js/jquery.peity.min.js"></script>
    <script type="text/javascript">
      $(".data-attributes span").peity("donut")
    </script>

    <!-- Datatables JS -->
    <script src="<?php echo media(); ?>/vendor/libs/datatables/datatables.min.js"></script>
    <!--<script src="<?php echo media(); ?>/vendor/libs/datatables/buttons.dataTables.min.js"></script>
    <script src="<?php echo media(); ?>/vendor/libs/datatables/jquery.dataTables.min.js"></script>-->

    <!-- Main JS -->
    <script src="<?php echo  media(); ?>/vendor/libs/select2-develop/select2.js"></script>

    <!-- Main JS -->
    <script src="<?php echo media(); ?>/js/main.js"></script>

    <!-- Buttons Datatables JS -->
    <script type="text/javascript" language="javascript" src="<?php echo media(); ?>/js/plugins/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo media(); ?>/js/plugins/jszip.min.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo media(); ?>/js/plugins/pdfmake.min.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo media(); ?>/js/plugins/vfs_fonts.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo media(); ?>/js/plugins/buttons.html5.min.js"></script>

    <!-- Page JS -->
    <script src="<?php echo media(); ?>/js/dashboards-analytics.js"></script>
    <script src="<?php echo media(); ?>/js/modal-edit-user.js"></script>
    <script src="<?php echo media(); ?>/js/app-user-view.js"></script>
    <script src="<?php echo media(); ?>/js/app-user-view-account.js"></script>


    <script src="<?php echo media(); ?>/js/plugins/JsBarcode.all.min.js"></script>
    <!-- Main JS -->
    <script type="text/javascript" src="<?= media();?>/js/functions_admin.js"></script>
    <script src="<?php echo media(); ?>/js/<?= $data['page_functions_js']; ?>"></script>
    

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    
  </body>
</html>
