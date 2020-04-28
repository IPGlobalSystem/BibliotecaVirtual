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
    $this->nombre;
}

public function setResponsable($responsable){
   $this->responsable;
}

public function setTelefono($telefono){
    $this->telefono;
}

public function setEmail($email){
    $this->email;
}

public function setDireccion($direccion){
    $this->direccion;
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

}