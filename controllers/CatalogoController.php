<?php
require_once 'models/catalogo.php';

class CatalogoController {

    public function index(){
        require_once 'views/catalogo/header.php';
        require_once 'views/catalogo/content.php';
    }

    public function search(){
        require_once 'views/catalogo/header.php';
        require_once 'views/catalogo/search.php';
        require_once 'views/catalogo/content.php';
    }
}

?>