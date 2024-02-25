<?php

namespace Modelo;

use Illuminate\Database\Eloquent\Model;

class ApiModelo extends Model
{
    protected $table = 'peliculas';

    public function fetchMovies($apiKey) {
        // URL de la API de TMDb para obtener las películas populares
        $url = 'https://api.themoviedb.org/3/movie/popular?api_key=' . $apiKey;

        // Realizar la solicitud a la API para obtener las películas populares
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        // Obtener solo los datos relevantes de las películas
        $movies = [];
        foreach ($data['results'] as $movie) {
            $movieModel = new ApiModelo();
            $movieModel->idpelicula = $movie['id'];
            $movieModel->titulo = $movie['title'];
            $movieModel->sinopsis = $movie['overview'];
            $movieModel->imagen_principal = 'https://image.tmdb.org/t/p/w500/' . $movie['poster_path'];
            $movieModel->save();

            $movies[] = $movieModel;
        }

        return $movies;
    }

    public function fetchVideoKey($movieId, $apiKey) {
        // URL de la API de TMDb para obtener los videos de una película
        $url = 'https://api.themoviedb.org/3/movie/' . $movieId . '/videos?api_key=' . $apiKey;

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
