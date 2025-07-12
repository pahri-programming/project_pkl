<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanExport implements FromView
{
    public $kasmingguan;
    public $transaksi;
    public $jenis;

    public function __construct($kasmingguan, $transaksi, $jenis)
    {
        $this->kasmingguan = $kasmingguan;
        $this->transaksi   = $transaksi;
        $this->jenis       = $jenis;
    }

    public function view(): View
    {
        return view('backend.report.export_excel', [
            'kasmingguan' => $this->kasmingguan,
            'transaksi'   => $this->transaksi,
            'jenis'       => $this->jenis,
        ]);
    }
}

?>