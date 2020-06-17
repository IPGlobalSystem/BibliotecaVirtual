<?php
require_once 'models/categoria.php';

class CategoriaController{

    public function list(){
        require_once "views/categoria/header.php";
        
        //DECLARAMOS LAS VARIABLES DE LA PAGINACION 
        //E INICIALIZAMOS CON VALORES PRIMARIOS PREDETERMINADOS
        $pag = 1;
        $registros_por_paginas = 3;
        $registros_totales = 0;
        $ultimo_registro = 0; 

        if(isset($_GET["pag"])){
            $pag = $_GET["pag"];
        }
        $ultimo_registro = ($pag - 1) * $registros_por_paginas;

        $categoria =  new Categoria();
        $categorias = $categoria->getAll($registros_por_paginas, $ultimo_registro);
        $registros_totales = $categoria->getCountAll()->registros_totales; // obtengo el conteo total de todos los registro de la tabla
        // $registros_totales = $registros_totales->registros_totales; 
        // comente para simplificar el codigo añadi la ultima parte (->registros_totales) 
        // ver arriba linea 23. 
        require_once "views/categoria/list.php";
    }

    public function register(){
        require_once "views/categoria/header.php";

        $categoria = new Categoria();
        if(isset($_SESSION["form"]) && $_SESSION["form"] != null){
            $form=$_SESSION["form"];
            $categoria->setNombre($form["nombre"]);
            $_SESSION["form"]=null;
        }

        require_once "views/categoria/register.php";
    }

    public function save(){

        if(isset($_POST)){
            $nombre = isset($_POST['nombre'])? trim($_POST['nombre']) : false;

            //declaro arrays que posteriormente sera una variables de session
            //ARRAY PARA ALMACENAR LOS ERRORES
            $errores = Array();
            //ARRAY PARA ALMACENAR LOS VALORES DE LOS CAMPOS DEL FORMULARIO
            $form = Array();
            $form["nombre"] = $nombre;

            //VALIDAR DATOS
            if(empty($nombre)){
                $errores['nombre'] = "El nombre no debe estar vacio";    
            }

            //anexa los datos de categoria al objeto
            $categoria = new Categoria();
            $categoria->setNombre($nombre);
            $categorias = $categoria->getByNombre();
            if($categorias->num_rows >0){
                $errores['nombre'] = "La categoria ya existe";   
            }

            if(count($errores)==0){
                ///QUE HAGA EL REGISTRO
                $save = $categoria->save();

                if($save){
                    $_SESSION['register'] = "complete";
                    $_SESSION['mensaje'] = "Registro guardado con exito!";
                    header("location:" . base_url . "categoria/list");
                }else{
                    $_SESSION['register'] = "failed";
                    $_SESSION['form'] = $form;
                    header("location:" . base_url . "categoria/register");
                }
            }else{
                $_SESSION["errores"] = $errores;
                $_SESSION["form"] = $form;
                header("location:" . base_url . "categoria/register");
            }
        }
    }

    public function select(){
        require_once "views/categoria/header.php";
        $edit = true;
        if(isset($_GET)){
            $categoria = new Categoria();
            $categoria->setId($_GET["id"]);
            $cat = $categoria->getById();
            $categoria->setNombre($cat->nombre);
        }
        require_once "views/categoria/register.php";
    }

    public function edit(){
        var_dump($_POST);
        die();
    }

    
}


?>