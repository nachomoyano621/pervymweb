<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipoduc extends Model
{
    protected $table = 'tipo_doc';

    use HasFactory;

    protected $fillable = [
		'nombre_tipodoc'
	];



    public function personas()
	{
		return $this->hasMany(Persona::class, 'tipo_documento');
	}

}
