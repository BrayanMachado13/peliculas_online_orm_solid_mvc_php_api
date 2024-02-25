<?php

namespace Servicio;

use Repositorio\PeliculasRepositoryInterface;

class PeliculasService
{
    protected $repositorio;

    public function __construct(PeliculasRepositoryInterface $repositorio)
    {
        $this->repositorio = $repositorio;
    }

    public function obtenerPeliculas()
    {
        return $this->repositorio->obtenerTodas();
    }
}
