<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vendedor
 *
 * @author Daniel Huenul
 */
class Vendedor extends Persona {

    private $foto;
    private $db;

    function __construct() {
        $this->db = bd::conectar();
    }

    /**
     * function que permite obtener foto de vendedor
     *
     *
     * Este DocBlock documenta la función getFoto()
     * @return: $foto String
     */
    function getFoto() {
        return $this->foto;
    }

    /**
     * function que permite establecer la foto de vendedor
     *
     *
     * Este DocBlock documenta la función setFoto()
     * @param: $foto String
     */
    function setFoto($foto): void {
        $this->foto = $foto;
    }

    /**
     * function que permite eliminar un producto en particular
     *
     *
     * Este DocBlock documenta la función agregarVendedor()
     * @return $est boolean true o false
     */
    public function agregarVendedor() {
        try {

            //idvendedores 	codigo 	rut 	nombre 	apellido_p 	apellido_m 	fotografica 	rol 	correo 	clave
            $sql = "INSERT INTO `vendedores`(`idvendedores`, `codigo`, `rut`, `nombre`, `apellido_p`, `apellido_m`, `fotografica`, `rol`, `correo`, `clave`) "
                    . "VALUES (0,"
                    . "{$this->db->real_escape_string($this->getCodigo())},"
                    . "'{$this->db->real_escape_string($this->getRut())}',"
                    . "'{$this->db->real_escape_string($this->getNombre())}',"
                    . "'{$this->db->real_escape_string($this->getApellido_p())}',"
                    . "'{$this->db->real_escape_string($this->getApellido_m())}',"
                    . "'{$this->db->real_escape_string($this->getFoto())}',"
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
     * function que permite obtener todos los vendedores de la base de datos
     *
     *
     * Este DocBlock documenta la función obtenerVendedores()
     * @return $listado
     */
    public function obtenerVendedores() {
        try {

            $sql = "SELECT * FROM `vendedores`";
            $listado = $this->db->query($sql);

            return $listado;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite obtener un  vendedor en particular de la base de datos por su ID
     *
     *
     * Este DocBlock documenta la función obtenerVendedor()
     * @return $resultado
     */
    public function obtenerVendedor() {
        try {

            $sql = "SELECT * FROM `vendedores` WHERE `idvendedores` = {$this->getId()}";
            $resultado = $this->db->query($sql);

            return $resultado;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite eliminar vendedores de la base de datos por su ID
     *
     *
     * Este DocBlock documenta la función eliminarVendedor()
     * @return $listado
     */
    public function eliminarVendedor() {
        try {

            $sql = "DELETE FROM `vendedores` WHERE `idvendedores` = {$this->getId()}";
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
     * function que permite modifcar un vendedor en particular de la base de datos por su ID
     *
     *
     * Este DocBlock documenta la función modificarVendedor()
     * @return $resultado
     */
    public function modificarVendedor() {
        try {

            $sql = "UPDATE `vendedores` SET ";

            $ingresados = array();
            if ($this->getRut() != "") {
                $ingresados['getRut'] = "ok";
                $sql .= "`rut`='{$this->db->real_escape_string($this->getRut())}'";
            }

            if ($this->getNombre() != "") {

                if (isset($ingresados['getRut'])) {
                    $ingresados['getNombre'] = "ok";
                    $sql .= ", `nombre`='{$this->db->real_escape_string($this->getNombre())}'";
                } else {
                    $ingresados['getNombre'] = "ok";
                    $sql .= "`nombre`='{$this->db->real_escape_string($this->getNombre())}'";
                }
            }

            if ($this->getApellido_p() != "") {

                if (isset($ingresados['getNombre'])) {
                    $ingresados['getApellido_p'] = "ok";
                    $sql .= ", `apellido_p`='{$this->db->real_escape_string($this->getApellido_p())}'";
                } else {
                    $ingresados['getApellido_p'] = "ok";
                    $sql .= "`apellido_p`='{$this->db->real_escape_string($this->getApellido_p())}'";
                }
            }

            if ($this->getApellido_m() != "") {

                if (isset($ingresados['getApellido_p'])) {
                    $ingresados['getApellido_m'] = "ok";
                    $sql .= ", `apellido_m`='{$this->db->real_escape_string($this->getApellido_m())}'";
                } else {
                    $ingresados['getApellido_m'] = "ok";
                    $sql .= "`apellido_m`='{$this->db->real_escape_string($this->getApellido_m())}'";
                }
            }

            if ($this->getFoto() != "") {

                if (isset($ingresados['getApellido_m'])) {
                    $ingresados['getFoto'] = "ok";
                    $sql .= ", `fotografica`='{$this->db->real_escape_string($this->getFoto())}'";
                } else {
                    $ingresados['getFoto'] = "ok";
                    $sql .= "`fotografica`='{$this->db->real_escape_string($this->getFoto())}'";
                }
            }

            if ($this->getCorreo() != "") {

                if (isset($ingresados['getFoto'])) {
                    $ingresados['getCorreo'] = "ok";
                    $sql .= ", `correo`='{$this->db->real_escape_string($this->getCorreo())}'";
                } else {
                    $ingresados['getCorreo'] = "ok";
                    $sql .= ",`correo`='{$this->db->real_escape_string($this->getCorreo())}'";
                }
            }

            if ($this->getClave() != "") {

                if (isset($ingresados['getCorreo'])) {
                    $ingresados['getClave'] = "ok";
                    $sql .= ", `clave`='{$this->db->real_escape_string($this->getClave())}'";
                } else {
                    $ingresados['getClave'] = "ok";
                    $sql .= "`clave`='{$this->db->real_escape_string($this->getClave())}'";
                }
            }

            if (count($ingresados) >= 1) {
                $sql .= " WHERE `idvendedores`= {$this->getId()}";
            }


//            echo "<h1 style='color: white; background: black;'>". $sql ."</h1>";
//             die();
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
     * function que permite que el vendedor acceda al sistema como un ususario registrado
     * 
     * Este DocBlock documenta la función loginVendedor()
     * @return: revuelve un boolean o un resultado de la base de datos
     */
    public function loginVendedor() {
        try {

            $vendedor_buscado = false;
            $email_busqueda = $this->getCorreo();
            $clave_busqueda = $this->getClave();


            $sql = "SELECT * FROM `vendedores` WHERE `correo` = '{$email_busqueda}'";
            $login = $this->db->query($sql);

            if ($login && $login->num_rows == 1) {

                //guardo el resulset en cliente
                $vendedor = $login->fetch_object();

                $es_correcta = password_verify($clave_busqueda, $vendedor->clave);
                if ($es_correcta) {
                    $vendedor_buscado = $vendedor;
                }
            }

            return $vendedor_buscado;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite la cantidad total vendedores registrados
     *
     * Este DocBlock documenta la función obtenerCantVend()
     * @return $resultado ResultSet
     */
    public function obtenerCantVend() {
        try {

            $sql = "SELECT COUNT(idvendedores) AS 'CANTVEND' FROM vendedores";
            $stock = $this->db->query($sql);
            $resultado = $stock->fetch_object();
            return $resultado;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite obtener un vendedor por su rut
     *
     * Este DocBlock documenta la función obtenerVendedorRut()
     * @return $resultado ResultSet
     */ 
    public function obtenerVendedorRut(){
        try {

            $sql = "SELECT * FROM `vendedores` WHERE rut = '{$this->getRut()}'";
            $busdao = $this->db->query($sql);
            $resultado = $busdao->fetch_object();
            return $resultado;

        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite obtener un vendedor por su correo
     *
     * Este DocBlock documenta la función obtenerVendedorCorreo()
     * @return $resultado ResultSet
     */ 
    public function obtenerVendedorCorreo(){
        try {

            $sql = "SELECT * FROM `vendedores` WHERE correo = '{$this->getCorreo()}'";
            $busdao = $this->db->query($sql);
            $resultado = $busdao->fetch_object();
            return $resultado;

        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }


}
