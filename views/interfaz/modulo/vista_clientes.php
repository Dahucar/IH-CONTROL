<div class="ayuda container">
    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "ADMINISTRADOR"): ?>
        <h1>Módulo administrador: Gestión clientes</h1>

        <!-- Grid de productos -->
        <div class="container">
            <div class="row"> 


                <?php while ($v = $todos->fetch_object()): ?>
                    <!-- idclientes`, `codigo`, `rut`, `nombre`, `apellido_p`, `apellido_m`, `rol`, `correo`, `clave` -->
                    <div id_product="<?= $v->idclientes ?>" class="card m-2" style="width: 18rem;">
                        <img class="card-img-top" src="http://localhost/Inmuebles-Herrera/assets/img/portfolio/cabin.png" alt="Card image cap">
                        <div class="card-body">

                            <h5 class="card-title"><?= $v->nombre . " " . $v->apellido_p ?></h5> 
                            <h6 class="card-title"><?= $v->rut ?></h6> 
                            <a class="btn btn-primary" href="http://localhost/Inmuebles-Herrera/cliente/verCliente&id=<?= $v->idclientes ?>"><i class="ico-btn fas fa-eye"></i></a> 

                        </div>
                    </div>
                <?php endwhile; ?>


            </div> 
        </div> 
    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            <strong>Usted no tiene acceso a este contenido</strong>
        </div>
    <?php endif; ?>
</div>

