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
                        <form action="http://localhost/Inmuebles-Herrera/administrador/filtrarProductos" method="POST">
                            <div class="form-row"> 
                                <div class="form-group col-md-2">
                                    <label for="txt-precio-desde">Precio</label>
                                    <input type="text" class="form-control" id="txt-precio-desde" name="txt-precio-desde" placeholder="Ingrese precio">
                                </div>

                                <!-- precio desde -->
                                <div class="form-group col-md-2">
                                    <label for="txt-precio-hasta">Precio</label>
                                    <input type="text" class="form-control" id="txt-precio-hasta" name="txt-precio-hasta" placeholder="Ingrese precio">
                                </div>

                                <!-- categoria -->
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
                                
                                <!-- estado -->
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

                            </div> 

                            <button type="submit" class="btn btn-primary mb-3">Filtrar</button> 
                            <button type="reset" class="btn btn-secondary mb-3">Quitar</button>
                            <a class="btn btn-info mb-3" href="#">Generar pdf</a>
                        </form> 
                        <div class="table-responsive-md">
                            <table class="table">
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
                                    <!-- idproductos	codigo	nombre	caracteristicas	precio	cantidad	imagenPrincipal	estado	nombre 	 -->
                                        <tr>
                                            <th scope="row"><?= $p->idproductos ?></th> 
                                            <td><?= $p->codigo ?></td>
                                            <td><?= $p->nombre ?></td>
                                            <td><?= $p->caracteristicas ?></td>
                                            <td><?= $p->precio ?></td>
                                            <td><?= $p->cantidad ?></td>
                                            <td><?= $p->imagenPrincipal ?></td>
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

                        <a class="btn btn-info mb-3" href="#">Generar pdf</a>

                        <div class="table-responsive-md">
                            <table class="table">
                                <thead class="thead-dark">
                                    <!--
                                    
            idproveedores 	codigo 	rut 	nombre 	apellido_p 	apellido_m 	
                                    nombreCompañia 	logoProveedor 	direccion 	
                                    correo 	clave 
                                    -->
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Código</th>
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
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
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

                        <a class="btn btn-info mb-3" href="#">Generar pdf</a>
                        <div class="table-responsive-md">

                            <!--
                            
            idvendedores 	codigo 	rut 	nombre 	apellido_p 	apellido_m 	fotografica 	correo 	clave 
                            -->

                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Código</th>
                                        <th scope="col">Rut</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Apellidos</th>
                                        <th scope="col">Fotografia</th>
                                        <th scope="col">Correo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
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

                        <!-- idventas 	codigo 	fecha 	detalle 	vendedores_idvendedores 	clientes_idclientes  -->

                        <form>
                            <div class="form-row"> 
                                <div class="form-group col-md-2">
                                    <label for="txt-precio-desde">Desde</label>
                                    <input type="date" class="form-control" id="txt-date-desde" name="txt-date-desde" placeholder="Ingrese fecha">
                                </div>

                                <!-- precio desde -->
                                <div class="form-group col-md-2">
                                    <label for="txt-precio-hasta">Hasta</label>
                                    <input type="date" class="form-control" id="txt-date-hasta" name="txt-date-hasta" placeholder="Ingrese fecha">
                                </div>

                            </div> 

                            <button type="submit" class="btn btn-primary mb-3">Filtrar</button> 
                            <button type="reset" class="btn btn-secondary mb-3">Quitar</button>
                            <a class="btn btn-info mb-3" href="#">Generar pdf</a>
                        </form> 
                        <div class="table-responsive-md">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Código</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Detalle</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col">Stock</th>
                                        <th scope="col">Categoría</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
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