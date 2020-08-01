<div class="ayuda container">
    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "CLIENTE"): ?>

        <?php if (isset($_SESSION['DETALLECOMP']['ERR'])): ?>
            <div class="alert alert-danger" role="alert">
                <strong><?= $_SESSION['DETALLECOMP']['ERR'] ?></strong> 
            </div>
        <?php else: ?>

            <h1>Módulo cliente: detalle de compra</h1> 
            <!-- Grid de productos -->
            <div class="container"> 

                <div class="row">
                    <div class="table-responsive">
                        <h3>Productos comprados</h3>
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Cant. P. Comprados</th>
                                    <th scope="col">Nombre de producto</th>
                                    <th scope="col">Detalle</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Imagen de producto</th>
                                </tr>
                            </thead>  
                            <tbody>
                                <?php while ($l = $listadoProductos->fetch_object()): ?>
                                    <tr>
                                        <td><?= $l->total ?></td>
                                        <td>
                                            <a href="http://localhost/Inmuebles-Herrera/producto/verproducto&id=<?= $l->idproductos ?>">
                                                <?= $l->nombre ?>
                                            </a>
                                        </td>
                                        <td>
                                            <div style="overflow-y: scroll; width: 380px; height: 80px;">
                                                <?= $l->caracteristicas ?>
                                            </div>
                                        </td>
                                        <td>$ <?= number_format($l->precio) ?></td>
                                        <td>
                                            <img width="50" src="http://localhost/Inmuebles-Herrera/uploads/images/<?= $l->imagenPrincipal ?>">
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

