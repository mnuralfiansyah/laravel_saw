<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Kriteria;
use App\Models\Perkalian;
use App\Models\Alternatif;
use App\Models\Hasil_Akhir;
use Illuminate\Http\Request;
use App\Models\Bobot_Alternatif;
use App\Models\Normalisasi_Kriteria;
use App\Models\Normalisasi_Alternatif;

class HasilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(!Bobot_Alternatif::count()){
        return redirect('/data_kriteria')->with('Gagal', 'Data Bobot Alternatif Masih Kosong');
      }

      Hasil_Akhir::truncate();

      $sum =  Kriteria::sum('bobot');
      foreach (Kriteria::all() as $k => $v) {
        //Normalisasi Kriteria
        $bobot[$v->id] = $v->bobot/$sum;

        foreach (Bobot_Alternatif::where(['kriteria_id'=>$v->id])->get() as $i => $u) {
          $total[$u->alternatif_id]=0;
          //Normalisasi Alternatif
          if($v->benefit){
            //jika benefit
            $max = Bobot_Alternatif::where(['kriteria_id'=>$v->id])->max('nilai');
            $normalisasi[$v->id][$u->alternatif_id] = $u->nilai/$max;
          }else{
            //jika cost
            $min = Bobot_Alternatif::where(['kriteria_id'=>$v->id])->min('nilai');
            $normalisasi[$v->id][$u->alternatif_id] = $min/$u->nilai;
          }
        }
      }



      // perkalian bobo alternatif dan kriteria
      foreach ($normalisasi as $k => $v) {

        foreach ($v as $i => $u) {
          $hasil[$k][$i] = $bobot[$k] * $u;
          $total[$i] = $total[$i] +   $hasil[$k][$i];
          // echo $bobot[$k]." x ".$u." = ".$hasil[$k][$i];
          // echo "<br>";
        }
        echo "<br>";
      }

      arsort($total);
      $iterasi=1;
      foreach ($total as $k => $v) {
        Hasil_Akhir::insert(['alternatif_id'=>$k,'nilai'=>$v,'ranking'=>$iterasi]);
        $iterasi++;
        // echo $v."<br>";
      }

      return view('template.data_hasil',['hasil'=>Hasil_Akhir::all()]);
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
        //
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
