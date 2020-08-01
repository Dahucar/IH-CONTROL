<?php

/**
 * Clase que contiene todos los datos de una alerta
 *
 * @author Daniel Huenul
 */
class Alerta {

    private $id;
    private $codigo;
    private $asunto;
    private $mensaje;
    private $estado;
    private $db;

    function __construct() {
        $this->db = bd::conectar();
    }

    /**
     * function que permite obtener el id de Alerta
     *
     *
     * Este DocBlock documenta la función getId()
     * @return: $id Integer
     */
    function getId() {
        return $this->id;
    }

    /**
     * function que permite obtener el codigo de Alerta
     *
     *
     * Este DocBlock documenta la función getCodigo()
     * @return: $codigo Integer
     */
    function getCodigo() {
        return $this->codigo;
    }

    /**
     * function que permite obtener el asunto de Alerta
     *
     *
     * Este DocBlock documenta la función getAsunto()
     * @return: $asunto String
     */
    function getAsunto() {
        return $this->asunto;
    }

    /**
     * function que permite obtener el mensaje de Alerta
     *
     *
     * Este DocBlock documenta la función getMensaje()
     * @return: $mensaje String
     */
    function getMensaje() {
        return $this->mensaje;
    }

    /**
     * function que permite obtener el estado de Alerta
     *
     *
     * Este DocBlock documenta la función getEstado()
     * @return: $estado String
     */
    function getEstado() {
        return $this->estado;
    }

    /**
     * function que permite establecer el id de Alerta
     *
     *
     * Este DocBlock documenta la función setId()
     * @param: $id Integer
     */
    function setId($id): void {
        $this->id = $id;
    }

    /**
     * function que permite establecer el codigo de Alerta
     *
     *
     * Este DocBlock documenta la función setCodigo()
     * @param: $codigo Integer
     */
    function setCodigo($codigo): void {
        $this->codigo = $codigo;
    }

    /**
     * function que permite establecer el asunto de Alerta
     *
     *
     * Este DocBlock documenta la función setAsunto()
     * @param: $asunto String
     */
    function setAsunto($asunto): void {
        $this->asunto = $asunto;
    }

    /**
     * function que permite establecer el mensaje de Alerta
     *
     *
     * Este DocBlock documenta la función setMensaje()
     * @param: $mensaje String
     */
    function setMensaje($mensaje): void {
        $this->mensaje = $mensaje;
    }

    /**
     * function que permite establecer el estado de Alerta
     *
     *
     * Este DocBlock documenta la función setEstado()
     * @param: $estado String
     */
    function setEstado($estado): void {
        $this->estado = $estado;
    }

