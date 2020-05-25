<?php
require_once "models/empresa.php";

class EmpresaController{

    public function list(){
        require_once "views/empresa/header.php";

        $empresa = new empresa();
        $empresas = $empresa->getAll();
       
        require_once "views/empresa/list.php";
       
    }
    public function register(){
        require_once "views/empresa/header.php";

        $empresa = new Empresa();
        if(isset($_SESSION["form"]) && $_SESSION["form"] != null){
            
            $empresa->setCodigo($_SESSION["form"]["codigo"]);
            $empresa->setNombre($_SESSION["form"]["nombre"]);
            $empresa->setTelefono($_SESSION["form"]["telefono"]);
            $empresa->setEmail($_SESSION["form"]["email"]);
            $empresa->setDireccion($_SESSION["form"]["direccion"]);
            $empresa->setDirector($_SESSION["form"]["director"]);
            $empresa->setSimboloMoneda($_SESSION["form"]["moneda"]);
            $empresa->setAnio($_SESSION["form"]["year"]);
            $_SESSION["form"] = null;
        }

        require_once "views/empresa/register.php";
    }

    public function save(){
        
        if(isset($_POST)){

            $codigo = isset($_POST['codigo'])? trim($_POST['codigo']): false;
            $nombre = isset($_POST['nombre'])? trim($_POST['nombre']): false;
            $telefono = isset($_POST['telefono'])? trim($_POST['telefono']): false;
            $email = isset($_POST['email'])? trim($_POST['email']): false;
            $direccion = isset($_POST['direccion'])? trim($_POST['direccion']): false;
            $director = isset($_POST['director'])? trim($_POST['director']): false;
            $moneda = isset($_POST['moneda'])? trim($_POST['moneda']): false;
            $year = isset($_POST['year'])? trim($_POST['year']): false;

            // ARRAY PARA ALMACENAR LOS ERRORES
            $errores = array();
            $form = array();
            $form["codigo"] = $codigo;
            $form["nombre"] = $nombre;
            $form["telefono"] = $telefono;
            $form["email"] = $email;
            $form["direccion"] = $direccion;
            $form["director"] = $director;
            $form["moneda"] = $moneda;
            $form["year"] = $year;

            //VALIDAR DATOS
            if(empty($codigo) || !is_numeric($codigo) || !preg_match("/[0-9]/",$codigo)){
                $errores['codigo'] = "El formato codigo no es correcto";
            }

            if(empty($nombre) || is_numeric($nombre) || preg_match("/[0-9]/", $nombre)){
                $errores['nombre'] = "El formato de nombre no es correcto";
            }

            if(empty($telefono) || !is_numeric($telefono) || !preg_match("/[0-9]/", $telefono)){ 
                $errores['telefono'] = "El formato de telefono no es correcto";  
            }

            if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){ 
                $errores['email'] = "El formato del email  no es correcto";
            }

            if(empty($direccion)){
                $errores['direccion'] = "El direccion no debe de estar vacio";
            }

            if(empty($director)){
                $errores['director'] = "El directorio no debe de estar vacio";   
            }

            if(empty($moneda) || preg_match("/[0-9]/", $moneda)){
                $errores['moneda'] = "El Formato de la moneda no es correcto";
            }

            if(empty($year) ||  !is_numeric($year)){
                $errores['year'] = "El Formato de la Año no es correcto"; 
            }

            //Anexa los datos de empresa al objeto
            $empresa = new empresa();
            $empresa->setCodigo($codigo);
            $empresa->setNombre($nombre);
            $empresa->setTelefono($telefono);
            $empresa->setEmail($email);
            $empresa->setDireccion($direccion);
            $empresa->setDirector($director);
            $empresa->setSimboloMoneda($moneda);
            $empresa->setAnio($year);

            if(count($errores)==0){

                //Guardar
               $save =  $empresa->save();
               if($save){
                    $_SESSION["register"] = "complete";
                    $_SESSION["mensaje"] = "Registro guardado con exito!";
                header("Location:".base_url.'empresa/register'); 
                }else{
                    $_SESSION["register"] = "failed";
                    $_SESSION["form"] = $form;
                    header("Location:".base_url."empresa/register");
                }           
            }else{
                $_SESSION["errores"]= $errores;
                $_SESSION["form"] = $form;
                header("location: " . base_url . "empresa/register");
            }

        }
    }


}

?>