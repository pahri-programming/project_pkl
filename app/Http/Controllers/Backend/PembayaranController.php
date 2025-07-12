<?php
namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Kasmingguan;
use App\Models\Pembayaran;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembayaran = Pembayaran::all();
        $users      = User::all();
        $title      = 'Hapus Data Pembayaran!';
        $text       = 'Apakah anda yakin ingin menghapus Pembayaran ini?';
        confirmDelete($title, $text);
        return view('backend.pembayaran.index', compact('pembayaran', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('backend.pembayaran.create', compact('users'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'jumlah'  => 'required|numeric|min:1',
            'tanggal' => 'required|date',
        ]);

        $pembayaran          = new Pembayaran();
        $pembayaran->user_id = $request->user_id;
        $pembayaran->jumlah  = $request->jumlah;
        $pembayaran->tanggal = $request->tanggal;
        $pembayaran->save();

        $tanggal  = Carbon::parse($request->tanggal);
        $mingguKe = ceil($tanggal->day / 7);
        $bulan    = $tanggal->month;

        // Cek apakah kas mingguan untuk user, minggu, bulan sudah ada
        $kasmingguan = Kasmingguan::where('user_id', $request->user_id)
            ->where('minggu_ke', $mingguKe)
            ->where('bulan', $bulan)
            ->first();

        if ($kasmingguan) {
            // Update jumlah
            $kasmingguan->jumlah += $request->jumlah;

            // Update status jika total sudah 10.000 atau lebih
            $kasmingguan->status = $kasmingguan->jumlah >= 10000 ? 'lunas' : 'belum';

            // Update tanggal bayar terakhir
            $kasmingguan->tanggal_bayar = $tanggal;

            $kasmingguan->save();
        } else {
            // Belum ada, buat baru
            $status = $request->jumlah >= 10000 ? 'lunas' : 'belum';

            Kasmingguan::create([
                'user_id'       => $request->user_id,
                'status'        => $status,
                'minggu_ke'     => $mingguKe,
                'bulan'         => $bulan,
                'jumlah'        => $request->jumlah,
                'tanggal_bayar' => $tanggal,
            ]);
        }

        toast('Data berhasil ditambah', 'success');
        return redirect()->route('backend.pembayaran.index');

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
        $pembayaran = Pembayaran::findorfail($id);
        $users      = User::all();
        return view('backend.pembayaran.edit', compact('pembayaran', 'users'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'jumlah'  => 'required|numeric|min:1',
            'tanggal' => 'required|date',
        ]);

        $pembayaranLama = Pembayaran::findOrFail($id);

        $userIdLama   = $pembayaranLama->user_id;
        $tanggalLama  = Carbon::parse($pembayaranLama->tanggal);
        $mingguKeLama = ceil($tanggalLama->day / 7);
        $bulanLama    = $tanggalLama->month;

        $kasLama = Kasmingguan::where('user_id', $userIdLama)
            ->where('minggu_ke', $mingguKeLama)
            ->where('bulan', $bulanLama)
            ->first();

        if ($kasLama) {
            $kasLama->jumlah -= $pembayaranLama->jumlah;

            if ($kasLama->jumlah <= 0) {
                $kasLama->delete(); // Jika tidak ada pembayaran lain, hapus kas
            } else {
                $kasLama->status = $kasLama->jumlah >= 10000 ? 'lunas' : 'belum';
                $kasLama->save();
            }
        }

        // Update pembayaran
        $pembayaranLama->user_id = $request->user_id;
        $pembayaranLama->jumlah  = $request->jumlah;
        $pembayaranLama->tanggal = $request->tanggal;
        $pembayaranLama->save();

        // Hitung minggu & bulan baru
        $tanggalBaru  = Carbon::parse($request->tanggal);
        $mingguKeBaru = ceil($tanggalBaru->day / 7);
        $bulanBaru    = $tanggalBaru->month;

        // Update / Tambah data ke kas mingguan
        $kasBaru = Kasmingguan::where('user_id', $request->user_id)
            ->where('minggu_ke', $mingguKeBaru)
            ->where('bulan', $bulanBaru)
            ->first();

        if ($kasBaru) {
            $kasBaru->jumlah += $request->jumlah;
            $kasBaru->status        = $kasBaru->jumlah >= 10000 ? 'lunas' : 'belum';
            $kasBaru->tanggal_bayar = $tanggalBaru;
            $kasBaru->save();
        } else {
            Kasmingguan::create([
                'user_id'       => $request->user_id,
                'minggu_ke'     => $mingguKeBaru,
                'bulan'         => $bulanBaru,
                'jumlah'        => $request->jumlah,
                'tanggal_bayar' => $tanggalBaru,
                'status'        => $request->jumlah >= 10000 ? 'lunas' : 'belum',
            ]);
        }

        toast('Data berhasil diedit', 'success');
        return redirect()->route('backend.pembayaran.index');

    }

   
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $tanggal  = \Carbon\Carbon::parse($pembayaran->tanggal);
        $mingguKe = ceil($tanggal->day / 7);
        $bulan    = $tanggal->month;
        $userId   = $pembayaran->user_id;

        // Hapus pembayaran
        $pembayaran->delete();

        // Ambil semua pembayaran lain (setelah penghapusan) di minggu+bulan itu
        $pembayarans = Pembayaran::where('user_id', $userId)
            ->whereMonth('tanggal', $bulan)
            ->get()
            ->filter(function ($item) use ($mingguKe) {
                return ceil(\Carbon\Carbon::parse($item->tanggal)->day / 7) == $mingguKe;
            });

        // Cek apakah masih ada pembayaran di minggu itu
        if ($pembayarans->isEmpty()) {
            // Hapus kas_mingguans karena tidak ada pembayaran tersisa
            \App\Models\KasMingguan::where('user_id', $userId)
                ->where('bulan', $bulan)
                ->where('minggu_ke', $mingguKe)
                ->delete();
        } else {
            // Update kas_mingguans: jumlah dan tanggal_bayar terakhir
            $totalJumlah     = $pembayarans->sum('jumlah');
            $tanggalTerakhir = $pembayarans->last()->tanggal;

            $status = $totalJumlah >= 10000 ? 'lunas' : 'belum';

            \App\Models\KasMingguan::where('user_id', $userId)
                ->where('bulan', $bulan)
                ->where('minggu_ke', $mingguKe)
                ->update([
                    'jumlah'        => $totalJumlah,
                    'status'        => $status,
                    'tanggal_bayar' => $tanggalTerakhir,
                ]);
        }

        toast('Data berhasil dihapus', 'success');
        return redirect()->route('backend.pembayaran.index');
    }

}
