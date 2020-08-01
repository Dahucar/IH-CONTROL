<div class="ayuda container">

    <?php if (isset($_SESSION['COMPRA']['OK'])): ?>
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading"><?= $_SESSION['COMPRA']['OK'] ?></h4>
            <p>
                Para finalizar su compra y retirar sus productos debe realizar un deposito en la siguiente cuenta <strong>20354357</strong>
            <h5>Hasta que no efectue el deposito su compra estara pendiente y podra ser eliminada por un administrativo</h5>
            </p>
            <hr>
            <p class="mb-0">Usted puede revisar sus compras desde <a href="http://localhost/Inmuebles-Herrera/cliente/historial">aqui</a></p>
        </div>
    <?php elseif (isset($_SESSION['COMPRA']['ERR'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><?= $_SESSION['COMPRA']['ERR'] ?></strong>  
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
    <?php Utils::borrarSessionNombre('COMPRA', 'OK') ?> 
    <?php Utils::borrarSessionNombre('COMPRA', 'ERR') ?> 

    <?php if (isset($_SESSION['CARROCOMPRA']) && count($_SESSION['CARROCOMPRA']) >= 1): ?>
        <h1>Carro de compras: mis productos</h1>

        <?php if (isset($_SESSION['LIMITECARRO']['OK'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['LIMITECARRO']['OK'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?> 
        <?php Utils::borrarSessionNombre('LIMITECARRO', 'OK') ?> 

        <div class="container">  
            <div class="table-responsive-md">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Nombre producto</th>
                            <th scope="col">Fotografía</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Cant. Productos</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($carro as $i => $elementoCarro):
                            $p = $elementoCarro['producto'];
                            ?>

                            <tr id_cesta_p="<?= $p->idproductos ?>">

                                <th scope="row">
                                    <a href="http://localhost/Inmuebles-Herrera/producto/verproducto&id=<?= $p->idproductos ?>">
                                        <?= $p->nombre ?>
                                    </a>
                                </th>
                                <td>
                                    <img style="height: 40px;" src="http://localhost/Inmuebles-Herrera/uploads/images/<?= $p->imagenPrincipal ?>" class="img-fluid" alt="Responsive image">
                                </td>
                                <td><?= number_format($p->precio) ?></td>
                                <td> 
                                    <?= $elementoCarro['unidades'] ?> 
                                </td> 
                                <td>
                                    <a id="btn-delPedido" class="btn btn-primary"
                                       href="http://localhost/Inmuebles-Herrera/carroCompra/quitarCarro&index=<?= $i ?>">
                                        <i class="ico-btn fas fa-trash"></i> 
                                    </a> 
                                </td>
                            </tr> 
                        <?php endforeach; ?>  
                        <?php $estadisticas = Utils::estadisticasCarro(); ?>
                        <tr class="table-secondary">
                            <th scope="col">
                                <h3>Total</h3>
                            </th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">
                                <h3><?= number_format($estadisticas['total']); ?></h3>
                            </th> 
                        </tr>
                    </tbody>  
                    </tbody>
                </table> 
                <a href="http://localhost/Inmuebles-Herrera/carroCompra/totalizar" class="btn btn-success">Totalizar carro</a>
                <a href="http://localhost/Inmuebles-Herrera/carroCompra/limpiarCarro" class="btn btn-danger">Vaciar carro</a>
            </div>

        </div>
    <?php else: ?>
        <div class="alert alert-success" role="alert">
            <strong>Su carro de compras no tiene productos añaddidos.</strong>
        </div>
    <?php endif; ?>
</div>
