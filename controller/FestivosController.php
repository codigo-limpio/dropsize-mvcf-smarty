<?php

defined('_DSEXEC') or die;

class FestivosController extends Controller {

    protected $BO;
    protected $BOHOLA;

    public function __construct($args) {
        parent::__construct($args);
        $this->BO = new FestivosBusiness($this->getModelo());
    }

    public function Init() {

        if ($this->HasAccess()) {
            $this->BO->Init();
        } else {
            throw new Exception("No existe modelo que cargar");
        }
    }

    public function Listar() {

        if ($this->HasAccess()) {
            $this->BO->Listar();
        } else {
            throw new Exception("No existe modelo que cargar");
        }
    }

    public function Listardb() {

        if ($this->HasAccess()) {
            $con = new Conexion();
            $this->BO->setCon($con);
            $this->BO->Listardb();
        } else {
            throw new Exception("No existe modelo que cargar");
        }
    }

}
