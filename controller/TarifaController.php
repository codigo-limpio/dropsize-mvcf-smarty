<?php

defined('_DSEXEC') or die;

class TarifaController extends Controller {

    protected $BO;
    protected $BOHOLA;

    public function __construct($args) {
        parent::__construct($args);
        $this->BO = new TarifaBusiness($this->getModelo());
    }

    public function Init() {

        if ($this->HasAccess()) {

            // Incluir Modelos de Trabajo Multiples
            //$this->BOHOLA = new HolaMundoBusiness($this->getModelo());

            $this->BO->Init();
            //$this->BOHOLA->Init();
        } else {
            throw new Exception("No existe modelo que cargar");
        }
    }

    public function Consultar() {

        if ($this->HasAccess()) {
            $this->BO->Consultar();
        } else {
            throw new Exception("No existe modelo que cargar");
        }
    }

    public function Actualizar() {

        if ($this->HasAccess()) {
            $this->BO->Actualizar();
        } else {
            throw new Exception("No existe modelo que cargar");
        }
    }

    public function Agregar() {

        if ($this->HasAccess()) {
            $this->BO->Agregar();
        } else {
            throw new Exception("No existe modelo que cargar");
        }
    }

}
