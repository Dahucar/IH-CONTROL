<?php

require_once 'models/personas/Turno.php';
require_once 'models/personas/persona.php';
require_once 'models/personas/vendedor.php';

/**
 * Clase controladora de turnos con todos los metodos y atributos para efectuar la gestion de turnos
 *
 * @author Daniel Huenul
 */
class TurnoController {

    /**
     * function que carga la vista de los turnos ya creados
     * 
     * Este DocBlock documenta la función inicio() 
     */
    public function inicio() {

        $tur = new Turno();
        $lista = $tur->obtenerTurnos();

        require_once 'views/interfaz/modulo/vista_turnos.php';
    }

    /**
     * function que permite lleva a la vista de creacion de nuevos turnos 
     * 
     * Este DocBlock documenta la función nuevoTurno() 
     */
    public function nuevoTurno() {
        require_once 'views/interfaz/modulo/vista_nuevoTurno.php';
    }

    /**
     * function que permite lleva a la vista de modificado de turnos 
     * 
     * Este DocBlock documenta la función modificar() 
     */
    public function modificar() { 
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            if (is_numeric($id)) {

                $tur = new Turno();
                $tur->setId($id);
                $turno = $tur->obtenerTurno();

                $t = $turno->fetch_object();

//                $rest = substr("abcdef", 2, -1);  // devuelve "cde"
                $fechaINI = substr($t->fecha_inicio, 0, -9); //obtiene le fecha tal cual ej 2020-06-12 
                $horaINI = substr($t->fecha_inicio, 11, -3); //hora tal cual ej 07:30 s

                $fechaTER = substr($t->fecha_termino, 0, -9);
                $horaTER = substr($t->fecha_termino, 11, -3);

                if (!is_object($t)) {
                    $_SESSION['TURMOD']['ERR'] = "No se ha encontrado el turno solicitado";
                }
            } else {
                $_SESSION['TURMOD']['ERR'] = "El tipo de parametro enviado no corresponde al esperado..";
            }
        } else {
            $_SESSION['TURMOD']['ERR'] = "Se esperaba un parametro para realizar esta acción.";
        }

