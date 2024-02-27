<?php

namespace Controlador;

use Repositorio\SeriesRepositoryInterface;

class ControlInicioSeries
{
    protected $repositorio;

    public function __construct(SeriesRepositoryInterface $repositorio)
    {
        $this->repositorio = $repositorio;
    }

    public function indexSeries()
    {
         // Obtener la dirección IP del usuario
         $ip = $_SERVER['REMOTE_ADDR'];

         // Guardar la dirección IP en un archivo de texto
         $file = 'traffic.txt';
         $data = "Usuario con IP $ip visitó la página en " . date('Y-m-d H:i:s') . "\n";
         file_put_contents($file, $data, FILE_APPEND);


         // Registro de una métrica de tiempo
         $start_time = microtime(true);

         // Lógica del controlador
         $peliculas = $this->repositorio->obtenerTodas();
 
         // Calcular el tiempo de ejecución
         $end_time = microtime(true);
         $execution_time = $end_time - $start_time;
 
         // Almacenar la métrica en un archivo de texto
         $file = 'metrics.txt';
         $data = "Tiempo de ejecución de la acción series: $execution_time segundos\n";
         file_put_contents($file, $data, FILE_APPEND);

        $series = $this->repositorio->obtenerTodas();
        include __DIR__ . ('/../Vista/indexSeries.php');
    }
}
