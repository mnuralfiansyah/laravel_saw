<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bobot_Alternatif extends Model
{
  public function alternatif(){
      return $this->belongsTo('App\Models\Alternatif', 'alternatif_id');
    }

    public function kriteria(){
        return $this->belongsTo('App\Models\Kriteria', 'kriteria_id');
      }

    public function emptyAlternatif(){
        $alternatif = $this->alternatif;

      foreach($alternatif as $v) {
          $v->Bobot_Alternatif()->dissociate();
          $v->save();
      }
    }

      public function emptyKriteria(){
          $kriteria = $this->kriteria;

        foreach($kriteria as $v) {
            $v->Bobot_Alternatif()->dissociate();
            $v->save();
        }
      }

    protected $table = 'bobot_alternatifs';
}
