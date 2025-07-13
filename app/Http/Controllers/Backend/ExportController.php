<?php
namespace App\Http\Controllers\Backend;

use App\Exports\LaporanExport;
use App\Http\Controllers\Controller;
use App\Models\Kasmingguan;
use App\Models\Transaksikas;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function index(Request $request)
    {
        $totalpemasukan = Transaksikas::where('jenis','pemasukan')->sum('jumlah');
        $totalpengeluaran = TransaksiKas::where('jenis','pengeluaran')->sum('jumlah');
        
        $totalpembayaran = Pembayaran::sum('jumlah');
        $saldokas = $totalpembayaran + $totalpemasukan - $totalpengeluaran;

        $saldonunggak = Kasmingguan::where('status','belum')->get()->sum(function($kas){
            return 10000 - $kas->jumlah;
        });
        $start_date = $request->get('start_date');
        $end_date   = $request->get('end_date');
        $jenis      = $request->jenis;

        $kasmingguan = collect();
        $transaksi   = collect();

        if ($jenis === 'kasmingguan') {
            $kasQuery = Kasmingguan::with('users');
            if ($start_date && $end_date) {
                $kasQuery->whereBetween('tanggal_bayar', [$start_date, $end_date]);
            }
            $kasmingguan = $kasQuery->get();
        } elseif (in_array($jenis, ['pemasukan', 'pengeluaran'])) {
            $trxQuery = Transaksikas::where('jenis', $jenis);
            if ($start_date && $end_date) {
                $trxQuery->whereBetween('tanggal', [$start_date, $end_date]);
            }
            $transaksi = $trxQuery->get();
        }

        if ($request->export == 'excel') {
            $filename = 'laporan_' . $jenis . '_' . now()->format('Ymd_His') . '.xlsx';

            return Excel::download(new LaporanExport($kasmingguan, $transaksi, $jenis, $saldokas,$saldonunggak), $filename );
        }
        return view('backend.report.index', compact('transaksi', 'kasmingguan', 'jenis','saldokas','saldonunggak'));

    }

    // public function exportExcel(Request $request)
    // {
    //     return Excel::download(new KasMingguanExport($request), 'kas_mingguan_report.xlsx');
    // }

    // public function exportPDF(Request $request)
    // {
    //     $query = Kasmingguan::with('user')->whereYear('tanggal_bayar', $request->get('year', date('Y')));

    //     if ($request->status !== 'all') {
    //         $query->where('status', $request->status);
    //     }

    //     if ($request->start_date) {
    //         $query->whereDate('tanggal_bayar', '>=', $request->start_date);
    //     }

    //     if ($request->end_date) {
    //         $query->whereDate('tanggal_bayar', '<=', $request->end_date);
    //     }

    //     $kasmingguan = $query->get();

    //     $pdf = PDF::loadView('backend.report.export_pdf', compact('kasmingguan'))->setPaper('A4', 'landscape');

    //     return $pdf->download('kas_mingguan_report.pdf');
    // }
}
