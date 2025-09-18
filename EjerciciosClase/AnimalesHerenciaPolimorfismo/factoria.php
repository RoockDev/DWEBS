<?php

require_once('./animal.php');
require_once('./perro.php');
require_once('./gato.php');
require_once('./elefante.php');

class Factoria{
    public static function generaAnimal(){
        
        $nombres = ['Alvaro','Jose Enrique','Carlos B','Carlos M','Antonio','Dani','Adrian','Manuel'];

        $razasAnimales = ['Labrador Retriever', 'Pastor Alemán', 'Golden Retriever', 'Bulldog Francés', 'Poodle',
                            'Rottweiler', 'Beagle', 'Dachshund', 'Siberian Husky', 'Gran Danés',
                            'Persa', 'Maine Coon', 'Siamés', 'Ragdoll', 'Sphynx',
                            'British Shorthair', 'American Shorthair', 'Scottish Fold', 'Abisinio', 'Bengala'];
        $pesosAnimales = [30, 25, 32, 12, 18, 45, 10, 8, 22, 60,5, 7, 4, 6, 4, 6, 5, 4, 3, 5];

        $coloresAnimales = [
                    'Negro', 'Blanco', 'Marrón', 'Gris', 'Atigrado',
                    'Crema', 'Moteado', 'Bicolor', 'Tricolor', 'Leonado',
                    'Naranja', 'Azul', 'Canela', 'Chocolate', 'Lila',
                    'Rojo', 'Plateado', 'Dorado', 'Crema', 'Negro'];

        $nombre = $nombres[rand(0, count($nombres) - 1)];
        $raza = $razasAnimales[rand(0, count($razasAnimales) - 1)];
        $peso = $pesosAnimales[rand(0, count($pesosAnimales) - 1)];
        $color = $coloresAnimales[rand(0, count($coloresAnimales) - 1)];

        $tipoDeAnimal = rand(1,3);

        $animal = match($tipoDeAnimal){
            1 => new Perro($nombre,$raza,$peso,$color,'con pedigree'),
            2 => new gato($nombre,$raza,$peso,$color,1000000000),
            3 => new Elefante($nombre,$raza,$peso,$color,'400'),
        };

        return $animal;



    }
   
}