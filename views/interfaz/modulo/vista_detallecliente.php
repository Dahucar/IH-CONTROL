<div class="ayuda container">
    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "ADMINISTRADOR"): ?>

        <?php if (isset($_SESSION['DETALLECLI']['ERR'])): ?>
            <div class="alert alert-danger" role="alert">
                <strong><?= $_SESSION['DETALLECLI']['ERR'] ?></strong>  
            </div>
        <?php else: ?> 

            <h1>Módulo administrador: Detalle cliente <?= $p->nombre . " " . $p->apellido_p ?></h1> 

            <!-- Grid de productos --> 
            <h3>Compras On-Line realizadas</h3> 

            <div class="table-responsive-xl">
                <table class="table mt-3">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th> 
                            <th scope="col">Fecha</th>
                            <th scope="col">Estado</th>
                            <th scope="col">nombre</th>
                            <th scope="col">precio</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php while ($c = $compras->fetch_object()): ?>

                            <tr> 
                                <td><?= $c->idcompras ?></td>
                                <td><?= $c->fecha ?></td>
                                <td><?= $c->estadoCompra ?></td>
                                <td><?= $c->nombre ?></td>
                                <td>$ <?= number_format($c->precio) ?></td>
                            </tr> 

                        <?php endwhile; ?>

                    </tbody>
                </table> 
            </div> 

            <h3>Compras presenciales realizadas</h3> 

            <div class="table-responsive-xl">
                <table class="table mt-3">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Detalle</th>
                            <th scope="col">Valor compra</th>
                            <th scope="col">Rut vendedor</th>
                            <th scope="col">Nombre producto</th>
                            <th scope="col">Imagen</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php while ($v = $ventas->fetch_object()): ?>

                            <tr>
                                <td><?= $v->idventas ?></td>
                                <td><?= $v->fecha ?></td>
                                <td>
                                    <div style="overflow-y: scroll; width: 300px; height: 80px;">
                                        <p class="justify-content-around">
                                        <?= $v->detalle ?>
                                    </p>
                                    </div> 
                                </td> 
                                <td>$ <?= number_format($v->valor) ?></td>
                                <td>
                                    <a href="http://localhost/Inmuebles-Herrera/vendedor/detalleVendedor&id=<?=$v->idvendedores?>"><?= $v->rut ?></a>
                                </td>
                                <td><?= $v->nombre ?></td>
                                <td>
                                    <img src="http://localhost/Inmuebles-Herrera/uploads/images/<?= $v->imagenPrincipal ?>" width="45">
                                </td> 
                            </tr>

                        <?php endwhile; ?>

                    </tbody>
                </table> 
            </div> 
        <?php endif; ?> 
        <?php Utils::borrarSessionNombre('DETALLECLI', 'ERR'); ?> 

    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            <strong>Usted no tiene acceso a este contenido</strong>
        </div>
    <?php endif; ?>
</div>

