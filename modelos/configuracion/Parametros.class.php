<?php


class Parametros {

    //put your code here
    public static function datos($parametroID) {
        $sqlQuery = ParametrosSQL::DATOS_COMPLETOS . " WHERE BDPrincipal.Parametros.parametroID = ? ";
        return BDPrincipal::consultar($sqlQuery, array($parametroID));
    }
    
    public static function todos() {
        $sqlQuery = ParametrosSQL::DATOS_COMPLETOS; 
        return BDPrincipal::consultar($sqlQuery, array());
    }
    
    public static function valor($codigoParametro) {
        $sqlQuery =  ParametrosSQL::DATOS_COMPLETOS . " WHERE BDPrincipal.Parametros.parametroCODIGO = ?; ";
        $Parametro = BDPrincipal::datos($sqlQuery, array($codigoParametro));
        switch ($Parametro->parametroTIPO) {
            case 'COLABORADOR':
                return Colaboradores::porId($Parametro->parametroVALOR);
                break;
            default:
                return $Parametro->parametroVALOR;
                break;
        }
        return null;
    }
    
    public static function tipos() {
        $sqlQuery = ParametrosSQL::TIPOS_PARAMETROS;
        $consulta = BDPrincipal::datos($sqlQuery, array());
        $tipos = explode("','",substr($consulta->Type,6,-2));
        return $tipos;
    }
    
    public static function guardar( $parametroTIPO, $parametroCODIGO, $parametroTITULO, $parametroDESCRIPCION, $parametroVALOR) {
        $sqlQuery = ParametrosSQL::CREAR_REGISTRO;
        return BDPrincipal::crear($sqlQuery, array(
               $parametroTIPO, $parametroCODIGO, $parametroTITULO, $parametroDESCRIPCION, $parametroVALOR, Cliente::usuarioID()
                )
        );
    }
    
    public static function actualizar( $parametroID ,$parametroTIPO, $parametroCODIGO, $parametroTITULO, $parametroDESCRIPCION, $parametroVALOR) {
        $sqlQuery = ParametrosSQL::ACTUALIZAR_REGISTRO;
        return BDPrincipal::actualizar($sqlQuery, array(
               $parametroTIPO, $parametroCODIGO, $parametroTITULO, $parametroDESCRIPCION, $parametroVALOR, Cliente::usuarioID(), $parametroID
                )
        );
    }
    
        /**
     * Recibe un identificador de ControlConsecutivos y elimina el registro.
     * @param int $consecutivosID Identificador del registro
     * ha eliminar.
     * @return int Cantidad de registros eliminados
     */
    public static function eliminar($parametroID) {
        $sqlQuery = ParametrosSQL::ELIMINAR_REGISTRO;
        return BDPrincipal::actualizar($sqlQuery, array($parametroID));
    }
}
