<?php

class CategoriaController{

    public function list(){
        require_once "views/categoria/header.php";
        require_once "views/categoria/list.php";
    }

    public function register(){
        require_once "views/categoria/header.php";
        require_once "views/categoria/register.php";
    }

    public function save(){

        if(isset($_POST)){
            $nombre = isset($_POST['nombre'])? $_POST['nombre'] : false;

             //declaro arrays que posteriormente sera una variables de session
            $errores = Array();

            //Validar los datos
            if(!empty($nombre)){
                $errores['nombre'] = "El nombre no debe estar vacio";    
            }

            if(count($errores)==0){
                ///QUE HAGA EL REGISTRO
            }else{
                $_SESSION["errores"] = $errores;
                header("location:" . base_url . "categoria/register");
            }
        }
    }


    
}


?>