<?php 
session_start();
require_once 'config/db.php';
require_once 'autoload.php';
require_once 'config/parameters.php';
require_once 'helpers/utils.php';
require_once 'views/layout/header.php';
require_once 'views/layout/sidebar.php';
require_once 'views/layout/navbar.php';

function show_error(){
    $error = new ErrorController();
    $error->index();    
}

///PRIMERO se define el controlador
if(isset($_GET['controller'])){
    $nombre_controlador = $_GET['controller'].'Controller';
}else if(!isset($_GET['controller']) && !isset($_GET['action'])){
    $nombre_controlador = controller_default;
}else{
    show_error();
    exit();
}

///SEGUNDO se define la accion
if(class_exists($nombre_controlador)){
    $controlador = new $nombre_controlador();

    if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
        $action = $_GET['action'];
        $controlador->$action();
    }else if(!isset($_GET['controller']) && !isset($_GET['action'])){
        $action= action_default;
        $controlador->$action();
    }else{
        show_error();
    }
}else{
    show_error();
}

require_once 'views/layout/footer.php';
?>