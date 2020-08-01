<?php

require_once 'models/pedido/Alerta.php';
require_once 'models/personas/persona.php';
require_once 'models/personas/administrador.php';
require_once 'models/Mail.php';

/**
 * Clase que permite realizar las operaciones con datos de alertas
 *
 * @author Daniel Huenul
 */
class alertaController {
    
    /**
     * function que permite cargar todas las alertas ya creadas en la vista principal del modulo de alertas de 
     * administrador
     * 
     * Este DocBlock documenta la función agregar() 
     */ 
    public function alertas() {

        $alerts = new Alerta();
        $alts = $alerts->obtenerAlertas();

        require_once 'views/interfaz/modulo/vista_alertas.php';
    }
    
    /**
     * function que permite llamar a la funcionalidad que envia el correo al destinatario
     * 
     * Este DocBlock documenta la función agregar() 
     */ 
    public function enviar(){
        $mail = new Mail();
        $mail->enviarEmail();
    }
    
    /**
     * function que permite cargar la vista para la creacion de nuevas vistas
     * 
     * Este DocBlock documenta la función agregar() 
     */ 
    public function nuevaalerta() {

        $adm = new administrador();
        $listado = $adm->obtenerAdministradores();

        require_once 'views/interfaz/modulo/vista_agregaralerta.php';
    }

    /**
     * function que permite modificar los datos de una alerta ya creada, cargando los 
     * los datos de la alerta en la vista para su modificación
     * 
     * Este DocBlock documenta la función agregar() 
     */
    public function modificarAlerta() {

        if (isset($_GET['id'])) {

            $id = $_GET['id'];
            $alert = new Alerta();
            $alert->setId($id);
            $alerta_encontrada = $alert->obtenerAlerta();
            $a = $alerta_encontrada->fetch_object();

            if (!is_object($a)) {
                $_SESSION['ALERTMOD']['ERR'] = "Se ha espesificado la busqueda de una alerta no existente.";
            }
        } else {
            $_SESSION['ALERTMOD']['ERR'] = "Se esperaba un parametro para realizar esta acción.";
        }

        require_once 'views/interfaz/modulo/vista_modificarAlerta.php';
    }

