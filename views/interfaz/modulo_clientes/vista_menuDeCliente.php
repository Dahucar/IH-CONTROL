<div class="ayuda container">
    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "CLIENTE"): ?>
        <h1>Módulo cliente </h1> 

        <div class="btn-group">
            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Acciones
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="http://localhost/Inmuebles-Herrera/cliente/misDatos&id=<?= $_SESSION['IDENTIDAD']->idclientes ?>">
                    Modificar mis datos
                </a>   

                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="http://localhost/Inmuebles-Herrera/cliente/historial">
                    Ver historial de compras / ventas.
                </a> 
            </div>
        </div>

        <!-- Grid de productos -->
        <div class="container">

            <h3>Compras pendientes.</h3>

            <div class="row"> 
                <!-- idcompras	fecha	estadoCompra	idproductos	nombre	precio -->
                <?php while ($com = $comprasCliente->fetch_object()): ?>

                    <?php if ($com->estadoCompra == 'PENDIENTE'): ?>
                        <div id_product="<?= $com->idcompras ?>" class="card m-2" style="width: 18rem;">
                            <div class="card-body">  
                                <h5 class="card-title"><?= $com->fecha ?></h5>
                                <h6 class="card-title">
                                    <?php if ($com->estadoCompra == "PENDIENTE"): ?>
                                        <p class="text-warning"><?= $com->estadoCompra ?></p>
                                        <?php elseif ($com->estadoCompra == "RECHAZADO"): ?>
                                        <p class="text-danger"><?= $com->estadoCompra ?></p>
                                        <?php elseif ($com->estadoCompra == "ACEPTADO"): ?>
                                        <p class="text-success"><?= $com->estadoCompra ?></p>
                                    <?php endif; ?>
                                </h6> 
                                <h6 class="card-title text-success">$ <?= number_format($com->valorCompra) ?></h6>   
                                <a class="btn btn-primary" 
                                   href="http://localhost/Inmuebles-Herrera/compra/detalleCompraCliente&id=<?= $com->idcompras ?>">
                                    <i class="ico-btn fas fa-eye"></i>
                                </a> 

                            </div>
                        </div>
                    <?php endif; ?>

                <?php endwhile; ?> 

            </div> 
        </div> 
    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            <strong>Usted no tiene acceso a este contenido</strong>
        </div>
    <?php endif; ?>
</div>

