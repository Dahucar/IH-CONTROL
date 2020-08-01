<div class="ayuda container">

    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "ADMINISTRADOR"): ?>

        <h1>Módulo administrador: Nuevo turno</h1> 

        <?php if (isset($_SESSION['TURNOADD']['OK'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['TURNOADD']['OK'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif (isset($_SESSION['TURNOADD']['ERR'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['TURNOADD']['ERR'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php Utils::borrarSessionNombre('TURNOADD', 'OK'); ?>
        <?php Utils::borrarSessionNombre('TURNOADD', 'ERR'); ?>

        <!-- idturnos 	codigo 	fecha_inicio 	fecha_termino 	estado  -->
        <form action="http://localhost/Inmuebles-Herrera/turno/guardar" method="POST">
            <div class="form-group">
                <label for="txt-nom">Nombre</label>
                <input type="text" class="form-control" id="txt-nom" name="txt-nom" placeholder="Ingrese nombre">
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="txt-nom">Fecha inicio</label>
                    <input type="date" class="form-control" id="txt-fecha-ini" name="txt-fecha-ini" placeholder="Ingrese fecha de inicio">
                </div>
                <div class="form-group col-md-4">
                    <label for="txt-rut">Hora de inicio</label>
                    <input type="time" class="form-control" id="time-ini" name="time-ini" placeholder="Ingrese fecha de termino">
                </div>
            </div> 
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="txt-nom">Fecha Termini</label>
                    <input type="date" class="form-control" id="txt-fecha-ter" name="txt-fecha-ter" placeholder="Ingrese fecha de inicio">
                </div>
                <div class="form-group col-md-4">
                    <label for="txt-rut">Hora de termino</label>
                    <input type="time" class="form-control" id="time-ter" name="time-ter" placeholder="Ingrese fecha de termino">
                </div>
            </div> 

            <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="customCheck1" name="customCheck1" checked="true">
                <label class="custom-control-label" for="customCheck1">Activar turno</label>
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

