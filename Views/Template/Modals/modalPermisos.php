
                <!-- Modal Permisos Rol -->
                <div class="modal fade modalPermisos" id="modalPermisos" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel4">Permisos Roles de Usuario</h5>
                        <button
                          type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                      </div>

                      <div class="modal-body">
                      <div id="divloading">
                        <div>
                          <img src="<?php echo media(); ?>/img/loading/loading.svg">
                        </div>
                      </div>
                        <?php 
                          //dep($data);
                         ?>
                        <div class="row">
                          <div class="col mb-3">
                            
                            <!-- Small table -->

                            <div class="card text-center">
                              <form action="" id="formPermisos" name="formPermisos">
                              <input type="hidden" id="idrol" name="idrol" value="<?= $data['id_rol']; ?>" required="">
                                <div class="table-responsive text-nowrap">
                                  <table class="table table-sm">
                                    <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>Modulo</th>
                                        <th>Ver</th>
                                        <th>Crear</th>
                                        <th>Actualizar</th>
                                        <th>Eliminar</th>
                                      </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                      <?php 
                                          $no=1;
                                          $modulos = $data['modulos'];
                                          for ($i=0; $i < count($modulos); $i++){

                                              $permisos = $modulos[$i]['permisos'];
                                              $rCheck = $permisos['r'] == 1 ? " checked " : "";
                                              $wCheck = $permisos['w'] == 1 ? " checked " : "";
                                              $uCheck = $permisos['u'] == 1 ? " checked " : "";
                                              $dCheck = $permisos['d'] == 1 ? " checked " : "";

                                              $idmod = $modulos[$i]['id_modulo'];
                                      ?>
                                      <tr>
                                        <td>
                                          <?php if (!$modulos[$i]['idpadre']) { ?>
                                            <?= $modulos[$i]['numero']; ?>
                                          <?php } ?>
                                            <input type="hidden" name="modulos[<?= $i; ?>][idmodulo]" value="<?= $idmod ?>" required >
                                        </td>
                                        <td style="text-align: left;">
                                          <?php if ($modulos[$i]['idpadre']) { ?>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                          <?php } ?>
                                          <?= $modulos[$i]['titulo']; ?>
                                        </td>
                                        <td>
                                          <label class="switch switch-square">
                                            <input type="checkbox" class="switch-input" name="modulos[<?= $i; ?>][r]" <?= $rCheck ?>>
                                            <span class="switch-toggle-slider">
                                              <span class="switch-on"><i class="bx bx-check"></i></span>
                                              <span class="switch-off"><i class="bx bx-x"></i></span>
                                            </span>
                                          </label>
                                        </td>
                                        <td>
                                          <label class="switch switch-square">
                                            <input type="checkbox" class="switch-input" name="modulos[<?= $i; ?>][w]" <?= $wCheck ?>>
                                            <span class="switch-toggle-slider">
                                              <span class="switch-on"><i class="bx bx-check"></i></span>
                                              <span class="switch-off"><i class="bx bx-x"></i></span>
                                            </span>
                                          </label>
                                        </td>
                                        <td>
                                          <label class="switch switch-square">
                                            <input type="checkbox" class="switch-input" name="modulos[<?= $i; ?>][u]" <?= $uCheck ?>>
                                            <span class="switch-toggle-slider">
                                              <span class="switch-on"><i class="bx bx-check"></i></span>
                                              <span class="switch-off"><i class="bx bx-x"></i></span>
                                            </span>
                                          </label>
                                        </td>
                                        <td>
                                          <label class="switch switch-square">
                                            <input type="checkbox" class="switch-input" name="modulos[<?= $i; ?>][d]" <?= $dCheck ?>>
                                            <span class="switch-toggle-slider">
                                              <span class="switch-on"><i class="bx bx-check"></i></span>
                                              <span class="switch-off"><i class="bx bx-x"></i></span>
                                            </span>
                                          </label>
                                        </td>
                                      </tr>
                                      <?php 
                                          $no++;
                                        }
                                      ?>
                                    </tbody>
                                  </table>
                                </div>
                                <div class="row g-2 pt-3">
                                  <div class="col mb-0">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" id="btnActionForm" class="btn btn-primary"><span id="btnText">Guardar</span></button>
                                  </div>
                                </div>
                              </form>

                            </div>

                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
                <!-- Fin Modal Permisos Rol -->
