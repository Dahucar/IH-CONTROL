<?php

/**
 * Clase que contiene las funcionalidades necesarias para los
 * clientes del sistema
 *
 * @author Daniel Huenul
 */
class Cliente extends Persona {

    private $db;

    function __construct() {
        $this->db = bd::conectar();
    }

    /**
     * function que permite guardar un nuevo cliente en la base de datos
     *
     *
     * Este DocBlock documenta la función agregarCliente()
     * @return: devuelve un boolean en función de si se ha conseguido agregar 
     * el registro
     */
    public function agregarCliente() {
        $sql = "INSERT INTO `clientes`(`idclientes`, `codigo`, `rut`, `nombre`, `apellido_p`, `apellido_m`, `rol`, `correo`, `clave`) "
                . "VALUES (0,"
                . "'{$this->db->real_escape_string($this->getCodigo())}',"
                . "'{$this->db->real_escape_string($this->getRut())}',"
                . "'{$this->db->real_escape_string($this->getNombre())}',"
                . "'{$this->db->real_escape_string($this->getApellido_p())}',"
                . "'{$this->db->real_escape_string($this->getApellido_m())}',"
                . "'{$this->getRol()}',"
                . "'{$this->db->real_escape_string($this->getCorreo())}',"
                . "'{$this->db->real_escape_string($this->getClave())}')";

        $save = $this->db->query($sql);

        $est = false;
        if ($save) {
            $est = true;
        }
        return $est;
    }

    public function eliminarCliente() {
        echo "eliminarCliente";
    }

