<div class="ayuda container">
    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "ADMINISTRADOR"): ?>
        <h1>Módulo administrador: Modificar turno</h1>


        <?php if (isset($_SESSION['TURMOD']['ERR'])): ?>
            <div class="alert alert-danger" role="alert">
                <strong><?= $_SESSION['TURMOD']['ERR'] ?></strong>
            </div>
        <?php else: ?>

            <form action="http://localhost/Inmuebles-Herrera/turno/modificarTurno&id=<?= $t->idturnos ?>" method="POST"> 
                <div class="form-group">
                    <label for="txt-nom">Nombre</label>
                    <input type="text" class="form-control" value="<?= $t->nombre ?>" id="txt-nom" name="txt-nom" placeholder="Ingrese nombre">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="txt-nom">Fecha inicio</label>
                        <input type="date" class="form-control" value="<?= $fechaINI ?>" id="txt-fecha-ini" name="txt-fecha-ini" placeholder="Ingrese fecha de inicio">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txt-rut">Hora de inicio</label>
                        <input type="time" class="form-control" value="<?= $horaINI ?>" id="time-ini" name="time-ini" placeholder="Ingrese fecha de termino">
                    </div>
                </div> 
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="txt-nom">Fecha Termini</label>
                        <input type="date" class="form-control" value="<?= $fechaTER ?>" id="txt-fecha-ter" name="txt-fecha-ter" placeholder="Ingrese fecha de inicio">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txt-rut">Hora de termino</label>
                        <input type="time" class="form-control" value="<?= $horaTER ?>" id="time-ter" name="time-ter" placeholder="Ingrese fecha de termino">
                    </div>
                </div> 

                <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" class="custom-control-input" id="customCheck1" name="customCheck1" checked="true">
                    <label class="custom-control-label" for="customCheck1">Activar turno</label>
                </div> 

                <button type="submit" class="btn btn-primary">Modificar</button>
                <button type="reset" class="btn btn-secondary">Limpiar</button>
                <a href="http://localhost/Inmuebles-Herrera/turno/inicio" class="btn btn-danger">Cancelar</a> 
            </form>

        <?php endif; ?> 
        <?php Utils::borrarSessionNombre('TURMOD', 'ERR') ?>

    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            <strong>Usted no tiene acceso a este contenido</strong>
        </div>
    <?php endif; ?>

</div>
