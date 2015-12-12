<?php

defined('_DSEXEC') or die;

final class TarifaDependence {

    public static function init() {

        return array(
            "Archivos" => array(
                "Business" => array(
                    FPATH_BUSINESS . DIRECTORY_SEPARATOR . 'HolamundoBusiness'
                ),
                "Dao" => array(),
                "Utils" => array(
                    FPATH_LIBRARIES . '/Smarty/libs/Smarty.class',
                    FPATH_LIBRARIES . '/FDSSmarty'
                )
            )
        );
    }

    public static function Agregar() {

        return array(
            "Archivos" => array(
                "Business" => array(),
                "Dao" => array(),
                "Utils" => array(
                )
            )
        );
    }

    public static function Actualizar() {

        return array(
            "Archivos" => array(
                "Business" => array(),
                "Dao" => array(),
                "Utils" => array(
                )
            )
        );
    }

    public static function Consultar() {

        return array(
            "Archivos" => array(
                "Business" => array(),
                "Dao" => array(),
                "Utils" => array(
                )
            )
        );
    }

}
