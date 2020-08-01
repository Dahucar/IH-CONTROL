<?php

require_once 'models/compras/Compra.php';

/**
 * Clase que permite realizar las operaciones con el modelo de compras 
 *
 * @author Daniel Huenul
 */
class CompraController {

    //put your code here

    public function inicio() {

        $comp = new Compra();
        $listadoCompras = $comp->obtenerTodasCompras();


        require_once 'views/interfaz/compras/vista_comprasGeneral.php';
    }

    public function detalleCompra() {
        try {
            if (isset($_GET['id'])) {
                $idCompra = $_GET['id'];

                if (is_numeric($idCompra)) {

                    $compra = new Compra();
                    $compra->setId($idCompra);
                    $listadoProductos = $compra->obtenerProductosCompra();
                } else {
                    $_SESSION['DETALLECOMPADM']['ERR'] = "El tipo de parametro enviado no es el esperado";
                }
            } else {
                $_SESSION['DETALLECOMPADM']['ERR'] = "Se esperaba un parametro para realizar esta acción.";
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }


        require_once 'views/interfaz/compras/vista_detalleCompras.php';
    }

    public function detalleCompraCliente() {
        try {
            if (isset($_GET['id'])) {
                $idCompra = $_GET['id'];

                if (is_numeric($idCompra)) {

                    $compra = new Compra();
                    $compra->setId($idCompra);
                    $listadoProductos = $compra->obtenerProductosCompra();
                } else {
                    $_SESSION['DETALLECOMP']['ERR'] = "El tipo de parametro enviado no es el esperado";
                }
            } else {
                $_SESSION['DETALLECOMP']['ERR'] = "Se esperaba un parametro para realizar esta acción.";
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }


        require_once 'views/interfaz/modulo_clientes/vista_detalleCompraCliente.php';
    }
    
    public function actCompra() {
        echo '<div style="margin-top: 350px; margin-bottom: 350px;">
                <center>
                    <div class="spinner-border" style="width: 200px; height: 200px; margin: auto;"></div> 
                </center>
            </div>';
        try { 
            //1: aceptado | 2_ rechazado
            if (isset($_GET['est']) && isset($_GET['id'])) {
                $nuevoEstado = $_GET['est'];
                $idComp = $_GET['id'];
                if (is_numeric($nuevoEstado) && is_numeric($idComp)) {

                    $compra = new Compra();
                    $compra->setId($idComp); 
                    
                    if($nuevoEstado == 1){
                        $compra->setEstado("ACEPTADO");
                    } else if ($nuevoEstado == 2){ 
                        $compra->setEstado("RECHAZADO");
                    }
                    
                    $accion = $compra->modificarEstado();

                    if ($accion) {
                        $_SESSION['MODESTADOC']['OK'] = "El estado de la compra se ha actualizado.";
                    } else {
                        $_SESSION['MODESTADOC']['ERR'] = "Ha ocurrido un error durante el proceso de actualización de estado";
                    }
                } else {
                    $_SESSION['MODESTADOC']['ERR'] = "Los parametros recibidos no son del tipo esperado.";
                }
            } else {
                $_SESSION['MODESTADOC']['ERR'] = "Se esperaban parametros para realizar esta acción.";
            }

            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/compra/inicio">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
