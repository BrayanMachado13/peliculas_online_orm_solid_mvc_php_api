<?php

namespace Repositorio;
require_once 'SeriesRepositoryInterface.php';
require_once __DIR__ . '/../Modelo/Series.php';


use Modelo\Serie;

class SeriesRepository implements SeriesRepositoryInterface
{
    public function obtenerTodas()
    {
        return serie::all();
    }
}
