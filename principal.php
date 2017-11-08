<html>
    <head>
        <meta charset="UTF-8">
        <title>Hola loko</title>
    </head>
    <body>
        <?php            
            include_once ('Controlador.php');
            $dni = $_GET['dni'];//dni inicio 05456120
            if (!(($dni == 'Escriba un numero de dni')||($dni == ''))){
                $controlador = new Controlador();
                $datosArray = $controlador ->obtenerDatos($dni);//0 cuit, 1 apellido, 2 nombres            
                if ($datosArray != null){
                    echo 'CUIT: '.$datosArray[0] . "<br>";
                    echo 'Apellido: '.$datosArray[1] . "<br>";
                    echo 'Nombre: '.$datosArray[2] . "<br>";                
                }
                else{
                    echo 'Error en la obtencion de datos, verifique los datos ingresados';
                }
            }
            else{
                echo 'Error en el ingreso de datos';
            }
            
        ?>
        
    </body>
</html>
