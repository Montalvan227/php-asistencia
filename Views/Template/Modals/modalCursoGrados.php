


                <!-- Modal Cursos Grados -->
                <div class="modal fade modalCursosGrado" id="modalCursosGrado" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel4">En que Grado se dicta el curso</h5>
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
                              <form action="" id="formCursosGrado" name="formCursosGrado">
                              <input type="hidden" id="idCurso" name="idCurso" value="<?= $data['id_curso']; ?>" required="">
                                <div class="table-responsive text-nowrap">
                                  <table class="table table-sm">
                                    <thead>
                                      <tr>
                                        <th>Grado</th>
                                        <th>Activo</th>
                                        <th>Docente</th>
                                      </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                      <?php 
                                          $no=1;
                                          $grados = $data['grados'];
                                          for ($i=0; $i < count($grados); $i++){

                                              $cursoGradoAct = $grados[$i]['s_grados'];
                                              $actCheck = $cursoGradoAct['estado'] == 1 ? " checked " : "";
                                              $actDisa = $cursoGradoAct['estado'] == 0 ? " disabled " : "";

                                              $idGra = $grados[$i]['id_grado'];
                                      ?>
                                      <tr>
                                        <td style="text-align: center;">
                                            <input type="hidden" name="grados[<?= $i; ?>][id_grado]" value="<?= $idGra ?>" required >
                                          <?= $grados[$i]['nombre_grado']; ?>
                                        </td>
                                        <td>
                                          <label class="switch switch-square">
                                            <input type="checkbox" class="switch-input" name="grados[<?= $i; ?>][estado]" <?= $actCheck ?>>
                                            <span class="switch-toggle-slider">
                                              <span class="switch-on"><i class="bx bx-check"></i></span>
                                              <span class="switch-off"><i class="bx bx-x"></i></span>
                                            </span>
                                          </label>
                                        </td>
                                        <td class="container-xs">
                                          
                                          <div class="row g-2">
                                            <div class="col-sm-12">
                                              <select name="grados[<?= $i; ?>][persona_id]" class="form-control listDocenteId selectGradosUsuario" style="width: 100%;" required>
                                                <option value="<?= $cursoGradoAct['id_persona']; ?>"><?= $cursoGradoAct['nombre_completo']; ?></option>
                                              </select>
                                            </div>
                                          </div>
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
                <!-- FIN Modal Cursos Grados -->
