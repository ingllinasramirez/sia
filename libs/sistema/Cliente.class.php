<?php

class Cliente {
     

    public static function estaLogueado() {
        SesionCliente::abrir();
        $ObjUSER = SesionCliente::valor(SESION);
        SesionCliente::cerrar();
        if($ObjUSER){
            return true;
        }
        return false;
        
    }
    public static function abrirSesion($usuario, $desde = null, $ip = null) {
        SesionCliente::valor(SESION, $usuario);
        SesionCliente::valor('SESION_ESTADO', $desde);
        SesionCliente::valor('SESION_IP', $ip);
        Usuarios::registrarLogin( Cliente::ip(), Cliente::latitud(), Cliente::longitud());
        return SesionCliente::valor(SESION);
    }
    public static function cerrarSesion() {
        SesionCliente::destruir();
    }

    public static function estadoSesion() {
        if (!empty($_SESSION['SESION_ESTADO'])):
            return $_SESSION['SESION_ESTADO'];
        else:
            return null;
        endif;
    }

    public static function is_inactividad() {
        if (!empty($_SESSION['SESION_ESTADO'])):
            if ($_SESSION['SESION_ESTADO'] == 'INACTIVIDAD'):
                return true;
            else:
                return false;
            endif;
        else:
            return $_SESSION['SESION_ESTADO'];
        endif;
    }
    
    public static function latitud($latitud = null) {
        return SesionCliente::valor('LATITUD', $latitud);
    }
    public static function longitud($longitud = null) {
        return SesionCliente::valor('LONGITUD', $longitud);
    }
    static function ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP')) {
            $ipaddress = getenv('HTTP_CLIENT_IP');
        } else if (getenv('HTTP_X_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR'); 
        } else if (getenv('HTTP_X_FORWARDED')) {
            $ipaddress = getenv('HTTP_X_FORWARDED');
        } else if (getenv('HTTP_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        } else if (getenv('HTTP_FORWARDED')) {
            $ipaddress = getenv('HTTP_FORWARDED');
        } else if (getenv('REMOTE_ADDR')) {
            $ipaddress = getenv('REMOTE_ADDR');
        } else {
            
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
                $ipaddress = $_SERVER['REMOTE_ADDR'];
            } else {
                $ipaddress = 'DESCONOCIDA';
            }
        }
        return $ipaddress;
    }
    public static function esAdministrador() {
        if (self::estaLogueado()):
            $dato = SesionCliente::activa()->usuarioADMINISTRADOR;
            if($dato == 'SI'):
                return true;
            endif;
        endif;
        return false;
    }
    
    public static function dato($atributo) {
        if (self::estaLogueado()):
            $dato = SesionCliente::dato($atributo);
            return $dato;
        endif;
        
    }
    public static function datoSession($nombre, $valor = NULL) {
        return SesionCliente::valor($nombre, $valor);
    }
    
    static function comoInvitado() {
        $_SESSION['INVITADO'] = 1;
    }

    static function esInvitado() {
        if ($_SESSION['INVITADO'] == 1):
            return true;
        else:
            return false;
        endif;
        
    }

    static function dioPermisoGoogle() {
        global $auth;
        try{
            $payload = $auth->getPayload();
            return isset($payload['email']);
        }catch (Exception $e) {
            return false;
        }
        return false;
    }
    
    static function emailPermisoGoogle() {
        global $auth;
        $payload = $auth->getPayload();
        return ($payload['email']);
    }
    
    static function codigoRedireccion() {
        global $auth;
        if ($auth->checkRedirectCode()) {
            if (isset($_GET['code'])) {
                return $_GET['code'];
            } else {
                return FALSE;
            }
        }
        return FALSE;
    }
    static function codigoRedireccionValido() {
        global $auth;
        if ($auth->checkRedirectCode()) {
            if (isset($_GET['code'])) {
                $payload = $auth->getPayload();
                return isset($payload['email']);
            } else {
                return false;
            }
        }
        return false;
    }

    static function cargarDatosUsuario($correo = null) {
        $Usuario = Usuarios::porUsername(is_null($correo) ? self::correo() : $correo);
        if (!empty($Usuario)) {
            //$_SESSION['Usuario'] = $Usuario;
            $_SESSION[SESION] = Colaboradores::datosCompletosPorUsuario($Usuario->usuarioID);
            //$_SESSION['INVITADO'] = 0;
        }
        return null;
    }

    static function urlGoogleLoguearse() {
        global $auth;
        return $auth->getAuthUrl();
    }

    public static function valor($nombreSesion) {
        if (isset($_SESSION[$nombreSesion])):
            $sesion = $_SESSION[$nombreSesion];
            return $sesion;
        endif;
        return null;
    }

    public static function actualizar($nombreSesion, $valorSesion) {
        $_SESSION[$nombreSesion] = $valorSesion;
        return $_SESSION[$nombreSesion];
    }

    public static function objetoUsuario() {
        if (isset($_SESSION[SESION])):
            return self::get(SESION);
        endif;
        return null;
    }

    
    public static function registroIP($usuario) {
        self::set('IP', $usuario);
        return self::get('IP');
    }

    
    public static function tienePermiso($codigoOperacion) {
        // $permisosDefault = [ 'iniciarSesion', 'cerrarSesion' ];
        // if (!in_array($codigoOperacion, $permisosDefault) and !empty(self::getUsuario())):
        //     if(!Cliente::esAdministrador()):
        //         if(ControlAcceso::porIp(self::getUsuario())):
        //             if(ControlAcceso::delUsaurioPorCodigoOperacion(self::dato('usuarioID'), $codigoOperacion)):
        //                 return true;
        //             else:
        //                 return false; 
        //             endif;
        //         else:
        //             return false; 
        //         endif;
        //     else:
        //         return true;
        //     endif;
        // else:
            return true;
        // endif;
    }
    
    public static function apiTienePermiso($codigoOperacion , $usuario, $ip=null) {
        // $permisosDefault = [];
        // if (!in_array($codigoOperacion, $permisosDefault) and !empty($usuario)):
        //     if(ControlAcceso::porIp($usuario , $ip)):
        //         //if(ControlAcceso::delUsaurio($usuario->usuarioID, $codigoOperacion)):
        //         if(true):
        //             return true;
        //         else:
        //             return false; 
        //         endif;
        //     else:
        //         return false; 
        //     endif;
        // else:
            return true;
        // endif;
    }

}
