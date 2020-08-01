<?php

/**
 * Claque que proporciona los atributos y funcionalidades 
 * relacionadas con la base de datos
 *
 * @author Daniel Huenul
 */
class Estado {

    private $id;
    private $codigo;
    private $estado;
    private $db;

    function __construct() {
        $this->db = bd::conectar();
    }

    /**
     * function que permite obtener el id de Estado
     *
     *
     * Este DocBlock documenta la función getId()
     * @return: $id Integer
     */
    function getId() {
        return $this->id;
    }

    /**
     * function que permite obtener el codigo de Estado
     *
     *
     * Este DocBlock documenta la función getCodigo()
     * @return: $codigo Integer
     */
    function getCodigo() {
        return $this->codigo;
    }

    /**
     * function que permite obtener el estado de Estado
     *
     *
     * Este DocBlock documenta la función getEstado()
     * @return: $estado String
     */
    function getEstado() {
        return $this->estado;
    }

    /**
     * function que permite establecer el id para el Estado
     *
     *
     * Este DocBlock documenta la función setId()
     * @param: $id Integer
     */
    function setId($id): void {
        $this->id = $id;
    }

    /**
     * function que permite establecer el codigo para el Estado
     *
     *
     * Este DocBlock documenta la función setId()
     * @param: $codigo Integer
     */
    function setCodigo($codigo): void {
        $this->codigo = $codigo;
    }

    /**
     * function que permite establecer el estado para el Estado
     *
     *
     * Este DocBlock documenta la función setEstado()
     * @param: $estado String
     */
    function setEstado($estado): void {
        $this->estado = $estado;
    }

    /**
     * function que permite guardar una nuevo estado en la base de datos
     *
     *
     * Este DocBlock documenta la función agregarEstado()
     * @return: true o false boolean 
     */
    public function agregarEstado() {
        try {

            $sql = "INSERT INTO `estados`(`idestados`, `codigo`, `estado`) "
                    . "VALUES ("
                    . "0,"
                    . "'{$this->db->real_escape_string($this->getCodigo())}',"
                    . "'{$this->db->real_escape_string($this->getEstado())}')";

            $agregar = $this->db->query($sql);

            $est = false;
            if ($agregar) {
                $est = true;
            }

            return $est;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite obtener un estado en particular de la base de datos
     *
     *
     * Este DocBlock documenta la función obtenerEstado()
     * @return:  $est Estado 
     */
    public function obtenerEstado() {
        try {

            $est = false;
            $sql = "SELECT * FROM `estados` WHERE `estado` = '{$this->getEstado()}'";
            $result = $this->db->query($sql); 
             
            if ($result && $result->num_rows == 1) {
                $est = $result->fetch_object(); 
            }

            return $est; 
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite obtener todos los estados de la base de datos
     *
     *
     * Este DocBlock documenta la función obtenerEstados()
     * @return: true o false boolean 
     */
    public function obtenerEstados() {
        try {
            
            $sql = "SELECT * FROM `estados`";
            $obtenidos = $this->db->query($sql);
            
            return $obtenidos;
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    /**
     * funtion que permite eliminar un estado de la base de datos
     *
     *
     * Este DocBlock documenta la función eliminarEstado()
     * @return: $delete Boolean
     */
    public function eliminarEstado() {
        try {
            $sql = "DELETE FROM `estados` WHERE `idestados` = {$this->getId()}";
            $eliminar = $this->db->query($sql);
            
            $est = false;
            if($eliminar){
                $est = true;
            }
            
            return $est;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
