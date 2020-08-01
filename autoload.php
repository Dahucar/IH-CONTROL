<?php

/*
 * function que carga de forma automatica todos los controladores del proyecto
 */

function autoCargar($nombreClase) { 
    try {
        include 'controllers/' . $nombreClase . '.php'; 
    } catch (Exception $exc) {
        echo '<div class="alert alert-danger" role="alert">
            <strong>Error al cargar el contenido solicitado</strong>
        </div>';
    }
}

spl_autoload_register('autoCargar');
