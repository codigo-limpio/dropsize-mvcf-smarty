<?php

defined('_DSEXEC') or die;

class FestivosBusiness {

    protected $modelo;
    public $con;

    public function __construct($modelo) {

        $this->setModelo($modelo);
    }

    public function setModelo($modelo) {
        $this->modelo = $modelo;
    }

    public function setCon($con) {
        $this->con = $con;
    }

    public function Init() {

        $data = '[{
        "label": "java",
        "value": "Java"
    }, {
        "label": "perl",
        "value": "Perl"
    }, {
        "label": "ruby",
        "value": "Ruby"
    }]';

        FDSSmarty::init();
        FDSSmarty::asignar("title", "Aplicación Cliente Servidor");
        FDSSmarty::asignar("data", $data);
        FDSSmarty::verifica_template(FPATH_TEMPLATES . "/festivos.tpl");
        FDSSmarty::load_set_template();
    }

    public function Listar() {

        $app = Slim::getInstance();
        $app->response()->header("Content-Type", "application/json");

        echo '[{
        "label": "java",
        "value": "Java"
    }, {
        "label": "perl",
        "value": "Perl"
    }, {
        "label": "ruby",
        "value": "Ruby"
    }]';
    }

    public function Listardb() {
        $app = Slim::getInstance();
        $app->response()->header("Content-Type", "application/json");
        $con = $this->con;
        $modelo = $this->modelo;
        $con->setDebug(0);
        $lstFields = DPManager::buildSingleJsonTo($modelo);
        $lstComboQuery = DPManager::buildSelectQuery($lstFields, 'festivos');
        $lstResultCombo = DPManager::getField($con, $lstComboQuery);
        echo $lstResultCombo;
    }

}
