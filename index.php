<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Busqueda de persona por DNI</title>
    </head>
    <body>
        <form action="principal.php?dni= 'dni'" method="GET">
            Introduzca el DNI: <input type="text" size="30" maxlength="8" value="Escriba un numero de dni" name="dni"
                                      onclick=" value = '' ">
            <INPUT type="submit" value="Buscar">
            
        </form>
    </body>
</html>