    /**
     * function que permite agregar una nueva alerta a la base de datos
     *
     *
     * Este DocBlock documenta la función agregar()
     * @return $est Boolean
     */
    public function agregar() {
        try {

            $sql = "INSERT INTO `alertas`(`idalertas`, `codigo`, `asunto`, `mensaje`, `fecha_envio`, `estadoAlerta`) "
                    . "VALUES ("
                    . "0,"
                    . "{$this->getCodigo()},"
                    . "'{$this->db->real_escape_string($this->getAsunto())}',"
                    . "'{$this->db->real_escape_string($this->getMensaje())}',"
                    . "CURRENT_TIMESTAMP, "
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
     * function que permite obtener todas las alerta de la base de datos
     *
     *
     * Este DocBlock documenta la función obtenerAlertas()
     * @return $listado Boolean
     */
    public function obtenerAlertas() {
        try {

            $sql = "SELECT * FROM `alertas`";
            $listado = $this->db->query($sql);
            return $listado;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite obtener una alerta de la base de datos
     *
     *
     * Este DocBlock documenta la función obtenerAlertas()
     * @return $listado Boolean
     */
    public function obtenerAlerta() {
        try {

            $sql = "SELECT * FROM `alertas` WHERE `idalertas` = {$this->getId()}";
            $alerta = $this->db->query($sql);
            
            return $alerta;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite obtener una alerta de la base de datos en base al codigo
     *
     *
     * Este DocBlock documenta la función obtenerAlertaCodigo()
     * @return $alerta ResultSet
     */
    public function obtenerAlertaCodigo() {
        try {

        $sql = "SELECT * FROM `alertas` WHERE codigo = {$this->getCodigo()}";
            $alerta = $this->db->query($sql);
            
            return $alerta;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite obtener todas las alerta de la base de datos
     *
     *
     * Este DocBlock documenta la función obtenerAlertas()
     * @return $est Boolean
     */
    public function eliminarAlerta() {
        try {

            $sql = "DELETE FROM `alertas` WHERE `idalertas` = {$this->getId()}";
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
     * function que permite modificar una alerta existente
     *
     *
     * Este DocBlock documenta la función modificarAlerta()
     * @return $est Boolean
     */ 
    public function modificarAlerta() {
        try {
            
            $sql = "UPDATE `alertas` SET";
            
            $ingresados = array();
            if ($this->getAsunto() != "") {
                $ingresados['getAsunto'] = "ok";
                $sql .= " `asunto` = '{$this->getAsunto()}'";
            }

            if ($this->getMensaje() != "") {

                if (isset($ingresados['getAsunto'])) {
                    $ingresados['getMensaje'] = "ok";
                    $sql .= ", `mensaje` = '{$this->getMensaje()}'";
                } else {
                    $ingresados['getMensaje'] = "ok";
                    $sql .= "`mensaje` = '{$this->getMensaje()}'";
                }
            }

            if($this->getEstado() != ""){
                if (isset($ingresados['getMensaje']) ||
                isset($ingresados['getAsunto'])) {
                    //`fecha_envio CURRENT_TIMESTAMP
                    $ingresados['getEstado'] = "ok";
                    $sql .= ", `estadoAlerta` = '{$this->getEstado()}'";
                    $sql .= ", `fecha_envio` = CURRENT_TIMESTAMP";
                } else {
                    $ingresados['getEstado'] = "ok";
                    $sql .= "`estadoAlerta` = '{$this->getEstado()}'";
                    $sql .= ", `fecha_envio` = CURRENT_TIMESTAMP";
                }
            }
            
            if(count($ingresados) >= 1){
                $sql .= " WHERE `idalertas` = {$this->getId()}";
            }
            
            $modificado = $this->db->query($sql);
             
            
            $mod = false;
            if($modificado){
                $mod = true;
            }  
            
            return $mod;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite la cantidad total de alertas registrados
     *
     * Este DocBlock documenta la función obtenerCantAlert()
     * @return $resultado ResultSet
     */
    public function obtenerCantAlert() {
        try {

            $sql = "SELECT COUNT(idalertas) AS 'CANTALERT' FROM alertas";
            $stock = $this->db->query($sql);
            $resultado = $stock->fetch_object();
            return $resultado;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite la cantidad total de alertas registrados
     *
     * Este DocBlock documenta la función asignarAlertaAdministrador()
     * @param Array $idsAdm Listado de ids de los los administradores
     * @param Integer $idAlerta ID de la alerta que estara realacionada con los administradores
     * @return $est True o False
     */
    public function asignarAlertaAdministrador($idAlerta, $idsAdm){
        try {
            $sql = "INSERT INTO `alerta_adm`(`idalerta_adm`, `administrador_idadministrador`, `alertas_idalertas`) VALUES ";
            foreach ($idsAdm as $i => $valor) {
                if($i == 0){
                    $sql .= "(0, $valor, $idAlerta)";
                }else{
                    $sql .= ", (0, $valor, $idAlerta)";
                }
            }
            $agregado = $this->db->query($sql);
            $est = false;
            if($agregado){
                $est = true;
            }
            return $est;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite eliminar de la base de datos las asociaciones entre administradores y alertas
     *
     * Este DocBlock documenta la función obtenerCantAlert()
     * @return $est True o False
     */
    public function eliminarAlertaAdministrador(){
        try{
            $sql = "DELETE FROM `alerta_adm` WHERE alertas_idalertas = {$this->getId()} ";
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
     * function que permite obtener el listado de alertas que estan pendiente a enviar y los 
     * administradores a los cuales se encuentran asociadas
     * 
     *
     * Este DocBlock documenta la función obtenerAlertasAdministrador()
     * @return $resultado ResultSet
     */
    public function obtenerAlertasAdministrador(){
        try{
            $sql = "SELECT aler.idalertas, aler.asunto, aler.mensaje, aler.estadoAlerta, adm.nombre, adm.apellido_p, adm.apellido_m, adm.correo"
            . " FROM alerta_adm alam"
            . " INNER JOIN alertas aler ON aler.idalertas = alam.alertas_idalertas " 
            . " INNER JOIN administrador adm ON adm.idadministrador = alam.administrador_idadministrador " 
            . " WHERE aler.estadoAlerta = 'PENDIENTE' ";
            $resultado = $this->db->query($sql); 

            return $resultado;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
}
