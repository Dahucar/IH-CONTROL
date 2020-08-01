<?php

/**
 * Description of Turno
 *
 * @author Daniel Huenul
 */
class Turno {

    //put your code here
    private $id;
    private $codigo;
    private $nombre;
    private $fechaInicio;
    private $fechaTermino;
    private $estado;
    private $db;

    function __construct() {
        $this->db = bd::conectar();
    }

    /**
     * function que permite obtener el id de turno
     *
     *
     * Este DocBlock documenta la función getId()
     * @return: $id Integer
     */
    function getId() {
        return $this->id;
    }

    /**
     * function que permite obtener el codigo de turno
     *
     *
     * Este DocBlock documenta la función getCodigo()
     * @return: $codigo Integer
     */
    function getCodigo() {
        return $this->codigo;
    }

    /**
     * function que permite obtener el nombre de turno
     *
     *
     * Este DocBlock documenta la función getNombre()
     * @return: $nombre String
     */
    function getNombre() {
        return $this->nombre;
    }

    /**
     * function que permite obtener la fecha de inicio de turno
     *
     *
     * Este DocBlock documenta la función getFechaInicio()
     * @return: $fechaInicio String
     */
    function getFechaInicio() {
        return $this->fechaInicio;
    }

    /**
     * function que permite obtener estado de turno
     *
     *
     * Este DocBlock documenta la función getEstado()
     * @return: $estado String
     */
    function getEstado() {
        return $this->estado;
    }

    /**
     * function que permite obtener la fecha de termino de turno
     *
     *
     * Este DocBlock documenta la función getFechaTermino()
     * @return: $fechaTermino String
     */
    function getFechaTermino() {
        return $this->fechaTermino;
    }

    /**
     * function que permite establecer el id de turno
     *
     *
     * Este DocBlock documenta la función setId()
     * @param: $id Integer
     */
    function setId($id): void {
        $this->id = $id;
    }

    /**
     * function que permite establecer el codigo de turno
     *
     *
     * Este DocBlock documenta la función setCodigo()
     * @param: $codigo Integer
     */
    function setCodigo($codigo): void {
        $this->codigo = $codigo;
    }

    /**
     * function que permite establecer el nombre de turno
     *
     *
     * Este DocBlock documenta la función setNombre()
     * @param: $nombre String
     */
    function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    /**
     * function que permite establecer la fecha de inicio de turno
     *
     *
     * Este DocBlock documenta la función setCodigo()
     * @param: $fechaInicio String
     */
    function setFechaInicio($fechaInicio): void {
        $this->fechaInicio = $fechaInicio;
    }

    /**
     * function que permite establecer la fecha de termino de turno
     *
     *
     * Este DocBlock documenta la función setCodigo()
     * @param: $fechaTermino String
     */
    function setFechaTermino($fechaTermino): void {
        $this->fechaTermino = $fechaTermino;
    }

    /**
     * function que permite establecer el estado de turno
     *
     *
     * Este DocBlock documenta la función setEstado()
     * @param: $fechaTermino String
     */
    function setEstado($estado): void {
        $this->estado = $estado;
    }

