<?php

namespace App\Http\Controllers;

use App\Models\Pengawasan;
use App\Models\Ppiu;
use App\Models\Kemenag_kab_kota;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->level === 'kanwil') {
            $ppiu = Ppiu::all();
            $countPpiu = $ppiu->count();
            $pengawasan = Pengawasan::all();
            $total_jemaah_laki_laki = $pengawasan->sum('jumlah_jemaah_laki_laki');
            $total_jemaah_wanita = $pengawasan->sum('jumlah_jemaah_wanita');
            $total_jemaah = $total_jemaah_laki_laki + $total_jemaah_wanita;
        } elseif (auth()->user()->level === 'kab/kota') {
            $kemenag_kab_kota = Kemenag_kab_kota::where('id_user', auth()->user()->id)->first();
            $ppiu = Ppiu::where('id_kab_kota', $kemenag_kab_kota->id_kab_kota)->get(['id']);
            $countPpiu = $ppiu->count();
            $pengawasan = Pengawasan::whereIn('id_ppiu', $ppiu)->get();
            $total_jemaah_laki_laki = $pengawasan->sum('jumlah_jemaah_laki_laki');
            $total_jemaah_wanita = $pengawasan->sum('jumlah_jemaah_wanita');
            $total_jemaah = $total_jemaah_laki_laki + $total_jemaah_wanita;
        } elseif (auth()->user()->level === 'ppiu') {
            $countPpiu = 0;
            $ppiu = Ppiu::where('id_user', auth()->user()->id)->first();
            $pengawasan = Pengawasan::where('id_ppiu', $ppiu->id)->get();
            $total_jemaah_laki_laki = $pengawasan->sum('jumlah_jemaah_laki_laki');
            $total_jemaah_wanita = $pengawasan->sum('jumlah_jemaah_wanita');
            $total_jemaah = $total_jemaah_laki_laki + $total_jemaah_wanita;

            if ($ppiu->id_akreditasi == null) {
                return view('dashboard.index', [
                    'title' => 'Dashboard',
                    'totalPpiu' => $countPpiu,
                    'totalPengawasan' => $pengawasan->count(),
                    'totalJemaah' => $total_jemaah,
                    'akreditasi' => 'Anda Belum Melakukan Akreditasi!',
                ]);
            } else {

                $tanggal_peringatan = date('d-m-Y', strtotime($ppiu->akreditasi->tanggal_akreditasi . " +4 year"));
                $tanggal_habis = date('d-m-Y', strtotime($ppiu->akreditasi->tanggal_akreditasi . " +5 year"));
                $tanggal_sekarang = date('d-m-Y');

                if ((strtotime($tanggal_sekarang) >= strtotime($tanggal_peringatan)) && (strtotime($tanggal_sekarang) <= strtotime($tanggal_habis))) {
                    // dd('peringatan', $tanggal_sekarang, $tanggal_habis);
                    return view('dashboard.index', [
                        'title' => 'Dashboard',
                        'totalPpiu' => $countPpiu,
                        'totalPengawasan' => $pengawasan->count(),
                        'totalJemaah' => $total_jemaah,
                        'akreditasi' => 'Akreditasi Anda Akan Habis, Silakan Perbarui!',
                    ]);
                }
                if (strtotime($tanggal_sekarang) > strtotime($tanggal_habis)) {
                    // dd('habis', $tanggal_sekarang, $tanggal_habis);
                    return view('dashboard.index', [
                        'title' => 'Dashboard',
                        'totalPpiu' => $countPpiu,
                        'totalPengawasan' => $pengawasan->count(),
                        'totalJemaah' => $total_jemaah,
                        'akreditasi' => 'Akreditasi Anda Sudah Habis, Silakan Perbarui!',
                    ]);
                }

                return view('dashboard.index', [
                    'title' => 'Dashboard',
                    'totalPpiu' => $countPpiu,
                    'totalPengawasan' => $pengawasan->count(),
                    'totalJemaah' => $total_jemaah,
                    'akreditasi' => '',
                ]);
            }
        }
        return view('dashboard.index', [
            'title' => 'Dashboard',
            'totalPpiu' => $countPpiu,
            'totalPengawasan' => $pengawasan->count(),
            'totalJemaah' => $total_jemaah,
        ]);
    }
}
