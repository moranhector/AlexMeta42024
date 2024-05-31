<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\FuturoJubilado; // Asegurate de importar el modelo FuturoJubilado
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class FuturoJubiladoController extends Controller
{
    //protected $apiUrl = 'http://localhost:3000/excel_jubilaciones_detalle_etiqueta/';
    protected $apiUrl = 'http://dic-alex-tst.mendoza.gov.ar:3000/excel_jubilaciones_detalle_etiqueta/';




    public function index(Request $request)
    {
        $etiqueta = $request->input('etiqueta');
    
        $estado = $request->input('estado');
        $regimen = $request->input('regimen');
        $genero  = $request->input('genero');

        $search = $request->input('search');

        $comment = $request->input('comment');                

        $query = FuturoJubilado::query();




        if ($regimen) {
            $query->where(DB::raw('LEFT(rats, 2)'), $regimen);
        }        

        if ($genero) {
            $query->where('genero', $genero);
        }        

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

        if ($comment === 'con') {
            $query->whereNotNull('comments');
        } elseif ($comment === 'sin') {
            $query->whereNull('comments');
        }


        $futurosjubilados = $query->get();
        $totalJubilados = $futurosjubilados->count();

        $etiquetas = FuturoJubilado::select('etiqueta')->distinct()->orderBy('etiqueta')->get();

        $generos   = FuturoJubilado::select('genero')->distinct()->orderBy('genero')->get();

        $regimenes = FuturoJubilado::select(DB::raw('LEFT(rats, 2) as regimen'))
        ->distinct()
        ->orderBy('regimen')
        ->get();        

        // ->where('last_cod_jub', 'like', 'J%')
        
        $estados = FuturoJubilado::select('last_cod_jub', 'last_cod_jub_desc')
            ->distinct()
            ->orderBy('last_cod_jub')
            ->get();

        //dd($regimenes)    ;

        return view('futurojubilado.index', 
         compact('futurosjubilados', 'totalJubilados', 'etiquetas', 'estados','regimenes','generos') 
        );
    }



    public function create_from_json()
    {
        // Consumir la API REST
        //$response = Http::get('http://localhost:3000/futurosjubilados');
        $response = Http::get('http://dic-alex-tst.mendoza.gov.ar:3000/futurosjubilados');

        // Verificar si la respuesta es exitosa
        if ($response->successful()) {
            // Obtener los datos del JSON
            $data = $response->json()['data'];


            // Iterar sobre cada registro y guardarlo en la base de datos
            foreach ($data as $item) {

                // Convertir las fechas al formato correcto
                $fechanacimiento = Carbon::createFromFormat('d/m/Y', $item['FECHANACIMIENTO'])->format('Y-m-d');
                $fechaingreso = Carbon::createFromFormat('d/m/Y', $item['FECHAINGRESO'])->format('Y-m-d');

                if (!is_null($item['FECHA_ACTUALIZA'])) {
                    try {
                        $fecha_actualiza = Carbon::createFromFormat('d/m/Y', $item['FECHA_ACTUALIZA'])->format('Y-m-d');
                    } catch (InvalidFormatException $e) {
                        dd($item);
                    }
                } else {
                    $fecha_actualiza = null;
                }


                if (!is_null($item['LAST_FECHA_HASTA'])) {
                    try {
                        $last_fecha_hasta = Carbon::createFromFormat('Y-m-d\TH:i:s.u\Z', $item['LAST_FECHA_HASTA'])->format('Y-m-d');
                    } catch (InvalidFormatException $e) {
                        dd($item);
                    }
                } else {
                    $last_fecha_hasta = null;
                }

                // Verificar y convertir LAST_FECHA_DESDE
                if (!is_null($item['LAST_FECHA_DESDE'])) {
                    try {
                        $last_fecha_desde = Carbon::createFromFormat('Y-m-d\TH:i:s.u\Z', $item['LAST_FECHA_DESDE'])->format('Y-m-d');
                    } catch (InvalidFormatException $e) {
                        dd($item);
                    }
                } else {
                    $last_fecha_desde = null;
                }

                // Truncar el campo LAST_OBSERVACION a los primeros 190 caracteres
                $last_observacion = Str::limit($item['LAST_OBSERVACION'], 190, '');

                $cuil = $item['CUIL'];

                // Buscar el registro por CUIL
                $futuroJubilado = FuturoJubilado::where('cuil', $cuil)->first();
                
                if ($futuroJubilado) {
                    // Registro encontrado, actualizar los datos necesarios
                    $futuroJubilado->update([
                        'periodo' => $item['PERIODO'],
                        'last_cod_jub' => $item['LAST_COD_JUB'],
                        'last_cod_jub_desc' => $item['LAST_COD_JUB_DESC'],
                        'last_fecha_desde' => $last_fecha_desde,
                        'last_fecha_hasta' => $last_fecha_hasta,
                        'last_observacion' => $last_observacion,
                        'id_secuser' => $item['ID_SECUSER'],
                        'fecha_actualiza' => $fecha_actualiza
                    ]);
                } else {
                    // No se encontró el registro, crear uno nuevo
                    FuturoJubilado::create([
                        'cuil' => $item['CUIL'],
                        'nombreapellido' => $item['NOMBREAPELLIDO'],
                        'fechanacimiento' => $fechanacimiento,
                        'edad' => $item['EDAD'],
                        'fechaingreso' => $fechaingreso,
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
        $request->validate([
            'id' => 'required|exists:futurosjubilados,id',
            'comments' => 'required|string|max:255',
        ]);
    
        $futuro = FuturoJubilado::find($request->id);
        if ($futuro) {
            $futuro->comments = $request->comments;
            $futuro->save();
        }
    
        return response()->json(['success' => 'Comentario actualizado correctamente']);
    }
    



    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'id' => 'required|exists:futurosjubilados,id',
    //         'comments' => 'required|string|max:255',
    //     ]);

    //     $futuro = FuturoJubilado::find($request->id);
    //     if ($futuro) {
    //         $futuro->comments = $request->comments;
    //         $futuro->save();
    //     }

    //     return redirect()->route('futurojubilado.index')->with('success', 'Comentario actualizado correctamente');
    // }



    public function show($id)
    {
        

        $cuil = $id;
        $futuro = FuturoJubilado::where('CUIL', $cuil)->first();

        

        //dd( $futuro );

        $dni = substr($id, 2 , 8 );     
        //dd( 'dni', $dni)  ;
        $apiUrlHisto = 'http://dic-alex-tst.mendoza.gov.ar:3000/futurosjubiladoshisto/';

        //dd($apiUrlHisto . $dni);
        
        $response = Http::get( $apiUrlHisto . $dni);

        if ($response->successful()) {
            // Obtener los datos del JSON
            $data = $response->json()['data'];
            // dd($data );
        }
        

        //dd( "no vino" ) ;
        $futuroJubilado = $response->json();

        // return view('futurojubilado.show', compact('futuroJubilado'));
        return view('futurojubilado.futurosjubiladoshisto', compact('data','dni','futuro'));        
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
