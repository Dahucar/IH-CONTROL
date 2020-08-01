<?php

require_once 'models/Reporte.php';
require_once 'models/pedido/Producto.php';
require_once 'models/compras/Venta.php';
require_once 'models/personas/persona.php';
require_once 'models/personas/Proveedor.php';
require_once 'models/personas/vendedor.php';

/**
 * Clase que controla las funcionales relacionadas a la obtencion de reportes en formato pdf
 *
 * @author Daniel Huenul
 */
class reporteController {
    

    /**
     * function que generar un reporte PDF de los productos actuales que hay registrados en la base de datos
     *
     * Este DocBlock documenta la función reporteProductos() 
     */
    public function reporteProductos() {
        echo '<div style="margin-top: 350px; margin-bottom: 350px;">
                <center>
                    <div class="spinner-border" style="width: 200px; height: 200px; margin: auto;"></div> 
                </center>
            </div>'; 
        try {
            $nombre = "reporte";
            if (isset($_POST['nom_report'])) {
                $nombre = $_POST['nom_report'];
            }

            $producto = new Producto();
            $pro = $producto->obtenerProductosExtra(false, false, false, false);
            if ($pro->num_rows >= 1) {
                $plantilla = '
      <style>
         *{margin: 0px; padding: 0px; font-size: 10px;}
         h1{ text-align: center; } 
         table { margin: auto; border: none; } 
         table td{ border-bottom: 1px solid #ccc; }
         table td, th{ padding: 3px 5px; } 
         #titulo{ background: #36304a; color: white; font-size: 19px; padding: 4px; }
         .dell{ width: 200px; text-align: justify; }
     </style>
     
     <h1>Productos Inmuebles Herrera</h1>
     <table>
         <tr id="titulo">
             <th>#</th>
             <th>Codigo</th>
             <th>Nombre</th>
             <th>Caracteristicas</th>
             <th>Precio</th>
             <th>Stock</th>
             <th>Estado</th>
             <th>Categoría</th>
         </tr>';

                while ($p = $pro->fetch_object()) {
                    $fila = '
               <tr>
                  <td>' . $p->idproductos . '</td>
                  <td>' . $p->codigo . '</td>
                  <td>' . $p->nombre . '</td>
                  <td class="dell">' . $p->caracteristicas . '</td>
                  <td>' . number_format($p->precio) . '</td>
                  <td>' . $p->cantidad . '</td>
                  <td>' . $p->estado . '</td>
                  <td>' . $p->categoria . '</td>
               </tr>
            ';
                    $plantilla .= $fila;
                }
                $plantilla .= '</table>';
            } else {
                echo "no hay productos";
            }

            $report = new Reporte();
            $report->setNombre($nombre);
            $report->setContenido($plantilla);
            $report->reportePdf();

            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/administrador/reportes">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    /**
     * function que generar un reporte PDF de las ventas actuales que hay registrados en la base de datos
     *
     * Este DocBlock documenta la función reportesVentas() 
     */
    public function reportesVentas() {
        echo '<div style="margin-top: 350px; margin-bottom: 350px;">
                <center>
                    <div class="spinner-border" style="width: 200px; height: 200px; margin: auto;"></div> 
                </center>
            </div>';
        try {
            $nombre = "reporte";
            if (isset($_POST['nom_report'])) {
                $nombre = $_POST['nom_report'];
            }

            $venta = new Venta();
            $vent = $venta->obtenerVentaDetalle();
            if ($vent->num_rows >= 1) {
                $plantilla = '
      <style>
         *{margin: 0px; padding: 0px; font-size: 8px;}
         h1{ text-align: center; } 
         table { margin: auto; border: none; } 
         table td{ border-bottom: 1px solid #ccc; }
         table td, th{ padding: 3px 5px; } 
         #titulo{ background: #36304a; color: white; font-size: 19px; padding: 4px; }
         .dell{ width: 100px; text-align: justify; }
         .delt{ width: 80px; text-align: justify; }
     </style>
     
     <h1>Ventas Inmuebles Herrera</h1>
     <table>
         <tr id="titulo">
            <th>#</th>
            <th class="delt">Fecha</th>
            <th>Detalle</th>
            <th class="delt">Valor</th>
            <th>Rut cliente</th>
            <th>Nombre cliente</th> 
            <th>Rut vendedor</th>
            <th>Nombre vendedor</th> 
         </tr>';

                while ($p = $vent->fetch_object()) {
                    $fila = '
               <tr>
                  <td>' . $p->idventas . '</td>
                  <td>' . $p->fecha . '</td>
                  <td class="dell">' . $p->detalle . '</td>
                  <td>$' . number_format($p->valor) . '</td>
                  <td>' . $p->RUTCLI . '</td>
                  <td>' . $p->NOMCLI . ' ' . $p->APEPCLI . '  ' . $p->APEMCLI . '</td> 
                  <td>' . $p->RUTVEND . '</td>
                  <td>' . $p->NOMVEND . ' ' . $p->APEPVEND . '  ' . $p->APEMVEND . '</td>  
               </tr> 
            ';
                    $plantilla .= $fila;
                }
                $plantilla .= '</table>';
            } else {
                echo "no hay productos";
            }

            $report = new Reporte();
            $report->setNombre($nombre);
            $report->setContenido($plantilla);
            $report->reportePdf();

            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/administrador/reportes">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    /**
     * function que generar un reporte PDF de los proveedores actuales que hay registrados en la base de datos
     *
     * Este DocBlock documenta la función reportesProveedores() 
     */
    public function reportesProveedores() {
        echo '<div style="margin-top: 350px; margin-bottom: 350px;">
                <center>
                    <div class="spinner-border" style="width: 200px; height: 200px; margin: auto;"></div> 
                </center>
            </div>';
        try {
            $nombre = "reporte";
            if (isset($_POST['nom_report']) && $_POST['nom_report'] != "") {
                $nombre = $_POST['nom_report'];
            }

            $proveedor = new Proveedor();
            $prov = $proveedor->obtenerProveedors();
            if ($prov->num_rows >= 1) {
                $plantilla = '
      <style>
         *{margin: 0px; padding: 0px; font-size: 10px;}
         h1{ text-align: center; } 
         table { margin: auto; border: none; } 
         table td{ border-bottom: 1px solid #ccc; }
         table td, th{ padding: 3px 5px; } 
         #titulo{ background: #36304a; color: white; font-size: 19px; padding: 4px; }
         .dell{ width: 200px; text-align: justify; }
     </style>
     
     <h1>Vendedores Inmuebles Herrera</h1>
     <table>
         <tr id="titulo">
            <th>#</th> 
            <th>Rut</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Nombre compañia</th> 
            <th>Dirección</th>
            <th>Correo</th>
         </tr>';

                while ($p = $prov->fetch_object()) {
                    $fila = '
               <tr>
                  <td>' . $p->idproveedores . '</td>
                  <td>' . $p->rut . '</td>
                  <td>' . $p->nombre . '</td>
                  <td>' . $p->apellido_p . ' ' . $p->apellido_m . '</td> 
                  <td>' . $p->nombreCompañia . '</td>
                  <td>' . $p->direccion . '</td>
                  <td>' . $p->correo . '</td>
               </tr>
            ';
                    $plantilla .= $fila;
                }
                $plantilla .= '</table>';
            } else {
                echo "no hay productos";
            }

            $report = new Reporte();
            $report->setNombre($nombre);
            $report->setContenido($plantilla);
            $report->reportePdf();

            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/administrador/reportes">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    /**
     * function que generar un reporte PDF de los vendedores actuales que hay registrados en la base de datos
     *
     * Este DocBlock documenta la función reportesVendedores() 
     */
    public function reportesVendedores() {
        echo '<div style="margin-top: 350px; margin-bottom: 350px;">
                <center>
                    <div class="spinner-border" style="width: 200px; height: 200px; margin: auto;"></div> 
                </center>
            </div>';
        try {
            $nombre = "reporte";
            if (isset($_POST['nom_report']) && $_POST['nom_report'] != "") {
                $nombre = $_POST['nom_report'];
            }

            $vendedor = new Vendedor();
            $vend = $vendedor->obtenerVendedores();
            if ($vend->num_rows >= 1) {
                $plantilla = '
      <style>
         *{margin: 0px; padding: 0px; font-size: 10px;}
         h1{ text-align: center; } 
         table { margin: auto; border: none; } 
         table td{ border-bottom: 1px solid #ccc; }
         table td, th{ padding: 3px 5px; } 
         #titulo{ background: #36304a; color: white; font-size: 19px; padding: 4px; }
         .dell{ width: 200px; text-align: justify; }
     </style>
     
     <h1>Vendedores Inmuebles Herrera</h1>
     <table>
         <tr id="titulo">
            <th>#</th> 
            <th>Rut</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Correo</th>
         </tr>';

                while ($p = $vend->fetch_object()) {
                    $fila = '
               <tr>
                  <td>' . $p->idvendedores . '</td>
                  <td>' . $p->rut . '</td>
                  <td>' . $p->nombre . '</td>
                  <td>' . $p->apellido_p . ' ' . $p->apellido_m . '</td> 
                  <td>' . $p->correo . '</td>
               </tr>
            ';
                    $plantilla .= $fila;
                }
                $plantilla .= '</table>';
            } else {
                echo "no hay productos";
            }

            $report = new Reporte();
            $report->setNombre($nombre);
            $report->setContenido($plantilla);
            $report->reportePdf();

            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/administrador/reportes">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
