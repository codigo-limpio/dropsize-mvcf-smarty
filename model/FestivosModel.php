<?php

defined('_DSEXEC') or die;

final class FestivosModel {

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

    public function listar() {
        $args = func_get_args();
        return array("ID" => self::$id
            , "Metodo" => "POST"
            , "Tipo" => "Seguros"
            , "Index" => array()
            , "Alias" => array()
            , "Params" => $args[0]
            , "Seguros" => $args[1]
        );
    }

    public function Listardb() {
        $args = func_get_args();
        return array("ID" => self::$id
            , "Metodo" => "POST"
            , "Tipo" => "Seguros"
            , "Index" => array("id_festivo", "fecha")
            , "Alias" => array("fecha" => "date_format(fecha, '%d/%m/%Y')")
            , "Params" => $args[0]
            , "Seguros" => $args[1]
        );
    }

}