    /**
     * function que agreagar un nuevo turno a la base de datos
     * 
     * Este DocBlock documenta la función setCodigo()
     * @return $est True o False
     */
    public function agregarTurno() {
        try {

            $sql = "INSERT INTO `turnos`(`idturnos`, `codigo`, `nombre`, `fecha_inicio`, `fecha_termino`, `estado`) "
                    . "VALUES (0,"
                    . "{$this->getCodigo()},"
                    . "'{$this->getNombre()}',"
                    . "'{$this->getFechaInicio()}',"
                    . "'{$this->getFechaTermino()}',"
                    . "'{$this->getEstado()}')";

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

    /**
     * function que permite obtener el listado completo de los turnos registrados en la base de datos
     * 
     * Este DocBlock documenta la función setCodigo()
     * @return $listado ResulSet
     */
    public function obtenerTurnos() {
        try {

            $sql = "SELECT * FROM `turnos`";
            $listado = $this->db->query($sql);

            return $listado;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite obtener un turno en particular en base a el ID asignados
     * 
     * Este DocBlock documenta la función obtenerTurno()
     * @return $turno ResulSet
     */
    public function obtenerTurno() {
        try {

            $sql = "SELECT * FROM `turnos` WHERE idturnos = {$this->getId()}";
            $turno = $this->db->query($sql);

            return $turno;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite modificar un turno ya registrado en la base de datos en base al ID
     * 
     * Este DocBlock documenta la función modificarTurno()
     *  
     */
    public function modificarTurno() {
        try {
            
            $sql = "UPDATE `turnos` SET "
                    . "`nombre`='{$this->db->real_escape_string($this->getNombre())}',"
                    . "`fecha_inicio`='{$this->getFechaInicio()}',"
                    . "`fecha_termino`='{$this->getFechaTermino()}',"
                    . "`estado`='{$this->getEstado()}' "
                    . "WHERE idturnos = {$this->getId()}";
            
            $modificado = $this->db->query($sql);
            
            $est = false;
            if($modificado){
                $est = true;
            }
            
            return $est;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite eliminar un turno ya registrado en la base de datos en base al ID
     * 
     * Este DocBlock documenta la función eliminarTurno()
     * @return $est True o False
     */
    public function eliminarTurno() {
        try {

            $sql = "DELETE FROM `turnos` WHERE `idturnos` = {$this->getId()}";
            $eliminar = $this->db->query($sql);

            $est = false;
            if ($eliminar) {
                $est = true;
            }

            return $est;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite establecer la relación entre turno y vendedor mediante los ID´S de ambos
     * 
     * Este DocBlock documenta la función eliminarTurno()
     * @param Integer $idVendedor id del vendedor
     * @param Integer $idTurno id del turno
     * @return $est True o False
     */
    public function asignarVendedorTurno($idVendedor, $idTurno) {
        try {

            $sql = "INSERT INTO `turno_de_vendedor`(`idturno_de_vendedor`, `vendedores_idvendedores`, `turnos_idturnos`) "
                    . "VALUES (0,{$idVendedor},{$idTurno})";

            $guardado = $this->db->query($sql);

            $est = false;
            if ($guardado) {
                $est = true;
            }

            return $est;
        } catch (Exception $ex) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite obtener el listado de todos los turnos asignados a un vendedor
     * 
     * Este DocBlock documenta la función obtenerTurosVendedor()
     * @param Integer $idvendedor id del vendedor 
     * @return $listadoTurnos ResulSet
     */
    public function obtenerTurosVendedor($idvendedor) {
        try {

            $sql = "SELECT tur.nombre, tur.fecha_inicio, tur.fecha_termino, tur.estado FROM turno_de_vendedor turvend "
                    . "INNER JOIN vendedores vend ON vend.idvendedores = turvend.vendedores_idvendedores "
                    . "INNER JOIN turnos tur ON tur.idturnos = turvend.turnos_idturnos "
                    . "WHERE vend.idvendedores = {$idvendedor} ";

            $listadoTurnos = $this->db->query($sql);

            return $listadoTurnos;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite la cantidad total turnos registrados
     *
     * Este DocBlock documenta la función obtenerCantTurn()
     * @return $resultado ResultSet
     */
    public function obtenerCantTurn() {
        try {

            $sql = "SELECT COUNT(idturnos) AS 'CANTTURN' FROM turnos";
            $stock = $this->db->query($sql);
            $resultado = $stock->fetch_object();
            return $resultado;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function eliminarTurnosVendedor(){
        try {
            $sql = "DELETE FROM `turno_de_vendedor` WHERE turnos_idturnos = {$this->getId()}";
            $eliminado = $this->db->query($sql);
            $est = false;
            if($eliminado){
                $est = true;
            }
            return $est;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
