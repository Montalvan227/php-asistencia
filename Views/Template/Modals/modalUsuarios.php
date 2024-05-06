                <!-- Modal Nuevo Usuario -->
                <div class="modal fade" id="modalFormUsuario" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <form id="formUsuario" name="formUsuario" class="modal-content">
                      <div id="divloading">
                        <div>
                          <img src="<?php echo media(); ?>/img/loading/loading.svg">
                        </div>
                      </div>
                      <input type="hidden" id="idUsuario" name="idUsuario" value="">
                      <div class="modal-header headerRegister pb-3">
                        <h5 class="modal-title" id="titleModal">Nuevo Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-7">
                            <div class="row mb-3">
                              <label class="col-sm-2 col-form-label" for="listTDocumento">T. Doc.</label>
                              <div class="col-sm-4">
                                <div class="input-group">
                                  <select id="listTDocumento" name="listTDocumento" class="form-select">
                                    <option value="1">DNI</option>
                                    <option value="2">CARNET DE EXT.</option>
                                  </select>
                                </div>
                              </div>
                              <label class="col-sm-2 col-form-label" for="txtIdentificacion">N° Doc.</label>
                              <div class="col-sm-4" id="div-dni">
                                <div class="input-group">
                                  <input type="text" class="form-control inputNumerico" maxlength="8" id="txtIdentificacion" name="txtIdentificacion" placeholder="Número de Documento">
                                </div>
                              </div>
                            </div>
                            <div class="row mb-3 nombreApellido">
                              <label class="col-sm-2 col-form-label" for="txtNombre">Nombres</label>
                              <div class="col-sm-4">
                                <input type="text" id="txtNombre" name ="txtNombre" class="form-control"/>
                              </div>
                              <label class="col-sm-2 col-form-label" for="txtApellido">Apellidos</label>
                              <div class="col-sm-4">
                                <input type="text" id="txtApellido" name ="txtApellido" class="form-control"/>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label class="col-sm-2 col-form-label" for="txtTelefono">Teléfono</label>
                              <div class="col-sm-10">
                                <input type="text" id="txtTelefono" name ="txtTelefono" class="form-control" placeholder=""/>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label class="col-sm-2 col-form-label" for="txtDireccion">Dirección</label>
                              <div class="col-sm-10">
                                <input type="text" id="txtDireccion" name ="txtDireccion" class="form-control" placeholder="">
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label class="col-sm-2 col-form-label" for="txtApoderado">Apoderado</label>
                              <div class="col-sm-10">
                                <input type="text" id="txtApoderado" name ="txtApoderado" class="form-control" placeholder="">
                              </div>
                            </div>
                            <div class="row g-2 mb-3">
                              <div class="col-sm-2" style="line-height: 40px;">
                                <label for="listStatus" class="form-label">Estado</label>
                              </div>
                              <div class="col-sm-10">
                                <select id="listStatus" name="listStatus" class="form-select listStatus" required>
                                  <option value="1">Activo</option>
                                  <option value="2">Inactivo</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-5">
                            <div class="row mb-3">
                              <label class="col-sm-2 col-form-label" for="txtEmail">Email</label>
                              <div class="col-sm-10">
                                <input type="email" id="txtEmail" name ="txtEmail" class="form-control" placeholder="" required/>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <div class="col">
                                <div class="form-password-toggle row">
                                    <div class="col-sm-2" style="line-height: 40px;">
                                      <label class="form-label" for="txtPassword">Password</label>
                                    </div>
                                    <div class="col-sm-10">
                                      <div class="input-group input-group-merge">
                                        <input type="password" class="form-control" id="txtPassword" name="txtPassword" placeholder="············" aria-describedby="basic-default-password">
                                        <span class="input-group-text cursor-pointer" id="basic-default-password"><i class="bx bx-hide"></i></span>
                                      </div>
                                    </div>
                                </div>
                              </div>
                            </div>
                            <div class="row g-2 mb-3">
                              <div class="col-sm-2" style="line-height: 40px;">
                                <label for="listRolid" class="form-label">Tipo Usuario</label>
                              </div>
                              <div class="col-sm-10">
                                <select id="listRolid" name="listRolid" class="form-control listRolid" style="width: 100%;" required>

                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="row g-2 pt-3">
                              <p class="text-primary">* Todos los Campos son obligatorios</p>
                              <div class="col mb-0">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" id="btnActionForm" class="btn btn-primary"><span id="btnText">Guardar</span></button>
                              </div>
                            </div>
                          </div>
                        </div>
                            
                      </div>
                    </form>
                  </div>
                </div>
                <!-- Fin Modal Nuevo Usuario -->



                <!-- Modal Nuevo Usuario -->
                <div class="modal fade" id="modalViewUser" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="titleModal">Datos de Usuario<span id="nombresApellidos"></span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <div class="card">
                            <div class="card-body">
                              <div class="divider text-start">
                                <div class="divider-text">Datos Generales</div>
                              </div>
                              <div class="row">
                                <div class="col-sm-6 celNombreApellido">
                                  <h5 class="card-title">Nombres</h5>
                                  <p id="celNombre"></p>
                                </div>
                                <div class="col-sm-6 celNombreApellido">
                                  <h5 class="card-title">Apellidos</h5>
                                  <p id="celApellido"></p>
                                </div>
                                <div class="col-sm-6">
                                  <h5 class="card-title">Teléfono</h5>
                                  <p id="celTelefono"></p>
                                </div>
                                <div class="col-sm-6">
                                  <h5 class="card-title">Identificación</h5>
                                  <p id="celIdentificacion"></p>
                                </div>
                                <div class="col-sm-6">
                                  <h5 class="card-title">Grado</h5>
                                  <p id="celGradoUsuario">GRADO 1</p>
                                </div>
                                <div class="col-sm-6">
                                  <h5 class="card-title">Dirección</h5>
                                  <p id="celDireccion"></p>
                                </div>
                                <div class="col-sm-6">
                                  <h5 class="card-title">Apoderado</h5>
                                  <p id="celApoderado"></p>
                                </div>
                              </div>

                              <div class="divider text-start">
                                <div class="divider-text">Sistema</div>
                              </div>
                              <div class="row">
                                <div class="col-sm-6">
                                  <h5 class="card-title">Email (Usuario)</h5>
                                  <p id="celEmail"></p>
                                </div>
                                <div class="col-sm-6">
                                  <h5 class="card-title">Tipo de Usuario;</h5>
                                  <p id="celTipoUsuario">Administrador</p>
                                </div>
                              </div>

                            </div>
                            <div class="card-footer text-muted">Creado el <span id="celFechaRegistro"></span></div>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                          </div>
                      </div>
                    </div>  
                  </div>
                </div>
                <!-- Fin Modal Nuevo Usuario -->

