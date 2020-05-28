<?php

class LibroController{

    public function info(){
        require_once 'views/libro_info/header.php';
        require_once 'views/libro_info/content.php';
    }

    public function config(){
        require_once 'views/libro_config/header.php';
        require_once 'views/libro_config/list.php';
        require_once 'views/libro_config/update.php';
    }

}

?>