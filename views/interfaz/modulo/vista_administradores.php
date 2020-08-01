<div class="ayuda container">
    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "ADMINISTRADOR"): ?>
        <h1>Módulo administrador: Gestión de administradores</h1>

        <?php if (isset($_SESSION['MODADM']['OK'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['MODADM']['OK'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif (isset($_SESSION['MODADM']['ERR'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?=$_SESSION['MODADM']['ERR'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?> 
        <?php Utils::borrarSessionNombre('MODADM', 'ERR'); ?>
        <?php Utils::borrarSessionNombre('MODADM', 'OK'); ?>

        <?php if (isset($_SESSION['DELAMD']['OK'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['DELAMD']['OK'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif (isset($_SESSION['DELAMD']['ERR'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?=$_SESSION['DELAMD']['ERR'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php Utils::borrarSessionNombre('DELAMD', 'OK'); ?>
        <?php Utils::borrarSessionNombre('DELAMD', 'ERR'); ?>

        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Acciones disponibles
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="http://localhost/Inmuebles-Herrera/administrador/nuevoAdministrador">Agregar administrador</a>  
            </div> 
        </div>


        <!-- Grid de productos -->
        <div class="container">
            <div class="row"> 

                <!-- Cargando el listado de productos -->
                <?php while ($p = $listado->fetch_object()):?>

                    <!-- proveedor -->
                    <div id_product="<?=$p->idadministrador?>"" class="card m-2" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $p->nombre ." ". $p->apellido_p ?></h5> 
                            <h6><?= $p->rut ?></h6> 
 
                            <a class="btn btn-primary" href="http://localhost/Inmuebles-Herrera/administrador/modificarAdministrador&id=<?=$p->idadministrador?>">
                                 <i class="ico-btn fas fa-marker"></i>
                            </a> 
                            <a id="btndDelAdm" class="btn btn-primary" href="" data-toggle="modal" data-target="#delAdministrador">
                                <i class="ico-btn fas fa-trash-alt"></i>
                            </a>
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

<div class="modal fade" id="delAdministrador" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <a id="delAdm" class="btn btn-primary" href="">Eliminar</a>
            </div>
        </div>
    </div>
</div> 