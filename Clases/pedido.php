<?php
class Pedido {
    protected $ID;
    protected $pdo; // Objeto PDO para la conexión a la base de datos
    private $fecha;
    private $descripcion;

    public function __construct($pdo,$fecha, $descripcion) {
        $this->pdo = $pdo;
        $this->id = $id;
        $this->fecha = $fecha;
        $this->descripcion = $descripcion;
    
    }

    public function getID() {
        return $this->id;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setID($id) {
        $this->id = $id;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
}