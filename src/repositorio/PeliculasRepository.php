<?php

namespace Repositorio;
require_once 'PeliculasRepositoryInterface.php';
require_once __DIR__ . '/../Modelo/Pelicula.php';


use Modelo\Pelicula;

class PeliculasRepository implements PeliculasRepositoryInterface
{
    public function obtenerTodas()
    {
        return Pelicula::all();
    }
}
