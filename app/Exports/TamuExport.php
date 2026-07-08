<?php

namespace App\Exports;

use App\Models\Tamu;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class TamuExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, WithEvents
{
    protected $filter;
    private $rowNumber = 0;

    public function __construct(string $filter = 'semua')
    {
        $this->filter = $filter;
    }

    public function collection()
    {
        $query = Tamu::query();

        if ($this->filter === 'mingguan') {
            $query->whereBetween('created_at', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ]);
        } elseif ($this->filter === 'bulanan') {
            $query->whereMonth('created_at', Carbon::now()->month)
                  ->whereYear('created_at', Carbon::now()->year);
        }

        return $query->latest('created_at')->get();
    }

    public function headings(): array
    {
        return ['No', 'Nama/Instansi', 'Jumlah Orang', 'Waktu Kedatangan', 'Nomor HP', 'Bertemu Dengan', 'Pesan/Keterangan', 'Tanggal'];
    }

    public function map($tamu): array
    {
        return [
            ++$this->rowNumber,
            $tamu->nama,
            $tamu->jumlah_orang . ' orang',
            $tamu->waktu_kedatangan ?? '-',
            $tamu->nomor_hp,
            $tamu->tujuan,
            $tamu->pesan,
            Carbon::parse($tamu->created_at)->format('d-m-Y H:i'),
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => ['bold' => true, 'size' => 11, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '3B82F6']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => '1E40AF'],
                    ],
                ],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,
            'B' => 25,
            'C' => 15,
            'D' => 20,
            'E' => 18,
            'F' => 25,
            'G' => 50,
            'H' => 20,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $highestCol = $sheet->getHighestColumn();
                $totalData = $this->rowNumber;

                $sheet->insertNewRowBefore(1, 2);

                $sheet->mergeCells('A1:' . $highestCol . '1');
                $sheet->setCellValue('A1', 'DATA TAMU - ' . strtoupper($this->getFilterLabel()) . ' (' . Carbon::now()->format('d F Y') . ')');
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 14, 'color' => ['rgb' => 'FFFFFF']],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '2563EB']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                ]);
                $sheet->getRowDimension(1)->setRowHeight(35);

                $sheet->mergeCells('A2:' . $highestCol . '2');
                $sheet->setCellValue('A2', 'Total Data: ' . $totalData . ' tamu');
                $sheet->getStyle('A2')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 11, 'color' => ['rgb' => '1E40AF']],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'DBEAFE']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT],
                ]);
                $sheet->getRowDimension(2)->setRowHeight(25);

                $highestRow = $sheet->getHighestRow();
                for ($row = 4; $row <= $highestRow; $row++) {
                    $sheet->getStyle('A' . $row . ':' . $highestCol . $row)->applyFromArray([
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => ['rgb' => 'D1D5DB'],
                            ],
                        ],
                        'alignment' => [
                            'vertical' => Alignment::VERTICAL_CENTER,
                        ],
                    ]);

                    if ($row % 2 === 0) {
                        $sheet->getStyle('A' . $row . ':' . $highestCol . $row)->applyFromArray([
                            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'F9FAFB']],
                        ]);
                    }
                }
            },
        ];
    }

    private function getFilterLabel(): string
    {
        return match ($this->filter) {
            'mingguan' => 'Minggu Ini',
            'bulanan' => 'Bulan Ini',
            default => 'Semua Data',
        };
    }
}
