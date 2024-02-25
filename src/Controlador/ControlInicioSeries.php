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
        $series = $this->repositorio->obtenerTodas();
        include __DIR__ . ('/../Vista/indexSeries.php');
    }
}
