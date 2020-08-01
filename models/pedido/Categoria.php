<?php

/**
 * Clase controladora de los mudlos destinados a las categorias de productos
 *
 * @author Daniel Huenul
 */
class Categoria {

    private $id;
    private $codigo;
    private $nombre;
    private $db;

    function __construct() {
        $this->db = bd::conectar();
    }

    /**
     * function que permite obtener el id de la categoria
     *
     *
     * Este DocBlock documenta la función getId()
     * @return: $id Integer
     */
    function getId() {
        return $this->id;
    }

    /**
     * function que permite obtener el codigo de la categoria
     *
     *
     * Este DocBlock documenta la función getCodigo()
     * @return: $codigo Integer
     */
    function getCodigo() {
        return $this->codigo;
    }

    /**
     * function que permite obtener el nombre de la categoria
     *
     *
     * Este DocBlock documenta la función getNombre()
     * @return: $nombre String
     */
    function getNombre() {
        return $this->nombre;
    }

    /**
     * function que permite establecer el id para la categoria
     *
     *
     * Este DocBlock documenta la función setId()
     * @param: $id Integer
     */
    function setId($id): void {
        $this->id = $id;
    }

    /**
     * function que permite establecer el codigo para la categoria
     *
     *
     * Este DocBlock documenta la función setCodigo()
     * @param: $codigo Integer
     */
    function setCodigo($codigo): void {
        $this->codigo = $codigo;
    }

    /**
     * function que permite establecer el nombre para la categoria
     *
     *
     * Este DocBlock documenta la función setNombre()
     * @param: $nombre String
     */
    function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    /**
     * function que permite guardar una nueva categoria
     *
     *
     * Este DocBlock documenta la función agregarCategoria()
     * @return: true o false boolean 
     */
    public function agregarCategoria() {
        try {

            $sql = "INSERT INTO `categoria_producto`(`idcategoria_producto`, `codigo`, `categoria`) "
                    . "VALUES (0,"
                    . "'{$this->db->real_escape_string($this->getCodigo())}',"
                    . "'{$this->db->real_escape_string($this->getNombre())}')";

            $resultado = $this->db->query($sql);

            $est = false;
            if ($resultado) {
                $est = true;
            }
            
            return $est;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    /**
     * funtion que permite obtener una categoria en espesifico de la base de datos
     *
     *
     * Este DocBlock documenta la función obtenerCategoria()
     * @return: $cat String
     */
    public function obtenerCategoria() {
        try {
             
            $cat = false;
            $sql = "SELECT * FROM `categoria_producto` WHERE `nombre` = '{$this->getNombre()}'";
            $result = $this->db->query($sql); 
            
            if($result && $result->num_rows == 1){
               $cat = $result->fetch_object()->nombre;  
            }
            
            return $cat;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    /**
     * funtion que permite obtener todas las categorías de la base de datos
     *
     *
     * Este DocBlock documenta la función obtenerCategorias()
     * @return: $contenido String
     */
    public function obtenerCategorias() {
        try {
            
            $sql = "SELECT * FROM `categoria_producto`";
            $categorias = $this->db->query($sql);
            
            return $categorias;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    /**
     * funtion que permite una eliminar una categoría de la base de datos
     *
     *
     * Este DocBlock documenta la función obtenerCategorias()
     * @return: $delete Boolean
     */ 
    public function eliminarCategoria() {
        try {
    
            $sql = "DELETE FROM `categoria_producto` WHERE `idcategoria_producto` = {$this->getId()}";
            
            
            $delete = $this->db->query($sql); 
            $est = false;
            if($delete){
                $est = true;
            }
            
            return $est;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    /**
     * funtion que permite una modificar una categoría de la base de datos
     *
     *
     * Este DocBlock documenta la función obtenerCategorias()
     * @return: $delete Boolean
     */ 
    public function modificarCategoria() {
        try {
    
            $sql = "DELETE FROM `categoria_producto` WHERE `idcategoria_producto` = {$this->getId()}";
            
            
            $delete = $this->db->query($sql); 
            $est = false;
            if($delete){
                $est = true;
            }
            
            return $est;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
