<?php

require_once 'models/personas/Turno.php';
require_once 'models/personas/persona.php';
require_once 'models/personas/vendedor.php';
require_once 'models/compras/Venta.php';


/**
 * Clase controladora del modelo vendedores
 *
 * @author Daniel Huenul
 */
class VendedorController { 

    /* VISTAS DE ADMINISTRADOR PARA VENDEDORES */
    

    /**
     * function que lleva a la interfas grafica de creación de nuevos vendedores
     * 
     * Este DocBlock documenta la función nuevovendedor() 
     */  
    public function vendedores() {

        $vendedor = new Vendedor();
        $vent = $vendedor->obtenerVendedores();

        require_once 'views/interfaz/modulo/vista_vendedores.php';
    }

    /**
     * function que lleva a la interfas grafica de creación de nuevos vendedores
     * 
     * Este DocBlock documenta la función nuevovendedor() 
     */  
    public function nuevovendedor() {
        require_once 'views/interfaz/modulo/vista_nuevovendedor.php';
    }

    /**
     * function que lleva a la interfas grafica de inicio de vendedor donde se muestras todas las ventas realizadas por el
     * 
     * Este DocBlock documenta la función detalleVendedor() 
     */ 
    public function modificarVendedor() {

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $vendedor = new Vendedor();
            $vendedor->setId($id);
            $vents = $vendedor->obtenerVendedor();
            $vt = $vents->fetch_object();

            if (!is_object($vt)) {
                $_SESSION['MODIFICAR']['ERR'] = "Se ha espesificado la busqueda de un vendedor no existente.";
            }
        } else {
            $_SESSION['MODIFICAR']['ERR'] = "Se esperaba un parametro para realizar esta acción.";
        }

