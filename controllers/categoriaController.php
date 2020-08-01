<?php

require_once 'models/pedido/Categoria.php';

/**
 * Clase controladora de los mudlos destinados a las categorias de productos
 *
 * @author Daniel Huenul
 */
class CategoriaController {


    /**
     * function carga la vista de categorias donde se miestra el listado de las categorias ya creadas
     * 
     * Este DocBlock documenta la función categorias() 
     */
    public function categorias() {

        $cli = new Categoria();

        //todas las categorias de la base de datos
        $result_cat = $cli->obtenerCategorias();

        require_once 'views/interfaz/modulo/vista_categorias.php';
    }

    /**
     * function que realiza el guardado de nuevas categorias en la base de datos
     * 
     * Este DocBlock documenta la función agregarCategoria() 
     */
    public function agregarCategoria() {
        echo '<div style="margin-top: 350px; margin-bottom: 350px;">
                <center>
                    <div class="spinner-border" style="width: 200px; height: 200px; margin: auto;"></div> 
                </center>
            </div>';
        try {

            if (isset($_POST)) {

                //guardando la categoria en una variable
                $categoria = isset($_POST['txt-nom']) ? $_POST['txt-nom'] : false;

                $errores = array();

                //validando la varible
                if (!empty($categoria) && !is_numeric($categoria) && !preg_match("/[0-9]/", $categoria)) {
                    if(strlen($categoria) < 60){
                        $categoria_valido = true;
                    }else{
                        $categoria_valido = false;
                        $errores['nombre'] = "<li>La categoría solo debe tener 60 caracteres o menos</li>";
                    }
                } else {
                    $categoria_valido = false;
                    $errores['nombre'] = "<li>Nombre de categoría ingresado invalido</li>";
                }

                if (count($errores) == 0) {

                    $cat = new Categoria();
                    $cat->setId(0);
                    $cat->setCodigo(rand());
                    $cat->setNombre($categoria);

                    //es el objeto de la categoria que se encuentra
                    //con todas las propiedades
                    $cat_buscada = $cat->obtenerCategoria();
                    if ($cat->getNombre() != $cat_buscada) {
                        $agregado = $cat->agregarCategoria();

                        if ($agregado) {
                            $_SESSION['ADD-CATEGORIA']['OK'] = "La categoria se ha añadido correctamente";
                        } else {
                            $_SESSION['ADD-CATEGORIA']['ERR'] = "Ha ocurrido un error inesperado... Intente nuevamente";
                        }
                    } else {
                        $_SESSION['ADD-CATEGORIA']['ERR'] = "La categoria ingresada ya se ha registrado";
                    }
                } else {
                    $_SESSION['ADD-CATEGORIA']['ERR'] = implode($errores);
                }
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/categoria/categorias">';
 
    }

    /**
     * function que realiza el eliminado de categorias en la base de datos
     * 
     * Este DocBlock documenta la función eliminarCategoria() 
     */
    public function eliminarCategoria() {
        echo '<div style="margin-top: 350px; margin-bottom: 350px;">
                <center>
                    <div class="spinner-border" style="width: 200px; height: 200px; margin: auto;"></div> 
                </center>
            </div>';
        try {

            if (isset($_GET['id'])) {

                $id_cat = isset($_GET['id']) ? $_GET['id'] : false;

                if (is_numeric($id_cat)) {
                    $cat = new Categoria(); 
                    $cat->setId($id_cat);
                    $eliminado = $cat->eliminarCategoria();
                     
                    
                    if($eliminado){
                        $_SESSION['REMOVE-CATEG']['CAT-DELETE'] = "Categoría eliminada correctamente";
                    }else{
                        $_SESSION['REMOVE-CATEG']['ERR-DELETE'] = "No se puede eliminar la categoría. Esta asociada a productos.";
                    }
                }else{
                   $_SESSION['REMOVE-CATEG']['ERR-DELETE'] = "Error. se esperaba un parametro para esta acción";
                }
            }
            
            echo '<meta http-equiv="Refresh" content="0;url=http://localhost/Inmuebles-Herrera/categoria/categorias">';
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}

?>
