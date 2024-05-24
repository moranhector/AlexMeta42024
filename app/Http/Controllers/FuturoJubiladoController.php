<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\FuturoJubilado; // Asegurate de importar el modelo FuturoJubilado
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Support\Str;

class FuturoJubiladoController extends Controller
{
    //protected $apiUrl = 'http://localhost:3000/excel_jubilaciones_detalle_etiqueta/';
    protected $apiUrl = 'http://dic-alex-tst.mendoza.gov.ar:3000/excel_jubilaciones_detalle_etiqueta/';

    public function indexOld(Request $request)
    {
        // $uor = $request->query('uor');
        // //dump($uor);
        // $response = Http::get($this->apiUrl . $uor);
        // //dd($this->apiUrl . $uor);
        // $data = $response->json()['data'];
        // dd($data);


        $uor = $request->query('uor');

        // // Realiza la solicitud a la API
        // $response = Http::get($this->apiUrl . $uor);

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->get($this->apiUrl . $uor);        

 

        // Verifica que la respuesta es válida y que contiene la clave 'data'
        if ($response->successful() && $response->json() !== null && isset($response->json()['data'])) {
            $data = $response->json()['data'];
            dump('con datos');
        } else {
            // Maneja el caso donde la respuesta no es válida o no contiene 'data'
            $data = []; // o cualquier valor por defecto que consideres adecuado
            dump('sin datos');            
        }

        // Pasar los datos a la vista
        return view('futurojubilado.index', compact('data'));        

    }


