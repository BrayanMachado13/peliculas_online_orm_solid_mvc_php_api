<?php

namespace Modelo;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $table = 'series';
    protected $fillable = ['idserie', 'nombre', 'descripcion', 'imagen_principal', 'video_principal'];
    public $timestamps = false;
}