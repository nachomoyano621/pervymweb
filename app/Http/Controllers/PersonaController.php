<?php

namespace App\Http\Controllers;


use App\Models\Persona;
use Illuminate\Http\Request;
use Inertia\Inertia;



class PersonaController extends Controller
{
    public function index()
    {

        $persona = Persona::
            take(100)
            ->with('documentos','sexos','departamentos')
            ->get();
            return Inertia::render('Persona/Index',['persona' => $persona ]);

    }

    public function dnivista()
    {
        return Inertia::render('Persona/DniVista');
    }

    public function buscardni(Request $request)
    {
        $request->validate([
            'documento' => 'required|numeric|min:06',

        ]);


            $persona = Persona::where('documento', $request->documento)
            ->orWhere('documento', 'like', '%' . $request->documento . '%')
            ->limit(10)
            ->with('documentos','sexos','departamentos')
            ->get();
            return Inertia::render('Persona/Index',['persona' => $persona]);
    }


    public function nombrevista()
    {
        return Inertia::render('Persona/NombreVista');
    }

    public function buscarnombre(Request $request)
    {

        $request->validate([
            'nombre' => 'required|max:30|min:06',

        ]);


        $personamay = strtoupper($request->nombre);
        $persona = Persona::
        where('nombre', $personamay)
            ->orWhere('nombre', 'like', '%' . $personamay . '%')
            ->limit(10)
            ->with('documentos','sexos','departamentos')
            ->get();
        return Inertia::render('Persona/Index',['persona' => $persona]);

    }
}
