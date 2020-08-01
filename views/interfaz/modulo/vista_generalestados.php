<div class="ayuda container">

    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "ADMINISTRADOR"): ?>
        <h1>Módulo administrador: Gestión de estados</h1>

        <?php if (isset($_SESSION['ESTADO']['SUCCESS'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['ESTADO']['SUCCESS'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif (isset($_SESSION['ESTADO']['ERR'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['ESTADO']['ERR'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?> 
        <?php Utils::borrarSession() ?>

        <form action="http://localhost/Inmuebles-Herrera/estado/guardar" method="POST">
            <div class="form-group">
                <label for="txt-nom">Nombre</label>
                <input type="text" class="form-control" id="txt-nom" name="txt-nom" placeholder="Ingrese nombre">
            </div> 

            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="reset" class="btn btn-secondary">Limpiar</button>
        </form>

        <div class="table-responsive-md">
            <h3 class="mt-3">Estados añadidos</h3>
            <table class="table">
                <thead class="thead-dark"> 
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Código</th>
                        <th scope="col">Nombre Estado</th> 
                        <th scope="col">Acciones</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php while ($est = $estados->fetch_object()): ?>

                        <tr id_producto="<?= $est->idestados ?>">
                            <td><?= $est->idestados ?></td>
                            <td><?= $est->codigo ?></td>
                            <td><?= $est->estado ?></td>
                            <td>
                                
                                <a id="btn-eliminar" href="http://localhost/Inmuebles-Herrera/categoria/eliminarCategoria&id=<?= $est->idestados ?>" class="btn btn-primary btn-delEstado" data-toggle="modal" data-target="#delEstado">
                                    <i class="fas fa-trash"></i> 
                                </a> 

                            </td>
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

<!-- Modal -->
<div class="modal fade" id="delEstado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a id="confirmar-delEstado" class="btn btn-primary" href="">Eliminar</a>
      </div>
    </div>
  </div>
</div>
