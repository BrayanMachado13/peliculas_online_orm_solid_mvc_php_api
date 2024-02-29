<?php

namespace Repositorio;

interface ApiModeloInterface {
    public function fetchMovies($apiKey);
    public function fetchVideoKey($movieId, $apiKey);
}
