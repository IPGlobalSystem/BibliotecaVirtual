<?php 

require_once 'models/usuario.php';

class UsuarioController{
    public function register(){
        require_once 'views/usuario/header.php';
        require_once 'views/usuario/register.php';
    }

    public function lista(){
        require_once 'views/usuario/header.php';
        require_once 'views/usuario/lista.php';
    }

    public function search(){
        require_once 'views/usuario/header.php';
        require_once 'views/usuario/search.php';
        require_once 'views/usuario/lista.php';
    }

    public function save(){
        if(isset($_POST)){
            //Recibo los datos
            $dni = isset($_POST['dni-reg']) ? $_POST['dni-reg'] : false;
            $nombre= isset($_POST['nombre-reg']) ? $_POST['nombre-reg'] : false;
            $apellido = isset($_POST['apellido-reg']) ? $_POST['apellido-reg'] : false;
            $telefono = isset($_POST['telefono-reg']) ? $_POST['telefono-reg'] : false;
            $direccion = isset($_POST['direccion-reg']) ? $_POST['direccion-reg'] : false;
            $user = isset($_POST['usuario-reg']) ? $_POST['usuario-reg'] : false;
            $password = isset($_POST['password1-reg']) ? $_POST['password1-reg'] : false;
            $password_confirm = isset($_POST['password2-reg']) ? $_POST['password2-reg'] : false;
            $email = isset($_POST['email-reg']) ? $_POST['email-reg'] : false;
            $genero = isset($_POST['optionsGenero']) ? $_POST['optionsGenero']:false;
            $privilegio = isset($_POST['optionsPrivilegio']) ? $_POST['optionsPrivilegio']:false;

            //declaro array que posteriormente sera una variable de session
            $errores = array();
            $campos= array();

            //Validar los datos
            if(empty(trim($dni)) || !is_numeric($dni) || !preg_match("/[0-9]/",$dni)){
                $campos["dni"] = $dni;
                $errores["dni"] = "El formato de dni no es el correcto";
            }

            if(empty(trim($nombre)) || is_numeric($nombre) || preg_match("/[0-9]/",$nombre)){
                $campos["nombre"] = $nombre;
                $errores["nombre"] = "El formato de nombre no es el correcto";
            }

            if(empty(trim($apellido)) || is_numeric($apellido) || preg_match("/[0-9]/",$apellido)){
                $campos["apellido"] = $apellido;
                $errores["apellido"] = "El formato de apellido no es el correcto";
            }

            if(empty(trim($telefono)) || !is_numeric($telefono) || !preg_match("/[0-9]/", $telefono)){
                $campos["telefono"] = $telefono;                
                $errores["telefono"] = "El formato de telefono no es el correcto";
            }

            if(empty(trim($direccion))){
                $campos["direccion"] = $direccion;                
                $errores["direccion"] = "Debe completar direccion";
            }

            if(empty(trim($email)) || !filter_var($email,FILTER_VALIDATE_EMAIL)){
                $campos["email"] = $email;                
                $errores["email"] = "El formato email no es el correcto";
            }

            if(empty(trim($user))){
                $campos["usuario"] = $user;                
                $errores["usuario"] = "Debe completar usuario";
            }

            if(empty($password)){
                $errores["password"] = "Debe completar password";
            }

            if(empty($password_confirm)){
                $errores["password_confirm"] = "Debe completar la confirmacion del password";
            }

            if($password != $password_confirm){
                $errores["password_confirm"] = "El password debe ser igual al primero digitado";
            }

            if(count($errores)==0){
               
                $usuario= new Usuario();
                $usuario->setNumeroDocumento($dni);
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellido);
                $usuario->setTelefono($telefono);
                $usuario->setDireccion($direccion);
                $usuario->setUsername($user);
                $usuario->setPassword($password);
                $usuario->setEmail($email);
                $usuario->setSexo($genero);
                $usuario->setPrivilegio($privilegio);

                $save = $usuario->save();

                if($save){
                    $_SESSION["register"] = "complete";
                    header("Location:".base_url.'usuario/lista'); 
                }else{
                    $_SESSION["register"] = "failed";
                    $_SESSION["campos"] = $campos;
                    header("Location:".base_url."usuario/register");
                }
            }else{
                $_SESSION["errores"] = $errores;
                header("Location:".base_url."usuario/register");
            }
        }
    }
}

?>