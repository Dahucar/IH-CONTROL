<div class="ayuda container">
    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "VENDEDOR"): ?>
        <?php if (isset($_SESSION['MOSTRARERROR']['ERR'])): ?>
            <div class="alert alert-danger" role="alert">
                <strong><?= $_SESSION['MOSTRARERROR']['ERR'] ?></strong>
            </div>
        <?php else: ?>    
            <h1>Módulo vendedor: Mis turnos</h1>

            <!-- Grid de productos --> 
            <div class="row">  
                <table class="table"> 
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Nombre turno</th>
                            <th scope="col">Fecha de Inicio</th>
                            <th scope="col">Fecha de Temino</th>
                            <th scope="col">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($lt = $listado->fetch_object()): ?> 
                            <tr> 
                                <th scope="row"><?= $lt->nombre ?></th>
                                <td><?= $lt->fecha_inicio ?></td>
                                <td><?= $lt->fecha_termino ?></td>
                                <td><?= $lt->estado ?></td>
                            </tr> 
                        <?php endwhile; ?>
                    </tbody>
                </table>

            </div>  
        <?php endif; ?>
        <?php Utils::borrarSessionNombre('MOSTRARERROR', 'ERR') ?>
    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            <strong>Usted no tiene acceso a este contenido</strong>
        </div>
    <?php endif; ?>

</div>


