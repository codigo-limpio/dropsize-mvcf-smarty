<?php

defined('_DSEXEC') or die;

final class TarifaModel {

    private static $id;

    public function __construct() {
        self::$id = "id";
    }

    public function init() {
        $args = func_get_args();
        return array("ID" => self::$id
            , "Metodo" => "GET"
            , "Tipo" => "Seguros"
            , "Index" => array()
            , "Alias" => array()
            , "Params" => $args[0]
            , "Seguros" => $args[1]
        );
    }

    // x=1
    // y=2
    // nombre=Coral
    // usuario=Jefe
    
    public function Actualizar() {
        $args = func_get_args();
        return array("ID" => self::$id
            , "Metodo" => "GET"
            , "Tipo" => "Seguros"
            , "Index" => array()
            , "Alias" => array()
            , "Params" => $args[0]
            , "Seguros" => $args[1]
        );
    }

    public function Agregar() {
        $args = func_get_args();
        return array("ID" => self::$id
            , "Metodo" => "GET"
            , "Tipo" => "Seguros"
            , "Index" => array()
            , "Alias" => array()
            , "Params" => $args[0]
            , "Seguros" => $args[1]
        );
    }

    public function Consultar() {
        $args = func_get_args();
        return array("ID" => self::$id
            , "Metodo" => "GET"
            , "Tipo" => "Seguros"
            , "Index" => array()
            , "Alias" => array()
            , "Params" => $args[0]
            , "Seguros" => $args[1]
        );
    }

}
