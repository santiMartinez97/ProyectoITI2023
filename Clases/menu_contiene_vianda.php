<?php
class Menu {
    private $con;
    protected $IDMenu;
    private $IDVianda;

    public function __construct($pdo,$IDMenu ,$IDVianda) {
        $this->con = $pdo;
        $this->IDMenu = $IDMenu;
        $this->IDVianda = $IDVianda;
    }

    public function getIDMenu() {
        return $this->IDMenu;
    }

    public function setIDMenu($IDMenu) {
        $this->IDMenu = $IDMenu;
    }

    public function getIDVianda() {
        return $this->IDVianda;
    }

    public function setIDVianda($IDVianda) {
        $this->IDVianda = $IDVianda;
    }
}
?>