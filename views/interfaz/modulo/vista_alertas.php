<div class="ayuda container">
    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "ADMINISTRADOR"): ?>
         
        <h1>Módulo administrador: Gestión de alertas</h1>  

        <div class="btn-group">        

            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Acciones disponibles
            </button>

            <div class="dropdown-menu">
                <a class="dropdown-item" href="http://localhost/Inmuebles-Herrera/alerta/nuevaalerta">Agregar alerta</a>   
            </div>  

        </div>

        <h3>Alertas creadas</h3>
        
        
        <?php if (isset($_SESSION['ALERTDEL']['OK'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['ALERTDEL']['OK'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif (isset($_SESSION['ALERTDEL']['ERR'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['ALERTDEL']['ERR'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php Utils::borrarSessionNombre('ALERTDEL','ERR') ?>
        <?php Utils::borrarSessionNombre('ALERTDEL','OK') ?>
        
        <?php if (isset($_SESSION['ALERTUPDATE']['OK'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['ALERTUPDATE']['OK'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif (isset($_SESSION['ALERTUPDATE']['ERR'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['ALERTUPDATE']['ERR'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php Utils::borrarSessionNombre('ALERTUPDATE','ERR') ?>
        <?php Utils::borrarSessionNombre('ALERTUPDATE','OK') ?>
        
        <!-- Grid de productos -->
        <div class="container">
            <div class="row"> 
                
                <?php while ($alt = $alts->fetch_object()):?> 

                    <!-- Alertas -->
                    <div id_product="<?=$alt->idalertas?>" class="card m-2" style="width: 18rem;">
                         <div class="card-body">
                            <div style="height: 50px; overflow-y: scroll">
                                <h5 class="card-title"><?=$alt->asunto?></h5> 
                            </div>

                            <?php if($alt->estadoAlerta == "PENDIENTE"): ?>
                                <p class="text-danger">
                                    <strong><?=$alt->estadoAlerta?></strong> 
                                </p>
                            <?php elseif($alt->estadoAlerta == "ENVIADA"): ?>
                                <p class="text-success">
                                    <strong><?=$alt->estadoAlerta?> : <?=$alt->fecha_envio?></strong> 
                                </p>
                            <?php endif; ?>
                            

                            <div style="height: 100px; overflow-y: scroll" class="my-4">
                                <?= $alt->mensaje?>
                            </div>
                                <!-- 
                            <a href="http://localhost/Inmuebles-Herrera/categoria/eliminarCategoria&id=<?= $alt->idalertas ?>" class="btn btn-primary btn-verProducto" >
                                <i class="ico-btn fas fa-eye"></i>
                            </a> -->

                            <a href="http://localhost/Inmuebles-Herrera/alerta/modificarAlerta&id=<?= $alt->idalertas ?>" class="btn btn-primary btn-modProducto">
                                <i class="ico-btn fas fa-marker"></i>
                            </a> 

                            <a id="btn-delAlets" href="" class="btn btn-primary btn-delProucto" data-toggle="modal" data-target="#eliminarAlets">
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

<div class="modal fade" id="eliminarAlets" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <a id="confirmar-delAlets" class="btn btn-primary" href="">Eliminar</a>
            </div>
        </div>
    </div>
</div>