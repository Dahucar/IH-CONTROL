<div class="ayuda container">
    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "PROVEEDOR"): ?>
        <h1>Modulo proveedores: inicio</h1> 

        <?php if (isset($_SESSION['MODESTADO']['OK'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['MODESTADO']['OK'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif (isset($_SESSION['MODESTADO']['ERR'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['MODESTADO']['ERR'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php Utils::borrarSessionNombre('MODESTADO', 'OK'); ?>
        <?php Utils::borrarSessionNombre('MODESTADO', 'ERR'); ?>

        <div class="btn-group">
            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Acción
            </button>
            <div class="dropdown-menu">  

                <a class="dropdown-item" href="http://localhost/Inmuebles-Herrera/proveedor/misDatos">
                    Mis datos
                </a> 
            </div>
        </div>

        <!-- Grid de productos -->
        <div class="container">

            <h3>Solicitudes pendientes</h3>

            <div class="row">  
                <?php if ($listado->num_rows > 0): ?>

                    <?php while ($p = $listado->fetch_object()): ?>
                        <!-- vendedores -->
                        <div class="card m-2" style="width: 18rem;">
                            <div class="card-body"> 
                                <h5 class="card-title"><?= $p->fechaSolicitud ?></h5> 

                                <div style="overflow-y: scroll; height: 100px;">
                                    <?= $p->detalleSolicitud ?>
                                </div>

                                <?php if ($p->estadoPedido == "PENDIENTE"): ?>
                                    <a title="Aceptar Pedido" class="btn btn-primary" href="http://localhost/Inmuebles-Herrera/pedido/actEstadoPed&estPedProv=1&id=<?= $p->idpedido ?>">
                                        <i class="ico-btn fas fa-check"></i>  
                                    </a> 

                                    <a title="Rechazar Pedido" class="btn btn-danger" href="http://localhost/Inmuebles-Herrera/pedido/actEstadoPed&estPedProv=2&id=<?= $p->idpedido ?>">
                                        <i class="ico-btn fas fa-times"></i>  
                                    </a> 
                                <?php elseif ($p->estadoPedido == "RECHAZADO"): ?>
                                    <a title="Aceptar Pedido" class="btn btn-primary" href="http://localhost/Inmuebles-Herrera/pedido/actEstadoPed&estPedProv=1&id=<?= $p->idpedido ?>">
                                        <i class="ico-btn fas fa-check"></i>  
                                    </a>
                                <?php elseif ($p->estadoPedido == "ACEPTADO"): ?>
                                    <a title="Rechazar Pedido" class="btn btn-danger" href="http://localhost/Inmuebles-Herrera/pedido/actEstadoPed&estPedProv=2&id=<?= $p->idpedido ?>">
                                        <i class="ico-btn fas fa-times"></i>  
                                    </a> 
                                <?php endif; ?>

                            </div>
                        </div> 
                    <?php endwhile; ?> 
                <?php else: ?>
                    <div class="alert alert-info" role="alert">
                        <strong>Usted no tiene pedidos por confirmar</strong>
                    </div>
                <?php endif; ?>
            </div> 
        </div> 
    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            <strong>Usted no tiene acceso a este contenido</strong>
        </div>
    <?php endif; ?>
</div>