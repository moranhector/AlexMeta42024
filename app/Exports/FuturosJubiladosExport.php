<?php

namespace App\Exports;

use App\Models\FuturoJubilado;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class FuturosJubiladosExport implements FromCollection, WithHeadings, 
WithEvents, WithCustomStartCell, WithTitle, ShouldAutoSize
{
    protected $futurosjubilados;
    protected $filtros;

    public function __construct($futurosjubilados, $titulo)
    {
        $this->futurosjubilados = $futurosjubilados;
        $this->filtros = $titulo;
    }

    public function collection()
    {
        // Mapea los datos para incluir solo los campos requeridos en el orden especificado
        return $this->futurosjubilados->map(function($jubilado) {
            return [
                'cuil' => str_pad((string) $jubilado->cuil, 12, '0', STR_PAD_LEFT),                
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
                'last_cod_jub' => $jubilado->last_cod_jub,
                'last_cod_jub_desc' => $jubilado->last_cod_jub_desc,
                'fecha_actualiza' => Carbon::parse($jubilado->fecha_actualiza)->format('d/m/Y'),
                'dias' => Carbon::parse($jubilado->fecha_actualiza)->diffInDays(),
                'id_secuser' => $jubilado->id_secuser,
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
            'Observación Personal RRHH',
            'Cód.Trámite',
            'descrip',
            'Fecha Actualiza',
            'dias',
            'usuario'
        ];
    }

    public function startCell(): string
    {
        return 'A2'; // Define que los encabezados comiencen en la celda A2
    }

    public function title(): string
    {
        return 'Reporte de Futuros Jubilados'; // Define el título de la hoja de cálculo
    }    


    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                
                // Agrega el título en la celda A1
                $sheet->setCellValue('A1', 'Reporte de Futuros Jubilados '.$this->filtros);
                
                // Combina las celdas para el título si lo deseas
                $sheet->mergeCells('A1:M1');
                
                // Aplica formato al título si lo deseas
                $sheet->getStyle('A1')->getFont()->setBold(true);
                $sheet->getStyle('A1')->getFont()->setSize(14);

                $sheet->getStyle('A2:Q2')->getFont()->setBold(true);                
                // $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            }
        ];
    }
}


