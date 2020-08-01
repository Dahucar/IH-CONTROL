<div class="ayuda container"> 

    <?php if (isset($_SESSION['VERPRODUCTO']['ERR'])): ?>
        <div class="alert alert-danger" role="alert">
            <strong><?= $_SESSION['VERPRODUCTO']['ERR'] ?></strong>  
        </div>
    <?php else: ?> 
        <h1>Producto: <?= $p->nombre ?></h1> 

        <!-- contenedor de tarjetas -->
        <div class="row"> 
            <div class="card m-2 col-md-6" style="width: 30rem;">
                <img class="card-img-top" style="height: 380px;" 
                src="http://localhost/Inmuebles-Herrera/uploads/images/<?= $p->imagenPrincipal ?>" 
                alt="Imagen de producto">
            </div>  

            <div class="card m-2 col-md-5" style="width: 30rem;">
                <div class="card-body">
                    <h5 class="card-title"><?= $p->nombre ?></h5>
                    <p class="card-text">
                        <strong>X <?= $p->cantidad ?></strong>
                    </p>
                    <h3 class="text-primary mt-4">
                        <strong>$ <?= number_format($p->precio) ?></strong>
                    </h3>

                    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "VENDEDOR"): ?>
                        <a href="http://localhost/Inmuebles-Herrera/venta/agregarCesta&id= <?= $p->idproductos ?>" class="btn btn-primary">Añadir a mi cesta de ventas</a>
                    <?php else: ?>
                        <a href="http://localhost/Inmuebles-Herrera/carrocompra/agregarCarro&id=<?= $p->idproductos ?>" class="btn btn-primary">Añadir al carro</a>
                    <?php endif; ?>


                </div>
            </div>
            <div class="card m-2 col-11">
                <h3>Cracteristicas de producto</h3>
                <div class="card-body" style="text-align: justify;">
                    <?= $p->caracteristicas ?>
                </div>
            </div>


        </div>  

    <?php endif; ?> 
    <?php Utils::borrarSessionNombre('VERPRODUCTO', 'ERR'); ?> 
</div>
