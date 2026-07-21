<?php

namespace App\Exports;

use App\Models\Masjid;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;

use Illuminate\Support\Collection;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;

use Maatwebsite\Excel\Events\AfterSheet;

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class KeuanganExport implements FromCollection, ShouldAutoSize, WithEvents
{
    protected $mulai;
    protected $selesai;

    public function __construct($mulai = null, $selesai = null)
    {
        $this->mulai = $mulai;
        $this->selesai = $selesai;
    }

    /*
    |--------------------------------------------------------------------------
    | Collection
    |--------------------------------------------------------------------------
    |
    | Data akan ditulis melalui AfterSheet agar layout dapat dibuat bebas.
    |
    */

    public function collection()
    {
        return new Collection([]);
    }

    /*
    |--------------------------------------------------------------------------
    | Events
    |--------------------------------------------------------------------------
    */

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                /*
                |--------------------------------------------------------------------------
                | Data Masjid
                |--------------------------------------------------------------------------
                */

                $masjid = Masjid::first();

                /*
                |--------------------------------------------------------------------------
                | Header Laporan
                |--------------------------------------------------------------------------
                */

                $sheet->mergeCells('A1:F1');
                $sheet->mergeCells('A2:F2');
                $sheet->mergeCells('A3:F3');
                $sheet->mergeCells('A4:F4');

                $sheet->setCellValue(
                    'A1',
                    'LAPORAN KEUANGAN MASJID'
                );

                $sheet->setCellValue(
                    'A2',
                    $masjid?->nama_masjid ?? '-'
                );

                $sheet->setCellValue(
                    'A3',
                    ($masjid?->alamat ?? '-') .
                    ' | Telp : ' .
                    ($masjid?->telepon ?? '-') .
                    ' | Email : ' .
                    ($masjid?->email ?? '-')
                );

                if ($this->mulai && $this->selesai) {

                    $periode =
                        'Periode : ' .
                        \Carbon\Carbon::parse($this->mulai)
                            ->translatedFormat('d F Y')
                        .
                        ' s/d ' .
                        \Carbon\Carbon::parse($this->selesai)
                            ->translatedFormat('d F Y');

                } else {
                    $periode = 'Periode : Seluruh Data';
                }

                $sheet->setCellValue('A4', $periode);
                                /*
                |--------------------------------------------------------------------------
                | Header Tabel
                |--------------------------------------------------------------------------
                */

                $sheet->fromArray([
                    [
                        'No',
                        'Tanggal',
                        'Jenis',
                        'Kategori / Sumber',
                        'Keterangan',
                        'Nominal'
                    ]
                ], null, 'A6');

                /*
                |--------------------------------------------------------------------------
                | Query Pemasukan
                |--------------------------------------------------------------------------
                */

                $pemasukan = Pemasukan::query();
                if ($this->mulai && $this->selesai) {
                    $pemasukan->whereBetween(
                        'tanggal',
                        [
                            $this->mulai,
                            $this->selesai
                        ]
                    );
                }

                $pemasukan = $pemasukan
                    ->orderBy('tanggal')
                    ->get();

                /*
                |--------------------------------------------------------------------------
                | Query Pengeluaran
                |--------------------------------------------------------------------------
                */

                $pengeluaran = Pengeluaran::query();
                if ($this->mulai && $this->selesai) {
                    $pengeluaran->whereBetween(
                        'tanggal',
                        [
                            $this->mulai,
                            $this->selesai
                        ]
                    );
                }

                $pengeluaran = $pengeluaran
                    ->orderBy('tanggal')
                    ->get();

                /*
                |--------------------------------------------------------------------------
                | Isi Data
                |--------------------------------------------------------------------------
                */

                $row = 7;
                $no = 1;

                foreach ($pemasukan as $item) {

                    $sheet->setCellValue('A'.$row, $no++);
                    $sheet->setCellValue(
                        'B'.$row,
                        \Carbon\Carbon::parse($item->tanggal)
                            ->translatedFormat('d M Y')
                    );
                    $sheet->setCellValue('C'.$row, 'Pemasukan');
                    $sheet->setCellValue('D'.$row, $item->sumber);
                    $sheet->setCellValue('E'.$row, $item->keterangan);
                    $sheet->setCellValue('F'.$row, $item->nominal);

                    $row++;

                }

                foreach ($pengeluaran as $item) {

                    $sheet->setCellValue('A'.$row, $no++);
                    $sheet->setCellValue(
                        'B'.$row,
                        \Carbon\Carbon::parse($item->tanggal)
                            ->translatedFormat('d M Y')
                    );
                    $sheet->setCellValue('C'.$row, 'Pengeluaran');
                    $sheet->setCellValue('D'.$row, $item->kategori);
                    $sheet->setCellValue('E'.$row, $item->keterangan);
                    $sheet->setCellValue('F'.$row, $item->nominal);

                    $row++;

                }

                /*
                |--------------------------------------------------------------------------
                | Ringkasan
                |--------------------------------------------------------------------------
                */

                $totalPemasukan = $pemasukan->sum('nominal');
                $totalPengeluaran = $pengeluaran->sum('nominal');
                $saldo = $totalPemasukan - $totalPengeluaran;

                $row += 2;

                $sheet->setCellValue('E'.$row, 'Total Pemasukan');
                $sheet->setCellValue('F'.$row, $totalPemasukan);

                $row++;

                $sheet->setCellValue('E'.$row, 'Total Pengeluaran');
                $sheet->setCellValue('F'.$row, $totalPengeluaran);

                $row++;

                $sheet->setCellValue('E'.$row, 'Saldo Akhir');
                $sheet->setCellValue('F'.$row, $saldo);
                                /*
                |--------------------------------------------------------------------------
                | Styling Header
                |--------------------------------------------------------------------------
                */

                $sheet->getStyle('A1:F1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 18,
                        'color' => [
                            'rgb' => 'FFFFFF'
                        ]
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => '059669'
                        ]
                    ]
                ]);

                $sheet->getStyle('A2:F2')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 15,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER
                    ]
                ]);

                $sheet->getStyle('A3:F4')->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER
                    ]
                ]);

                /*
                |--------------------------------------------------------------------------
                | Header Tabel
                |--------------------------------------------------------------------------
                */

                $sheet->getStyle('A6:F6')->applyFromArray([

                    'font' => [
                        'bold' => true,
                        'color' => [
                            'rgb' => 'FFFFFF'
                        ]
                    ],

                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER
                    ],

                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => '10B981'
                        ]
                    ],

                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN
                        ]
                    ]

                ]);

                /*
                |--------------------------------------------------------------------------
                | Border Seluruh Isi Tabel
                |--------------------------------------------------------------------------
                */

                $sheet->getStyle("A6:F".($row-3))
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN);

                /*
                |--------------------------------------------------------------------------
                | Alignment
                |--------------------------------------------------------------------------
                */

                $sheet->getStyle("A7:A".($row-3))
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $sheet->getStyle("F7:F".$row)
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_RIGHT);

                /*
                |--------------------------------------------------------------------------
                | Format Rupiah
                |--------------------------------------------------------------------------
                */

                $sheet->getStyle("F7:F".$row)
                    ->getNumberFormat()
                    ->setFormatCode(
                        '"Rp" #,##0'
                    );

                /*
                |--------------------------------------------------------------------------
                | Total
                |--------------------------------------------------------------------------
                */

                $sheet->getStyle("E".($row-2).":F".$row)
                    ->applyFromArray([

                        'font' => [
                            'bold' => true
                        ],

                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'startColor' => [
                                'rgb' => 'ECFDF5'
                            ]
                        ],

                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN
                            ]
                        ]

                    ]);

                /*
                |--------------------------------------------------------------------------
                | Freeze Header
                |--------------------------------------------------------------------------
                */

                $sheet->freezePane('A7');

                /*
                |--------------------------------------------------------------------------
                | Auto Filter
                |--------------------------------------------------------------------------
                */

                $sheet->setAutoFilter('A6:F6');
                                /*
                |--------------------------------------------------------------------------
                | Lebar Kolom
                |--------------------------------------------------------------------------
                */

                $sheet->getColumnDimension('A')->setWidth(8);
                $sheet->getColumnDimension('B')->setWidth(18);
                $sheet->getColumnDimension('C')->setWidth(18);
                $sheet->getColumnDimension('D')->setWidth(28);
                $sheet->getColumnDimension('E')->setWidth(45);
                $sheet->getColumnDimension('F')->setWidth(22);

                /*
                |--------------------------------------------------------------------------
                | Tinggi Baris
                |--------------------------------------------------------------------------
                */

                foreach (range(1, $row) as $i) {
                    $sheet->getRowDimension($i)->setRowHeight(24);
                }

                $sheet->getRowDimension(1)->setRowHeight(32);
                $sheet->getRowDimension(2)->setRowHeight(26);

                /*
                |--------------------------------------------------------------------------
                | Warna Saldo
                |--------------------------------------------------------------------------
                */

                if ($saldo >= 0) {

                    $sheet->getStyle("F{$row}")
                        ->getFont()
                        ->getColor()
                        ->setRGB('059669');

                } else {

                    $sheet->getStyle("F{$row}")
                        ->getFont()
                        ->getColor()
                        ->setRGB('DC2626');

                }

                /*
                |--------------------------------------------------------------------------
                | Footer
                |--------------------------------------------------------------------------
                */

                $footerRow = $row + 3;

                $sheet->mergeCells("A{$footerRow}:F{$footerRow}");

                $sheet->setCellValue(
                    "A{$footerRow}",
                    'Dicetak pada ' .
                    now()->translatedFormat('d F Y H:i')
                );

                $sheet->getStyle("A{$footerRow}")
                    ->applyFromArray([
                        'font' => [
                            'italic' => true,
                            'size' => 10,
                            'color' => [
                                'rgb' => '64748B'
                            ]
                        ],
                        'alignment' => [
                            'horizontal' => Alignment::HORIZONTAL_RIGHT
                        ]
                    ]);

            }

        ];

    }

}