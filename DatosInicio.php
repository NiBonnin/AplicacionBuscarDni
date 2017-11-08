<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DatosInicio
 *
 * @author Nico
 */
include_once('IDatos.php');

class DatosInicio implements IDatos {
    public function getDatos($page,$dni){
        $cuil ='/([0-9]{2})('.'-'.$dni.'-'.')([0-9]{1})/';
        preg_match($cuil,$page,$matches,PREG_OFFSET_CAPTURE);
        
        $datos[0]= $matches[0][0];
        
        $posIni = strpos($page, 'title>');
        $posFin = (strpos($page, '- CUIT') - $posIni);
        $pageRecortada = substr($page, ($posIni+ 6), $posFin);
        $pageRecortada = substr($pageRecortada, 0, -7);
        
        $posInicioApellido = strripos($pageRecortada, ' ');
        $apellido = substr($pageRecortada, $posInicioApellido);
        $nombre = substr($pageRecortada,0,$posInicioApellido);
        
        $datos[1] = $apellido;
        $datos[2] = $nombre;
        
        return $datos;
    }
}
