<?php

class Empresa{

    private $id;
    private $codigo;
    private $nombre;
    private $telefono;
    private $email;
    private $direccion;
    private $director;
    private $simbolo_moneda;
    private $anio;
    private $id_usuario;
    private $db;

    ////CONSTRUCT////
    public function __contruct(){
        $this->db = Database::connect();
    }

    ////GETTERS////
    public function getId(){
        return $this->id;
    }

    public function getCodigo(){
        return $this->codigo;
    }

    public function getNombre(){
        return $this->nombre;
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

    public function getDirector(){
        return $this->director;
    }

    public function getSimboloMoneda(){
        return $this->simbolo_moneda;
    }

    public function getAnio(){
        return $this->anio;
    }

    public function getIdUsuario(){
        return $this->id_usuario;
    } 

    ////SETTERS////
    public function setId($id){
        $this->id = $id;
    }

    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
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

    public function setDirector($director){
        $this->director = $director;
    }

    public function setSimboloMoneda($simbolo_moneda){
        $this->simbolo_moneda = $simbolo_moneda;
    }

    public function setAnio($anio){
        $this->anio = $anio;
    }

    public function setIdUsuario($id_usuario){
        $this->id_usuario = $id_usuario;
    } 

    //// TOSTRING //// 
    public function tostring(){
        return "id: " . $this->id
        . "codigo: " . $this->codigo
        . "nombre: " .  $this->nombre
        . "telefono: " . $this->telefono
        . "email: " . $this->email
        . "direccion: " . $this->direccion
        . "simbolo_moneda: " . $this->simbolo_moneda
        . "anio: " . $this->anio
        . "id_usuario: " . $this->id_usuario;
    }

    //CODIGO SQL

}

?>