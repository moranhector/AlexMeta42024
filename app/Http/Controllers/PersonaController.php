<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;
use App\Models\FuturoJubilado; // Asegurate de importar el modelo FuturoJubilado
use Illuminate\Support\Facades\DB;

// EXCEL
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PersonasExport;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        if ($search) {
            $personas = Persona::where('m4user', 'LIKE', "%{$search}%")
                ->orWhere('nombre', 'LIKE', "%{$search}%")
                ->orWhere('etiqueta', 'LIKE', "%{$search}%")
                ->orderBy('etiqueta')
                ->get();
        } else {
            $personas = Persona::orderBy('etiqueta')->get();

        }

        if ($request->has('export_excel')) {
            return Excel::download(new PersonasExport(), 'personas.xlsx');
        }        

        return view('personas.index', compact('personas'))->with('i', 0);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        
        // Obtener los usuarios únicos de la tabla 'futurosjubilados'
        $usuarios = DB::table('futurosjubilados')->distinct()->pluck('id_secuser');        

        $etiquetas = FuturoJubilado::select('etiqueta')->distinct()->orderBy('etiqueta')->get();        

        return view('personas.create', compact(
            'etiquetas',
            'usuarios' 
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'm4user' => 'required|unique:personas',
            'nombre' => 'required',
            'etiqueta' => 'required'
        ]);

        Persona::create($request->all());

        return redirect()->route('personas.index')->with('success', 'Persona creada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $persona)
    {
        return view('personas.show', compact('persona'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit(Persona $persona)
    {
        return view('personas.edit', compact('persona'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Persona $persona)
    {
        $request->validate([
            'm4user' => 'required|unique:personas,m4user,' . $persona->id,
            'nombre' => 'required',
            'etiqueta' => 'required'
             ]);


        $persona->update($request->all());

        return redirect()->route('personas.index')->with('success', 'Persona actualizada exitosamente.');
    }

 
        public function guardarSeguimiento(Request $request, Persona $persona)
        {
            // Validar la solicitud
            $request->validate([
                'm4user' => 'required|exists:personas,m4user',
                'observaciones' => 'required'
            ]);
    
            // Buscar la persona por su m4user
            $persona = Persona::where('m4user', $request->m4user)->firstOrFail();
    
            // Actualizar el campo observaciones
            $persona->update([
                'observaciones' => $request->observaciones,
            ]);
    
            // Redirigir con un mensaje de éxito
            return redirect()->route('personas.index')->with('success', 'Seguimiento actualizado exitosamente.');
        }
  

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persona $persona)
    {
        $persona->delete();

        return redirect()->route('personas.index')->with('success', 'Persona eliminada exitosamente.');
    }
}
