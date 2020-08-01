<div class="ayuda container">
    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "ADMINISTRADOR"): ?>
        <h1>Módulo administrador: Gestión de ventas / compras</h1>

        <div id="accordion">

            <div class="card"> 

                <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Ventas presenciales
                        </button>
                    </h5>
                </div>

                <!-- Acordion de ventas -->
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body"> 
                        <div class="table-responsive-md">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Fecha venta</th>
                                        <th scope="col">Valor</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Precio Prod.</th>
                                        <th scope="col">Imagen de producto</th>
                                        <th scope="col">Vendedor</th>
                                        <th scope="col">Cliente</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($v = $listadoVentas->fetch_object()): ?>
                                        <tr> 
                                            <td><?= $v->fecha ?></td>
                                            <td>$ <?= number_format($v->valor) ?></td>
                                            <td><?= $v->nombre ?></td> 
                                            <td>$ <?= number_format($v->precio) ?></td> 
                                            <td>
                                                <img src="http://localhost/Inmuebles-Herrera/uploads/images/<?= $v->imagenPrincipal ?>" height="40" alt="rack"/>
                                            </td>
                                            <td>
                                                <a href="http://localhost/Inmuebles-Herrera/vendedor/detalleVendedor&id=<?= $v->vendID ?>" title="Ver vendedor">
                                                    <strong><?= $v->rutvend ?></strong> 
                                                </a>
                                            </td> 
                                            <td>
                                                <a href="http://localhost/Inmuebles-Herrera/cliente/verCliente&id=<?= $v->cliID ?>"  title="Ver cliente">
                                                    <strong><?= $v->rutcli ?></strong>
                                                </a>
                                            </td>
                                        </tr> 
                                    <?php endwhile; ?> 
                                </tbody>
                            </table>
                        </div>

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

<div class="modal fade" id="eliminarVendedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

