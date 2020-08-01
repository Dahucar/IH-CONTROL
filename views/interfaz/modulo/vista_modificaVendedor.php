<div class="ayuda container">
    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "ADMINISTRADOR"): ?>

        <?php if (isset($_SESSION['MODIFICAR']['ERR'])): ?>
            <div class="alert alert-danger" role="alert">
                <strong><?= $_SESSION['MODIFICAR']['ERR'] ?></strong>
            </div>
        <?php else: ?>

            <h1>Módulo administrador: Modificar vendedor/a <?= $vt->nombre . ' ' . $vt->apellido_p ?></h1>  

            <form action="http://localhost/Inmuebles-Herrera/vendedor/modificar&id=<?= $vt->idvendedores ?>" method="POST" enctype="multipart/form-data">
                <div class="form-row"> 
                    <div class="form-group col-md-6">
                        <label for="txt-rut">Rut vendedor</label>
                        <input type="text" class="form-control" id="txt-rut" name="txt-rut" placeholder="Ingrese rut"
                               value="<?= $vt->rut ?>">
                    </div>
                </div> 
                <div class="form-group">
                    <label for="txt-nom">Nombre vendedor</label>
                    <input type="text" class="form-control" id="txt-nom" name="txt-nom" placeholder="Ingrese nombre"
                           value="<?= $vt->nombre ?>">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="txt-ape-p">Apellido paterno vendedor</label>
                        <input type="text" class="form-control" id="txt-ape-p" name="txt-ape-p" placeholder="Ingrese apellido paterno"
                               value="<?= $vt->apellido_p ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txt-ape-m">Apellido materno vendedor</label>
                        <input type="text" class="form-control" id="txt-ape-m" name="txt-ape-m" placeholder="Ingrese apellido materno"
                               value="<?= $vt->apellido_m ?>">
                    </div>
                </div>
                <div class="custom-file"> 
                    <input type="file" class="custom-file-input" id="img-pro" name="img-pro" lang="es">
                    <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label> 
                </div>
                <div class="form-row"> 
                    <div class="form-group col-md-6 my-2">  
                        <img src="http://localhost/Inmuebles-Herrera/uploads/users/vendedores/<?= $vt->fotografica ?>" alt="Imagen actual de producto" class="img-thumbnail">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="txt-correo">Correo</label>
                        <input type="text" class="form-control" id="txt-correo" name="txt-correo" placeholder="Ingrese correo de vendedor"
                               value="<?= $vt->correo ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txt-pass">Clave</label>
                        <input type="password" class="form-control" id="txt-pass" name="txt-pass" placeholder="Ingrese apellido materno"
                               value="<?= $vt->clave ?>">
                    </div> 
                </div>
                <button type="submit" class="btn btn-primary">Modificar</button>
                <button type="reset" class="btn btn-secondary">Limpiar</button>
                <a href="http://localhost/Inmuebles-Herrera/vendedor/vendedores" class="btn btn-danger">Cancelar</a>
            </form>
        <?php endif; ?>
        <?php Utils::borrarSessionNombre('MODIFICAR', 'ERR') ?>
    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            <strong>Usted no tiene acceso a este contenido</strong>
        </div>
    <?php endif; ?>
</div>