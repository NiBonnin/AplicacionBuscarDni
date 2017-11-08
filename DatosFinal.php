<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DatosFinal
 *
 * @author Nico
 */
include_once('IDatos.php');

class DatosFinal implements IDatos {
    public function getDatos($page,$dni){
        
        $cuil ='/([0-9]{2})('.'-'.$dni.'-'.')([0-9]{1})/';
        preg_match($cuil,$page,$matches,PREG_OFFSET_CAPTURE);
        
        $datos[0]= $matches[0][0];
        
        $cuil ='/([0-9]{2})('.$dni.')([0-9]{1})/';
        preg_match($cuil,$page,$matches,PREG_OFFSET_CAPTURE);
        
        $pageRecortada = substr($page, ($matches[0][1]+13));
        
        $posFinApellido = strpos($pageRecortada, ' ');
        $apellido = substr($pageRecortada, 0, $posFinApellido);
        
        $posFinNombre = strpos($pageRecortada, '<a', ($posFinApellido + 2));
        $nombre = substr($pageRecortada, ($posFinApellido + 1) , $posFinNombre);
        
        $datos[1] = $apellido;
        $datos[2] = $nombre;
        
        return $datos;
    
    }
}
