                <!-- Modal Nuevo Usuario -->
                <div class="modal show" id="modalFormSlider" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <form id="formSlider" name="formSlider" class="modal-content">
                      <div id="divloading">
                        <div>
                          <img src="<?php echo media(); ?>/img/loading/loading.svg">
                        </div>
                      </div>
                      <input type="hidden" id="idSlider" name="idSlider" value="">
                      <input type="hidden" id="foto_actual" name="foto_actual" value="">
                      <input type="hidden" id="foto_remove" name="foto_remove" value="0">
                      <div class="modal-header headerRegister pb-3">
                        <h5 class="modal-title" id="titleModal">Nuevo Slider</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">

                          <div class="col-md-12">
                            <div class="row mb-1">
                              <label class="col-sm-3 col-form-label" for="txtTitulo">Título *</label>
                              <div class="col-sm-9">
                                <input type="text" id="txtTitulo" name ="txtTitulo" class="form-control" placeholder="" required/>
                              </div>
                            </div>

                            <div class="row mb-1">
                              <label class="col-sm-3 col-form-label" for="txtTexto">Texto</label>
                              <div class="col-sm-9">
                                <input type="text" id="txtTexto" name ="txtTexto" class="form-control" placeholder="" required/>
                              </div>
                            </div>

                            <div class="row mb-1">
                              <label class="col-sm-3 col-form-label" for="txtEnlace">Enlace</label>
                              <div class="col-sm-9">
                                <input type="text" id="txtEnlace" name ="txtEnlace" class="form-control" placeholder="" required/>
                              </div>
                            </div>

                            <div class="photo">
                              <label for="foto">Imagen (1770 X 720)</label>
                              <div class="prevPhoto prevSlider">
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
                <div class="modal fade" id="modalViewMarca" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="titleModal">Datos de la Marca<span id="nombresApellidos"></span></h5>
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
                                  <p id="celNombreMarca">Marca</p>
                                </div>
                                <div class="col-sm-6">
                                  <h5 class="card-title">Imagen</h5>
                                  <p id="celImagenMarca">img</p>
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

