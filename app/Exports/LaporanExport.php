<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanExport implements FromView
{
    public $kasmingguan;
    public $transaksi;
    public $jenis;
    public $saldokas;
    public $saldonunggak;

    public function __construct($kasmingguan, $transaksi, $jenis, $saldokas, $saldonunggak)
    {
        $this->kasmingguan  = $kasmingguan;
        $this->transaksi    = $transaksi;
        $this->jenis        = $jenis;
        $this->saldokas     = $saldokas;
        $this->saldonunggak = $saldonunggak;
    }

    public function view(): View
    {
        return view('backend.report.export_excel', [
            'kasmingguan'  => $this->kasmingguan,
            'transaksi'    => $this->transaksi,
            'jenis'        => $this->jenis,
            'saldokas'     => $this->saldokas,
            'saldonunggak' => $this->saldonunggak,
        ]);
    }
}
