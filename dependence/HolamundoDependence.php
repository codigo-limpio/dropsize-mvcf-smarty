<?php

defined('_DSEXEC') or die;

final class HolamundoDependence {

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

    public static function isaac() {

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

}
