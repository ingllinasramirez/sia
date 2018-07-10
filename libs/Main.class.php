<?php
require_once DIR_LIBRERIA.'Cargadores.class.php';
class Main {
    public static function init() {
        return self::twigConfigPlantilla(DIR_BASE.'plantilla/');
    }
    public static function twigConfigPlantilla($dirPlantilla) {
        $loader = new Twig_Loader_Filesystem($dirPlantilla);
        $twig = new Twig_Environment(
            $loader, array( 'debug' => true )
        );
        // $filter = new Twig_Filter('Parametro', function ($PARAMETRO) {
        //     return Parametros::valor($PARAMETRO);
        // });
        // $twig->addFilter($filter);
        $twig->addExtension(new Twig_Extension_Debug());
        return $twig;
    }
    public static function getGlobals() {
        SesionCliente::abrir();
        return array(
         'favicon' => 'favicon.tmpl.php',
         'login' => PLANTILLA_ACTIVA . 'login.tmpl.php',
         'dashboard' => PLANTILLA_ACTIVA . 'dashboard.tmpl.php',
         'mantenimiento' => PLANTILLA_ACTIVA . 'mantenimiento.tmpl.php',
         'bloqueo' => PLANTILLA_ACTIVA . 'bloqueo.tmpl.php',
         'inactividad' => PLANTILLA_ACTIVA . 'inactividad.tmpl.php',
         'estaLogueado' => Cliente::estaLogueado(),
         'isEstadoSesion' => Cliente::estadoSesion(),
         'session' => Cliente::objetoUsuario(),
         'estado_session' => Cliente::valor('ESTADO'),
         'session_desde' => SesionCliente::valor('LOGIN_DESDE'),
         'session_ip' => SesionCliente::valor('LOGIN_IP'),
         'enMantenimiento' => Parametros::valor('MODO_MANTENIMIENTO'),
         'hash_vista' => uniqid(),
         'URL_ARCHIVOS' => URL_ARCHIVOS,
        );
    }
}