<?php

require_once 'models/personas/persona.php';
require_once 'models/personas/cliente.php';
require_once 'models/compras/Compra.php';
require_once 'models/compras/Venta.php';

/**
 * Clase controladora del modelo cliente
 *
 * @author Daniel Huenul
 */
class ClienteController {
 
    /**
     * function carga la vista principal del modulo de clientes donde se muestran las compras que ha realizado y estan pendientes
     * 
     * Este DocBlock documenta la función homeCliente() 
     */
    public function homeCliente() {

        $compClie = new Compra();
        $comprasCliente = $compClie->obtenerComprasCliente($_SESSION['IDENTIDAD']->idclientes);

        require_once 'views/interfaz/modulo_clientes/vista_menuDeCliente.php';
    }

    /**
     * function carga la vista de registro para nuevos clientes
     * 
     * Este DocBlock documenta la función registro() 
     */
    public function registro() {
        require_once 'views/interfaz/registro.php';
    }
    
    /**
     * function carga la vista de inicio de sesion para nuevos clientes
     * 
     * Este DocBlock documenta la función iniciar() 
     */
    public function iniciar() {
        require_once 'views/interfaz/inicar.php';
    }
    
    /**
     * function carga la vista de principal de un vendedor
     * 
     * Este DocBlock documenta la función inicio() 
     */
    public function inicio() {
        require_once 'views/interfaz/modulo_vendedores/vista_vendedores.php';
    }
    
    /**
     * function carga la vista con el historial de las compras
     * realizadas por un cliente en particular.
     * 
     * Este DocBlock documenta la función historial() 
     */
    public function historial() {

        $compClie = new Compra();
        $comprasCliente = $compClie->obtenerComprasCliente($_SESSION['IDENTIDAD']->idclientes);

        $ventCle = new Venta();
        $ventasCliente = $ventCle->obtenerVentasCliente($_SESSION['IDENTIDAD']->idclientes);

        require_once 'views/interfaz/modulo_clientes/vista_historicoComprasCliente.php';
    }
    
    /**
     * function carga la vista con los datos de un cliente en particular. 
     * 
     * Este DocBlock documenta la función misDatos() 
     */
    public function misDatos() {

        if (isset($_GET['id'])) {

            $id = $_GET['id'];

            if (is_numeric($id)) {

                if ($_SESSION['IDENTIDAD']->idclientes == $id) {


                    $cliente = new Cliente();
                    $cliente->setId($id);
                    $obtenido = $cliente->obtenerClienteId();
                    $p = $obtenido->fetch_object();

                    if (!is_object($p)) {
                        $_SESSION['MIDETALLE']['ERR'] = "No se ha encontrado sus datos. Favor solicite esta acción nuevamente.";
                    }
                } else {
                    $_SESSION['MIDETALLE']['ERR'] = "No puedes acceder a los datos solicitados ya no corresponden a ti.";
                }
            } else {
                $_SESSION['MIDETALLE']['ERR'] = "El tipo de parametro enviado no es el esperado.";
            }
        } else {
            $_SESSION['MIDETALLE']['ERR'] = "Se esperaba una parametro para acceder a esta funcionalidad.";
        }

        require_once 'views/interfaz/modulo_clientes/vista_datosCliente.php';
    }
    
    /**
     * function carga la vista con el listado de todos los clientes que hay registrados en la base de datos
     * 
     * Este DocBlock documenta la función clientes() 
     */
    public function clientes() {

        $cli = new Cliente();
        $todos = $cli->obtenerTodosCliente();

        require_once 'views/interfaz/modulo/vista_clientes.php';
    }

    /**
     * function que permite obtener un cliente en la base de datos
     * 
     * Este DocBlock documenta la función verCliente() 
     */
    public function verCliente() {
        if (isset($_GET['id'])) {

            $id = $_GET['id'];

            $cliente = new Cliente();
            $cliente->setId($id);
            $obtenido = $cliente->obtenerClienteId();
            $p = $obtenido->fetch_object();

            //obtener las compras realizadas
            $compras = $cliente->obtenerComprasCliente();

            //obtener las ventas donde participa un cliente
            $ventas = $cliente->obtenerVentasCliente();

            if (!is_object($p)) {
                $_SESSION['DETALLECLI']['ERR'] = "No se ha ecnontrado el cliente cuyo detalle se ha solicitado. ";
            }
        } else {
            $_SESSION['DETALLECLI']['ERR'] = "Se espera una parametro para acceder a esta funcionalidad.";
        }
        require_once 'views/interfaz/modulo/vista_detallecliente.php';
    }

