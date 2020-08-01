<div class="ayuda container">

    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "ADMINISTRADOR"): ?>

        <h1>Módulo administrador: Gestión de productos</h1>
        
        <?php if (isset($_SESSION['DEL']['OK'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['DEL']['OK'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif (isset($_SESSION['DEL']['ERR'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['DEL']['ERR'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php Utils::borrarSessionProductos() ?>

        <?php if (isset($_SESSION['MODIFICAR-FINAL']['OK'])): ?>
                <div class="alert alert-success" role="alert">
                    <strong><?= $_SESSION['MODIFICAR-FINAL']['OK'] ?></strong>  
                </div>
        <?php elseif (isset($_SESSION['MODIFICAR-FINAL']['ERR'])): ?>
                <div class="alert alert-danger" role="alert">
                    <strong><?= $_SESSION['MODIFICAR-FINAL']['ERR'] ?></strong>  
                </div>
        <?php endif; ?> 
        <?php Utils::borrarSessionNombre('MODIFICAR-FINAL', 'ERR'); ?>
        <?php Utils::borrarSessionNombre('MODIFICAR-FINAL', 'OK'); ?>

        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Acciones disponibles
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="http://localhost/Inmuebles-Herrera/producto/nuevoproducto">Agregar productos</a>  
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="http://localhost/Inmuebles-Herrera/pedido/nuevopedido">Hacer pedido</a>  
            </div> 
        </div>

        <!-- Grid de productos -->
        <div class="container">
            <div class="row"> 

                <!-- Cargando el listado de productos -->
                <?php while ($p = $pro->fetch_object()): ?>

                    <!-- productos  'cantidad'-->
                    <div id_producto="<?= $p->idproductos?>" class="card m-2" style="width: 18rem;">
                        <img class="card-img-top" style="height: 300px;" src="http://localhost/Inmuebles-Herrera/uploads/images/<?= $p->imagenPrincipal ?>" alt="Card image cap">
                        <div class="card-body">
                            <div style="height: 30px;">
                                <h5 class="card-title"><?= $p->nombre ?></h5> 
                            </div>

                            <div class="mt-3">
                                <?php if($p->cantidad >= $p->cantidadMax): ?>
                                    <p class="text-warning">
                                        <strong>Cantidad (x<?=$p->cantidad?>)</strong>
                                    </p>
                                <?php elseif($p->cantidad < $p->cantidadMax && $p->cantidad > $p->cantidadMin): ?>
                                    <p class="text-success">
                                        <strong>Cantidad (x<?=$p->cantidad?>)</strong>
                                    </p>
                                <?php elseif($p->cantidad < 5 && $p->cantidadMin >= 0): ?>
                                    <p class="text-danger">
                                        <strong>Cantidad (x<?=$p->cantidad?>)</strong>
                                    </p>
                                <?php endif; ?> 
                            </div>

                            <div style="height: 100px; overflow-y: scroll" class="my-4">
                                <?= $p->caracteristicas?>
                            </div>
                                    <!-- 
                            <a href="http://localhost/Inmuebles-Herrera/categoria/eliminarCategoria&id=<?= $p->idproductos ?>" class="btn btn-primary btn-verProducto" >
                                <i class="ico-btn fas fa-eye"></i>
                            </a> -->

                            <a href="http://localhost/Inmuebles-Herrera/producto/modificar&id=<?= $p->idproductos ?>" class="btn btn-primary btn-modProducto">
                                <i class="ico-btn fas fa-marker"></i>
                            </a> 

                            <a id="btn-delProucto" href="" class="btn btn-primary btn-delProucto" data-toggle="modal" data-target="#mpeliminar">
                                <i class="ico-btn fas fa-trash"></i> 
                            </a> 

                        </div>
                    </div> 

                <?php endwhile; ?>  

            </div> 
        </div>

    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            <strong>Usted no tiene acceso a este contenido</strong>
        </div>
    <?php endif; ?>

</div>

<!-- Modal -->
<div class="modal fade" id="mpeliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar un registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>¿Desea eliminar el registro seleccionado?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <a id="confirmar-delPro" class="btn btn-primary" href="">Eliminar</a>
            </div>
        </div>
    </div>
</div>