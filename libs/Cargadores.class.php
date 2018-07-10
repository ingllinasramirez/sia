<?php
class Cargadores {

    //put your code here
    public static function registrar() {
        spl_autoload_register('Cargadores::cargarModelosDatos');
        spl_autoload_register('Cargadores::cargarClasesPrincipales');
    }

    public static function cargarModelosDatos($clase) {
        $dirModelo = self::buscarModelos($clase, DIR_MODELOS);
        if (is_file($dirModelo)):
            include $dirModelo;
        endif;
    }
    
    public static function cargarClasesPrincipales($clase) {
        $dirModelo = self::buscarModelos($clase, DIR_LIBRERIA);
        if (is_file($dirModelo)):
            include $dirModelo;
        endif;
    }

    public static function buscarModelos($clase, $ruta) {
        $listDireccionCarpetas = self::buscarCarpetas($ruta);
        foreach ($listDireccionCarpetas as $directorio):
            $dirModelo = $directorio . $clase . '.class.php';
            if (is_file($dirModelo)):
                return $dirModelo;
            endif;
        endforeach;
    }

    public static function cargarModelos($directorio) {
        if (is_dir($directorio)):
            $listArchivos = self::buscarArchivos(array($directorio));
            foreach ($listArchivos as $archivo):
                require_once $archivo;
            endforeach;

            $listDireccionCarpetas = self::buscarCarpetas($directorio);
            $listArchivos = self::buscarArchivos($listDireccionCarpetas);
            foreach ($listArchivos as $archivo):
                require_once $archivo;
            endforeach;
        endif;
    }

    private static function buscarCarpetas($directorio) {
        $listDireccionCarpetas = [];
        if (is_dir($directorio)):
            $openDirectorio = scandir($directorio);
            foreach ($openDirectorio as $key => $componente):
                if (!in_array($componente, array('.', '..'))):
                    if (is_dir($directorio . $componente)):
                        array_push($listDireccionCarpetas, $directorio . $componente . '/');
                    endif;
                endif;
            endforeach;
        endif;
        return $listDireccionCarpetas;
    }

    private static function buscarArchivos($listDireccionCarpetas) {
        $listArchivos = [];
        foreach ($listDireccionCarpetas as $carpetas):
            if (is_dir($carpetas)):
                $openCarpetas = scandir($carpetas);
                foreach ($openCarpetas as $key => $clase):
                    if (!in_array($clase, array('.', '..'))):
                        if (is_file($carpetas . $clase)):
                            array_push($listArchivos, $carpetas . $clase);
                        endif;
                    endif;
                endforeach;
            endif;
        endforeach;
        return $listArchivos;
    }

}
Cargadores::registrar();
