<?php

/**
 * Description of Venta
 *
 * @author Daniel Huenul
 */
class Venta {

    //put your code here
    private $id;
    private $codigo;
    private $fecha;
    private $detalle;
    private $valor;
    private $vendedor;
    private $cliente;
    private $db;

    function __construct() {
        $this->db = bd::conectar();
    }

    /**
     * function que permite obtener el id de venta
     *
     *
     * Este DocBlock documenta la función getId()
     * @return: $id Integer
     */
    function getId() {
        return $this->id;
    }

    /**
     * function que permite obtener el codigo de venta
     *
     *
     * Este DocBlock documenta la función getCodigo()
     * @return: $codigo Integer
     */
    function getCodigo() {
        return $this->codigo;
    }

    /**
     * function que permite obtener al fecha de venta
     *
     *
     * Este DocBlock documenta la función getFecha()
     * @return: $fecha String
     */
    function getFecha() {
        return $this->fecha;
    }

    /**
     * function que permite obtener el detalle de venta
     *
     *
     * Este DocBlock documenta la función getDetalle()
     * @return: $detalle String
     */
    function getDetalle() {
        return $this->detalle;
    }

    /**
     * function que permite obtener el valor de venta
     *
     *
     * Este DocBlock documenta la función getValor()
     * @return: $valor Integer
     */
    function getValor() {
        return $this->valor;
    }

    /**
     * function que permite obtener el id de vendedor de venta
     *
     *
     * Este DocBlock documenta la función getValor()
     * @return: $vendedor Integer
     */
    function getVendedor() {
        return $this->vendedor;
    }

    /**
     * function que permite obtener el id de cliente de venta
     *
     *
     * Este DocBlock documenta la función getCliente()
     * @return: $cliente Integer
     */
    function getCliente() {
        return $this->cliente;
    }

    /**
     * function que permite establecer el id de venta
     *
     *
     * Este DocBlock documenta la función setId()
     * @param: $id Integer
     */
    function setId($id): void {
        $this->id = $id;
    }

    /**
     * function que permite establecer el codigo de venta
     *
     *
     * Este DocBlock documenta la función setCodigo()
     * @param: $codigo Integer
     */
    function setCodigo($codigo): void {
        $this->codigo = $codigo;
    }

    /**
     * function que permite establecer la fecha de venta
     *
     *
     * Este DocBlock documenta la función setCodigo()
     * @param: $fecha String
     */
    function setFecha($fecha): void {
        $this->fecha = $fecha;
    }

    /**
     * function que permite establecer el detalle de venta
     *
     *
     * Este DocBlock documenta la función setDetalle()
     * @param: $detalle String
     */
    function setDetalle($detalle): void {
        $this->detalle = $detalle;
    }

    /**
     * function que permite establecer el valor de venta
     *
     *
     * Este DocBlock documenta la función setValor()
     * @param: $valor Integer
     */
    function setValor($valor): void {
        $this->valor = $valor;
    }

    /**
     * function que permite establecer el id de vendedor de venta
     *
     *
     * Este DocBlock documenta la función setVendedor()
     * @param: $vendedor Integer
     */
    function setVendedor($vendedor): void {
        $this->vendedor = $vendedor;
    }

    /**
     * function que permite establecer el id de cliente de venta
     *
     *
     * Este DocBlock documenta la función setCliente()
     * @param: $cliente Integer
     */
    function setCliente($cliente): void {
        $this->cliente = $cliente;
    }

