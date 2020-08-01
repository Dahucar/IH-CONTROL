<?php

require_once 'models/personas/persona.php';
require_once 'models/personas/Proveedor.php';

/**
 * Clase contrlador de proveedor 
 *
 * @author Daniel Huenul
 */
class proveedorController {


    /**
     * function que lleva la interfas grafica con todos los proveedores que hay registrados
     * en la base de datos
     * 
     * Este DocBlock documenta la función inicioProveedores() 
     */
    public function inicioProveedores() {

        $prov = new Proveedor();
        $prov->setId($_SESSION['IDENTIDAD']->idproveedores);
        $listado = $prov->obtenerPedidosProveedor();

        require_once 'views/interfaz/modulo_proveedores/vista_proveedores.php';
    }

    /**
     * function que lleva la interfas grafica con todos los proveedores que hay registrados
     * en la base de datos
     * 
     * Este DocBlock documenta la función proveedores() 
     */
    public function proveedores() {

        $prov = new Proveedor();
        $pv = $prov->obtenerProveedors();

        require_once 'views/interfaz/modulo/vista_proveedores.php';
    }

    /**
     * function que lleva la interfas grafica de detalle de un proveedor donde 
     * se cargan todos pedidos realizados a un proveedor ademas de sus datos
     * 
     * Este DocBlock documenta la función nuevoproveedor() 
     */
    public function nuevoproveedor() {
        require_once 'views/interfaz/modulo/vista_nuevoproveedor.php';
    }

    /**
     * function que lleva la interfas grafica de detalle de un proveedor donde 
     * se cargan todos pedidos realizados a un proveedor ademas de sus datos
     * 
     * Este DocBlock documenta la función detalleproveedor() 
     */
    public function detalleproveedor() {

        if (isset($_GET['id'])) {
            $idP = $_GET['id'];

            if (is_numeric($idP)) {

                $prov = new Proveedor();
                $prov->setId($idP);
                $proveedor = $prov->obtenerProveedor();
                $pro = $proveedor->fetch_object();
                
                $listado = $prov->obtenerPedidosProveedor();
                
            } else {
                $_SESSION['DETALLEPROV']['ERR'] = "Se esperaba un tipo de parametro en particular para realizar esta acción.";
            }
        } else {
            $_SESSION['DETALLEPROV']['ERR'] = "Se esperaba un parametro para realizar esta acción.";
        }

        require_once 'views/interfaz/modulo/vista_detallerproveedor.php';
    }

    /**
     * function que lleva la interfas grafica para modificar un proveedor en espesifico donde se cargan todos los datos del proveedor
     * 
     * Este DocBlock documenta la función modificarProveedor() 
     */
    public function modificarProveedor() {
        if (isset($_GET['id'])) {
            $id_p = $_GET['id'];

            //obteniendo el producto
            $prov = new Proveedor();
            $prov->setId($id_p);
            $producto_encontrado = $prov->obtenerProveedor();
            $p = $producto_encontrado->fetch_object();

            if (!is_object($p)) {
                $_SESSION['MODIFICAR']['ERR'] = "Se ha espesificado la busqueda de un producto no existente.";
            }
        } else {
            $_SESSION['MODIFICAR']['ERR'] = "Se esperaba un parametro para efectuar esta operación.";
        }

        require_once 'views/interfaz/modulo/vista_modificarProveedor.php';
    }

    /**
     * function que lleva la interfas grafica para modificar los datos del proveedor
     * 
     * Este DocBlock documenta la función misDatos() 
     */
    public function misDatos() {  
            $id_p = $_SESSION['IDENTIDAD']->idproveedores;

            //obteniendo el producto
            $prov = new Proveedor();
            $prov->setId($id_p);
            $producto_encontrado = $prov->obtenerProveedor();
            $p = $producto_encontrado->fetch_object();

            if (!is_object($p)) {
                $_SESSION['MODIFICAR']['ERR'] = "Se ha espesificado la busqueda de un producto no existente.";
            } 

        require_once 'views/interfaz/modulo_proveedores/vista_misDatos.php';
    }

