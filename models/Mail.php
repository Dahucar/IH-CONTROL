<?php

/**
 * Clase que contiene los parametros y funcionalidades relacionadas 
 * con el envio de email
 *
 * @author Daniel Huenul
 */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//require_once 'C:\wamp64\www\Inmuebles-Herrera-Copia\vendor\autoload.php' ; 

class Mail {
    
    private $correoDestinatario;
    private $asunto;
    private $mensaje;
    private $destinatario; 

    /**
     * function obtener el correo del destinatario del correo
     *
     *
     * Este DocBlock documenta la función getCorreoDestinatario()
     * @return String $correoDestinatario 
     */
    function getCorreoDestinatario() { return $this->correoDestinatario; } 
    
    /**
     * function obtener el asunto del correo que sera enviado
     *
     *
     * Este DocBlock documenta la función getAsunto()
     * @return String $asunto 
     */
    function getAsunto() { return $this->asunto; }

    /**
     * function obtener el mensaje que se enviara en el correo
     *
     *
     * Este DocBlock documenta la función getMensaje()
     * @return String $mensaje 
     */
    function getMensaje() { return $this->mensaje; } 
    
    /**
     * function obtener destinatario del correo que sera enviado
     *
     *
     * Este DocBlock documenta la función getDestinatario()
     * @return String $destinatario 
     */
    function getDestinatario() { return $this->destinatario; } 

    /**
     * function que permite establecer el destinatario del correo
     *
     *
     * Este DocBlock documenta la función setCorreoDestinatario()
     * @param String $correoDestinatario 
     */
    function setCorreoDestinatario($correoDestinatario): void { $this->correoDestinatario = $correoDestinatario; }

    /**
     * function que permite establecer el asunto del correo 
     *
     * Este DocBlock documenta la función setAsunto()
     * @param String $asunto 
     */
    function setAsunto($asunto): void { $this->asunto = $asunto; }

    /**
     * function que permite establecer el mensaje del correo 
     *
     * Este DocBlock documenta la función setMensaje()
     * @param String $mensaje 
     */
    function setMensaje($mensaje): void { $this->mensaje = $mensaje; }

    /**
     * function que permite establecer el mensaje del correo 
     *
     * Este DocBlock documenta la función setMensaje()
     * @param String $destinatario 
     */
    function setDestinatario($destinatario): void { $this->destinatario = $destinatario; } 

    /**
     * function que permite enviar un email en base alos mensajes que 
     *
     * Este DocBlock documenta la función obtenerCantVend()
     * @return $resultado ResultSet
     */
    public function enviarEmail() {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   // Enable SMTP authentication
            $mail->Username = 'herreraInmuebles2020@gmail.com';                     // SMTP username
            $mail->Password = 'inmueblesHerrer@2020';                               // SMTP password
            $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port = 587;
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            //Recipients
            $mail->setFrom('herreraInmuebles2020@gmail.com', 'Muebles Herrera');
            $mail->addAddress($this->getCorreoDestinatario(), $this->getDestinatario());   // Add a recipient
            
            // Content
            $mail->isHTML(true);   
            $mail->CharSet = "UTF-8";                               // Set email format to HTML
            $mail->Subject = $this->getAsunto();
            $mail->Body = "<h1 style='background: red; color: white; text-align: center; border-radius: 10px;
                                padding: 5px 10px;'>
                              {$this->getMensaje()}
                           </h1>";
            
            $mail->send(); 
        } catch (Exception $ex) {
            echo '<div class="alert alert-danger" role="alert">
                <strong>Ups... Ha ocurrido un error durante el envio de una alerta de emergencia</strong>
            </div>';
        }
    }
    
}
