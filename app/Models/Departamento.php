<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = 'departamento';

    use HasFactory;

    protected $fillable = [
		'nombre'
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
