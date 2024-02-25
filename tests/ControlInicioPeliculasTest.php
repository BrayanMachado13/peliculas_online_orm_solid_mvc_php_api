<?php

use PHPUnit\Framework\TestCase;
use Controlador\ControlInicioPeliculas;
use Repositorio\PeliculasRepositoryInterface;
use Modelo\Pelicula;


class ControlInicioPeliculasTest {
    
public function testObtenerTodasLasPeliculas()
{
    $repositorioMock = $this->createMock(PeliculasRepositoryInterface::class);
    $repositorioMock->expects($this->once())
        ->method('obtenerTodas')
        ->willReturn([]);

    $controlador = new ControlInicioPeliculas($repositorioMock);
    $peliculas = $controlador->index();

    $this->assertEquals([], $peliculas);
}

}