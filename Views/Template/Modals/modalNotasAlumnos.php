


                <!-- Modal Cursos Grados -->
                <div class="modal fade modalNotasAlumnos" id="modalNotasAlumnos" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel4">Añadir Promedios</h5>
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
                              <form action="" id="formNotasAlumnos" name="formNotasAlumnos">
                              <input type="hidden" id="idGraC" name="idGraC" value="<?= $data['id_grado_curso']; ?>" required="">
                                <div class="table-responsive text-nowrap">
                                  <table class="table table-sm">
                                    <thead>
                                      <tr>
                                        <th>Alumno</th>
                                        <th>Bimestre 1</th>
                                        <th>Bimestre 2</th>
                                        <th>Bimestre 3</th>
                                        <th>Bimestre 4</th>
                                      </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                      <?php 
                                      if (!empty($data['notas'])) {
                                          $no=1;
                                          $notas = $data['notas'];
                                          for ($i=0; $i < count($notas); $i++){

                                              $cursoGradoAct = $notas[$i]['ar_notas'];

                                              $idGra = $data['id_grado_curso'];
                                      ?>
                                      <tr>
                                        <td style="text-align: center;">
                                            <input type="hidden" name="notas[<?= $i; ?>][id_persona]" value="<?= $notas[$i]['id_persona']; ?>" required>
                                            <?= $notas[$i]['nombres'] . " " . $notas[$i]['apellidos']; ?>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="notas[<?= $i; ?>][n1]" value="<?= $cursoGradoAct['n1']; ?>" min="0" max="20">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="notas[<?= $i; ?>][n2]" value="<?= $cursoGradoAct['n2']; ?>" min="0" max="20">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="notas[<?= $i; ?>][n3]" value="<?= $cursoGradoAct['n3']; ?>" min="0" max="20">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="notas[<?= $i; ?>][n4]" value="<?= $cursoGradoAct['n4']; ?>" min="0" max="20">
                                        </td>
                                      </tr>
                                      <?php 
                                          $no++;
                                        }
                                        // code...
                                      }else{
                                        ?>
                                        <tr>
                                          <td colspan="5">No hay Alumnos Registrados en este Grado</td>
                                        </tr>
                                        <?php
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
