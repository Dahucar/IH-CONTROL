<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pedido
 *
 * @author Daniel Huenul
 */
class Pedido {

    //put your code here
    private $id;
    private $codigo;
    private $cantidadProductos;
    private $precioUnitario;
    private $precioTotal;
    private $detalleSolicitud;
    private $estado;
    private $fechaSolicitud;
    private $proveedor;
    private $administrador;
    private $db;

    function __construct() {
        $this->db = bd::conectar();
    }

    /**
     * function que permite obtener el id de Pedido
     *
     *
     * Este DocBlock documenta la función getId()
     * @return: $id Integer
     */
    function getId() {
        return $this->id;
    }

    /**
     * function que permite obtener el codigo de Pedido
     *
     *
     * Este DocBlock documenta la función getCodigo()
     * @return: $codigo Integer
     */
    function getCodigo() {
        return $this->codigo;
    }

    /**
     * function que permite obtener la cantidad de Productos de Pedido
     *
     *
     * Este DocBlock documenta la función getCantidadProductos()
     * @return: $cantidadProductos Integer
     */
    function getCantidadProductos() {
        return $this->cantidadProductos;
    }

    /**
     * function que permite obtener el precio Unitario de Pedido
     *
     *
     * Este DocBlock documenta la función getPrecioUnitario()
     * @return: $precioUnitario Integer
     */
    function getPrecioUnitario() {
        return $this->precioUnitario;
    }

    /**
     * function que permite obtener el precio Total de Pedido
     *
     *
     * Este DocBlock documenta la función getPrecioTotal()
     * @return: $precioTotal Integer
     */
    function getPrecioTotal() {
        return $this->precioTotal;
    }

    /**
     * function que permite obtener el detalle de Solicitud de Pedido
     *
     *
     * Este DocBlock documenta la función getDetalleSolicitud()
     * @return: $detalleSolicitud String
     */
    function getDetalleSolicitud() {
        return $this->detalleSolicitud;
    }

    /**
     * function que permite obtener el estado de Pedido
     *
     *
     * Este DocBlock documenta la función getEstado()
     * @return: $estado String
     */
    function getEstado() {
        return $this->estado;
    }

    /**
     * function que permite obtener la Fecha Solicitud de Pedido
     *
     *
     * Este DocBlock documenta la función getFechaSolicitud()
     * @return: $fechaSolicitud String
     */
    function getFechaSolicitud() {
        return $this->fechaSolicitud;
    }

    /**
     * function que permite obtener el proveedor de Pedido
     *
     *
     * Este DocBlock documenta la función getProveedor()
     * @return: $proveedor Integer
     */
    function getProveedor() {
        return $this->proveedor;
    }

    /**
     * function que permite obtener el administrador de Pedido
     *
     *
     * Este DocBlock documenta la función getAdministrador()
     * @return: $administrador Integer
     */
    function getAdministrador() {
        return $this->administrador;
    }

    /**
     * function que permite establecer el id de Pedido
     *
     *
     * Este DocBlock documenta la función setId()
     * @param: $id Integer
     */
    function setId($id): void {
        $this->id = $id;
    }

    /**
     * function que permite establecer el codigo de Pedido
     *
     *
     * Este DocBlock documenta la función setCodigo()
     * @param: $codigo Integer
     */
    function setCodigo($codigo): void {
        $this->codigo = $codigo;
    }

    /**
     * function que permite establecer la cantidad de Productos de Pedido
     *
     *
     * Este DocBlock documenta la función setCantidadProductos()
     * @param: $cantidadProductos Integer
     */
    function setCantidadProductos($cantidadProductos): void {
        $this->cantidadProductos = $cantidadProductos;
    }

    /**
     * function que permite establecer el precio Unitario de Pedido
     *
     *
     * Este DocBlock documenta la función setPrecioUnitario()
     * @param: $precioUnitario Integer
     */
    function setPrecioUnitario($precioUnitario): void {
        $this->precioUnitario = $precioUnitario;
    }

    /**
     * function que permite establecer el precio Unitario de Pedido
     *
     *
     * Este DocBlock documenta la función setPrecioUnitario()
     * @param: $precioUnitario Integer
     */
    function setPrecioTotal($precioTotal): void {
        $this->precioTotal = $precioTotal;
    }

    /**
     * function que permite establecer el detalle de Solicitud de Pedido
     *
     *
     * Este DocBlock documenta la función setDetalleSolicitud()
     * @param: $detalleSolicitud String
     */
    function setDetalleSolicitud($detalleSolicitud): void {
        $this->detalleSolicitud = $detalleSolicitud;
    }

