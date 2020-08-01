<?php

/**
 * Clase que contiene los parametros y funciones para gestionar los proveedores
 *
 * @author Daniel Huenul
 */
class Proveedor extends Persona {

    //put your code here
    private $nombreCompañia;
    private $logoProveedor;
    private $direccion;
    private $db;

    function __construct() {
        $this->db = bd::conectar();
    }

    /**
     * function que permite obtener el nombre de compañia de proveedor
     *
     *
     * Este DocBlock documenta la función getNombreCompañia()
     * @return: $nombreCompañia String
     */
    function getNombreCompañia() {
        return $this->nombreCompañia;
    }

    /**
     * function que permite obtener el logo de proveedor
     *
     *
     * Este DocBlock documenta la función getLogoProveedor()
     * @return: $logoProveedor String
     */
    function getLogoProveedor() {
        return $this->logoProveedor;
    }

    /**
     * function que permite obtener la direccion de proveedor
     *
     *
     * Este DocBlock documenta la función getDireccion()
     * @return: $direccion String
     */
    function getDireccion() {
        return $this->direccion;
    }

    /**
     * function que permite establecer el nombre de compañia de Proveedor
     *
     *
     * Este DocBlock documenta la función setNombreCompañia()
     * @param: $nombreCompañia String
     */
    function setNombreCompañia($nombreCompañia): void {
        $this->nombreCompañia = $nombreCompañia;
    }

    /**
     * function que permite establecer la direccion de Proveedor
     *
     *
     * Este DocBlock documenta la función setDireccion()
     * @param: $logoProveedor String
     */
    function setDireccion($direccion): void {
        $this->direccion = $direccion;
    }

    /**
     * function que permite establecer el logo de Proveedor
     *
     *
     * Este DocBlock documenta la función setLogoProveedor()
     * @param: $logoProveedor String
     */
    function setLogoProveedor($logoProveedor): void {
        $this->logoProveedor = $logoProveedor;
    }

