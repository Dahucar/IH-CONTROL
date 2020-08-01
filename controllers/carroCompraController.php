<?php

require_once 'models/pedido/Producto.php';
require_once 'models/pedido/Categoria.php';
require_once 'models/pedido/Estado.php';
require_once 'models/compras/Boleta.php';
require_once 'models/compras/Compra.php';

/**
 * CLase que permite operar los datos de las carro junto a los productos que puede tener
 *
 * @author Daniel Huenul
 */
class CarroCompraController {

    //put your code here

    public function carro() {

        if (isset($_SESSION['CARROCOMPRA']) && count($_SESSION['CARROCOMPRA']) >= 1) {
            $carro = $_SESSION['CARROCOMPRA'];
        }

        require_once 'views/compras/carroproductos.php';
    }

    /**
     * function que permite agregar nuevos productos al carro de clientes
     * 
     * Este DocBlock documenta la función agregarCesta() 
     */
    public function agregarCarro() {
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
            if (isset($_SESSION['CARROCOMPRA'])) {

                foreach ($_SESSION['CARROCOMPRA'] as $indice => $elemento) {

                    $limitado = false;
                    $cantidadLimite = $_SESSION['CARROCOMPRA'][$indice]['producto']->cantidad;
                    if ($elemento['id_producto'] == $id_producto) {

//                        echo "<h1>UNIDADES: ".$_SESSION['CESTA-VENDEDOR'][$indice]['unidades'] . "<h1>";
//                        echo "<h1>LIMITE: ".$cantidadLimite . "<h1>";
//                        

                        if ($cantidadLimite > $_SESSION['CARROCOMPRA'][$indice]['unidades']) {

                            $_SESSION['CARROCOMPRA'][$indice]['unidades']++;
                            $cont++;
                        } else {
                            $_SESSION['LIMITECARRO']['OK'] = "Has alcanzado el limite de unidades disponibles";
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
                        $_SESSION['CARROCOMPRA'][] = array(
                            "id_producto" => $pro->idproductos,
                            "precio" => $pro->precio,
                            "unidades" => 1,
                            "producto" => $pro
                        );
                    }else{
                        $_SESSION['LIMITECARRO']['OK'] = "Producto sin stock";
                    }
                }
            }
            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/carroCompra/carro">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite eliminar un producto en particuloar del carro de compras
     * 
     * Este DocBlock documenta la función agregarCesta() 
     */
    public function quitarCarro() { 
        echo '<div style="margin-top: 350px; margin-bottom: 350px;">
                <center>
                    <div class="spinner-border" style="width: 200px; height: 200px; margin: auto;"></div> 
                </center>
            </div>';
        try {

            if (isset($_GET['index'])) {
                $index = $_GET['index'];

                unset($_SESSION['CARROCOMPRA'][$index]);
            }
            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/carroCompra/carro">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite totalizar el carro de compra 
     * 
     * Este DocBlock documenta la función totalizar() 
     */
    public function totalizar() {
        echo '<div style="margin-top: 350px; margin-bottom: 350px;">
                <center>
                    <div class="spinner-border" style="width: 200px; height: 200px; margin: auto;"></div> 
                </center>
            </div>';
        try {

            if (isset($_SESSION['IDENTIDAD'])) {

                //listado de id de todos los productos que hay en el carro
                $listadoIds = array();
                $listadoUnidades = array();
                $valorCarro = 0;
                foreach ($_SESSION['CARROCOMPRA'] as $i => $elemento) {

                    $suma = $_SESSION['CARROCOMPRA'][$i]['precio'] * $_SESSION['CARROCOMPRA'][$i]['unidades'];
                    $valorCarro += $suma;

                    $_SESSION['CARROCOMPRA'][$i]['producto']->precio;

                    //guardando el id de producto en carro en variable
                    $id_encontrado = $_SESSION['CARROCOMPRA'][$i]['producto']->idproductos;
                    //guardando las unidades de productos añadidos en carro en el array de unidades
                    $listadoUnidades[$i] = $_SESSION['CARROCOMPRA'][$i]['unidades'];

                    $listadoIds[] = $id_encontrado;
                }
                //tener boleta creada antes de guardar la compra


                $detalle = "";
                foreach ($_SESSION['CARROCOMPRA'] as $i => $elemento) {
                    $detalle .= "Nombre de producto: " . $_SESSION['CARROCOMPRA'][$i]['producto']->nombre . ". ";
                    $detalle .= "Precio: " . $_SESSION['CARROCOMPRA'][$i]['producto']->precio . ". ";
                    $detalle .= "Cantidad de productos: " . $_SESSION['CARROCOMPRA'][$i]['producto']->cantidad . ". ";
                }

                $bol = new Boleta();
                $bol->setId(0);
                $bol->setCodigo(rand());
                $bol->setDetalle($detalle);

                $guardado = $bol->crearBoleta();

                if ($guardado) {

                    $boleta = $bol->obtenerBoletaCodigo();
                    $bolObtenida = $boleta->fetch_object();

                    //ahora que tengo la boleta créo la compra 
                    //CURRENT_TIMESTAMP
                    $compra = new Compra();
                    $compra->setId(0);
                    $compra->setCodigo(rand());
                    $compra->setFecha('CURRENT_TIMESTAMP');
                    $compra->setValorCompra($valorCarro);
                    $compra->setEstado('PENDIENTE');
                    $compra->setBoleta($bolObtenida->idboleta);
                    $compra->setCliente($_SESSION['IDENTIDAD']->idclientes);

                    $com_agregada = $compra->agregarCompra();

                    if ($com_agregada) {

                        //obtengo la compra que guarde hace nada 
                        $compra_obtenida = $compra->obtenerCompra();
                        $comObten = $compra_obtenida->fetch_object();

                        if (is_object($comObten)) {
                            //guardar la compra con todos los productos que se hayan seleccionado

                            $guardadoCompraProducto = $compra->guardarProductosCarro($comObten->idcompras, $listadoIds, $listadoUnidades);

                            $prod = new Producto();

                            $primero = false;
                            foreach ($listadoIds as $i => $idIndice) {
                                // $i es el id que hay en cada posición de array
                                $cantidadLimite = $_SESSION['CARROCOMPRA'][$i]['producto']->cantidad;
                                $total = $cantidadLimite - $listadoUnidades[$i];

                                $prod->actualizarStock($total, $idIndice);
                            }

                            if ($guardadoCompraProducto) {
                                $_SESSION['COMPRA']['OK'] = "Se ha completado la compra de forma satisfactoría.";

                                $this->limpiarCarro();
                            } else {
                                $_SESSION['COMPRA']['ERR'] = "Error durante el proceso compra de productos";
                            }
                        } else {
                            $_SESSION['COMPRA']['ERR'] = "No se ha encontrado la compra que ha solicitado realizar";
                        }
                    } else {
                        $_SESSION['COMPRA']['ERR'] = "Error durante el proceso de guardado de compra.";
                    }
                } else {
                    $_SESSION['COMPRA']['ERR'] = "Error durante el proceso creación de boleta";
                }
            } else {
                $_SESSION['COMPRA']['ERR'] = "Usted debe estar registrado para totalizar su carro";
            }
            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/carroCompra/carro">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite eliminar todos los productos agregados a la tienda.
     * 
     * Este DocBlock documenta la función agregarCesta() 
     */
    public function limpiarCarro() {
        echo '<div style="margin-top: 350px; margin-bottom: 350px;">
                <center>
                    <div class="spinner-border" style="width: 200px; height: 200px; margin: auto;"></div> 
                </center>
            </div>';
        try {

            if (isset($_SESSION['CARROCOMPRA'])) {
                $_SESSION['CARROCOMPRA'] = null;
                unset($_SESSION['CARROCOMPRA']);
            }
            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/carrocompra/carro">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
