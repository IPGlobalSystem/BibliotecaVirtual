<?php

class libro{

    private $codigo;
    private $titulo;
    private $pais;
    private $year;
    private $editorial;
    private $edicion;
    private $empresa;
    private $categoria;
    private $proveedor;
    private $precio;
    private $ejemplares;
    private $ubicacion;
    private $resumen;
    private $imagen;
    private $pdf;
    private $optionsPDF;   
    private $db;

    ////CONSTRUCT////
    public function __construct(){
        $this->db = Database::connect();
    }

    ////GETTERS////
    public function getCodigo(){
        return $this->codigo;
    }

    public function getTitulo(){
        return $this->titulo;
    }

    public function getPais(){
        return $this->pais;
    }

    public function getYear(){
        return $this->year;
    }

    public function getEditorial(){
        return $this->editorial;
    }

    public function getEdicion(){
        return $this->edicion;
    }

    public function getEmpresa(){
        return $this->empresa;
    }

    public function getCategoria(){
        return $this->categoria;
    }

    public function getProveedor(){
        return $this->proveedor;
    }

    public function getPrecio(){
        return $this->precio;
    }

    public function getEjemplares(){
        return $this->ejemplares;
    }

    public function getUbicacion(){
        return $this->ubicacion;
    }

    public function getResumen(){
        return $this->resumen;
    }

    public function getImagen(){
        return $this->imagen;
    }

    public function getPdf(){
        return $this->pdf;
    }

    public function getOptionsPDF(){
        return $this->optionsPDF;
    }

    ////SETTERS////
    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }

    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }

    public function setPais($pais){
        $this->pais = $pais;
    }

    public function setYear($year){
        $this->year = $year;
    }

    public function setEditorial($editorial){
        $this->editorial = $editorial;
    }

    public function setEdicion($edicion){
        $this->edicion = $edicion;
    }

    public function setEmpresa($empresa){
        $this->empresa = $empresa;
    }

    public function setCategoria($categoria){
        $this->categoria = $categoria;
    }

    public function setProveedor($proveedor){
        $this->proveedor = $proveedor;
    }

    public function setPrecio($precio){
        $this->precio = $precio;
    }
    
    public function setEjemplares($ejemplares){
        $this->ejemplares = $ejemplares;
    }

    public function setUbicacion($ubicacion){
        $this->ubicacion = $ubicacion;
    }

    public function setResumen($resumen){
        $this->resumen = $resumen;
    }

    public function setImagen($imagen){
        $this->imagen = $imagen;
    }

    public function setPdf($pdf){
        $this->pdf = $pdf;
    }

    public function setOptionsPDF($optionsPDF){
        $this->optionsPDF = $optionsPDF;
    }
}

?>