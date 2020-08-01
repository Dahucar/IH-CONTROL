<?php

session_start(); 
require_once 'autoload.php'; 
require_once './models/database/bd.php';
require_once './models/parametros.php';
require_once './models/utils.php';  

//verificando si el stock de productos esta bajo.
require_once 'models/pedido/Producto.php';
require_once 'C:\wamp64\www\Inmuebles-Herrera-Copia\vendor\autoload.php' ;  


//Incluyendo las interfaces
include_once './views/interfaz/header.php'; 

$producto = new Producto();
$stockPorcent = $producto->obtenerPorcentajeStock(); 
$cantActual = $stockPorcent->CANTACTUAL;
$cantTotal = $stockPorcent->CANTTOTAL;

//(55*100)/102 = 54%
$porcentaje = round(($cantActual * 100) / $cantTotal);
 
if($porcentaje <= 10){
    require_once 'models/pedido/Alerta.php';  
    require_once 'models/Mail.php'; 
    $alertaPendiente = new Alerta(); 
    $listadoAlertasPendientes = $alertaPendiente->obtenerAlertasAdministrador();
    if($listadoAlertasPendientes->num_rows >= 1){ 
        while($LAF = $listadoAlertasPendientes->fetch_object()){ 
            $mailEnviar = new Mail();
            $mailEnviar->setAsunto($LAF->asunto);
            $mailEnviar->setMensaje($LAF->mensaje);
         
            $datosADM = $LAF->nombre ." ". $LAF->apellido_p ." ". $LAF->apellido_m;

            $mailEnviar->setCorreoDestinatario($LAF->correo);
            $mailEnviar->setDestinatario($datosADM);
            $mailEnviar->enviarEmail();
            $alertaPendiente->setId($LAF->idalertas);
            $alertaPendiente->setEstado('ENVIADA');
            $alertaPendiente->modificarAlerta();
        }
    }
}

if (isset($_GET['controller'])) {
    $nombre_controller = $_GET['controller'] . 'Controller';
} elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
    $nombre_controller = "productoController";
}else{ 
    $error = new ErrorController();
    $error->errorAccion();
}

if (class_exists($nombre_controller)) {
    $controlador = new $nombre_controller();

    if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
        $action = $_GET['action'];
        $controlador->$action();
    } elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
        $action = "home";
        $controlador->$action();
    } else {
        $error = new ErrorController();
        $error->errorAccion();
    }
} else {
    $error = new ErrorController();
    $error->errorClase();
}


//Incluyendo las interfaces
include_once './views/interfaz/footer.php';
