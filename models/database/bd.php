<?php

/**
 * Description of bd
 * Clase que permite establecer la conexión con la base de datos mysql
 *
 * @author Daniel Huenul
 */
class bd {

    public static function conectar() {
        try {
            $conexion = new mysqli("localhost", "root", "", "inmuebles_herrera", "3308");
            $conexion->query("SET NAMES 'utf-8'");
            return $conexion;
        } catch (Exception $exc) {
            echo '<div class="alert alert-danger" role="alert">
                <strong>Se ha perdido la conexión con la base de datos</strong>
            </div>';
        } 
    }

}
