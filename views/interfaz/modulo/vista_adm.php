<div class="ayuda container">

    <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "ADMINISTRADOR"): ?>

        <h1>Módulo administrador</h1> 

        <!-- Example split danger button -->
        <div class="btn-group">
            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Gestión personas
            </button>
            <div class="dropdown-menu">  

                <a class="dropdown-item" href="http://localhost/Inmuebles-Herrera/administrador/administradores">
                    Gestión de administradores
                </a> 
                
                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="http://localhost/Inmuebles-Herrera/proveedor/proveedores">
                    Gestión de Proveedores
                </a> 

                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="http://localhost/Inmuebles-Herrera/vendedor/vendedores">
                    Gestión de vendedores
                </a> 
                
                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="http://localhost/Inmuebles-Herrera/cliente/clientes">
                    Gestión de Clientes
                </a>  

                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="http://localhost/Inmuebles-Herrera/alerta/alertas">
                    Gestión de Alertas
                </a>  

                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="http://localhost/Inmuebles-Herrera/administrador/reportes">
                    Gestión de Reportes
                </a>  

                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="http://localhost/Inmuebles-Herrera/turno/inicio">
                    Gestión de Turnos
                </a>   

            </div>
        </div>

        <div class="btn-group">
            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Acciones de productos
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="http://localhost/Inmuebles-Herrera/producto/productos">
                    Gestión de Productos
                </a>  

                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="http://localhost/Inmuebles-Herrera/pedido/pedidos">
                    Gestión de Pedidos
                </a> 

                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="http://localhost/Inmuebles-Herrera/categoria/categorias">
                    Gestión de Categorias
                </a> 

                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="http://localhost/Inmuebles-Herrera/estado/inicio">
                    Gestión de Estados
                </a> 
            </div>
        </div>

        <div class="btn-group">
            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Compras / Ventas
            </button>
            <div class="dropdown-menu">
                
                <a class="dropdown-item" href="http://localhost/Inmuebles-Herrera/venta/ventas">
                    Gestión de Ventas  
                </a>
                
                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="http://localhost/Inmuebles-Herrera/compra/inicio">
                    Gestión de Compras
                </a>  
            </div>
        </div>

        <h3>Estado actual</h3> 

        <div class="row">
            <div class="col-md-4">
                <div class="card 
                    <?php if($cantVentas >= 10): ?>
                        border-success mb-3
                    <?php elseif($cantVentas < 10 && $cantVentas > 5): ?>
                        border-warning mb-3
                    <?php elseif($cantVentas < 5 && $cantVentas >= 0): ?>
                        border-danger mb-3
                    <?php endif;?>" style="max-width: 18rem;">
                    <div class="card-header">Ventas</div>
                    <div class="card-body 
                    <?php if($cantVentas >= 10): ?>
                        text-success
                    <?php elseif($cantVentas < 10 && $cantVentas > 5): ?>
                        text-warning
                    <?php elseif($cantVentas <= 5 && $cantVentas >= 1): ?>
                        text-danger
                    <?php endif;?>"> 
                        <div class="row">
                            <div class="col-md-4 mt-2">
                                <i class="logIco fas fa-shopping-cart"></i>
                            </div>
                            <div class="col-md-8">
                                <p class="contLog card-text">
                                    x<?=$cantVentas?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
            
            <div class="col-md-4">
                <div class="card 
                    <?php if($cantC >= 10): ?>
                        border-success mb-3
                    <?php elseif($cantC < 10 && $cantC > 5): ?>
                        border-warning mb-3
                    <?php elseif($cantC <= 5 && $cantC >= 1): ?>
                        border-danger mb-3
                    <?php endif;?>" style="max-width: 18rem;">
                    <div class="card-header">Compras</div>
                    <div class="card-body 
                    <?php if($cantC >= 10): ?>
                        text-success
                    <?php elseif($cantC < 10 && $cantC > 5): ?>
                        text-warning
                    <?php elseif($cantC <= 5 && $cantC >= 1): ?>
                        text-danger
                    <?php endif;?>"> 
                        <div class="row">
                            <div class="col-md-4 mt-2">
                                <i class="logIco fas fa-shopping-bag"></i>
                            </div>
                            <div class="col-md-8">
                                <p class="contLog card-text">
                                    x<?=$cantC?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>  
            
            <div class="col-md-4">
                <div class="card 
                    <?php if($porcentaje > 10): ?>
                        border-success mb-3
                    <?php elseif($porcentaje <= 10 && $porcentaje > 5): ?>
                        border-warning mb-3
                    <?php elseif($porcentaje <= 5 && $porcentaje >= 1): ?>
                        border-danger mb-3
                    <?php endif;?>" style="max-width: 18rem;">
                    <div class="card-header">Productos</div>
                    <div class="card-body 
                    <?php if($porcentaje > 10): ?>
                        text-success
                    <?php elseif($porcentaje <= 10 && $porcentaje > 5): ?>
                        text-warning
                    <?php elseif($porcentaje <= 5 && $porcentaje >= 1): ?>
                        text-danger
                    <?php endif;?>"> 
                        <div class="row">
                            <div class="col-md-4 mt-2">
                                <i class="logIco fas fa-box-open"></i>
                            </div>
                            <div class="col-md-8">
                                <p class="contLog card-text">
                                    <?=$porcentaje?>%
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  

            <div class="col-md-4">
                <div class="card border-info mb-3" style="max-width: 18rem;">
                    <div class="card-header">Pedidos</div>
                    <div class="card-body text-info"> 
                        <div class="row">
                            <div class="col-md-4 mt-2">
                                <i class="logIco fas fa-people-carry"></i>
                            </div>
                            <div class="col-md-8">
                                <p class="contLog card-text">
                                    x<?=$cantPed?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card border-info mb-3" style="max-width: 18rem;">
                    <div class="card-header">Proveedores</div>
                    <div class="card-body text-info"> 
                        <div class="row">
                            <div class="col-md-4 mt-2">
                                <i class="logIco fas fa-people-carry"></i>
                            </div>
                            <div class="col-md-8">
                                <p class="contLog card-text">
                                    x<?=$cantProv?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="col-md-4">
                <div class="card border-info mb-3" style="max-width: 18rem;">
                    <div class="card-header">Vendedores</div>
                    <div class="card-body text-info"> 
                        <div class="row">
                            <div class="col-md-4 mt-2">
                                <i class="logIco fas fa-users"></i>
                            </div>
                            <div class="col-md-8">
                                <p class="contLog card-text">
                                    x<?=$cantVend?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-info mb-3" style="max-width: 18rem;">
                    <div class="card-header">Turnos</div>
                    <div class="card-body text-info"> 
                        <div class="row">
                            <div class="col-md-4 mt-2">
                                <i class="logIco fas fa-calendar-day"></i>
                            </div>
                            <div class="col-md-8">
                                <p class="contLog card-text">
                                    x<?=$cantTurn?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 

            <div class="col-md-4">
                <div class="card border-info mb-3" style="max-width: 18rem;">
                    <div class="card-header">Alertas</div>
                    <div class="card-body text-info"> 
                        <div class="row">
                            <div class="col-md-4 mt-2">
                                <i class="logIco fas fa-exclamation-circle"></i>
                            </div>
                            <div class="col-md-8">
                                <p class="contLog card-text">
                                    x<?=$cantAlert?>
                                </p>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>  

            <div class="col-md-4">
                <div class="card border-info mb-3" style="max-width: 18rem;">
                    <div class="card-header">Cliente</div>
                    <div class="card-body text-info"> 
                        <div class="row">
                            <div class="col-md-4 mt-2">
                                <i class="logIco fas fa-user-lock"></i>
                            </div>
                            <div class="col-md-8">
                                <p class="contLog card-text">
                                    x<?=$cantCli?>
                                </p>
                            </div>
                        </div> 
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