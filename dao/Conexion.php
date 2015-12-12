<?php

//namespace dao;

class Conexion {

    protected $driver;
    protected $host;
    protected $user;
    protected $passwd;
    protected $name;
    public $con;
    private static $instancia;

    public static function getInstance() {
        if (!self::$instancia instanceof self) {
            self::$instancia = new self;
        }
        return self::$instancia;
    }

    public function __construct() {
        $this->driver = "mysqli";
        $this->host = "localhost";
        $this->user = "root";
        $this->passwd = "";
        $this->name = "dropsize";
        $this->con = $this->Conexion();
    }

    public function Affected_Rows() {
        return $this->con->Affected_Rows();
    }

    public function Insert_ID() {
        return $this->con->Insert_ID();
    }

    public function Execute($pstQuery) {
        return $this->con->Execute($pstQuery);
    }

    public function GetOne($pstQuery) {
        return $this->con->GetOne($pstQuery);
    }

    public function GetRow($pstQuery) {
        return $this->con->GetRow($pstQuery);
    }

    public function setDebug($pboModo = 0) {
        return $this->con->debug = $pboModo;
    }

    public function RollbackTrans() {
        return $this->con->RollbackTrans();
    }

    public function CompleteTrans() {
        return $this->con->CompleteTrans();
    }

    public function UnixTimeStamp($pstDate) {
        return $this->con->UnixTimeStamp($pstDate);
    }

    public function Conexion() {

        require_once "adodb/adodb.inc.php";

        $con = ADONewConnection($this->driver);

        $con->Connect($this->host
                , $this->user, $this->passwd
                , $this->name);

        if ($con == false) {
            throw new Exception("Sin conexi&oacute;n.");
        } else {
            $con->SetFetchMode(ADODB_FETCH_ASSOC);
        }

        return $con;
    }

}
