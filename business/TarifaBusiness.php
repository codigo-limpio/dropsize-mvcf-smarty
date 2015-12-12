<?php

defined('_DSEXEC') or die;

class TarifaBusiness {

    protected $modelo;
    public $con;

    public function __construct($modelo) {

        $this->setModelo($modelo);
    }

    public function setModelo($modelo) {
        $this->modelo = $modelo;
    }

    public function Init() {

        $a = 1 + 5;

        FDSSmarty::init();
        FDSSmarty::asignar("nombre", "SuperChinazoPoderoso");
        FDSSmarty::asignar("resultado", $a);
        FDSSmarty::asignar("marca", "Nokia");
        FDSSmarty::verifica_template(FPATH_TEMPLATES . "/curso.tpl");
        FDSSmarty::load_set_template();

        //echo "Index";
        //echo "<br />";
        #/tarifa/index.php
        #/tarifa/agregar.php 
        #/tarifa/actualizar.php
        //$this->Consultar();
        //$this->Actualizar();
        //$this->Agregar();
    }

    public function Consultar() {

        echo "Consultar";
        echo "<br />";
    }

    public function Actualizar() {

        echo "Actualizar";
        echo "<br />";

        echo "<pre>";
        print_r($_GET);
        echo "</pre>";
        echo "<br />";
    }

    public function Agregar() {

        echo "Agregar";
        echo "<br />";
    }

}
