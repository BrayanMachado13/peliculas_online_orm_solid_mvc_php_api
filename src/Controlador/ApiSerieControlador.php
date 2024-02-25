<?php

namespace Controlador;

require_once __DIR__ . '/../Modelo/ApiSeries.php';

use Modelo\ApiSerie;

class ApiSerieControlador {

    private $modelo;

    public function __construct() {
        $this->modelo = new ApiSerie(); // Inicializa la propiedad $modelo
    }

    public function fetchDataSeries($apiKey) {
        $series = $this->modelo->fetchSeries($apiKey);

        foreach ($series as $serie) {
            // Verificar si la película ya existe en la base de datos
            $seriestv = ApiSerie::where('idserie', $serie['idserie'])->first();

            // Si la película no existe, la insertamos
            if (!$seriestv) {
                $seriestv = new ApiSerie();
                $seriestv->idserie = $serie['id'];
                $seriestv->nombre = $serie['name'];
                $seriestv->descripcion = $serie['overview'];
                $seriestv->imagen_principal = $serie['poster_path'];
                $seriestv->save();
            }

            // Obtener y actualizar el video principal de la película
            $videoKey = $this->modelo->fetchVideoKeySeries($serie['idserie'], $apiKey);
            if ($videoKey !== '') {
                $seriestv->video_principal = $videoKey;
                $seriestv->save();
            }
        }
    }
    public function setModelo($modelo)
{
    $this->modelo = $modelo;
}

}
