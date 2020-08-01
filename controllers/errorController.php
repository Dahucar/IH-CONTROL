<?php 

/**
 * Clase que muestras las vistas en caso se quiera acceder avistas no creadas
 *
 * @author Daniel Huenul
 */
class ErrorController {  

    /**
     * function carga la vista en caso se espesifique en la URL una clase controladora que no existe
     * 
     * Este DocBlock documenta la función errorClase() 
     */
    public function errorClase() {
        require_once 'views/interfaz/errorClase.php';
    }

    /**
     * function carga la vista en caso se espesifique en la URL una accion en un controlador que no existe
     * 
     * Este DocBlock documenta la función errorClase() 
     */
    public function errorAccion() {
        require_once 'views/interfaz/errorMetodo.php';
    }
}
