<div class="ayuda container">
    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "ADMINISTRADOR"): ?>
        <h1>Módulo administrador: Agregar alerta</h1>

        <?php if (isset($_SESSION['ALERTADD']['OK'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['ALERTADD']['OK'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif (isset($_SESSION['ALERTADD']['ERR'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['ALERTADD']['ERR'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php Utils::borrarSessionNombre('ALERTADD','ERR') ?>
        <?php Utils::borrarSessionNombre('ALERTADD','OK') ?>

        <form action="http://localhost/Inmuebles-Herrera/alerta/agregar" method="POST"> 
            <div class="form-group">
                <label data-error="wrong" data-success="right" for="txt-asunto">Asunto</label>
                <input type="text" class="form-control" id="txt-asunto" name="txt-asunto" placeholder="Ingrese asunto">
            </div>
            <div class="form-group">
                <label data-error="wrong" data-success="right" for="txt-mensaje">Mensaje</label>
                <textarea type="text" id="txt-mensaje" name="txt-mensaje" class="md-textarea form-control" rows="4"></textarea>
            </div> 

            <div class="table-responsive-md">
                <table class="table" id="TablaReportProduct">
                    <thead class="thead-dark">
                        <tr>     
                            <th scope="col">Seleccionar</th>
                            <th scope="col">Nombres</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Correo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($ad = $listado->fetch_object()): ?>
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="selectAdm[]" id="selectAdm<?= $ad->idadministrador?>" value="<?= $ad->idadministrador?>">
                                        <label class="custom-control-label" for="selectAdm<?= $ad->idadministrador?>">Seleccionar</label>
                                    </div>
                                </td>
                                <td><?= $ad->nombre ?></td>
                                <td><?= $ad->apellido_p .' '. $ad->apellido_m ?></td>
                                <td><?= $ad->correo ?></td>
                            </tr>
                        <?php endwhile; ?> 
                    </tbody>
                </table>
            </div>

            <button type="submit" class="btn btn-primary">Agregar</button>
            <button type="reset" class="btn btn-secondary">Limpiar</button>
        </form>

    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            <strong>Usted no tiene acceso a este contenido</strong>
        </div>
    <?php endif; ?>

</div>
