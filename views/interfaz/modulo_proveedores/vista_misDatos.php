<div class="ayuda container">

    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "PROVEEDOR"): ?>
        <h1>Módulo administrador: modificar proveedor <?= $p->nombre . ' ' . $p->apellido_p ?></h1>  
        
        <?php if (isset($_SESSION['UPDATEPROVEE']['OK'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['UPDATEPROVEE']['OK'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif (isset($_SESSION['UPDATEPROVEE']['ERR'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?=$_SESSION['UPDATEPROVEE']['ERR'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php Utils::borrarSessionNombre('UPDATEPROVEE', 'ERR'); ?>
        <?php Utils::borrarSessionNombre('UPDATEPROVEE', 'OK'); ?>

        <form action="http://localhost/Inmuebles-Herrera/proveedor/modificar&idp=<?= $p->idproveedores ?>" method="POST" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="campo_rut">RUT</label>
                    <input type="text" class="form-control" id="campo_rut" name="campo_rut" placeholder="Ingrese rut"
                           value="<?= $p->rut ?>">
                </div>
            </div>
            <div class="form-group">
                <label data-error="wrong" data-success="right" for="campo_nombre">Nombre</label>
                <input type="text" class="form-control" id="campo_nombre" name="campo_nombre" placeholder="Ingrese nombre"
                       value="<?= $p->nombre ?>">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label data-error="wrong" data-success="right" for="campo_ppaterno">Apellido paterno</label>
                    <input type="text" class="form-control" id="campo_ppaterno" name="campo_ppaterno" placeholder="Ingrese apellido paterno"
                           value="<?= $p->apellido_p ?>">
                </div> 
                <div class="form-group col-md-6">
                    <label data-error="wrong" data-success="right" for="campo_pmaterno">Apellido materno</label>
                    <input type="text" class="form-control" id="campo_pmaterno" name="campo_pmaterno" placeholder="Ingrese apellido materno"
                           value="<?= $p->apellido_m ?>">
                </div> 
            </div>  
            <div class="form-group">
                <label data-error="wrong" data-success="right" for="campo_nomCompañia">Nombre compañia</label>
                <input type="text" class="form-control" id="campo_nomCompañia" name="campo_nomCompañia" placeholder="Ingrese nombre compañia"
                       value="<?= $p->nombreCompañia ?>">
            </div> 
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="img-pro" name="img-pro" lang="es">
                <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
            </div>
            <div class="form-group">
                <label data-error="wrong" data-success="right" for="campo_direccion">Dirección</label>
                <input type="text" class="form-control" id="campo_direccion" name="campo_direccion" placeholder="Ingrese dirección"
                       value="<?= $p->direccion ?>">
            </div> 
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label data-error="wrong" data-success="right" for="campo_mail">Correo</label>
                    <input type="text" class="form-control" id="campo_mail" name="campo_mail" placeholder="Ingrese correo" 
                           value="<?= $p->correo ?>">
                </div> 
                <div class="form-group col-md-6">
                    <label data-error="wrong" data-success="right" for="campo_clave">Clave</label>
                    <input type="password" class="form-control" id="campo_clave" name="campo_clave" placeholder="Ingrese nueva clave"
                           value="<?= $p->clave ?>">
                </div> 
            </div>  

            <button type="submit" class="btn btn-primary">Actualizar datos</button>
            <button type="reset" class="btn btn-secondary">Limpiar</button>
            <a class="btn btn-danger" href="http://localhost/Inmuebles-Herrera/proveedor/inicioProveedores">Cancelar</a>
        </form>


    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            <strong>Usted no tiene acceso a este contenido</strong>
        </div>
    <?php endif; ?>
</div>