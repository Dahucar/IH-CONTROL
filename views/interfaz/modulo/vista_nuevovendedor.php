<div class="ayuda container">
    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "ADMINISTRADOR"): ?>

        <h1>Módulo administrador: Agregar nuevo vendedor</h1>

        <?php if (isset($_SESSION['VENTADD']['OK'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['VENTADD']['OK'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif (isset($_SESSION['VENTADD']['ERR'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['VENTADD']['ERR'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php Utils::borrarSessionNombre('VENTADD', 'ERR'); ?>
        <?php Utils::borrarSessionNombre('VENTADD', 'OK'); ?>

        <form action="http://localhost/Inmuebles-Herrera/vendedor/guardar" method="POST" enctype="multipart/form-data">
            <div class="form-row"> 
                <div class="form-group col-md-6">
                    <label for="txt-rut">Rut vendedor</label>
                    <input type="text" class="form-control" id="txt-rut" name="txt-rut" placeholder="Ingrese rut">
                </div>
            </div> 
            <div class="form-group">
                <label for="txt-nom">Nombre vendedor</label>
                <input type="text" class="form-control" id="txt-nom" name="txt-nom" placeholder="Ingrese nombre">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="txt-ape-p">Apellido paterno vendedor</label>
                    <input type="text" class="form-control" id="txt-ape-p" name="txt-ape-p" placeholder="Ingrese apellido paterno">
                </div>
                <div class="form-group col-md-6">
                    <label for="txt-ape-m">Apellido materno vendedor</label>
                    <input type="text" class="form-control" id="txt-ape-m" name="txt-ape-m" placeholder="Ingrese apellido materno">
                </div>
            </div>
            <div class="custom-file"> 
                <input type="file" class="custom-file-input" id="img-pro" name="img-pro" lang="es">
                <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label> 
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="txt-correo">Correo</label>
                    <input type="text" class="form-control" id="txt-correo" name="txt-correo" placeholder="Ingrese correo de vendedor">
                </div>
                <div class="form-group col-md-6">
                    <label for="txt-pass">Clave</label>
                    <input type="password" class="form-control" id="txt-pass" name="txt-pass" placeholder="Ingrese apellido materno">
                </div> 
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
