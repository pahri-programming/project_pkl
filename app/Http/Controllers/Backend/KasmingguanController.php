<?php
namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Kasmingguan;
use App\Models\User;

class KasmingguanController extends Controller
{
    public function index()
    {
        $kasmingguan = Kasmingguan::all();
        $users       = User::all();
        $title       = 'Hapus Data Kas!';
        $text        = "Apakah Anda Yakin??";
        confirmDelete($title, $text);

        return view('backend.kasmingguan.index', compact('kasmingguan', 'users'));
    }

    public function show($id)
    {
        $kasmingguan = Kasmingguan::findOrFail($id);
        $mingguKe    = $kasmingguan->minggu_ke;
        $bulan       = $kasmingguan->bulan;
        $userId      = $kasmingguan->user_id;

        // Ambil semua pembayaran user yang masuk minggu & bulan yang sama
        $pembayaran = Pembayaran::where('user_id', $userId)
            ->whereMonth('tanggal', $bulan)
            ->get()
            ->filter(function ($pembayaran) use ($mingguKe) {
                return ceil(\Carbon\Carbon::parse($pembayaran->tanggal)->day / 7) == $mingguKe;
            });

        // Total jumlah dibayarkan
        $totalJumlah = $pembayaran->sum('jumlah');

        // Ambil daftar tanggal
        $tanggalList = $pembayaran->map(function ($item) {
            $tanggal = \Carbon\Carbon::parse($item->tanggal)->format('d M Y');
            $jumlah  = number_format($item->jumlah, 0, '.', '.');
            return "{$tanggal} (Rp. {$jumlah})";
        });

        return view('backend.kasmingguan.show', compact('kasmingguan', 'totalJumlah', 'tanggalList'));
    }

    public function destroy(string $id)
    {
        $kasmingguan = Kasmingguan::findOrFail($id);
        $kasmingguan->delete();
        toast('Data berhasil dihapus', 'success');
        return redirect()->route('backend.kasmingguan.index');

    }
}
