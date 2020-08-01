<?php

/**
 * Clase que permite realizar las operaciones con el modelo de mail
 *
 * @author Daniel Huenul
 */
require 'vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;

class MailController {

    public function generarInforme() { 

        $html2pdf = new Html2Pdf();
        $html2pdf->writeHTML('<h1>HelloWorld</h1>This is my first test');
        $html2pdf->output();
        
    }

}
