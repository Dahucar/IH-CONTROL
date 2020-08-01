<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CuentaCliente
 *
 * @author Daniel Huenul
 */
class CuentaCliente {
    //put your code here
    private $id;
    private $correo;
    private $contraseña;
    private $ultimoInicio;
    private $idCliente;
    private $db;
    
    function __construct() {
        $this->db= bd::conectar();
    }
     
    function getId() {
        return $this->id;
    }

    function getCorreo() {
        return $this->correo;
    }

    function getContraseña() {
        return $this->contraseña;
    }

    function getUltimoInicio() {
        return $this->ultimoInicio;
    }

    function getIdCliente() {
        return $this->idCliente;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setCorreo($correo): void {
        $this->correo = $correo;
    }

    function setContraseña($contraseña): void {
        $this->contraseña = $contraseña;
    }

    function setUltimoInicio($ultimoInicio): void {
        $this->ultimoInicio = $ultimoInicio;
    }

    function setIdCliente($idCliente): void {
        $this->idCliente = $idCliente;
    }

    
    public function agregarCuenta() {
       //idcuenta_cliente	correo	contrasenna	ultimaSesion	clientes_idclientes
        $sql = "INSERT INTO `cuenta_cliente`(`idcuenta_cliente`, `correo`, `contrasenna`, `ultimaSesion`, `clientes_idclientes`) "
                . "VALUES (0,'{$this->correo}','{$this->contraseña}','{$this->ultimoInicio}','{$this->idCliente}')";
        $guardar = $this->db->query($sql);
        $est = false;
        if($guardar){
            $est = true;
        }
        return $est;
        
    }

    public function eliminarCuenta() {
        echo "eliminarCuenta";
    }

    public function modificarCliente() {
        echo "modificarCuenta";
    }

    public function obtenerCliente() {
        echo "obtenerCuenta";
    }

}
