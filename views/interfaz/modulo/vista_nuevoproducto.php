<div class="ayuda container">

    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "ADMINISTRADOR"): ?>

        <h1>Módulo administrador: Agregar nuevo producto</h1>
        <!-- 	idproductos 	codigo 	nombre 	caracteristicas 	precio 	cantidad 	categoria_producto_idcategoria_producto   -->

        <?php if (isset($_SESSION['ADD']['OK'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['ADD']['OK'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif (isset($_SESSION['ADD']['ERR'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['ADD']['ERR'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php Utils::borrarSession(); ?>

        <form action="http://localhost/Inmuebles-Herrera/producto/agregar" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="txt-nom">Nombre</label>
                <input type="text" class="form-control" id="txt-nom" name="txt-nom" placeholder="Ingrese nombre">
            </div>
            <div class="form-group">
                <label data-error="wrong" data-success="right" for="txt-caracte">Caracteristica</label>
                <textarea type="text" id="txt-caracte" name="txt-caracte" class="md-textarea form-control" rows="4"></textarea>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="txt-cod">Precio producto</label>
                    <input type="text" class="form-control" id="txt-prec" name="txt-prec" placeholder="Ingrese precio">
                </div> 
                <div class="form-group col-md-2">
                    <label for="txt-cod">Cantidad</label>
                    <input type="number" class="form-control" id="txt-cant" name="txt-cant" placeholder="Ingrese cantidad">
                </div> 
                <div class="form-group col-md-2">
                    <label for="txt-cod">Cantidad Max.</label>
                    <input type="number" class="form-control" id="txt-cantMax" name="txt-cantMax" placeholder="Ingrese cantidad máxima">
                </div>
                <div class="form-group col-md-2">
                    <label for="txt-cod">Cantidad Min.</label>
                    <input type="number" class="form-control" id="txt-cantMin" name="txt-cantMin" placeholder="Ingrese cantidad minima">
                </div>
            </div>  

            <div class="custom-file">
                <input type="file" class="custom-file-input" id="img-pro" name="img-pro" lang="es">
                <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label data-error="wrong" data-success="right" for="txt-categ-model">Categoria</label>
                    <select class="form-control" id="select-categ" name="select-categ">
                        <option value="Seleccione" >Seleccione</option>
                        <?php while ($ct = $cats->fetch_object()): ?>
                            <option value="<?= $ct->idcategoria_producto ?>" >
                                <?= $ct->categoria ?>
                            </option> 
                        <?php endwhile; ?>
                    </select>
                </div> 
                <div class="form-group col-md-6">
                    <label data-error="wrong" data-success="right" for="txt-categ-model">Estado</label>
                    <select class="form-control" id="select-est" name="select-est">
                        <option value="Seleccione" >Seleccione</option>

                        <?php while ($est = $ests->fetch_object()): ?>
                            <option value="<?= $est->idestados ?>" >
                                <?= $est->estado ?>
                            </option> 
                        <?php endwhile; ?>  
                    </select>
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