        require_once 'views/interfaz/modulo/vista_modificarTurno.php';
    }

    /**
     * function que permite asignar turno ya creados a vendedores ya registrados en el sistema
     * 
     * Este DocBlock documenta la función asignarturno() 
     */
    public function asignarturno() { 
        if (isset($_GET['id'])) {

            $id = $_GET['id'];
            $tur = new Turno();
            $lista = $tur->obtenerTurnos();

            $vent = new Vendedor();
            $vent->setId($id);
            $vendedor_encontrado = $vent->obtenerVendedor();
            $v = $vendedor_encontrado->fetch_object();

            $listadoTurnos = $tur->obtenerTurosVendedor($v->idvendedores);

            if (!is_object($v)) {
                $_SESSION['ASIGTURNO']['ERR'] = "Se ha espesificado la busqueda de un vendedor no existente";
            }
        } else {
            $_SESSION['ASIGTURNO']['ERR'] = "Se esperaba un parametro para realizar esta acción";
        }

        require_once 'views/interfaz/modulo/vista_asignarturno.php';
    }

    /**
     * function que permite guardar un turno en la base de datos
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
            if (isset($_POST)) {

                $nombre = isset($_POST['txt-nom']) ? $_POST['txt-nom'] : "";
                $fecha_ini = isset($_POST['txt-fecha-ini']) ? $_POST['txt-fecha-ini'] : "";
                $fecha_ter = isset($_POST['txt-fecha-ter']) ? $_POST['txt-fecha-ter'] : "";
                $hora_ini = isset($_POST['time-ini']) ? $_POST['time-ini'] : "";
                $hora_ter = isset($_POST['time-ter']) ? $_POST['time-ter'] : "";
                $estado = isset($_POST['customCheck1']) ? $_POST['customCheck1'] : "";

                $errores = array();
                if (!empty($nombre)) {
                    if(strlen($nombre) < 65){
                        $nombre_valido = true;
                    }else{
                        $nombre_valido = true;
                        $errores['nombre'] = "<li>El nombre de turno solo debe tener 65 caracteres o menos</li>";
                    }
                } else { 
                    $nombre_valido = false;
                    $errores['nombre'] = "<li>Nombre invalida</li>";
                }

                if (!empty($fecha_ini)) { 
                    if(Utils::validarFecha($fecha_ini)){
                        $fecha_ini_valido = true;
                    }else{
                        $fecha_ini_valido = false;
                        $errores['fecha_ini'] = "<li>La fecha de inicio ingresada no tiene el formato correcto.</li>";
                    } 
                } else {
                    $fecha_ini_valido = false;
                    $errores['fecha_ini'] = "<li>Fecha inicio invalida</li>";
                }

                if (!empty($fecha_ter)) {
                    if(Utils::validarFecha($fecha_ter)){
                        $fecha_ter_valido = true;
                    }else{
                        $fecha_ter_valido = false;
                        $errores['fecha_ter'] = "<li>La fecha de termino ingresada no tiene el formato correcto.</li>";
                    } 
                } else {
                    $fecha_ter_valido = false;
                    $errores['fecha_ter'] = "<li>Fecha termino invalida</li>";
                }

                if (!empty($hora_ini)) { 
                    if(Utils::validarHora($hora_ini)){
                        $hora_ini_valido = true;
                    }else{
                        $hora_ini_valido = false;
                        $errores['hora-ini'] = "<li>La hora de inicio ingresada no es valida</li>";
                    } 
                } else {
                    $hora_ini_valido = false;
                    $errores['hora-ini'] = "<li>Hora de inicio ingresada esta vacía</li>";
                }

                if (!empty($hora_ter)) {
                    if(Utils::validarHora($hora_ter)){
                        $hora_ter_valido = true;
                    }else{
                        $hora_ter_valido = false;
                        $errores['hora-ter'] = "<li>La hora de termino ingresada no es valida</li>";
                    } 
                } else {
                    $hora_ter_valido = false;
                    $errores['hora-ter'] = "<li>Hora de termino ingresada esta vacía</li>";
                }  
                
                if (count($errores) == 0) {

                    if ($fecha_ini < $fecha_ter) {

                        $fecha_ini .= " " . $hora_ini . ":00";
                        $fecha_ter .= " " . $hora_ter . ":00";

                        $tur = new Turno();
                        $tur->setId(0);
                        $tur->setCodigo(rand());
                        $tur->setNombre($nombre);
                        $tur->setFechaInicio($fecha_ini);
                        $tur->setFechaTermino($fecha_ter);

                        if ($estado == "on") {
                            $tur->setEstado("ACTIVO");
                        } else {
                            $tur->setEstado("INACTIVO");
                        }

                        $guardado = $tur->agregarTurno();

                        if ($guardado) {
                            $_SESSION['TURNOADD']['OK'] = "Turno agregado correctamente.";
                        } else {
                            $_SESSION['TURNOADD']['ERR'] = "Error durante el proceso de agregado de turno.";
                        }
                    } else {
                        $_SESSION['TURNOADD']['ERR'] = "La fecha de termino de turno no debe estar días antes que la fecha de inicio";
                    }
                } else {
                    $_SESSION['TURNOADD']['ERR'] = implode($errores);
                }
            }

            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/turno/nuevoTurno">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite eliminar un turno en la base de datos
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
                $tur = new Turno();
                $tur->setId($id);
                $turEliminado = $tur->eliminarTurnosVendedor();

                if($turEliminado){
                    $eliminado = $tur->eliminarTurno();
                    if ($eliminado) {
                        $_SESSION['TURNODEL']['OK'] = "Turno eliminado correctamente";
                    } else {
                        $_SESSION['TURNODEL']['ERR'] = "Error durante el proceso de eliminado de turno.";
                    }
                }else{
                    $_SESSION['TURNODEL']['ERR'] = "Error durante el proceso de eliminado de vendedores de turno.";
                }

                
            } else {
                $_SESSION['TURNODEL']['ERR'] = "Se esperaba un parametro para realizar esta acción.";
            }

            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/turno/inicio">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite eliminar un turno en la base de datos
     * 
     * Este DocBlock documenta la función eliminar() 
     */
    public function asignarTunno() {
        echo '<div style="margin-top: 350px; margin-bottom: 350px;">
                <center>
                    <div class="spinner-border" style="width: 200px; height: 200px; margin: auto;"></div> 
                </center>
            </div>';
        try {

            if (isset($_GET['idv']) && isset($_POST['select_turno'])) {

                $id_v = $_GET['idv'];
                $id_t = $_POST['select_turno'];

                $tur = new Turno();
                $asignado = $tur->asignarVendedorTurno($id_v, $id_t);

                if ($asignado) {
                    $_SESSION['ASIGTV']['OK'] = "Se ha asignado correctamente el vendedor al turno.";
                } else {
                    $_SESSION['ASIGTV']['ERR'] = "Error durante el proceso de asignación de turno.";
                }
            } else {
                $_SESSION['ASIGTV']['ERR'] = "Se esperaban parametros para realizar esta acción.";
            }

            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/vendedor/vendedores">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    /**
     * function permite modificar un turno que creado en la base de datos
     * 
     * Este DocBlock documenta la función modificarTurno() 
     */
    public function modificarTurno() {
        echo '<div style="margin-top: 350px; margin-bottom: 350px;">
                <center>
                    <div class="spinner-border" style="width: 200px; height: 200px; margin: auto;"></div> 
                </center>
            </div>';
        try {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                if (is_numeric($id)) {

                    if (isset($_POST)) {
                        $nombre = isset($_POST['txt-nom']) ? $_POST['txt-nom'] : "";
                        $fecha_ini = isset($_POST['txt-fecha-ini']) ? $_POST['txt-fecha-ini'] : "";
                        $fecha_ter = isset($_POST['txt-fecha-ter']) ? $_POST['txt-fecha-ter'] : "";
                        $hora_ini = isset($_POST['time-ini']) ? $_POST['time-ini'] : "";
                        $hora_ter = isset($_POST['time-ter']) ? $_POST['time-ter'] : "";
                        $estado = isset($_POST['customCheck1']) ? $_POST['customCheck1'] : "";

                        $errores = array();
                        if (!empty($nombre)) {
                            if(strlen($nombre) < 65){
                                $nombre_valido = true;
                            }else{
                                $nombre_valido = true;
                                $errores['nombre'] = "<li>El nombre de turno solo debe tener 65 caracteres o menos</li>";
                            }
                        } else { 
                            $nombre_valido = false;
                            $errores['nombre'] = "<li>Nombre invalida</li>";
                        }
        
                        if (!empty($fecha_ini)) { 
                            if(Utils::validarFecha($fecha_ini)){
                                $fecha_ini_valido = true;
                            }else{
                                $fecha_ini_valido = false;
                                $errores['fecha_ini'] = "<li>La fecha de inicio ingresada no tiene el formato correcto.</li>";
                            } 
                        } else {
                            $fecha_ini_valido = false;
                            $errores['fecha_ini'] = "<li>Fecha inicio invalida</li>";
                        }
        
                        if (!empty($fecha_ter)) {
                            if(Utils::validarFecha($fecha_ter)){
                                $fecha_ter_valido = true;
                            }else{
                                $fecha_ter_valido = false;
                                $errores['fecha_ter'] = "<li>La fecha de termino ingresada no tiene el formato correcto.</li>";
                            } 
                        } else {
                            $fecha_ter_valido = false;
                            $errores['fecha_ter'] = "<li>Fecha termino invalida</li>";
                        }
        
                        if (!empty($hora_ini)) { 
                            if(Utils::validarHora($hora_ini)){
                                $hora_ini_valido = true;
                            }else{
                                $hora_ini_valido = false;
                                $errores['hora-ini'] = "<li>La hora de inicio ingresada no es valida</li>";
                            } 
                        } else {
                            $hora_ini_valido = false;
                            $errores['hora-ini'] = "<li>Hora de inicio ingresada esta vacía</li>";
                        }
        
                        if (!empty($hora_ter)) {
                            if(Utils::validarHora($hora_ter)){
                                $hora_ter_valido = true;
                            }else{
                                $hora_ter_valido = false;
                                $errores['hora-ter'] = "<li>La hora de termino ingresada no es valida</li>";
                            } 
                        } else {
                            $hora_ter_valido = false;
                            $errores['hora-ter'] = "<li>Hora de termino ingresada esta vacía</li>";
                        }  

                        if (count($errores) == 0) {

                            if ($fecha_ini < $fecha_ter) {

                                $fecha_ini .= " " . $hora_ini . ":00";
                                $fecha_ter .= " " . $hora_ter . ":00";

                                $tur = new Turno();
                                $tur->setId($id); 
                                $tur->setNombre($nombre);
                                $tur->setFechaInicio($fecha_ini);
                                $tur->setFechaTermino($fecha_ter);

                                if ($estado == "on") {
                                    $tur->setEstado("ACTIVO");
                                } else {
                                    $tur->setEstado("INACTIVO");
                                }

                                $mod = $tur->modificarTurno();

                                if ($mod) {
                                    $_SESSION['MODTURNO']['OK'] = "Turno modificado correctamente.";
                                } else {
                                    $_SESSION['MODTURNO']['ERR'] = "Error durante el proceso de modificado de turno.";
                                }
                            } else {
                                $_SESSION['MODTURNO']['ERR'] = "La fecha de termino de turno no debe estar días antes que la fecha de inicio";
                            }
                        } else {
                            $_SESSION['MODTURNO']['ERR'] = implode($errores);
                        }
                    }
                } else {
                    $_SESSION['MODTURNO']['ERR'] = "El tipo de parametro enviado no es el esperado.";
                }
            } else {
                $_SESSION['MODTURNO']['ERR'] = "Se esperaba un parametro para realizar la acción.";
            }
            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/turno/inicio">';
        } catch (Exception $ex) {
            echo $exc->getTraceAsString();
        }
    }

}
