<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
  public function Bobot_Alternatif(){
    return $this->hasOne('App\Models\Bobot_Alternatif');
    }

  public function Hasil_Akhir(){
    return $this->hasOne('App\Models\Hasil_Akhir');
    }

  public function Perkalian(){
    return $this->hasOne('App\Models\Perkalian');
    }

  protected $hidden = [
      'created_at', 'updated_at',
  ];
}
