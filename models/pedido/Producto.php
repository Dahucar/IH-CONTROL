<?php

require_once 'models/pedido/Categoria.php';

/**
 * Clase con todos los parametros establecidos para un producto en la base de datos
 *
 * @author Daniel Huenul
 */
class Producto {

    //put your code here
    private $id;
    private $codigo;
    private $nombre;
    private $detalle;
    private $precio;
    private $stock;
    private $cantMin;
    private $cantMax;
    private $imagenPrincipal;
    private $categoria;
    private $estado;
    private $db;

    function __construct() {
        $this->db = bd::conectar();
    }

    /**
     * function que permite obtener el id de Producto
     *
     *
     * Este DocBlock documenta la función getId()
     * @return: $id Integer
     */
    function getId() {
        return $this->id;
    }

    /**
     * function que permite obtener el nombre de Producto
     *
     *
     * Este DocBlock documenta la función getNombre()
     * @return: $nombre String
     */
    function getNombre() {
        return $this->nombre;
    }

    /**
     * function que permite obtener la categoria de Producto
     *
     *
     * Este DocBlock documenta la función getCategoria()
     * @return: $categoria Categoria
     */
    function getCategoria() {
        return $this->categoria;
    }

    /**
     * function que permite obtener el detalle de Producto
     *
     *
     * Este DocBlock documenta la función getDetalle()
     * @return: $detalle String
     */
    function getDetalle() {
        return $this->detalle;
    }

    /**
     * function que permite obtener el estado de Producto
     *
     *
     * Este DocBlock documenta la función getEstado()
     * @return: $estado String
     */
    function getEstado() {
        return $this->estado;
    }

    /**
     * function que permite obtener el precio de Producto
     *
     *
     * Este DocBlock documenta la función getPrecio()
     * @return: $precio Float
     */
    function getPrecio() {
        return $this->precio;
    }

    /**
     * function que permite obtener el stock de Producto
     *
     *
     * Este DocBlock documenta la función getStock()
     * @return: $stock Integer
     */
    function getStock() {
        return $this->stock;
    }

    /**
     * function que permite obtener lca cantidad minima del stock de un producto
     *
     *
     * Este DocBlock documenta la función getCantMin()
     * @return: $cantMin Integer
     */
    function getCantMin() {
        return $this->cantMin;
    }

    /**
     * function que permite obtener lca cantidad máxima del stock de un producto
     *
     *
     * Este DocBlock documenta la función getCantMax()
     * @return: $cantMax Integer
     */
    function getCantMax() {
        return $this->cantMax;
    }

    /**
     * function que permite obtener el codigo de Producto
     *
     *
     * Este DocBlock documenta la función getCodigo()
     * @return: $codigo Integer
     */
    function getCodigo() {
        return $this->codigo;
    }

    /**
     * function que permite obtener la ruta de la imagen principal de Producto
     *
     *
     * Este DocBlock documenta la función getCodigo()
     * @return: $codigo Integer
     */
    function getImagenPrincipal() {
        return $this->imagenPrincipal;
    }

    /**
     * function que permite establecer el id de Producto
     *
     *
     * Este DocBlock documenta la función setId()
     * @param: $id Integer
     */
    function setId($id): void {
        $this->id = $id;
    }

    /**
     * function que permite establecer el nombre de Producto
     *
     *
     * Este DocBlock documenta la función setNombre()
     * @param: $nombre String
     */
    function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    /**
     * function que permite establecer el nombre de Producto
     *
     *
     * Este DocBlock documenta la función setNombre()
     * @param: $categoria Categoria
     */
    function setCategoria($categoria): void {
        $this->categoria = $categoria;
    }

    /**
     * function que permite establecer el detalle de Producto
     *
     *
     * Este DocBlock documenta la función setDetalle()
     * @param: $detalle String
     */
    function setDetalle($detalle): void {
        $this->detalle = $detalle;
    }

    /**
     * function que permite establecer el estado de Producto
     *
     *
     * Este DocBlock documenta la función setEstado()
     * @param: $estado String
     */
    function setEstado($estado): void {
        $this->estado = $estado;
    }

    /**
     * function que permite establecer el precio de Producto
     *
     *
     * Este DocBlock documenta la función setPrecio()
     * @param: $precio Float
     */
    function setPrecio($precio): void {
        $this->precio = $precio;
    }

    /**
     * function que permite establecer el stock de Producto
     *
     *
     * Este DocBlock documenta la función setStock()
     * @param: $stock Integer
     */
    function setStock($stock): void {
        $this->stock = $stock;
    }

    /**
     * function que permite establecer la cantidad minima de Producto
     *
     *
     * Este DocBlock documenta la función setCantMin()
     * @param: $cantMin Integer
     */
    function setCantMin($cantMin): void {
        $this->cantMin = $cantMin;
    }

