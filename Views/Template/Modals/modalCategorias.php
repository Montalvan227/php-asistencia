                <!-- Modal Nuevo Usuario -->
                <div class="modal show" id="modalFormCategorias" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <form id="formCategoria" name="formCategoria" class="modal-content">
                      <div id="divloading">
                        <div>
                          <img src="<?php echo media(); ?>/img/loading/loading.svg">
                        </div>
                      </div>
                      <input type="hidden" id="idCategoria" name="idCategoria" value="">
                      <input type="hidden" id="foto_actual" name="foto_actual" value="">
                      <input type="hidden" id="foto_remove" name="foto_remove" value="0">
                      <input type="hidden" id="nombreCompleto" name="nombreCompleto" value="0">
                      <div class="modal-header headerRegister pb-3">
                        <h5 class="modal-title" id="titleModal">Nueva Categoria</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">

                          <div class="col-md-6">
                            <div class="row mb-3">
                              <label class="col-sm-3 col-form-label" for="txtNombre">Nombre</label>
                              <div class="col-sm-9">
                                <input type="text" id="txtNombre" name ="txtNombre" class="form-control" placeholder=""/>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label class="col-sm-3 col-form-label" for="txtDescripcion">Descripción</label>
                              <div class="col-sm-9">
                                <textarea id="txtDescripcion" name ="txtDescripcion" class="form-control" placeholder=""></textarea>
                              </div>
                            </div>

                            <div class="row g-2 mb-3">
                              <div class="col-sm-3" style="line-height: 40px;">
                                <label for="listStatus" class="form-label">Estado</label>
                              </div>
                              <div class="col-sm-9">
                                <select id="listStatus" name="listStatus" class="form-control listStatus" required>
                                  <option value="1">Activo</option>
                                  <option value="2">Inactivo</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="photo">
                              <label for="foto">Foto (400X400)</label>
                              <div class="prevPhoto">
                                <span class="delPhoto notBlock">X</span>
                                <label for="foto"></label>
                                <div>
                                  <img style="max-width:100%;max-height:100%;" id="img" src="http://localhost:8080/PHPPOOMVCPDO/tienda_virtual/Assets/images/uploads/product.png">
                                </div>
                              </div>
                              <div class="upimg">
                                <input type="file" class="form-control" name="foto" id="foto">
                              </div>
                              <div id="form_alert"></div>
                          </div>
                          </div>
                          <div class="col-md-12 mt-3">

                            <div class="row g-2 mb-3">
                              <div class="col-sm-2" style="line-height: 40px;">
                                <label for="listRolid" class="form-label">Categoria Padre</label>
                              </div>
                              <div class="col-sm-10">
                                <select id="listCatPadre" name="listCatPadre" class="form-control listCatPadre" style="width: 100%;" required>
                                  <option value='0'>- Buscar -</option>
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
                <div class="modal fade" id="modalViewCategoria" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="titleModal">Datos de la Categoria<span id="nombresApellidos"></span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <div class="card">
                            <div class="card-body">
                              <div class="divider text-start">
                                <div class="divider-text">Datos Generales</div>
                              </div>
                              <div class="row">
                                <div class="col-sm-6">
                                  <h5 class="card-title">Nombre</h5>
                                  <p id="celNombreCategoria">Ronald Rabanal</p>
                                  <h5 class="card-title">Nombre Completo</h5>
                                  <p id="celNombreCompletoCategoria">Ronald Rabanal</p>
                                  <h5 class="card-title">Descripción</h5>
                                  <p id="celDescripcionCategoria">Rabanal Cardoza</p>
                                </div>
                                <div class="col-sm-6">
                                  <h5 class="card-title">Imagen</h5>
                                  <p id="celImagenCategoria">9309052915</p>
                                </div>
                              </div>

                            </div>
                            <div class="card-footer text-muted">Creado el <span id="celFechaRegistro">15/09/2022</span></div>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                          </div>
                      </div>
                    </div>  
                  </div>
                </div>
                <!-- Fin Modal Nuevo Usuario -->

