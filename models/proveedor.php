<?php

class Proveedor{

private $id;
private $nombre;
private $responsable;
private $telefono;
private $email;
private $direccion;
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

public function getResponsable(){
    return $this->responsable;
}

public function getTelefono(){
    return $this->telefono;
}

public function getEmail(){
    return $this->email;
}

public function getDireccion(){
    return $this->direccion;
}


//// SETTER ////
public function setId($id){
    $this->id = $id;
}

public function setNombre($nombre){
    $this->nombre = $nombre;
}

public function setResponsable($responsable){
   $this->responsable = $responsable;
}

public function setTelefono($telefono){
    $this->telefono = $telefono;
}

public function setEmail($email){
    $this->email = $email;
}

public function setDireccion($direccion){
    $this->direccion = $direccion;
}

//// TOSTRING //// 
public function toString(){
    return 'Id:' . $this->id  
            . ', nombre:' . $this->nombre
            . ', responsable:' . $this->responsable
            . ', telefono:' . $this->telefono
            . ', email:' . $this->email
            . ', direccion:' . $this->direccion;        
        }

public function save(){
    $result=false;
    $sql = "INSERT INTO proveedor(nombre, responsable, telefono, email, direccion) "  
    . "VALUES('{$this->nombre}', '{$this->responsable}', '{$this->telefono}', '{$this->email}', '{$this->direccion}')"; 
    $save = $this->db->query($sql); 
    
    if($save){
        $result=true;
    }

    return $result;
}

}