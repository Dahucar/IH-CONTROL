<div class="ayuda container">
    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "VENDEDOR"): ?>

        <?php if (isset($_SESSION['MSGCESTA']['OK'])): ?>
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading"><?= $_SESSION['MSGCESTA']['OK'] ?></h4>
                <p>
                    Usted podra consultar las ventas que ha realizado desde su modulo vendedor 
                    o bien acceder directamente desde <a href="">aqui</a></p>
                </p> 
            </div>
        <?php elseif (isset($_SESSION['MSGCESTA']['ERR'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['MSGCESTA']['ERR'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php Utils::borrarSessionNombre('MSGCESTA', 'OK') ?> 
        <?php Utils::borrarSessionNombre('MSGCESTA', 'ERR') ?>     



        <?php if (isset($_SESSION['CESTA-VENDEDOR']) && count($_SESSION['CESTA-VENDEDOR']) >= 1): ?>
            <h1>Módulo vendedor: cesta de ventas</h1>  
            <!-- Grid de productos --> 
            <?php if (isset($_SESSION['LIMITECESTA']['OK'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><?= $_SESSION['LIMITECESTA']['OK'] ?></strong>  
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?> 
            <?php Utils::borrarSessionNombre('LIMITECESTA', 'OK') ?> 
            
            <?php if (isset($_SESSION['MSGCESTACLI']['RUT'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><?= $_SESSION['MSGCESTACLI']['RUT'] ?></strong>  
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?> 
            <?php Utils::borrarSessionNombre('MSGCESTACLI', 'RUT') ?> 
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Cantidad</th> 
                            <th scope="col">Acción</th> 
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        foreach ($cesta as $i => $elementoCesta):
                            $p = $elementoCesta['producto'];
                            ?>

                            <tr id_cesta_p="<?= $p->idproductos ?>">

                                <th scope="row">
                                    <a href="http://localhost/Inmuebles-Herrera/producto/verproducto&id=<?= $p->idproductos ?>">
                                        <?= $p->nombre ?>
                                    </a>
                                </th>
                                <td>
                                    <img style="height: 40px;" src="http://localhost/Inmuebles-Herrera/uploads/images/<?= $p->imagenPrincipal ?>" class="img-fluid" alt="Responsive image">
                                </td>
                                <td><?= $p->precio ?></td>
                                <td> 
                                    <?= $elementoCesta['unidades'] ?> 
                                </td> 
                                <td>
                                    <a id="btn-delPedido" class="btn btn-primary"
                                       href="http://localhost/Inmuebles-Herrera/venta/eliminarProductoCesta&index=<?= $i ?>">
                                        <i class="ico-btn fas fa-trash"></i> 
                                    </a> 
                                </td>
                            </tr> 
                        <?php endforeach; ?>  
                        <?php $estadisticas = Utils::estadisticasCesta(); ?>
                        <tr class="table-secondary">
                            <th scope="col">
                                <h3>Total</h3>
                            </th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">
                                <h3><?= number_format($estadisticas['total']); ?></h3>
                            </th> 
                        </tr>
                    </tbody>  
                </table>
            </div> 

            <form action="http://localhost/Inmuebles-Herrera/venta/totalizarCesta" method="POST"> 
                <div class="form-group">
                    <label for="campo_rut">Rut Cliente</label>
                    <input type="text" name="campo_rut" id="campo_rut" class="form-control" placeholder="Ingrese rut de cliente">
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="campo_activo" id="campo_activo">
                    <label class="form-check-label" for="campo_activo">¿Cliente nuevo?</label>
                </div>
                <button type="submit" class="btn btn-primary">Totalizar cesta</button>
                <a href="http://localhost/Inmuebles-Herrera/venta/limpiarCesta" class="btn btn-danger">
                    Limpiar cesta
                </a>
            </form>




        <?php else: ?>
            <div class="alert alert-success" role="alert">
                <strong>Su cesta de ventas no tiene producto añadidos</strong>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            <strong>Usted no tiene acceso a este contenido</strong>
        </div>
    <?php endif; ?>
</div>

<div class="modal fade" id="limpiarCesta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmacioón.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>¿Realmente desea eliminar todos los productos de la cesta?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a class="btn btn-primary" href="http://localhost/Inmuebles-Herrera/venta/limpiarCesta">
                    Eliminar
                </a>
            </div>
        </div>
    </div>
</div>
