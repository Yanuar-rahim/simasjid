<?php

namespace App\Exports;

use App\Models\Kegiatan;
use App\Models\Masjid;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;

use Maatwebsite\Excel\Events\AfterSheet;

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class KegiatanExport implements FromCollection, ShouldAutoSize, WithEvents
{
    protected $mulai;
    protected $selesai;
    protected $status;
    protected $pemateri;
    protected $keyword;

    public function __construct(
        $mulai = null,
        $selesai = null,
        $status = null,
        $pemateri = null,
        $keyword = null
    ) {
        $this->mulai = $mulai;
        $this->selesai = $selesai;
        $this->status = $status;
        $this->pemateri = $pemateri;
        $this->keyword = $keyword;
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
                $sheet->mergeCells('A1:H1');
                $sheet->mergeCells('A2:H2');
                $sheet->mergeCells('A3:H3');
                $sheet->mergeCells('A4:H4');

                $sheet->setCellValue(
                    'A1',
                    'LAPORAN DATA KEGIATAN'
                );

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
                        .
                        ' s/d ' .
                        \Carbon\Carbon::parse($this->selesai)
                        ->translatedFormat('d F Y');
                } else {

                    $periode = 'Periode : Seluruh Data';
                }

                $sheet->setCellValue('A4', $periode);
                $sheet->setCellValue('A6', 'No');
                $sheet->setCellValue('B6', 'Judul');
                $sheet->setCellValue('C6', 'Tanggal');
                $sheet->setCellValue('D6', 'Jam');
                $sheet->setCellValue('E6', 'Lokasi');
                $sheet->setCellValue('F6', 'Pemateri');
                $sheet->setCellValue('G6', 'Status');
                $sheet->setCellValue('H6', 'Dibuat');
                $kegiatan = Kegiatan::query();
                if ($this->keyword) {
                    $kegiatan->where(function ($q) {

                        $q->where(
                            'judul',
                            'like',
                            '%' . $this->keyword . '%'
                        )

                            ->orWhere(
                                'lokasi',
                                'like',
                                '%' . $this->keyword . '%'
                            );
                    });
                }

                if ($this->pemateri) {
                    $kegiatan->where(
                        'pemateri',
                        'like',
                        '%' . $this->pemateri . '%'
                    );
                }

                if ($this->status) {
                    $kegiatan->where(
                        'status',
                        $this->status
                    );
                }

                if ($this->mulai && $this->selesai) {
                    $kegiatan->whereBetween(
                        'tanggal',
                        [
                            $this->mulai,
                            $this->selesai
                        ]
                    );
                }

                $kegiatan = $kegiatan
                    ->orderBy('tanggal')
                    ->get();

                $row = 7;
                $no = 1;

                foreach ($kegiatan as $item) {
                    $sheet->setCellValue('A' . $row, $no++);
                    $sheet->setCellValue(
                        'B' . $row,
                        $item->judul
                    );

                    $sheet->setCellValue(
                        'C' . $row,
                        \Carbon\Carbon::parse($item->tanggal)
                            ->translatedFormat('d M Y')
                    );

                    $sheet->setCellValue(
                        'D' . $row,
                        $item->jam
                    );

                    $sheet->setCellValue(
                        'E' . $row,
                        $item->lokasi
                    );

                    $sheet->setCellValue(
                        'F' . $row,
                        $item->pemateri
                    );

                    $sheet->setCellValue(
                        'G' . $row,
                        ucfirst($item->status)
                    );

                    $sheet->setCellValue(
                        'H' . $row,
                        $item->created_at->translatedFormat('d M Y')
                    );
                    $row++;
                }

                $sheet->getStyle('A1:H1')->applyFromArray([
                    'font' => [
                        'bold'  => true,
                        'size'  => 18,
                        'color' => ['rgb' => 'FFFFFF']
                    ],

                    'fill' => [
                        'fillType'   => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '2563EB']
                    ],

                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER
                    ]
                ]);

                $sheet->getStyle('A2:H4')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ],

                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER
                    ]
                ]);

                $sheet->getStyle('A6:H6')->applyFromArray([

                    'font' => [
                        'bold'  => true,
                        'color' => ['rgb' => 'FFFFFF']
                    ],

                    'fill' => [
                        'fillType'   => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '16A34A']
                    ],

                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER
                    ]
                ]);

                $sheet->getStyle('A6:H' . ($row - 1))
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN);

                $sheet->getStyle('A6:H' . ($row - 1))
                    ->getAlignment()
                    ->setVertical(Alignment::VERTICAL_CENTER);

                $sheet->getStyle('A6:A' . ($row - 1))
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $sheet->getStyle('C6:H' . ($row - 1))
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $sheet->getStyle('B7:B' . ($row - 1))
                    ->getAlignment()
                    ->setWrapText(true);

                $sheet->getStyle('E7:E' . ($row - 1))
                    ->getAlignment()
                    ->setWrapText(true);

                foreach (range(6, $row) as $r) {
                    $sheet->getRowDimension($r)
                        ->setRowHeight(24);
                }

                $sheet->getColumnDimension('A')->setWidth(8);
                $sheet->getColumnDimension('B')->setWidth(45);
                $sheet->getColumnDimension('C')->setWidth(18);
                $sheet->getColumnDimension('D')->setWidth(15);
                $sheet->getColumnDimension('E')->setWidth(35);
                $sheet->getColumnDimension('F')->setWidth(28);
                $sheet->getColumnDimension('G')->setWidth(15);
                $sheet->getColumnDimension('H')->setWidth(18);
                $sheet->freezePane('A7');
                $sheet->setAutoFilter('A6:H6');
            }
        ];
    }
}
