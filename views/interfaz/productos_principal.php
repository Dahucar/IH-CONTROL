<!-- Portfolio Section-->

<div class="ayuda container">  

    <h2>Nuestros productos.</h2>

    <!-- Portfolio Grid Items-->
    <div class="row">
        <!-- Portfolio Item 1-->  
 

        <?php while ($p = $listadoFinal->fetch_object()): ?>  

            <div class="card m-2" style="width: 16rem;">
                <img class="card-img-top" style="height: 250px;" src="http://localhost/Inmuebles-Herrera/uploads/images/<?= $p->imagenPrincipal ?>" alt="Card image cap">
                <div class="card-body"> 
                    <div style="height: 30px;">
                        <h5 class="card-title"><?= $p->nombre ?></h5> 
                    </div>
                    <h3 class="text-primary mt-4">
                        <strong>$ <?= number_format($p->precio) ?></strong>
                    </h3>

                    <a class="btn btn-primary" href="http://localhost/Inmuebles-Herrera/producto/verproducto&id=<?= $p->idproductos ?>"><i class="ico-btn fas fa-eye"></i></a>   

                    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "VENDEDOR"): ?>
                        <a class="btn btn-primary" href="http://localhost/Inmuebles-Herrera/venta/agregarCesta&id=<?= $p->idproductos ?>">
                            <i class="ico-btn fas fa-plus-circle"></i>
                        </a> 
                    <?php else: ?>
                        <a class="btn btn-primary" href="http://localhost/Inmuebles-Herrera/carrocompra/agregarCarro&id=<?= $p->idproductos ?>">
                            <i class="ico-btn fas fa-plus-circle"></i>
                        </a>
                    <?php endif; ?> 
                </div>
            </div> 

        <?php endwhile; ?>   
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php $pagination->render();?>
        </div> 
    </div>
</div>

