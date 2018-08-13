<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\Bobot_Alternatif;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('template.data_kriteria',['data_kriteria'=>Kriteria::all()]);

        // $sum =  Kriteria::sum('bobot');
        // foreach (Kriteria::all() as $k => $v) {
        //   //Normalisasi Kriteria
        //   $bobot[$v->id] = $v->bobot/$sum;
        //
        //   foreach (Bobot_Alternatif::where(['kriteria_id'=>$v->id])->get() as $i => $u) {
        //     $total[$u->alternatif_id]=0;
        //     //Normalisasi Alternatif
        //     if($v->benefit){
        //       //jika benefit
        //       $max = Bobot_Alternatif::where(['kriteria_id'=>$v->id])->max('nilai');
        //       $normalisasi[$v->id][$u->alternatif_id] = $u->nilai/$max;
        //     }else{
        //       //jika cost
        //       $min = Bobot_Alternatif::where(['kriteria_id'=>$v->id])->min('nilai');
        //       $normalisasi[$v->id][$u->alternatif_id] = $min/$u->nilai;
        //     }
        //   }
        // }
        //
        //
        //
        // // perkalian bobo alternatif dan kriteria
        // foreach ($normalisasi as $k => $v) {
        //
        //   foreach ($v as $i => $u) {
        //     $hasil[$k][$i] = $bobot[$k] * $u;
        //     $total[$i] = $total[$i] +   $hasil[$k][$i];
        //     echo $bobot[$k]." x ".$u." = ".$hasil[$k][$i];
        //     echo "<br>";
        //   }
        //   echo "<br>";
        // }
        //
        // arsort($total);
        // foreach ($total as $k => $v) {
        //   echo $v."<br>";
        // }




        //return $bobot;
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
    public function store(Request $r)
    {
      $validator = Validator::make($r->all(), [
            'nama' => 'required|unique:kriterias|max:255',
            'bobot' => 'required|integer',
            'benefit' => 'required|integer',
                                              ]);

        if ($validator->fails()) {
          return redirect('/data_kriteria')->with('Gagal', 'Data Kriteria Gagal Ditambahkan.1');
        }


      if(Kriteria::insert(['nama'=>$r->nama,'bobot'=>$r->bobot,'benefit'=>$r->benefit,])){
        $kriteria = Kriteria::where(['nama'=>$r->nama])->first();
        foreach (Alternatif::all() as $k => $v) {
          Bobot_Alternatif::insert(['alternatif_id'=>$v->id,'kriteria_id'=>$kriteria->id,'nilai'=>1]);
        }
        return redirect('/data_kriteria')->with('Berhasil', 'Data Kriteria Berhasil Ditambahkan.');
      }

      return redirect('/data_kriteria')->with('Gagal', 'Data Kriteria Gagal Ditambahkan.');
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
    public function update(Request $r, $id)
    {
      $validator = Validator::make($r->all(), [
            'nama' => 'required|max:255',
            'bobot' => 'required|integer',
            'benefit' => 'required|integer',
                                              ]);

        if ($validator->fails()) {
          return redirect('/data_kriteria')->with('Gagal', 'Data Kriteria Gagal DiEdit.');
        }

      if(Kriteria::where(['id'=>$id])->update(['nama'=>$r->nama,'bobot'=>$r->bobot,'benefit'=>$r->benefit,])){
        return redirect('/data_kriteria')->with('Berhasil', 'Data Kriteria Berhasil DiEdit.');
      }

      return redirect('/data_kriteria')->with('Gagal', 'Data Kriteria Gagal DiEdit.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Kriteria::find($id)->Bobot_Alternatif()->delete();

      if(Kriteria::where(['id'=>$id])->delete()){
        return redirect('/data_kriteria')->with('Berhasil', 'Data Kriteria Berhasil Dihapus.');
      }

      return redirect('/data_kriteria')->with('Gagal', 'Data Kriteria Gagal Dihapus.');
    }
}
