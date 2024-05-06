                <!-- Modal Nuevo Rol -->
                <div class="modal fade" id="modalFormAula" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <form id="formAula" name="formAula" class="modal-content">
                    <div id="divloading">
                      <div>
                        <img src="<?php echo media(); ?>/img/loading/loading.svg">
                      </div>
                    </div>
                      <input type="hidden" id="idGrado" name="idGrado" value="">
                      <div class="modal-header headerRegister pb-3">
                        <h5 class="modal-title" id="titleModal">Nueva Aula</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col mb-3">
                            <label for="txtNombre" class="form-label">Grado / Aula</label>
                            <input type="text" id="txtNombre" name ="txtNombre" class="form-control" placeholder="Nombre del aula" required/>
                          </div>
                        </div>
                        <div class="row g-2">
                          <div class="col mb-0">
                            <label for="listStatus" class="form-label">Estado</label>
                            <select id="listStatus" name="listStatus" class="form-select" required>
                              <option value="1">Activo</option>
                              <option value="2">Inactivo</option>
                            </select>
                          </div>
                        </div>
                        <div class="row g-2 pt-3">
                          <div class="col mb-0">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" id="btnActionForm" class="btn btn-primary"><span id="btnText">Guardar</span></button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <!-- Fin Modal Nuevo Rol -->

