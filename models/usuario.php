<?php 

class Usuario{
    private $id;
    private $tipoUsuario;
    private $numeroDocumento;
    private $nombre;
    private $apellidos;
    private $ocupacion;
    private $sexo;
    private $telefono;
    private $email;
    private $direccion;
    private $username;
    private $password;
    private $privilegio;
    private $estado;
    private $db;

    ///CONSTRUCTOR///
    public function __construct(){
        $this->db = Database::connect();
    }

    //// GETTER //// 
    public function getId(){
        return $this->id;
    }

    public function getTipoUsuario(){
        return $this->tipoUsuario;
    }

    public function getNumeroDocumento(){
        return $this->numeroDocumento;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getApellidos(){
        return $this->apellidos;
    }

    public function getOcupacion(){
        return $this->ocupacion;
    }

    public function getSexo(){
        return $this->sexo;
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

    public function getUsername(){
        return $this->username;
    }

    public function getPrivilegio(){
        return $this->privilegio;
    }

    public function getEstado(){
        return $this->estado;
    }

    public function getPassword(){
        return password_hash($this->db->real_escape_string($this->password),PASSWORD_BCRYPT,['cost'=>4]);
    }

    //// SETTER //// 
    public function setId($id){
        $this->id = $id;
    }

    public function setTipoUsuario($tipoUsuario){
        $this->tipoUsuario = $tipoUsuario;
    }

    public function setNumeroDocumento($numeroDocumento){
        $this->numeroDocumento = $this->db->real_escape_string($numeroDocumento);
    }

    public function setNombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    public function setApellidos($apellidos){
        $this->apellidos = $this->db->real_escape_string($apellidos);
    }

    public function setOcupacion($ocupacion){
        $this->ocupacion = $this->db->real_escape_string($ocupacion);
    }

    public function setSexo($sexo){
        $this->sexo = $sexo;
    }

    public function setTelefono($telefono){
        $this->telefono = $this->db->real_escape_string($telefono);
    }

    public function setEmail($email){
        $this->email = $this->db->real_escape_string($email);
    }

    public function setDireccion($direccion){
        $this->direccion = $this->db->real_escape_string($direccion);
    }

    public function setUsername($username){
        $this->username = $this->db->real_escape_string($username);
    }

    public function setPrivilegio($privilegio){
        $this->privilegio = $privilegio;
    }

    public function setEstado($estado){
        $this->estado= $estado;
    }

    public function setPassword($password){
        $this->password =  $this->db->real_escape_string($password);
    }

    //// TOSTRING //// 
    public function toString(){
        return 'Id:' . $this->id  
                . ', tipoUsuario:' . $this->tipoUsuario 
                . ', numeroDocumento:' . $this->numeroDocumento 
                . ', apellidos:' . $this->nombre 
                . ', apellidos:' . $this->apellidos 
                . ', ocupacion:' . $this->ocupacion 
                . ', sexo:' . $this->sexo 
                . ', telefono:' . $this->telefono
                . ', email:' . $this->email 
                . ', direccion:' . $this->direccion 
                . ', username:' . $this->username
                . ', privilegio:' . $this->privilegio
                . ', estado:' . $this->estado 
                . ', password:' . $this->getPassword();
    }

    public function getAll(){
        $sql="SELECT id, v_NumeroDocumento as numeroDocumento, v_Nombres as nombre, " 
        . " v_Apellidos as apellidos, v_Telefono as telefono, b_Estado as estado FROM USUARIO ";
        $usuarios=$this->db->query($sql);
        return $usuarios;
    }

    public function getOne(){
        $sql="SELECT id, v_TipoUsuario as tipoUsuario, v_NumeroDocumento as numeroDocumento, " 
        . " v_Nombres as nombre,"
        . " v_Apellidos as apellidos, v_Ocupacion as ocupacion, c_Sexo as sexo, v_Telefono as telefono, "
        . " v_Email as email, v_Direccion as direccion, v_Username as username, " 
        . " i_IdPrivilegio as privilegio, "
        . " b_Estado as estado FROM USUARIO WHERE id={$this->getId()}";
        $usuario=$this->db->query($sql);
        return $usuario->fetch_object();
    }

    public function save(){
        $sql="INSERT INTO usuario (v_TipoUsuario, v_NumeroDocumento, v_Nombres, v_Apellidos, v_Ocupacion, c_Sexo, v_Telefono, v_Email, v_Direccion, v_Username, v_Password, i_IdPrivilegio, b_Estado) ";
        $sql.="VALUES('admin', '{$this->numeroDocumento}', '{$this->nombre}','{$this->apellidos}','{$this->ocupacion}','{$this->sexo}','{$this->telefono}','{$this->email}','{$this->direccion}','{$this->username}','{$this->getPassword()}','{$this->privilegio}','1')";
        $save=$this->db->query($sql);

        $result=false;
        if($save){
            $result=true;
        }

        return $result;
    }


}

?>