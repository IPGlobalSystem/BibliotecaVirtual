<?php 

require_once 'models/usuario.php';

class UsuarioController{

    public function list(){
        require_once 'views/usuario/header.php';

        $usuario = new Usuario();
        $usuarios = $usuario->getAll();

        require_once 'views/usuario/list.php';
    }

    public function search(){
        require_once 'views/usuario/header.php';
        require_once 'views/usuario/search.php';
        require_once 'views/usuario/list.php';
    }

    
    public function cancel(){
        require_once 'views/usuario/header.php';

        $usuario = new Usuario();
        if(isset($_GET["id"])){
            $usuario = new Usuario();
            $usuario->setId($_GET["id"]);
            $usuario->cancel();
            
            $_SESSION["register"] = "complete";
            $_SESSION["mensaje"] = "Registro anulado con exito!";
        }

        header('Location:'.base_url.'usuario/list');
    }

    public function delete(){
        require_once 'views/usuario/header.php';
        $usuario = new Usuario();

        if(isset($_GET["id"])){
            $usuario = new Usuario();
            $usuario->setId($_GET["id"]);
            $usuario->delete();
            
            $_SESSION["register"] = "complete";
            $_SESSION["mensaje"] = "Registro eliminado con exito!";
        }
        header('Location:'.base_url.'usuario/list');
    }

