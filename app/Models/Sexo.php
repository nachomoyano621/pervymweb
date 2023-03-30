<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sexo extends Model
{
    protected $table = 'sexo';

    use HasFactory;

    protected $fillable = [
		'sexo'
	];




    public function personas()
	{
		return $this->hasMany(Persona::class, 'sexo');
	}
    public function getNombreAttribute($data)
    {

  return ucwords(strtolower($data));

  }

}
