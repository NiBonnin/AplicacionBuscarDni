<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once('DatosFinal.php');
include_once('DatosInicio.php');

/**
 * Description of Controlador
 *
 * @author Nico
 */
class Controlador {
    
    public function obtenerDatos($dni){
        $url = 'https://www.dateas.com/es/consulta_cuit_cuil/?cuit=' . $dni;
        $page = file_get_contents($url);
        return (Controlador::procesarDatos($page,$dni));
    }


    private function verificarDatos($page, $dni){//devueleve -1 si no encontro resultados, 0 si los resultados estan en el inicio y 1 si estan mezclados en el codigo, -2 es error    
        $buscado = "|";
        $posFinal = stripos($page, $buscado);
        if ($posFinal != false){
            $cadenaAVerificar = substr($page, 0, $posFinal);
            if(stripos($cadenaAVerificar, 'No se encontraron resultados') != false){
                return -1;
            }
            else{//verificando si esta al inicio
                $cuil ='/([0-9]{2})('.'-'.$dni.'-'.')([0-9]{1})/';
                preg_match($cuil,$cadenaAVerificar,$matches);
                if($matches != false){
                    return 0;
                } 
                else{
                    return 1;
                }
            }                    
        }
        else{
            return -2;
        }
    }
            
    private function procesarDatos($page, $dni){
        switch (Controlador::verificarDatos($page, $dni)){
            case -1:            //no hubo resultados
                echo 'no se encontaron resulatados';
                return null;
                break;
            case 0:             //resultados al inicio
                $accesoDatos = new DatosInicio();
                $datosPersona = $accesoDatos->getDatos($page, $dni);
                return $datosPersona;
                break;
            case 1:             //resultados al final
                $accesoDatos = new DatosFinal();
                $datosPersona = $accesoDatos->getDatos($page, $dni);
                return $datosPersona;
                break;
            default:           //error inesperado
                echo 'error inesperado';
                return null;
                break;
        }
    }
                    

    
    
}
