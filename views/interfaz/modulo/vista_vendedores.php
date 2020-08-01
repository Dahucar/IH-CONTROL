<div class="ayuda container">
    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "ADMINISTRADOR"): ?>
        <h1>Módulo administrador: Gestión de vendedores</h1>

        <?php if (isset($_SESSION['VENTDEL']['OK'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['VENTDEL']['OK'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif (isset($_SESSION['VENTDEL']['ERR'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['VENTDEL']['ERR'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php Utils::borrarSessionNombre('VENTDEL', 'OK'); ?>
        <?php Utils::borrarSessionNombre('VENTDEL', 'ERR'); ?>

        <?php if (isset($_SESSION['VENTUPDATE']['OK'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['VENTUPDATE']['OK'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif (isset($_SESSION['VENTUPDATE']['ERR'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['VENTUPDATE']['ERR'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php Utils::borrarSessionNombre('VENTUPDATE', 'OK'); ?>
        <?php Utils::borrarSessionNombre('VENTUPDATE', 'ERR'); ?>
        
        <?php if (isset($_SESSION['ASIGTV']['OK'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['ASIGTV']['OK'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif (isset($_SESSION['ASIGTV']['ERR'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['ASIGTV']['ERR'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php Utils::borrarSessionNombre('ASIGTV', 'OK'); ?>
        <?php Utils::borrarSessionNombre('ASIGTV', 'ERR'); ?>

        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Acciones disponibles
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="http://localhost/Inmuebles-Herrera/vendedor/nuevovendedor">Agregar vendedor</a>  
            </div> 
        </div> 

        <!-- Grid de productos -->
        <div class="container">
            <div class="row">  

                <?php while ($v = $vent->fetch_object()): ?>

                    <!-- vendedores -->
                    <div id_product="<?= $v->idvendedores ?>" class="card m-2" style="width: 18rem;">
                        <img class="card-img-top" src="http://localhost/Inmuebles-Herrera/uploads/users/vendedores/<?= $v->fotografica ?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title" style="height: 30px;"><?= $v->nombre . ' ' . $v->apellido_p ?></h5> 
                            <h6 class="mt-4"> <?= $v->rut ?> </h6>
                            <!-- BOTON VER -->
                            <a class="btn btn-primary" href="http://localhost/Inmuebles-Herrera/vendedor/detalleVendedor&id=<?= $v->idvendedores ?>">
                                <i class="ico-btn fas fa-eye"></i>
                            </a>

                            <!-- BOTON EDITAR -->
                            <a class="btn btn-primary" href="http://localhost/Inmuebles-Herrera/vendedor/modificarVendedor&id=<?= $v->idvendedores ?>">
                                <i class="ico-btn fas fa-marker"></i>
                            </a>

                            <!-- BOTON ELIMINAR -->
                            <a id="btnDelvent" class="btn btn-primary" href="" data-toggle="modal" data-target="#mpeliminar">
                                <i class="ico-btn fas fa-trash-alt"></i>
                            </a>

                            <!-- BOTON TURNO -->
                            <a class="btn btn-primary" href="http://localhost/Inmuebles-Herrera/turno/asignarturno&id=<?= $v->idvendedores ?>">
                                <i class="ico-btn fas fa-calendar-day"></i>
                            </a>


                        </div>
                    </div> 

                <?php endwhile; ?> 

            </div> 
        </div>

        <div class="modal fade" id="mpeliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar registro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>¿Desea eliminar el registro seleccionado?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button> 
                        <a id="btnDelVendedor" class="btn btn-primary" href="">Eliminar</a>
                    </div>
                </div>
            </div>
        </div>

    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            <strong>Usted no tiene acceso a este contenido</strong>
        </div>
    <?php endif; ?>
</div>

