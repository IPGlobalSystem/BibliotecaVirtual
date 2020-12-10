<?php
require_once 'models/catalogo.php';
require_once 'models/libro.php';
require_once 'models/categoria.php';

class CatalogoController {

    public function index(){ 
        
        $categoria = new categoria();
        $categoria = $categoria->getAllForSelect(); 
        
        require_once 'views/catalogo/header.php';

        $libro = new libro();
            
            if(isset($_GET['id'])){  

                $id = $_GET['id'];
                $libro->setId($id);
                
                $registros_por_paginas = 3;
                $registros_totales = 0;
                $pagina_actual = 1;
                $ultimo_registro = 0; 
                
                if(isset($_GET["pag"])){                    
                    $pagina_actual = $_GET["pag"];
                } 
                
                //Obtengo la Consulta de los Libro Por el Id De Categoria
                $libros = $libro->getAllByIdCategoria();
                        
            }else{        

                // DECLARAMOS LAS VARIABLES DE LA PAGINACION 
                // E INICIALIZAMOS CON VALORES PRIMARIOS PREDETERMINADOS
                $registros_por_paginas = 3;
                $registros_totales = 0;
                $pagina_actual = 1;
                $ultimo_registro = 0; 
                
                if(isset($_GET["pag"])){
                    $pagina_actual = $_GET["pag"];
                }            
                $ultimo_registro = ($pagina_actual - 1) * $registros_por_paginas;
                $libros = $libro->getAllByLimit($registros_por_paginas,$ultimo_registro);
                $registros_totales = $libro->getCountAll()->registros_totales; 
        
            }
        
        require_once 'views/catalogo/content.php';
    }
    
    public function search(){
        require_once 'views/catalogo/header.php';
        require_once 'views/catalogo/search.php';
        require_once 'views/catalogo/content.php';
    }
    
    public function tes(){
      echo 'tes';
    }

}

?>