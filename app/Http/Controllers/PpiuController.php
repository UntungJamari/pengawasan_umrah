<?php

namespace App\Http\Controllers;

use App\Models\Kab_kota;
use App\Models\Kemenag_kab_kota;
use App\Models\Ppiu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PpiuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Ppiu::class);
        if (auth()->user()->level === 'kanwil') {
            $ppiu = Ppiu::all();
        } elseif (auth()->user()->level === 'kab/kota') {
            $kemenag_kab_kota = Kemenag_kab_kota::where('id_user', auth()->user()->id)->first();
            $ppiu = Ppiu::where('id_kab_kota', $kemenag_kab_kota->id_kab_kota)
                ->get();
        }
        return view('ppiu.index', [
            'title' => 'PPIU',
            'ppius' =>  $ppiu
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Ppiu::class);
        return view('ppiu.create', [
            'title' => 'PPIU',
            'subtitle' => 'Tambah PPIU',
            'kab_kotas' => Kab_kota::all()
        ]);
    }

    public function cariPpiu(Request $request)
    {
        $this->authorize('create', Ppiu::class);
        if ($request->get('query')) {
            $query = $request->get('query');
            $ppius = Ppiu::where('status', 'Pusat')
                ->where('nama', 'LIKE', "%{$query}%")
                ->get();
            $output = '<ul class="dropdown-menu mx-3" style="display:block; position:absolute;width:97%;]">';
            foreach ($ppius as $ppiu) {
                $output .= '
                <li><a class="dropdown-item" href="#">' . $ppiu->nama . '</a></li>
                ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Ppiu::class);
        if (auth()->user()->level === 'kab/kota') {
            $kemenag_kab_kotas = Kemenag_kab_kota::all();
            $kemenag_kab_kota = $kemenag_kab_kotas->where('id_user', auth()->user()->id)->first();
            $request->merge([
                'id_kab_kota' => $kemenag_kab_kota->id_kab_kota,
                'status' => 'Cabang',
            ]);
        }

        $valid1 = $request->validate([
            'username' => 'required|min:7|max:255|unique:users',
        ]);

        $valid2 = $request->validate([
            'nama' => 'required|min:7|max:255',
            'id_kab_kota' => 'required',
            'nama_pimpinan' => '',
            'status' => 'required',
            'nomor_sk' => 'required',
            'tanggal_sk' => 'required|date',
            'alamat' => 'required',
            'logo' => 'image|file|max:1024',
        ]);

        $valid1['password'] = bcrypt('11111111');
        $valid1['level'] = 'ppiu';

        if ($request->status == 'Pusat') {
            $cek_pusat = Ppiu::where('nama', $request->nama)
                ->where('status', $request->status)
                ->first();
            if ($cek_pusat) {
                return redirect()->back()->withInput()->with('gagal', $request->nama . ' Kantor ' . $request->status . ' Sudah Ada!');
            }
        }

        if ($request->status == 'Cabang') {

            $cek_pusat = Ppiu::where('nama', $request->nama)
                ->where('status', 'Pusat')
                ->first();
            if (!$cek_pusat) {
                return redirect()->back()->withInput()->with('gagal', $request->nama . ' Belum Terdaftar!');
            }

            $cek_cabang = Ppiu::where('nama', $request->nama)
                ->where('status', $request->status)
                ->where('id_kab_kota', $request->id_kab_kota)
                ->first();

            if ($cek_cabang) {
                $kab_kota = Kab_kota::where('id', $request->id_kab_kota)->first();
                return redirect()->back()->withInput()->with('gagal', $request->nama . ' Kantor ' . $request->status . ' di ' . $kab_kota->nama . ' Sudah Ada!');
            }

            $valid2['logo'] = $cek_pusat->logo;
        }

        User::create($valid1);

        $users = User::all();
        $user = $users->where('username', $valid1['username'])->first();
        $valid2['id_user'] = $user->id;

        if ($request->file('logo')) {

            $logo = Image::make($request->file('logo'));
            $logo = $logo->resize(1000, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $logo = $logo->encode('jpg');
            $hash = md5($logo->__toString());
            $path = "image-profile/{$hash}.jpg";
            $path_c = "storage/{$path}";
            $save = $logo->save($path_c);

            $valid2['logo'] = $path;
        }

        Ppiu::create($valid2);

        return redirect('/ppiu/create')->with('berhasil', 'Berhasil Menambahkan PPIU!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ppiu  $ppiu
     * @return \Illuminate\Http\Response
     */
    public function show(Ppiu $ppiu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ppiu  $ppiu
     * @return \Illuminate\Http\Response
     */
    public function edit(Ppiu $ppiu)
    {
        $this->authorize('update', $ppiu);
        return view('ppiu.edit', [
            'title' => 'PPIU',
            'subtitle' => 'Edit PPIU',
            'ppiu' => $ppiu,
            'kab_kotas' => Kab_kota::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ppiu  $ppiu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ppiu $ppiu)
    {
        $this->authorize('update', $ppiu);
        if (auth()->user()->level === 'kab/kota') {
            $kemenag_kab_kotas = Kemenag_kab_kota::all();
            $kemenag_kab_kota = $kemenag_kab_kotas->where('id_user', auth()->user()->id)->first();
            $request->merge([
                'id_kab_kota' => $kemenag_kab_kota->id_kab_kota,
                'status' => $ppiu->status,
            ]);
        }

        if ($ppiu->status == 'Cabang') {
            $request['nama'] = $ppiu->nama;
        }

        $valid2 = $request->validate([
            'nama' => 'required|min:7|max:255',
            'id_kab_kota' => 'required',
            'nama_pimpinan' => '',
            'status' => 'required',
            'nomor_sk' => 'required',
            'tanggal_sk' => 'required|date',
            'alamat' => 'required',
            'logo' => 'image|file|max:1024',
        ]);

        if ($request->username != $ppiu->user->username) {
            $valid1 = $request->validate([
                'username' => 'required|min:7|max:255|unique:users',
            ]);
            User::where('id', $ppiu->user->id)
                ->update($valid1);
        }

        if ($ppiu->status == 'Pusat') {
            if ($request->file('logo')) {
                if ($ppiu->logo !== 'image-profile/btuP6rIVQw1r89VG4C5pSPwZyONSORAclojTQU9N.png') {
                    Storage::delete($ppiu->logo);
                }

                $logo = Image::make($request->file('logo'));
                $logo = $logo->resize(1000, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $logo = $logo->encode('jpg');
                $hash = md5($logo->__toString());
                $path = "image-profile/{$hash}.jpg";
                $path_c = "storage/{$path}";
                $save = $logo->save($path_c);

                $valid2['logo'] = $path;

                Ppiu::where('nama', $ppiu->nama)
                    ->update(['logo' => $valid2['logo']]);
            }

            if ($request->nama != $ppiu->nama) {
                Ppiu::where('nama', $ppiu->nama)
                    ->update(['nama' => $valid2['nama']]);
            }
        }

        Ppiu::where('id', $ppiu->id)
            ->update($valid2);

        return redirect('/ppiu/update/' . $ppiu->id)->with('berhasil', 'Berhasil Mengubah data PPIU!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ppiu  $ppiu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ppiu $ppiu)
    {
        $this->authorize('delete', $ppiu);

        Storage::delete($ppiu->logo);

        Ppiu::destroy($ppiu->id);
        User::destroy($ppiu->id_user);

        return redirect('/ppiu')->with('berhasil', 'Berhasil Menghapus PPIU!');
    }

    public function resetPassword(Request $request, Ppiu $ppiu)
    {
        User::where('id', $ppiu->id_user)
            ->update(['password' => bcrypt('12345678')]);

        return redirect('/ppiu/update/' . $ppiu->id)->with('berhasil', 'Berhasil Mereset Password PPIU!');
    }
}