    /**
     * function que permite agregar ventas a la base de datos
     *
     *
     * Este DocBlock documenta la función agregarVenta()
     * @return: $est true ofalse
     */
    public function agregarVenta() {
        try {

            $sql = "INSERT INTO `ventas`(`idventas`, `codigo`, `fecha`, `detalle`, `valor`, `vendedores_idvendedores`, `clientes_idclientes`) "
                    . "VALUES (0,"
                    . "{$this->getCodigo()},"
                    . "{$this->getFecha()},"
                    . "'{$this->getDetalle()}',"
                    . "{$this->getValor()},"
                    . "{$this->getVendedor()},"
                    . "{$this->getCliente()})";

            $guardar = $this->db->query($sql);

            $est = false;
            if ($guardar) {
                $est = true;
            }

            return $est;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite guardar las los productos vendidos por un cliente y 
     * la venta a los que estan asociados
     *
     *
     * Este DocBlock documenta la función agregarProductosVentas()
     * @param Integer $idVenta ID de la venta que se ha agregado 
     * @param Array $listProduct Listado de id de los productos en una venta
     * @return: $resultado ResultSet
     */
    public function agregarProductosVentas($idVenta, $listProduct) {
        try {

            $sql = "INSERT INTO `productos_en_venta`(`idproductos_en_venta`, `productos_idproductos`, `ventas_idventas`) VALUES ";

            foreach ($listProduct as $i => $idIndice) {

                if ($i == 0) {
                    $sql .= "(0,{$idIndice},{$idVenta})";
                } else {
                    $sql .= ", (0,{$idIndice},{$idVenta})";
                }
            }

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
     * function que permite obtener una venta en base al codigo de la misma
     *
     *
     * Este DocBlock documenta la función obtenerVenta()
     * @return: $resultado obtenerVenta
     */
    public function obtenerVenta() {
        try {

            $sql = "SELECT * FROM `ventas` WHERE codigo = {$this->getCodigo()}";
            $resultado = $this->db->query($sql);

            return $resultado;
        } catch (Exception $ex) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite obtener una venta junto al vendedor involucrado y el cliente participante en base al codigo de la misma
     *
     *
     * Este DocBlock documenta la función obtenerVentaDetalle()
     * @return: $resultado ResultSet
     */
    public function obtenerVentaDetalle() {
        try {

            $sql = 'SELECT vent.idventas, vent.fecha, vent.detalle, vent.valor, cli.idclientes, cli.rut AS "RUTCLI", cli.nombre AS "NOMCLI", cli.apellido_p AS "APEPCLI", cli.apellido_m AS "APEMCLI", vend.idvendedores, vend.rut AS "RUTVEND", vend.nombre AS "NOMVEND", vend.apellido_p AS "APEPVEND", vend.apellido_m AS "APEMVEND" '
                    . 'FROM ventas vent '
                    . 'INNER JOIN clientes cli ON cli.idclientes = vent.clientes_idclientes '
                    . 'INNER JOIN vendedores vend ON vend.idvendedores = vent.vendedores_idvendedores';
            $resultado = $this->db->query($sql);

            return $resultado;
        } catch (Exception $ex) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite obtener todoas la ventas realizadas ademas de 
     *
     *
     * Este DocBlock documenta la función obtenerVentas()
     * @return: $resultado ResultSet
     */
    public function obtenerVentas() {
        try {

            $sql = 'SELECT vent.idventas, vent.fecha, vent.valor, prod.nombre, prod.precio, prod.imagenPrincipal, vend.idvendedores AS "vendID",vend.rut AS "rutvend", vend.fotografica, cli.idclientes AS "cliID",cli.rut AS "rutcli" '
                    . ' FROM productos_en_venta proVent'
                    . ' INNER JOIN ventas vent ON vent.idventas = proVent.ventas_idventas'
                    . ' INNER JOIN vendedores vend ON vend.idvendedores = vent.vendedores_idvendedores'
                    . ' INNER JOIN clientes cli ON cli.idclientes = vent.clientes_idclientes'
                    . ' INNER JOIN productos prod ON prod.idproductos = proVent.productos_idproductos';

            $resultado = $this->db->query($sql);

            return $resultado;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function eliminarVenta() {
        echo "eliminarVenta";
    }

    public function modificarVenta() {
        echo "modificarVenta";
    }

    /**
     * function que permite obtener la cantidad de ventas registradas. 
     *
     *
     * Este DocBlock documenta la función obtenerCantVentas()
     * @return: $cantidad ResultSet
     */ 
    public function obtenerCantVentas() {
        try {
 
            $sql = "SELECT COUNT(idventas) AS 'CANTIDAD' FROM ventas";
            $cont = $this->db->query($sql);

            $cantidad = $cont->fetch_object();
            
            return $cantidad;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    } 

    /**
     * function que permite obtener el listado de ventas con el cliente involucrado 
     * relacionadas con un vendedor en espesifico 
     * 
     * Este DocBlock documenta la función obtenerVentasVendedor()
     * @param Integer $idVendedor ID de vendedor que efectua la venta
     * @return: $resultado ResultSet
     */
    public function obtenerVentasVendedor($idVendedor) {
        try {

            $sql = "SELECT vent.idventas, vent.fecha, vent.detalle, vent.valor, cli.idclientes, cli.rut "
                    . "FROM ventas vent "
                    . "INNER JOIN clientes cli ON cli.idclientes = vent.clientes_idclientes "
                    . "WHERE vent.vendedores_idvendedores = {$idVendedor}";
                    
            $resultado = $this->db->query($sql);
            
            return $resultado;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite obtener el listado de ventas de un cliente en particular
     * 
     * Este DocBlock documenta la función obtenerVentasVendedor()
     * @param Integer $idCliente ID de cliente participa en la venta
     * @return: $resultado ResultSet
     */
    public function obtenerVentasCliente($idCliente) {
        try {

            $sql = "SELECT * FROM `ventas` WHERE clientes_idclientes = {$idCliente}";
                    
            $resultado = $this->db->query($sql);
            
            return $resultado;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
