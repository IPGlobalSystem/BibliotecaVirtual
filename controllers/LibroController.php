<?php
require_once 'models/libro.php';
require_once 'models/empresa.php';
require_once 'models/categoria.php';
require_once 'models/proveedor.php';

class LibroController{

    public function register(){
        require_once 'views/libro/header.php';

        $empresa = new Empresa();
        $empresas = $empresa->getAllForSelect();

        $categoria = new Categoria();
        $categorias = $categoria->getAllForSelect();

        $proveedor = new Proveedor();
        $proveedores = $proveedor->getAllForSelect();

        require_once 'views/libro/register.php';
    }

    public function save(){
        
        if(isset($_POST)){
            //guardar la informacion que llega del formulario
            $codigo = isset($_POST['codigo']) ? $_POST['codigo'] : false;
            $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : false;
            $pais = isset($_POST['pais']) ? $_POST['pais'] : false;
            $year = isset($_POST['year']) ? $_POST['year'] : false;
            $editorial = isset($_POST['editorial']) ? $_POST['editorial'] : false;
            $edicion = isset($_POST['edicion']) ? $_POST['edicion'] : false;
            $empresa = isset($_POST['empresa']) ? $_POST['empresa'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
            $proveedor = isset($_POST['proveedor']) ? $_POST['proveedor'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $ejemplares = isset($_POST['ejemplares']) ? $_POST['ejemplares'] : false;
            $ubicacion = isset($_POST['ubicacion']) ? $_POST['ubicacion'] : false;
            $resumen = isset($_POST['resumen']) ? $_POST['resumen'] : false;
            $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : false;
            $pdf = isset($_POST['pdf']) ? $_POST['pdf'] : false;
            $optionsPDF = isset($_POST['optionsPDF']) ? $_POST['optionsPDF'] : false;

            //declaro arrays que posteriormente sera una variables de session
            $errores = array();
            $form = array();
            $form["codigo"]=$codigo;
            $form["titulo"]=$titulo;
            $form["pais"]=$pais;
            $form["year"]=$year;
            $form["editorial"]=$editorial;
            $form["edicion"]=$edicion;
            $form["empresa"]=$empresa;
            $form["categoria"]=$categoria;
            $form["proveedor"]=$proveedor;
            $form["precio"]=$precio;
            $form["ejemplares"]=$ejemplares;
            $form["ubicacion"]=$ubicacion;
            $form["resumen"]=$resumen;
            $form["imagen"]=$imagen;
            $form["pdf"]=$pdf;
            $form["optionsPDF"]=$optionsPDF;

            //Validar los datos
            if(empty(trim($codigo))){
                $errores["codigo"] = "Debe completar codigo";
            }

            if(empty(trim($titulo)) || is_numeric($titulo) || preg_match("/[0-9]/",$titulo)){
                $errores["titulo"] = "El formato de titulo no es el correcto";
            }

            if(empty(trim($pais)) || is_numeric($pais) || preg_match("/[0-9]/",$pais)){
                $errores["pais"] = "El formato de pais no es el correcto";
            }

            if(empty(trim($year)) || !is_numeric($year) || !preg_match("/[0-9]/", $year)){
                $errores["year"] = "El formato de año no es el correcto";
            }

            if(empty(trim($editorial))){
                $errores["editorial"] = "Debe completar editorial";
            }

            if(empty(trim($edicion))){
                $errores["edicion"] = "El formato edicion no es el correcto";
            }

            if(trim($empresa) == "0" ){
                $errores["empresa"] = "Debe seleccionar una empresa";
            }

            if(trim($categoria) == "0" ){
                $errores["categoria"] = "Debe seleccionar una categoria";
            }

            if(trim($proveedor) == "0" ){
                $errores["proveedor"] = "Debe seleccionar una proveedor";
            }

            if(empty($precio) || !is_numeric($precio) || !preg_match("/[0-9]/", $precio)){
                $errores["precio"] = "El formato de precio no es el correcto";
            }

            if(empty(trim($ejemplares))){
                $errores["ejemplares"] = "Debe completar ejemplares";
            }

            if(empty(trim($ubicacion))){
                $errores["ubicacion"] = "Debe completar ubicacion";
            }

            if(empty(trim($resumen))){
                $errores["resumen"] = "Debe completar resumen";
            }

            if(empty(trim($imagen))){
                $errores["imagen"] = "Debe adjuntar imagen";
            }

            if(empty(trim($pdf))){
                $errores["pdf"] = "Debe adjuntar PDF";
            }

            //anexa los datos de libro al objeto
            $libro = new Libro();
            

        }
        
    }

    public function info(){        
        require_once 'views/libro_info/header.php';
        require_once 'views/libro_info/content.php';
    }

    public function config(){
        require_once 'views/libro_config/header.php';
        require_once 'views/libro_config/list.php';
        require_once 'views/libro_config/update.php';
    }

}

?>