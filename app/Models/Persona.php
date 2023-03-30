<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Persona extends Model
{
    protected $table = 'persona';
    use HasFactory;
    protected $fillable = ['documento','tipo_documento','nombre','fecha_dif','direccion','clase','sexo','profesion','dpto'];

     public function documentos()
      {

    return $this->belongsTo(Tipoduc::class, 'tipo_documento');
    }

    public function sexos()
      {

    return $this->belongsTo(Sexo::class, 'sexo');
    }

    public function departamentos()
    {

  return $this->belongsTo(Departamento::class, 'dpto');

  }

  public function getNombreAttribute($data)
    {

  return ucwords(strtolower($data));


  }

  public function getDireccionAttribute($data)
  {

return ucwords(strtolower($data));

}

public function getProfesionAttribute($data)
  {

return ucwords(strtolower($data));

}






}
