<div class="ayuda container">
    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "ADMINISTRADOR"): ?>

        <?php if (isset($_SESSION['MODIFICAR']['ERR'])): ?>
            <div class="alert alert-danger" role="alert">
                <strong><?= $_SESSION['MODIFICAR']['ERR'] ?></strong>
            </div>
        <?php else: ?>

            <h1>Módulo administrador: Detalle de vendedor <?= $v->nombre . ' ' . $v->apellido_p ?></h1>

            <!-- Grid de productos -->
            <div class="container"> 

                <div class="row"> 

                    <!-- proveedor -->
                    <div class="row">
                        <div class="card mb-3 ml-4" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="http://localhost/Inmuebles-Herrera/uploads/users/vendedores/<?= $v->fotografica ?>" class="card-img m-3" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <h3>Datos de vendedor</h3>
                                    <div class="card-body"> 
                                        <p class="card-text">
                                            <strong>RUT:        </strong> <?= $v->rut ?> <br>
                                            <strong>Nombre:     </strong> <?= $v->nombre ?> <br>
                                            <strong>Apellidos:   </strong> <?= $v->apellido_p . ' ' . $v->apellido_m ?> <br>
                                            <strong>Correo:   </strong> <?= $v->correo ?> <br> 
                                        </p> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  

                </div> 

                <div class="row">
                    <h3>Ventas realizadas</h3>
                    <div class="table-responsive-sm">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Detalle</th>
                                    <th scope="col">Valor</th>
                                    <th scope="col">Rut cliente</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php while ($vent = $listadoVentas->fetch_object()): ?>

                                    <tr>
                                        <td><?= $vent->fecha ?></td>
                                        <td>
                                            <!--<div style="overflow-y: scroll; width: 100px; height: 40px;">-->
                                            <?= $vent->detalle ?>
                                            <!--</div>-->
                                        </td>
                                        <td>$ <?= number_format($vent->valor) ?></td>
                                        <td>
                                            <a href="http://localhost/Inmuebles-Herrera/cliente/verCliente&id=<?= $vent->idclientes ?>"><?= $vent->rut ?></a>
                                        </td>
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
