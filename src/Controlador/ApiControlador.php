<?php

namespace Controlador;

require_once __DIR__ . '/../Modelo/ApiModelo.php';

use Modelo\ApiModelo;

class ApiControlador {

    private $modelo;

    public function __construct() {
        $this->modelo = new ApiModelo(); // Inicializa la propiedad $modelo
    }

    public function fetchData($apiKey) {
        $movies = $this->modelo->fetchMovies($apiKey);

        foreach ($movies as $movie) {
            // Verificar si la película ya existe en la base de datos
            $pelicula = ApiModelo::where('idpelicula', $movie['idpelicula'])->first();

            // Si la película no existe, la insertamos
            if (!$pelicula) {
                $pelicula = new ApiModelo();
                $pelicula->idpelicula = $movie['idpelicula'];
                $pelicula->titulo = $movie['title'];
                $pelicula->sinopsis = $movie['overview'];
                $pelicula->imagen_principal = $movie['poster_path'];
                $pelicula->save();
            }

            // Obtener y actualizar el video principal de la película
            $videoKey = $this->modelo->fetchVideoKey($movie['idpelicula'], $apiKey);
            if ($videoKey !== '') {
                $pelicula->video_principal = $videoKey;
                $pelicula->save();
            }
        }
    }
    public function setModelo($modelo)
{
    $this->modelo = $modelo;
}
}
