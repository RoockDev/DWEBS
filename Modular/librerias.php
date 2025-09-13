<?php

#Ejercicio 5 determina modularmente si un año es bisiesto o no

function esBisiesto($agno){
    $bisiesto = false;
    if($agno % 4 == 0 || ($agno % 100 == 0 && $agno % 400 == 0)){
        $bisiesto = true;
    }

    return $bisiesto;
}

#Ejercicio 11 calcula modularmente el factorial de un numero

function calculaFactorial($numero){
    $factorial = 1;
    for ($i=1 ; $i <= $numero  ; $i++ ) { 
              $factorial *= $i;
    }
    return $factorial;
}

#Ejercicio 15, dados dos numeros enteros, realizar el algoritmo que calcule resto mediante restas sucesivas

function CalculaCocienteyResto($numero1,$numero2){
    $cocienteYresto = [];
    $contador = 0;
    $resto = 0;
    while($numero1>=$numero2){
        $resto = $numero1-$numero2;
        $numero1 = $resto;
        $contador++;
        
    }

    $cocienteYresto = [$contador,$resto];
    return $cocienteYresto;
    
}

function calculaCocienteyResto2($numero1,$numero2,&$cociente,&$resto){
    $cociente = 0;
    $resto = $numero1;

    while($resto >= $numero2){
        $resto -= $numero2;
        $cociente++;
    }
    
}


/*Ejercicio 16 Dada una hora (horas,minutos y segundos) realiza un algoritmo que muestre la hora
despues de incrementarle 1 segundos */

function IncrementaHora($horas,$minutos,$segundos){
    $horaCompleta = "";
    $segundos++;
    $franjaHoraria = '';

        
    if($segundos == 60){
        $segundos = 0;
        $minutos++;
    }

    if($minutos == 60){
        $minutos = 0;
        $horas++;
    }

    if($horas == 24){
        $horas = 0;
    }

    if($horas >= 0 && $horas < 12 ){
        $franjaHoraria = 'AM';
    }else{
        $franjaHoraria = 'PM';
    }


    $horaCompleta = sprintf("%02d:%02d:%02d %s",$horas,$minutos,$segundos,$franjaHoraria);

    return $horaCompleta;
    
}

#Ejercicio 22 Realiza un modulo que devuelva cuantos digitos pares e impares tiene un numero

function dimeDigitos($numero,&$cantidadPares,&$cantidadImpares){

    $cantidadPares = 0;
    $cantidadImpares = 0;

    $numeroCadena = (string)$numero;

    for ($i=0; $i < strlen($numeroCadena) ; $i++) {
        $digito = $numeroCadena[$i];

        if($digito % 2 == 0){
            $cantidadPares++;
        }else{
            $cantidadImpares++;
        }
    }
    
}

/*
Ej 5 Arrays Diseña un programa que genere un vector con números al azar que oscilan entre [-100 y 100].
Después realiza un módulo que indique cuantos números positivos y cuantos negativos hay.
 */

function negativosYpositivos ($vector,&$positivos,&$negativos){
    $positivos = 0;
    $negativos = 0;
    for ($i=0; $i < count($vector) ; $i++) { 
        if($i % 2  == 0){
            $positivos++;
        }elseif($i % 2 == 1){
            $negativos++;
        }
    }
}

/*
Ej 8 Arrays  Dado un array de números de 5 posiciones con los siguiente valores {1,2,3,4,5},
guardar los valores de este array en otro array distinto pero con los valores invertidos, es decir,
que el segundo array deberá tener los valores {5,4,3,2,1}.
 */

function arrayInvertido($numeros,&$numeroInvertidos){
    for ($i=count($numeros) -1 ; $i >= 0 ; $i--) { 
        $numeroInvertidos[] = $numeros[$i];
    }
}

/*
Ej 9 Arrays haz un programa que diga si un numero es capicua por ejemplo 30303
 */

function esCapicua($num){
    
    $numCadena = (string)$num;
    $numCadenaInvertido = '';

    for ($i=strlen($numCadena) - 1; $i >= 0 ; $i--) { 
        $numCadenaInvertido .= $numCadena[$i];
        
    }

    return $numCadena === $numCadenaInvertido;


}

#ejemplo con array

function arrayCapicua($array){
    
    $array2 = [];
    for ($i=count($array) - 1; $i >= 0 ; $i--) { 
        $array2[] = $array[$i];
    }

    return $array === $array2;
}

?>