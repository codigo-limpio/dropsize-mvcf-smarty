<?php

defined('_DSEXEC') or die;

class IndexBusiness {

    protected $modelo;
    public $con;

    public function __construct($modelo) {

        $this->setModelo($modelo);
    }

    public function setModelo($modelo) {
        $this->modelo = $modelo;
    }

    public function Init() {
        
        FDSSmarty::init();
        
        FDSSmarty::asignar("title", "Codigo Limpio es Dropsize MVCf");
        FDSSmarty::verifica_template(FPATH_TEMPLATES . "/index.tpl");
        FDSSmarty::load_set_template();
    }

}
