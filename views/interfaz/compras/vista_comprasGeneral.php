<div class="ayuda container">
    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "ADMINISTRADOR"): ?>
        <h1>Modulo administrador: Compras realizadas por clientes</h1> 

        <?php if (isset($_SESSION['MODESTADOC']['OK'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['MODESTADOC']['OK'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif (isset($_SESSION['MODESTADOC']['ERR'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['MODESTADOC']['ERR'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php Utils::borrarSessionNombre('MODESTADOC', 'OK'); ?>
        <?php Utils::borrarSessionNombre('MODESTADOC', 'ERR'); ?>

        <div class="table-responsive-md"> 
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Fecha compra</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Estado compra</th> 
                        <th scope="col">Rut cliente</th>  
                        <th scope="col">Productos en compra</th>  
                    </tr>
                </thead>   
                <tbody>
                    <?php while ($com = $listadoCompras->fetch_object()): ?>
                        <tr>
                            <td><?= $com->fecha ?></td>
                            <td>$ <?= number_format($com->valorCompra) ?></td>
                            <td>
                                <?= $com->estadoCompra ?> 

                                <?php if ($com->estadoCompra == "PENDIENTE"): ?>
                                    <a title="Aceptar Compra" class="btn btn-primary" href="http://localhost/Inmuebles-Herrera/compra/actCompra&est=1&id=<?= $com->idcompras ?>">
                                        <i class="ico-btn fas fa-check"></i>  
                                    </a> 

                                    <a title="Rechazar Compra" class="btn btn-danger" href="http://localhost/Inmuebles-Herrera/compra/actCompra&est=2&id=<?= $com->idcompras ?>">
                                        <i class="ico-btn fas fa-times"></i>  
                                    </a> 
                                <?php elseif ($com->estadoCompra == "RECHAZADO"): ?>
                                    <a title="Aceptar Compra" class="btn btn-primary" href="http://localhost/Inmuebles-Herrera/compra/actCompra&est=1&id=<?= $com->idcompras ?>">
                                        <i class="ico-btn fas fa-check"></i>  
                                    </a>
                                <?php elseif ($com->estadoCompra == "ACEPTADO"): ?>
                                    <a title="Rechazar Compra" class="btn btn-danger" href="http://localhost/Inmuebles-Herrera/compra/actCompra&est=2&id=<?= $com->idcompras ?>">
                                        <i class="ico-btn fas fa-times"></i>  
                                    </a> 
                                <?php endif; ?>

                            </td> 
                            <td>
                                <a href="http://localhost/Inmuebles-Herrera/cliente/verCliente&id=<?= $com->idclientes ?>" title="Ver cliente">
                                    <?= $com->rut ?>
                                </a>
                            </td> 
                            <td>
                                <a title="Ver productos en compra" class="btn btn-primary" href="http://localhost/Inmuebles-Herrera/compra/detalleCompra&id=<?= $com->idcompras ?>">
                                    <i class="ico-btn fas fa-luggage-cart"></i>
                                </a> 
                            </td>
                        </tr> 
                    <?php endwhile; ?> 
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            <strong>Usted no tiene acceso a este contenido</strong>
        </div>
    <?php endif; ?>
</div>