    /**
     * function que permite establecer el estado de Pedido
     *
     *
     * Este DocBlock documenta la función setEstado()
     * @param: $estado String
     */
    function setEstado($estado): void {
        $this->estado = $estado;
    }

    /**
     * function que permite establecer la fecha de Solicitud de Pedido
     *
     *
     * Este DocBlock documenta la función setFechaSolicitud()
     * @param: $fechaSolicitud String
     */
    function setFechaSolicitud($fechaSolicitud): void {
        $this->fechaSolicitud = $fechaSolicitud;
    }

    /**
     * function que permite establecer el proveedor de Pedido
     *
     *
     * Este DocBlock documenta la función setProveedor()
     * @param: $proveedor Integer
     */
    function setProveedor($proveedor): void {
        $this->proveedor = $proveedor;
    }

    /**
     * function que permite establecer el administrador de Pedido
     *
     *
     * Este DocBlock documenta la función setAdministrador()
     * @param: $administrador Integer
     */
    function setAdministrador($administrador): void {
        $this->administrador = $administrador;
    }

    /**
     * function que permite agregar nuevos pedidos
     *
     *
     * Este DocBlock documenta la función agregarPedido()
     * @return: $est true o false
     */
    public function agregarPedido() {
        try {

            $sql = "INSERT INTO `pedido`(`idpedido`, `codigo`, `cantidadProdcutos`, `precioUnitario`, `precioTotal`, `detalleSolicitud`, `estadoPedido`, `fechaSolicitud`, `proveedores_idproveedores`, `administrador_idadministrador`) "
                    . "VALUES ("
                    . "0,"
                    . "{$this->getCodigo()},"
                    . "{$this->getCantidadProductos()},"
                    . "{$this->getPrecioUnitario()},"
                    . "{$this->getPrecioTotal()},"
                    . "'{$this->getDetalleSolicitud()}',"
                    . "'{$this->getEstado()}',"
                    . "{$this->getFechaSolicitud()},"
                    . "{$this->getProveedor()},"
                    . "{$this->getAdministrador()})";

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
     * function que permite obtener el listado de todos los pedidos
     *
     *
     * Este DocBlock documenta la función obtenerProductos()
     * @return: Lista de productos
     */
    public function obtenerPedidos() {
        try {

            $sql = "SELECT ped.idpedido, ped.cantidadProdcutos, ped.precioUnitario, ped.precioTotal, ped.detalleSolicitud, "
                    . "ped.estadoPedido, ped.fechaSolicitud, prov.rut, prov.nombre, prov.apellido_p, prov.apellido_m, prov.correo, "
                    . "adm.rut FROM pedido ped "
                    . "INNER JOIN proveedores prov ON prov.idproveedores = ped.proveedores_idproveedores "
                    . "INNER JOIN administrador adm ON adm.idadministrador = ped.administrador_idadministrador";
            $resultado = $this->db->query($sql);

            return $resultado;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite eliminar un pedido
     *
     *
     * Este DocBlock documenta la función obtenerProductos()
     * @return: $est true ofalse
     */
    public function eliminarPedido() {
        try {

            $sql = "DELETE FROM `pedido` WHERE `idpedido` = {$this->getId()}";
            $eliminado = $this->db->query($sql);

            $est = false;
            if ($eliminado) {
                $est = true;
            }

            return $est;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function modificarPedido() {
        echo "modificarPedido";
    }

    /**
     * function que permite actualizar el estado del pedido según las preferencias del proveedor
     *
     *
     * Este DocBlock documenta la función actualizarEstadoPedido()
     * @return: $est true o false
     */
    public function actualizarEstadoPedido($estado) {
        try {
            
            $sql = "UPDATE `pedido` ";
            if($estado == 1){
                $sql .= "SET estadoPedido = 'ACEPTADO' ";
            }
            
            if($estado == 2){
                 $sql .= "SET estadoPedido = 'RECHAZADO' ";
            }
            
            $sql .= "WHERE proveedores_idproveedores = {$this->getProveedor()} AND idpedido = {$this->getId()} ";
            
            $modificado = $this->db->query($sql);
            
            $est = false;
            if($modificado){
                $est = true;
            }
            
            return $est;
        } catch (Exception $ex) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite la cantidad total de pedidos de la base de datos 
     *
     * Este DocBlock documenta la función obtenerStock()
     * @return $resultado ResultSet
     */
    public function obtenerStock() {
        try {

            $sql = "SELECT COUNT(idpedido) AS 'CANTPED' FROM pedido";
            $stock = $this->db->query($sql);
            $resultado = $stock->fetch_object();
            return $resultado;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
