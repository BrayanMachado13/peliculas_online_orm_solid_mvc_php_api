<?php
require_once '../vendor/autoload.php';
require_once '../src/Controlador/ControlInicioPeliculas.php';
require_once '../src/Controlador/ApiControlador.php';
require_once '../src/repositorio/PeliculasRepository.php';
require_once '../src/repositorio/PeliculasRepositoryInterface.php';
require_once '../src/servicio/PeliculasService.php';
require_once '../src/modelo/ApiModelo.php';
require_once '../src/repositorio/ApiModeloInterface.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Controlador\ControlInicioPeliculas;
use Controlador\ApiControlador;
use Repositorio\PeliculasRepository;
use Repositorio\ApiModeloInterface;
use Servicio\PeliculasService;
use Modelo\ApiModelo;

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

$apiKey = '021cf04cb15ec0ef1e5d3b944e6273a9'; // API key de TMDb

$modelo = new ApiModelo();
$controlador = new ApiControlador($modelo);
if (isset($_POST['fetch_data'])) {
    $controlador->fetchData($apiKey);
    echo "Datos obtenidos y guardados correctamente.";
}

// Crear una instancia concreta de PeliculasRepository que implemente PeliculasRepositoryInterface
$repositorio = new PeliculasRepository();
// Inyectar el repositorio en el controlador
$controlador = new ControlInicioPeliculas($repositorio);
// Ejecutar el método index del controlador
$controlador->index();
