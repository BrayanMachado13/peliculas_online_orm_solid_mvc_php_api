<?php

namespace Controlador;

use Modelo\VerPelicula;

class ControlVerPelicula
{
    private $modelo;

    public function __construct(VerPelicula $modelo)
    {
        $this->modelo = $modelo;
    }

    public function show($id , $tipo)
    {
        if ($tipo === 'pelicula') {
        $videoUrl = $this->modelo->obtenerVideoUrl($id);
    } elseif ($tipo === 'serie') {
        $videoUrl = $this->modelo->obtenerVideoSerie($id);
    }
    else {
        // Tipo desconocido, manejar el error adecuadamente
        $videoUrl = null;
    }

    include __DIR__ . ('/../Vista/ver_pelicula.php');

}
}