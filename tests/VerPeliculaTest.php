<?php
namespace Tests\Modelo;

use Illuminate\Database\Capsule\Manager as Capsule;
use PHPUnit\Framework\TestCase;
use Modelo\VerPelicula;

class VerPeliculaTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'peliculas_online',
            'username'  => 'root',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

    public function testObtenerVideoUrl()
    {
        // Crear una instancia del modelo VerPelicula
        $verPelicula = new VerPelicula();

        // Definir un ID existente en la tabla de películas
        $idPeliculaExistente = 124;

        // Obtener la URL del video para la película existente
        $videoUrl = $verPelicula->obtenerVideoUrl($idPeliculaExistente);

        // Verificar que la URL del video no sea nula
        $this->assertNotNull($videoUrl);

        // Definir un ID inexistente en la tabla de películas
        $idPeliculaInexistente = 100;

        // Obtener la URL del video para la película inexistente
        $videoUrlInexistente = $verPelicula->obtenerVideoUrl($idPeliculaInexistente);

        // Verificar que la URL del video para la película inexistente sea nula
        $this->assertNull($videoUrlInexistente);
    }

    public function testObtenerVideoSerie()
    {
        // Crear una instancia del modelo VerPelicula
        $verPelicula = new VerPelicula();

        // Definir un ID existente en la tabla de series
        $idSerieExistente = 1;

        // Obtener la URL del video para la serie existente
        $videoUrl = $verPelicula->obtenerVideoSerie($idSerieExistente);

        // Verificar que la URL del video no sea nula
        $this->assertNotNull($videoUrl);

        // Definir un ID inexistente en la tabla de series
        $idSerieInexistente = 100;

        // Obtener la URL del video para la serie inexistente
        $videoUrlInexistente = $verPelicula->obtenerVideoSerie($idSerieInexistente);

        // Verificar que la URL del video para la serie inexistente sea nula
        $this->assertNull($videoUrlInexistente);
    }
}

?>
