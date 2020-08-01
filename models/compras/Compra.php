<?php

/**
 * Clase que permite realizar las operaciones con el modelo de compras 
 *
 * @author Daniel Huenul
 */
class Compra {

    //put your code here
    private $id;
    private $codigo;
    private $valorCompra;
    private $fecha;
    private $estado;
    private $detalle;
    private $boleta;
    private $cliente;
    private $db;

    function __construct() {
        $this->db = bd::conectar();
    }

    /**
     * function que permite obtener el id de compra
     *
     *
     * Este DocBlock documenta la función getId()
     * @return: $id Integer
     */
    function getId() {
        return $this->id;
    }

    /**
     * function que permite obtener el codigo de compra
     *
     *
     * Este DocBlock documenta la función getCodigo()
     * @return: $codigo Integer
     */
    function getCodigo() {
        return $this->codigo;
    }

    /**
     * function que permite obtener el valor de compra
     *
     *
     * Este DocBlock documenta la función getValorCompra()
     * @return: $valorCompra Integer
     */
    function getValorCompra() {
        return $this->valorCompra;
    }

    /**
     * function que permite obtener la fecha de compra
     *
     *
     * Este DocBlock documenta la función getFecha()
     * @return: $fecha String
     */
    function getFecha() {
        return $this->fecha;
    }

    /**
     * function que permite obtener el detalle de compra
     *
     *
     * Este DocBlock documenta la función getDetalle()
     * @return: $detalle String
     */
    function getDetalle() {
        return $this->detalle;
    }

    /**
     * function que permite obtener el estado de compra
     *
     *
     * Este DocBlock documenta la función getEstado()
     * @return: $estado String
     */
    function getEstado() {
        return $this->estado;
    }

    /**
     * function que permite obtener el id boleta de compra
     *
     *
     * Este DocBlock documenta la función getEstado()
     * @return: $boleta Integer
     */
    function getBoleta() {
        return $this->boleta;
    }

    /**
     * function que permite obtener el id cliente de compra
     *
     *
     * Este DocBlock documenta la función getCliente()
     * @return: $cliente Integer
     */
    function getCliente() {
        return $this->cliente;
    }

    /**
     * function que permite establecer el id de compra
     *
     *
     * Este DocBlock documenta la función setId()
     * @param: $id Integer
     */
    function setId($id): void {
        $this->id = $id;
    }

    /**
     * function que permite establecer el codigo de compra
     *
     *
     * Este DocBlock documenta la función setCodigo()
     * @param: $codigo Integer
     */
    function setCodigo($codigo): void {
        $this->codigo = $codigo;
    }

    /**
     * function que permite establecer el valor de Compra
     *
     *
     * Este DocBlock documenta la función setValorCompra()
     * @param: $valorCompra Integer
     */
    function setValorCompra($valorCompra): void {
        $this->valorCompra = $valorCompra;
    }

    /**
     * function que permite establecer la fecha de compra
     *
     *
     * Este DocBlock documenta la función setFecha()
     * @param: $fecha String
     */
    function setFecha($fecha): void {
        $this->fecha = $fecha;
    }

    /**
     * function que permite establecer el estado de compra
     *
     *
     * Este DocBlock documenta la función setEstado()
     * @param: $estado String
     */
    function setEstado($estado): void {
        $this->estado = $estado;
    }

    /**
     * function que permite establecer el detalle de compra
     *
     *
     * Este DocBlock documenta la función setDetalle()
     * @param: $detalle String
     */
    function setDetalle($detalle): void {
        $this->detalle = $detalle;
    }

    /**
     * function que permite establecer el id de boleta de compra
     *
     *
     * Este DocBlock documenta la función setBoleta()
     * @param: $boleta Integer
     */
    function setBoleta($boleta): void {
        $this->boleta = $boleta;
    }

    /**
     * function que permite establecer el id de cliente de compra
     *
     *
     * Este DocBlock documenta la función setCliente()
     * @param: $cliente Integer
     */
    function setCliente($cliente): void {
        $this->cliente = $cliente;
    }

