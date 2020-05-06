<?php 

require_once 'models/usuario.php';

class UsuarioController{

    public function login(){
        $_SESSION["identity"] = null;
        require_once 'views/usuario/login.php';
    }

    public function logining(){
        ///HACER EL LOGIN AQUI 
        if(isset($_POST)){
            $usuario = new Usuario();
            $usuario->setUsername($_POST["username"]);
            $usuario->setEmail($_POST["username"]);
            $usuario->setPassword($_POST["password"]);
            $identity = $usuario->login();

            if($identity && is_object($identity)){
                $_SESSION["identity"] = $identity;

                if($identity->rol == "admin"){
                    $_SESSION['admin'] = true;
                }
            
                header("Location:".base_url."home/index");
            }else{
                $_SESSION["error"]="Identificacion fallida!!!";
                header("Location:".base_url."usuario/login");
            }
        }
    }

    public function mi_cuenta(){
        require_once 'views/mi_cuenta/header.php';
        require_once 'views/mi_cuenta/update.php';
    }

    public function mis_datos(){
        require_once 'views/mis_datos/header.php';
        require_once 'views/mis_datos/update.php';
    }

    public function list(){
        require_once 'views/usuario/header.php';

        $usuario = new Usuario();
        $usuarios = $usuario->getAll('admin');

        require_once 'views/usuario/list.php';
    }

    public function search(){
        require_once 'views/usuario/header.php';
        require_once 'views/usuario/search.php';
        $usuario = new Usuario();
        $usuarios = $usuario->getAll('admin');
        require_once 'views/usuario/list.php';
    }

    public function searching(){
        require_once 'views/usuario/header.php';

        $usuario = new Usuario();
        $usuarios = $usuario->getAll('admin');
        if(isset($_POST['search'])){
            $search=$_POST["search"];
       
            $usuarios = $usuario->getByAll($search);
            require_once 'views/usuario/searching.php';
        }
        require_once 'views/usuario/list.php';
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
                $errores["password_confirm"] = "Debe completar password";
            }

            if($password != $password_confirm){
                $errores["password_confirm"] = "Debe repetir la misma contraseña";
            }

            //anexa los datos de usuario al objeto
            $usuario= new Usuario();
            $usuario->setNumeroDocumento($dni);
            $usuario->setNombre($nombre);
            $usuario->setApellidos($apellido);
            $usuario->setTelefono($telefono);
            $usuario->setDireccion($direccion);
            $usuario->setUsername($user);
            $usuario->setPassword($password);
            $usuario->setEmail($email);
            $usuario->setSexo($sexo);
            $usuario->setPrivilegio($privilegio);
            if($usuario->getByDocument()->num_rows > 0){
                $errores["dni"]="El dni/cedula ya existe en la base de datos";
            }else if ($usuario->getByEmail()->num_rows > 0){
                $errores["email"]="El email ya existe en la base de datos";
            }else if ($usuario->getByUsername()->num_rows > 0){
                $errores["usuario"]="El usuario ya existe en la base de datos";
            }

            if(count($errores)==0){
                $save = $usuario->save('admin');

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

    public function cancel(){
        require_once 'views/usuario/header.php';

        $usuario = new Usuario();
        $usuarios = $usuario->getAll('admin');
        if(isset($_GET["id"])){
            $id = $_GET["id"];
            $title = "ANULAR ADMINISTRADOR";
            $action = "ANULAR";
            require_once 'views/usuario/delete.php';
        }

        require_once 'views/usuario/list.php';
    }


    public function canceling(){
        require_once 'views/usuario/header.php';

        $usuario = new Usuario();
        if(isset($_GET["id"])){
            $usuario->setId($_GET["id"]);
            $usuario->cancel();
            
            $_SESSION["register"] = "complete";
            $_SESSION["mensaje"] = "Registro anulado con exito!";
        }

        header('Location:'.base_url.'usuario/list');
    }

    public function select(){
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
                $user = $usuario->getOneById();
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

    public function edit(){
        if(isset($_POST)){
            $editarPassword = false;
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

            if(!empty($password)){
                if($password != $password_confirm){
                    $errores["password_confirm"] = "Debe repetir la misma contraseña";
                }
                $editarPassword=true;
            }

            if(isset($id)){
                
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
                $usuario->setSexo($sexo);
                $usuario->setPrivilegio($privilegio);
                if($usuario->getByDocument()->num_rows > 0){
                    $errores["dni"]="El dni/cedula ya existe en la base de datos";
                }else if($usuario->getByEmail()->num_rows > 0){
                    $errores["email"]="El email ya existe en la base de datos";
                }else if($usuario->getByUsername()->num_rows > 0){
                    $errores["usuario"]="El usuario ya existe en la base de datos";
                }

                if(count($errores)==0){
                    
                    $edit = $usuario->edit($editarPassword);

                    if($edit){
                        $_SESSION["register"] = "complete";
                        $_SESSION["mensaje"] = "Registro actualizado con exito!";
                        header("Location:".base_url.'usuario/list'); 
                    }else{
                        $_SESSION["register"] = "failed";
                        $_SESSION["form"] = $form;
                        header("Location:".base_url."usuario/select&id=". $id);
                    }
                }else{
                    $_SESSION["errores"] = $errores;
                    $_SESSION["form"] = $form;
                    $_SESSION["register"] = "failed";
                    header("Location:".base_url."usuario/select&id=". $id);
                }
            }else{
                $_SESSION["register"] = "failed";
                header("Location:".base_url."usuario/list");
            }
        }
    }

    public function remove(){
        require_once 'views/usuario/header.php';

        if(isset($_GET["id"])){
            $id = $_GET["id"];
            $title = "ELIMINAR ADMINISTRADOR";
            $action = "ELIMINAR";
            require_once 'views/usuario/delete.php';
        }

        $usuario = new Usuario();
        $usuarios = $usuario->getAll('admin');

        require_once 'views/usuario/list.php';
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
}

?>