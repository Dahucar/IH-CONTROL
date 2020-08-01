<?php

require_once 'models/pedido/Producto.php';
require_once 'models/pedido/Categoria.php';
require_once 'models/pedido/Estado.php';

require_once 'models/personas/persona.php';
require_once 'models/personas/cliente.php';

require_once 'models/compras/Venta.php';

/**
 * Clase que permite realizar el CRUD con los datos de ventas
 *
 * @author Daniel Huenul
 */
class VentaController {

    public function ventas() {
        
        //obtener todas las ventas y enviar a la vista
        $vent = new Venta();
        $listadoVentas = $vent->obtenerVentas(); 
        
        require_once 'views/interfaz/modulo/vista_ventas.php';
    }
    
    public function cestaventas() {

        $cli = new Cliente();
        $clientes = $cli->obtenerTodosCliente();

        if (isset($_SESSION['CESTA-VENDEDOR']) && count($_SESSION['CESTA-VENDEDOR']) >= 1) {
            $cesta = $_SESSION['CESTA-VENDEDOR'];
        }

        require_once 'views/interfaz/modulo_vendedores/vista_cestaventas.php';
    }

    /**
     * function que permite agregar nuevos productos a la cesta de vendedor
     * 
     * Este DocBlock documenta la función agregarCesta() 
     */
    public function agregarCesta() {
        echo '<div style="margin-top: 350px; margin-bottom: 350px;">
                <center>
                    <div class="spinner-border" style="width: 200px; height: 200px; margin: auto;"></div> 
                </center>
            </div>';
        try {
            $id_producto = 0;
            if (isset($_GET['id'])) {
                $id_producto = $_GET['id'];
            }
            //
            $cont = 0;
            if (isset($_SESSION['CESTA-VENDEDOR'])) {

                foreach ($_SESSION['CESTA-VENDEDOR'] as $indice => $elemento) {

                    $limitado = false;
                    $cantidadLimite = $_SESSION['CESTA-VENDEDOR'][$indice]['producto']->cantidad;
                    if ($elemento['id_producto'] == $id_producto) {

//                        echo "<h1>UNIDADES: ".$_SESSION['CESTA-VENDEDOR'][$indice]['unidades'] . "<h1>";
//                        echo "<h1>LIMITE: ".$cantidadLimite . "<h1>";
//                        

                        if ($cantidadLimite > $_SESSION['CESTA-VENDEDOR'][$indice]['unidades']) {

                            $_SESSION['CESTA-VENDEDOR'][$indice]['unidades']++;
                            $cont++;
                        } else {
                            $_SESSION['LIMITECESTA']['OK'] = "Has alcanzado el limite de unidades disponibles";
                            $cont = 1;
                        }
                    }
                }
            }

            if (!isset($cont) || $cont == 0) {
                $producto = new Producto();
                $producto->setId($id_producto);
                $resultado = $producto->obtenerProducto();
                $pro = $resultado->fetch_object();

                if (is_object($pro)) {
                    if($pro->cantidad != 0){
                        $_SESSION['CESTA-VENDEDOR'][] = array(
                            "id_producto" => $pro->idproductos,
                            "precio" => $pro->precio,
                            "unidades" => 1,
                            "producto" => $pro
                        );
                    }else{
                        $_SESSION['LIMITECESTA']['OK'] = "Producto sin stock";
                    }
                }
            }
            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/venta/cestaventas">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite eliminar todos los productos agregados a la tienda.
     * 
     * Este DocBlock documenta la función agregarCesta() 
     */
    public function limpiarCesta() {
        echo '<div style="margin-top: 350px; margin-bottom: 350px;">
                <center>
                    <div class="spinner-border" style="width: 200px; height: 200px; margin: auto;"></div> 
                </center>
            </div>';
        try {

            if (isset($_SESSION['CESTA-VENDEDOR'])) {
                $_SESSION['CESTA-VENDEDOR'] = null;
                unset($_SESSION['CESTA-VENDEDOR']);
            }
            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/venta/cestaventas">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite eliminar un producto en particuloar de la cesta de ventas
     * 
     * Este DocBlock documenta la función agregarCesta() 
     */
    public function eliminarProductoCesta() {
        echo '<div style="margin-top: 350px; margin-bottom: 350px;">
                <center>
                    <div class="spinner-border" style="width: 200px; height: 200px; margin: auto;"></div> 
                </center>
            </div>';
        try {

            if (isset($_GET['index'])) {
                $index = $_GET['index'];

                unset($_SESSION['CESTA-VENDEDOR'][$index]);
            }
            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/venta/cestaventas">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite guardar las ventas que ha realizado el vendedor
     * 
     * Este DocBlock documenta la función agregarCesta() 
     */
    public function totalizarCesta() {
        echo '<div style="margin-top: 350px; margin-bottom: 350px;">
                <center>
                    <div class="spinner-border" style="width: 200px; height: 200px; margin: auto;"></div> 
                </center>
            </div>';
        try {

            if (isset($_POST['campo_rut'])) {
                $rutCliente = $_POST['campo_rut'];

                $nuevoCliente = false;
                if (isset($_POST['campo_activo']) && $_POST['campo_activo'] == "on") {
                    $nuevoCliente = true;
                }

                //array para capturar errores
                $errores = array();
                //validando datos
                if (!empty($rutCliente) && Utils::valida_rut($rutCliente)) {
                    $rut_valido = true;
                } else {
                    $rut_valido = false;
                    $errores['rut'] = "rut invalido";
                }
                $clienteComprador = false;
                if (count($errores) == 0) {

                    //verifico si el cliente es nuevo o ya registrado en el sistema
                    if ($nuevoCliente) {

                        //si el cliente es nuevo. Creare un cliente temporal para guardar la venta
                        $clientTemp = new Cliente();
                        $clientTemp->setId(0);
                        $clientTemp->setCodigo(rand());
                        $clientTemp->setRut($rutCliente);
                        $clientTemp->setRol("CLIENTE TEMPORAL");

                        $cliVeifi = $clientTemp->obtenerRutCliente();

                        if (!is_object($cliVeifi)) {
                            //si no es objecto es por que el rut esta disponibles
                            $agregando = $clientTemp->agregarCliente();

                            if ($agregando) {
                                //en el nuevoCliTemp esta el cliente que hace la compra
                                $NuevoCliTemp = $clientTemp->obtenerRutCliente();
                                $clienteComprador = $NuevoCliTemp;
                            } else {
                                //si es objecto es por que el rut esta en uso
                                $clienteComprador = false;
                            }
                        } else {
                            //si es objecto es por que el rut esta en uso
                            $clienteComprador = false;
                            $_SESSION['MSGCESTACLI']['RUT'] = "El rut ingresado corresponde a un usuario registrado";
                        }
                    } else {
                        //si lo hay, voy a buscarlo por el rut
                        $client = new Cliente();
                        $client->setRut($rutCliente);
                        $clienteObtenido = $client->obtenerCliente();
                        if ($clienteObtenido) {
                            $cli = $clienteObtenido->fetch_object();

                            if (is_object($cli)) {
                                $clienteComprador = $cli;
                            }
                        }
                    }

                    if (is_object($clienteComprador)) {
                        //$_SESSION['CESTA-VENDEDOR'][$indice]['producto'] 
                        //array donde guardo todos los id de productos que hay en la cesta
                        $listadoIds = array();
                        $listadoUnidades = array();
                        $detalle = "";
                        foreach ($_SESSION['CESTA-VENDEDOR'] as $i => $elemento) {
                            $detalle .= "Nombre de producto: " . $_SESSION['CESTA-VENDEDOR'][$i]['producto']->nombre . ". ";
                            $detalle .= "Precio: " . $_SESSION['CESTA-VENDEDOR'][$i]['producto']->precio . ". ";
                            $detalle .= "Cantidad de productos: " . $_SESSION['CESTA-VENDEDOR'][$i]['producto']->cantidad . ". ";
                            $idEncontrado = $_SESSION['CESTA-VENDEDOR'][$i]['producto']->idproductos;
                            $listadoUnidades[$i] = $_SESSION['CESTA-VENDEDOR'][$i]['unidades'];
                            $listadoIds[] = $idEncontrado;
                        }

                        $ven = new Venta();
                        $ven->setId(0);
                        $ven->setCodigo(rand());
                        $ven->setFecha('CURRENT_TIMESTAMP');
                        $ven->setDetalle($detalle);

                        $estadisticas = Utils::estadisticasCesta();

                        $ven->setValor($estadisticas['total']);
                        $ven->setVendedor($_SESSION['IDENTIDAD']->idvendedores);
                        $ven->setCliente($clienteComprador->idclientes);
                        //hasta este punto la venta ya esta guardad

                        $agregado = $ven->agregarVenta();

                        if ($agregado) {

                            $vent_obtenida = $ven->obtenerVenta();
                            $ventResultado = $vent_obtenida->fetch_object();

                            if (is_object($ventResultado)) {
                                //hata este punto la venta se guardo y se obtubo 

                                $productosVentaGuardado = $ven->agregarProductosVentas($ventResultado->idventas, $listadoIds);

                                $prod = new Producto();
                                foreach ($listadoIds as $i => $idIndice) {
                                    $cantidadLimite = $_SESSION['CESTA-VENDEDOR'][$i]['producto']->cantidad;
                                    $total = $cantidadLimite - $listadoUnidades[$i];

                                    $prod->actualizarStock($total, $idIndice);
                                }

                                if ($productosVentaGuardado) {
                                    $_SESSION['MSGCESTA']['OK'] = "Venta guardada correctamente.";
                                    $this->limpiarCesta();
                                } else {
                                    $_SESSION['MSGCESTA']['ERR'] = "Error durante el proceso de guardado de productos de cesta.";
                                }
                            } else {
                                $_SESSION['MSGCESTA']['ERR'] = "No se ha encontrado la venta registrada.";
                            }
                        } else {
                            $_SESSION['MSGCESTA']['ERR'] = "Ha ocurrido un error durante el proceso de guardado de compra.";
                        }
                    } else {
                        $_SESSION['MSGCESTA']['ERR'] = "No se ha encontrado el rut ingresado en los registros de clientes.";
                    }
                } else {
                    $_SESSION['MSGCESTA']['ERR'] = "Hay errores en los campos ingresados o estan vacíos.";
                }
            } else {
                $_SESSION['MSGCESTA']['ERR'] = "Debe ingresar el rut del cliente.";
            }
            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/venta/cestaventas">';
        } catch (Exception $ex) {
            echo $exc->getTraceAsString();
        }
    }

}
