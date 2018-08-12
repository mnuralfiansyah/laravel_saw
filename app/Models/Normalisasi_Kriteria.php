<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Normalisasi_Kriteria extends Model
{
  protected $table = 'normalisasi_kriterias';
  protected $hidden = ['created_at', 'updated_at',];

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
