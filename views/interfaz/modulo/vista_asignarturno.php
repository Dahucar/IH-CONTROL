<div class="ayuda container">
    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "ADMINISTRADOR"): ?>

        <?php if (isset($_SESSION['ASIGTURNO']['ERR'])): ?>
            <div class="alert alert-danger" role="alert">
                <strong><?= $_SESSION['ASIGTURNO']['ERR'] ?></strong>  
            </div>
        <?php else: ?>



            <h1>Módulo administrador: Asignar turno a <?= $v->nombre . " " . $v->apellido_p ?></h1>

            <!-- idturnos 	codigo 	fecha_inicio 	fecha_termino 	estado 	turno_de_vendedor_idturno_de_vendedor  -->

            <form action="http://localhost/Inmuebles-Herrera/turno/asignarTunno&idv=<?= $v->idvendedores ?>" method="POST">
                <div class="form-group">
                    <label for="select_turno">Turnos disponibles</label>
                    <select class="custom-select" name="select_turno" id="select_turno">
                        <option selected value="" >Seleccione</option>
                        <?php while ($t = $lista->fetch_object()): ?>
                            <option value="<?= $t->idturnos ?>"><?= $t->nombre ?></option>
                        <?php endwhile; ?>
                    </select> 
                </div>  


                <button type="submit" class="btn btn-primary">Agregar</button>
                <a class="btn btn-danger" href="http://localhost/Inmuebles-Herrera/vendedor/vendedores">Cancelar</a>
            </form> 
            <div class="row">
                <div class="col-12">
                    <h3 class="mt-3">Turnos ya asignados</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr> 
                                    <th scope="col">Nombre</th>  
                                    <th scope="col">Fecha inicio</th>
                                    <th scope="col">Fecha termino</th>
                                    <th scope="col">Estado</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php while ($lt = $listadoTurnos->fetch_object()) : ?> 
                                    <tr>  
                                        <td><?= $lt->nombre ?></td>
                                        <td><?= $lt->fecha_inicio ?></td>
                                        <td><?= $lt->fecha_termino ?></td>
                                        <td><?= $lt->estado ?></td>
                                    </tr> 
                                <?php endwhile; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        <?php endif; ?>
        <?php Utils::borrarSessionNombre('ADDPROD', 'ERR'); ?> 
    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            <strong>Usted no tiene acceso a este contenido</strong>
        </div>
    <?php endif; ?>
</div>
