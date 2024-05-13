<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Usuario
 * @package App\Models
 * @version September 15, 2022, 3:32 pm UTC
 *
 * @property string $nombre
 * @property string $apellido_nombre
 * @property string $nombre_usuario
 * @property string $mail
 * @property string $numero_cuit
 * @property string $codigo_reparticion
 * @property string $nombre_reparticion
 * @property string $codigo_sector_interno
 * @property string $cargo
 */
class Usuario extends Model
{
    //use SoftDeletes;

    use HasFactory;

    public $table = 'usuarios';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'nombre',
        'apellido_nombre',
        'nombre_usuario',
        'mail',
        'numero_cuit',
        'codigo_reparticion',
        'nombre_reparticion',
        'codigo_sector_interno',
        'cargo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nombre' => 'string',
        'apellido_nombre' => 'string',
        'nombre_usuario' => 'string',
        'mail' => 'string',
        'numero_cuit' => 'string',
        'codigo_reparticion' => 'string',
        'nombre_reparticion' => 'string',
        'codigo_sector_interno' => 'string',
        'cargo' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required',
        'apellido_nombre' => 'required',
        'nombre_usuario' => 'required',
        'mail' => 'required',
        'numero_cuit' => 'required',
        'codigo_reparticion' => 'required',
        'nombre_reparticion' => 'required',
        'codigo_sector_interno' => 'required',
        'cargo' => 'required'
    ];

    
}
