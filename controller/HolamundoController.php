<?php

defined('_DSEXEC') or die;

class HolamundoController extends Controller {

    protected $BO;

    public function __construct($args) {
        parent::__construct($args);
        $this->BO = new HolamundoBusiness($this->getModelo());
    }

    public function Init() {

        if ($this->HasAccess()) {
            $this->BO->Init();
        } else {
            throw new Exception("No existe modelo que cargar");
        }
    }
    
    public function Isaac() {

        if ($this->HasAccess()) {
            $this->BO->Isaac();
        } else {
            throw new Exception("No existe modelo que cargar");
        }
    }

}
