<?php

namespace App\Exports;

use App\Models\Donasi;
use App\Models\Masjid;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

use Maatwebsite\Excel\Events\AfterSheet;

class DonasiExport implements FromCollection, ShouldAutoSize, WithEvents
{
    protected $mulai;
    protected $selesai;
    protected $status;
    protected $jenis;

    public function __construct(
        $mulai = null,
        $selesai = null,
        $status = null,
        $jenis = null
    ) {
        $this->mulai = $mulai;
        $this->selesai = $selesai;
        $this->status = $status;
        $this->jenis = $jenis;
    }

    public function collection()
    {
        return collect([]);
    }

    public function registerEvents(): array
    {
        return [

            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();

                $masjid = Masjid::first();

                /*
|--------------------------------------------------------------------------
| HEADER
|--------------------------------------------------------------------------
*/

                $sheet->mergeCells('A1:G1');
                $sheet->mergeCells('A2:G2');
                $sheet->mergeCells('A3:G3');
                $sheet->mergeCells('A4:G4');

                $sheet->setCellValue('A1', 'LAPORAN DONASI MASJID');

                $sheet->setCellValue(
                    'A2',
                    $masjid->nama_masjid ?? '-'
                );

                $sheet->setCellValue(
                    'A3',
                    ($masjid->alamat ?? '-') .
                        ' | Telp : ' .
                        ($masjid->telepon ?? '-') .
                        ' | Email : ' .
                        ($masjid->email ?? '-')
                );

                if ($this->mulai && $this->selesai) {

                    $periode =
                        'Periode : ' .
                        \Carbon\Carbon::parse($this->mulai)
                        ->translatedFormat('d F Y')
                        . ' s/d ' .
                        \Carbon\Carbon::parse($this->selesai)
                        ->translatedFormat('d F Y');
                } else {

                    $periode = 'Periode : Seluruh Data';
                }

                $sheet->setCellValue('A4', $periode);

                // =====================
                // STYLE HEADER
                // =====================

                $sheet->getStyle('A1:G1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 18,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '059669'],
                    ],
                ]);

                $sheet->getStyle('A2:G4')->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                $sheet->getStyle('A2')->getFont()->setBold(true)->setSize(14);

                /*
|--------------------------------------------------------------------------
| HEADER TABEL
|--------------------------------------------------------------------------
*/

                $sheet->fromArray([
                    [
                        'No',
                        'Tanggal',
                        'Donatur',
                        'Jenis Donasi',
                        'Metode',
                        'Status',
                        'Nominal'
                    ]
                ], null, 'A6');

                // =====================
                // HEADER TABEL
                // =====================

                $sheet->getStyle('A6:G6')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '10B981'],
                    ],
                ]);

                $donasi = Donasi::query();

                if ($this->mulai && $this->selesai) {

                    $donasi->whereBetween('tanggal', [
                        $this->mulai,
                        $this->selesai
                    ]);
                }

                if ($this->status) {

                    $donasi->where(
                        'transaction_status',
                        $this->status
                    );
                }

                if ($this->jenis) {

                    $donasi->where(
                        'jenis_donasi',
                        $this->jenis
                    );
                }

                $donasi = $donasi
                    ->orderBy('tanggal')
                    ->get();

                $row = 7;

                $no = 1;

                foreach ($donasi as $item) {

                    $status = match ($item->transaction_status) {
                        'settlement' => 'Berhasil',
                        'pending'    => 'Pending',
                        'expire'     => 'Expired',
                        'deny'       => 'Ditolak',
                        'cancel'     => 'Dibatalkan',
                        default      => ucfirst($item->transaction_status),
                    };

                    $sheet->setCellValue('A' . $row, $no++);
                    $sheet->setCellValue(
                        'B' . $row,
                        \Carbon\Carbon::parse($item->tanggal)
                            ->translatedFormat('d M Y')
                    );
                    $sheet->setCellValue('C' . $row, $item->nama_donatur);
                    $sheet->setCellValue('D' . $row, $item->jenis_donasi);
                    $sheet->setCellValue('E' . $row, strtoupper($item->metode));
                    $sheet->setCellValue('F' . $row, $status);
                    $sheet->setCellValue('G' . $row, $item->nominal);

                    $row++;
                }



                $sheet
                    ->getStyle("G7:G" . ($row - 1))
                    ->getNumberFormat()
                    ->setFormatCode('"Rp " #,##0');

                // =====================
                // BORDER TABEL
                // =====================

                $sheet->getStyle("A6:G" . ($row - 1))
                    ->applyFromArray([
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN,
                            ],
                        ],
                    ]);

                $sheet->freezePane('A7');

                $sheet->setAutoFilter("A6:G".($row-1));

                $sheet->getColumnDimension('A')->setWidth(8);
                $sheet->getColumnDimension('B')->setWidth(18);
                $sheet->getColumnDimension('C')->setWidth(32);
                $sheet->getColumnDimension('D')->setWidth(22);
                $sheet->getColumnDimension('E')->setWidth(18);
                $sheet->getColumnDimension('F')->setWidth(18);
                $sheet->getColumnDimension('G')->setWidth(18);

                $totalDonasi = $donasi->sum('nominal');

                $row += 2;

                $sheet->setCellValue(
                    'F' . $row,
                    'Total Donasi'
                );

                $sheet->setCellValue(
                    'G' . $row,
                    $totalDonasi
                );

                $sheet->getStyle("F{$row}:G{$row}")
    ->applyFromArray([
        'font' => [
            'bold' => true,
        ],
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => [
                'rgb' => 'ECFDF5',
            ],
        ],
    ]);

$sheet
    ->getStyle("G{$row}")
    ->getNumberFormat()
    ->setFormatCode('"Rp " #,##0');
            }

        ];

        $row += 4;

$sheet->mergeCells("A{$row}:G{$row}");

$sheet->setCellValue(
    "A{$row}",
    "Dicetak pada ".now()->translatedFormat('d F Y H:i')
);

$sheet->getStyle("A{$row}")
    ->getAlignment()
    ->setHorizontal(Alignment::HORIZONTAL_RIGHT);

$sheet->getStyle("A{$row}")
    ->getFont()
    ->setItalic(true);
    }
}