    /**
     * function que permite añadir un nuevo proveedor a la base de datos
     * 
     * Este DocBlock documenta la función agregar() 
     */
    public function agregar() {
        echo '<div style="margin-top: 350px; margin-bottom: 350px;">
                <center>
                    <div class="spinner-border" style="width: 200px; height: 200px; margin: auto;"></div> 
                </center>
            </div>';
        if ($_POST) {
            //guardando los datos en variables
            $rut_p = isset($_POST['campo_rut']) ? $_POST['campo_rut'] : false;
            $nom_p = isset($_POST['campo_nombre']) ? $_POST['campo_nombre'] : false;
            $ape_p_p = isset($_POST['campo_ppaterno']) ? $_POST['campo_ppaterno'] : false;
            $ape_p_m = isset($_POST['campo_pmaterno']) ? $_POST['campo_pmaterno'] : false;
            $nom_comp_p = isset($_POST['campo_nomCompañia']) ? $_POST['campo_nomCompañia'] : false;
            $direcc_p = isset($_POST['campo_direccion']) ? $_POST['campo_direccion'] : false;
            $mail_p = isset($_POST['campo_mail']) ? $_POST['campo_mail'] : false;
            $clave_p = isset($_POST['campo_clave']) ? $_POST['campo_clave'] : false;

            //validando datos
            $errores = array();
            if (!empty($rut_p) && strlen($rut_p) <= 10 && Utils::valida_rut($rut_p)) {
                $rut_valido = true;
            } else {
                $rut_valido = false;
                $errores['rut'] = "<li>Rut invalido</li>";
            }

            if (!empty($nom_p) && !is_numeric($nom_p) && !preg_match("/[0-9]/", $nom_p)) {
                if(strlen($nom_p) < 60){
                    $nombre_valido = true;
                }else{
                    $nombre_valido = false;
                    $errores['nombre'] = "<li>El nombre solo debe tener 60 caracteres o menos</li>";
                }
            } else {
                $nombre_valido = false;
                $errores['nombre'] = "<li>Nombre invalido</li>";
            }

            if (!empty($ape_p_p) && !is_numeric($ape_p_p) && !preg_match("/[0-9]/", $ape_p_p)) {
                if(strlen($ape_p_p) < 60){
                    $apellido_p_valido = true;
                }else{
                    $nombre_valido = false;
                    $errores['apellido_p'] = "<li>El apellido paterno solo debe tener 60 caracteres o menos</li>";
                }
            } else {
                $apellido_p_valido = false;
                $errores['apellido_p'] = "<li>Apellido paterno invalido</li>";
            } 

            if (!empty($ape_p_m) && !is_numeric($ape_p_m) && !preg_match("/[0-9]/", $ape_p_m)) {
                if(strlen($ape_p_m) < 60){
                    $apellido_m_valido = true;
                }else{
                    $apellido_m_valido = false;
                    $errores['apellido_m'] = "<li>El apellido paterno solo debe tener 60 caracteres o menos</li>";
                }
            } else {
                $apellido_m_valido = false;
                $errores['apellido_m'] = "<li>Apellido materno invalido</li>";
            }

            if (!empty($nom_comp_p)) {
                if(strlen($nom_comp_p) < 60){
                    $nom_comp_p_valido = true;
                }else{
                    $nom_comp_p_valido = false;
                    $errores['nom_comapñia'] = "<li>El nombre de la compañia solo debe tener 60 caracteres o menos</li>";
                } 
            } else {
                $nom_comp_p_valido = false;
                $errores['nom_comapñia'] = "<li>Nombre compañia invalido</li>";
            }

            if (!empty($direcc_p)) {
                if(strlen($direcc_p) < 255){
                    $direcc_p_valido = true;
                }else{
                    $direcc_p_valido = false;
                    $errores['direcc'] = "<li>La dirección solo debe tener 255 caracteres o menos</li>";
                } 
            } else {
                $direcc_p_valido = false;
                $errores['direcc'] = "<li>Dirección invalido</li>";
            }

            if (!empty($mail_p) && filter_var($mail_p, FILTER_VALIDATE_EMAIL)) {
                if(strlen($mail_p) < 60){
                    $email_validado = true;
                }else{
                    $email_validado = false;
                    $errores['email'] = "<li>El email solo debe tener 60 caracteres o menos</li>";
                } 
            } else {
                $email_validado = false;
                $errores['email'] = "<li>Email invalido</li>";
            }

            if (!empty($clave_p)) {
                if(strlen($clave_p) < 11){
                    $clave_p_valido = true;
                }else{
                    $clave_p_valido = false;
                    $errores['clave'] = "<li>La clave solo debe tener 10 caracteres o menos</li>";
                } 
            } else {
                $clave_p_valido = false;
                $errores['clave'] = "<li>Clave invalida</li>";
            }

            $nombreArchivo = "";
            if(isset($_FILES['img-pro']) && $_FILES['img-pro']['name'] != ""){
                //validar y guardar imagen
                $archivo = $_FILES['img-pro'];
                $nombreArchivo = $archivo['name'];
                $tipoArchivo = $archivo['type'];
                    
                if ($tipoArchivo == "image/jpg" || $tipoArchivo == "image/jpeg" || $tipoArchivo == "image/png") {
                    if (!is_dir('uploads/images')) {
                        mkdir('uploads/images', 0777, true);
                    }

                    move_uploaded_file($archivo['tmp_name'], 'uploads/images/' . $nombreArchivo);
                } else {
                    $errores['img'] = "<li>Tipo de archivo no admitido o no seleccionado</li>";
                }
            }

            if (count($errores) == 0) {
                $prove = new Proveedor();
                $prove->setId(0);
                $prove->setCodigo(rand());
                $prove->setRut($rut_p);
                $prove->setNombre($nom_p);
                $prove->setApellido_p($ape_p_p);
                $prove->setApellido_m($ape_p_m);
                $prove->setNombreCompañia($nom_comp_p);

                if($nombreArchivo != ""){
                    $prove->setLogoProveedor($nombreArchivo);
                }else{
                    $prove->setLogoProveedor('defaultImage.png');
                }
                
                $prove->setDireccion($direcc_p);
                $prove->setRol("PROVEEDOR");
                $prove->setCorreo($mail_p);

                $claveSegura = password_hash($clave_p, PASSWORD_BCRYPT, ['cost' => 4]);

                $prove->setClave($claveSegura);

                $prove_correo = $prove->obtenerProveedorCorreo();
                $prove_rut = $prove->obtenerProveedorRut();

                $errores_duplicidad = "";
                if ($prove_correo && $prove_correo->correo == $prove->getCorreo()) {
                    $errores_duplicidad .= "<li>El correo ingresado ya esta en uso por otro usuario.</li>";
                }

                if ($prove_rut && $prove_rut->rut == $prove->getRut()) {
                    $errores_duplicidad .= "<li>El rut ingresado ya esta en uso por otro usuario.</li>";
                }

                if ($errores_duplicidad == "") {
                    $agregado = $prove->agregarProveedor();

                    if ($agregado) {
                        $_SESSION['ADDPROD']['OK'] = "Proveedor registrado correctamente.";
                    } else {
                        $_SESSION['ADDPROD']['ERR'] = "Error durante el proceso de guardado de proveedor.";
                    }
                } else {
                    $_SESSION['ADDPROD']['ERR'] = $errores_duplicidad;
                }
            } else {
                $_SESSION['ADDPROD']['ERR'] = implode($errores);
            }
        }

        echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/proveedor/nuevoproveedor">';
    }

