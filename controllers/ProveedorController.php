<?php
require_once "models/proveedor.php";

class ProveedorController{

    public function list(){
        require_once "views/proveedor/header.php";
        require_once "views/proveedor/list.php";
    }

    public function register(){
        require_once "views/proveedor/header.php";

        
        require_once "views/proveedor/registro.php";
    }

    public function save(){
        
        if(isset($_POST)){
            $nombre = isset($_POST['nombre'])? trim($_POST['nombre']): false;
            $responsable = isset($_POST['responsable'])? trim($_POST['responsable']): false;
            $telefono = isset($_POST['telefono'])? trim($_POST['telefono']): false;
            $email = isset($_POST['email'])? trim($_POST['email']): false;
            $direccion = isset($_POST['direccion'])? trim($_POST['direccion']): false;

            //Array para almacenar Los Errores
            $errores = array();
            $form = array();
            $form['nombre'] = $nombre;
            $form['responsable'] = $responsable;
            $form['telefono'] = $telefono;
            $form['email'] = $email;
            $form['direccion'] = $direccion;
            
            if(empty($nombre) || is_numeric($nombre) || preg_match("/[0-9]/", $nombre)){
                $errores['nombre'] = "El formato de nombre no es correcto";
            }

            if(empty($responsable) || is_numeric($responsable) || preg_match("/[0-9]/", $responsable)){
                $errores['responsable'] = "El formato de responsable no es correcto";
            }

            if(empty($telefono) || !is_numeric($telefono) || !preg_match("/[0-9]/", $telefono)){ 
                $errores['telefono'] = "El formato de telefono no es correcto";  
            }  

            if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){ 
                $errores['email'] = "El formato del email  no es correcto";
            }

            if(empty($direccion)){
                $errores['direccion'] = "El formato de direccion no es correcto";
            }

            // anexa los datos de empresa al objeto para guardar
            $proveedor = new Proveedor();
            $proveedor->setNombre($nombre);
            $proveedor->setResponsable($responsable);
            $proveedor->setTelefono($telefono);
            $proveedor->setEmail($email);
            $proveedor->setDireccion($direccion);

            if(count($errores)==0){

                //Guardar
                $save = $proveedor->save();
                
                if($save){
                    $_SESSION["register"] = "complete";
                    $_SESSION["mensaje"] = "Registro guardado con exito!";
                    header("location:".base_url."proveedor/register");
                }else{
                    $_SESSION["register"] = "failed";
                    $_SESSION["form"] = $form;
                    header("Location:".base_url."proveedor/register");
                }
            }else{
                $_SESSION["errores"]= $errores;
                $_SESSION["form"] = $form;
                header("location: " . base_url . "proveedor/register");
            }
        
        }
    }
}

        
    
    



?>