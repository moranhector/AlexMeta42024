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

    protected $search;

    // Constructor para recibir el parámetro de búsqueda
    public function __construct($search = null)
    {
        $this->search = $search;
    }

    /**
     * Retorna la colección de datos para ser exportados.
     * 
     * @return \Illuminate\Support\Collection
     */
    // Filtra la colección según el parámetro de búsqueda
    public function collection()
    {
        $query = Persona::select('m4user', 'nombre', 'etiqueta', 'oficina','email', 'celular', 'observaciones','es_principal');

        // Si hay un término de búsqueda, aplica el filtro
        if ($this->search) {
            $query->where('m4user', 'LIKE', "%{$this->search}%")
                ->orWhere('nombre', 'LIKE', "%{$this->search}%")
                ->orWhere('etiqueta', 'LIKE', "%{$this->search}%")
                ->orWhere('oficina', 'LIKE', "%{$this->search}%");
        }

        return $query->get();
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
            'Oficina',
            'Email',
            'Celular',
            'Observaciones',
            'es_principal'
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
                $sheet->mergeCells('A1:H1');
                // Aplica formato al título si lo deseas
                $sheet->getStyle('A1')->getFont()->setBold(true);
                $sheet->getStyle('A1')->getFont()->setSize(14);                
                
                // Aplica formato al título si lo deseas
                $sheet->getStyle('A2:H2')->getFont()->setBold(true);
                // $sheet->getStyle('A2:F2')->getFont()->setSize(14);
                // $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            }
        ];
    }    

}
