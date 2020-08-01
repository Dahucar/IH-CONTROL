<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CarroCompra
 *
 * @author Daniel Huenul
 */
class CarroCompra {
    //put your code here
    private $id;
    private $cantidadProductos;
    private $total;
    
    function __construct() {
        
    }
    function getId() {
        return $this->id;
    }

    function getCantidadProductos() {
        return $this->cantidadProductos;
    }

    function getTotal() {
        return $this->total;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setCantidadProductos($cantidadProductos): void {
        $this->cantidadProductos = $cantidadProductos;
    }

    function setTotal($total): void {
        $this->total = $total;
    }

    public function totalizarCarro() {
        echo 'totalizarCarro';
    }

    public function agregarProductos() {
        echo 'agregarProductos';
    }

    public function quitarProductos() {
        echo 'quitarProductos';
    }
}
