<div class="ayuda container">
    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "CLIENTE"): ?>

        <?php if (isset($_SESSION['MIDETALLE']['ERR'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['MIDETALLE']['ERR'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php else: ?> 
            <h1>Módulo cliente: datos de <?= $p->nombre . " " . $p->apellido_p ?></h1> 
            
            <?php if (isset($_SESSION['CLIUPDATE']['OK'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><?= $_SESSION['CLIUPDATE']['OK'] ?></strong>  
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php elseif (isset($_SESSION['CLIUPDATE']['ERR'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><?= $_SESSION['CLIUPDATE']['ERR'] ?></strong>  
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <?php Utils::borrarSessionNombre('CLIUPDATE', 'OK'); ?>
            <?php Utils::borrarSessionNombre('CLIUPDATE', 'ERR'); ?>

            <!-- Grid de datos de cliete -->
            <div class="container">

                <form class="formu" id="" action="http://localhost/Inmuebles-Herrera/cliente/modificarDatos&id=<?= $p->idclientes ?>" method="POST">  
                    <div class="form-group"> 
                        <input type="text" class="form-control" id="campo_rut" name="campo_rut" placeholder="Ingresa tu rut"
                               value="<?= $p->rut ?>"> 
                    </div>

                    <div class="form-group"> 
                        <input type="text" class="form-control" id="campo_nombre" name="campo_nombre" placeholder="Ingresa tu nombre"
                               value="<?= $p->nombre ?>"> 
                    </div>

                    <div class="form-group"> 
                        <input type="text" class="form-control" id="campo_apellido_p" name="campo_apellido_p" placeholder="Ingresa tu apellido paterno"
                               value="<?= $p->apellido_p ?>"> 
                    </div>

                    <div class="form-group"> 
                        <input type="text" class="form-control" id="campo_apellido_m" name="campo_apellido_m" placeholder="Ingresa tu apellido materno"
                               value="<?= $p->apellido_m ?>"> 
                    </div> 

                    <div class="form-group"> 
                        <input type="text" class="form-control" id="campo_email" name="campo_email" placeholder="Ingresa tu email"
                               value="<?= $p->correo ?>"> 
                    </div>

                    <div class="form-group"> 
                        <input type="password" class="form-control" id="campo_clave" name="campo_clave" placeholder="Ingresa tu contraseña"
                               value="<?= $p->clave ?>">
                    </div>  

                    <input type="submit" value="Actualizar" class="btn btn-success m-2">
                    <input type="reset" value="Limpiar" class="btn btn-primary m-2">
                    <a href="http://localhost/Inmuebles-Herrera/cliente/homeCliente" class="btn btn-danger m-2">Volver</a>
                </form>
            </div> 
        <?php endif; ?>
        <?php Utils::borrarSessionNombre('MIDETALLE', 'ERR') ?>
    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            <strong>Usted no tiene acceso a este contenido</strong>
        </div>
    <?php endif; ?>
</div>