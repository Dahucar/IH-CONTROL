<?php 
/**
 * Clase que contiene los parametros y funciones necesarias para realizar CRUD sobre el modelo de administrador
 *
 * @author Daniel Huenul
 */
class administrador extends Persona {

    //put your code here
    private $db;

    function __construct() {
        $this->db = bd::conectar();
    }

    /**
     * function que permite agregar un nuevo administrador al sistema
     * 
     * Este DocBlock documenta la función agregarAdministrador()
     * @return: boolean true o false
     */
    public function agregarAdministrador() {
        $sql = "INSERT INTO `administrador`(`idadministrador`, `codigo`, `rut`, `nombre`, `apellido_p`, `apellido_m`, `rol`, `correo`, `clave`) "
                . "VALUES (0, '{$this->getCodigo()}', '{$this->getRut()}', '{$this->getNombre()}', '{$this->getApellido_p()}', '{$this->getApellido_m()}', '{$this->getRol()}','{$this->getCorreo()}','{$this->getClave()}')";

 
        $guardar = $this->db->query($sql);
        $est = false;
        if ($guardar) {
            $est = true;
        }
        return $est;
    }

    /**
     * function que permite que el administradir acceda al sistema como un ususario registrado
     * 
     * Este DocBlock documenta la función loginAdministrador()
     * @return: revuelve un boolean o un resultado de la base de datos
     */
    public function loginAdministrador() {
        try {

            $adm_buscado = false;
            $email_busqueda = $this->getCorreo();
            $clave_busqueda = $this->getClave();

            $sql = "SELECT * FROM `administrador` WHERE `correo` = '{$email_busqueda}'";
            $login = $this->db->query($sql);

            if ($login && $login->num_rows == 1) {
                //guardo el resulset en administrador
                $adm = $login->fetch_object();

                if ($adm->correo == "root@root.com") {
                    if ($adm->clave == $clave_busqueda) {
                        $adm_buscado = $adm;
                    }
                } else {
                    $es_correcta = password_verify($clave_busqueda, $adm->clave);
                    if ($es_correcta) {
                        $adm_buscado = $adm;
                    }
                }
            }

            return $adm_buscado;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite modificar un administrador en particular de la base de datos
     * Este DocBlock documenta la función modificarAdministrador()
     * @return: $est True o Flase
     */
    public function modificarAdministrador() {
        try{

            $sql = "UPDATE `administrador` SET";

            $correctos = array();
            if($this->getRut() != ""){
                $correctos['getRut'] = 'ok';
                $sql .= " `rut` = '{$this->getRut()}'";
            }

            if($this->getNombre() != ""){
                if(isset($correctos['getRut'])){
                    $correctos['getNombre'] = 'ok';
                    $sql .= ", `nombre` = '{$this->getNombre()}'";
                }else{
                    $correctos['getNombre'] = 'ok';
                    $sql .= " `nombre` = '{$this->getNombre()}'";
                }
            }

            if($this->getApellido_p() != ""){
                if(isset($correctos['getNombre'])){
                    $correctos['getApellido_p'] = 'ok';
                    $sql .= ", `apellido_p` = '{$this->getApellido_p()}'";
                }else{
                    $correctos['getApellido_p'] = 'ok';
                    $sql .= " `apellido_p` = '{$this->getApellido_p()}'";
                }
            }

            if($this->getApellido_m() != ""){
                if(isset($correctos['getApellido_p'])){
                    $correctos['getApellido_m'] = 'ok';
                    $sql .= ", `apellido_m` = '{$this->getApellido_m()}'";
                }else{
                    $correctos['getApellido_m'] = 'ok';
                    $sql .= " `apellido_m` = '{$this->getApellido_m()}'";
                }
            }

            if($this->getCorreo() != ""){
                if(isset($correctos['getApellido_m'])){
                    $correctos['getCorreo'] = 'ok';
                    $sql .= ", `correo` = '{$this->getCorreo()}'";
                }else{
                    $correctos['getCorreo'] = 'ok';
                    $sql .= " `correo` = '{$this->getCorreo()}'";
                }
            }

            if($this->getClave() != ""){
                if(isset($correctos['getCorreo'])){
                    $correctos['getClave'] = 'ok';
                    $sql .= ", `clave` = '{$this->getClave()}'";
                }else{
                    $correctos['getClave'] = 'ok';
                    $sql .= " `clave` = '{$this->getClave()}'";
                }
            }

            if (count($correctos) >= 1) {

                $sql .= " WHERE `idadministrador` = {$this->getId()}";
            }
 
            $modificar = $this->db->query($sql);

            //var_dump($this);
            //echo "<h1 style='color: red'> $sql </h1>";
            //var_dump($modificar); die();

            $est = false;
            if ($modificar) {
                $est = true;
            }

            return $est;

        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } 
    }

    /**
     * function que permite eliminar un administrador de la base de datos por su id
     *
     *
     * Este DocBlock documenta la función obtenerAdministrador()
     * @return: $obtenido true o false
     */
    public function eliminarAdministrador() {
        try {
            $sql = "DELETE FROM `administrador` WHERE idadministrador = {$this->getId()}";
            $del = $this->db->query($sql);
            
            $est = false;
            if ($del) {
                $est = true;
            }

            return $est;

        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite obtener administrador de la base de datos en funcion del correo
     *
     *
     * Este DocBlock documenta la función obtenerAdministrador()
     * @return: $obtenido true o false
     */
    public function obtenerAdministrador() {
        try {
            $resultado = false;

            $sql = "SELECT * FROM `administrador` WHERE correo = '{$this->getCorreo()}'";
            $econtrado = $this->db->query($sql);

            if ($econtrado->num_rows == 1) {
                $adm = $econtrado->fetch_object();
                if ($adm->clave == $this->getClave()) {
                    $resultado = $adm;
                }
            }

            return $resultado;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite obtener un administrador de la base de datos por el correo
     *
     *
     * Este DocBlock documenta la función obtenerAdministradorCorreo()
     * @return: $obtenido true o false
     */
    public function obtenerAdministradorCorreo() {
        try {

            $sql = "SELECT * FROM `administrador` WHERE correo = '{$this->getCorreo()}' ";
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
     * function que permite obtener un administrador de la base de datos por el rut
     *
     *
     * Este DocBlock documenta la función obtenerAdministradorRut()
     * @return: $obtenido ResultSet
     */
    public function obtenerAdministradorRut() {
        try {

            $sql = "SELECT * FROM `administrador` WHERE rut = '{$this->getRut()}'";
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
     * function que permite obtener un administrador en base a su ID
     *
     *
     * Este DocBlock documenta la función obtenerAdm()
     * @return: $resultado ResutSet
     */
    public function obtenerAdm() {
        try {

            $sql = "SELECT * FROM `administrador` WHERE idadministrador = '{$this->getId()}'";
            $resultado = $this->db->query($sql);

            return $resultado;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite obtener todos los administradores del sistema
     *
     *
     * Este DocBlock documenta la función obtenerAdministradores()
     * @return: $resultado ResutSet
     */
    public function obtenerAdministradores() {
        try {

            $sql = "SELECT * FROM `administrador`";
            $resultado = $this->db->query($sql);

            return $resultado;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
