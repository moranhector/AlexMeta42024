<?php

namespace App\Exports;

use App\Models\FuturoJubilado;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Carbon\Carbon;

class FuturosJubiladosExport implements FromCollection, WithHeadings
{
    protected $futurosjubilados;

    public function __construct($futurosjubilados)
    {
        $this->futurosjubilados = $futurosjubilados;
    }

    public function collection()
    {
        // Mapea los datos para incluir solo los campos requeridos en el orden especificado
        return $this->futurosjubilados->map(function($jubilado) {
            return [
                'cuil' => str_pad((string) $jubilado->cuil, 12, ' 0', STR_PAD_LEFT),                
                'nombreapellido' => $jubilado->nombreapellido,
                'fechanacimiento' => Carbon::parse($jubilado->fechanacimiento)->format('d/m/Y'),
                'edad' => $jubilado->edad,
                'fechaingreso' => Carbon::parse($jubilado->fechaingreso)->format('d/m/Y'),
                'genero' => $jubilado->genero,
                'descripcionuor' => $jubilado->descripcionuor,
                'dependencia' => $jubilado->dependencia,
                'etiqueta' => $jubilado->etiqueta,
                'rats' => $jubilado->rats,
                'clase' => $jubilado->clase,
                'last_observacion' => $jubilado->last_observacion,
                'comments' => $jubilado->comments,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'CUIL',
            'Nombre y Apellido',
            'Fecha de Nacimiento',
            'Edad',
            'Fecha de Ingreso',
            'Género',
            'Unidad Org.',
            'Lugar de Trabajo',
            'Dependencia',
            'RATS',
            'Clase',
            'Observación Usuario responsable',
            'Observación Personal RRHH'
        ];
    }
}
