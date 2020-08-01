<div class="formulario container">

    <?php if (!isset($_SESSION['IDENTIDAD'])): ?>
        <?php if (isset($_SESSION['ERR-LOGIN'])): ?>

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['ERR-LOGIN'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

        <?php endif; ?>

        <?php Utils::borrarSession() ?>

        <form class="formu" action="http://localhost/Inmuebles-Herrera/usuario/ingresar" method="post"> 

            <h2>Inicia Sesión.</h2>

            <div class="form-group"> 
                <input type="text" class="form-control" id="campo_email" name="campo_email" placeholder="Ingresa tu email"> 
            </div>

            <div class="form-group"> 
                <input type="password" class="form-control" id="campo_clave" name="campo_clave" placeholder="Ingresa tu contraseña">
            </div>  

            <select class="form-control" id="campo_modoacceso" name="campo_modoacceso">
                <option>Seleccione como ingresar</option>
                <option>Administrador</option> 
                <option>Proveedor</option> 
                <option>Vendedor</option>  
                <option>Cliente</option> 
            </select> 

            <button type="submit" class="btn btn-success m-2">Iniciar</button>
            <button type="reset" class="btn btn-primary m-2">Limpiar</button>

        </form>

    <?php else: ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong>Usted ya tiene su sesión iniciada</strong>  
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

</div>
