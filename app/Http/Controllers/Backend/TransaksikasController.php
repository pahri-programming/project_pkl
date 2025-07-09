<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Transaksikas;
use App\Models\User;
use Illuminate\Http\Request;

class TransaksikasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksi = Transaksikas::all();
        $title     = 'Hapus Data Transaksi!';
        $text      = 'Apakah anda yakin ingin menghapus Transaksi ini?';
        confirmDelete($title, $text);
        $users = User::where('isAdmin', '!=', 1)->get();
        return view('backend.transaksi.index', compact('transaksi', 'users'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('backend.transaksi.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id'    => 'required',
            'jenis'      => 'required|in:pemasukan,pengeluaran',
            'jumlah'     => 'required|numeric|min:1',
            'keterangan' => 'required|string|max:255',
            'tanggal'    => 'required|date',

        ]);

        $transaksi             = new Transaksikas();
        $transaksi->user_id    = $request->user_id;
        $transaksi->jenis      = $request->jenis;
        $transaksi->jumlah     = $request->jumlah;
        $transaksi->keterangan = $request->keterangan;
        $transaksi->tanggal    = $request->tanggal;
        $transaksi->save();

        toast('Data Berhasil ditambahkan', 'success');
        return redirect()->route('backend.transaksi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaksi = Transaksikas::findorfail($id);
        $users     = User::all();

        return view('backend.transaksi.show', compact('transaksi', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $transaksi = Transaksikas::findorfail($id);
        $users     = User::all();

        return view('backend.transaksi.edit', compact('transaksi', 'users'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id'    => 'required',
            'jenis'      => 'required|in:pemasukan,pengeluaran',
            'jumlah'     => 'required|numeric|min:1',
            'keterangan' => 'required|string|max:255',
            'tanggal'    => 'required|date',

        ]);

        $transaksi             = Transaksikas::findorFail($id);
        $transaksi->user_id    = $request->user_id;
        $transaksi->jenis      = $request->jenis;
        $transaksi->jumlah     = $request->jumlah;
        $transaksi->keterangan = $request->keterangan;
        $transaksi->tanggal    = $request->tanggal;
        $transaksi->save();

        toast('Data Berhasil diEdit', 'success');
        return redirect()->route('backend.transaksi.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaksi = Transaksikas::findOrfail($id);
        $transaksi->delete();
        toast('Data berhasil dihapus', 'success');
        return redirect()->route('backend.akun.index');
    }
}
