<div class="ayuda container">
    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "CLIENTE"): ?>
        <h1>Módulo cliente: Historial de compras / ventas </h1> 
        <!-- Grid de productos -->
        <div class="container">
            <h3>Compras On-Line realizadas</h3>
            <div class="row"> 
                <!-- idcompras	fecha	estadoCompra	idproductos	nombre	precio -->
                <?php while ($com = $comprasCliente->fetch_object()): ?>

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

                <?php endwhile; ?> 

            </div> 
            <h3>Compras presenciales realizadas</h3>
            <div class="row"> 
                <!-- idcompras	fecha	estadoCompra	idproductos	nombre	precio -->
                <?php while ($vent = $ventasCliente->fetch_object()): ?>

                    <div id_product="<?= $vent->idventas ?>" class="card m-2" style="width: 18rem;">
                         <div class="card-body">  
                            <h5 class="card-title"><?= $vent->fecha ?></h5>
                            <div style="height: 100px; overflow-y: scroll" class="my-4">
                                <?= $vent->detalle?>
                            </div> 
                            <h6 class="card-title text-success">$ <?= number_format($vent->valor) ?></h6>    

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