    /**
     * function que permite modificar los datos de un cliente ya registrado
     * 
     * Este DocBlock documenta la función modificarCliente()
     * @return: $est True o False
     */
    public function modificarCliente() {
        try {

            $sql = "UPDATE `clientes` SET ";

            $ingresados = array();
            if ($this->getRut() != "") {
                $ingresados['getRut'] = "ok";
                $sql .= "`rut` = '{$this->db->real_escape_string($this->getRut())}'";
            }

            if ($this->getNombre() != "") {

                if (isset($ingresados['getRut'])) {
                    $ingresados['getNombre'] = "ok";
                    $sql .= ", `nombre` = '{$this->db->real_escape_string($this->getNombre())}'";
                } else {
                    $ingresados['getNombre'] = "ok";
                    $sql .= "`nombre` = '{$this->db->real_escape_string($this->getNombre())}'";
                }
            }

            if ($this->getApellido_p() != "") {

                if (isset($ingresados['getNombre'])) {
                    $ingresados['getApellido_p'] = "ok";
                    $sql .= ", `apellido_p` = '{$this->db->real_escape_string($this->getApellido_p())}'";
                } else {
                    $ingresados['getApellido_p'] = "ok";
                    $sql .= "`apellido_p` = '{$this->db->real_escape_string($this->getApellido_p())}'";
                }
            }

            if ($this->getApellido_m() != "") {

                if (isset($ingresados['getApellido_p'])) {
                    $ingresados['getApellido_m'] = "ok";
                    $sql .= ", `apellido_m` = '{$this->db->real_escape_string($this->getApellido_m())}'";
                } else {
                    $ingresados['getApellido_m'] = "ok";
                    $sql .= "`apellido_m` = '{$this->db->real_escape_string($this->getApellido_m())}'";
                }
            }

            if ($this->getCorreo() != "") {

                if (isset($ingresados['getApellido_m'])) {
                    $ingresados['getCorreo'] = "ok";
                    $sql .= ", `correo` = '{$this->db->real_escape_string($this->getCorreo())}'";
                } else {
                    $ingresados['getCorreo'] = "ok";
                    $sql .= "`correo` = '{$this->db->real_escape_string($this->getCorreo())}'";
                }
            }

            if ($this->getClave() != "") {

                if (isset($ingresados['getCorreo'])) {
                    $ingresados['clave'] = "ok";
                    $sql .= ", `clave` = '{$this->db->real_escape_string($this->getClave())}'";
                } else {
                    $ingresados['clave'] = "ok";
                    $sql .= "`clave` = '{$this->db->real_escape_string($this->getClave())}'";
                }
            }

            if ($this->getRol() != "") {

                if (isset($ingresados['clave'])) {
                    $ingresados['getRol'] = "ok";
                    $sql .= ", `rol` = '{$this->getRol()}'";
                } else {
                    $ingresados['getRol'] = "ok";
                    $sql .= "`rol` = '{$this->getRol()}'";
                }
            }

            if (count($ingresados) >= 1) {
                $sql .= " WHERE `idclientes`= {$this->getId()}";
            } 
 
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
     * function que permite actualizar los datos de un cliente ya registrado
     * 
     * Este DocBlock documenta la función modificarCliente()
     * @return: $est True o False
     */
    public function actualizarDatos() {
        try {

            $sql = "UPDATE `vendedores` SET ";

            $ingresados = array();
            if ($this->getRut() != "") {
                $ingresados['getRut'] = "ok";
                $sql .= "`rut`='{$this->db->real_escape_string($this->getRut())}'";
            }

            if ($this->getNombre() != "") {

                if (isset($ingresados['getRut'])) {
                    $ingresados['getNombre'] = "ok";
                    $sql .= ", `nombre`='{$this->db->real_escape_string($this->getNombre())}'";
                } else {
                    $ingresados['getNombre'] = "ok";
                    $sql .= "`nombre`='{$this->db->real_escape_string($this->getNombre())}'";
                }
            }

            if ($this->getApellido_p() != "") {

                if (isset($ingresados['getNombre'])) {
                    $ingresados['getApellido_p'] = "ok";
                    $sql .= ", `apellido_p`='{$this->db->real_escape_string($this->getApellido_p())}'";
                } else {
                    $ingresados['getApellido_p'] = "ok";
                    $sql .= "`apellido_p`='{$this->db->real_escape_string($this->getApellido_p())}'";
                }
            }

            if ($this->getApellido_m() != "") {

                if (isset($ingresados['getApellido_p'])) {
                    $ingresados['getApellido_m'] = "ok";
                    $sql .= ", `apellido_m`='{$this->db->real_escape_string($this->getApellido_m())}'";
                } else {
                    $ingresados['getApellido_m'] = "ok";
                    $sql .= "`apellido_m`='{$this->db->real_escape_string($this->getApellido_m())}'";
                }
            }

            if ($this->getFoto() != "") {

                if (isset($ingresados['getApellido_m'])) {
                    $ingresados['getFoto'] = "ok";
                    $sql .= ", `fotografica`='{$this->db->real_escape_string($this->getFoto())}'";
                } else {
                    $ingresados['getFoto'] = "ok";
                    $sql .= "`fotografica`='{$this->db->real_escape_string($this->getFoto())}'";
                }
            }

            if ($this->getCorreo() != "") {

                if (isset($ingresados['getFoto'])) {
                    $ingresados['getCorreo'] = "ok";
                    $sql .= ", `correo`='{$this->db->real_escape_string($this->getCorreo())}'";
                } else {
                    $ingresados['getCorreo'] = "ok";
                    $sql .= ",`correo`='{$this->db->real_escape_string($this->getCorreo())}'";
                }
            }

            if ($this->getClave() != "") {

                if (isset($ingresados['getCorreo'])) {
                    $ingresados['getClave'] = "ok";
                    $sql .= ", `clave`='{$this->db->real_escape_string($this->getClave())}'";
                } else {
                    $ingresados['getClave'] = "ok";
                    $sql .= "`clave`='{$this->db->real_escape_string($this->getClave())}'";
                }
            }

            if (count($ingresados) >= 1) {
                $sql .= " WHERE `idvendedores`= {$this->getId()}";
            }


//            echo "<h1 style='color: white; background: black;'>". $sql ."</h1>";
//             die();
            $update = $this->db->query($sql);

            $est = false;
            if ($update) {
                $est = true;
            }

            return $est;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite obtener un cliente en espesifico de la base de datos por el ID
     * 
     * Este DocBlock documenta la función obtenerClienteId()
     * @return: $obtener Cliente
     */
    public function obtenerClienteId() {
        try {
            $sql = "SELECT * FROM `clientes` WHERE `idclientes` = {$this->getId()}";
            $obtener = $this->db->query($sql);

            return $obtener;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite obtener un cliente en espesifico de la base de datos por el RUT 
     * 
     * Este DocBlock documenta la función obtenerCliente()
     * @return: $client Cliente
     */
    public function obtenerCliente() {
        try {
            $sql = "SELECT * FROM `clientes` WHERE rut = '{$this->getRut()}'";
            $obtener = $this->db->query($sql);

            if ($obtener && $obtener->num_rows == 1) {
                $client = $obtener;
                return $client;
            }

            return null;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite obtener un rut en la base de datos
     * 
     * Este DocBlock documenta la función obtenerRutCliente()
     * @return: $rut ResulSet de cliente
     */
    public function obtenerRutCliente() {
        try {
            $sql = "SELECT * FROM `clientes` WHERE rut = '{$this->getRut()}'";
            $obtener_rut = $this->db->query($sql);

            $rut = "";
            if ($obtener_rut && $obtener_rut->num_rows == 1) {
                $rut = $obtener_rut->fetch_object();
            }
            return $rut;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite obtener un correo en la base de datos
     * 
     * Este DocBlock documenta la función obtenerCorreoCliente()
     * @return: $correo Cliente
     */
    public function obtenerCorreoCliente() {
        try {
            $sql = "SELECT * FROM `clientes` WHERE `correo` = '{$this->getCorreo()}'";
            $obtener_correo = $this->db->query($sql);

            $correo = "";
            if ($obtener_correo && $obtener_correo->num_rows == 1) {
                $correo = $obtener_correo->fetch_object();
            }
            return $correo;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite obtener el listado de todos los clientes
     * ingresados al sistema
     * 
     * Este DocBlock documenta la función obtenerClientes()
     * @return: revuelve el listado de todos los cliente encontrados
     */
    public function obtenerClientes() {
        try {
            $sql = "SELECT * FROM `clientes`";
            $obtener = $this->db->query($sql);

            if ($obtener && $obtener->num_rows == 1) {
                $client = $obtener->idclientes();
                return $client;
            }

            return null;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite que permite obtener el listado completo de clientes registrados
     * 
     * Este DocBlock documenta la función obtenerTodosCliente()
     * @return: revuelve un boolean o un resultado de la base de datos
     */
    public function obtenerTodosCliente() {
        try {

            $sql = "SELECT * FROM `clientes`";
            $resultado = $this->db->query($sql);

            return $resultado;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite que el cliente acceda al sistema como un ususario registrado
     * 
     * Este DocBlock documenta la función loginCliente()
     * @return: revuelve un boolean o un resultado de la base de datos
     */
    public function loginCliente() {
        try {

            $cliente_buscado = false;
            $email_busqueda = $this->getCorreo();
            $clave_busqueda = $this->getClave();


            $sql = "SELECT * FROM `clientes` WHERE `correo` = '{$email_busqueda}'";
            $login = $this->db->query($sql);

            if ($login && $login->num_rows == 1) {

                //guardo el resulset en cliente
                $cliente = $login->fetch_object();

                $es_correcta = password_verify($clave_busqueda, $cliente->clave);
                if ($es_correcta) {
                    $cliente_buscado = $cliente;
                }
            }

            return $cliente_buscado;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite obtener todas las compras realizadas por un cliente en particular
     * 
     * Este DocBlock documenta la función obtenerComprasCliente()
     * @return: $resultado ResultSet
     */
    public function obtenerComprasCliente() {
        try {

            $sql = "SELECT comp.idcompras, comp.fecha, comp.estadoCompra, prod.idproductos, prod.nombre, prod.precio FROM compras_de_productos comprod "
                    . "INNER JOIN compras comp ON comprod.compras_idcompras = comp.idcompras "
                    . "INNER JOIN productos prod on prod.idproductos = comprod.productos_idproductos "
                    . "WHERE comp.clientes_idclientes = {$this->getId()}";

            $resultado = $this->db->query($sql);

            return $resultado;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite obtener todas las ventas donde participa un cliente en particular
     * 
     * Este DocBlock documenta la función obtenerComprasCliente()
     * @return: $resultado ResultSet
     */
    public function obtenerVentasCliente() {
        try {

            $sql = "SELECT vent.idventas, vent.fecha, vent.detalle, vent.valor, vend.idvendedores, vend.rut, prod.idproductos, prod.nombre, prod.imagenPrincipal "
                    . "FROM productos_en_venta pv "
                    . "INNER JOIN ventas vent ON vent.idventas = pv.ventas_idventas "
                    . "INNER JOIN vendedores vend ON vend.idvendedores = vent.vendedores_idvendedores "
                    . "INNER JOIN productos prod ON prod.idproductos = pv.productos_idproductos "
                    . "WHERE vent.clientes_idclientes = {$this->getId()}";

            $resultado = $this->db->query($sql);

            return $resultado;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite la cantidad total de clientes registrados
     *
     * Este DocBlock documenta la función obtenerCantCli()
     * @return $resultado ResultSet
     */
    public function obtenerCantCli() {
        try {

            $sql = "SELECT COUNT(idclientes) AS 'CANTCLI' FROM clientes";
            $stock = $this->db->query($sql);
            $resultado = $stock->fetch_object();
            return $resultado;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
