<?php

require_once 'models/pedido/Producto.php';
require_once 'models/pedido/Categoria.php';
require_once 'models/pedido/Estado.php';
require_once 'models/pedido/Pedido.php'; 
require_once 'models/pedido/Alerta.php'; 

require_once 'models/personas/persona.php';
require_once 'models/personas/administrador.php';
require_once 'models/personas/Proveedor.php';
require_once 'models/personas/vendedor.php';
require_once 'models/personas/cliente.php';
require_once 'models/personas/Turno.php';

require_once 'models/compras/Venta.php';
require_once 'models/compras/Compra.php';

//require_once 'C:\wamp64\www\Inmuebles-Herrera\vendor\autoload.php' ; 

use Spipu\Html2Pdf\Html2Pdf;

/**
 * Clase controladora del modelo administrador
 *
 * @author Daniel Huenul
 */
class administradorController { 


    /**
     * function que permite llevar a la vista general de administradores registrados
     * 
     * Este DocBlock documenta la función administradores() 
     */ 
    public function administradores() {

        $adm = new administrador();
        $listado = $adm->obtenerAdministradores();
        
        require_once 'views/interfaz/modulo/vista_administradores.php';
    }

    /**
     * function que permite llevar a la vista para agregar un nuevo administrador
     * 
     * Este DocBlock documenta la función modificarAdministrador() 
     */ 
    public function nuevoAdministrador() {
        require_once 'views/interfaz/modulo/vista_nuevoAdministrador.php';
    }
    
    /**
     * function que permite llevar a la vista de modificado de un administrador en espesifico.
     * 
     * Este DocBlock documenta la función modificarAdministrador() 
     */ 
    public function modificarAdministrador() {
        if (isset($_GET['id'])) {
            $id_p = $_GET['id'];

            //obteniendo todas las categorias
            $adm = new administrador();
            $adm->setId($id_p);
            $resultAdm = $adm->obtenerAdm();
            $admEnt = $resultAdm->fetch_object();
            //imagenPrincipal  

            if (!is_object($admEnt)) {
                $_SESSION['MODIFICARADM']['ERR'] = "Se ha espesificado la busqueda de un administrador no existente.";
            }
        } else {
            $_SESSION['MODIFICARADM']['ERR'] = "Se esperaba un parametro para efectuar esta operación.";
        }
        require_once 'views/interfaz/modulo/vista_modificarAdministrador.php';
    }
    
    /**
     * function que permite llevar a la vista principal del modulo de administradores onde se 
     * muestran datos relacionados a stock o la cantidad de determinados registros
     * 
     * Este DocBlock documenta la función inicio() 
     */ 
    public function inicio() { 
        
        $vent = new Venta();
        $resultado = $vent->obtenerCantVentas();  
        $cantVentas = $resultado->CANTIDAD;
        
        $comp = new Compra();
        $resltC = $comp->obtenerCantCompras();
        $cantC = $resltC->CANTC;
        
        $prod = new Producto();
        $stockPorcent = $prod->obtenerPorcentajeStock(); 
        $cantActual = $stockPorcent->CANTACTUAL;
        $cantTotal = $stockPorcent->CANTTOTAL;
        $porcentaje = round(($cantActual * 100) / $cantTotal);

        $ped = new Pedido();
        $resultPed = $ped->obtenerStock();
        $cantPed = $resultPed->CANTPED;

        $prov = new Proveedor();
        $resultProv = $prov->obtenerCantProv();
        $cantProv = $resultProv->CANTPROV;

        $vend = new Vendedor();
        $resultVend = $vend->obtenerCantVend();
        $cantVend = $resultVend->CANTVEND;

        $turn = new Turno();
        $resulTurn = $turn->obtenerCantTurn();
        $cantTurn = $resulTurn->CANTTURN;
        
        $alert = new Alerta();
        $resulAlert = $alert->obtenerCantAlert();
        $cantAlert = $resulAlert->CANTALERT;
        
        $client = new Cliente();
        $resulCli = $client->obtenerCantCli();
        $cantCli = $resulCli->CANTCLI;
        
        require_once 'views/interfaz/modulo/vista_adm.php';
    } 
    
    /**
     * function que permite a la vista de inicio de administrador deonde se cargan datos de interes sobre los datos
     * del negocio. 
     * 
     * Este DocBlock documenta la función inicio() 
     */ 
    public function reportes() {

        //cargando todas las categorias registradas
        $categoria = new Categoria();
        $cats = $categoria->obtenerCategorias();

        //cargando todas los estados registrados
        $estado = new Estado();
        $ests = $estado->obtenerEstados();

        //cargando todos los productos registrados
        $producto = new Producto();
        $pro = $producto->obtenerProductosExtra(false, false, false, false); 

        //fin paginacion de tabla productos
        $proveedor = new Proveedor();
        $prov = $proveedor->obtenerProveedors();   
        
        $vendedor = new Vendedor();
        $vend = $vendedor->obtenerVendedores();
        
        $venta = new Venta();
        $vent = $venta->obtenerVentaDetalle();

        require_once 'views/interfaz/modulo/vista_reportes.php';
    }  
    