    public function index(Request $request)
    {
        $etiqueta = $request->input('etiqueta');
        $estado = $request->input('estado');
        $search = $request->input('search');
    
        $query = FuturoJubilado::query();
    
        if ($etiqueta) {
            $query->where('etiqueta', $etiqueta);
        }
    
        if ($estado) {
            $query->where('last_cod_jub', $estado);
        }
    
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nombreapellido', 'like', "%$search%")
                  ->orWhere('cuil', 'like', "%$search%");
            });
        }
    
        $futurosjubilados = $query->get();
        $totalJubilados = $futurosjubilados->count();
    
        $etiquetas = FuturoJubilado::select('etiqueta')->distinct()->orderBy('etiqueta')->get();
        $estados = FuturoJubilado::select('last_cod_jub', 'last_cod_jub_desc')
            ->where('last_cod_jub', 'like', 'J%')
            ->distinct()
            ->orderBy('last_cod_jub')
            ->get();
    
        return view('futurojubilado.index', compact('futurosjubilados', 'totalJubilados', 'etiquetas', 'estados'));
    }
    


    // public function index(Request $request)
    // {
    //     $etiqueta = $request->input('etiqueta');
    //     $estado = $request->input('estado');
    
    //     $query = FuturoJubilado::query();
    
    //     if ($etiqueta) {
    //         $query->where('etiqueta', $etiqueta);
    //     }
    
    //     if ($estado) {
    //         $query->where('last_cod_jub', $estado);
    //     }
    
    //     $futurosjubilados = $query->get();
    //     $totalJubilados = $futurosjubilados->count();
    
    //     $etiquetas = FuturoJubilado::select('etiqueta')->distinct()->orderBy('etiqueta')->get();
    //     // $estados = FuturoJubilado::select('last_cod_jub', 'last_cod_jub_desc')->distinct()->orderBy('last_cod_jub')->get();
        
    //     $estados = FuturoJubilado::select('last_cod_jub', 'last_cod_jub_desc')
    //     ->where('last_cod_jub', 'like', 'J%')
    //     ->distinct()
    //     ->orderBy('last_cod_jub')
    //     ->get();        
    
    //     return view('futurojubilado.index', compact('futurosjubilados', 'totalJubilados', 'etiquetas', 'estados'));
    // }
    



    
    // public function index( Request $request )
    // {

    //     $etiqueta = $request->input('etiqueta');
    //     $estado   = $request->input('estado');

    //     //$futurosjubilados = FuturoJubilado::all();

    //     if ($etiqueta) {
    //         $futurosjubilados = FuturoJubilado::where('etiqueta', $etiqueta)->get();
    //     } else {
    //         $futurosjubilados = FuturoJubilado::all();
    //     }        


    //     $totalJubilados = $futurosjubilados->count();



    //     // SELECT DISTINCT etiqueta FROM futurosjubilados ORDER BY etiqueta        
    //     $etiquetas = FuturoJubilado::select('etiqueta')->distinct()->orderBy('etiqueta')->get();
    //     $estados = FuturoJubilado::select('last_cod_jub', 'last_cod_jub_desc')->distinct()->orderBy('last_cod_jub')->get();
        


    //     return view('futurojubilado.index', compact('futurosjubilados','totalJubilados','etiquetas','estados'));
    // }    


    public function create_from_json()
    {
        //dd("entro");
        // Consumir la API REST
        //$response = Http::get('http://localhost:3000/futurosjubilados');
        $response = Http::get('http://dic-alex-tst.mendoza.gov.ar:3000/futurosjubilados');
        
        //dd($response);
        
        // Verificar si la respuesta es exitosa
        if ($response->successful()) {
            // Obtener los datos del JSON
            $data = $response->json()['data'];
       
            //dd($data);
            
            // Iterar sobre cada registro y guardarlo en la base de datos
            foreach ($data as $item) {

                // Convertir las fechas al formato correcto
                $fechanacimiento = Carbon::createFromFormat('d/m/Y', $item['FECHANACIMIENTO'])->format('Y-m-d');
                $fechaingreso = Carbon::createFromFormat('d/m/Y', $item['FECHAINGRESO'])->format('Y-m-d');
                       
                // $last_fecha_hasta = Carbon::createFromFormat('Y-m-d\TH:i:s.u\Z', $item['LAST_FECHA_HASTA'])->format('Y-m-d');
                // $last_fecha_desde = Carbon::createFromFormat('Y-m-d\TH:i:s.u\Z', $item['LAST_FECHA_DESDE'])->format('Y-m-d');                
                                                     
                if (!is_null($item['FECHA_ACTUALIZA'])) {
                    try {
                        $fecha_actualiza = Carbon::createFromFormat('d/m/Y', $item['FECHA_ACTUALIZA'])->format('Y-m-d'); 
                    } catch (InvalidFormatException $e) {
                        dd( $item );
                    }
                } else {
                    $fecha_actualiza = null;
                }


                if (!is_null($item['LAST_FECHA_HASTA'])) {
                    try {
                        $last_fecha_hasta = Carbon::createFromFormat('Y-m-d\TH:i:s.u\Z', $item['LAST_FECHA_HASTA'])->format('Y-m-d');
                    } catch (InvalidFormatException $e) {
                        dd( $item );
                    }
                } else {
                    $last_fecha_hasta = null;
                }
            
                // Verificar y convertir LAST_FECHA_DESDE
                if (!is_null($item['LAST_FECHA_DESDE'])) {
                    try {
                        $last_fecha_desde = Carbon::createFromFormat('Y-m-d\TH:i:s.u\Z', $item['LAST_FECHA_DESDE'])->format('Y-m-d');
                    } catch (InvalidFormatException $e) {
                        dd( $item );
                    }
                } else {
                    $last_fecha_desde = null;
                }

                // Truncar el campo LAST_OBSERVACION a los primeros 190 caracteres
                $last_observacion = Str::limit($item['LAST_OBSERVACION'], 190, '');                


                FuturoJubilado::create([
                    'cuil' => $item['CUIL'],
                    'nombreapellido' => $item['NOMBREAPELLIDO'],
                    'fechanacimiento' => $fechanacimiento,
                    'edad' => $item['EDAD'],
                    'fechaingreso' =>  $fechaingreso,
                    'genero' => $item['GENERO'],
                    'periodo' => $item['PERIODO'],
                    'descripcionuor' => $item['DESCRIPCIONUOR'],
                    'dependencia' => $item['DEPENDENCIA'],
                    'etiqueta' => $item['ETIQUETA'],                    
                    'rats' => $item['RATS'],
                    'clase' => $item['CLASE'],
                    'last_cod_jub' => $item['LAST_COD_JUB'],
                    'last_cod_jub_desc' => $item['LAST_COD_JUB_DESC'],
                    'last_fecha_desde' => $last_fecha_desde,
                    'last_fecha_hasta' => $last_fecha_hasta,
                    'last_observacion' => $last_observacion,
                    'id_secuser' => $item['ID_SECUSER'],
                    'fecha_actualiza' => $fecha_actualiza
                ]);
            }

     

            return response()->json(['message' => 'Datos insertados correctamente.'], 200);
        } else {
            // Manejar error en la respuesta de la API
            return response()->json(['message' => 'Error al consumir la API.'], 500);
        }
    }



    public function create()
    {
        return view('futurojubilado.create');
    }

    public function store(Request $request)
    {
        // Lógica para almacenar los datos, aunque no se almacena en MySQL sino en la API
    }

    public function show($id)
    {
        $response = Http::get($this->apiUrl . 'AMBIENTE/' . $id);
        $futuroJubilado = $response->json();

        return view('futurojubilado.show', compact('futuroJubilado'));
    }

    public function edit($id)
    {
        $response = Http::get($this->apiUrl . 'AMBIENTE/' . $id);
        $futuroJubilado = $response->json();

        return view('futurojubilado.edit', compact('futuroJubilado'));
    }

    public function update(Request $request, $id)
    {
        // Lógica para actualizar los datos, aunque no se almacena en MySQL sino en la API
    }

    public function destroy($id)
    {
        // Lógica para eliminar los datos, aunque no se almacena en MySQL sino en la API
    }
}
