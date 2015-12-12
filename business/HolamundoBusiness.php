<?php
defined('_DSEXEC') or die;

class HolamundoBusiness {

    protected $modelo;
    public $con;

    public function __construct($modelo) {

        $this->setModelo($modelo);
    }

    public function setModelo($modelo) {
        $this->modelo = $modelo;
    }

    public function Init() {

        #Hook
        ?>
        <h1>HolaMundo</h1>
        <p>Parrafo</p>
        <?php
        $date = date("Y-m-d");

        echo $date;
        echo "<br />";
    }
    
    public function Isaac() {

        echo "Ahora esta respondiendo : ";
        echo "<br />";
        echo __CLASS__;
        echo "<br />";
        echo __METHOD__;
        echo "<br />";
        echo __FILE__;
        echo "<br />";
    }

}
