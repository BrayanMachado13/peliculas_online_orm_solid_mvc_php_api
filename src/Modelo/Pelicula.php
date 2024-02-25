<?php

namespace Modelo;

use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    protected $table = 'peliculas';
    protected $fillable = ['titulo', 'sinopsis', 'imagen_pincipal', 'video_principal'];
    public $timestamps = false;
}
