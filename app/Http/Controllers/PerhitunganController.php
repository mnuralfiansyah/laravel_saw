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

// use App/Http/Controller/KriteriaController;

class PerhitunganController extends Controller
{

  // public function __construct(Kriteria $kriteria)
  // {
  //   $this->kriteria = $kriteria;
  // }
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
      Perkalian::truncate();
      Normalisasi_Kriteria::truncate();
      Normalisasi_Alternatif::truncate();

      $sum =  Kriteria::sum('bobot');
      foreach (Kriteria::all() as $k => $v) {
        //Normalisasi Kriteria
        $bobot[$v->id] = $v->bobot/$sum;
        Normalisasi_Kriteria::insert(['kriteria_id'=>$v->id,'nilai'=>$bobot[$v->id]]);

        foreach (Bobot_Alternatif::where(['kriteria_id'=>$v->id])->get() as $i => $u) {
          $total[$u->alternatif_id]=0;
          //Normalisasi Alternatif
          if($v->benefit){
            //jika benefit
            $max = Bobot_Alternatif::where(['kriteria_id'=>$v->id])->max('nilai');
            $normalisasi[$v->id][$u->alternatif_id] = $u->nilai/$max;
            Normalisasi_Alternatif::insert(['alternatif_id'=>$u->alternatif_id,'kriteria_id'=>$v->id,'nilai'=>$normalisasi[$v->id][$u->alternatif_id]]);
          }else{
            //jika cost
            $min = Bobot_Alternatif::where(['kriteria_id'=>$v->id])->min('nilai');
            $normalisasi[$v->id][$u->alternatif_id] = $min/$u->nilai;
            Normalisasi_Alternatif::insert(['alternatif_id'=>$u->alternatif_id,'kriteria_id'=>$v->id,'nilai'=>$normalisasi[$v->id][$u->alternatif_id]]);
          }
        }
      }



      // perkalian bobo alternatif dan kriteria
      foreach ($normalisasi as $k => $v) {

        foreach ($v as $i => $u) {
          $hasil[$k][$i] = $bobot[$k] * $u;
          $total[$i] = $total[$i] +   $hasil[$k][$i];

          Perkalian::insert(['kriteria_id'=>$k,'alternatif_id'=>$i,'nilai'=>$hasil[$k][$i]]);
        }
      }

      arsort($total);
      $iterasi=1;
      foreach ($total as $k => $v) {
        Hasil_Akhir::insert(['alternatif_id'=>$k,'nilai'=>$v,'ranking'=>$iterasi]);
        $iterasi++;
        // echo $v."<br>";
      }

      $kriteria = Kriteria::orderBy('id')->get();
      $hasil    = Hasil_Akhir::all();


      $bobot_kriteria = DB::table('kriterias')->join('normalisasi_kriterias','kriterias.id','=','normalisasi_kriterias.kriteria_id')
                        ->select('kriterias.nama','kriterias.bobot','kriterias.benefit','normalisasi_kriterias.nilai')->get();

      foreach (Perkalian::orderBy('alternatif_id')->orderBy('kriteria_id')->get() as $key => $v) {
        $perkalian[$v->alternatif->nama][$v->kriteria_id] = ['id'=>$v->alternatif_id,'nilai'=>$v->nilai,'nama_kriteria'=>$v->kriteria->nama];
      }
      foreach (Normalisasi_Alternatif::orderBy('alternatif_id')->orderBy('kriteria_id')->get() as $key => $v) {
        $data_normalisasi_alternatif[$v->alternatif->nama][$v->kriteria_id] = ['id'=>$v->alternatif_id,'nilai'=>$v->nilai,'nama_kriteria'=>$v->kriteria->nama];
      }
      foreach (Bobot_Alternatif::orderBy('alternatif_id')->orderBy('kriteria_id')->get() as $key => $v) {
        $data_bobot_alternatif[$v->alternatif->nama][$v->kriteria_id] = ['id'=>$v->alternatif_id,'nilai'=>$v->nilai,'nama_kriteria'=>$v->kriteria->nama];
      }

      return view('template.data_perhitungan',['kriteria' => $kriteria,
                                                'data_normalisasi_alternatif'=>$data_normalisasi_alternatif,
                                                'data_bobot_alternatif'=>$data_bobot_alternatif,
                                                'bobot_kriteria'=>$bobot_kriteria,
                                                'perkalian'=>$perkalian,
                                                'hasil'=>$hasil,
                                              ]);
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
        return redirect('/data_kriteria')->with('Gagal', 'Data Bobot Alternatif Masih Kosong');
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
