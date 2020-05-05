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

    public function getByNombre(){
        $sql = "SELECT * FROM categoria WHERE nombre='{$this->getNombre()}';";
        $categoria = $this->db->query($sql);
        return $categoria;
    }

    public function save(){
        $result=false;
        $sql = "INSERT INTO categoria(nombre) VALUES('{$this->nombre}')";
        $save = $this->db->query($sql);

        if($save){
            $result=true;
        }

        return $result;
    }

}

?>