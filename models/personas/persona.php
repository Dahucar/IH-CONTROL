<?php

/**
 * Clase que contiene los datos de una persona y 
 * los deja a disposición de sus clases hijas
 *
 * @author Daniel Huenul
 */
class Persona {

    private $id;
    private $codigo;
    private $rut;
    private $nombre;
    private $apellido_p;
    private $apellido_m;
    private $correo;
    private $clave;
    private $rol;

    function __construct() {
        
    }

    /**
     * function que permite obtener el id de usuario
     *
     *
     * Este DocBlock documenta la función getId()
     * @return: devuelve un entero en función del id obtenido
     */
    function getId() {
        return $this->id;
    }

    /**
     * function que permite obtener el codigo del usuario
     *
     *
     * Este DocBlock documenta la función getCodigo()
     * @return: devuelve un entero en función del código obtenido
     */
    function getCodigo() {
        return $this->codigo;
    }

    /**
     * function que permite obtener el rut de usuario
     *
     *
     * Este DocBlock documenta la función getRut()
     * @return: devuelve un String en función del rut obtenido
     */
    function getRut() {
        return $this->rut;
    }

    /**
     *function que permite obtener el nombre de usuario
     *
     *
     * Este DocBlock documenta la función getNombre()
     * @return: devuelve un String en función del nombre obtenido
     */
    function getNombre() {
        return $this->nombre;
    }

    /**
     * function que permite obtener el apellido paterno de usuario
     *
     *
     * Este DocBlock documenta la función getApellido_p()
     * @return: devuelve un String en función del apellido obtenido
     */
    function getApellido_p() {
        return $this->apellido_p;
    }

    /**
     * function que permite obtener el apellido materno de usuario
     *
     *
     * Este DocBlock documenta la función getApellido_m()
     * @return: devuelve un String en función del apellido obtenido
     */
    function getApellido_m() {
        return $this->apellido_m;
    }

    /**
     * function que permite obtener el correo de usuario
     *
     *
     * Este DocBlock documenta la función getCorreo()
     * @return: devuelve un String en función del correo obtenido
     */
    function getCorreo() {
        return $this->correo;
    }

    /**
     * function que permite obtener la clave de usuario
     *
     *
     * Este DocBlock documenta la función getClave()
     * @return: devuelve un String en función de la clave obtenido
     */
    function getClave() {
        return $this->clave;
    }

    /**
     * function que permite obtener el rol de usuario
     *
     *
     * Este DocBlock documenta la función getRol()
     * @return: devuelve un String en función del rol obtenido
     */
    function getRol() {
        return $this->rol;
    }

    /**
     * function que permite establecer el id para el usuario
     *
     *
     * Este DocBlock documenta la función setId()
     * @param: $id id que sera establecido para el usuario
     */
    function setId($id): void {
        $this->id = $id;
    }

    /**
     * function que permite establecer el codigo para el usuario
     *
     *
     * Este DocBlock documenta la función setCodigo()
     * @param: $codigo codigo que sera establecido para el usuario
     */
    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    /**
     * function que permite establecer el rut para el usuario
     *
     *
     * Este DocBlock documenta la función setRut()
     * @param: $rut rut que sera establecido para el usuario
     */
    function setRut($rut): void {
        $this->rut = $rut;
    }

    /**
     * function que permite establecer el nombre para el usuario
     *
     *
     * Este DocBlock documenta la función setNombre()
     * @param: $nombre nombre que sera establecido para el usuario
     */
    function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    /**
     * function que permite establecer el apellido paterno para el usuario
     *
     *
     * Este DocBlock documenta la función setApellido_p()
     * @param: $apellido_p apellido que sera establecido para el usuario
     */
    function setApellido_p($apellido_p): void {
        $this->apellido_p = $apellido_p;
    }

    /**
     * function que permite establecer el apellido materno para el usuario
     *
     *
     * Este DocBlock documenta la función setApellido_m()
     * @param: $apellido_m apellido paterno que sera establecido para el usuario
     */
    function setApellido_m($apellido_m): void {
        $this->apellido_m = $apellido_m;
    }

    /**
     * function que permite establecer el correo para el usuario
     *
     *
     * Este DocBlock documenta la función setCorreo()
     * @param: $correo correo que sera establecido para el usuario
     */
    function setCorreo($correo): void {
        $this->correo = $correo;
    }

    /**
     * function que permite establecer la clave para el usuario
     *
     *
     * Este DocBlock documenta la función setClave()
     * @param: $clave clave que sera establecido para el usuario
     */
    function setClave($clave): void {
        $this->clave = $clave;
    }

    /**
     * function que permite establecer el rol para el usuario
     *
     *
     * Este DocBlock documenta la función setRol()
     * @param: $rol clave que sera establecido para el usuario
     */
    function setRol($rol): void {
        $this->rol = $rol;
    }  

}
