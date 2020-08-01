<div class="ayuda container">
    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "VENDEDOR"): ?>
        <h1>Módulo vendedores: mis ventas</h1> 

        <div class="btn-group">
            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Acciones
            </button>
            <div class="dropdown-menu">  

                <a class="dropdown-item" href="http://localhost/Inmuebles-Herrera/vendedor/misturnos&id=<?=$_SESSION['IDENTIDAD']->idvendedores?>">
                    Ver mis turnos
                </a> 
            </div>
        </div>

        <!-- Grid de productos --> 
 

            <div class="table-responsive-md mt-2">
                <table class="table" id="TablaReportProduct">
                    <thead class="thead-dark">
                        <!-- TITULARES DE PRODUCTOS -->
                        <tr>    
                            <th scope="col">Fecha</th> 
                            <th scope="col">Detalle</th>
                            <th scope="col">Valor</th>  
                        </tr>
                    </thead>
                    <tbody>
                                    <!-- PRODUCTOS ENCONTRADOS -->
                        <?php while ($p = $listVend->fetch_object()): ?>

                            <tr>
                                <th scope="row"><?= $p->fecha ?></th>  
                                <td>
                                    <div style="overflow-y: scroll; height: 100px;">
                                        <?= $p->detalle ?>
                                    </div>
                                </td>
                                <td><?= number_format($p->valor) ?></td> 
                            </tr>
                        <?php endwhile; ?>   
                    </tbody> 
                </table> 
            </div> 
    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            <strong>Usted no tiene acceso a este contenido</strong>
        </div>
    <?php endif; ?>
</div>