    /**
     * function que permite eliminar un nuevo proveedor de la base de datos
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

                    $prov = new Proveedor();
                    $prov->setId($id);

                    $eliminado = $prov->eliminarProveedor();

                    if ($eliminado) {
                        $_SESSION['DELPROV']['OK'] = "Proveedor eliminado correctamente.";
                    } else {
                        $_SESSION['DELPROV']['ERR'] = "Error durante el proceso de eliminado de proveedor.";
                    }
                } else {
                    $_SESSION['DELPROV']['ERR'] = "Se esperaba el ingreso de parametro para completar esta acción.";
                }
            } else {
                $_SESSION['DELPROV']['ERR'] = "Se esperaba el ingreso de parametro para completar esta acción.";
            }

            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/proveedor/proveedores">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite mdoficar un proveedor de la base de datos
     * 
     * Este DocBlock documenta la función modificar() 
     */
    public function modificar() { 
        echo '<div style="margin-top: 350px; margin-bottom: 350px;">
                <center>
                    <div class="spinner-border" style="width: 200px; height: 200px; margin: auto;"></div> 
                </center>
            </div>';
        $modP = isset($_GET['idp']) ? true : false; 
        try {
            if (isset($_GET['id']) || isset($_GET['idp'])) {
                $id_p = 0;
                if(isset($_GET['id'])){
                    $id_p = $_GET['id'];
                }else if (isset($_GET['idp'])){
                    $id_p = $_GET['idp'];
                }  
 
                //guardando los datos en variables
                $rut_p = isset($_POST['campo_rut']) ? $_POST['campo_rut'] : false;
                $nom_p = isset($_POST['campo_nombre']) ? $_POST['campo_nombre'] : false;
                $ape_p_p = isset($_POST['campo_ppaterno']) ? $_POST['campo_ppaterno'] : false;
                $ape_p_m = isset($_POST['campo_pmaterno']) ? $_POST['campo_pmaterno'] : false;
                $nom_comp_p = isset($_POST['campo_nomCompañia']) ? $_POST['campo_nomCompañia'] : false;
                $direcc_p = isset($_POST['campo_direccion']) ? $_POST['campo_direccion'] : false;
                $mail_p = isset($_POST['campo_mail']) ? $_POST['campo_mail'] : false;
                $clave_p = isset($_POST['campo_clave']) ? $_POST['campo_clave'] : false;


                //validando datos
                $errores = array();
                if (!empty($rut_p) && strlen($rut_p) <= 10 && Utils::valida_rut($rut_p)) {
                    $rut_valido = true;
                } else {
                    $rut_valido = false;
                    $errores['rut'] = "<li>Rut invalido</li>";
                }
    
                if (!empty($nom_p) && !is_numeric($nom_p) && !preg_match("/[0-9]/", $nom_p)) {
                    if(strlen($nom_p) < 60){
                        $nombre_valido = true;
                    }else{
                        $nombre_valido = false;
                        $errores['nombre'] = "<li>El nombre solo debe tener 60 caracteres o menos</li>";
                    }
                } else {
                    $nombre_valido = false;
                    $errores['nombre'] = "<li>Nombre invalido</li>";
                }
    
                if (!empty($ape_p_p) && !is_numeric($ape_p_p) && !preg_match("/[0-9]/", $ape_p_p)) {
                    if(strlen($ape_p_p) < 60){
                        $apellido_p_valido = true;
                    }else{
                        $nombre_valido = false;
                        $errores['apellido_p'] = "<li>El apellido paterno solo debe tener 60 caracteres o menos</li>";
                    }
                } else {
                    $apellido_p_valido = false;
                    $errores['apellido_p'] = "<li>Apellido paterno invalido</li>";
                } 
    
                if (!empty($ape_p_m) && !is_numeric($ape_p_m) && !preg_match("/[0-9]/", $ape_p_m)) {
                    if(strlen($ape_p_m) < 60){
                        $apellido_m_valido = true;
                    }else{
                        $apellido_m_valido = false;
                        $errores['apellido_m'] = "<li>El apellido paterno solo debe tener 60 caracteres o menos</li>";
                    }
                } else {
                    $apellido_m_valido = false;
                    $errores['apellido_m'] = "<li>Apellido materno invalido</li>";
                }
    
                if (!empty($nom_comp_p)) {
                    if(strlen($nom_comp_p) < 60){
                        $nom_comp_p_valido = true;
                    }else{
                        $nom_comp_p_valido = false;
                        $errores['nom_comapñia'] = "<li>El nombre de la compañia solo debe tener 60 caracteres o menos</li>";
                    } 
                } else {
                    $nom_comp_p_valido = false;
                    $errores['nom_comapñia'] = "<li>Nombre compañia invalido</li>";
                }
    
                if (!empty($direcc_p)) {
                    if(strlen($direcc_p) < 255){
                        $direcc_p_valido = true;
                    }else{
                        $direcc_p_valido = false;
                        $errores['direcc'] = "<li>La dirección solo debe tener 255 caracteres o menos</li>";
                    } 
                } else {
                    $direcc_p_valido = false;
                    $errores['direcc'] = "<li>Dirección invalido</li>";
                }
    
                if (!empty($mail_p) && filter_var($mail_p, FILTER_VALIDATE_EMAIL)) {
                    if(strlen($mail_p) < 60){
                        $email_validado = true;
                    }else{
                        $email_validado = false;
                        $errores['email'] = "<li>El email solo debe tener 60 caracteres o menos</li>";
                    } 
                } else {
                    $email_validado = false;
                    $errores['email'] = "<li>Email invalido</li>";
                }

                if (!empty($clave_p)) { 
                    $clave_p_valido = true; 
                } else {
                    $clave_p_valido = false;
                    $errores['clave_p'] = "<li>Clave vacía</li>";
                }  

                $nombreArchivo = "";
                if(isset($_FILES['img-pro']) && $_FILES['img-pro']['name'] != ""){
                    //validar y guardar imagen
                    $archivo = $_FILES['img-pro'];
                    $nombreArchivo = $archivo['name'];
                    $tipoArchivo = $archivo['type'];
                        
                    if ($tipoArchivo == "image/jpg" || $tipoArchivo == "image/jpeg" || $tipoArchivo == "image/png") {
                        if (!is_dir('uploads/users/proveedores')) {
                            mkdir('uploads/users/proveedores', 0777, true);
                        }

                        move_uploaded_file($archivo['tmp_name'], 'uploads/users/proveedores/' . $nombreArchivo);
                    } else {
                        $errores['img'] = "<li>Tipo de archivo no admitido o no seleccionado</li>";
                    }
                }

                

                if (count($errores) == 0) {

                    $prove = new Proveedor();
                    $prove->setId($id_p);
                    $prove->setRut($rut_p);
                    $prove->setNombre($nom_p);
                    $prove->setApellido_p($ape_p_p);
                    $prove->setApellido_m($ape_p_m);
                    $prove->setNombreCompañia($nom_comp_p);
                    $prove->setDireccion($direcc_p);
                    $prove->setCorreo($mail_p);

                    if($nombreArchivo != ""){
                        $prove->setLogoProveedor($nombreArchivo);
                    }

                    $claveSegura = "";
                    if (strlen($clave_p) < 50) {

                        //cifrar contraseña
                        $claveSegura = password_hash($clave_p, PASSWORD_BCRYPT, ['cost' => 4]);
                        $prove->setClave($claveSegura);
                    }
 
                    $prove_correo = $prove->obtenerProveedorCorreo();
                    $prove_rut = $prove->obtenerProveedorRut();
 
                    $errores_duplicidad = "";
                    if ($prove_correo && $prove_correo->correo == $prove->getCorreo()) {
                        if($id_p != $prove_correo->idproveedores){
                            $errores_duplicidad .= "<li>El correo ingresado ya esta en uso por otro usuario.</li>";
                        }
                    }

                    if ($prove_rut && $prove_rut->rut == $prove->getRut()) {
                        if($id_p != $prove_rut->idproveedores){
                            $errores_duplicidad .= "<li>El rut ingresado ya esta en uso por otro usuario.</li>";
                        }
                    }
                    if ($errores_duplicidad == "") {
                        $agregado = $prove->modificarProveedor();

                        if ($agregado) {
                            $_SESSION['UPDATEPROVEE']['OK'] = "Proveedor modificado correctamente.";
                        } else {
                            $_SESSION['UPDATEPROVEE']['ERR'] = "Error durante el proceso de modificado de proveedor.";
                        }
                    } else {
                        $_SESSION['UPDATEPROVEE']['ERR'] = $errores_duplicidad;
                    }
                } else {
                    $_SESSION['UPDATEPROVEE']['ERR'] = implode($errores);
                }
            } else {
                $_SESSION['UPDATEPROVEE-FINAL']['ERR'] = "Se esperaba un parametro para modicar el producto";
            }


            if($modP){
                echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/proveedor/misDatos">';
            }else{
                echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/proveedor/proveedores">';
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
