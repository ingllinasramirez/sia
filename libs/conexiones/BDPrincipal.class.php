<?php

class BDPrincipal extends PDO {
    
    public $HOST;
    public $BD_NAME;
    public $BD_NAME_LOG;
    public $BD_USER;
    public $BD_PASSWORD;
    
    public static $instancia;
    
    public $dsn;  public $username;  public $password;  public $options;
    
    private function bdLocal() {
        $this->HOST = '192.185.163.40';
        $this->BD_NAME = 'siaonecl_principal';
        $this->BD_USER =  'siaonecl_admin';
        $this->BD_PASSWORD =  '(t@htxzZEbD{';
    }
    
    private function bdGoogle() {
        $this->HOST = '35.198.46.145';
        $this->BD_NAME = 'sicam_principal';
        $this->BD_USER =  'admsicam';
        $this->BD_PASSWORD =  'wv8t133w3c5';
    }  
    
    public function __construct() {
        $this->bdLocal();
        $this->dsn = 'mysql:dbname=' . $this->BD_NAME.';host=' . $this->HOST . '';
        $this->username = $this->BD_USER;
        $this->password = $this->BD_PASSWORD;
        $this->options = array( PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8  ", PDO::ATTR_PERSISTENT => false );
        try {
            parent::__construct($this->dsn, $this->username, $this->password, $this->options);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Conexion Principal:" ."<br />";
            echo "Cadena de Coneción:" . $this->dsn ."<br />";
            echo 'ERROR: ' . $e->getMessage() ."<br />";
            echo "Conexion desde la IP:". getHostByName(getHostName());
            die(); 
        }
    }
    
    public static function singleton() {
        if (empty(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }
    
    public static function iniciarTransaccion(){
        $conexion = self::singleton();
        if( !$conexion->inTransaction() ){
            $conexion->beginTransaction();
        }
    }
    
    public static function grabarTransaccion(){
        $conexion = self::singleton();
        if( $conexion->inTransaction() ){
            $conexion->commit();
        }
    }
    
    public static function cancelarTransaccion(){
        $conexion = self::singleton();
        if( $conexion->inTransaction() ){
            $conexion->rollBack();
        }
    }

    public static function datos($sqlQuery, $datosQuery = array() ) {
        $sqlQuery = self::formatearConsulta($sqlQuery);
        $conexion = self::singleton();
        try {
            //$conexion->beginTransaction();
            $sentenciaSql = $conexion->prepare($sqlQuery);
            $sentenciaSql->execute($datosQuery);
            $datos = $sentenciaSql->fetch(PDO::FETCH_OBJ);
            //$conexion->commit();
            if (!empty($datos)) {
                return $datos;
            }
            return NULL;
        } catch (PDOException $error) {
             if( $conexion->inTransaction() ){
                $conexion->rollBack();
            }
            throw $error;
        }
    }

    public static function consultar($sqlQuery, $datosQuery = array() ) {
        $sqlQuery = self::formatearConsulta($sqlQuery);
        $conexion = self::singleton();
        try {
            // $conexion->beginTransaction();
            $sentenciaSql = $conexion->prepare($sqlQuery);
            $sentenciaSql->execute($datosQuery);
            $datos = $sentenciaSql->fetchAll(PDO::FETCH_OBJ);
            // $conexion->commit();
            if (!is_null($datos)) {
                return $datos;
            }
            return NULL;
        } catch (PDOException $error) {
            if( $conexion->inTransaction() ){
                $conexion->rollBack();
            }
            throw $error;
        }
    }

    public static function crear($sqlQuery, $datosQuery = array() ) {
        $sqlQuery = self::formatearConsulta($sqlQuery);
        $conexion = self::singleton();
        try {            
            //$conexion->beginTransaction();
            $sentenciaSql = $conexion->prepare($sqlQuery);
            $sentenciaSql->execute($datosQuery);
            $ultimoInsert = $conexion->lastInsertId();
            //$conexion->commit();
            if (!is_null($ultimoInsert)) {
                return $ultimoInsert;
            }
            return NULL;
        } catch (PDOException $error) {
            if( $conexion->inTransaction() ){
                $conexion->rollBack();
            }
            throw $error;
        }
    }

    public static function actualizar($sqlQuery, $datosQuery = array() ) {
        $sqlQuery = self::formatearConsulta($sqlQuery);
        $conexion = self::singleton();
        try {
            //$conexion->beginTransaction();
            $sentenciaSql = $conexion->prepare($sqlQuery);
            $sentenciaSql->execute($datosQuery);
            $modificados = $sentenciaSql->rowCount();
            //$conexion->commit();
            if (!is_null($modificados)) {
                return $modificados;
            }
            return NULL;
        } catch (PDOException $error) {
             if( $conexion->inTransaction() ){
                $conexion->rollBack();
            }
            throw $error;
        }
    }
    
    public static function formatearConsulta($sqlQuery){
        $variables = array('BDPrincipal');
        $datos = array( self::singleton()->BD_NAME );
        return str_replace( $variables, $datos, $sqlQuery );
        return $sqlQuery;
    }
    
}