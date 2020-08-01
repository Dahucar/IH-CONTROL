<?php

/**
 * Clase que contine todos los atributos y metodos para operar los datos 
 * de las botas de la base de datos
 *
 * @author Daniel Huenul
 */
class Boleta {

    //put your code here
    private $id;
    private $codigo;
    private $detalle;
    private $db;

    function __construct() {
        $this->db = bd::conectar();
    }

    /**
     * function que permite obtener el id de boleta 
     *
     * Este DocBlock documenta la función getId()
     * @return Integer $id 
     */
    function getId() {
        return $this->id;
    }

    /**
     * function que permite obtener el codigo de boleta 
     *
     * Este DocBlock documenta la función getCodigo()
     * @return Integer $codigo 
     */
    function getCodigo() {
        return $this->codigo;
    }

    /**
     * function que permite obtener el detalle de boleta 
     *
     * Este DocBlock documenta la función getDetalle()
     * @return Integer $detalle 
     */
    function getDetalle() {
        return $this->detalle;
    }

    /**
     * function que permite establecer el id de boleta
     *
     *
     * Este DocBlock documenta la función setId($id)
     * @param Integer $id 
     */
    function setId($id): void {
        $this->id = $id;
    } 

    /**
     * function que permite establecer el codigo de boleta
     *
     *
     * Este DocBlock documenta la función setCodigo($codigo)
     * @param Integer $id 
     */
    function setCodigo($codigo): void {
        $this->codigo = $codigo;
    }

    /**
     * function que permite establecer el detalle de una boleta
     *
     *
     * Este DocBlock documenta la función setDetalle($detalle)
     * @param String $detalle 
     */
    function setDetalle($detalle): void {
        $this->detalle = $detalle;
    }

    /**
     * function que permite crear un nueva boleta para guardarla en la base de datos
     *
     *
     * Este DocBlock documenta la función crearBoleta()
     * @return bolean $est true o false 
     */
    public function crearBoleta() {
        try {

            $sql = "INSERT INTO `boleta`(`idboleta`, `codigo`, `fecha`, `detalle`) "
                    . "VALUES (0,{$this->getCodigo()}, CURRENT_TIMESTAMP,'{$this->getDetalle()}')";

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
     * function que permite obtener una boleta en particular de la base de datos
     *
     *
     * Este DocBlock documenta la función obtenerBoletaCodigo()
     * @return ResulSet $resultado 
     */
    public function obtenerBoletaCodigo() {
        try {
            $sql = "SELECT * FROM `boleta` WHERE codigo = {$this->getCodigo()}";
            $resultado = $this->db->query($sql);
            
            return $resultado;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function modificarBoleta() {
        echo 'modificarBoleta';
    }

    public function eliminarBoleta() {
        echo 'eliminarBoleta';
    }

    public function obtenerBoleta() {
        echo 'obtenerBoleta';
    }

}
