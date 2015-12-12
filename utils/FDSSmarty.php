<?php

/**
 * DropsizeMVCf - extension of the SlimFramework and others tools
 *
 * @author      Isaac Trenado <isaac.trenado@codigolimpio.com>
 * @copyright   2013 Isaac Trenado
 * @link        http://dropsize.codigolimpio.com
 * @license     http://dropsize.codigolimpio.com/license.txt
 * @version     3.0.1
 * @package     DropsizeMVCf
 *
 * DropsizeMVCf - Web publishing software
 * Copyright 2015 by the contributors
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 * 
 * This program incorporates work covered by the following copyright and
 * permission notices:
 * 
 * DropsizeMVCf is (c) 2013, 2015 
 * Isaac Trenado - isaac.trenado@codigolimpio.com -
 * http://www.codigolimpio.com
 * 
 * Wherever third party code has been used, credit has been given in the code's comments.
 *
 * DropsizeMVCf is released under the GPL
 * 
 */
/**
 * This class help to generate complete html 
 * verify if exists a template, and show it
 * put all the variables through the method assign
 * 
 * @package com.dropsizemvcf.utils.fdropsizesmarty
 * @author  Isaac Trenado
 * @since   1.0.0
 */
defined('_DSEXEC') or die;

class FDSSmarty extends Smarty {

    private static $obSmarty = false;
    private static $lboExiste = false;
    private static $lstPathTemplate = "";
    protected static $larOptions = array("force" => false, "debug" => false
        , "caching" => false, "cache" => 120);

    public static function init($option = array()) {

        $options = array_merge(self::$larOptions, $option);

        $smarty = new Smarty;

        $smarty->force_compile = $options['force'];
        $smarty->debugging = $options['debug'];
        $smarty->caching = $options['caching'];
        $smarty->cache_lifetime = $options['cache'];

        $smarty->template_dir = FPATH_TEMPLATES;
        $smarty->compile_dir = FPATH_COMPILES;
        $smarty->config_dir = FPATH_CONFIGS;
        $smarty->cache_dir = FPATH_CACHE;

        self::$obSmarty = $smarty;
    }

    public static function asignar($pstVariable, $pstValor) {
        self::$obSmarty->assign($pstVariable, $pstValor);
    }

    public static function load_set_template() {

        self::$obSmarty->assign("title", FTITLE);

        if (self::$lboExiste) {
            self::fnDisplayView();
        } else {
            self::$obSmarty->assign("mensaje", "Archivo no encontrado");
            self::$obSmarty->display("404.tpl");
        }
    }

    private static function fnDisplayView() {

        $lstTemplate = self::$lstPathTemplate;
        self::$obSmarty->display($lstTemplate);
    }

    public static function verifica_template($pstTemplate) {

        self::$lstPathTemplate = $pstTemplate;

        if (@file_exists($pstTemplate)) {
            self::$lboExiste = true;
        } else {
            self::$lboExiste = false;
        }
    }

}
