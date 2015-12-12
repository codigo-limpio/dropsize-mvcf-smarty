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
 * Manejador de Querys, Construye querys a partir de parametros
 * 
 * @package com.dropsizemvcf
 * @author  Isaac Trenado
 * @since   1.0.0
 */
class DPManager extends DPManagerJSON {

    private static $recordSet;
    private static $row;
    private static $field;
    private static $affectedRows;
    private static $Insert_ID;
    private static $query;

    public static function buildDatosToUpdate($parModelo) {
        $larCampos = array();
        foreach ($parModelo as $k => $field) {
            array_push($larCampos, $k . ' = ' . $field);
        }

        return implode(",", $larCampos);
    }

    public static function buildSelectQuery($fields, $table, $where = false
    , $groupBy = false, $orderBy = false, $order = false, $limit = false) {
        self::$query = 'SELECT ' . $fields . ' FROM ' . $table;
        if (isset($where) && $where != '')
            self::$query .= ' WHERE ' . $where;
        if (isset($groupBy) && $groupBy != '')
            self::$query .= ' GROUP BY ' . $groupBy;
        if (isset($orderBy) && $orderBy != '')
            self::$query .= ' ORDER BY ' . $orderBy;
        if (isset($order) && $order != '')
            self::$query .= ' ' . $order;
        if (isset($limit) && $limit != '')
            self::$query .= $limit;

        return self::$query;
    }

    public static function buildDeleteQuery($table, $where = false) {
        self::$query = 'DELETE FROM ' . $table;
        if (isset($where) && $where != '')
            self::$query .= ' WHERE ' . $where;
        return self::$query;
    }

    public static function buildInsertQuery($fields, $table) {
        self::$query = 'INSERT INTO ' . $table . ' ( ' . implode(',', array_keys($fields)) . ') VALUES (' . implode(",", array_values($fields)) . ')';
        return utf8_decode(self::$query);
    }

    public static function buildUpdateQuery($table, $fields, $where) {
        self::$query = 'UPDATE ' . $table . ' SET ' . $fields . ' WHERE ' . $where;
        return utf8_decode(self::$query);
    }

    public static function getAllRows($lobCon, $query) {
        self::$recordSet = $lobCon->Execute($query);

        return self::$recordSet;
    }

    public static function getRow($lobCon, $query) {
        self::$row = $lobCon->GetRow($query);
        return self::$row;
    }

    public static function getField($lobCon, $query) {
        self::$field = $lobCon->GetOne($query);
        return self::$field;
    }

    public static function insert($lobCon, $query) {

        if ($lobCon->Execute($query) === false) {
            return 0;
        } else {
            self::$Insert_ID = $lobCon->Insert_ID();
            return self::$Insert_ID;
        }
    }

    public static function update($lobCon, $query) {
        if ($lobCon->Execute($query) === false) {
            return 0;
        } else {
            self::$affectedRows = $lobCon->Affected_Rows();
            return self::$affectedRows;
        }
    }

    public static function delete($lobCon, $query) {

        if ($lobCon->Execute($query) === false) {
            return 0;
        } else {
            self::$affectedRows = $lobCon->Affected_Rows();
            return self::$affectedRows;
        }
    }

}
