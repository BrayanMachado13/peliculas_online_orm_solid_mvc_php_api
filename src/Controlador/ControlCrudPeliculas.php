<?php

namespace Controlador;

use Modelo\Pelicula;
use Modelo\PeliculaEliminada;
use Illuminate\Database\Capsule\Manager as Capsule;

class ControlCrudPeliculas
{
    public function index()
    {
        $peliculas = Pelicula::orderByDesc('id')->get();
        include __DIR__ . '/../Vista/crud.php';
    }

    public function crear()
    {
        include __DIR__ . '/../Vista/crear.php';
    }

    public function guardar($datos)
    {
    $pelicula = new Pelicula();
    $pelicula->idpelicula = $datos['idpelicula'];
    $pelicula->titulo = $datos['titulo'];
    $pelicula->sinopsis = $datos['sinopsis'];
    $pelicula->imagen_principal = $datos['imagen_principal'];
    $pelicula->save();
    header('Location: crud.php');
    }

    public function editar($id)
    {
        $pelicula = Pelicula::find($id);
        include __DIR__ . '/../Vista/editar.php';
    }

    public function actualizar($id)
    {
        $pelicula = Pelicula::find($id);
        $pelicula->titulo = $_POST['titulo'];
        $pelicula->sinopsis = $_POST['sinopsis'];
        $pelicula->imagen_principal = $_POST['imagen_principal'];
        $pelicula->save();
        header('Location: crud.php');
    }

    public function eliminar($id)
    {
        // Obtener la película a eliminar
    $pelicula = Pelicula::find($id);
    if (!$pelicula) {
        // Película no encontrada, redirigir a la página principal
        header('Location: crud.php');
        exit();
    }

    // Mostrar un mensaje de confirmación
    echo "<script>alert('La película se eliminará y se guardará en la tabla de películas eliminadas.');</script>";

    // Esperar 5 segundo antes de redirigir
    echo "<meta http-equiv='refresh' content='5;url=crud.php'>";

    // Guardar un registro en la tabla peliculas_eliminadas
    $peliculaEliminada = new PeliculaEliminada();
    $peliculaEliminada->idpelicula = $pelicula->idpelicula;
    $peliculaEliminada->titulo = $pelicula->titulo;
    $peliculaEliminada->sinopsis = $pelicula->sinopsis;
    $peliculaEliminada->imagen_principal = $pelicula->imagen_principal;
    $peliculaEliminada->video_principal = $pelicula->video_principal;
    $peliculaEliminada->save();

    // Eliminar la película
    $pelicula->delete();
}
}