    /**
     * function que permite añadir una nueva alerta a la base de datos
     * 
     * Este DocBlock documenta la función agregar() 
     */
    public function agregar() {
        echo '<div style="margin-top: 350px; margin-bottom: 350px;">
                <center>
                    <div class="spinner-border" style="width: 200px; height: 200px; margin: auto;"></div> 
                </center>
            </div>';
        
        try {
            if (isset($_POST) && isset($_POST['selectAdm'])) {
                //fecha CURRENT_TIMESTAMP
                $date = date_create();

                $asunto = isset($_POST['txt-asunto']) ? $_POST['txt-asunto'] : false;
                $mensaje = isset($_POST['txt-mensaje']) ? $_POST['txt-mensaje'] : false;
                $listadoId = count($_POST['selectAdm']) >= 1 ? $_POST['selectAdm'] : false;

                $errores = array();
                if (!empty($asunto)) {
                    if(strlen($asunto) < 45){
                        $asunto_valido = true;
                    }else{
                        $asunto_valido = false;
                        $errores['asunto'] = "<li>El asunto solo debe tener 45 caracteres o menos</li>";
                    }
                } else {
                    $asunto_valido = false;
                    $errores['asunto'] = "<li>Asunto vacío</li>";
                }

                if (!empty($mensaje)) {
                    if(strlen($mensaje) < 255){
                        $mensaje_valido = true;
                    }else{
                        $mensaje_valido = false;
                        $errores['mensaje'] = "<li>El mensaje solo debe tener 255 caracteres o menos</li>";
                    }
                } else {
                    $mensaje_valido = false;
                    $errores['mensaje'] = "<li>Mensaje vacío</li>";
                }

                $correctos = true;
                if (count($listadoId) >= 1) {
                    foreach ($listadoId as $i) {
                        if(!is_numeric($i)){
                            $correctos = false;
                        }
                    }
                } else {
                    $errores['listadoId'] = "<li>No se han seleccionado administradores</li>";
                }

                if(!$correctos){
                    $errores['tablaAdm'] = "<li>El contenido de la tabla no es el esperado. Actualize.</li>";
                }

                if (count($errores) == 0) {

                    $alert = new Alerta();
                    $alert->setId(0);
                    $alert->setCodigo(rand());
                    $alert->setAsunto($asunto);
                    $alert->setMensaje($mensaje);
                    $alert->setEstado('PENDIENTE');

                    $agregado = $alert->agregar();

                    if ($agregado) { 
                        $alertObtenida = $alert->obtenerAlertaCodigo();
                        $alertObt = $alertObtenida->fetch_object();

                        if(is_object($alertObtenida)){
                            
                            $asignados = $alert->asignarAlertaAdministrador($alertObt->idalertas, $listadoId);
                            if($asignados){
                                $_SESSION['ALERTADD']['OK'] = "Alerta agregada correctamente.";
                            }else{
                                $_SESSION['ALERTADD']['ERR'] = "Error durante el proceso de asignación de alerta a administradores.";
                            }
                        }else{
                            $_SESSION['ALERTADD']['ERR'] = "Error al buscar la alerta ingresada";
                        }

                    } else {
                        $_SESSION['ALERTADD']['ERR'] = "Error durante el proceso de guardado de alerta.";
                    }
                } else {
                    $_SESSION['ALERTADD']['ERR'] = implode($errores);
                }
            }else{
                $_SESSION['ALERTADD']['ERR'] = "No se ingresaron los datos.";
            }
 
            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/alerta/nuevaalerta">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite eliminar una alerta a la base de datos
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
                $id = $_GET['id'];

                $alert = new Alerta();
                $alert->setId($id);
                $resultado = $alert->obtenerAlerta();
                $alertEnt = $resultado->fetch_object();

                if(is_object($alertEnt)){

                    $rest = $alert->eliminarAlertaAdministrador();

                    if($rest){
                        $elimado = $alert->eliminarAlerta();
                        if ($elimado) {
                            $_SESSION['ALERTDEL']['OK'] = "Alerta eliminada correctamente.";
                        } else {
                            $_SESSION['ALERTDEL']['ERR'] = "Error al eliminar el alerta";
                        }
                    }else{
                        $_SESSION['ALERTDEL']['ERR'] = "No se encontro la alerta solicitada";
                    }

                }else{
                    $_SESSION['ALERTDEL']['ERR'] = "No se ha encontrado la alerta espesificada";
                }

            } else {
                $_SESSION['ALERTDEL']['ERR'] = "Se esperaba un parametro para efectuar la acción solicitada.";
            }

            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/alerta/alertas">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite aplicar los cambios que se realizan sobre una alerta
     * 
     * Este DocBlock documenta la función agregar() 
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
                $asunto = isset($_POST['txt-asunto']) ? $_POST['txt-asunto'] : false;
                $mensaje = isset($_POST['txt-mensaje']) ? $_POST['txt-mensaje'] : false;

                $errores = array();
                if (!empty($asunto)) {
                    if(strlen($asunto) < 45){
                        $asunto_valido = true;
                    }else{
                        $asunto_valido = false;
                        $errores['asunto'] = "<li>El asunto solo debe tener 45 caracteres o menos</li>";
                    }
                } else {
                    $asunto_valido = false;
                    $errores['asunto'] = "<li>Asunto vacío</li>";
                }

                if (!empty($mensaje)) {
                    if(strlen($mensaje) < 255){
                        $mensaje_valido = true;
                    }else{
                        $mensaje_valido = false;
                        $errores['mensaje'] = "<li>El mensaje solo debe tener 255 caracteres o menos</li>";
                    }
                } else {
                    $mensaje_valido = false;
                    $errores['mensaje'] = "<li>Mensaje vacío</li>";
                }

                if (count($errores) == 0) {
                    $alert = new Alerta();
                    $alert->setId($id);
                    $alert->setAsunto($asunto);
                    $alert->setMensaje($mensaje);

                    $modificado = $alert->modificarAlerta(); 

                    if ($modificado) {
                        $_SESSION['ALERTUPDATE']['OK'] = "Alerta modificada correctamente.";
                    } else {
                        $_SESSION['ALERTUPDATE']['ERR'] = "Error durante el proceso de modificado de alerta.";
                    }
                }else{
                    $_SESSION['ALERTUPDATE']['ERR'] = implode($errores);
                }
            } else {
                $_SESSION['ALERTUPDATE']['ERR'] = "Se esperaba un parametro para realizar esta acción.";
            }
            
            
            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/alerta/alertas">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
