<?php

require_once('./tablero.php');
require('./factoria.php');

echo $_SERVER["REQUEST_URI"].'<br>';
echo $_SERVER["REQUEST_METHOD"].'<br>';

$parametros = explode("/",$_SERVER["REQUEST_URI"]);
unset($parametros[0]);

if ($_SERVER["REQUEST_METHOD"] === 'GET') {
    if ($parametros[1] == "jugar") {
        $tableroDeBuscaMinas = new Tablero(20);
        $tableroDeBuscaMinas->colocarMinas();
        echo ($tableroDeBuscaMinas->toString());
        echo '<br>';
        echo ($tableroDeBuscaMinas->minasAdyacentes(intval($parametros[2])));
        echo '<br>';
        echo ($tableroDeBuscaMinas->toString());
    }
}
