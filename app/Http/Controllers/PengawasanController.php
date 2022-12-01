<?php

namespace App\Http\Controllers;

use App\Models\FilePengawasan;
use App\Models\Kemenag_Kab_kota;
use App\Models\Ppiu;
use App\Models\Pengawasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PengawasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->level === 'kanwil') {
            $pengawasan = Pengawasan::join('ppius', 'ppius.id', '=', 'id_ppiu')->get(['pengawasans.*']);
            // dd($pengawasan);
        } elseif (auth()->user()->level === 'kab/kota') {
            $kemenag_kab_kota = Kemenag_kab_kota::where('id_user', auth()->user()->id)->first();
            $pengawasan = Pengawasan::join('ppius', 'ppius.id', '=', 'id_ppiu')
                ->where('ppius.id_kab_kota', $kemenag_kab_kota->id_kab_kota)
                ->get(['pengawasans.*']);
        } elseif (auth()->user()->level === 'ppiu') {
            $ppiu = Ppiu::where('id_user', auth()->user()->id)->first();
            $pengawasan = Pengawasan::where('id_ppiu', $ppiu->id)->get();
        }

        $bulan = ['Januari', 'Februari', 'Maret', 'Apri', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $currentTime = Carbon::now();
        $currentTahun = $currentTime->format('Y');

        return view('pengawasan.index', [
            'title' => 'Pengawasan',
            'pengawasans' => $pengawasan,
            'bulans' => $bulan,
            'tahun' => $currentTahun,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Pengawasan::class);
        return view('pengawasan.create', [
            'title' => 'Pengawasan',
            'subtitle' => 'Blanko Pengawasan Umrah',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Pengawasan::class);
        $valid = $request->validate([
            'izin' => 'required',
            'jumlah_jemaah_laki_laki' => 'required|numeric|min:0',
            'jumlah_jemaah_wanita' => 'required|numeric|min:0',
            'tanggal_keberangkatan' => 'required|date|before:tanggal_kepulangan',
            'tanggal_kepulangan' => 'required|date|after:tanggal_keberangkatan',
            'temuan_lapangan' => 'required',
            'data_jemaah' => 'required',
            'data_jemaah.*' => 'required|mimes:pdf|max:2048',
            'petugas_1' => 'required',
            'petugas_2' => 'required',
        ]);

        $data_jemaahs = $request->file('data_jemaah');

        $count_data_jemaah = 0;
        foreach ($data_jemaahs as $data_jemaah) {
            $count_data_jemaah++;
        }

        $total_jemaah = $valid['jumlah_jemaah_laki_laki'] + $valid['jumlah_jemaah_wanita'];

        if ($total_jemaah != $count_data_jemaah) {
            return redirect()->back()->withInput()->with('gagal', 'Jumlah Jemaah Tidak Sesuai dengan Jumlah File yang Diupload!');
        }

        $currentTime = Carbon::now();
        $haris = array('Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu', 'Sunday' => 'Minggu');
        $day = $currentTime->format('l');
        $hari = $haris[$day];
        $valid['hari'] = $hari;
        $tanggal = $currentTime->format('Y-m-d');
        $valid['tanggal'] = $tanggal;
        $jam = $currentTime->format('H:i:s');
        $valid['jam'] = $jam;

        $valid['id_ppiu'] = auth()->user()->ppiu->id;

        $pengawasan = Pengawasan::create($valid);

        foreach ($data_jemaahs as $data_jemaah) {
            $nama_jemaah = $data_jemaah->getClientOriginalName();
            $nama_jemaah = preg_replace("/.pdf/", "", $nama_jemaah);
            $data_jemaah = $data_jemaah->store('file-pengawasan');
            FilePengawasan::create([
                'id_pengawasan' => $pengawasan->id,
                'file_jemaah' => $data_jemaah,
                'nama_jemaah' => $nama_jemaah,
            ]);
        }

        return redirect('/pengawasan/create')->with('berhasil', 'Berhasil Menambahkan Data Pengawasan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengawasan  $pengawasan
     * @return \Illuminate\Http\Response
     */
    public function show(Pengawasan $pengawasan)
    {
        $this->authorize('show', $pengawasan);

        $pengawasan = Pengawasan::find($pengawasan->id);
        $file_pengawasan = FilePengawasan::where('id_pengawasan', $pengawasan->id)->get();

        return view('pengawasan.detail', [
            'title' => 'Pengawasan',
            'subtitle' => 'Detail Pengawasan',
            'pengawasan' => $pengawasan,
            'file_pengawasans' => $file_pengawasan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengawasan  $pengawasan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengawasan $pengawasan)
    {
        $this->authorize('update', $pengawasan);
        return view('pengawasan.edit', [
            'title' => 'Pengawasan',
            'subtitle' => 'Edit Isian Blanko Pengawasan',
            'pengawasan' => $pengawasan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengawasan  $pengawasan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengawasan $pengawasan)
    {
        $this->authorize('update', $pengawasan);
        $valid = $request->validate([
            'izin' => 'required',
            'tanggal_keberangkatan' => 'required|date|before:tanggal_kepulangan',
            'tanggal_kepulangan' => 'required|date|after:tanggal_keberangkatan',
            'temuan_lapangan' => 'required',
            'petugas_1' => 'required',
            'petugas_2' => 'required',
        ]);

        Pengawasan::where('id', $pengawasan->id)
            ->update($valid);

        return redirect('/pengawasan/update/' . $pengawasan->id)->with('berhasil', 'Berhasil Mengubah Data Pengawasan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengawasan  $pengawasan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengawasan $pengawasan)
    {
        $this->authorize('destroy', $pengawasan);
        $file_pengawasans = FilePengawasan::where('id_pengawasan', $pengawasan->id)->get();
        foreach ($file_pengawasans as $file_pengawasan) {
            Storage::delete($file_pengawasan->file_jemaah);
        }
        Pengawasan::destroy($pengawasan->id);
        FilePengawasan::where('id_pengawasan', $pengawasan->id)->delete();

        return redirect('/pengawasan')->with('berhasil', 'Berhasil Menghapus Data Pengawasan!');
    }

    public function export(Request $request)
    {
        $valid = $request->validate([
            'bulan' => 'required',
            'tahun' => 'required|numeric|min:2010',
        ]);

        if (auth()->user()->level == 'kanwil') {
            $pengawasans = Pengawasan::whereYear('tanggal_keberangkatan', $valid['tahun'])
                ->whereMonth('tanggal_keberangkatan', $valid['bulan'])
                ->get();

            $nama = 'Kantor Wilayah Kementerian Agama Sumatra Barat';
        } elseif (auth()->user()->level == 'kab/kota') {
            $kemenag_kab_kota = Kemenag_Kab_kota::where('id_user', auth()->user()->id)->first();
            $pengawasans = Pengawasan::join('ppius', 'ppius.id', '=', 'id_ppiu')
                ->where('ppius.id_kab_kota', $kemenag_kab_kota->id_kab_kota)
                ->whereYear('tanggal_keberangkatan', $valid['tahun'])
                ->whereMonth('tanggal_keberangkatan', $valid['bulan'])
                ->get(['pengawasans.*']);

            $nama = $kemenag_kab_kota->nama;
        } elseif (auth()->user()->level == 'ppiu') {
            $ppiu = Ppiu::where('id_user', auth()->user()->id)->first();
            $pengawasans = Pengawasan::where('id_ppiu', $ppiu->id)
                ->whereYear('tanggal_keberangkatan', $valid['tahun'])
                ->whereMonth('tanggal_keberangkatan', $valid['bulan'])
                ->get();

            $nama = $ppiu->nama;
        }

        if ($pengawasans->isEmpty()) {
            return redirect()->back()->withInput()->with('info', 'Data Kosong!');
        }

        $noBulan = $valid['bulan'];
        $arrNamaBulan = array('1' => 'Januari', '2' => 'Februari', '3' => 'Maret', '4' => 'April', '5' => 'Mei', '6' => 'Juni', '7' => 'Juli', '8' => 'Agustus', '9' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember');
        $bulan = $arrNamaBulan[$noBulan];

        $namaFile = "Pengisian Blanko Pengawasan Umrah " . $nama . " " . "$bulan" . " " . $valid['tahun'] . '.xlsx';

        $no = 1;

        echo "
        <link rel='stylesheet' href='/sweetalert2/sweetalert2.min.css'>
        <script src='/sweetalert2/sweetalert2.min.js'></script>
        <script type='text/javascript' src='/table-to-excel-master/dist/tableToExcel.js'></script>
        <table id='table1' data-cols-width='4,14,12,12,30,15,20,10,10,14,14,20,20,20' style='color: white;'>
        <tr>
            <th data-a-h='center' colspan='14'>Pengisian Blanko Pengawasan Umrah</th>
        </tr>
        <tr>            
            <th data-a-h='center' colspan='14'>" . $nama . "</th>
        </tr>
        <tr>
            <th data-a-h='center' colspan='14'>" . $bulan . " " . $valid['tahun'] . "</th>
        </tr>
        <tr>
            <th data-a-h='center' data-b-b-s='medium' data-b-t-s='medium' data-b-l-s='medium' data-f-bold='true' rowspan='2'>No</th>
            <th data-a-h='center' data-b-b-s='medium' data-b-t-s='medium' data-b-l-s='thin' data-f-bold='true' rowspan='2'>Hari</th>
            <th data-a-h='center' data-b-b-s='medium' data-b-t-s='medium' data-b-l-s='thin' data-f-bold='true' rowspan='2'>Tanggal</th>
            <th data-a-h='center' data-b-b-s='medium' data-b-t-s='medium' data-b-l-s='thin' data-f-bold='true' rowspan='2'>Jam</th>
            <th data-a-h='center' data-b-b-s='medium' data-b-t-s='medium' data-b-l-s='thin' data-f-bold='true' rowspan='2'>PPIU</th>
            <th data-a-h='center' data-b-b-s='medium' data-b-t-s='medium' data-b-l-s='thin' data-f-bold='true' rowspan='2'>Status PPIU</th>
            <th data-a-h='center' data-b-b-s='medium' data-b-t-s='medium' data-b-l-s='thin' data-f-bold='true' rowspan='2'>Izin</th>
            <th data-a-h='center' data-b-b-s='thin' data-b-t-s='medium' data-b-l-s='thin' data-f-bold='true' colspan='2'>Jumlah Jemaah</th>
            <th data-a-h='center' data-b-b-s='thin' data-b-t-s='medium' data-b-l-s='thin' data-f-bold='true' colspan='2'>Tanggal</th>
            <th data-a-h='center' data-b-b-s='medium' data-b-t-s='medium' data-b-l-s='thin' data-f-bold='true' rowspan='2'>Temuan Lapangan</th>
            <th data-a-h='center' data-b-b-s='medium' data-b-t-s='medium' data-b-l-s='thin' data-f-bold='true' rowspan='2'>Petugas 1</th>
            <th data-a-h='center' data-b-b-s='medium' data-b-t-s='medium' data-b-l-s='thin' data-b-r-s='medium' data-f-bold='true' rowspan='2'>Petugas 2</th>
        </tr>
        <tr>
            <th data-a-h='center' data-b-b-s='medium' data-b-l-s='thin' data-f-bold='true'>Laki-laki</th>
            <th data-a-h='center' data-b-b-s='medium' data-b-l-s='thin' data-f-bold='true'>Wanita</th>
            <th data-a-h='center' data-b-b-s='medium' data-b-l-s='thin' data-f-bold='true'>Keberangkatan</th>
            <th data-a-h='center' data-b-b-s='medium' data-b-l-s='thin' data-f-bold='true'>Kepulangan</th>
        </tr>";
        foreach ($pengawasans as $pengawasan) {
            echo "
        <tr>
            <td data-b-l-s='medium' data-t='n'>" . $no . "</td>
            <td data-b-l-s='thin'>" . $pengawasan->hari . "</td>
            <td data-b-l-s='thin' data-t='d'>" . $pengawasan->tanggal . "</td>
            <td data-b-l-s='thin'>" . $pengawasan->jam . "</td>
            <td data-b-l-s='thin'>" . $pengawasan->ppiu->nama . "</td>
            <td data-b-l-s='thin'>" . $pengawasan->ppiu->status . "</td>
            <td data-b-l-s='thin'>" . $pengawasan->izin . "</td>
            <td data-b-l-s='thin' data-t='n'>" . $pengawasan->jumlah_jemaah_laki_laki . "</td>
            <td data-b-l-s='thin' data-t='n'>" . $pengawasan->jumlah_jemaah_wanita . "</td>
            <td data-b-l-s='thin' data-t='d'>" . $pengawasan->tanggal_keberangkatan . "</td>
            <td data-b-l-s='thin' data-t='d'>" . $pengawasan->tanggal_kepulangan . "</td>
            <td data-b-l-s='thin'>" . $pengawasan->temuan_lapangan . "</td>
            <td data-b-l-s='thin'>" . $pengawasan->petugas_1 . "</td>
            <td data-b-l-s='thin' data-b-r-s='medium'>" . $pengawasan->petugas_2 . "</td>
        </tr>";
            $no++;
        }
        echo "               
        <tr>
            <td data-b-t-s='medium'></td>
            <td data-b-t-s='medium'></td>
            <td data-b-t-s='medium'></td>
            <td data-b-t-s='medium'></td>
            <td data-b-t-s='medium'></td>
            <td data-b-t-s='medium'></td>
            <td data-b-t-s='medium'></td>
            <td data-b-t-s='medium'></td>
            <td data-b-t-s='medium'></td>
            <td data-b-t-s='medium'></td>
            <td data-b-t-s='medium'></td>
            <td data-b-t-s='medium'></td>
            <td data-b-t-s='medium'></td>
            <td data-b-t-s='medium'></td>
        </tr>    
    </table>
    <script>
    TableToExcel.convert(document.getElementById('table1'), {
        name: '" . $namaFile . "',
        sheet: {
            name: 'Sheet 1'
        }
    });
    let timerInterval
    Swal.fire({
        title: 'File Anda Sedang Di-download!',
        html: '-',
        timer: 2000,
        width: '100%',
        position: 'top',
        timerProgressBar: true,  
        showClass: {
            backdrop: 'swal2-noanimation', 
            popup: '',                     
            icon: ''                       
          },
          hideClass: {
            popup: '',                     
          },              
        didOpen: () => {
            Swal.showLoading()
            const b = Swal.getHtmlContainer().querySelector('b')
            timerInterval = setInterval(() => {
            b.textContent = Swal.getTimerLeft()
            }, 100)
        },
        willClose: () => {
            clearInterval(timerInterval)
        }
        }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {
            console.log('I was closed by the timer')
        }
    })
    </script>";

        return redirect('/pengawasan')->with('berhasil', 'Berhasil Meng-export Data Pengawasan!');
    }
}
