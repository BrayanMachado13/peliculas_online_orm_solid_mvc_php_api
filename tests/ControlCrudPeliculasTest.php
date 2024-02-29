<?php

namespace Tests;

use Illuminate\Database\Capsule\Manager as Capsule;
use PHPUnit\Framework\TestCase;
use Controlador\ControlCrudPeliculas;
use Modelo\Pelicula;
use Modelo\PeliculaEliminada;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;



class ControlCrudPeliculasTest extends TestCase
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

    public function testGuardar()
    {
        $datos = [
            'idpelicula' => '1',
            'titulo' => 'pelicula',
            'sinopsis' => 'esta es una pelicula',
            'imagen_principal' => 'test.jpg'
        ];
    
        $controlador = new ControlCrudPeliculas();
        $controlador->guardar($datos);
    
        $peliculaGuardada = Pelicula::where('titulo', 'pelicula')->first();
    
        $this->assertEquals('pelicula', $peliculaGuardada->titulo);
        $this->assertEquals('esta es una pelicula', $peliculaGuardada->sinopsis);
        $this->assertEquals('test.jpg', $peliculaGuardada->imagen_principal);

    }

    public function testEliminar()
    {
        // Crear una película para eliminar
        $pelicula = new Pelicula();
        $pelicula->idpelicula = 2;
        $pelicula->titulo = 'terminator';
        $pelicula->sinopsis = 'es una gran pelicula';
        $pelicula->imagen_principal = 'imagen.jpg';
        $pelicula->video_principal = 'video.mp4';
        $pelicula->save();

        // Crear instancia del controlador
        $controlador = new ControlCrudPeliculas();

        // Ejecutar el método eliminar
        $controlador->eliminar($pelicula->id);

        // Verificar que la película se haya eliminado correctamente
        $this->assertNull(Pelicula::find($pelicula->id));
        
        // Verificar que se haya guardado en la tabla de películas eliminadas
        $peliculaEliminada = PeliculaEliminada::where('idpelicula', $pelicula->idpelicula)->first();
        $this->assertInstanceOf(PeliculaEliminada::class, $peliculaEliminada);
        $this->assertEquals($pelicula->titulo, $peliculaEliminada->titulo);
        $this->assertEquals($pelicula->sinopsis, $peliculaEliminada->sinopsis);
        $this->assertEquals($pelicula->imagen_principal, $peliculaEliminada->imagen_principal);
        $this->assertEquals($pelicula->video_principal, $peliculaEliminada->video_principal);
    }
}
