<?php

namespace App\Exports;

use App\Models\Persona;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class PersonasExport implements FromCollection, WithHeadings, 
WithEvents, WithCustomStartCell, WithTitle, ShouldAutoSize
{
    /**
     * Retorna la colección de datos para ser exportados.
     * 
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Retorna todos los registros de la tabla personas con todos los campos
        return Persona::select('m4user', 'nombre', 'etiqueta', 'email', 'celular', 'observaciones')->get();
    }

    /**
     * Define los encabezados de las columnas en el archivo Excel.
     * 
     * @return array
     */
    public function headings(): array
    {
        return [
            'M4User',
            'Nombre',
            'Etiqueta',
            'Email',
            'Celular',
            'Observaciones'
        ];
    }

    public function startCell(): string
    {
        return 'A2'; // Define que los encabezados comiencen en la celda A2
    }

    public function title(): string
    {
        return 'Reporte de Usuarios / Institución'; // Define el título de la hoja de cálculo
    }        

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                
                // Agrega el título en la celda A1
                $sheet->setCellValue('A1', 'Reporte de Usuarios - Instituciones ');
                
                // Combina las celdas para el título si lo deseas
                $sheet->mergeCells('A1:F1');
                // Aplica formato al título si lo deseas
                $sheet->getStyle('A1')->getFont()->setBold(true);
                $sheet->getStyle('A1')->getFont()->setSize(14);                
                
                // Aplica formato al título si lo deseas
                $sheet->getStyle('A2:F2')->getFont()->setBold(true);
                // $sheet->getStyle('A2:F2')->getFont()->setSize(14);
                // $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            }
        ];
    }    

}
