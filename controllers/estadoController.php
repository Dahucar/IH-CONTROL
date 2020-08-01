<?php

require_once 'models/pedido/Estado.php';

/**
 * Clase controladore de estados 
 *
 * @author Daniel Huenul
 */
class EstadoController {

    /**
     * function que carga el listado de estados registrados en la base de datos
     * 
     * Este DocBlock documenta la función inicio() 
     */ 
    public function inicio() {

        $est = new Estado();
        $estados = $est->obtenerEstados();

        require_once 'views/interfaz/modulo/vista_generalestados.php';
    }

    /**
     * function que realiza el guardado de nuevos estados en la base de datos
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

                $estado = isset($_POST['txt-nom']) ? $_POST['txt-nom'] : false;

                //validando la varible
                $errores = array();
                if (!empty($estado) && !is_numeric($estado) && !preg_match("/[0-9]/", $estado)) {
                    if(strlen($estado) < 45){
                        $estado_valido = true;
                    }else{
                        $estado_valido = false;
                        $errores['nombre'] = "<li>El nombre de estado solo debe tener 45 caracteres o menos</li>";
                    }
                } else {
                    $estado_valido = false;
                    $errores['nombre'] = "<li>nombre ingresado invalido</li>";
                }

                if (count($errores) == 0) {

                    $est = new Estado();
                    $est->setCodigo(rand());
                    $est->setEstado($estado);

                    $est_obtenido = $est->obtenerEstado();  
                     
                    if ($est_obtenido->estado != $est->getEstado()) {

                        $resultado = $est->agregarEstado();

                        if ($resultado) {
                            $_SESSION['ESTADO']['SUCCESS'] = "El estado se ha añadido correctamente";
                        } else {
                            $_SESSION['ESTADO']['ERR'] = "Ha ocurrido un error inesperado... Intente nuevamente";
                        }
                    } else {
                        $_SESSION['ESTADO']['ERR'] = "El estado ingresado ya se ha guardado";
                    }
                } else {
                    $_SESSION['ESTADO']['ERR'] = implode($errores);
                }
            }

            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/estado/inicio">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que realiza el eliminado de estados en la base de datos
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

                $id_est = isset($_GET['id']) ? $_GET['id'] : false;

                if (is_numeric($id_est)) {
                    $estado = new Estado();
                    $estado->setId($id_est);
                    $eliminado = $estado->eliminarEstado();


                    if ($eliminado) {
                        $_SESSION['ESTADO']['SUCCESS'] = "Estado eliminado correctamente";
                    } else {
                        $_SESSION['ESTADO']['ERR'] = "Error durante el proceso de eliminado";
                    }
                } else {
                    $_SESSION['ESTADO']['ERR'] = "Error. se esperaba un parametro para esta acción";
                }
            }
            
            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/estado/inicio">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
