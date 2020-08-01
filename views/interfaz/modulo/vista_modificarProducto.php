<div class="ayuda container">

    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "ADMINISTRADOR"): ?>

        <?php if (isset($_SESSION['MODIFICAR']['ERR'])): ?>
            <div class="alert alert-danger" role="alert">
                <strong><?= $_SESSION['MODIFICAR']['ERR'] ?></strong>  
            </div>
        <?php else: ?> 

            <h1>Módulo administrador: Modificar producto <?= $p->nombre ?></h1>

            <?php if (isset($_SESSION['MODIFICAR-FINAL']['OK'])): ?>
                <div class="alert alert-danger" role="alert">
                    <strong><?= $_SESSION['MODIFICAR-FINAL']['OK'] ?></strong>  
                </div>
            <?php elseif (isset($_SESSION['MODIFICAR-FINAL']['ERR'])): ?>
                <div class="alert alert-danger" role="alert">
                    <strong><?= $_SESSION['MODIFICAR-FINAL']['ERR'] ?></strong>  
                </div>
            <?php endif; ?> 

            <form action="http://localhost/Inmuebles-Herrera/producto/modificarProducto&id=<?= $p->idproductos ?>" method="POST" enctype="multipart/form-data" >
                <div class="form-group">
                    <label for="txt-nom">Nombre</label>
                    <input type="text" class="form-control" id="txt-nom" name="txt-nom" placeholder="Ingrese nombre"
                           value="<?= $p->nombre ?>">
                </div>
                <div class="form-group">
                    <label data-error="wrong" data-success="right" for="txt-caracte">Caracteristica</label>
                    <textarea type="text" id="txt-caracte" name="txt-caracte" class="md-textarea form-control" rows="4">
                        <?= $p->caracteristicas ?>
                    </textarea>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="txt-cod">Precio producto</label>
                        <input type="text" class="form-control" id="txt-prec" name="txt-prec" placeholder="Ingrese precio" value="<?= $p->precio ?>">
                    </div> 
                    <div class="form-group col-md-2">
                        <label for="txt-cod">Cantidad</label>
                        <input type="number" class="form-control" id="txt-cant" name="txt-cant" placeholder="Ingrese cantidad" value="<?= $p->cantidad ?>">
                    </div> 
                    <div class="form-group col-md-2">
                        <label for="txt-cod">Cantidad Max.</label>
                        <input type="number" class="form-control" id="txt-cantMax" name="txt-cantMax" placeholder="Ingrese cantidad máxima" value="<?= $p->cantidadMax ?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="txt-cod">Cantidad Min.</label>
                        <input type="number" class="form-control" id="txt-cantMin" name="txt-cantMin" placeholder="Ingrese cantidad minima" value="<?= $p->cantidadMin ?>">
                    </div>
                </div>  

                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="img-pro" name="img-pro" lang="es">
                    <label class="custom-file-label" for="customFileLang">Seleccionar nuevo archivo</label>
                </div>

                <div class="form-row"> 
                    <div class="form-group col-md-6 my-2">  
                        <img src="http://localhost/Inmuebles-Herrera/uploads/images/<?= $p->imagenPrincipal ?>" alt="Imagen actual de producto" class="img-thumbnail">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label data-error="wrong" data-success="right" for="txt-categ-model">Categoria</label>
                        <select class="form-control" id="select-categ" name="select-categ">
                            <option value="Seleccione" >Seleccione</option>

                            <?php while ($ct = $cats->fetch_object()): ?>
                                <option value="<?= $ct->idcategoria_producto ?>" 
                                        <?= $ct->idcategoria_producto == $p->categoria_producto_idcategoria_producto ? 'selected' : '' ?> >
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
                                <option value="<?= $est->idestados ?>" 
                                        <?= $est->idestados == $p->estados_idestados ? 'selected' : '' ?>>
                                            <?= $est->estado ?>
                                </option> 
                            <?php endwhile; ?>  

                        </select>
                    </div> 
                </div> 

                <button type="submit" class="btn btn-primary">Modificar datos</button>
                <button type="reset" class="btn btn-secondary">Limpiar</button>
                <a class="btn btn-danger" href="http://localhost/Inmuebles-Herrera/producto/productos">Cancelar</a>
            </form>
        <?php endif; ?> 
        <?php Utils::borrarSessionNombre('MODIFICAR', 'ERR'); ?>
        <?php Utils::borrarSessionNombre('MODIFICAR-FINAL', 'ERR'); ?>
        <?php Utils::borrarSessionNombre('MODIFICAR-FINA', 'ERR'); ?>


    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            <strong>Usted no tiene acceso a este contenido</strong>
        </div>
    <?php endif; ?>
</div>
