<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Controlador\ControlInicioPeliculas;
use Repositorio\PeliculasRepositoryInterface;
use Modelo\Pelicula;

class ControlInicioPeliculasTest extends TestCase
{
    public function testIndexDevuelveArrayDePeliculas()
    {
        // Creamos un mock de la interfaz PeliculasRepositoryInterface
        $mockRepository = $this->createMock(PeliculasRepositoryInterface::class);
        
        // Definimos un array de películas para simular la respuesta del repositorio
        $peliculas = [
            new Pelicula(),
            new Pelicula()
        ];
        
        // Configuramos el mock para que devuelva el array de películas
        $mockRepository->method('obtenerTodas')->willReturn($peliculas);
        
        // Creamos una instancia de ControlInicioPeliculas con el mock como repositorio
        $controlador = new ControlInicioPeliculas($mockRepository);
        
        // Ejecutamos el método index() que queremos probar
        $resultado = $controlador->index();
        
        // Verificamos que el resultado sea un array de películas
        $this->assertIsArray($resultado);
        $this->assertContainsOnlyInstancesOf(Pelicula::class, $resultado);
    }
}

