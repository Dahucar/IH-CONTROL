<div class="ayuda container">
    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "ADMINISTRADOR"): ?>
        <h1>Módulo administrador: Hacer pedido</h1>
       
        <?php if (isset($_SESSION['PEDIDOADD']['OK'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['PEDIDOADD']['OK'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif (isset($_SESSION['PEDIDOADD']['ERR'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['PEDIDOADD']['ERR'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php Utils::borrarSessionNombre('PEDIDOADD','OK')?>
        <?php Utils::borrarSessionNombre('PEDIDOADD','ERR')?>
        
        
        <form action="http://localhost/Inmuebles-Herrera/pedido/agregarPedido" method="POST">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="txt-cod">Cantidad productos</label>
                    <input type="number" class="form-control" id="txt_cand" name="txt_cand" placeholder="Ingrese cantidad">
                </div> 
                <div class="form-group col-md-6">
                    <label for="txt-cod">Precio unitario</label>
                    <input type="number" class="form-control" id="txt_precUni" name="txt_precUni" placeholder="Precio unitario">
                </div>  
            </div>  
            <div class="form-group">
                <label data-error="wrong" data-success="right" for="txt-detalle">Detalle de solicitud</label>
                <textarea type="text" id="txt_detalle" name="txt_detalle" class="md-textarea form-control" rows="4"></textarea>
            </div> 
            <div class=" md-form mb-3">
                <label data-error="wrong" data-success="right" for="txt-categ-model">Seleccionar proveedores</label>
                <select class="form-control" id="select-provee" name="select-provee">
                    <option value="" >Seleccione</option>

                    <?php while ($p = $listado->fetch_object()): ?>
                        <option value="<?= $p->idproveedores ?>"><?= $p->nombre . " " . $p->apellido_p . " " . $p->apellido_m ?></option>
                    <?php endwhile; ?>

                </select>
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