    /**
     * function que permite guardar un nuevo usuario en la base de datos
     * 
     * Este DocBlock documenta la función guardar() 
     */
    public function guardar() {
        echo '<div style="margin-top: 350px; margin-bottom: 350px;">
        <center>
            <div class="spinner-border" style="width: 200px; height: 200px; margin: auto;"></div> 
        </center>
    </div>';

        if (isset($_POST)) {
            //obteniendo datos 
            $rut = isset($_POST['campo_rut']) ? $_POST['campo_rut'] : false;
            $nombre = isset($_POST['campo_nombre']) ? $_POST['campo_nombre'] : false;
            $apellido_p = isset($_POST['campo_apellido_p']) ? $_POST['campo_apellido_p'] : false;
            $apellido_m = isset($_POST['campo_apellido_m']) ? $_POST['campo_apellido_m'] : false;
            $email = isset($_POST['campo_email']) ? $_POST['campo_email'] : false;
            $clave = isset($_POST['campo_clave']) ? $_POST['campo_clave'] : false;

            //array para capturar errores
            $errores = array();

            //validando datos
            if (!empty($rut) && strlen($rut) <= 10 && Utils::valida_rut($rut)) {
                $rut_valido = true;
            } else {
                $rut_valido = false;
                $errores['rut'] = "<li> Formato de rut invalido o esta vacío </li>";
            }

            if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
                if(strlen($nombre) < 50){
                    $nombre_valido = true;
                }else{
                    $nombre_valido = false;
                    $errores['nombre'] = "<li>El nombre solo debe tener 50 caracteres o menos</li>";
                }
            } else {
                $nombre_valido = false;
                $errores['nombre'] = "<li>Nombre invalido</li>";
            }

            if (!empty($apellido_p) && !is_numeric($apellido_p) && !preg_match("/[0-9]/", $apellido_p)) {
                if(strlen($apellido_p) < 50){
                    $apellido_p_valido = true;
                }else{
                    $apellido_p_valido = false;
                    $errores['apellido_p'] = "<li>El apellido paterno solo debe tener 50 caracteres o menos</li>";
                }
            } else {
                $apellido_p_valido = false;
                $errores['apellido_p'] = "<li>Apellido paterno invalido</li>";
            }

            if (!empty($apellido_m) && !is_numeric($apellido_m) && !preg_match("/[0-9]/", $apellido_m)) {
                if(strlen($apellido_m) < 50){
                    $apellido_m_valido = true;
                }else{
                    $apellido_m_valido = false;
                    $errores['apellido_m'] = "<li>El apellido materno solo debe tener 50 caracteres o menos</li>";
                }
            } else {
                $apellido_m_valido = false;
                $errores['apellido_m'] = "<li>Apellido materno invalido</li>";
            }

            if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if(strlen($email) < 60){
                    $email_validado = true;
                }else{
                    $email_validado = false;
                    $errores['email'] = "<li>El apellido materno solo debe tener 60 caracteres o menos</li>";
                }
            } else {
                $email_validado = false;
                $errores['email'] = "<li>Formato de email invalido o esta vacío</li>";
            }

            if (!empty($clave)) {
                if(strlen($clave) < 11){
                    $clave_p_valido = true;
                }else{
                    $clave_p_valido = false;
                    $errores['clave'] = "<li>La clave solo debe tener 10 caracteres o menos</li>";
                }
            } else {
                $clave_p_valido = false;
                $errores['clave'] = "<li>Clave vacía</li>";
            } 
 
