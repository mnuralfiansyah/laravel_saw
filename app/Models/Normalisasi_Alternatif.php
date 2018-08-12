<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Normalisasi_Alternatif extends Model
{
  protected $table = 'normalisasi_alternatifs';
  protected $hidden = ['created_at', 'updated_at',];

  public function alternatif(){
      return $this->belongsTo('App\Models\Alternatif', 'alternatif_id');
    }

  public function emptyAlternatif(){
      $alternatif = $this->alternatif;

    foreach($alternatif as $v) {
        $v->Hasil_Akhir()->dissociate();
        $v->save();
    }
  }

  public function kriteria(){
      return $this->belongsTo('App\Models\Kriteria', 'kriteria_id');
    }

  public function emptyKriteria(){
          $kriteria = $this->kriteria;

        foreach($kriteria as $v) {
            $v->Normalisasi_Kriteria()->dissociate();
            $v->save();
        }
      }
}
