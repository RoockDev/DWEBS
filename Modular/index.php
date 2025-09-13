<?php

require ('./librerias.php');

#Ejercicio 5 determina modularmente si un año es bisiesto o no

$agno = 2023;
$bisiesto = esBisiesto($agno);

if($bisiesto){
    echo 'el año '.$agno. ' es bisiesto<br>';
}else{
    echo "el año $agno no es bisiesto<br>";
}

#Ejercicio 11 Calcula modularmente el factorial de un numero

$numero = 4;
$factorial = calculaFactorial($numero);

echo "el factorial de $numero es $factorial<br>";

#Ejercicio 15, dados dos numeros enteros, realizar el algoritmo que calcule resto mediante restas sucesivas

$numero1 = 20;
$numero2 = 2;
$cocienteYresto = [];
if($numero1 > $numero2){
    $cocienteYresto = CalculaCocienteyResto($numero1,$numero2);
    echo "El cociente es $cocienteYresto[0] y el resto es $cocienteYresto[1]<br>";
}else{
    echo 'No se puede calcular';
}

#Ejemplo 2

$numero1v2 = 20;
$numero2v2 = 2;
$cociente;
$resto;

if($numero1v2 > $numero2v2){
    $cocienteYresto2 = calculaCocienteyResto2($numero1v2,$numero2v2,$cociente,$resto);
    echo 'el cociente es '.$cociente. ' el resto es '.$resto;
}else{
    echo 'No se puede calcular';
}
echo'<br>';

/*Ejercicio 16 Dada una hora (horas,minutos y segundos) realiza un algoritmo que muestre la hora
despues de incrementarle 1 segundos */

$horas = 23;
$minutos = 59;
$segundos = 59;
if($horas < 24 && $minutos < 60 && $segundos < 60){
    $horaActual = IncrementaHora($horas,$minutos,$segundos);

    echo " Hora actual : $horaActual";
}else{
    echo 'Introduce valores correctos';
}
echo '<br>';

#Ejercicio 22 Realiza un modulo que devuelva cuantos digitos pares e impares tiene un numero

$cantidadPares;
$cantidadImpares;

$numero = 234656;

dimeDigitos($numero,$cantidadPares,$cantidadImpares);

echo 'el numero '.$numero.' tiene '.$cantidadPares.' numero pares y '.$cantidadImpares.' numero impares <br>';

/*
Ej 5 Arrays Diseña un programa que genere un vector con números al azar que oscilan entre [-100 y 100].
Después realiza un módulo que indique cuantos números positivos y cuantos negativos hay.
 */

$positivos;
$negativos;
$vector = [];
$cantidad = 20;
$vector2 = range(-100,100);

for ($i=0; $i < $cantidad ; $i++) { 
    $vector[] = rand(-100,100);
}

negativosYpositivos($vector,$positivos,$negativos);
print_r($vector);
echo '<br>';
echo "El primer vector tiene $positivos numeros positivos y $negativos numeros negativos <br>";
print_r($vector2);
echo '<br>';
negativosYpositivos($vector2,$positivos,$negativos);
echo "El segundo vector tiene $positivos numeros positivos y $negativos numeros negativos <br>";

/*
Ej 8 Arrays  Dado un array de números de 5 posiciones con los siguiente valores {1,2,3,4,5},
guardar los valores de este array en otro array distinto pero con los valores invertidos, es decir,
que el segundo array deberá tener los valores {5,4,3,2,1}.
 */

$numeros = [1,2,3,4,5];
$numerosInvertidos = [];
print_r($numeros);
arrayInvertido($numeros,$numerosInvertidos);
print_r($numerosInvertidos);
echo '<br>';

/*
Ej 9 Arrays haz un programa que diga si un numero es capicua por ejemplo 30303
 */

$num = 30303;

if(esCapicua($num)){
    echo "el numero $num es capicua<br>";
}else{
    echo "el numero $num no es capicua<br>";
}

#Ejemplo con Array

$array1 = [3,0,3,0,4];

if(arrayCapicua($array1)){
    echo 'es capicua';
}else{
    echo 'no es capicua';
}



?>