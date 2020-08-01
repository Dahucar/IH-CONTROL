<div class="formulario container">

    <?php if (!isset($_SESSION['IDENTIDAD'])): ?>

        <?php if (isset($_SESSION['registro']['ok'])): ?>

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['registro']['ok'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

        <?php elseif (isset($_SESSION['registro']['err'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['registro']['err'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?> 
        <?php Utils::borrarSessionNombre('registro', 'err') ?>
        <?php Utils::borrarSessionNombre('registro', 'ok') ?>

        <?php if (isset($_SESSION['CLITEMPREG']['OK'])): ?>

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['CLITEMPREG']['OK'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

        <?php elseif (isset($_SESSION['CLITEMPREG']['ERR'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['CLITEMPREG']['ERR'] ?></strong>  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?> 
        <?php Utils::borrarSessionNombre('CLITEMPREG', 'ERR') ?>
        <?php Utils::borrarSessionNombre('CLITEMPREG', 'OK') ?>

        

        <form class="formu" id="" action="http://localhost/Inmuebles-Herrera/cliente/guardar" method="POST">
            <h2>Crea tu cuenta</h2>

            <div class="form-group"> 
                <input type="text" class="form-control" id="campo_rut" name="campo_rut" placeholder="Ingresa tu rut"> 
            </div>

            <div class="form-group"> 
                <input type="text" class="form-control" id="campo_nombre" name="campo_nombre" placeholder="Ingresa tu nombre"> 
            </div>

            <div class="form-group"> 
                <input type="text" class="form-control" id="campo_apellido_p" name="campo_apellido_p" placeholder="Ingresa tu apellido paterno"> 
            </div>

            <div class="form-group"> 
                <input type="text" class="form-control" id="campo_apellido_m" name="campo_apellido_m" placeholder="Ingresa tu apellido materno"> 
            </div> 

            <div class="form-group"> 
                <input type="text" class="form-control" id="campo_email" name="campo_email" placeholder="Ingresa tu email"> 
            </div>

            <div class="form-group"> 
                <input type="password" class="form-control" id="campo_clave" name="campo_clave" placeholder="Ingresa tu contraseña">
            </div>  

            <input type="submit" value="Registrar" class="btn btn-success m-2">
            <input type="reset" value="Limpiar" class="btn btn-primary m-2">

        </form>

    <?php else: ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong>Usted ya esta registrado en el sistema.</strong>  
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

</div>



