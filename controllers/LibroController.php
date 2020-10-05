<?php
require_once 'models/libro.php';
require_once 'models/empresa.php';
require_once 'models/categoria.php';
require_once 'models/proveedor.php';
require_once 'helpers/utils.php';

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
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $ejemplares = isset($_POST['ejemplares']) ? $_POST['ejemplares'] : false;
            $ubicacion = isset($_POST['ubicacion']) ? $_POST['ubicacion'] : false;
            $resumen = isset($_POST['resumen']) ? $_POST['resumen'] : false;
            $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : false;
            $autor = isset($_POST['titulo']) ? $_POST['autor'] : false;
            $pais = isset($_POST['pais']) ? $_POST['pais'] : false;
            $anio = isset($_POST['year']) ? $_POST['year'] : false;
            $editorial = isset($_POST['editorial']) ? $_POST['editorial'] : false;
            $edicion = isset($_POST['edicion']) ? $_POST['edicion'] : false;
            $imagen = isset($_FILES['imagen']['name']) ? $_FILES['imagen']['name'] : false;
            $pdf = isset($_FILES['pdf']['name']) ? $_FILES['pdf']['name'] : false;
            $descargable = isset($_POST['descargable']) ? $_POST['descargable'] : false;
            $empresa = isset($_POST['empresa']) ? $_POST['empresa'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
            $proveedor = isset($_POST['proveedor']) ? $_POST['proveedor'] : false;

            //declaro arrays que posteriormente sera una variables de session
            $errores = array();
            $form = array();
            $form["codigo"]=$codigo;
            $form["precio"]=$precio;
            $form["ejemplares"]=$ejemplares;
            $form["ubicacion"]=$ubicacion;
            $form["resumen"]=$resumen;            
            $form["titulo"]=$titulo;
            $form["autor"]=$autor;
            $form["pais"]=$pais;
            $form["anio"]=$anio;
            $form["editorial"]=$editorial;
            $form["edicion"]=$edicion;
            $form["imagen"]=$imagen;
            $form["pdf"]=$pdf;
            $form["descargable"]=$descargable;
            $form["empresa"]=$empresa;
            $form["categoria"]=$categoria;
            $form["proveedor"]=$proveedor;
            
           
            //Validar los datos
            if(empty(trim($codigo))){
                $errores["codigo"] = "Debe completar codigo";
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

            if(empty(trim($titulo)) || is_numeric($titulo) || preg_match("/[0-9]/",$titulo)){
                $errores["titulo"] = "El formato de titulo no es el correcto";
            }

            if(empty(trim($autor))){
                $errores["autor"] = "Debe completar el autor";
            }

            if(empty(trim($pais)) || is_numeric($pais) || preg_match("/[0-9]/",$pais)){
                $errores["pais"] = "El formato de pais no es el correcto";
            }

            if(empty(trim($anio)) || !is_numeric($anio) || !preg_match("/[0-9]/", $anio)){
                $errores["anio"] = "El formato de año no es el correcto";
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


            if(empty(trim($pdf))){
                $errores["pdf"] = "Debe adjuntar PDF";
            }else{
                if($_FILES["pdf"]["error"]>0){
                    $errores["pdf"] = "El formato no es el correcto";
                }else{
                    Utils::subirArchivo($_FILES);
                }
            }
            
            if(empty(trim($imagen))){
                $errores["imagen"] = "Debe adjuntar imagen";
            }
            else
            {
                if($_FILES["imagen"]["error"]>0){
               
                    $errores["imagen"] = "El formato no es el correcto";
                }else{
                    Utils::subirImagen($_FILES);
                }
            }

            //Anexa los datos de libro al objeto para guardar
            $libro = new Libro();
            $libro->setCodigo($codigo);
            $libro->setPrecio($precio);
            $libro->setEjemplares($ejemplares);
            $libro->setUbicacion($ubicacion);
            $libro->setResumen($resumen);
            $libro->setTitulo($titulo);
            $libro->setAutor($autor);
            $libro->setPais($pais);
            $libro->setAnio($anio);
            $libro->setEditorial($editorial);
            $libro->setEdicion($edicion);
            $libro->setImagen($imagen);
            $libro->setPdf($pdf);
            $libro->setDescargable($descargable);
            $libro->setEmpresa($empresa);
            $libro->setCategoria($categoria);
            $libro->setProveedor($proveedor);

            if(count($errores)==0){
                //Guardar
                $save = $libro->save();

            }else{
                
            }
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