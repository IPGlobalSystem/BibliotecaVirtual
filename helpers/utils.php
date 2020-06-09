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

    public static function paginar($registros_por_paginas,$registros_totales,$pagina_actual,$controlado_lista){
        //Una funcion para paginar las listas 
        $html = "<li></li>";
        $paginas = $registros_totales/$registros_por_paginas;
        $paginas = ceil($paginas);

        if($paginas>1){
            //ANTERIOR
            if($pagina_actual==1){
                $html="<li class='disabled'><a href='#'>«</a></li>";
            }else{
                $html="<li><a href='". base_url . $controlado_lista ."&pag=". ($pagina_actual-1) . "'>«</a></li>";
            }
            
            for ($i=1; $i <= $paginas; $i++) { 
                if($pagina_actual==$i){
                    $html.="<li class='active'><a href='". base_url . $controlado_lista ."&pag=".$i."'>".$i."</a></li>";
                }else{
                    $html.="<li><a href='". base_url . $controlado_lista ."&pag=".$i."'>".$i."</a></li>";
                }
            }
            
            //SIGUIENTE
            if($pagina_actual==$paginas){
                $html.="<li class='disabled'><a href='#'>»</a></li>";
            }else{
                $html.="<li><a href='". base_url . $controlado_lista ."&pag=". ($pagina_actual+1) . "'>»</a></li>";
            }
        }

        return $html;
    }
}

?>