    /**
     * function que permite que el proveedor acceda al sistema como un ususario registrado
     * 
     * Este DocBlock documenta la función loginProveedor()
     * @return: revuelve un boolean o un resultado de la base de datos
     */
    public function loginProveedor() {
        try {

            $prov_buscado = false;
            $email_busqueda = $this->getCorreo();
            $clave_busqueda = $this->getClave();


            $sql = "SELECT * FROM `proveedores` WHERE `correo` = '{$email_busqueda}'";
            $login = $this->db->query($sql);

            if ($login && $login->num_rows == 1) {

                //guardo el resulset en cliente
                $prov = $login->fetch_object();

                $es_correcta = password_verify($clave_busqueda, $prov->clave);
                if ($es_correcta) {
                    $prov_buscado = $prov;
                }
            }

            return $prov_buscado;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite guardar el proveedor en la base de datos
     *
     *
     * Este DocBlock documenta la función agregarProveedor()
     * @return:$est true o false
     */
    public function agregarProveedor() {
        try {

            $sql = "INSERT INTO `proveedores`(`idproveedores`, `codigo`, `rut`, `nombre`, `apellido_p`, `apellido_m`, `nombreCompañia`, `logoProveedor`, `direccion`, `rol`, `correo`, `clave`) "
                    . "VALUES ("
                    . "0,"
                    . "{$this->getCodigo()},"
                    . "'{$this->db->real_escape_string($this->getRut())}',"
                    . "'{$this->db->real_escape_string($this->getNombre())}',"
                    . "'{$this->db->real_escape_string($this->getApellido_p())}',"
                    . "'{$this->db->real_escape_string($this->getApellido_m())}',"
                    . "'{$this->db->real_escape_string($this->getNombreCompañia())}',"
                    . "'{$this->db->real_escape_string($this->getLogoProveedor())}',"
                    . "'{$this->db->real_escape_string($this->getDireccion())}',"
                    . "'{$this->db->real_escape_string($this->getRol())}',"
                    . "'{$this->db->real_escape_string($this->getCorreo())}',"
                    . "'{$this->db->real_escape_string($this->getClave())}')";

            $guardar = $this->db->query($sql);


            $est = false;
            if ($guardar) {
                $est = true;
            }

            return $est;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite obtener un proveedor de la base de datos por el correo
     *
     *
     * Este DocBlock documenta la función agregarProveedor()
     * @return: $obtenido true o false
     */
    public function obtenerProveedorCorreo() {
        try {

            $sql = "SELECT * FROM `proveedores` WHERE `correo` = '{$this->getCorreo()}'";
            $buscar = $this->db->query($sql);

            $obtenido = false;
            if ($buscar && $buscar->num_rows == 1) {
                $obtenido = $buscar->fetch_object();
            }

            return $obtenido;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite obtener un proveedor de la base de datos por el rut
     *
     *
     * Este DocBlock documenta la función agregarProveedor()
     * @return: $obtenido true o false
     */
    public function obtenerProveedorRut() {
        try {

            $sql = "SELECT * FROM `proveedores` WHERE `rut` = '{$this->getRut()}'";
            $buscar = $this->db->query($sql);

            $obtenido = false;
            if ($buscar && $buscar->num_rows == 1) {
                $obtenido = $buscar->fetch_object();
            }

            return $obtenido;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    } 

    /**
     * function que permite eliminar un proveedor de la base de datos por su id
     *
     *
     * Este DocBlock documenta la función eliminarProveedor()
     * @return: $obtenido true o false
     */
    public function eliminarProveedor() {
        try {

            $sql = "DELETE FROM `proveedores` WHERE `idproveedores` = {$this->getId()}";
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

    /**
     * function que permite modificar un proveedor de la base de datos por su id
     *
     *
     * Este DocBlock documenta la función modificarProveedor()
     * @return: $obtenido true o false
     */
    public function modificarProveedor() {
        try {
            // WHERE `idproveedores` = '{$this->getId()}'
            $sql = "UPDATE `proveedores` SET ";

            $ingresados = array();
            if ($this->getRut() != "") {
                $ingresados['getRut'] = "ok";
                $sql .= "`rut`='{$this->getRut()}'";
            }

            if ($this->getNombre() != "") {

                if (isset($ingresados['getRut'])) {
                    $ingresados['getNombre'] = "ok";
                    $sql .= ", `nombre`='{$this->getNombre()}'";
                } else {
                    $ingresados['getNombre'] = "ok";
                    $sql .= "`nombre`='{$this->getNombre()}'";
                }
            }

            if ($this->getApellido_p() != "") {

                if (isset($ingresados['getNombre'])) {
                    $ingresados['getApellido_p'] = "ok";
                    $sql .= ", `apellido_p`='{$this->getApellido_p()}'";
                } else {
                    $ingresados['getApellido_p'] = "ok";
                    $sql .= "`apellido_p`='{$this->getApellido_p()}'";
                }
            }

            if ($this->getApellido_m() != "") {

                if (isset($ingresados['getApellido_p'])) {
                    $ingresados['getApellido_m'] = "ok";
                    $sql .= ", `apellido_m`='{$this->getApellido_m()}'";
                } else {
                    $ingresados['getApellido_m'] = "ok";
                    $sql .= "`apellido_m`='{$this->getApellido_m()}'";
                }
            }

            if ($this->getNombreCompañia() != "") {

                if (isset($ingresados['getApellido_m'])) {
                    $ingresados['getNombreCompañia'] = "ok";
                    $sql .= ", `nombreCompañia`='{$this->getNombreCompañia()}'";
                } else {
                    $ingresados['getNombreCompañia'] = "ok";
                    $sql .= "`nombreCompañia`='{$this->getNombreCompañia()}'";
                }
            }

            if ($this->getDireccion() != "") {

                if (isset($ingresados['getNombreCompañia'])) {
                    $ingresados['getDireccion'] = "ok";
                    $sql .= ", `direccion`='{$this->getDireccion()}'";
                } else {
                    $ingresados['getDireccion'] = "ok";
                    $sql .= "`direccion`='{$this->getDireccion()}'";
                }
            }

            if ($this->getLogoProveedor() != "") {

                if (isset($ingresados['getDireccion'])) {
                    $ingresados['getLogoProveedor'] = "ok";
                    $sql .= ", `logoProveedor`='{$this->getLogoProveedor()}'";
                } else {
                    $ingresados['getLogoProveedor'] = "ok";
                    $sql .= "`logoProveedor`='{$this->getLogoProveedor()}'";
                }
            }

            if (count($ingresados) >= 1) {
                $sql .= " WHERE `idproveedores` = '{$this->getId()}'";
            }

            $update = $this->db->query($sql);

            $est = false;
            if ($update) {
                $est = true;
            }

            return $est;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite obtener todos proveedores de la base de datos
     *
     *
     * Este DocBlock documenta la función obtenerProveedors()
     * @return: $obtenido true o false
     */
    public function obtenerProveedors() {
        try {
            $sql = "SELECT * FROM `proveedores`";
            $lista = $this->db->query($sql);

            return $lista;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite obtener un proveedor de la base de datos por el id
     *
     *
     * Este DocBlock documenta la función agregarProveedor()
     * @return: $obtenido true o false
     */
    public function obtenerProveedor() {
        try {

            $sql = "SELECT * FROM `proveedores` WHERE idproveedores = {$this->getId()}";
            $proveedor_ent = $this->db->query($sql);

            return $proveedor_ent;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite obtener el listado de todos los pedidos asociados a el proveedor en base a su id
     *
     *
     * Este DocBlock documenta la función obtenerPedidosProveedor()
     * @return: $obtenido true o false
     */
    public function obtenerPedidosProveedor() {
        try {
            
            $sql = "SELECT * FROM pedido ped INNER JOIN proveedores prov ON prov.idproveedores = ped.proveedores_idproveedores "
                    . "WHERE prov.idproveedores = {$this->getId()} ";
                    
            $resultado = $this->db->query($sql);
            
            return $resultado;
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite la cantidad total proveedores registrados
     *
     * Este DocBlock documenta la función obtenerCantProv()
     * @return $resultado ResultSet
     */
    public function obtenerCantProv() {
        try {

            $sql = "SELECT COUNT(idproveedores) AS 'CANTPROV' FROM proveedores";
            $stock = $this->db->query($sql);
            $resultado = $stock->fetch_object();
            return $resultado;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
