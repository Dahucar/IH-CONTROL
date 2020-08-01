<?php

require_once 'models/pedido/Pedido.php';
require_once 'models/personas/persona.php';
require_once 'models/personas/Proveedor.php';

/**
 * Clase controlladora que permite realizar el CRUD de los pedidos
 *
 * @author Daniel Huenul
 */
class PedidoController {

    /**
     * Function que permite llevar a la vista de creación de los nuevos pedidos
     *  
     */
    public function nuevopedido() {

        $prove = new Proveedor();
        $listado = $prove->obtenerProveedors();

        require_once 'views/interfaz/modulo/vista_nuevopedido.php';
    }

    /**
     * Function que permite llevar a la vista de todos los pedidos creados
     *  
     */
    public function pedidos() {

        $ped = new Pedido();
        $pedidos = $ped->obtenerPedidos();

        require_once 'views/interfaz/modulo/vista_pedidos.php';
    }

    /**
     * Function que permite procesar la solicitud de creacion de un nuevo pedido
     *  
     */
    public function agregarPedido() { 
        echo '<div style="margin-top: 350px; margin-bottom: 350px;">
                <center>
                    <div class="spinner-border" style="width: 200px; height: 200px; margin: auto;"></div> 
                </center>
            </div>';
        try {

            if (isset($_POST)) {

                //guardando los datos en variables
                $cantidad = isset($_POST['txt_cand']) ? $_POST['txt_cand'] : false;
                $precioUnitario = isset($_POST['txt_precUni']) ? $_POST['txt_precUni'] : false;
                $detalle = isset($_POST['txt_detalle']) ? $_POST['txt_detalle'] : false;
                $proveedor = isset($_POST['select-provee']) ? $_POST['select-provee'] : false;

                $errores = array();
                if (!empty($cantidad) && is_numeric($cantidad)) { 
                    if(strlen($cantidad) < 11){
                        $cantidad_valido = true;
                    }else{
                        $cantidad_valido = false;
                        $errores['cant'] = "<li>La cantidad ingresada debe poseer 11 caracteres o menos</li>";
                    }
                } else {
                    $cantidad_valido = false;
                    $errores['cant'] = "<li>Cantidad invalida</li>";
                }

                if (!empty($precioUnitario) && is_numeric($precioUnitario)) { 
                    if(strlen($precioUnitario) < 11){
                        $precioUnitario_valido = true;
                    }else{
                        $precioUnitario_valido = false;
                        $errores['precUni'] = "<li>El precio unitario ingresado debe poseer 11 caracteres o menos</li>";
                    }
                } else {
                    $precioUnitario_valido = false;
                    $errores['precUni'] = "<li>Precio unitario invalido</li>";
                }

                if (!empty($detalle)) {
                    if(strlen($detalle) < 255){
                        $detalle_valido = true;
                    }else{
                        $detalle_valido = false;
                        $errores['detalle'] = "<li>El detalle ingresado debe poseer 255 caracteres o menos</li>";
                    }
                } else {
                    $detalle_valido = false;
                    $errores['detalle'] = "<li>Detalle invalido</li>";
                }

                if (!empty($proveedor) && is_numeric($proveedor)) {
                    $proveedor_valido = true;
                } else {
                    $proveedor_valido = false;
                    $errores['proveedor'] = "<li>Proveedor invalido</li>";
                }

                //`idpedido`, `codigo`, `cantidadProdcutos`, `precioUnitario`, `precioTotal`, 
                //`detalleSolicitud`, `estadoPedido`, `fechaSolicitud`, `proveedores_idproveedores`,
                // `administrador_idadministrador`
                if (count($errores) == 0) {

                    $ped = new Pedido();
                    $ped->setId(0);
                    $ped->setCodigo(rand());
                    $ped->setCantidadProductos($cantidad);
                    $ped->setPrecioUnitario($precioUnitario);

                    $prec_total = $precioUnitario * $cantidad;

                    $ped->setPrecioTotal($prec_total);
                    $ped->setDetalleSolicitud($detalle);
                    $ped->setEstado('PENDIENTE');
                    $ped->setFechaSolicitud('CURRENT_TIMESTAMP');
                    $ped->setProveedor($proveedor);
                    $ped->setAdministrador($_SESSION['IDENTIDAD']->idadministrador);

                    $guardado = $ped->agregarPedido();

                    if ($guardado) {
                        $_SESSION['PEDIDOADD']['OK'] = "Pedido guardado correctamente.";
                    } else {
                        $_SESSION['PEDIDOADD']['ERR'] = "Error durante el proceso de guardado de pedido";
                    }
                } else {
                    $_SESSION['PEDIDOADD']['ERR'] = implode($errores);
                }
            } 
            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/pedido/nuevopedido">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * Function que permite el eliminado de un pedidos en particular
     *  
     */
    public function eliminarPedido() {
        echo '<div style="margin-top: 350px; margin-bottom: 350px;">
                <center>
                    <div class="spinner-border" style="width: 200px; height: 200px; margin: auto;"></div> 
                </center>
            </div>';
        try {

            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                if (!empty($id) && is_numeric($id)) {

                    $ped = new Pedido();
                    $ped->setId($id);
                    $eliminado = $ped->eliminarPedido();

                    if ($eliminado) {
                        $_SESSION['DELPED']['OK'] = "Pedido eliminado correctamente";
                    } else {
                        $_SESSION['DELPED']['ERR'] = "Error durante el proceso de eliminado de pedido.";
                    }
                } else {
                    $_SESSION['DELPED']['ERR'] = "Se esperaba un parametro para realizar esta ación.";
                }
            } else {
                $_SESSION['DELPED']['ERR'] = "Se esperaba un parametro para realizar esta ación.";
            }
            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/pedido/pedidos">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * Function que permite actualizar el estado de pedidos por parte del proveedor propietario del pedido
     *  
     */
    public function actEstadoPed() {
        echo '<div style="margin-top: 350px; margin-bottom: 350px;">
                <center>
                    <div class="spinner-border" style="width: 200px; height: 200px; margin: auto;"></div> 
                </center>
            </div>';
        try {
            //estPedProv : espera un 1 si se acepta. Un 2 si se rechaza
            if (isset($_GET['estPedProv']) && isset($_GET['id'])) {
                $nuevoEstado = $_GET['estPedProv'];
                $idPed = $_GET['id'];
                if (is_numeric($nuevoEstado) && is_numeric($idPed)) {

                    $ped = new Pedido();
                    $ped->setId($idPed);
                    $ped->setProveedor($_SESSION['IDENTIDAD']->idproveedores);
                    $accion = $ped->actualizarEstadoPedido($nuevoEstado);

                    if ($accion) {
                        $_SESSION['MODESTADO']['OK'] = "El estado del pedido ha cambiado.";
                    } else {
                        $_SESSION['MODESTADO']['ERR'] = "Ha ocurrido un error durante el proceso de actualización de estado";
                    }
                } else {
                    $_SESSION['MODESTADO']['ERR'] = "Los parametros recibidos no son del tipo esperado.";
                }
            } else {
                $_SESSION['MODESTADO']['ERR'] = "Se esperaban parametros para realizar esta acción.";
            }

            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/proveedor/inicioProveedores">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
