<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'mueble'; // Cambiado a 'mueble' para que coincida con el nombre de la tabla en tu base de datos

    protected $primaryKey = 'id'; // Cambiado a 'id' para que coincida con el nombre de la columna de clave primaria en tu base de datos

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'material', // Cambiado a 'material' para que coincida con el nombre de la columna en tu base de datos
        'precio',
        'imagen'
    ];

    protected $guarded = [

    ];
}