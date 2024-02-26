<?php

namespace Modelo;

use Illuminate\Database\Eloquent\Model;

class PeliculaEliminada extends Model
{
    protected $table = 'pelicula_eliminada';
    protected $fillable = ['titulo', 'sinopsis', 'imagen_pincipal', 'video_principal'];
    public $timestamps = false;
}