    /**
     * function que permite guardar una nueva compra en la base de datos
     *
     *
     * Este DocBlock documenta la función agregarCompra()
     * @return: $est True o Flase
     */
    public function agregarCompra() {
        try {

            $sql = "INSERT INTO `compras`(`idcompras`, `codigo`, `valorCompra`, `fecha`, `estadoCompra`, `boleta_idboleta`, `clientes_idclientes`) "
                    . "VALUES (0,"
                    . "{$this->getCodigo()}, "
                    . "{$this->getValorCompra()}, "
                    . "{$this->getFecha()}, "
                    . "'{$this->getEstado()}', "
                    . "{$this->getBoleta()}, "
                    . "{$this->getCliente()}) ";
            $guardado = $this->db->query($sql);

            $est = false;
            if ($guardado) {
                $est = true;
            }

            return $est;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite guardar los productos que hay en el carro de compras y asociarlos a la compra que realiza el cliente
     *
     *
     * Este DocBlock documenta la función guardarProductosCarro()
     * @return: $est True o Flase
     */
    public function guardarProductosCarro($idcompra, $listProduct, $listadoUnid) {
        try {

            $sql = "INSERT INTO `compras_de_productos`(`idcompras_de_productos`, `compras_idcompras`, `productos_idproductos`, `total`) "
                    . "VALUES ";

            $primero = false;
            foreach ($listProduct as $i => $idIndice) {
                // $i es el id que hay en cada posición de array

                if ($i == 0) {

                    $sql .= "(0,{$idcompra},{$idIndice},{$listadoUnid[$i]})";
                } else {

                    $sql .= ", (0,{$idcompra},{$idIndice},{$listadoUnid[$i]})";
                }
            }

            $agregado = $this->db->query($sql);

            $est = false;
            if ($agregado) {
                $est = true;
            }

            return $est;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function eliminarCompra() {
        echo "eliminarCompra";
    }

    /**
     * function que permite modificar el estado de una compra ya sea para aceptarla o rechazarla
     *
     *
     * Este DocBlock documenta la función modificarEstado()
     * @return: $resultado ResultSet
     */
    public function modificarEstado() {
        try {

            $sql = "UPDATE `compras` SET estadoCompra = '{$this->getEstado()}' WHERE idcompras = {$this->getId()}";
            $resultado = $this->db->query($sql);
            
            $est = false;
            if($resultado){
                $est = true;
            }
            
            return $est;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite obtener el listado de compras realizadas por clientes
     *
     *
     * Este DocBlock documenta la función guardarProductosCarro()
     * @return: $resultado ResultSet
     */
    public function obtenerComprasClientes() {
        try {

            $sql = "SELECT * FROM compras_de_productos comPts "
                    . "INNER JOIN compras comp ON comp.idcompras = comPts.compras_idcompras "
                    . "INNER JOIN clientes cli ON cli.idclientes = comp.clientes_idclientes "
                    . "INNER JOIN productos prod ON prod.idproductos = comPts.productos_idproductos";

            $resultado = $this->db->query($sql);


            return $resultado;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite obtener una compra en particular de la base de datos en base a su ID
     *
     *
     * Este DocBlock documenta la función obtenerCompra()
     * @return: $resultado ResultSet
     */
    public function obtenerCompra() {
        try {

            $sql = "SELECT * FROM `compras` WHERE codigo = {$this->getCodigo()}";
            $resultado = $this->db->query($sql);

            return $resultado;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite obtener todas las compras de un usuario en particular.
     *
     *
     * Este DocBlock documenta la función obtenerComprasCliente()
     * @param Integer $id ID de cliente 
     * @return: $resultado ResultSet 
     */
    public function obtenerComprasCliente($id) {
        try {

            $sql = "SELECT * FROM compras WHERE clientes_idclientes = {$id}";
            $resultado = $this->db->query($sql);

            return $resultado;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite obtener todos los registros de la tabla de compras de la base de datos junto al cliente que la realiza
     *
     *
     * Este DocBlock documenta la función obtenerTodasCompras() 
     * @return: $resultado ResultSet 
     */
    public function obtenerTodasCompras() {
        try {

            $sql = "SELECT * from compras comp INNER JOIN clientes cli ON cli.idclientes = comp.clientes_idclientes";
            $resultado = $this->db->query($sql);

            return $resultado;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permiteo obtener el listado de productos asociados
     * a una compra en marticular.
     *
     *
     * Este DocBlock documenta la función obtenerProductosCompra() 
     * @return: $resultado ResultSet 
     */
    public function obtenerProductosCompra() {
        try {
            $sql = "SELECT * FROM compras_de_productos compProd "
                    . "INNER JOIN productos prod ON prod.idproductos = compProd.productos_idproductos "
                    . "WHERE compProd.compras_idcompras = {$this->getId()}";

            $resultado = $this->db->query($sql);

            return $resultado;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite obtener la cantidad de compras registradas. 
     *
     *
     * Este DocBlock documenta la función obtenerCantVentas()
     * @return: $cantidad ResultSet
     */
    public function obtenerCantCompras() {
        try {
 
            $sql = "SELECT COUNT(idcompras) AS 'CANTC' FROM compras";
            $cont = $this->db->query($sql);

            $cantidad = $cont->fetch_object();
            
            return $cantidad;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
