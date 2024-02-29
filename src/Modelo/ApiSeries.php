<?php

namespace Modelo;

use Illuminate\Database\Eloquent\Model;
use Repositorio\ApiModeloInterface;

class ApiSerie extends Model implements ApiModeloInterface
{
    protected $table = 'series';

    public function fetchMovies($apiKey) {
        // URL de la API de TMDb para obtener las películas populares
        $url = 'https://api.themoviedb.org/3/tv/popular?api_key=' . $apiKey;

        // Realizar la solicitud a la API para obtener las películas populares
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        // Obtener solo los datos relevantes de las películas
        $series = [];
        foreach ($data['results'] as $serie) {
            $movieSerie = new ApiSerie();
            $movieSerie->idserie = $serie['id'];
            $movieSerie->nombre = $serie['name'];
            $movieSerie->descripcion = $serie['overview'];
            $movieSerie->imagen_principal = 'https://image.tmdb.org/t/p/w500/' . $serie['poster_path'];
            $movieSerie->save();

            $series[] = $movieSerie;
        }

        return $series;
    }

    public function fetchVideoKey($serieId, $apiKey) {
        // URL de la API de TMDb para obtener los videos de una película
        $url = 'https://api.themoviedb.org/3/tv/' . $serieId . '/videos?api_key=' . $apiKey;

        // Realizar la solicitud a la API para obtener los videos de la película
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        // Obtener la clave del video principal si está disponible
        $videoKey = '';
        if (isset($data['results'][0])) {
            $videoKey = $data['results'][0]['key'];
        }

        return $videoKey;
    }
}
