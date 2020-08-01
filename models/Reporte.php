<?php

/**
 * Clase que permite la obtencion de reportes en base a la libreria Html2Pdf.
 *
 * @author Daniel Huenul
 */
//require 'C:\wamp64\www\Inmuebles-Herrera\vendor\autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

class Reporte {

    private $nombre;
    private $ruta;
    private $contenido; 
    
    /**
     * function obtener el nombre del pdf
     *
     * Este DocBlock documenta la función getNombre()
     * @return String $nombre 
     */
    function getNombre() {
        return $this->nombre;
    } 
    
    /**
     * function obtener el ruta del pdf
     *
     * Este DocBlock documenta la función getRuta()
     * @return String $ruta 
     */
    function getRuta() {
        return $this->ruta;
    } 
    
    /**
     * function obtener el contenido del pdf
     *
     * Este DocBlock documenta la función getContenido()
     * @return String $contenido 
     */
    function getContenido() {
        return $this->contenido;
    }

    /**
     * function que permite establecer el nombre del PDF 
     *
     * Este DocBlock documenta la función setNombre()
     * @param String $nombre 
     */
    function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    /**
     * function que permite establecer el nombre del PDF 
     *
     * Este DocBlock documenta la función setNombre()
     * @param String $nombre 
     */ 
    function setRuta($ruta): void {
        $this->ruta = $ruta;
    }

    /**
     * function que permite establecer el contenido del PDF 
     *
     * Este DocBlock documenta la función setContenido()
     * @param String $contenido 
     */ 
    function setContenido($contenido): void {
        $this->contenido = $contenido;
    }

    /**
     * function que permite generar un reporte pdf
     *
     * Este DocBlock documenta la función reportePdf() 
     */
    public function reportePdf() {
        try {
            $pdf = new Html2Pdf();
            $pdf->writeHTML($this->contenido); //C:\Users\Daniel Huenul\Desktop\productos.pdf
            $pdf->output("C:\Users\Daniel Huenul\Desktop\{$this->nombre}.pdf", 'F');
        } catch (Exception $exc) {
            echo '<div class="alert alert-danger" role="alert">
                <strong>Ups... Ha ocurrido un error inesperado</strong>
            </div>';
        }
    }

}
