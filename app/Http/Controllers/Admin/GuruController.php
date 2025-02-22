<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\TipeUser;
use App\Models\Laboratorium;
use Illuminate\Http\Request;
use DB;
use Storage;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'Data Guru';
        $page_description = 'Menampilkan seluruh data guru';
        $action = 'table_datatable_basic';
        $user = User::select('users.*','t.*')->join('tipe_user as t','t.ID_TIPE_USER','=','users.ID_TIPE_USER')->where('t.NAMA_TIPE_USER','LIKE', '%Guru%')->get()->sortByDesc("ID_USER");
        $tipeuser = TipeUser::select('*')->where('tipe_user.NAMA_TIPE_USER','LIKE', '%Guru%')->get();
        $lab = Laboratorium::all();
        return view('admin.guru', compact('page_title', 'page_description','action','user','tipeuser','lab'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "foto" => 'file|mimes:jpg,jpeg,png',
            'nama_lengkap' => 'required|min:3',
            'username' => 'required|min:6|unique:App\Models\User,username',
            'password' => 'required|min:6',
            'id_laboratorium' => 'required|exists:App\Models\Laboratorium,ID_LABORATORIUM',
        ]);

        DB::transaction(function() use($request){

            if($request->foto != null)
            {
                $lastid = User::select('ID_USER')->orderBy('ID_USER','DESC')->first();
                $lastid = intval($lastid->ID_USER);
                $ext = $request->file("foto")->extension();
                $path = ($lastid+1).'.'.$ext;

                Storage::disk('public')->putFileAs('/images/profile/',$request->file('foto'),$path);

                User::insert([
                    "USERNAME" => str_replace(" ","",strtolower($request->username)),
                    "ID_TIPE_USER" => 5,
                    "PATH_FOTO" => '/images/profile/'.$path,
                    "NAMA_LENGKAP" => ucwords(strtolower($request->nama_lengkap)),
                    "PASSWORD" => bcrypt($request->password),
                    "ID_LABORATORIUM" => $request->id_laboratorium,
                ]);
            }
            else
            {
                User::insert([
                    "NAMA_LENGKAP" => ucwords(strtolower($request->nama_lengkap)),
                    "USERNAME" => str_replace(" ","",strtolower($request->username)),
                    "ID_TIPE_USER" => 5,
                    "PASSWORD" => bcrypt($request->password),
                    "ID_LABORATORIUM" => $request->id_laboratorium,
                ]);
            }
        });
        return redirect()->route('admin.guru.index')->with('created','Data berhasil dibuat');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "foto" => 'file|mimes:jpg,jpeg,png',
            'nama_lengkap' => 'required|min:3',
            'username' => 'required|min:6',
            'id_laboratorium' => 'required|exists:App\Models\Laboratorium,ID_LABORATORIUM',
        ]);

        $user = User::find($id);

        if($user->username != $request->username)
        {
            $request->validate([
                "username" => 'unique:App\Models\User,username',
            ]);
        }

        if($request->foto != null)
        {
            $ext = $request->file("foto")->extension();
            $path = ($id).'.'.$ext;

            Storage::disk('public')->putFileAs('/images/profile/',$request->file('foto'),$path);
            $user->update([
                "NAMA_LENGKAP" => ucwords(strtolower($request->nama_lengkap)),
                "USERNAME" => str_replace(" ","",strtolower($request->username)),
                "PATH_FOTO" => '/images/profile/'.$path,
                "ID_LABORATORIUM" => $request->id_laboratorium,
            ]);
        }
        else{
            $user->update([
                "NAMA_LENGKAP" => ucwords(strtolower($request->nama_lengkap)),
                "USERNAME" => str_replace(" ","",strtolower($request->username)),
                "ID_LABORATORIUM" => $request->id_laboratorium,
            ]);
        }
        if($request->password != null)
        {
            $request->validate([
                'password' => 'required|min:6',
            ]);
            $user->update([
                "PASSWORD" => bcrypt($request->password),
            ]);
        }
        
        return redirect()->route('admin.guru.index')->with('updated','Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('admin.guru.index')->with('deleted','Data berhasil dihapus');
    }
}
