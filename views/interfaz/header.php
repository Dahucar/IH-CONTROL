<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Muebles Herrera</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <!--<script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>-->
        <script src="http://localhost/Inmuebles-Herrera/assets/js/all.js" crossorigin="anonymous"></script>
        
        <!-- Google fonts-->
<!--        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet"--> 
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="http://localhost/Inmuebles-Herrera/assets/css/styles.css" rel="stylesheet" />
        <link href="http://localhost/Inmuebles-Herrera/assets/css/estilos.css" rel="stylesheet" />
        <!--<script src="https://kit.fontawesome.com/6e3e85ce1d.js" crossorigin="anonymous"></script>-->
        <script src="http://localhost/Inmuebles-Herrera/assets/js/6e3e85ce1d.js" ></script>
       
        <script src="http://localhost/Inmuebles-Herrera/assets/jquery-3.5.0.min" ></script>
        <script src="http://localhost/Inmuebles-Herrera/assets/js/calendario.js" ></script>
        <link rel="stylesheet" href="http://localhost/Inmuebles-Herrera/assets/fontawesome/css/all.min.css">

    </head>

    <body id="page-top">

        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="http://localhost/Inmuebles-Herrera/">Muebles Herrera</a>
                <button
                    class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded"
                    type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive"
                    aria-expanded="false" aria-label="Toggle navigation">Menu <i class="fas fa-bars"></i>
                </button> 
                <div class="collapse navbar-collapse" id="navbarResponsive"> 

                    <ul class="navbar-nav ml-auto">

                        <?php if (isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "VENDEDOR"): ?>
                            <a class="btn btn-outline-light btn-social mx-1" href="http://localhost/Inmuebles-Herrera/venta/cestaventas">
                                <i class="fab fa-fw fas fas fa-shopping-basket"></i>
                                <div class="count-container">
                                    <?php if(isset($_SESSION['CESTA-VENDEDOR'])): ?>
                                        <span>
                                        <?=count($_SESSION['CESTA-VENDEDOR'])?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </a> 
                        <?php elseif(isset($_SESSION['IDENTIDAD']) && $_SESSION['IDENTIDAD']->rol == "CLIENTE"): ?>
                            <a class="btn btn-outline-light btn-social mx-1" href="http://localhost/Inmuebles-Herrera/carrocompra/carro">
                                <i class="fab fa-fw fas fa-cart-plus"></i> 
                                <div class="count-container">
                                    <?php if(isset($_SESSION['CARROCOMPRA'])): ?>
                                        <span>
                                        <?=count($_SESSION['CARROCOMPRA'])?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </a>  
                        <?php elseif(!isset($_SESSION['IDENTIDAD'])): ?>
                            <a class="btn btn-outline-light btn-social mx-1" href="http://localhost/Inmuebles-Herrera/carrocompra/carro">
                                <i class="fab fa-fw fas fa-cart-plus"></i> 
                                <div class="count-container">
                                    <?php if(isset($_SESSION['CARROCOMPRA'])): ?>
                                        <span>
                                        <?=count($_SESSION['CARROCOMPRA'])?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </a>  
                        <?php endif; ?>




                        <li class="ayudamenu nav-item dropdown mx-0 mx-lg-2">

                            <?php if (!isset($_SESSION['IDENTIDAD'])): ?> 

                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Nuevo usuario
                                </a> 

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="http://localhost/Inmuebles-Herrera/usuario/iniciar">Iniciar sesión</a> 

                                    <a class="dropdown-item" href="http://localhost/Inmuebles-Herrera/cliente/registro">Registrarse</a> 
                                </div>

                            <?php else: ?>
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       <?= $_SESSION['IDENTIDAD']->rol . ": " . $_SESSION['IDENTIDAD']->nombre . " " . $_SESSION['IDENTIDAD']->apellido_p ?>
                                </a> 

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown"> 
                                    <a class="dropdown-item" href="http://localhost/Inmuebles-Herrera/usuario/salir">Cerrar Sesión</a>  
                                    <a class="dropdown-item" href="http://localhost/Inmuebles-Herrera/<?php if ($_SESSION['IDENTIDAD']->rol == "ADMINISTRADOR"): ?>administrador/inicio<?php elseif ($_SESSION['IDENTIDAD']->rol == "CLIENTE"): ?>cliente/homeCliente<?php elseif ($_SESSION['IDENTIDAD']->rol == "VENDEDOR"): ?>vendedor/inicio<?php elseif ($_SESSION['IDENTIDAD']->rol == "PROVEEDOR"): ?>proveedor/inicioProveedores<?php endif;?>">Modulo</a> 
                                </div>

                            <?php endif; ?>

                            <!--                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                            
                            
                                                            <a class="dropdown-item" href="http://localhost/Inmuebles-Herrera/administrador/inicio">Modulo administrador</a>
                            
                                                            <a class="dropdown-item" href="http://localhost/Inmuebles-Herrera/vendedor/misturnos">Modulo proveedor</a>
                            
                                                            <a class="dropdown-item" href="http://localhost/Inmuebles-Herrera/vendedor/registrarventa">Mis datos</a> 
                                                        </div> -->
                        </li>    

                    </ul> 

                </div>
            </div>
        </nav>

        <section class="page-section portfolio" id="portfolio">

