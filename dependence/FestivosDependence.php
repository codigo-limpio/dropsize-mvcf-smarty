<?php

defined('_DSEXEC') or die;

final class FestivosDependence {

    public static function init() {

        return array(
            "Archivos" => array(
                "Business" => array(),
                "Dao" => array(),
                "Utils" => array(
                    FPATH_LIBRARIES . '/Smarty/libs/Smarty.class',
                    FPATH_LIBRARIES . '/FDSSmarty'
                )
            )
        );
    }

    public static function listar() {

        return array(
            "Archivos" => array(
                "Business" => array(),
                "Dao" => array(),
                "Utils" => array()
            )
        );
    }

    public static function Listardb() {

        return array(
            "Archivos" => array(
                "Business" => array(),
                "Dao" => array(
                    FPATH_DAO . "/Conexion"
                ),
                "Utils" => array(
                    FPATH_LIBRARIES . "/UnicodeUtf8Replace",
                    FPATH_LIBRARIES . "/DPManagerJSON",
                    FPATH_LIBRARIES . "/DPManager"
                )
            )
        );
    }

}
