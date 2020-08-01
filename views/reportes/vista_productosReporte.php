<div class="table-responsive-md">
    <table class="table" id="TablaReportProduct">
        <thead class="thead-dark">
            <!-- TITULARES DE PRODUCTOS -->
            <tr>    
                <th scope="col">#</th>
                <th scope="col">Código</th>
                <th scope="col">Nombre</th>
                <th scope="col">Detalle</th>
                <th scope="col">Precio</th>
                <th scope="col">Stock</th>
                <th scope="col">Imagen principal</th>
                <th scope="col">Estado</th>
                <th scope="col">Categoría</th>
            </tr>
        </thead>
        <tbody>
            <!-- PRODUCTOS ENCONTRADOS -->
            <?php while ($p = $pro->fetch_object()): ?>

                <tr>
                    <th scope="row"><?= $p->idproductos ?></th> 
                    <td><?= $p->codigo ?></td>
                    <td><?= $p->nombre ?></td>
                    <td>
                        <div style="overflow-y: scroll; height: 100px;">
                            <?= $p->caracteristicas ?>
                        </div>
                    </td>
                    <td><?= number_format($p->precio) ?></td>
                    <td><?= $p->cantidad ?></td>
                    <td>
                        <img src="http://localhost/Inmuebles-Herrera/uploads/images/<?= $p->imagenPrincipal ?>" width="50">
                    </td>
                    <td><?= $p->estado ?></td>
                    <td><?= $p->categoria ?></td>
                </tr> 

            <?php endwhile; ?> 

        </tbody>
    </table>
</div>