<?php

require_once('./animal.php');
require_once('./perro.php');
require_once('./gato.php');
require_once('./elefante.php');
require('./factoria.php');

echo $_SERVER["REQUEST_URI"].'<br>';
echo $_SERVER["REQUEST_METHOD"].'<br>';

$parametros = explode("/", $_SERVER["REQUEST_URI"]);
unset($parametros[0]);

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if ($parametros[1] == "simular") {
        $Animales = [];
        for ($i = 0; $i < (intval($parametros[2])); $i++) {
            $animales[] = 0;
        }
        $segundos = 100;
        while ($segundos != 0) {
            echo 'segundo'.$segundos.'<br>';
            if ($segundos % 10 == 0) {
                $random = rand(0, count($animales) - 1);
                if (!is_object($animales[$random])) {
                    $animales[$random] = Factoria::generaAnimal();
                    echo 'se añade animal al array <br>';
                    print_r($animales);
                    
                }

            } else if ($segundos % 15 == 0) {
                $random2 = rand(0, count($animales) - 1);
                $salir = false;
                $intentos = 10; 
                
                while (!$salir && $intentos > 0) {
                    if ($random2 > 0 && is_object($animales[$random2])) {
                        
                        if (!is_object($animales[$random2 - 1])) {
                            $animales[$random2 - 1] = $animales[$random2];
                            $animales[$random2] = 0; 
                            echo'se desplaza animal una posicion a la izquierda <br>';
                            $salir = true;
                            
                        }
                    }
                    
                    if (!$salir && $random2 < count($animales) - 1) {
                        
                        if (is_object($animales[$random2]) && !is_object($animales[$random2 + 1])) {
                            $animales[$random2 + 1] = $animales[$random2];
                            $animales[$random2] = 0; 
                            echo 'se desplaza el animal una posicion a la derecha <br>';
                            $salir = true;
                        }
                    }
                    
                    $intentos--;
                    if (!$salir) {
                        $random2 = rand(0, count($animales) - 1); 
                    }
                }
                // foreach ($animales as $animal) { // ¿por que con un for normal no me funciona y con el forEach si? preguntar mañana en clase
                //     if (is_object($animal)) {
                //          $animal->toString();
                //     }
                // }
                print_r($animales);
            } else if ($segundos % 20 == 0) {
                $probabilidad = rand(1, 100);
                if ($probabilidad >= 1 && $probabilidad <= 50) {
                    $abandona = false;
                    while (!$abandona) {
                        $random3 = rand(0, count($animales) - 1);
                        if (is_object($animales[$random3])) {
                            $animales[$random3] = 0;
                            echo 'se borra animal del array <br>';
                            $abandona = true;
                        }
                    }
                }

               
            }
             $segundos--;
        }
    }
}
