<div class="ayuda container">

    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "ADMINISTRADOR"): ?>
        <h1>Módulo administrador: Agregar nuevo proveedor</h1>
        <?php if (isset($_SESSION['ADDPROD']['OK'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['ADDPROD']['OK'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif (isset($_SESSION['ADDPROD']['ERR'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?=$_SESSION['ADDPROD']['ERR'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php Utils::borrarSessionNombre('ADDPROD', 'ERR'); ?>
        <?php Utils::borrarSessionNombre('ADDPROD', 'OK'); ?>

        <form action="http://localhost/Inmuebles-Herrera/proveedor/agregar" method="POST" >
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="campo_rut">RUT</label>
                    <input type="text" class="form-control" id="campo_rut" name="campo_rut" placeholder="Ingrese rut">
                </div>
            </div>
            <div class="form-group">
                <label data-error="wrong" data-success="right" for="campo_nombre">Nombre</label>
                <input type="text" class="form-control" id="campo_nombre" name="campo_nombre" placeholder="Ingrese nombre">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label data-error="wrong" data-success="right" for="campo_ppaterno">Apellido paterno</label>
                    <input type="text" class="form-control" id="campo_ppaterno" name="campo_ppaterno" placeholder="Ingrese apellido paterno">
                </div> 
                <div class="form-group col-md-6">
                    <label data-error="wrong" data-success="right" for="campo_pmaterno">Apellido materno</label>
                    <input type="text" class="form-control" id="campo_pmaterno" name="campo_pmaterno" placeholder="Ingrese apellido materno">
                </div> 
            </div>  
            <div class="form-group">
                <label data-error="wrong" data-success="right" for="campo_nomCompañia">Nombre compañia</label>
                <input type="text" class="form-control" id="campo_nomCompañia" name="campo_nomCompañia" placeholder="Ingrese nombre compañia">
            </div> 
            <div class="form-group">
                <label data-error="wrong" data-success="right" for="campo_direccion">Dirección</label>
                <input type="text" class="form-control" id="campo_direccion" name="campo_direccion" placeholder="Ingrese dirección">
            </div> 
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label data-error="wrong" data-success="right" for="campo_mail">Correo</label>
                    <input type="text" class="form-control" id="campo_mail" name="campo_mail" placeholder="Ingrese correo">
                </div> 
                <div class="form-group col-md-6">
                    <label data-error="wrong" data-success="right" for="campo_clave">Clave</label>
                    <input type="password" class="form-control" id="campo_clave" name="campo_clave" placeholder="Ingrese clave">
                </div> 
            </div>  

            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="reset" class="btn btn-secondary">Limpiar</button>
        </form>


    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            <strong>Usted no tiene acceso a este contenido</strong>
        </div>
    <?php endif; ?>
</div>