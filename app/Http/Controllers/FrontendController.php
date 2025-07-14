<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Transaksikas;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalPemasukan   = Transaksikas::where('jenis', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = Transaksikas::where('jenis', 'pengeluaran')->sum('jumlah');

        $totalPembayaran = Pembayaran::sum('jumlah');
        $saldokas        = $totalPembayaran + $totalPemasukan - $totalPengeluaran;

        $transaksi = Transaksikas::where('jenis', 'pengeluaran')->get();

        return view('index', compact(
            'totalPemasukan',
            'totalPengeluaran',
            'totalPembayaran',
            'saldokas',
            'transaksi'
        ));

    }

    public function profile($id)
    {
        $jumlahuang = Pembayaran::where('user_id', $id)->sum('jumlah');

        return view('profile', compact('jumlahuang'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
