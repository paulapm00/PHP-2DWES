<?php
/**El API de Twig me obliga a colocar estas lineas para utilizar la libreria */

//Carga el fichero autoload.php
require_once 'vendor/autoload.php';

// Ubicacion de mis plantillas de Twig
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

// Ejecuta con "render" la vitsa que yo quiero
//echo $twig->render('plantilla.twig');

echo $twig->render('users/index.twig',
[
    'alumno' => 'PAULA',
    'numero' => '1',
    'dias' => ['lunes', 'martes']
]
);
