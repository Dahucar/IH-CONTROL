<?php

require_once 'models/personas/persona.php';
require_once 'models/personas/cliente.php';
require_once 'models/personas/vendedor.php';
require_once 'models/personas/administrador.php';
require_once 'models/personas/Proveedor.php';

/**
 * Clase controladora de usuarios
 *
 * @author Daniel Huenul
 */
class usuarioController {
    //<meta http-equiv="Refresh" content="5;url=http://www.emol.com">

    /**
     * function que muestra la interfaz de inicio de sesión
     *  
     *
     * Este DocBlock documenta la función iniciar()
     */
    public function iniciar() {
        require_once 'views/interfaz/inicar.php';
    }

    /**
     * function permite ingresar al sistema como usuario registrado
     * para los diferente tipos de roles disponibles 
     *  
     *
     * Este DocBlock documenta la función ingresar()
     */
    public function ingresar() {
        echo '<div style="margin-top: 350px; margin-bottom: 350px;">
                <center>
                    <div class="spinner-border" style="width: 200px; height: 200px; margin: auto;"></div> 
                </center>
            </div>';
        try {

            if (isset($_POST)) {

                $iniciado = false;

                $email = isset($_POST['campo_email']) ? $_POST['campo_email'] : false;
                $clave = isset($_POST['campo_clave']) ? $_POST['campo_clave'] : false;
                $acceso = isset($_POST['campo_modoacceso']) ? $_POST['campo_modoacceso'] : false;

                $error = true;

                if ($email && $clave && $acceso != "Seleccione como ingresar") {

                    if ($acceso == "Administrador") {

                        $admin = new administrador();
                        $admin->setCorreo($email);
                        $admin->setClave($clave);

                        $adm_login = $admin->loginAdministrador();
                        if ($adm_login && is_object($adm_login)) {
                            $_SESSION['IDENTIDAD'] = $adm_login;
                            $iniciado = true;
                            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/">';
                        } else {
                            $_SESSION['ERR-LOGIN'] = "No hay cuentas administrativas que coincidan con los datos ingresados";
                        }
                    } else if ($acceso == "Proveedor") {

                        $prov = new Proveedor();
                        $prov->setCorreo($email);
                        $prov->setClave($clave);
                        $provLogin = $prov->loginProveedor();

                        if ($provLogin && is_object($provLogin)) {
                            $_SESSION['IDENTIDAD'] = $provLogin;
                            $iniciado = true;
                            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/">';
                        } else {
                            $_SESSION['ERR-LOGIN'] = "No hay cuentas de proveedores que coincidan con los datos ingresados";
                        }
                    } else if ($acceso == "Vendedor") {

                        $vend = new Vendedor();
                        $vend->setCorreo($email);
                        $vend->setClave($clave);

                        $vendLogin = $vend->loginVendedor();
                        if ($vendLogin && is_object($vendLogin)) {
                            $_SESSION['IDENTIDAD'] = $vendLogin;
                            $iniciado = true;
                            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/">';
                        } else {
                            $_SESSION['ERR-LOGIN'] = "No hay cuentas de vendedores que coincidan con los datos ingresados";
                        }
                    } else if ($acceso == "Cliente") {

                        $cli = new Cliente();
                        $cli->setCorreo($email);
                        $cli->setClave($clave);

                        $cli_login = $cli->loginCliente();

                        if ($cli_login && is_object($cli_login)) {
                            $_SESSION['IDENTIDAD'] = $cli_login;
                            $iniciado = true;
                            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/">';
                        } else {
                            $_SESSION['ERR-LOGIN'] = "No hay cuentas clientes que coincidan con los datos ingresados";
                        }
                    } else {
                        $_SESSION['ERR-LOGIN'] = "No se ha encontrado sus credenciales en los registros";
//                        echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/cliente/iniciar">';
                    }
                } else {
                    $_SESSION['ERR-LOGIN'] = "Ingrese correctamente sus credenciales";

                    //echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/cliente/iniciar">';
                }
            }

            if ($iniciado) {
                echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/">';
            } else {
                echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/cliente/iniciar">';
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function permite cerrar la sesion que se crear iniciar sesión dentro del sistema
     *  
     *
     * Este DocBlock documenta la función ingresar()
     */
    public function salir() {
        echo '<div style="margin-top: 350px; margin-bottom: 350px;">
                <center>
                    <div class="spinner-border" style="width: 200px; height: 200px; margin: auto;"></div> 
                </center>
            </div>';
        try {

            if (isset($_SESSION['IDENTIDAD'])) {
                unset($_SESSION['IDENTIDAD']);
            }
            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
