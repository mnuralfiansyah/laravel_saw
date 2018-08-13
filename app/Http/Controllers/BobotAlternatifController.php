<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use App\Models\Bobot_Alternatif;

class BobotAlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(!Bobot_Alternatif::count()){
        return redirect('/data_kriteria')->with('Gagal', 'Data Alternatif atau Kriteria Masih Kosong');
      }
        $kriteria = Kriteria::orderBy('id')->get();

        // $tes = Bobot_Alternatif::orderBy('alternatif_id')->orderBy('kriteria_id')->get();
        // return $tes;

        foreach (Bobot_Alternatif::orderBy('alternatif_id')->orderBy('kriteria_id')->get() as $key => $v) {
          $data_bobot_alternatif[$v->alternatif->nama][$v->kriteria_id] = ['id'=>$v->alternatif_id,'nilai'=>$v->nilai,'nama_kriteria'=>$v->kriteria->nama];
        }
// return $data_bobot_alternatif;
        // foreach ($hasil as $k => $v) {
        //   foreach ($v as $i => $u) {
        //     // echo $u['nilai']."<br>";
        //   }
        // }

        return view('template.data_bobot_alternatif',['kriteria' => $kriteria,'data_bobot_alternatif'=>$data_bobot_alternatif]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('/data_kriteria')->with('Gagal', 'Data Bobot Alternatif Masih Kosong');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect('/data_kriteria')->with('Gagal', 'Data Bobot Alternatif Masih Kosong');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('/data_kriteria')->with('Gagal', 'Data Bobot Alternatif Masih Kosong');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect('/data_kriteria')->with('Gagal', 'Data Bobot Alternatif Masih Kosong');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      foreach (Kriteria::all() as $k => $v) {
        if(!Bobot_Alternatif::where(['kriteria_id'=>$v->id,'alternatif_id'=>$id])->update(['nilai'=>request($v->id)])){
          return redirect('/data_bobot_alternatif')->with('Gagal', 'Data Bobot Alternatif Gagal Diganti.');
        }
      }
        return redirect('/data_bobot_alternatif')->with('Berhasil', 'Data Bobot Alternatif Berhasil Diganti.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect('/data_kriteria')->with('Gagal', 'Data Bobot Alternatif Masih Kosong');
    }
}