    public function register(){
        require_once 'views/usuario/header.php';
        
        $usuario = new Usuario();
        if(isset($_SESSION["form"]) && $_SESSION["form"] != null){
            $form=$_SESSION["form"];
            $usuario->setNumeroDocumento($form["dni"]);
            $usuario->setNombre($form["nombre"]);
            $usuario->setApellidos($form["apellido"]);
            $usuario->setTelefono($form["telefono"]);
            $usuario->setDireccion($form["direccion"]);
            $usuario->setUsername($form["user"]);
            $usuario->setEmail($form["email"]);
            $usuario->setSexo($form["sexo"]);
            $usuario->setPrivilegio($form["privilegio"]);
            $_SESSION["form"]=null;
        }

        require_once 'views/usuario/register.php';
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
            $sexo = isset($_POST['sexo']) ? $_POST['sexo']:false;
            $privilegio = isset($_POST['privilegio']) ? $_POST['privilegio']:false;

            //declaro arrays que posteriormente sera una variables de session
            $errores = array();
            $form = array();
            $form["dni"]=$dni;
            $form["nombre"]=$nombre;
            $form["apellido"]=$apellido;
            $form["telefono"]=$telefono;
            $form["direccion"]=$direccion;
            $form["user"]=$user;
            $form["email"]=$email;
            $form["sexo"]=$sexo;
            $form["privilegio"]=$privilegio;

            //Validar los datos
            if(empty(trim($dni)) || !is_numeric($dni) || !preg_match("/[0-9]/",$dni)){
                $errores["dni"] = "El formato de dni no es el correcto";
            }

            if(empty(trim($nombre)) || is_numeric($nombre) || preg_match("/[0-9]/",$nombre)){
                $errores["nombre"] = "El formato de nombre no es el correcto";
            }

            if(empty(trim($apellido)) || is_numeric($apellido) || preg_match("/[0-9]/",$apellido)){
                $errores["apellido"] = "El formato de apellido no es el correcto";
            }

            if(empty(trim($telefono)) || !is_numeric($telefono) || !preg_match("/[0-9]/", $telefono)){
                $errores["telefono"] = "El formato de telefono no es el correcto";
            }

            if(empty(trim($direccion))){
                $errores["direccion"] = "Debe completar direccion";
            }

            if(empty(trim($email)) || !filter_var($email,FILTER_VALIDATE_EMAIL)){
                $errores["email"] = "El formato email no es el correcto";
            }

            if(empty(trim($user))){
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
                    $_SESSION["mensaje"] = "Registro guardado con exito!";
                    header("Location:".base_url.'usuario/list'); 
                }else{
                    $_SESSION["register"] = "failed";
                    $_SESSION["form"] = $form;
                    header("Location:".base_url."usuario/register");
                }
            }else{
                $_SESSION["errores"] = $errores;
                $_SESSION["form"] = $form;
                header("Location:".base_url."usuario/register");
            }
        }
    }

    public function edit(){
        require_once 'views/usuario/header.php';

        $edit = true;

        if(isset($_GET["id"])){
            $usuario = new Usuario();

            if(isset($_SESSION["form"]) && $_SESSION["form"] != null){
                $form=$_SESSION["form"];
                $usuario->setId($_GET["id"]);
                $usuario->setNumeroDocumento($form["dni"]);
                $usuario->setNombre($form["nombre"]);
                $usuario->setApellidos($form["apellido"]);
                $usuario->setTelefono($form["telefono"]);
                $usuario->setDireccion($form["direccion"]);
                $usuario->setUsername($form["user"]);
                $usuario->setEmail($form["email"]);
                $usuario->setSexo($form["sexo"]);
                $usuario->setPrivilegio($form["privilegio"]);
                $_SESSION["form"]=null;
            }else{
                $usuario->setId($_GET["id"]);
                $user = $usuario->getOne();
                $usuario->setNumeroDocumento($user->numeroDocumento);
                $usuario->setNombre($user->nombre);
                $usuario->setApellidos($user->apellidos);
                $usuario->setTelefono($user->telefono);
                $usuario->setDireccion($user->direccion);
                $usuario->setUsername($user->username);
                $usuario->setEmail($user->email);
                $usuario->setSexo($user->sexo);
                $usuario->setPrivilegio($user->privilegio);
            }
        }

        require_once 'views/usuario/register.php';
    }

    public function editSave(){
        if(isset($_POST)){
            //Recibo los datos
            $id = isset($_POST['id']) ? $_POST['id'] : false;
            $dni = isset($_POST['dni-reg']) ? $_POST['dni-reg'] : false;
            $nombre= isset($_POST['nombre-reg']) ? $_POST['nombre-reg'] : false;
            $apellido = isset($_POST['apellido-reg']) ? $_POST['apellido-reg'] : false;
            $telefono = isset($_POST['telefono-reg']) ? $_POST['telefono-reg'] : false;
            $direccion = isset($_POST['direccion-reg']) ? $_POST['direccion-reg'] : false;
            $user = isset($_POST['usuario-reg']) ? $_POST['usuario-reg'] : false;
            $password = isset($_POST['password1-reg']) ? $_POST['password1-reg'] : false;
            $password_confirm = isset($_POST['password2-reg']) ? $_POST['password2-reg'] : false;
            $email = isset($_POST['email-reg']) ? $_POST['email-reg'] : false;
            $sexo = isset($_POST['sexo']) ? $_POST['sexo']:false;
            $privilegio = isset($_POST['privilegio']) ? $_POST['privilegio']:false;

            //declaro arrays que posteriormente sera una variables de session
            $errores = array();
            $form = array();
            $form["id"]=$id;
            $form["dni"]=$dni;
            $form["nombre"]=$nombre;
            $form["apellido"]=$apellido;
            $form["telefono"]=$telefono;
            $form["direccion"]=$direccion;
            $form["user"]=$user;
            $form["email"]=$email;
            $form["sexo"]=$sexo;
            $form["privilegio"]=$privilegio;

            //Validar los datos
            if(empty(trim($dni)) || !is_numeric($dni) || !preg_match("/[0-9]/",$dni)){
                $errores["dni"] = "El formato de dni no es el correcto";
            }

            if(empty(trim($nombre)) || is_numeric($nombre) || preg_match("/[0-9]/",$nombre)){
                $errores["nombre"] = "El formato de nombre no es el correcto";
            }

            if(empty(trim($apellido)) || is_numeric($apellido) || preg_match("/[0-9]/",$apellido)){
                $errores["apellido"] = "El formato de apellido no es el correcto";
            }

            if(empty(trim($telefono)) || !is_numeric($telefono) || !preg_match("/[0-9]/", $telefono)){
                $errores["telefono"] = "El formato de telefono no es el correcto";
            }

            if(empty(trim($direccion))){
                $errores["direccion"] = "Debe completar direccion";
            }

            if(empty(trim($email)) || !filter_var($email,FILTER_VALIDATE_EMAIL)){
                $errores["email"] = "El formato email no es el correcto";
            }

            if(empty(trim($user))){
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

            if(count($errores)==0 && isset($id)){
                
                $usuario= new Usuario();
                $usuario->setId($id);
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
               
                $edit = $usuario->edit();

                if($edit){
                    $_SESSION["register"] = "complete";
                    $_SESSION["mensaje"] = "Registro guardado con exito!";
                    header("Location:".base_url.'usuario/list'); 
                }else{
                    $_SESSION["register"] = "failed";
                    $_SESSION["form"] = $form;
                    header("Location:".base_url."usuario/edit&id=". $id);
                }
            }else{
                $_SESSION["errores"] = $errores;
                $_SESSION["register"] = "failed";
                header("Location:".base_url."usuario/list");
            }
        }
    }
}

?>