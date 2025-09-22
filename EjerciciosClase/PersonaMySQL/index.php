<?php

        /** ****************** Conectar ************************* */
        // Utilizando la forma procedimental.
        $conexion = mysqli_connect('localhost', 'fernando', 'Chubaca2024', 'ejemplo');
        if (!$conexion) {
            print "Fallo al conectar a MySQL: " . mysqli_connect_error();
        }


        /** ****************** Consultar ************************* */
        //Bind param procedimental.
        $consulta = "SELECT * FROM personas WHERE dni = ?";
        $stmt = mysqli_prepare($conexion, $consulta);
        $dni = '2B';
        $clave = 1245;
        $edad = 18;
        mysqli_stmt_bind_param($stmt, "s", $dni); 
        mysqli_stmt_execute($stmt);                 
        $resultados = mysqli_stmt_get_result($stmt);
        //print_r($resultados);
        while( $fila = mysqli_fetch_array($resultados)) 
        {
            // print_r($fila);
            /* obtener array asociativo */
        //    while ($fila = mysqli_fetch_assoc($resultado)) {
        //        print  $fila["dni"].",". $fila["nombre"].",".$fila["tfno"]."<br/>";
        //    }

            /* obtener el array por índices */
        //    while ($fila = mysqli_fetch_row($resultado)) {
        //        print  $fila[0].",". $fila[1].",".$fila[2]."<br/>";
        //    }

            /* obtener ambos */
            print $fila["dni"] . "," . $fila[1] . "," . $fila[2] . "<br>";
        }

        echo "----------------------<br>";


        //************* Insertar ************************
        /* Sentencias de preparación de la inserción y de la inserción propiamente. 
           Con esta forma se evitará la inyección de SQL.         */
       $query = "INSERT INTO personas (dni, nombre, clave, tfno) VALUES (?,?,?,?)"; //Estos parametros seran sustituidos mas adelante por valores.
       $stmt = mysqli_prepare($conexion, $query);
       $val1 = '101A';
       $val2 = 'Un nombre';
       $val3 = 1234;
       $val4 = '555827494';
       mysqli_stmt_bind_param($stmt, "ssis", $val1, $val2, $val3, $val4);
       /* Ejecución de la sentencia. */
       try {
           echo mysqli_stmt_execute($stmt).' registro insertado.<br>';
       } catch(Exception $e){
            echo "Fallo al insertar: (" . $e->getMessage() . ") <br>";
       }


        /** ****************** Consultar ************************* */
        //Bind param procedimental.
        $consulta = "SELECT * FROM personas";
        $stmt = mysqli_prepare($conexion, $consulta); 
        mysqli_stmt_execute($stmt);                 
        $resultados = mysqli_stmt_get_result($stmt);
        //print_r($resultados);
        while( $fila = mysqli_fetch_array($resultados)) 
        {
            // print_r($fila);
            /* obtener array asociativo */
        //    while ($fila = mysqli_fetch_assoc($resultado)) {
        //        print  $fila["dni"].",". $fila["nombre"].",".$fila["tfno"]."<br/>";
        //    }

            /* obtener el array por índices */
        //    while ($fila = mysqli_fetch_row($resultado)) {
        //        print  $fila[0].",". $fila[1].",".$fila[2]."<br/>";
        //    }

            /* obtener ambos */
            print $fila["dni"] . "," . $fila[1] . "," . $fila[2] . "<br>";
        }

        echo "----------------------<br>";

         /** ******** UPDATE ******** */
        //Queremos actualizar el nombre y teléfono de una persona con dni específico.
        $query = "UPDATE personas SET nombre = ?, tfno = ? WHERE dni = ?";
        $stmt = mysqli_prepare($conexion, $query);

        if ($stmt) {
            $nuevoNombre = "Nuevo Nombre";
            $nuevoTfno   = "600123456";
            $dniActualizar = "2B";   //Aquí indicamos el DNI de la persona que quieres modificar

            //"sss" porque son 3 strings (nombre, tfno, dni)
            mysqli_stmt_bind_param($stmt, "sss", $nuevoNombre, $nuevoTfno, $dniActualizar);

            if (mysqli_stmt_execute($stmt)) {
                echo mysqli_stmt_affected_rows($stmt) . " registro(s) actualizado(s).<br>";
            } else {
                echo "Error en UPDATE: " . mysqli_stmt_error($stmt) . "<br>";
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparando la consulta: " . mysqli_error($conexion);
        }


         /** ****************** Consultar ************************* */
        //Bind param procedimental.
        $consulta = "SELECT * FROM personas";
        $stmt = mysqli_prepare($conexion, $consulta); 
        mysqli_stmt_execute($stmt);                 
        $resultados = mysqli_stmt_get_result($stmt);
        //print_r($resultados);
        while( $fila = mysqli_fetch_array($resultados)) 
        {
            print $fila["dni"] . "," . $fila[1] . "," . $fila[2] . "<br>";
        }

        echo "----------------------<br>";

        /** ***************** Borrar ************************ */
        //Con Update y con Delete es exactamente igual. 
        //También se puede usar:
        $query = "DELETE FROM personas WHERE dni = '101A'";
        try{
            mysqli_query($conexion, $query);
            echo "Borrado ok<br>";
        }catch(Exception $e){
            echo "Fallo al borrar: (" . $e->getMessage() . ") <br>";
        }
            
         /** ****************** Consultar ************************* */
        //Bind param procedimental.
        $consulta = "SELECT * FROM personas";
        $stmt = mysqli_prepare($conexion, $consulta); 
        mysqli_stmt_execute($stmt);                 
        $resultados = mysqli_stmt_get_result($stmt);
        //print_r($resultados);
        while( $fila = mysqli_fetch_array($resultados)) 
        {
            print $fila["dni"] . "," . $fila[1] . "," . $fila[2] . "<br>";
        }

        echo "----------------------<br>";
            

        echo "----------------------<br>";
        /******************** Cerrar la conexión *********************/
        mysqli_close($conexion);
        //unset($conexion);
        print "Conexión 2 cerrada" . "<br>";
