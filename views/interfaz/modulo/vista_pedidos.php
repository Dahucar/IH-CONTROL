<div class="ayuda container">

    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "ADMINISTRADOR"): ?>
        <h1>Módulo administrador: Registro de pedidos </h1>

        <?php if (isset($_SESSION['DELPED']['OK'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['DELPED']['OK'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif (isset($_SESSION['DELPED']['ERR'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['DELPED']['ERR'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php Utils::borrarSessionNombre('DELPED', 'OK'); ?>
        <?php Utils::borrarSessionNombre('DELPED', 'ERR'); ?>

        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Acciones disponibles
            </button>
            <div class="dropdown-menu"> 
                <a class="dropdown-item" href="http://localhost/Inmuebles-Herrera/pedido/nuevopedido">Hacer pedido</a>  
            </div> 
        </div>

        <!-- Grid de productos -->

        <!-- 	idpedido 	codigo 	cantidadProdcutos 	precioUnitario 	precioTotal 	detalleSolicitud 	estadoPedido 	fechaSolicitud 	proveedores_idproveedores 	administrador_idadministrador  -->
        <div class="table-responsive-md"> 
            <table class="table mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Cant.Productos </th>
                        <th scope="col">Prec. Unitario</th>
                        <th scope="col">Prec. Total</th> 
                        <th scope="col">Detalle</th> 
                        <th scope="col">Estado</th> 
                        <th scope="col">Fecha Solicitud</th> 
                        <th scope="col">Rut Provee.</th> 
                        <th scope="col">Nombre Provee.</th> 
                        <th scope="col">Apellidos Provee.</th>
                        <th scope="col">Correo Provee.</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($p = $pedidos->fetch_object()): ?>
                        <tr id_pedido="<?= $p->idpedido ?>">
                            <th scope="row"><?= $p->idpedido ?></th>
                            <td><?= $p->cantidadProdcutos ?></td>
                            <td><?= $p->precioUnitario ?> CLP</td>
                            <td><?= $p->precioTotal ?> CLP</td>
                            <td>
                                <div style="overflow-y: scroll; height: 100px;">        
                                    <?= $p->detalleSolicitud ?>
                                </div>
                            </td>
                            <td><?= $p->estadoPedido ?></td>
                            <td><?= $p->fechaSolicitud ?></td>
                            <td><?= $p->rut ?></td>
                            <td><?= $p->nombre ?></td>
                            <td><?= $p->apellido_p . " " . $p->apellido_m ?></td>
                            <td><?= $p->correo ?></td>
                            <th> 
                                <a id="btn-delPedido" href="" class="btn btn-primary"
                                   data-toggle="modal" data-target="#delPedido">
                                    <i class="ico-btn fas fa-trash"></i> 
                                </a> 
                            </th>
                        </tr> 
                    <?php endwhile; ?>

                </tbody>
            </table>
        </div>

        <div class="modal fade" id="delPedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a id="confirmDelPedido" class="btn btn-primary" href="">Eliminar</a>
                    </div>
                </div>
            </div>
        </div>

    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            <strong>Usted no tiene acceso a este contenido</strong>
        </div>
    <?php endif; ?>
</div>