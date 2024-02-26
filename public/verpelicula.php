<?php

require_once '../vendor/autoload.php';
require_once '../src/Modelo/VerPelicula.php';
require_once '../src/Controlador/ControlVerPelicula.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'peliculas_online',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

$modelo = new \Modelo\VerPelicula();
$controller = new \Controlador\ControlVerPelicula($modelo);

$id = $_GET['id'];
$tipo = $_GET['tipo'];
$videoUrl = $controller->show($id,$tipo);

?>