    /**
     * function que permite filtrar los producot sen torno a determinados campos del registro
     * 
     * Este DocBlock documenta la función filtrarProductos() 
     */ 
    public function filtrarProductos() {
        try {

            $precio_desde = isset($_POST['txt-precio-desde']) ? $_POST['txt-precio-desde'] : "";
            $precio_hasta = isset($_POST['txt-precio-hasta']) ? $_POST['txt-precio-hasta'] : "";
            $categoria = isset($_POST['select-categ']) ? $_POST['select-categ'] : "";
            $estado = isset($_POST['select-estado']) ? $_POST['select-estado'] : "";

            $pro = new Producto();
            $pro->obtenerProductosExtra($precio_desde, $precio_hasta, $categoria, $estado);

            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/administrador/reportes">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    } 

    /**
     * function que permite añadir un nuevo administrador a la base de datos
     * 
     * Este DocBlock documenta la función agregarAdministrador() 
     */
    public function agregarAdministrador() {
        echo '<div style="margin-top: 350px; margin-bottom: 350px;">
                <center>
                    <div class="spinner-border" style="width: 200px; height: 200px; margin: auto;"></div> 
                </center>
            </div>';
        try {
            if ($_POST) {
                //guardando los datos en variables
                $rut_p = isset($_POST['campo_rut']) ? $_POST['campo_rut'] : '';
                $nom_p = isset($_POST['campo_nombre']) ? $_POST['campo_nombre'] : '';
                $ape_p_p = isset($_POST['campo_ppaterno']) ? $_POST['campo_ppaterno'] : '';
                $ape_p_m = isset($_POST['campo_pmaterno']) ? $_POST['campo_pmaterno'] : '';
                $mail_p = isset($_POST['campo_mail']) ? $_POST['campo_mail'] : '';
                $clave_p = isset($_POST['campo_clave']) ? $_POST['campo_clave'] : '';

                //validando datos
                $errores = array();
                if (!empty($rut_p) && strlen($rut_p) <= 10 && Utils::valida_rut($rut_p)) {
                    $rut_valido = true;
                } else {
                    $rut_valido = false;
                    $errores['rut'] = "<li>Rut invalido o esta vacío</li>";
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
                        $nombre_valido = false;
                        $errores['apellido_m'] = "<li>El apellido paterno solo debe tener 60 caracteres o menos</li>";
                    }
                } else {
                    $apellido_m_valido = false;
                    $errores['apellido_m'] = "<li>Apellido materno invalido</li>";
                }

                if (!empty($mail_p) && filter_var($mail_p, FILTER_VALIDATE_EMAIL)) {
                    if(strlen($mail_p) < 60){
                        $email_validado = true;
                    }else{
                        $email_validado = false;
                        $errores['email'] = "<li>El mail solo debe tener 60 caracteres o menos</li>";
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
                        $errores['clave_p'] = "<li>La clave solo debe tener 10 caracteres o menos</li>";
                    }
                } else {
                    $clave_p_valido = false;
                    $errores['clave_p'] = "<li>Clave vacía</li>";
                } 
               
                if (count($errores) == 0) {
                    $adm = new administrador();
                    $adm->setId(0);
                    $adm->setCodigo(rand());
                    $adm->setRut(trim($rut_p));
                    $adm->setRol('ADMINISTRADOR');
                    $adm->setNombre(trim($nom_p));
                    $adm->setApellido_p(trim($ape_p_p));
                    $adm->setApellido_m(trim($ape_p_m));
                    $adm->setCorreo(trim($mail_p));

                    $claveSegura = password_hash($clave_p, PASSWORD_BCRYPT, ['cost' => 4]);

                    $adm->setClave($claveSegura);

                    $adm_correo = $adm->obtenerAdministradorCorreo();
                    $adm_rut = $adm->obtenerAdministradorRut();

                    $errores_duplicidad = "";
                    if ($adm_correo && $adm_correo->correo == $adm->getCorreo()) {
                        $errores_duplicidad .= "<li>El correo ingresado ya esta en uso por otro usuario.</li>";
                    }

                    if ($adm_rut && $adm_rut->rut == $adm->getRut()) {
                        $errores_duplicidad .= "<li>El rut ingresado ya esta en uso por otro usuario.</li>";
                    }

                    if ($errores_duplicidad == "") {
                        $agregado = $adm->agregarAdministrador();

                        if ($agregado) {
                            $_SESSION['ADMADD']['OK'] = "Administrador registrado correctamente.";
                        } else {
                            $_SESSION['ADMADD']['ERR'] = "Error durante el proceso de guardado de administrador.";
                        }
                    } else {
                        $_SESSION['ADMADD']['ERR'] = $errores_duplicidad;
                    }
                } else {
                    $_SESSION['ADMADD']['ERR'] = implode($errores);
                }
            }
            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/administrador/nuevoAdministrador">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

    } 

    /**
     * function que permite modficar los datos de un administrador
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
            if(isset($_GET['id'])){
                $idadm = $_GET['id'];
                //guardando los datos en variables
                $rut_p = isset($_POST['campo_rut']) ? $_POST['campo_rut'] : '';
                $nom_p = isset($_POST['campo_nombre']) ? $_POST['campo_nombre'] : '';
                $ape_p_p = isset($_POST['campo_ppaterno']) ? $_POST['campo_ppaterno'] : '';
                $ape_p_m = isset($_POST['campo_pmaterno']) ? $_POST['campo_pmaterno'] : '';
                $mail_p = isset($_POST['campo_mail']) ? $_POST['campo_mail'] : '';
                $clave_p = isset($_POST['campo_clave']) ? $_POST['campo_clave'] : '';
                
                //validando datos
                $errores = array();
                if (!empty($rut_p) && strlen($rut_p) <= 10 && Utils::valida_rut($rut_p)) {
                    $rut_valido = true;
                } else {
                    $rut_valido = false;
                    $errores['rut'] = "<li>Rut invalido o esta vacío</li>";
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
                        $nombre_valido = false;
                        $errores['apellido_m'] = "<li>El apellido paterno solo debe tener 60 caracteres o menos</li>";
                    }
                } else {
                    $apellido_m_valido = false;
                    $errores['apellido_m'] = "<li>Apellido materno invalido</li>";
                }

                if (!empty($mail_p) && filter_var($mail_p, FILTER_VALIDATE_EMAIL)) {
                    if(strlen($mail_p) < 60){
                        $email_validado = true;
                    }else{
                        $email_validado = false;
                        $errores['email'] = "<li>El mail solo debe tener 60 caracteres o menos</li>";
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

                if (count($errores) == 0) {
                    $adm = new administrador();
                    $adm->setId($idadm);
                    $adm->setCodigo(rand());
                    $adm->setRut($rut_p);
                    $adm->setRol('ADMINISTRADOR');
                    $adm->setNombre($nom_p);
                    $adm->setApellido_p($ape_p_p);
                    $adm->setApellido_m($ape_p_m);
                    $adm->setCorreo($mail_p);

                    $claveSegura = "";
                    if (strlen($clave_p) < 50) {

                        //cifrar contraseña
                        $claveSegura = password_hash($clave_p, PASSWORD_BCRYPT, ['cost' => 4]);
                        $adm->setClave($claveSegura);
                    }

                    $adm_correo = $adm->obtenerAdministradorCorreo();
                    $adm_rut = $adm->obtenerAdministradorRut();

                    $errores_duplicidad = "";
                    if ($adm_correo && $adm_correo->correo == $adm->getCorreo()) {
                        if($idadm != $adm_correo->idadministrador){
                            $errores_duplicidad .= "<li>El correo ingresado ya esta en uso por otro usuario.</li>";
                        }
                    }

                    if ($adm_rut && $adm_rut->rut == $adm->getRut()) {
                        if($idadm != $adm_rut->idadministrador){
                            $errores_duplicidad .= "<li>El rut ingresado ya esta en uso por otro usuario.</li>";
                        }
                    }

                    if ($errores_duplicidad == "") {
                        $agregado = $adm->modificarAdministrador();

                        if ($agregado) {
                            $_SESSION['MODADM']['OK'] = "Dato de administrador modificados correctamente.";
                        } else {
                            $_SESSION['MODADM']['ERR'] = "Error durante el proceso de modificado de administrador.";
                        }
                    } else {
                        $_SESSION['MODADM']['ERR'] = $errores_duplicidad;
                    }
                } else {
                    $_SESSION['MODADM']['ERR'] = implode($errores);
                }
            }else{
                $_SESSION['MODADM']['ERR'] = "Se esperaba un parametro para realizar esta acción.";
            }
            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/administrador/administradores">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } 
    } 

    /**
     * function que permite eliminar un administrador en particular
     * 
     * Este DocBlock documenta la función modificar() 
     */
    public function eliminar(){
        echo '<div style="margin-top: 350px; margin-bottom: 350px;">
                <center>
                    <div class="spinner-border" style="width: 200px; height: 200px; margin: auto;"></div> 
                </center>
            </div>';
        try {
            if (isset($_GET['id'])) {
                $id = isset($_GET['id']) ? $_GET['id'] : '';

                if (is_numeric($id)) {

                    $adm = new administrador();
                    $adm->setId($id);

                    $eliminado = $adm->eliminarAdministrador();

                    if ($eliminado) {
                        $_SESSION['DELAMD']['OK'] = "Administrador eliminado correctamente.";
                    } else {
                        $_SESSION['DELAMD']['ERR'] = "El administrador estas asociado a otros registros, no puede ser eliminado.";
                    }
                } else {
                    $_SESSION['DELAMD']['ERR'] = "Se esperaba el ingreso de parametro para completar esta acción.";
                }
            } else {
                $_SESSION['DELAMD']['ERR'] = "Se esperaba el ingreso de parametro para completar esta acción.";
            }

            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/administrador/administradores">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
}
