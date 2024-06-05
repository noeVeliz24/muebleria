<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $table='categoria';
    protected $primarykey='id_categoria';
    public $timestamps = false;
    protected $filable=['categoria','descripcion','estatus'];

    protected $guarded=[];
}
