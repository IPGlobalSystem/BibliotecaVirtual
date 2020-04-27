<?php

class Categoria{

    private $id;
    private $nombre;
    private $db;

    ///CONSTRUCTOR///
    public function  __construct(){
        $this->db = Database::connect();
    }
    
    //// GETTER ////
    public function getId(){
        return $this->id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    //// SETTER ////
    public function setId($id){
        $this->id = $id;
    }

    public function setNombre($nombre){
        $this->nombre =$nombre;
    }

    //// TOSTRING //// 
    public function toString(){
        return 'Id:' . $this->id  
        . ', nombre:' . $this->nombre;
               
    }

}

?>