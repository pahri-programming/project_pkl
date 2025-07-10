<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaksikas;
use App\Models\Pembayaran;

class BackendController extends Controller
{
    public function index()
    {
        $totalUser = User::count();

        $totalPemasukan = Transaksikas::where('jenis','pemasukan')->sum('jumlah');
        $totalPengeluaran = Transaksikas::where('jenis','pengeluaran')->sum('jumlah');

        $totalPembayaran = Pembayaran::sum('jumlah');
        $saldoKas = $totalPembayaran + $totalPemasukan - $totalPengeluaran;
        return view('backend.index', compact(
            'totalUser',
            'totalPemasukan',
            'totalPengeluaran',
            'totalPembayaran',
            'saldoKas'
        ));
    }
}
