<?php

require_once 'models/pedido/Producto.php';
require_once 'models/pedido/Categoria.php';
require_once 'models/pedido/Estado.php';
require 'C:\wamp64\www\Inmuebles-Herrera-Copia\vendor\autoload.php' ; 

/**
 * Clase que permite realizar todas las operaciones con el modelo de productos
 *
 * @author Daniel Huenul
 */
class ProductoController {
 
    /**
     * function que permite llevar a la vista principal de todos los productos que se han añadido a la base de datos
     *
     *
     * Este DocBlock documenta la función home() 
     */
    public function home() { 
        $producto = new Producto();
        $listado = $producto->obtenerProductos();

        //todal de elementos que trae la consulta
        $cantidadElementos = $listado->num_rows; 
        $cantidadXpagina = 8;
        //se hace la paginacion
        $pagination = new Zebra_Pagination();
        //tatal de elemtos que seran paginados
        $pagination->records($cantidadElementos);
        //numero de elemetos que se mostrarran en cada pagina
        $pagination->records_per_page($cantidadXpagina);
        //pagina actual 
        $paginaActual = $pagination->get_page(); 
        $comienzo = (($paginaActual - 1) * $cantidadXpagina);
        $listadoFinal = $producto->obtenerProductosRand($comienzo, $cantidadXpagina);
        
        require_once 'views/interfaz/productos_principal.php';
    }

    /**
     * function que permite llevar a la vista del detalle de producto donde se muestran los detalles del mismo
     * para realizar las compra o añadido a la cesta o carro
     *
     *
     * Este DocBlock documenta la función verproducto() 
     */
    public function verproducto() {
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            
            $producto = new Producto();
            $producto->setId($id);
            $obtenido = $producto->obtenerProducto();
            $p = $obtenido->fetch_object();
            
             
            if(!is_object($p)){
                $_SESSION['VERPRODUCTO']['ERR'] = "No se ha encontrado el producto deseado.";
            }
            
        }else{
            $_SESSION['VERPRODUCTO']['ERR'] = "Se esperaba un paramatro para realizar esta acción.";
        }
        
