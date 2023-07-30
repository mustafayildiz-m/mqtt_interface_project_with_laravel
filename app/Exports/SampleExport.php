<?php

// app/Exports/SampleExport.php
namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SampleExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct(Collection $data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'Cihaz Adı',
            'Serial No',
            'Bölge',
            'Isı',
            'Nem',
            'Durum',
            'Tarih'

        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Hücre renklerini değiştirin
        $sheet->getStyle('A1:C10')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FF0000', // ARGB renk kodu (örn: Kırmızı)
                ],
            ],
        ]);

    }

}
