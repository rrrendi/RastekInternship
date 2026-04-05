<?php

namespace App\Exports;

use App\Models\pendaftar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class PendaftarExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $pendaftars;
    protected $row = 1;

    public function __construct($pendaftars)
    {
        $this->pendaftars = $pendaftars;
    }

    public function collection()
    {
        return $this->pendaftars;
    }

    public function headings(): array
    {
        return [
            'No', 'Nama Lengkap', 'Tempat Lahir', 'Tanggal Lahir', 
            'Email', 'Telepon', 'Pendidikan', 'Institusi', 
            'IPK/Nilai', 'Status', 'Tanggal Daftar'
        ];
    }

    public function map($pendaftar): array
    {
        return [
            $this->row++,
            $pendaftar->full_name,
            $pendaftar->birth_place,
            $pendaftar->birth_date ? $pendaftar->birth_date->format('d/m/Y') : '-',
            $pendaftar->email,
            // Tambahkan spasi agar Excel membaca ini sebagai teks (Angka 0 tidak akan hilang)
            ' ' . $pendaftar->phone,
            $pendaftar->education_level,
            $pendaftar->institution,
            $pendaftar->gpa_average,
            ucfirst($pendaftar->status),
            $pendaftar->created_at ? $pendaftar->created_at->format('d/m/Y H:i:s') : '-'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Mendapatkan baris dan kolom terakhir yang ada datanya
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        
        // Membuat jangkauan (range) dari cell A1 sampai cell terakhir
        $range = 'A1:' . $highestColumn . $highestRow;

        // 1. Menerapkan garis border ke seluruh tabel
        $sheet->getStyle($range)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'], // Warna Hitam
                ],
            ],
        ]);

        // 2. Menerapkan gaya (style) khusus hanya untuk Header (Baris 1)
        return [
            1 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FF87CEEB'] // Biru Muda
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }
}