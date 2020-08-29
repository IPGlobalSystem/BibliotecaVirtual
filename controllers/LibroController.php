<?php

require_once 'models/empresa.php';
require_once 'models/categoria.php';
require_once 'models/proveedor.php';

class LibroController{

    public function register(){
        require_once 'views/libro/header.php';

        $empresa = new Empresa();
        $empresas = $empresa->getAllForSelect();

        $categoria = new Categoria();
        $categorias = $categoria->getAllForSelect();

        $proveedor = new Proveedor();
        $proveedores = $proveedor->getAllForSelect();

        require_once 'views/libro/register.php';
    }

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