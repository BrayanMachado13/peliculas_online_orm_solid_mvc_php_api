<?php

require_once '../vendor/autoload.php';
require_once '../src/Controlador/ControlInicioSeries.php';
require_once '../src/Controlador/ApiSerieControlador.php';
require_once '../src/repositorio/SeriesRepository.php';
require_once '../src/repositorio/ApiModeloInterface.php';
require_once '../src/modelo/ApiSeries.php';


use Illuminate\Database\Capsule\Manager as Capsule;
use Controlador\ApiSerieControlador;
use Controlador\ControlInicioSeries;
use Repositorio\SeriesRepository;
use Servicio\SeriesService;
use Modelo\Serie;
use Modelo\ApiSerie;
use Repositorio\ApiModeloInterface;

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

$modelo = new ApiSerie();
$controlador = new ApiSerieControlador($modelo);
if (isset($_POST['fetch_data_Series'])) {
    $controlador->fetchData($apiKey);
    echo "Datos obtenidos y guardados correctamente.";
}

$repositorio = new SeriesRepository();
$controlador = new ControlInicioSeries($repositorio);
$controlador->indexSeries();