        require_once 'views/pedido/vista_verproducto.php';
    }

    /**
     * function que permite llevar a la vista del listado de todos los productos en la base de datos
     *
     *
     * Este DocBlock documenta la función productos() 
     */
    public function productos() {

        $producto = new Producto();
        $pro = $producto->obtenerProductos(); 
        require_once 'views/interfaz/modulo/vista_productos.php';
    }

    /**
     * function que permite llevar a la vista de agregar productos cargando los 
     * el listado de categorias y estado disponibles en la base de datos
     *
     *
     * Este DocBlock documenta la función nuevoproducto() 
     */
    public function nuevoproducto() {

        $categoria = new Categoria();
        $cats = $categoria->obtenerCategorias();

        $estado = new Estado();
        $ests = $estado->obtenerEstados();

        require_once 'views/interfaz/modulo/vista_nuevoproducto.php';
    }

    /**
     * function que permite llevar a la vista de modificar productos cargando los 
     * datos de un producto en particulos
     *
     *
     * Este DocBlock documenta la función modificar() 
     */
    public function modificar() { 
        if (isset($_GET['id'])) {
            $id_p = $_GET['id'];

            //obteniendo todas las categorias
            $categoria = new Categoria();
            $cats = $categoria->obtenerCategorias(); 

            //obteniendo todos los estados
            $estado = new Estado();
            $ests = $estado->obtenerEstados();

            //obteniendo el producto
            $pro = new Producto();
            $pro->setId($id_p);
            $producto_encontrado = $pro->obtenerProducto();
            $p = $producto_encontrado->fetch_object(); 

            //imagenPrincipal  

            if (!is_object($p)) {
                $_SESSION['MODIFICAR']['ERR'] = "Se ha espesificado la busqueda de un producto no existente.";
            }
        } else {
            $_SESSION['MODIFICAR']['ERR'] = "Se esperaba un parametro para efectuar esta operación.";
        }

        require_once 'views/interfaz/modulo/vista_modificarProducto.php';
    }

    /**
     * function que permite guardar una nuevo producto en la base de datos
     *
     *
     * Este DocBlock documenta la función agregar() 
     */
    public function agregar() {  
        echo '<div style="margin-top: 350px; margin-bottom: 350px;">
        <center>
            <div class="spinner-border" style="width: 200px; height: 200px; margin: auto;"></div> 
        </center>
    </div>';
        try {
            
            if (isset($_POST)) {

                //guardando los datos en variables
                $nom_p = isset($_POST['txt-nom']) ? $_POST['txt-nom'] : '';
                $caract_p = isset($_POST['txt-caracte']) ? $_POST['txt-caracte'] : '';
                $prec_p = isset($_POST['txt-prec']) ? $_POST['txt-prec'] : '';
                $cant_p = isset($_POST['txt-cant']) ? $_POST['txt-cant'] : '';
                $cantMin_p = isset($_POST['txt-cantMin']) ? $_POST['txt-cantMin'] : '';
                $cantMax_p = isset($_POST['txt-cantMax']) ? $_POST['txt-cantMax'] : '';
                $img_p = isset($_POST['img-pro']) ? $_POST['img-pro'] : '';
                $categ_p = isset($_POST['select-categ']) ? $_POST['select-categ'] : '';
                $est_p = isset($_POST['select-est']) ? $_POST['select-est'] : '';

                $errores = array();
                //validando la varible
                if (!empty($nom_p) && !is_numeric($nom_p) && !preg_match("/[0-9]/", $nom_p)) {
                    if(strlen($nom_p) < 60){
                        $nom_valido = true;
                    } else {
                        $nom_valido = false;
                        $errores['nombre'] = "<li>El nombre de su producto no debe superar los 60 caracteres</li>";
                    }
                } else {
                    $nom_valido = false;
                    $errores['nombre'] = "<li>Nombre invalido o esta vacío</li>";
                }

                if (!empty($caract_p)) {
                    if(strlen($caract_p) < 255){
                        $caract_valido = true;
                    } else {
                        $caract_valido = false;
                        $errores['caract'] = "<li>La caracteristica de su producto no puede superar los 255 caracteres</li>";
                    }
                } else {
                    $caract_valido = false;
                    $errores['caract'] = "<li>Caracteristica ingresada vacía</li>";
                }

                if (!empty($prec_p) && is_numeric($prec_p) && $prec_p > 0) {
                    if(strlen($prec_p) < 12){
                        $prec_valido = true;
                    } else {
                        $prec_valido = false;
                        $errores['precio'] = "<li>El precio de su producto no puede superar los 12 caracteres</li>";
                    }
                } else {
                    $prec_valido = false;
                    $errores['precio'] = "<li>Precio ingresado invalido</li>";
                }

                if (!empty($cant_p) && is_numeric($cant_p) && strlen($cant_p) < 11 && $cant_p > 0) {
                    $cant_p_valido = true;
                } else {
                    $cant_p_valido = false;
                    $errores['cantidad'] = "<li>Cantidad ingresada invalida</li>";
                }

                if (!empty($cantMin_p) && strlen($cantMin_p) < 11 && is_numeric($cantMin_p) && $cantMin_p > 0) {
                    $cantMin_p_valido = true;
                } else {
                    $cantMin_p_valido = false;
                    $errores['cantidadMin'] = "<li>Cantidad minima ingresada invalida</li>";
                }

                if (!empty($cantMax_p) && strlen($cantMax_p) < 11  && is_numeric($cantMax_p) && $cantMax_p > 0) {
                    $cantMax_p_valido = true;
                } else {
                    $cantMax_p_valido = false;
                    $errores['cantidadMax'] = "<li>Cantidad máxima ingresada invalida</li>";
                }

                if($cantMax_p_valido && $cantMin_p_valido){ 
                    if($cantMin_p >= $cantMax_p){
                        $errores['errCanridades'] = "<li>La cantidad minima no puede superara la cantidad máxima</li>";
                    }  
                }else{ 
                    $errores['cantidades'] = "<li>Las cantidades ingresadas son invalidas</li>";
                } 

                if (!empty($categ_p) && $categ_p != "Seleccione") {
                    $categ_p_valido = true;
                } else {
                    $categ_p_valido = false;
                    $errores['categ'] = "<li>Debe seleccionar una categoría</li>";
                }

                if (!empty($est_p) && $est_p != "Seleccione") {
                    $est_p_valido = true;
                } else {
                    $est_p_valido = false;
                    $errores['estado'] = "<li>Debe seleccionar un estado</li>";
                }

                //validar y guardar imagen
                $archivo = $_FILES['img-pro'];
                $nombreArchivo = $archivo['name'];
                $tipoArchivo = $archivo['type'];

                //verificar el tipo de archivo que es la imagen
                if ($tipoArchivo == "image/jpg" || $tipoArchivo == "image/jpeg" || $tipoArchivo == "image/png") {

                    if (!is_dir('uploads/images')) {
                        mkdir('uploads/images', 0777, true);
                    }

                    move_uploaded_file($archivo['tmp_name'], 'uploads/images/' . $nombreArchivo);
                } else {
                    $errores['img'] = "<li>Tipo de archivo no admitido o no seleccionado</li>";
                } 
                if (count($errores) == 0) {

                    $produc = new Producto();
                    $produc->setId(0);
                    $produc->setCodigo(rand());
                    $produc->setNombre($nom_p);
                    $produc->setDetalle(trim($caract_p));
                    $produc->setPrecio($prec_p);
                    $produc->setStock($cant_p);
                    $produc->setCantMin($cantMin_p);
                    $produc->setCantMax($cantMax_p);
                    $produc->setCategoria($categ_p);
                    $produc->setEstado($est_p);

                    $produc->setImagenPrincipal($nombreArchivo);

                    $agregardo = $produc->agregarProducto();

                    if ($agregardo) {
                        $_SESSION['ADD']['OK'] = "Producto agregado correctamente.";
                    } else {
                        $_SESSION['ADD']['ERR'] = "Error inesperado durante el proceso guardado.";
                    }
                } else {
                    $_SESSION['ADD']['ERR'] = implode($errores);
                }
            }

            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/producto/nuevoproducto">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite eliminar un nuevo producto en la base de datos
     *
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

            if (isset($_GET)) {

                $id = isset($_GET['id']) ? $_GET['id'] : false;

                if (is_numeric($id)) {

                    $pro = new Producto();
                    $pro->setId($id);

                    $eliminado = $pro->eliminarProducto();

                    if ($eliminado) {
                        $_SESSION['DEL']['OK'] = "Producto eliminado correctamente";
                    } else {
                        $_SESSION['DEL']['ERR'] = "Error durante el proceso de eliminado";
                    }
                } else {
                    $_SESSION['DEL']['ERR'] = "Error. se esperaba un parametro para esta acción";
                }
            }
            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/producto/productos">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * function que permite modificar un producto en la base de datos
     *
     *
     * Este DocBlock documenta la función modificarProducto() 
     */
    public function modificarProducto() {     
        echo '<div style="margin-top: 350px; margin-bottom: 350px;">
                <center>
                    <div class="spinner-border" style="width: 200px; height: 200px; margin: auto;"></div> 
                </center>
            </div>'; 
        try {
            
            if(isset($_GET['id'])){
                
                $id_p = $_GET['id'];
                //guardando los datos en variables
                $nom_p = isset($_POST['txt-nom']) ? $_POST['txt-nom'] : '';
                $caract_p = isset($_POST['txt-caracte']) ? $_POST['txt-caracte'] : '';
                $prec_p = isset($_POST['txt-prec']) ? $_POST['txt-prec'] : '';
                $cant_p = isset($_POST['txt-cant']) ? $_POST['txt-cant'] : '';
                $cantMin_p = isset($_POST['txt-cantMin']) ? $_POST['txt-cantMin'] : '';
                $cantMax_p = isset($_POST['txt-cantMax']) ? $_POST['txt-cantMax'] : ''; 
                $categ_p = isset($_POST['select-categ']) ? $_POST['select-categ'] : '';
                $est_p = isset($_POST['select-est']) ? $_POST['select-est'] : '';
                
               
                
                $errores = array();
                //validando la varible
                if (!empty($nom_p) && !is_numeric($nom_p) && !preg_match("/[0-9]/", $nom_p)) {
                    if(strlen($nom_p) < 60){
                        $nom_valido = true;
                    } else {
                        $nom_valido = false;
                        $errores['nombre'] = "<li>El nombre de su producto no debe superar los 60 caracteres</li>";
                    }
                } else {
                    $nom_valido = false;
                    $errores['nombre'] = "<li>Nombre invalido o esta vacío</li>";
                }

                if (!empty($caract_p)) {
                    if(strlen($caract_p) < 255){
                        $caract_valido = true;
                    } else {
                        $caract_valido = false;
                        $errores['caract'] = "<li>La caracteristica de su producto no puede superar los 255 caracteres</li>";
                    }
                } else {
                    $caract_valido = false;
                    $errores['caract'] = "<li>Caracteristica ingresada vacía</li>";
                }

                if (!empty($prec_p) && is_numeric($prec_p) && $prec_p > 0) {
                    if(strlen($prec_p) < 12){
                        $prec_valido = true;
                    } else {
                        $prec_valido = false;
                        $errores['precio'] = "<li>El precio de su producto no puede superar los 12 caracteres</li>";
                    }
                } else {
                    $prec_valido = false;
                    $errores['precio'] = "<li>Precio ingresado invalido</li>";
                }

                if (!empty($cant_p) && is_numeric($cant_p) && strlen($cant_p) < 11 && $cant_p > 0) {
                    $cant_p_valido = true;
                } else {
                    $cant_p_valido = false;
                    $errores['cantidad'] = "<li>Cantidad ingresada invalida</li>";
                }

                if (!empty($cantMin_p) && strlen($cantMin_p) < 11 && is_numeric($cantMin_p) && $cantMin_p > 0) {
                    $cantMin_p_valido = true;
                } else {
                    $cantMin_p_valido = false;
                    $errores['cantidadMin'] = "<li>Cantidad minima ingresada invalida</li>";
                }

                if (!empty($cantMax_p) && strlen($cantMax_p) < 11  && is_numeric($cantMax_p) && $cantMax_p > 0) {
                    $cantMax_p_valido = true;
                } else {
                    $cantMax_p_valido = false;
                    $errores['cantidadMax'] = "<li>Cantidad máxima ingresada invalida</li>";
                }

                if($cantMax_p_valido && $cantMin_p_valido){ 
                    if($cantMin_p >= $cantMax_p){
                        $errores['errCanridades'] = "<li>La cantidad minima no puede superara la cantidad máxima</li>";
                    }  
                }else{ 
                    $errores['cantidades'] = "<li>Las cantidades ingresadas son invalidas</li>";
                } 

                if (!empty($categ_p) && $categ_p != "Seleccione") {
                    $categ_p_valido = true;
                } else {
                    $categ_p_valido = false;
                    $errores['categ'] = "<li>Debe seleccionar una categoría</li>";
                }

                if (!empty($est_p) && $est_p != "Seleccione") {
                    $est_p_valido = true;
                } else {
                    $est_p_valido = false;
                    $errores['estado'] = "<li>Debe seleccionar un estado</li>";
                } 
 
                $nombreArchivo = "";
                if(isset($_FILES['img-pro']) && $_FILES['img-pro']['name'] != ""){
                    //validar y guardar imagen
                    $archivo = $_FILES['img-pro'];
                    $nombreArchivo = $archivo['name'];
                    $tipoArchivo = $archivo['type'];
                    
                    if ($tipoArchivo == "image/jpg" || $tipoArchivo == "image/jpeg" || $tipoArchivo == "image/png") {

                        if (!is_dir('uploads/images')) {
                            mkdir('uploads/images', 0777, true);
                        }

                        move_uploaded_file($archivo['tmp_name'], 'uploads/images/' . $nombreArchivo);
                    } else {
                        $errores['img'] = "<li>Tipo de archivo no admitido o no seleccionado</li>";
                    }
                }
                  
                if(count($errores) == 0){
                    
                    $produc = new Producto();
                    $produc->setId($id_p);
                    $produc->setNombre($nom_p);
                    $produc->setDetalle(trim($caract_p));
                    $produc->setPrecio($prec_p);
                    $produc->setCantMin($cantMin_p);
                    $produc->setCantMax($cantMax_p);
                    $produc->setStock($cant_p);
                    $produc->setCategoria($categ_p);
                    $produc->setEstado($est_p);
                    
                    if($nombreArchivo != ""){
                        $produc->setImagenPrincipal($nombreArchivo);
                    } 
                    $modificada = $produc->modificarProducto();
                    
                    if($modificada){
                        $_SESSION['MODIFICAR-FINAL']['OK'] = "Producto modificado correctamente.";
                    } else {
                        $_SESSION['MODIFICAR-FINAL']['ERR'] = "Error inesperado durante el proceso guardado.";
                    }
                    
                }else{
                   $_SESSION['MODIFICAR-FINAL']['ERR'] = implode($errores);
                }

            }else{
                $_SESSION['MODIFICAR-FINAL']['ERR'] = "Se esperaba un parametro para modicar el producto";
            } 
            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/producto/productos">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
