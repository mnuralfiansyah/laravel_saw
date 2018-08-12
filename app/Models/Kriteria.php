<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
  public function Bobot_Alternatif()
    {
      return $this->hasOne('App\Models\Bobot_Alternatif');
    }

  protected $hidden = ['created_at', 'updated_at',];
}
