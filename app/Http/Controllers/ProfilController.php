<?php

namespace App\Http\Controllers;

use App\Models\Akreditasi;
use App\Models\Kemenag_kab_kota;
use App\Models\Ppiu;
use App\Models\User;
use App\Models\Kanwil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProfilController extends Controller
{

    public function index()
    {
        $user = User::where('id', auth()->user()->id)->first();

        if (auth()->user()->level == 'kanwil') {
            $nama = 'Kantor Wilayah Kementerian Agama Sumatera Barat';
        } elseif (auth()->user()->level == 'kab/kota') {
            $nama = $user->kemenag_kab_kota->nama;
        } elseif (auth()->user()->level == 'ppiu') {
            $nama = $user->ppiu->nama;

            if ($user->ppiu->id_akreditasi == null) {
                return view('profil.index', [
                    'title' => 'Profil',
                    'subtitle' => 'fffffff',
                    'user' => $user,
                    'nama' => $nama,
                    'akreditasi' => 'Anda Belum Melakukan Akreditasi!',
                ]);
            } else {

                $tanggal_peringatan = date('d-m-Y', strtotime($user->ppiu->akreditasi->tanggal_akreditasi . " +4 year"));
                $tanggal_habis = date('d-m-Y', strtotime($user->ppiu->akreditasi->tanggal_akreditasi . " +5 year"));
                $tanggal_sekarang = date('d-m-Y');

                if ((strtotime($tanggal_sekarang) >= strtotime($tanggal_peringatan)) && (strtotime($tanggal_sekarang) <= strtotime($tanggal_habis))) {
                    // dd('peringatan', $tanggal_sekarang, $tanggal_habis);
                    return view('profil.index', [
                        'title' => 'Profil',
                        'subtitle' => 'fffffff',
                        'user' => $user,
                        'nama' => $nama,
                        'akreditasi' => 'Akreditasi Anda Akan Habis, Silakan Perbarui!',
                    ]);
                }
                if (strtotime($tanggal_sekarang) > strtotime($tanggal_habis)) {
                    // dd('habis', $tanggal_sekarang, $tanggal_habis);
                    return view('profil.index', [
                        'title' => 'Profil',
                        'subtitle' => 'fffffff',
                        'user' => $user,
                        'nama' => $nama,
                        'akreditasi' => 'Akreditasi Anda Sudah Habis, Silakan Perbarui!',
                    ]);
                }

                return view('profil.index', [
                    'title' => 'Profil',
                    'subtitle' => 'fffffff',
                    'user' => $user,
                    'nama' => $nama,
                    'akreditasi' => '',
                ]);
            }
        }

        return view('profil.index', [
            'title' => 'Profil',
            'subtitle' => 'fffffff',
            'user' => $user,
            'nama' => $nama,
            'akreditasi' => '',
        ]);
    }

    public function edit()
    {
        $user = User::where('id', auth()->user()->id)->first();

        return view('profil.edit', [
            'title' => 'Profil',
            'subtitle' => 'fffffff',
            'user' => $user,
        ]);
    }

    public function update(Request $request)
    {
        if (auth()->user()->level == 'kanwil') {

            $valid = $request->validate([
                'nama_pimpinan' => '',
                'alamat' => 'required',
            ]);

            $kanwil = Kanwil::where('id_user', auth()->user()->id)->first();
            if ($request->username != $kanwil->user->username) {
                $valid1 = $request->validate([
                    'username' => 'required|min:7|max:255|unique:users',
                ]);
                User::where('id', $kanwil->user->id)
                    ->update($valid1);
            }

            Kanwil::where('id_user', auth()->user()->id)
                ->update($valid);
        } elseif (auth()->user()->level == 'kab/kota') {
            $valid = $request->validate([
                'nama_pimpinan' => '',
                'alamat' => 'required',
            ]);

            $kemenag_kab_kota = Kemenag_kab_kota::where('id_user', auth()->user()->id)->first();
            if ($request->username != auth()->user()->username) {
                $valid1 = $request->validate([
                    'username' => 'required|min:7|max:255|unique:users',
                ]);
                User::where('id', $kemenag_kab_kota->user->id)
                    ->update($valid1);
            }

            Kemenag_kab_kota::where('id_user', auth()->user()->id)
                ->update($valid);
        } elseif (auth()->user()->level == 'ppiu') {

            $ppiu = Ppiu::where('id_user', auth()->user()->id)->first();

            if ($ppiu->status == 'Pusat') {
                $valid = $request->validate([
                    'nama' => 'required|min:7|max:255',
                    'nama_pimpinan' => '',
                    'nomor_sk' => 'required',
                    'tanggal_sk' => 'required|date',
                    'alamat' => 'required',
                    'logo' => 'image|file|max:1024',
                ]);
            } elseif ($ppiu->status == 'Cabang') {
                $valid = $request->validate([
                    'nama_pimpinan' => '',
                    'nomor_sk' => 'required',
                    'tanggal_sk' => 'required|date',
                    'alamat' => 'required',
                ]);
            }

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

                    $valid['logo'] = $path;

                    Ppiu::where('nama', $ppiu->nama)
                        ->update(['logo' => $valid['logo']]);
                }

                if ($request->nama != $ppiu->nama) {
                    Ppiu::where('nama', $ppiu->nama)
                        ->update(['nama' => $valid['nama']]);
                }
            }

            Ppiu::where('id_user', auth()->user()->id)
                ->update($valid);
        }

        return redirect('/profil')->with('berhasil', 'Berhasil Mengubah Profil!');
    }

    public function gantipassword()
    {
        return view('profil.gantipassword', [
            'title' => 'Ganti Password',
            'subtitle' => 'fffffff',
        ]);
    }

    public function savegantipassword(Request $request)
    {
        $valid = $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|string|min:8',
            'konfirmasi_password_baru' => 'required|same:password_baru',
        ]);

        if (!Hash::check($request->password_lama, auth()->user()->password)) {
            return back()->with('gagal', 'Password Lama Salah!');
        }

        // dd($valid['password_baru']);

        User::where('id', auth()->user()->id)
            ->update(['password' => bcrypt($valid['password_baru'])]);

        return redirect('/profil/gantipassword')->with('berhasil', 'Berhasil Mengubah Password!');
    }

    public function akreditasi()
    {
        $this->authorize('akreditasi', Akreditasi::class);

        return view('profil.akreditasi', [
            'title' => 'Akreditasi',
            'subtitle' => 'fffffff',
        ]);
    }

    public function storeakreditasi(Request $request)
    {
        $this->authorize('akreditasi', Akreditasi::class);
        $valid = $request->validate([
            'tanggal_akreditasi' => 'required|date',
            'bukti' => 'required|mimes:pdf|max:2048',
        ]);

        $ppiu = Ppiu::where('id_user', auth()->user()->id)->first();

        if ($ppiu->id_akreditasi == null) {
            $valid['bukti'] = $request->file('bukti')->store('file-akreditasi');

            $akreditasi = Akreditasi::create($valid);

            Ppiu::where('id', $ppiu->id)
                ->update(['id_akreditasi' => $akreditasi->id]);
        } else {
            Storage::delete($ppiu->akreditasi->bukti);
            $valid['bukti'] = $request->file('bukti')->store('file-akreditasi');

            Akreditasi::where('id', $ppiu->akreditasi->id)
                ->update($valid);
        }

        return redirect('/profil')->with('berhasil', 'Berhasil Memperbarui Akreditasi!');
    }
}
