<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuturoJubilado extends Model
{
    use HasFactory;

    // Nombre de la tabla asociada
    protected $table = 'futurosjubilados';

    // Nombre de la clave primaria
    protected $primaryKey = 'id';

    // Los atributos que son asignables
    protected $fillable = [
        'cuil',
        'id_meta4',
        'nombreapellido',
        'fechanacimiento',
        'edad',
        'fechaingreso',
        'genero',
        'periodo',
        'descripcionuor',
        'dependencia',
        'etiqueta',
        'rats',
        'clase',
        'last_cod_jub',
        'last_cod_jub_desc',
        'last_fecha_desde',
        'last_fecha_hasta',
        'last_observacion',
        'id_secuser',
        'fecha_actualiza'
    ];

    // Indica si el modelo debe gestionar las marcas de tiempo created_at y updated_at
    public $timestamps = true;

    // Los atributos que deben ser convertidos a tipos nativos
    protected $casts = [
        'fechanacimiento' => 'date',
        'fechaingreso' => 'date',
        'last_fecha_desde' => 'date',
        'last_fecha_hasta' => 'date',
        'fecha_actualiza' => 'date'
    ];
}