        require_once 'views/interfaz/modulo/vista_modificaVendedor.php';
    }

    /**
     * function que lleva a la interfas grafica de inicio de vendedor donde se muestras todas las ventas realizadas por el
     * 
     * Este DocBlock documenta la función detalleVendedor() 
     */ 
    public function detalleVendedor() {

        if (isset($_GET['id'])) {

            $id = $_GET['id'];
            $ventas = new Venta();
            $ven = new Vendedor();
            $ven->setId($id);
            
            $listadoVentas = $ventas->obtenerVentasVendedor($id); 
            
            $vendedor = $ven->obtenerVendedor();
            $v = $vendedor->fetch_object();
            

            if (!is_object($v)) {
                $_SESSION['DETALLEVEND']['ERR'] = "Se ha espesificado la busqueda de un vendedor no existente.";
            }
        } else {
            $_SESSION['DETALLEVEND']['ERR'] = "Se esperaba un parametro para realizar esta acción.";
        }

        require_once 'views/interfaz/modulo/vista_detalleVendedor.php';
    }

    /* FIN VISTAS DE ADMINISTRADOR PARA VENDEDORES */


    /**
     * function que lleva a la interfas grafica de inicio de vendedor donde se muestras todas las ventas realizadas por el
     * 
     * Este DocBlock documenta la función inicio() 
     */ 
    public function inicio() { 
        $ventas = new Venta();
        $listVend = $ventas->obtenerVentasVendedor($_SESSION['IDENTIDAD']->idvendedores);

        require_once 'views/interfaz/modulo_vendedores/vista_vendedores.php';
    }

    /**
     * function que lleva a la interfas grafica para agregar nuevas ventas
     * 
     * Este DocBlock documenta la función registrarventa() 
     */ 
    public function registrarventa() {
        require_once 'views/interfaz/modulo_vendedores/vista_registrarventa.php';
    }

    /**
     * function que muestra los turnos de un vendedor en espesifico de la base de datos
     * 
     * Este DocBlock documenta la función misturnos() 
     */
    public function misturnos() {

        if (isset($_GET['id'])) {
            
            $id = $_GET['id'];
            
            $tur = new Turno();
            $listado = $tur->obtenerTurosVendedor($id); 
            
        }else{
            $_SESSION['MOSTRAR ERROR']['ERR'] = "Se esperaba un paramentro para realizar esta acción";
        } 

        require_once 'views/interfaz/modulo_vendedores/vista_misturnos.php';
    } 

    /* FUNCTIONS PARA PROCESAR LOS DATOS DE VENDEDORES */

    /**
     * function que realiza el guardado de nuevos vendedores en la base de datos
     * 
     * Este DocBlock documenta la función guardar() 
     */
    public function guardar() {
        echo '<div style="margin-top: 350px; margin-bottom: 350px;">
                <center>
                    <div class="spinner-border" style="width: 200px; height: 200px; margin: auto;"></div> 
                </center>
            </div>';
        try {

            if ($_POST) {
                //guardando los datos en variables
                $rut = isset($_POST['txt-rut']) ? $_POST['txt-rut'] : false;
                $nom = isset($_POST['txt-nom']) ? $_POST['txt-nom'] : false;
                $ape_p = isset($_POST['txt-ape-p']) ? $_POST['txt-ape-p'] : false;
                $ape_m = isset($_POST['txt-ape-m']) ? $_POST['txt-ape-m'] : false;
                $correo = isset($_POST['txt-correo']) ? $_POST['txt-correo'] : false;
                $pass = isset($_POST['txt-pass']) ? $_POST['txt-pass'] : false;

                $errores = array();
                //validando la rut
                if (!empty($rut) && strlen($rut) <= 10 && Utils::valida_rut($rut)) {
                    $rut_valido = true;
                } else {
                    $rut_valido = false;
                    $errores['rut'] = "<li>Rut invalido</li>";
                }

                //validando la nombre  
                if (!empty($nom) && !is_numeric($nom) && !preg_match("/[0-9]/", $nom)) {
                    if(strlen($nom) < 60){
                        $nom_valido = true;
                    }else{
                        $nom_valido = false;
                        $errores['nombre'] = "<li>El nombre solo debe tener 60 caracteres o menos</li>";
                    }
                } else {
                    $nom_valido = false;
                    $errores['nombre'] = "<li>Nombre invalido</li>";
                }

                //validando la apellido p  
                if (!empty($ape_p) && !is_numeric($ape_p) && !preg_match("/[0-9]/", $ape_p)) {
                    if(strlen($ape_p) < 60){
                        $apep_valido = true;
                    }else{
                        $apep_valido = false;
                        $errores['ape_p'] = "<li>El apellido paterno solo debe tener 60 caracteres o menos</li>";
                    }
                } else {
                    $apep_valido = false;
                    $errores['ape_p'] = "<li>Apellido paterno invalido</li>";
                } 

                //validando la apellido m  
                if (!empty($ape_m) && !is_numeric($ape_m) && !preg_match("/[0-9]/", $ape_m)) {
                    if(strlen($ape_m) < 60){
                        $apellido_m_valido = true;
                    }else{
                        $apellido_m_valido = false;
                        $errores['apellido_m'] = "<li>El apellido paterno solo debe tener 60 caracteres o menos</li>";
                    }
                } else {
                    $apellido_m_valido = false;
                    $errores['apellido_m'] = "<li>Apellido materno invalido</li>";
                }
    

                //validando correo 
                if (!empty($correo) && filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                    if(strlen($correo) < 60){
                        $email_validado = true;
                    }else{
                        $email_validado = false;
                        $errores['email'] = "<li>El email solo debe tener 60 caracteres o menos</li>";
                    } 
                } else {
                    $email_validado = false;
                    $errores['email'] = "<li>Email invalido</li>";
                }

                //validando contraseña 
                if (!empty($pass)) {
                    if(strlen($pass) < 11){
                        $clave_p_valido = true;
                    }else{
                        $clave_p_valido = false;
                        $errores['clave'] = "<li>La clave solo debe tener 10 caracteres o menos</li>";
                    } 
                } else {
                    $clave_p_valido = false;
                    $errores['clave'] = "<li>Clave invalida</li>";
                }

                //validar y guardar imagen
                $archivo = $_FILES['img-pro'];
                $nombreArchivo = $archivo['name'];
                $tipoArchivo = $archivo['type'];

                //verificar el tipo de archivo que es la imagen
                if ($tipoArchivo == "image/jpg" || $tipoArchivo == "image/jpeg" || $tipoArchivo == "image/png") {

                    if (!is_dir('uploads/users/vendedores')) {
                        mkdir('uploads/users/vendedores', 0777, true);
                    }

                    move_uploaded_file($archivo['tmp_name'], 'uploads/users/vendedores/' . $nombreArchivo);
                } else {
                    $errores['img'] = "<li>Tipo de imagen no admitido</li>";
                }

                //validando que hay errores 
                if (count($errores) == 0) {

                    $vent = new Vendedor();
                    $vent->setId(0);
                    $vent->setCodigo(rand());
                    $vent->setRut($rut);
                    $vent->setNombre($nom);
                    $vent->setApellido_m($ape_m);
                    $vent->setApellido_p($ape_p);
                    $vent->setRol('VENDEDOR');
                    $vent->setFoto($nombreArchivo);

                    //cifrar contraseña
                    $claveSegura = password_hash($pass, PASSWORD_BCRYPT, ['cost' => 4]);

                    $vent->setCorreo($correo);
                    $vent->setClave($claveSegura);

                    $vend_correo = $vent->obtenerVendedorCorreo();
                    $vend_rut = $vent->obtenerVendedorRut();
 
                    $errores_duplicidad = "";
                    if ($vend_correo && $vend_correo->correo == $vent->getCorreo()) {
                        $errores_duplicidad .= "<li>El correo ingresado ya esta en uso por otro usuario.</li>";
                    }

                    if ($vend_rut && $vend_rut->rut == $vent->getRut()) {
                        $errores_duplicidad .= "<li>El rut ingresado ya esta en uso por otro usuario.</li>";
                    }

                    if ($errores_duplicidad == "") {
                        $agregado = $vent->agregarVendedor();

                        if ($agregado) {
                            $_SESSION['VENTADD']['OK'] = "Vendedor registrador correctamente.";
                        } else {
                            $_SESSION['VENTADD']['ERR'] = "Error durante el proceso de guardado de vendedor.";
                        }
                    } else {
                        $_SESSION['VENTADD']['ERR'] = $errores_duplicidad;
                    }
                } else {
                    $_SESSION['VENTADD']['ERR'] = implode($errores);
                }
            }
            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/vendedor/nuevovendedor">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que realiza el eliminado de vendedores en la base de datos
     * 
     * Este DocBlock documenta la función eliminar() 
     */
    public function eliminar() {
        echo '<div style="margin-top: 350px; margin-bottom: 350px;">
                <center>
                    <div class="spinner-border" style="width: 200px; height: 200px; margin: auto;"></div> 
                </center>
            </div>';
        try {

            if (isset($_GET['id'])) {

                $id = isset($_GET['id']) ? $_GET['id'] : false;

                if (is_numeric($id)) {
                    $vent = new Vendedor();
                    $vent->setId($id);
                    $eliminado = $vent->eliminarVendedor();

                    if ($eliminado) {
                        $_SESSION['VENTDEL']['OK'] = "Vendedor eliminado correctamente.";
                    } else {
                        $_SESSION['VENTADD']['ERR'] = "Ocurrio un error durante el proceso de eliminado de vendedor";
                    }
                } else {
                    $_SESSION['VENTADD']['ERR'] = "Se esperaba un parametro para realizar esta operación";
                }
            } else {
                $_SESSION['VENTADD']['ERR'] = "Se esperaba un parametro para realizar esta operación";
            }

            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/vendedor/vendedores">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que realiza el modificado de vendedores en la base de datos
     * 
     * Este DocBlock documenta la función modificar() 
     */
    public function modificar() {
        echo '<div style="margin-top: 350px; margin-bottom: 350px;">
                <center>
                    <div class="spinner-border" style="width: 200px; height: 200px; margin: auto;"></div> 
                </center>
            </div>';
        try {

            if (isset($_GET['id'])) {

                $id = $_GET['id'];
                //guardando los datos en variables
                $rut = isset($_POST['txt-rut']) ? $_POST['txt-rut'] : false;
                $nom = isset($_POST['txt-nom']) ? $_POST['txt-nom'] : false;
                $ape_p = isset($_POST['txt-ape-p']) ? $_POST['txt-ape-p'] : false;
                $ape_m = isset($_POST['txt-ape-m']) ? $_POST['txt-ape-m'] : false;
                $correo = isset($_POST['txt-correo']) ? $_POST['txt-correo'] : false;
                $pass = isset($_POST['txt-pass']) ? $_POST['txt-pass'] : false;

                $errores = array();
                //validando la rut
                if (!empty($rut) && strlen($rut) <= 10 && Utils::valida_rut($rut)) {
                    $rut_valido = true;
                } else {
                    $rut_valido = false;
                    $errores['rut'] = "<li>Rut invalido</li>";
                }

                //validando la nombre  
                if (!empty($nom) && !is_numeric($nom) && !preg_match("/[0-9]/", $nom)) {
                    if(strlen($nom) < 60){
                        $nom_valido = true;
                    }else{
                        $nom_valido = false;
                        $errores['nombre'] = "<li>El nombre solo debe tener 60 caracteres o menos</li>";
                    }
                } else {
                    $nom_valido = false;
                    $errores['nombre'] = "<li>Nombre invalido</li>";
                }

                //validando la apellido p  
                if (!empty($ape_p) && !is_numeric($ape_p) && !preg_match("/[0-9]/", $ape_p)) {
                    if(strlen($ape_p) < 60){
                        $apep_valido = true;
                    }else{
                        $apep_valido = false;
                        $errores['ape_p'] = "<li>El apellido paterno solo debe tener 60 caracteres o menos</li>";
                    }
                } else {
                    $apep_valido = false;
                    $errores['ape_p'] = "<li>Apellido paterno invalido</li>";
                } 

                //validando la apellido m  
                if (!empty($ape_m) && !is_numeric($ape_m) && !preg_match("/[0-9]/", $ape_m)) {
                    if(strlen($ape_m) < 60){
                        $apellido_m_valido = true;
                    }else{
                        $apellido_m_valido = false;
                        $errores['apellido_m'] = "<li>El apellido paterno solo debe tener 60 caracteres o menos</li>";
                    }
                } else {
                    $apellido_m_valido = false;
                    $errores['apellido_m'] = "<li>Apellido materno invalido</li>";
                }
    

                //validando correo 
                if (!empty($correo) && filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                    if(strlen($correo) < 60){
                        $email_validado = true;
                    }else{
                        $email_validado = false;
                        $errores['email'] = "<li>El email solo debe tener 60 caracteres o menos</li>";
                    } 
                } else {
                    $email_validado = false;
                    $errores['email'] = "<li>Email invalido</li>";
                }

                //validando contraseña   
                if (!empty($pass)) { 
                    $clave_p_valido = true; 
                } else {
                    $clave_p_valido = false;
                    $errores['clave_p'] = "<li>Clave vacía</li>";
                } 


                if (isset($_FILES['img-pro'])) {
                    //validar y guardar imagen
                    $archivo = $_FILES['img-pro'];
                    $nombreArchivo = $archivo['name'];
                    $tipoArchivo = $archivo['type'];

                    if ($nombreArchivo != "") {
                        //verificar el tipo de archivo que es la imagen
                        if ($tipoArchivo == "image/jpg" || $tipoArchivo == "image/jpeg" || $tipoArchivo == "image/png") {

                            if (!is_dir('uploads/users/vendedores')) {
                                mkdir('uploads/users/vendedores', 0777, true);
                            }

                            move_uploaded_file($archivo['tmp_name'], 'uploads/users/vendedores/' . $nombreArchivo);
                        } else {
                            $errores['img'] = "<li>Tipo de imagen no admitido</li>";
                        }
                    }
                }


                //validando que hay errores 
                if (count($errores) == 0) {

                    $vent = new Vendedor();
                    $vent->setId($id);

                    $vent->setRut($rut);
                    $vent->setNombre($nom);
                    $vent->setApellido_m($ape_m);
                    $vent->setApellido_p($ape_p);

                    $vent->setFoto($nombreArchivo);
                    $vent->setCorreo($correo);

                    $claveSegura = "";
                    if (strlen($pass) < 50) {

                        //cifrar contraseña
                        $claveSegura = password_hash($pass, PASSWORD_BCRYPT, ['cost' => 4]);
                        $vent->setClave($claveSegura);
                    }

                    $vent->setClave($claveSegura);

                    $vent_correo = $vent->obtenerVendedorCorreo();
                    $vent_rut = $vent->obtenerVendedorRut();
                    
                    

                    $errores_duplicidad = "";
                    if ($vent_correo && $vent_correo->correo == $vent->getCorreo()) {
                        if($id != $vent_correo->idvendedores){
                            $errores_duplicidad .= "<li>El correo ingresado ya esta en uso por otro usuario.</li>";
                        }
                    }

                    if ($vent_rut && $vent_rut->rut == $vent->getRut()) {
                        if($id != $vent_rut->idvendedores){
                            $errores_duplicidad .= "<li>El rut ingresado ya esta en uso por otro usuario.</li>";
                        }
                    }

                    if ($errores_duplicidad == "") {
                        $agregado = $vent->modificarVendedor();


                        if ($agregado) {
                            $_SESSION['VENTUPDATE']['OK'] = "Vendedor modificado correctamente.";
                        } else {
                            $_SESSION['VENTUPDATE']['ERR'] = "Error durante el proceso de modificación de vendedor.";
                        }
                    } else {
                        $_SESSION['VENTUPDATE']['ERR'] = $errores_duplicidad;
                    }
                } else {
                    $_SESSION['VENTUPDATE']['ERR'] = implode($errores);
                }
            }
            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/vendedor/vendedores">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /* FIN FUNCTIONS PARA PROCESAR LOS DATOS DE VENDEDORES */
}
