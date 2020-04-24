<?php

class Utils{
    public static function mostrarError($errores,$campo){
        $alerta='';
        
        if(isset($errores[$campo]) && !empty($campo)){
            // $alerta = "<div class='alert alert-warning alert-dismissible' role='alert'>"
            //     . "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>"
            //     . "<span aria-hidden='true'>&times;</span></button>"
            //     . "<strong>Error!</strong> " . $errores[$campo] ."</div>";
            $alerta = "<div id='validar_contra' style='color:#d20b0b; display:none;'><p>" . $errores[$campo] ."</p></div>";
        }
        
        return $alerta;
    }

    public static function mostrarValor($campos,$campo){
        $valor='';
        
        if(isset($campos[$campo]) && !empty($campo)){
            $valor = $campos[$campo] ;
        }
        return $valor;
    }

    public static function borrarErrores(){
        $_SESSION["errores"]= null;
        $_SESSION["campos"]=null;
        $_SESSION["register"]= null;
        // session_unset($_SESSION["errores"]);
    }
}

?>