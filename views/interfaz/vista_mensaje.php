<div class="ayuda container">

    <?php if (isset($_SESSION['registro'])): ?>
        <h1>Cuenta creada exitosamente</h1>
        <h3><?php $_SESSION['registro'] ?></h3>
        <a class="btn btn-primary" href="http://localhost/Inmuebles-Herrera/cliente/registro">Volver a registro</a>
        <a class="btn btn-primary" href="http://localhost/Inmuebles-Herrera/cliente/iniciar">Iniciar sesión</a>
    <?php endif; ?>
        
        <h1>NO</h1>

</div>

