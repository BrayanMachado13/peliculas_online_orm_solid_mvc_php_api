<?php

namespace Controlador;

use Repositorio\PeliculasRepositoryInterface;

class ControlInicioPeliculas
{
    protected $repositorio;

    public function __construct(PeliculasRepositoryInterface $repositorio)
    {
        $this->repositorio = $repositorio;
    }

    public function index()
    {
        $peliculas = $this->repositorio->obtenerTodas();
        include __DIR__ . ('/../Vista/index.php');
        return $peliculas;
    }
}
