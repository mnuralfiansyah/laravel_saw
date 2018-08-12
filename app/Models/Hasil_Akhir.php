<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hasil_Akhir extends Model
{
    protected $table = 'hasil_akhirs';

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
}
