<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Masjid;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

use Maatwebsite\Excel\Events\AfterSheet;

class PenggunaExport implements FromCollection, ShouldAutoSize, WithEvents
{
    protected $mulai;
    protected $selesai;
    protected $role;
    protected $status;
    protected $keyword;

    public function __construct(
        $mulai = null,
        $selesai = null,
        $role = null,
        $status = null,
        $keyword = null
    ) {
        $this->mulai = $mulai;
        $this->selesai = $selesai;
        $this->role = $role;
        $this->status = $status;
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

                /*
            |--------------------------------------------------------------------------
            | HEADER
            |--------------------------------------------------------------------------
            */

                $sheet->mergeCells('A1:G1');
                $sheet->mergeCells('A2:G2');
                $sheet->mergeCells('A3:G3');
                $sheet->mergeCells('A4:G4');

                $sheet->setCellValue('A1', 'LAPORAN DATA PENGGUNA');

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

                /*
            |--------------------------------------------------------------------------
            | HEADER TABEL
            |--------------------------------------------------------------------------
            */

                $sheet->fromArray([
                    [
                        'No',
                        'Nama',
                        'Email',
                        'Role',
                        'Status',
                        'Tanggal Daftar',
                        'Last Seen'
                    ]
                ], null, 'A6');

                /*
            |--------------------------------------------------------------------------
            | QUERY
            |--------------------------------------------------------------------------
            */

                $users = User::query();

                if ($this->keyword) {

                    $users->where(function ($q) {

                        $q->where('name', 'like', '%' . $this->keyword . '%')
                            ->orWhere('email', 'like', '%' . $this->keyword . '%');
                    });
                }

                if ($this->role) {
                    $users->where('role', $this->role);
                }

                if ($this->mulai && $this->selesai) {

                    $users->whereBetween('created_at', [
                        $this->mulai,
                        $this->selesai
                    ]);
                }

                if ($this->status == 'online') {

                    $users->whereNotNull('last_seen')
                        ->where('last_seen', '>=', now()->subMinutes(5));
                }

                if ($this->status == 'offline') {

                    $users->where(function ($q) {

                        $q->whereNull('last_seen')
                            ->orWhere(
                                'last_seen',
                                '<',
                                now()->subMinutes(5)
                            );
                    });
                }

                $users = $users
                    ->orderBy('name')
                    ->get();

                /*
            |--------------------------------------------------------------------------
            | ISI DATA
            |--------------------------------------------------------------------------
            */

                $row = 7;
                $no = 1;

                foreach ($users as $user) {

                    $sheet->setCellValue('A' . $row, $no++);
                    $sheet->setCellValue('B' . $row, $user->name);
                    $sheet->setCellValue('C' . $row, $user->email);
                    $sheet->setCellValue('D' . $row, ucfirst($user->role));

                    $sheet->setCellValue(
                        'E' . $row,
                        ($user->last_seen &&
                            $user->last_seen >= now()->subMinutes(5))
                            ? 'Online'
                            : 'Offline'
                    );

                    $sheet->setCellValue(
                        'F' . $row,
                        $user->created_at->translatedFormat('d M Y')
                    );

                    $sheet->setCellValue(
                        'G' . $row,
                        $user->last_login_at
                            ? \Carbon\Carbon::parse($user->last_login_at)->diffForHumans()
                            : '-'
                    );

                    $row++;
                }

                /*
            |--------------------------------------------------------------------------
            | STYLE HEADER
            |--------------------------------------------------------------------------
            */

                $sheet->getStyle('A1:G1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 18,
                        'color' => [
                            'rgb' => 'FFFFFF'
                        ]
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => '2563EB'
                        ]
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER
                    ]
                ]);

                $sheet->getStyle('A2:G4')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER
                    ]
                ]);

                /*
            |--------------------------------------------------------------------------
            | STYLE HEADER TABEL
            |--------------------------------------------------------------------------
            */

                $sheet->getStyle('A6:G6')->applyFromArray([

                    'font' => [
                        'bold' => true,
                        'color' => [
                            'rgb' => 'FFFFFF'
                        ]
                    ],

                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => '16A34A'
                        ]
                    ],

                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER
                    ]
                ]);

                /*
            |--------------------------------------------------------------------------
            | BORDER
            |--------------------------------------------------------------------------
            */

                $sheet->getStyle("A6:G" . ($row - 1))
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN);

                /*
            |--------------------------------------------------------------------------
            | FONT
            |--------------------------------------------------------------------------
            */

                $sheet->getStyle("A1:G" . ($row - 1))
                    ->getFont()
                    ->setName('Calibri')
                    ->setSize(11);

                /*
            |--------------------------------------------------------------------------
            | ROW HEIGHT
            |--------------------------------------------------------------------------
            */

                foreach (range(6, $row - 1) as $r) {

                    $sheet->getRowDimension($r)
                        ->setRowHeight(24);
                }

                /*
            |--------------------------------------------------------------------------
            | COLUMN WIDTH
            |--------------------------------------------------------------------------
            */

                $sheet->getColumnDimension('A')->setWidth(8);
                $sheet->getColumnDimension('B')->setWidth(28);
                $sheet->getColumnDimension('C')->setWidth(40);
                $sheet->getColumnDimension('D')->setWidth(15);
                $sheet->getColumnDimension('E')->setWidth(15);
                $sheet->getColumnDimension('F')->setWidth(20);
                $sheet->getColumnDimension('G')->setWidth(25);

                /*
            |--------------------------------------------------------------------------
            | WRAP TEXT
            |--------------------------------------------------------------------------
            */

                $sheet->getStyle("A6:G" . ($row - 1))
                    ->getAlignment()
                    ->setWrapText(true);

                /*
            |--------------------------------------------------------------------------
            | ALIGNMENT
            |--------------------------------------------------------------------------
            */

                $sheet->getStyle("A7:A" . ($row - 1))
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $sheet->getStyle("B7:C" . ($row - 1))
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_LEFT);

                $sheet->getStyle("D7:G" . ($row - 1))
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                /*
            |--------------------------------------------------------------------------
            | FREEZE & FILTER
            |--------------------------------------------------------------------------
            */

                $sheet->freezePane('A7');
                $sheet->setAutoFilter("A6:G6");
            }
        ];
    }
}
