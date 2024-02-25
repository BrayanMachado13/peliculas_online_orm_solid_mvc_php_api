<?php

namespace Servicio;

use Repositorio\SeriesRepositoryInterface;

class SeriesService
{
    protected $repositorio;

    public function __construct(SeriesRepositoryInterface $repositorio)
    {
        $this->repositorio = $repositorio;
    }

    public function obtenerSeries()
    {
        return $this->repositorio->obtenerTodas();
    }
}
