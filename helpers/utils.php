<?php

class Utils{

    public static function mostrarError($errores,$campo){
        $alerta='';
        
        if(isset($errores[$campo]) && !empty($campo)){
            $alerta = "<div class='valid_form'>" . $errores[$campo] ."</div>";
        }
        
        return $alerta;
    }

    public static function borrarErrores(){
        $_SESSION["errores"]= null;
        $_SESSION["register"]= null;
        $_SESSION["mensaje"]= null;
        // session_unset($_SESSION["errores"]);
    }

    public static function verSession(){
        if($_SESSION["identity"]==null){
            header("location:".base_url."usuario/login");
        }
    }
}

?>