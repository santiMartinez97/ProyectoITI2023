<?php  
  class ClienteWeb {
   
    protected $ci;
    protected $email;
    protected $password;
    protected $nombre;
    protected $apellido;
    protected $telefono;
    protected $calle;
    protected $numero;
    protected $esquina;
    protected $barrio;
  
    //$direccion = $calle + " " + $numero + " " + $esquina + " " + $barrio;

    public function __construct ($ci, $email, $password, $nombre, $apellido,$telefono,$calle,$numero,$esquina,$barrio){
       $this -> ci = $ci;
       $this -> email = $email;
       $this -> password = $password;
       $this -> nombre = $nombre;
       $this -> apellido = $apellido;
       $this -> telefono = $telefono;
       $this -> calle = $calle;
       $this -> numero = $numero;
       $this -> esquina = $esquina;
       $this -> barrio = $barrio;
    }

    public function getCi(){
        return $this -> ci;
    }

    public function setCi($ci){
        $this -> ci = $ci;
    }

    public function getEmail(){
        return $this -> email;
    }

    public function setEmail($email){
        $this -> email = $email;
    }

    public function getPassword(){
        return $this -> password;
    }

    public function setPassword($password){
        $this -> password = $password;
    }

    public function getNombre(){
        return $this -> nombre;
    }
    
    public function setNombre($nombre){
        $this -> nombre = $nombre;
    }

    public function getTelefono(){
        return $this -> telefono;
    }

    public function setTelefono($telefono){
        $this -> telefono = $telefono;
    }

    public function getCalle(){
        return $this -> calle;
    }

    public function setCalle($calle){
        $this -> calle = $calle;
    }

    public function getNumero(){
        return $this -> numero;
    }

    public function setNumero($numero){
        $this -> numero = $numero;
    }

    public function getEsquina(){
        return $this -> esquina;
    }

    public function setEsquina($esquina){
        $this -> esquina = $esquina;
    }

    public function getBarrio(){
        return $this -> barrio;
    }

    public function setBarrio($barrio) {
        $this -> barrio = $barrio;
    }
}  
    
?>