<div class="ayuda container">
    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "ADMINISTRADOR"): ?>

        <?php if (isset($_SESSION['DETALLEPROV']['ERR'])): ?>
            <div class="alert alert-danger" role="alert">
                <strong><?= $_SESSION['DETALLEPROV']['ERR'] ?></strong> 
            </div>
        <?php else: ?>

            <h1>Módulo administrador: Detalle de proveedor</h1>

            <!-- Grid de productos -->
            <div class="container"> 

                <div class="row"> 

                    <!-- proveedor -->
                    <div class="row">
                        <div class="card mb-3 ml-4" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="http://localhost/Inmuebles-Herrera/uploads/users/proveedores/<?= $pro->logoProveedor ?>" class="card-img m-3" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body"> 
                                        <p class="card-text">
                                            <strong>RUT:        </strong> <?= $pro->rut ?> <br>
                                            <strong>Nombre:     </strong> <?= $pro->nombre ?> <br>
                                            <strong>Apellidos:   </strong> <?= $pro->apellido_p . " " . $pro->apellido_m ?> <br>
                                            <strong>Compañia:   </strong> <?= $pro->nombreCompañia ?> <br>
                                            <strong>Correo:     </strong> <?= $pro->correo ?> 
                                        </p> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  

                </div> 

                <div class="row">
                    <div class="table-responsive">
                        <h3>Pedidos concretados.</h3>
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Cant. P</th>
                                    <th scope="col">Precio Unitario</th>
                                    <th scope="col">Precio tatal</th>
                                    <th scope="col">Estado de pedido</th>
                                    <th scope="col">Fecha de solicitud</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($l = $listado->fetch_object()):?>
                                    <tr>
                                        <td><?= $l->cantidadProdcutos ?></td>
                                        <td>$ <?= number_format($l->precioUnitario) ?></td>
                                        <td>$ <?= number_format($l->precioTotal) ?></td>
                                        <td><?= $l->estadoPedido ?></td>
                                        <td><?= $l->fechaSolicitud ?></td>
                                    </tr>
                                <?php endwhile; ?> 
                            </tbody>
                        </table>
                    </div>
                </div>

            </div> 

        <?php endif; ?>
    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            <strong>Usted no tiene acceso a este contenido</strong>
        </div>
    <?php endif; ?>
</div>