<?php

class DPManagerJSON extends UnicodeUtf8Replace {

    private $conexion;
    private static $recordSet;
    private static $row;
    private static $field;
    private static $affectedRows;
    private static $Insert_ID;
    private static $query;

    public static function getEmptyJson($pstJson) {

        $empty = array("success" => true,
            "total" => 0,
            "rows" => array());

        return empty($pstJson) ? json_encode($empty) : UnicodeUtf8Replace::UnicodeReplace($pstJson);
    }

    public static function merge_in_array($parParams, $parIndex, &$larOtros) {

        $larRegreso = array();
        $larOtros = array();
        $larParams = $parParams;

        foreach ($larParams as $key => $valor) {

            $lstValor = $larParams[$key];

            if (in_array($key, $parIndex))
                $larRegreso[$key] = $lstValor;
            else {

                if (is_array($valor))
                    $larOtros[$key] = $lstValor;
                else {
                    $larOtros[$key] = sprintf("%s", $lstValor);
                }
            }
        }

        return $larRegreso;
    }

    public static function merge_array($parParams, $parIndex) {

        $larRegreso = array();
        $larParams = $parParams;

        foreach ($parIndex as $index => $valor) {

            if (isset($larParams[$valor])) {

                $lstValor = $larParams[$valor];
                $larRegreso[$valor] = sprintf("%s", $lstValor);
            } else
                $larRegreso[$valor] = "";
        }

        return $larRegreso;
    }

    public static function setSessionGroupConcatMaxLen($lobCon) {

        $query = "SET SESSION group_concat_max_len = 4294967295";

        return $lobCon->Execute($query);
    }

    private static function GroupConcat($parModelo, $pstExtra = false) {

        $larFields = array();
        $lnuTotal = sizeof($parModelo['Index']);
        $lnuRestante = $lnuTotal;
        $larAlias = isset($parModelo['Alias']) ? $parModelo['Alias'] : array();

        for ($i = 0; $i < $lnuTotal; $i++) {

            $lstCampo = $parModelo['Index'][$i];

            $lnuRestante = $lnuRestante - 1;

            if ($lnuRestante > 0) {
                $lstCampoConcat = 'CONCAT("\"' . $lstCampo
                        . '\":\"",' . ((array_key_exists($lstCampo, $larAlias)) ? $larAlias[$lstCampo] : $lstCampo) . ',"\",")';
            } else {
                $lstCampoConcat = 'CONCAT("\"' . $lstCampo
                        . '\":\"",' . ((array_key_exists($lstCampo, $larAlias)) ? $larAlias[$lstCampo] : $lstCampo) . ',"\"")';
            }

            array_push($larFields, $lstCampoConcat);
        }

        $lstGroupConcat = 'GROUP_CONCAT(CONCAT("{"),';
        $lstFields = implode(",", $larFields);

        $lstGroupConcat = $lstGroupConcat . $lstFields
                . $pstExtra . ',CONCAT("}"))';

        return $lstGroupConcat;
    }

    private static function GroupSingleArrayConcat($parModelo, $pstExtra = false) {

        $larFields = array();
        $lnuTotal = sizeof($parModelo['Index']);
        $lnuRestante = $lnuTotal;
        $larAlias = isset($parModelo['Alias']) ? $parModelo['Alias'] : array();

        for ($i = 0; $i < $lnuTotal; $i++) {

            $lstCampo = $parModelo['Index'][$i];

            $lnuRestante = $lnuRestante - 1;

            if ($lnuRestante > 0) {
                $lstCampoConcat = 'CONCAT("\"",' . ((array_key_exists($lstCampo, $larAlias)) ? $larAlias[$lstCampo] : $lstCampo) . ',"\",")';
            } else {
                $lstCampoConcat = 'CONCAT("\"",' . ((array_key_exists($lstCampo, $larAlias)) ? $larAlias[$lstCampo] : $lstCampo) . ',"\"")';
            }

            array_push($larFields, $lstCampoConcat);
        }

        $lstGroupConcat = 'GROUP_CONCAT(';
        $lstFields = implode(",", $larFields);

        $lstGroupConcat = $lstGroupConcat . $lstFields
                . $pstExtra . ')';

        return $lstGroupConcat;
    }

    private static function GroupSingleConcat($parModelo, $pstExtra = false) {

        $larFields = array();
        $lnuTotal = sizeof($parModelo['Index']);
        $lnuRestante = $lnuTotal;
        $larAlias = isset($parModelo['Alias']) ? $parModelo['Alias'] : array();

        for ($i = 0; $i < $lnuTotal; $i++) {

            $lstCampo = $parModelo['Index'][$i];

            $lnuRestante = $lnuRestante - 1;

            if ($lnuRestante > 0) {
                $lstCampoConcat = 'CONCAT("\"",' . ((array_key_exists($lstCampo, $larAlias)) ? $larAlias[$lstCampo] : $lstCampo) . ',"\",")';
            } else {
                $lstCampoConcat = 'CONCAT("\"",' . ((array_key_exists($lstCampo, $larAlias)) ? $larAlias[$lstCampo] : $lstCampo) . ',"\"")';
            }

            array_push($larFields, $lstCampoConcat);
        }

        $lstGroupConcat = 'GROUP_CONCAT("[",';
        $lstFields = implode(",", $larFields);

        $lstGroupConcat = $lstGroupConcat . $lstFields
                . $pstExtra . ',"]")';

        return $lstGroupConcat;
    }

    public static function buildSingleArrayFieldJsonTo($parModelo) {

        $lstJson = 'CONCAT("[",';

        $lstFields = self::GroupSingleArrayConcat($parModelo);

        $lstJson .= $lstFields . ', "]") AS json';

        return $lstJson;
    }

    public static function buildSingleFieldJsonTo($parModelo) {

        $lstJson = 'CONCAT("[",';

        $lstFields = self::GroupSingleConcat($parModelo);

        $lstJson .= $lstFields . ', "]") AS json';

        return $lstJson;
    }

    public static function buildSingleJsonTo($parModelo, $pstExtra = false) {

        $lstJson = 'CONCAT("[",';

        $lstFields = self::GroupConcat($parModelo, $pstExtra);

        $lstJson .= $lstFields . ', "]") AS json';

        return $lstJson;
    }

    public static function buildDatosJsonTo($parModelo, $pstTable, $pstWhere, $pstExtra = false) {

        $lstJson = sprintf('CONCAT("{\"success\":true,\"total\":\"",'
                . '(SELECT COUNT(*) FROM %s WHERE %s),"\",", "\"rows\":[",'
                , $pstTable, $pstWhere);

        $lstFields = self::GroupConcat($parModelo, $pstExtra);

        $lstJson .= $lstFields . ', "]}") AS json';

        return $lstJson;
    }

    public static function buildDatosTo($parModelo, &$larOtros = array()) {

        $tipo = isset($parModelo['Tipo']) ? $parModelo['Tipo'] : "None";
        $larParams = isset($parModelo[$tipo]) ? $parModelo[$tipo] : array();
        $larIndex = isset($parModelo['Index']) ? $parModelo['Index'] : array();

        self::merge_in_array($larParams, $larIndex, $larOtros);

        return self::merge_array($larParams, $larIndex);
    }

}
