<div class="ayuda container">
    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "ADMINISTRADOR"): ?>
        <h1>Módulo administrador: Gestión de reportes</h1>

        <!-- Acordion general -->
        <div class="accordion" id="acordionReporte">


            <!-- Acordion producto -->
            <div class="card">
                <div class="card-header" id="headingProduct">
                    <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseProduct" aria-expanded="true" aria-controls="collapseOne">
                            Productos
                        </button>
                    </h2>
                </div>

                <div id="collapseProduct" class="collapse show" aria-labelledby="headingProduct" data-parent="#acordionReporte">
                    <div class="card-body"> 

                        <!-- FORMULARIO PARA FILTRAR LOS PRODUCTOS INGRESADOS -->
                        <!--<form action="http://localhost/Inmuebles-Herrera/administrador/filtrarProductos" method="POST">
                            <div class="form-row"> 
                                <div class="form-group col-md-2">
                                    <label for="txt-precio-desde">Precio</label>
                                    <input type="text" class="form-control" id="txt-precio-desde" name="txt-precio-desde" placeholder="Ingrese precio">
                                </div>
 
                                <div class="form-group col-md-2">
                                    <label for="txt-precio-hasta">Precio</label>
                                    <input type="text" class="form-control" id="txt-precio-hasta" name="txt-precio-hasta" placeholder="Ingrese precio">
                                </div>
 
                                <div class="form-group col-md-2">
                                    <label for="select-categ">Categoria</label>
                                    <select class="form-control" id="select-categ" name="select-categ">
                                        <option value="">Seleccione</option>
                                        <?php while ($c = $cats->fetch_object()): ?>
                                            <option value="<?= $c->categoria ?>">
                                                <?= $c->categoria ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div> 
 
                                <div class="form-group col-md-2">
                                    <label for="select-categ">Estado</label>
                                    <select class="form-control" id="select-estado" name="select-estado">
                                        <option value="">Seleccione</option>
                                        <?php while ($e = $ests->fetch_object()): ?>
                                            <option value="<?= $e->estado ?>">
                                                <?= $e->estado ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div> 

                            </div> -->

                            <!-- <button type="submit" class="btn btn-primary mb-3">Filtrar</button> -->
                            <!-- <button type="reset" class="btn btn-secondary mb-3">Quitar</button> -->

                            <a id="btn-prod-pdf" class="pdf btn btn-danger mb-3" data-toggle="modal" data-target="#pdfModel"
                               href="http://localhost/Inmuebles-Herrera/reporte/reporteProductos">
                                Obtener reporte<i class="fas fa-file-pdf ml-2"></i>
                            </a>

                        </form> 
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

                    </div>
                </div>
            </div>

            <!-- Acordion proveedores -->
            <div class="card">
                <div class="card-header" id="headingProvee">
                    <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseProvee" aria-expanded="true" aria-controls="collapseOne">
                            Proveedores
                        </button>
                    </h2>
                </div>

                <div id="collapseProvee" class="collapse show" aria-labelledby="headingProvee" data-parent="#acordionReporte">
                    <div class="card-body">


                        <a id="btn-prov-pdf" class="pdf btn btn-danger mb-3" data-toggle="modal" data-target="#pdfModel"
                           href="http://localhost/Inmuebles-Herrera/reporte/reportesProveedores">
                            Obtener reporte<i class="fas fa-file-pdf ml-2"></i>
                        </a>

                        <div class="table-responsive-md">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th> 
                                        <th scope="col">Rut</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Apellidos</th>
                                        <th scope="col">Nombre compañia</th>
                                        <th scope="col">Logo</th>
                                        <th scope="col">Correo</th>
                                        <th scope="col">Dirección</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php while ($pr = $prov->fetch_object()): ?>
                                        <tr>
                                            <th scope="row"><?= $pr->idproveedores ?></th>
                                            <td><?= $pr->rut ?></td>
                                            <td><?= $pr->nombre ?></td>
                                            <td><?= $pr->apellido_p . " " . $pr->apellido_m ?></td>
                                            <td><?= $pr->nombreCompañia ?></td>
                                            <td>
                                                <img width="50" src="http://localhost/Inmuebles-Herrera/uploads/users/proveedores/<?= $pr->logoProveedor ?>">
                                            </td>
                                            <td><?= $pr->direccion ?></td>
                                            <td><?= $pr->correo ?></td> 
                                        </tr> 
                                    <?php endwhile; ?> 

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Acordion vendedores -->
            <div class="card">
                <div class="card-header" id="headingVend">
                    <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseVend" 
                                aria-expanded="true" aria-controls="collapseOne">
                            Vendedores
                        </button>
                    </h2>
                </div>

                <div id="collapseVend" class="collapse show" aria-labelledby="headingVend" data-parent="#acordionReporte">
                    <div class="card-body"> 

                        <a id="btn-vend-pdf" class="pdf btn btn-danger mb-3" data-toggle="modal" data-target="#pdfModel"
                           href="http://localhost/Inmuebles-Herrera/reporte/reportesVendedores">
                            Obtener reporte<i class="fas fa-file-pdf ml-2"></i>
                        </a>
                        <div class="table-responsive-md">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th> 
                                        <th scope="col">Rut</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Apellidos</th>
                                        <th scope="col">Fotografia</th>
                                        <th scope="col">Correo</th>
                                    </tr>
                                </thead>
                                <tbody>  
                                    <?php while ($vd = $vend->fetch_object()): ?>
                                        <tr>
                                            <th scope="row"><?= $vd->idvendedores ?></th>
                                            <td><?= $vd->rut ?></td>
                                            <td><?= $vd->nombre ?></td>
                                            <td><?= $vd->apellido_p . " " . $vd->apellido_m ?></td> 
                                            <td>
                                                <img width="50" src="http://localhost/Inmuebles-Herrera/uploads/users/vendedores/<?= $vd->fotografica ?>">
                                            </td> 
                                            <td><?= $vd->correo ?></td> 
                                        </tr> 
                                    <?php endwhile; ?> 
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div><!-- fin acordion ventas -->

            <!-- Acordion ventas -->
            <div class="card">
                <div class="card-header" id="headingVent">
                    <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseVent" aria-expanded="true" aria-controls="collapseOne">
                            Ventas
                        </button>
                    </h2>
                </div>

                <div id="collapseVent" class="collapse show" aria-labelledby="headingVent" data-parent="#acordionReporte">
                    <div class="card-body">  
                        <!--<form>
                            <div class="form-row"> 
                                <div class="form-group col-md-2">
                                    <label for="txt-precio-desde">Desde</label>
                                    <input type="date" class="form-control" id="txt-date-desde" name="txt-date-desde" placeholder="Ingrese fecha">
                                </div>
 
                                <div class="form-group col-md-2">
                                    <label for="txt-precio-hasta">Hasta</label>
                                    <input type="date" class="form-control" id="txt-date-hasta" name="txt-date-hasta" placeholder="Ingrese fecha">
                                </div>

                            </div> 

                            <button type="submit" class="btn btn-primary mb-3">Filtrar</button> 
                            <button type="reset" class="btn btn-secondary mb-3">Quitar</button>
                            
                        </form> -->
                        <a id="btn-vent-pdf" class="pdf btn btn-danger mb-3" data-toggle="modal" data-target="#pdfModel"
                               href="http://localhost/Inmuebles-Herrera/reporte/reportesVentas">
                                Obtener reporte<i class="fas fa-file-pdf ml-2"></i>
                            </a>
                        <div class="table-responsive-md">
                            <table class="table">
                                <!--  	codigo 	 	detalle 	vendedores_idvendedores 	clientes_idclientes  -->
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Detalle</th>
                                        <th scope="col">Valor</th>
                                        <th scope="col">Rut cliente</th>
                                        <th scope="col">Nombre cliente</th>
                                        <th scope="col">Apellidos cliente</th>
                                        <th scope="col">Rut vendedor</th>
                                        <th scope="col">Nombre vendedor</th>
                                        <th scope="col">Apellidos vendedor</th> 
                                    </tr>
                                </thead>
                                <tbody> 
                                    <?php while ($vt = $vent->fetch_object()): ?>
                                        <tr>
                                            <th scope="row"><?= $vt->idventas ?></th>
                                            <td><?= $vt->fecha ?></td>
                                            <td><?= $vt->detalle ?></td>
                                            <td><?= number_format($vt->valor) ?></td> 
                                            <td>
                                                <a><?= $vt->RUTCLI ?></a>
                                            </td>
                                            <td><?= $vt->NOMCLI ?></td>
                                            <td><?= $vt->APEPCLI . ' ' . $vt->APEMCLI ?></td> 
                                            <td>
                                                <a><?= $vt->RUTVEND ?></a>
                                            </td>

                                            <td><?= $vt->NOMVEND ?></td>
                                            <td><?= $vt->APEPVEND . ' ' . $vt->APEMVEND ?></td> 
                                        </tr> 
                                    <?php endwhile; ?> 
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div><!-- fin acordion ventas -->

        </div>

    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            <strong>Usted no tiene acceso a este contenido</strong>
        </div>
    <?php endif; ?>

</div> 
<!-- Modal -->
<div class="modal fade" id="pdfModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Generar reporte .PDF <i class="fas fa-file-pdf ml-2"></i></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="">
                <form id="form-report" action="" method="POST" class="p-4">
                    <div class="form-group">
                        <label for="nom_report">Nombre reporte</label>
                        <input type="text" class="form-control" id="nom_report" name="nom_report" placeholder="Ingrese nombre de reporte">
                    </div> 

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Generar Reporte</button>
            </div>
            </form>  
        </div>
    </div>
</div>