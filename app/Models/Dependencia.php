<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dependencia extends Model {
  protected $fillable = ['nombre','codigo','descripcion'];
  public function radicados(){ return $this->hasMany(Radicado::class); }
}
