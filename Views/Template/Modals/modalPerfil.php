            <!-- Edit User Modal -->
            <div class="modal fade" id="modalFormPerfil" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                <div class="modal-content p-3 p-md-5">
                  <div class="modal-body">
                    <div id="divloading">
                      <div>
                        <img src="<?php echo media(); ?>/img/loading/loading.svg">
                      </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                      <h3>Editar datos de Usuario</h3>
                      <p></p>
                    </div>
                    <form id="formPerfil" name="formPerfil" class="row g-3" onsubmit="return false">
                      <div class="col-12 col-md-12">
                        <label class="form-label" for="txtIdentificacion">Identificación</label>
                        <input type="text" id="txtIdentificacion" name="txtIdentificacion" class="form-control" placeholder="" value="<?= $_SESSION['userData']['identificacion'] ?>" />
                      </div>
                      <div class="col-12 col-md-6">
                        <label class="form-label" for="txtNombre">Nombres</label>
                        <input type="text" id="txtNombre" name="txtNombre" class="form-control" placeholder="" value="<?= $_SESSION['userData']['nombres'] ?>" />
                      </div>
                      <div class="col-12 col-md-6">
                        <label class="form-label" for="txtApellido">Apellidos</label>
                        <input type="text" id="txtApellido" name="txtApellido" class="form-control" placeholder="" value="<?= $_SESSION['userData']['apellidos'] ?>" />
                      </div>
                      <div class="col-12 col-md-12">
                        <label class="form-label" for="modalEditUserEmail">Email</label>
                        <input type="text" id="modalEditUserEmail" name="modalEditUserEmail" class="form-control" placeholder="" value="<?= $_SESSION['userData']['email_user'] ?>" readonly disabled/>
                      </div>
                      <div class="col-12 col-md-12">
                        <label class="form-label" for="txtTelefono">Telefono</label>
                        <div class="input-group input-group-merge">
                          <span class="input-group-text">+51</span>
                          <input type="text" id="txtTelefono" name="txtTelefono" class="form-control phone-number-mask" placeholder="965985478" value="<?= $_SESSION['userData']['telefono'] ?>" />
                        </div>
                      </div>
                      <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Actualizar</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!--/ Edit User Modal -->