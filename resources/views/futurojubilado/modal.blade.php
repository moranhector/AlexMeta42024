    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document"> <!-- Cambiamos a modal-lg para hacerlo más grande -->
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h5 class="modal-title" id="editModalLabel">Editar</h5> -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id">
                        <input type="hidden" id="cuil" name="cuil">

                        <div class="form-group row">
                            <div class="col-md-3">
                                <label for="nombreapellido">Nombre y Apellido</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="nombreapellido" name="nombreapellido" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3">
                                <label for="cuil">CUIL</label>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="cuil" name="cuil" value=" " readonly>
                            </div>

                            <div class="col-md-1">
                                <label for="dni">DNI</label>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="dni" name="dni" value=" " readonly>
                            </div>

                            <div class="col-md-1">
                                <label for="id_meta4">Id M4</label>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="id_meta4" name="id_meta4" value=" " readonly>
                            </div>


                        </div>

                        <div class="form-group row">
                            <div class="col-md-3">
                                <label for="uor">UOR</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="uor" name="uor" value=" " readonly>
                            </div>

                        </div>


                        <div class="form-group row">
                            <div class="col-md-3">
                                <label for="fechanacimiento">Fecha Nacimiento</label>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="fechanacimiento" name="fechanacimiento" value=" " readonly>
                            </div>
                            <div class="col-md-1">
                                <label for="edad">Edad</label>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="edad" name="edad" value=" " readonly>
                            </div>
                            <div class="col-md-1">
                                <label for="rats">Rats</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="rats" name="rats" value=" " readonly>
                            </div>


                        </div>


                        <div class="form-group row">
                            <div class="col-md-3">
                                <label for="fechaactualiza">Fecha Ultima Actualización</label>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="fechaactualiza" name="fechaactualiza" value=" " readonly>
                            </div>

                            <div class="col-md-2">
                                <label for="diast">Días Transcurridos</label>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="diast" name="diast" value=" " readonly>
                            </div>


                        </div>







                        <div class="form-group row">
                            <div class="col-md-3">
                                <label for="comments">Comentarios</label>
                            </div>
                            <div class="col-md-9">
                                <textarea class="form-control" id="comments" name="comments" rows="3"></textarea>
                            </div>

                        </div>
                        <div class="form-group">

                            <div>

                                <label>Historial de Trámites</label>


                                <!-- Botón para exportar los datos a Excel -->
                                <button type="submit" id="export_excel2" class="btn btn-success">Exportar a Excel</button>




                            </div>


                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>F.Inicio</th>
                                        <th>F.Fin</th>
                                        <th>Trámite</th>
                                        <th>Observación</th>
                                        <th>Usuario</th>
                                        <th>Actualizado</th>
                                    </tr>
                                </thead>
                                <tbody id="tramites-table-body">
                                    <!-- Aquí se llenarán los datos de la API -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- Modal -->