    /**
     * function que permite establecer la cantidad máxima de Producto
     *
     *
     * Este DocBlock documenta la función setCantMax()
     * @param: $cantMax Integer
     */
    function setCantMax($cantMax): void {
        $this->cantMax = $cantMax;
    }

    /**
     * function que permite establecer el codigo de Producto
     *
     *
     * Este DocBlock documenta la función setCodigo()
     * @param: $codigo Integer
     */
    function setCodigo($codigo): void {
        $this->codigo = $codigo;
    }

    /**
     * function que permite establecer la imagen principal de Producto
     *
     *
     * Este DocBlock documenta la función seImagenPrincipal()
     * @param: $imagenPrincipal String
     */
    function setImagenPrincipal($imagenPrincipal): void {
        $this->imagenPrincipal = $imagenPrincipal;
    }

    /**
     * function que permite guardar una nuevo producto
     *
     *
     * Este DocBlock documenta la función agregarProducto()
     * @return: true o false boolean 
     */
    public function agregarProducto() {
        try {

            $sql = "INSERT INTO `productos`(`idproductos`, `codigo`, `nombre`, `caracteristicas`, `precio`, `cantidad`, `cantidadMin`, `cantidadMax`, `imagenPrincipal`, `categoria_producto_idcategoria_producto`, `estados_idestados`) 
            VALUES (0,"
                    . "'{$this->db->real_escape_string($this->getCodigo())}',"
                    . "'{$this->db->real_escape_string($this->getNombre())}',"
                    . "'{$this->db->real_escape_string($this->getDetalle())}',"
                    . "'{$this->db->real_escape_string($this->getPrecio())}',"
                    . "'{$this->db->real_escape_string($this->getStock())}',"
                    . "'{$this->db->real_escape_string($this->getCantMin())}',"
                    . "'{$this->db->real_escape_string($this->getCantMax())}',"
                    . "'{$this->db->real_escape_string($this->getImagenPrincipal())}',"
                    . "'{$this->db->real_escape_string($this->getCategoria())}',"
                    . "'{$this->db->real_escape_string($this->getEstado())}')";


            $resultado = $this->db->query($sql);
            $est = false;
            if ($resultado) {
                $est = true;
            }

            return $est;
        } catch (Exception $exc) {
            echo '<div class="alert alert-danger" role="alert">
                <strong>Se ha perdido la conexión con la base de datos</strong>
            </div>';
        }
    }

    /**
     * function que permite obtener el listado de todos los productos
     *
     *
     * Este DocBlock documenta la función obtenerProductos()
     * @return: Lista de productos
     */
    public function obtenerProductos() {
        try {

            $sql = "SELECT * FROM `productos`";
            $productos = $this->db->query($sql);

            return $productos;
        } catch (Exception $exc) {
            echo '<div class="alert alert-danger" role="alert">
                <strong>Se ha perdido la conexión con la base de datos</strong>
            </div>';
        }
    }

    /**
     * function que permite obtener el listado de todos los productos y los datos asociados
     * a cada producto registrado
     *
     *
     * Este DocBlock documenta la función obtenerProductosExtra()
     * @param Integer $limit_ini limite odnde se comienza a obtener los registros
     * @param Integer $limit_ter limite odnde se acaba de obtener los registros
     * @return: Lista de productos
     */
    public function obtenerProductosExtra($prec_desde, $prec_hasta, $categ, $estad) {
        try {

            $sql = "SELECT pro.idproductos, "
                    . "pro.codigo, pro.nombre, "
                    . "pro.caracteristicas, "
                    . "pro.precio, pro.cantidad, "
                    . "pro.imagenPrincipal, "
                    . "est.estado, "
                    . "catpro.categoria "
                    . "FROM productos pro "
                    . "INNER JOIN estados est ON est.idestados = pro.estados_idestados "
                    . "INNER JOIN categoria_producto catpro ON catpro.idcategoria_producto = pro.categoria_producto_idcategoria_producto ";

            $ingreso = array();
            if ($categ != "") {
                if (count($ingreso) == 0) {
                    $ingreso['categ'] = "ok";
                    $sql .= "WHERE catpro.categoria = '{$categ}'";
                }
            }

            if ($estad != "") {
                if (isset($ingreso['categ'])) {
                    $ingreso['estad'] = "ok";
                    $sql .= " AND est.estado = '{$estad}'";
                } else {
                    $ingreso['estad'] = "ok";
                    $sql .= " WHERE est.estado = '{$estad}'";
                }
            }


            if ($prec_desde != "" && $prec_hasta != "") {
                if ($prec_desde < $prec_hasta) {

                    if (isset($ingreso['categ']) || isset($ingreso['estad'])) {
                        $ingreso['precios'] = "ok";
                        $sql .= " AND pro.precio BETWEEN {$prec_desde} AND {$prec_hasta} ";
                    } else {
                        $ingreso['precios'] = "ok";
                        $sql .= "WHERE pro.precio BETWEEN {$prec_desde} AND {$prec_hasta} ";
                    }
                }
            }  
             
            $listado = $this->db->query($sql);

            return $listado;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite obtener un producto en particular
     *
     *
     * Este DocBlock documenta la función obtenerProducto()
     * @return: $producto Producto
     */
    public function obtenerProducto() {
        try {

            $sql = "SELECT * FROM `productos` WHERE `idproductos` = {$this->getId()}";
            $productos = $this->db->query($sql);

            return $productos;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite eliminar un producto en particular
     *
     *
     * Este DocBlock documenta la función obtenerProducto()
     * @return $est boolean true o false
     */
    public function eliminarProducto() {
        try {

            $sql = "DELETE FROM `productos` WHERE `idproductos` = {$this->getId()}";
            $delete = $this->db->query($sql);

            $est = false;
            if ($delete) {
                $est = true;
            }

            return $est;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite eliminar un producto en particular
     *
     *
     * Este DocBlock documenta la función obtenerProducto()
     * @return $est boolean true o false
     */
    public function modificarProducto() {
        try {

            $sql = "UPDATE `productos` SET";

            $correctos = array();
            if ($this->getNombre() != "") {
                $correctos['nom'] = "ok";
                $sql .= " `nombre` = '{$this->getNombre()}',";
            }

            if ($this->getDetalle() != "") {
                $correctos['detalle'] = "ok";
                $sql .= " `caracteristicas` = '{$this->getDetalle()}',";
            }

            if ($this->getPrecio() != "") {
                $correctos['prec'] = "ok";
                $sql .= " `precio` = {$this->getPrecio()},";
            }

            if ($this->getStock() != "") {
                $correctos['cant'] = "ok";
                $sql .= " `cantidad` = {$this->getStock()},";
            }

            //`cantidadMin`=[value-7],`cantidadMax`=[value-8]

            if($this->getCantMin() != ""){ 
                $correctos['getCantMin'] = "ok";
                $sql .= " `cantidadMin` = {$this->getCantMin()},";
            }

            if($this->getCantMax() != ""){ 
                $correctos['getCantMax'] = "ok";
                $sql .= " `cantidadMax` = {$this->getCantMax()},";
            }

            if ($this->getImagenPrincipal() != "") {
                $correctos['img'] = "ok";
                $sql .= " `imagenPrincipal` = '{$this->getImagenPrincipal()}',";
            }

            if ($this->getCategoria() != "") {
                $correctos['categ'] = "ok";
                $sql .= " `categoria_producto_idcategoria_producto` = {$this->getCategoria()},";
            }

            if ($this->getEstado() != "") {
                $correctos['est'] = "ok";
                $sql .= " `estados_idestados` = {$this->getEstado()}";
            }

            if (count($correctos) >= 1) {

                $sql .= " WHERE `idproductos` = {$this->getId()}";
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
     * function que permite el listado de productos que se mouestran el 
     * pagina principal
     *
     * Este DocBlock documenta la función obtenerProductosRand()
     * @param Integer $limit_ini limite odnde se comienza a obtener los registros
     * @param Integer $limit_ter limite odnde se acaba de obtener los registros
     * @return $listado ResultSete
     */
    public function obtenerProductosRand($limit_ini, $limit_ter) {
        try {

            $sql = "SELECT * FROM productos";
            if(is_numeric($limit_ini) && is_numeric($limit_ter)){
                $sql .= " LIMIT {$limit_ini}, {$limit_ter}";
            } 
            $listado = $this->db->query($sql);
            return $listado;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite la cantidad total de productos de la base de datos 
     *
     * Este DocBlock documenta la función obtenerStock()
     * @return $resultado ResultSet
     */
    public function obtenerStock() {
        try {

            $sql = "SELECT SUM(cantidad) AS 'CANTP' FROM productos";
            $stock = $this->db->query($sql);
            $resultado = $stock->fetch_object();
            return $resultado;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite obtener el porcentaje de stock total de productos
     *
     * Este DocBlock documenta la función obtenerPorcentajeStock()
     * @return $resultado ResultSet
     */
    public function obtenerPorcentajeStock() {
        try {

            $sql = "SELECT SUM(cantidad) AS 'CANTACTUAL', SUM(cantidadMax) AS 'CANTTOTAL' FROM productos";
            $stock = $this->db->query($sql);
            $resultado = $stock->fetch_object();
            return $resultado;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite actualizar la cantidad de stock que tiene cada unidad de productos
     *
     * Este DocBlock documenta la función actualizarStock()
     * @param Integer $cantidad cantidad de productos que se deben establecer a un tipo de producto
     * @param Integer $id ID del producto al cual se le establecera la cantidad de productos actuales
     * @return $est True o False
     */
    public function actualizarStock($cantidad, $id) {
        try {

            $sql = "UPDATE `productos` SET cantidad = {$cantidad} WHERE idproductos = {$id}";
            $modificado = $this->db->query($sql);

            $est = false;
            if ($modificado) {
                $est = false;
            }

            return $est;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