            if (count($errores) == 0) {
                $cli = new Cliente();
                $cli->setRut($rut);

                $codigo = substr($rut, 0, -2);

                $cli->setCodigo($codigo);
                $cli->setNombre($nombre);
                $cli->setApellido_p($apellido_p);
                $cli->setApellido_m($apellido_m);
                $cli->setCorreo($email);
                $claveSegura = password_hash($clave, PASSWORD_BCRYPT, ['cost' => 4]);

                $cli->setClave($claveSegura);
                $cli->setRol("CLIENTE");

                //se guarda el rut que se ha busca y encontrado en la BBDD
                $rut_obtenido = $cli->obtenerRutCliente();
                $correo_obtenido = $cli->obtenerCorreoCliente();

                $errores_duplicidad = "";
                $cliEncontrado = false;
                if ($rut_obtenido && $rut_obtenido->rut == $cli->getRut()) {
                    if ($rut_obtenido->rol == "CLIENTE TEMPORAL") {
                        $cliEncontrado = true;
                        $cli->setId($rut_obtenido->idclientes);
                        $cli->setCodigo($rut_obtenido->codigo);
                        $cli->setRut($rut_obtenido->rut);

                        if ($correo_obtenido == "") {

                            if ($cli->modificarCliente()) {
                                $_SESSION['CLITEMPREG']['OK'] = "Su cuenta temporal ya esta activada correctamente.";
                            } else {
                                $_SESSION['CLITEMPREG']['ERR'] = "Error durante el proceso de habilitado de cuenta.";
                            }
                        } else {
                            $_SESSION['CLITEMPREG']['ERR'] = "El correo ingresado ya esta en uso por otro usuario. Ingrese uno diferente. ";
                        }
                    } else {
                        $errores_duplicidad .= "El rut ingresado ya esta en uso por otro usuario. ";
                    }
                }


                if (!$cliEncontrado) {

                    if ($correo_obtenido && $correo_obtenido->correo == $cli->getCorreo()) {
                        $errores_duplicidad .= "El correo ingresado ya esta en uso por otro usuario. ";
                    }

                    if ($errores_duplicidad == "") {
                        $guardado = $cli->agregarCliente();

                        if ($guardado) {
                            $_SESSION['registro']['ok'] = "Usuario registrado correctamente";
                        } else {
                            $_SESSION['registro']['err'] = "Error inesperado durante el proceso de registro";
                        }
                    } else {
                        $_SESSION['registro']['err'] = $errores_duplicidad;
                    }
                }
            } else {
                $_SESSION['registro']['err'] = implode($errores);
            }
        }
        echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/cliente/registro">';
    }

    /**
     * function que permite modificar los datos de un cliente en particulos.
     * 
     * Este DocBlock documenta la función modificarDatos() 
     */
    public function modificarDatos() {
        echo '<div style="margin-top: 350px; margin-bottom: 350px;">
        <center>
            <div class="spinner-border" style="width: 200px; height: 200px; margin: auto;"></div> 
        </center>
    </div>';
        try {

            if (isset($_GET['id'])) {

                $id = $_GET['id'];
                //guardando los datos en variables
                $rut = isset($_POST['campo_rut']) ? $_POST['campo_rut'] : false;
                $nombre = isset($_POST['campo_nombre']) ? $_POST['campo_nombre'] : false;
                $apellido_p = isset($_POST['campo_apellido_p']) ? $_POST['campo_apellido_p'] : false;
                $apellido_m = isset($_POST['campo_apellido_m']) ? $_POST['campo_apellido_m'] : false;
                $email = isset($_POST['campo_email']) ? $_POST['campo_email'] : false;
                $clave = isset($_POST['campo_clave']) ? $_POST['campo_clave'] : false;

                //array para capturar errores
                $errores = array();

                //validando datos
                if (!empty($rut) && strlen($rut) <= 10 && Utils::valida_rut($rut)) {
                    $rut_valido = true;
                } else {
                    $rut_valido = false;
                    $errores['rut'] = "<li> Formato de rut invalido o esta vacío </li>";
                }

                if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
                    if(strlen($nombre) < 50){
                        $nombre_valido = true;
                    }else{
                        $nombre_valido = false;
                        $errores['nombre'] = "<li>El nombre solo debe tener 50 caracteres o menos</li>";
                    }
                } else {
                    $nombre_valido = false;
                    $errores['nombre'] = "<li>Nombre invalido</li>";
                }

                if (!empty($apellido_p) && !is_numeric($apellido_p) && !preg_match("/[0-9]/", $apellido_p)) {
                    if(strlen($apellido_p) < 50){
                        $apellido_p_valido = true;
                    }else{
                        $apellido_p_valido = false;
                        $errores['apellido_p'] = "<li>El apellido paterno solo debe tener 50 caracteres o menos</li>";
                    }
                } else {
                    $apellido_p_valido = false;
                    $errores['apellido_p'] = "<li>Apellido paterno invalido</li>";
                }

                if (!empty($apellido_m) && !is_numeric($apellido_m) && !preg_match("/[0-9]/", $apellido_m)) {
                    if(strlen($apellido_m) < 50){
                        $apellido_m_valido = true;
                    }else{
                        $apellido_m_valido = false;
                        $errores['apellido_m'] = "<li>El apellido materno solo debe tener 50 caracteres o menos</li>";
                    }
                } else {
                    $apellido_m_valido = false;
                    $errores['apellido_m'] = "<li>Apellido materno invalido</li>";
                }

                if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    if(strlen($email) < 60){
                        $email_validado = true;
                    }else{
                        $email_validado = false;
                        $errores['email'] = "<li>El apellido materno solo debe tener 60 caracteres o menos</li>";
                    }
                } else {
                    $email_validado = false;
                    $errores['email'] = "<li>Formato de email invalido o esta vacío</li>";
                }

                if (!empty($clave)) { 
                    $clave_p_valido = true; 
                } else {
                    $clave_p_valido = false;
                    $errores['clave_p'] = "<li>Clave vacía</li>";
            } 


                //validando que hay errores 
                if (count($errores) == 0) {

                    $cli = new Cliente();
                    $cli->setId($id);
                    $cli->setRut($rut);
                    $cli->setNombre($nombre);
                    $cli->setApellido_p($apellido_p);
                    $cli->setApellido_m($apellido_m);
                    $cli->setCorreo($email);

                    $claveSegura = "";
                    if (strlen($clave) < 50) {

                        //cifrar contraseña
                        $claveSegura = password_hash($clave, PASSWORD_BCRYPT, ['cost' => 4]);
                        $cli->setClave($claveSegura);
                    }

                    $modificado = $cli->modificarCliente();


                    if ($modificado) {
                        $_SESSION['CLIUPDATE']['OK'] = "Datos modificado correctamente.";
                    } else {
                        $_SESSION['CLIUPDATE']['ERR'] = "Error durante el proceso de modificación de datos.";
                    }
                } else {
                    $_SESSION['CLIUPDATE']['ERR'] = implode($errores);
                }
            }
            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/cliente/misDatos&id=' . $_SESSION['IDENTIDAD']->idclientes . '">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
