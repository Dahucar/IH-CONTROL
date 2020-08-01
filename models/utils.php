<?php

/**
 * Clase que provee todos los metodos de uso generar para las clases del proyecto
 *
 * @author Daniel Huenul
 */
class Utils {

    /**
     * function que permite eliminar las sesiones de error que se crean
     * para mostrar los mensajes de error
     * 
     * Este DocBlock documenta la función borrarSession() 
     */
    public static function borrarSession() {
        if (isset($_SESSION['registro'])) {
            $_SESSION['registro'] = null;
            unset($_SESSION['registro']);
        }

        if (isset($_SESSION['err-form'])) {
            $_SESSION['err-form'] = null;
            unset($_SESSION['err-form']);
        }

        if (isset($_SESSION['ERR-LOGIN'])) {
            $_SESSION['ERR-LOGIN'] = null;
            unset($_SESSION['ERR-LOGIN']);
        }

        /* Sesiones de categorias */
        if (isset($_SESSION['ADD-CATEGORIA']['OK'])) {
            $_SESSION['ADD-CATEGORIA']['OK'] = null;
            unset($_SESSION['ADD-CATEGORIA']['OK']);
        }

        if (isset($_SESSION['ADD-CATEGORIA']['ERR'])) {
            $_SESSION['ADD-CATEGORIA']['ERR'] = null;
            unset($_SESSION['ADD-CATEGORIA']['ERR']);
        }

        if (isset($_SESSION['REMOVE-CATEG']['ERR-DELETE'])) {
            $_SESSION['REMOVE-CATEG']['ERR-DELETE'] = null;
            unset($_SESSION['REMOVE-CATEG']['ERR-DELETE']);
        }

        if (isset($_SESSION['REMOVE-CATEG']['CAT-DELETE'])) {
            $_SESSION['REMOVE-CATEG']['CAT-DELETE'] = null;
            unset($_SESSION['REMOVE-CATEG']['CAT-DELETE']);
        }
        /* fin Sesiones de categorias */

        /* Sesiones de estado */

        if (isset($_SESSION['ESTADO']['SUCCESS'])) {
            $_SESSION['ESTADO']['SUCCESS'] = null;
            unset($_SESSION['ESTADO']['SUCCESS']);
        }

        if (isset($_SESSION['ESTADO']['ERR'])) {
            $_SESSION['ESTADO']['ERR'] = null;
            unset($_SESSION['ESTADO']['ERR']);
        }

        /* Fin sesiones de estado */


        if (isset($_SESSION['ADD']['OK'])) {
            $_SESSION['ADD']['OK'] = null;
            unset($_SESSION['ADD']['OK']);
        }

        if (isset($_SESSION['ADD']['ERR'])) {
            $_SESSION['ADD']['ERR'] = null;
            unset($_SESSION['ADD']['ERR']);
        }
    }

    /**
     * function que permite eliminar las sesiones de error que se crean
     * para mostrar los mensajes de error de los productos
     * 
     * Este DocBlock documenta la función borrarSessionProductos() 
     */
    public static function borrarSessionProductos() {
        if (isset($_SESSION['DEL']['OK'])) {
            $_SESSION['DEL']['OK'] = null;
            unset($_SESSION['DEL']['OK']);
        }

        if (isset($_SESSION['DEL']['ERR'])) {
            $_SESSION['DEL']['ERR'] = null;
            unset($_SESSION['DEL']['ERR']);
        }
    } 

    /**
     * function que permite elimina una $_SESSION en espesifico mediante el nombre de su indice
     * 
     * Este DocBlock documenta la función borrarSessionProductos()
     * @param String $nombre elimina un $_SESSION por el indicie de esta 
     * @param String $indice Indice de la sesion que se quiere eliminar
     */
    public static function borrarSessionNombre($nombre, $indice) {
        if (isset($_SESSION[$nombre][$indice])) {
            $_SESSION[$nombre][$indice] = null;
            unset($_SESSION[$nombre][$indice]);
        } 
    }

    /**
     * Comprueba si el rut ingresado es valido
     *
     * @param String $rut rut a validar
     * @return Bolean $est true o false;
     */
    public static function valida_rut($rut) {
        $rut = preg_replace('/[^k0-9]/i', '', $rut);
        $dv = substr($rut, -1);
        $numero = substr($rut, 0, strlen($rut) - 1);
        $i = 2;
        $suma = 0;
        foreach (array_reverse(str_split($numero)) as $v) {
            if ($i == 8)
                $i = 2;

            $suma += $v * $i;
            ++$i;
        }

        $dvr = 11 - ($suma % 11);

        if ($dvr == 11)
            $dvr = 0;
        if ($dvr == 10)
            $dvr = 'K';

        if ($dvr == strtoupper($dv))
            return true;
        else
            return false;
    } 
    

    /**
     * Actualiza los valores de de la cesta de vendedor
     * 
     * @return $estadisticas array
     */
    public static function estadisticasCesta() {
        $estadisticas = array(
            'cont' => 0,
            'total' => 0
        );
        
        if(isset($_SESSION['CESTA-VENDEDOR'])){
            $estadisticas['cont'] = count($_SESSION['CESTA-VENDEDOR']);
            
            foreach ($_SESSION['CESTA-VENDEDOR'] as $i => $contenido){
                $estadisticas['total'] += $contenido['precio'] * $contenido['unidades'];
            }
            
        }
        
        return $estadisticas;
    } 

    /**
     * Actualiza los valores del carro de cliente
     * 
     * @return $estadisticas array
     */
    public static function estadisticasCarro() {
        $estadisticas = array(
            'cont' => 0,
            'total' => 0
        );
        
        if(isset($_SESSION['CARROCOMPRA'])){
            $estadisticas['cont'] = count($_SESSION['CARROCOMPRA']);
            
            foreach ($_SESSION['CARROCOMPRA'] as $i => $contenido){
                $estadisticas['total'] += $contenido['precio'] * $contenido['unidades'];
            }
            
        }
        
        return $estadisticas;
    }

    /**
     * function que verifica que una fecha sea valida
     * 
     * @param String $fecha Fecha que sera validada
     * @return Bolean $est True o False
     */
    public static function validarFecha($fecha){
        $est = false;
        $valores = explode('-', $fecha);

        if(count($valores) == 3){ 
            $anno = $valores[0];
            $mes = $valores[1];
            $dia = $valores[2]; 
            if(checkdate($mes, $dia, $anno)){ 
                $est = true;
            }else{
                $est = false;
            }
        }else{
            $est = false;
        } 
        return $est;
    }

    /**
     * function que verifica que una hora sea correcta
     * 
     * @param String $hora Hora que sera validada
     * @return Bolean $est True o False
     */
    public static function validarHora($hora){
        $est = false;
        $hora_validar = explode(':', $hora); 
        
        if(count($hora_validar) == 2){
            $hora_firt = $hora_validar[0]; 
            $hora_two = $hora_validar[1]; 
            if(is_numeric($hora_firt) && is_numeric($hora_two)){
                $est = true;
            }
        }

        return $est;
    }

}
?>

