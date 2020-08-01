<div class="ayuda container">

    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "ADMINISTRADOR"): ?>

        <h1>Módulo administrador: Gestión de turnos</h1> 

        <?php if (isset($_SESSION['TURNODEL']['OK'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['TURNODEL']['OK'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif (isset($_SESSION['TURNODEL']['ERR'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['TURNODEL']['ERR'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php Utils::borrarSessionNombre('TURNODEL', 'OK'); ?>
        <?php Utils::borrarSessionNombre('TURNODEL', 'ERR'); ?>
        
        <?php if (isset($_SESSION['MODTURNO']['OK'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['MODTURNO']['OK'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif (isset($_SESSION['MODTURNO']['ERR'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['MODTURNO']['ERR'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php Utils::borrarSessionNombre('MODTURNO', 'OK'); ?>
        <?php Utils::borrarSessionNombre('MODTURNO', 'ERR'); ?> 
        
        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Acciones disponibles
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="http://localhost/Inmuebles-Herrera/turno/nuevoTurno">Agregar turno</a>    
            </div> 
        </div> 

        <!-- Grid de productos -->
        <div class="container">
            <div class="row">  

                <?php while ($t = $lista->fetch_object()): ?>
                    <!-- productos `idturnos`, `codigo`, `fecha_inicio`, `fecha_termino`, `estado`-->
                    <div id_product="<?= $t->idturnos ?>" class="card m-2" style="width: 18rem;">
                        <div class="card-body">
                            <div style="height: 30px;"> 
                                <h5 class="card-title"><?= $t->nombre ?></h5> 
                            </div>  

                            <div class="mt-5" style="height: 100px; overflow-y: scroll" class="my-4">
                                <strong><?= $t->fecha_inicio ?> A <?= $t->fecha_termino ?> </strong> 
                            </div>

                            <a href="http://localhost/Inmuebles-Herrera/turno/modificar&id=<?= $t->idturnos ?>" class="btn btn-primary btn-modProducto">
                                <i class="ico-btn fas fa-marker"></i>
                            </a> 

                            <a id="btn-delTurno" href="#" class="btn btn-primary btn-delProucto" data-toggle="modal" data-target="#delTur">
                                <i class="ico-btn fas fa-trash"></i> 
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

<!-- Modal -->
<div class="modal fade" id="delTur" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar un registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>¿Desea eliminar el registro seleccionado?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <a id="delTurno" class="btn btn-primary" href="">Eliminar</a>
            </div>
        </div>
    </div>
</div>

