<div class="ayuda container">

    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "ADMINISTRADOR"): ?>
        <h1>Módulo administrador: Gestión de categorias</h1>



        <?php if (isset($_SESSION['ADD-CATEGORIA']['OK'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['ADD-CATEGORIA']['OK'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif (isset($_SESSION['ADD-CATEGORIA']['ERR'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['ADD-CATEGORIA']['ERR'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif (isset($_SESSION['REMOVE-CATEG']['CAT-DELETE'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['REMOVE-CATEG']['CAT-DELETE'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif (isset($_SESSION['REMOVE-CATEG']['ERR-DELETE'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['REMOVE-CATEG']['ERR-DELETE'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?> 
        <?php Utils::borrarSession() ?>

        <form action="http://localhost/Inmuebles-Herrera/categoria/agregarCategoria" method="POST">
            <div class="form-group">
                <label for="txt-nom">Nombre</label>
                <input type="text" class="form-control" id="txt-nom" name="txt-nom" placeholder="Ingrese nombre">
            </div> 

            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="reset" class="btn btn-secondary">Limpiar</button>
        </form>

        <div class="table-responsive-md">
            <h3 class="mt-3">Categorías añadidas</h3>
            <table class="table">
                <thead class="thead-dark"> 
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Código</th>
                        <th scope="col">Nombre Categoría</th> 
                        <th scope="col">Acciones</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php while ($cat = $result_cat->fetch_object()): ?>

                        <tr id_producto="<?= $cat->idcategoria_producto ?>">
                            <td><?= $cat->idcategoria_producto ?></td>
                            <td><?= $cat->codigo ?></td>
                            <td><?= $cat->categoria ?></td>
                            <td>  
                                
<!--                                <a id="btn-eliminar" href="http://localhost/Inmuebles-Herrera/categoria/eliminarCategoria&id=<?= $cat->idcategoria_producto ?>" class="btn btn-primary">
                                    <i class="fas fa-trash"></i> 
                                </a>-->
                                
                                <a id="btn-eliminar" href="http://localhost/Inmuebles-Herrera/categoria/eliminarCategoria&id=<?= $cat->idcategoria_producto ?>" class="btn btn-primary btn-eliminar" data-toggle="modal" data-target="#exampleModal">
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <a id="confirmar-eliminar" class="btn btn-primary" href="">Eliminar</a>
      </div>
    </div>
  </div>
</div>




