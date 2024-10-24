<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\FuturoJubilado; // Asegurate de importar el modelo FuturoJubilado
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
// EXCEL
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FuturosJubiladosExport;
use App\Models\Persona;

class FuturoJubiladoController extends Controller
{
    //protected $apiUrl = 'http://localhost:3000/excel_jubilaciones_detalle_etiqueta/';
    protected $apiUrl = 'http://dic-alex-tst.mendoza.gov.ar:3000/excel_jubilaciones_detalle_etiqueta/';

    public function index(Request $request)
    {
        
        $titulo = '';
        
        $etiqueta = $request->input('etiqueta');
        $oficina  = $request->input('oficina');
        $unidad  = $request->input('unidad');

        //dump($oficina);

        $usuario = $request->input('usuario');
        
        $estado = $request->input('estado');
        $regimen = $request->input('regimen');
        $genero  = $request->input('genero');
        $search = $request->input('search');
        $comment = $request->input('comment');

        $maxPeriodo = FuturoJubilado::max('PERIODO'); // Obtener el último perido trabajado
        
        $mostrarjubilados = $request->input('mostrarjubilados');
        

        if ( $mostrarjubilados )
        {
            // $query = FuturoJubilado::query();     
            //$query = FuturoJubilado::where('PERIODO','<', $maxPeriodo);       
            $query = FuturoJubilado::where('PERIODO', $maxPeriodo);                        

        }
        else
        {
            $query = FuturoJubilado::where('PERIODO', $maxPeriodo);
        }

        // Si se usa la Jurisdicción    
        if ($etiqueta) {

                //dump('etiqueta');
            if ($oficina) {

                $titulo = $titulo.' oficina '.$oficina ;     
                
                // Paso 1: Obtener los valores de m4user desde la tabla personas
                $m4users = DB::table('personas')
                            ->distinct()
                            ->where('oficina', $oficina)
                            ->pluck('m4user');  // Esto devuelve una colección con los valores de m4user
                
                // Paso 2: Envolver cada valor de m4users en comillas simples
                $m4usersList = $m4users->map(function($user) {
                    return "'{$user}'";  // Envolver cada valor en comillas simples
                })->implode(',');        

                // Paso 3: Crear la consulta base sin ejecutarla
                $query->whereIn('id_secuser', $m4users);  // No ejecutar aún, solo define la base de la consulta                
              
    
            }   
             elseif( $unidad )
            {
                //dump('unidad');
                $titulo = $titulo.' unidad organizativa '.$unidad ;  
                //dump($titulo);

                $query->where('descripcionuor', $unidad);                

            }
            
            else 
            {
                $query->where('etiqueta', $etiqueta);
                $titulo = $titulo.$etiqueta;

            }

        }


        //Este era el filtro de USUARIO
        // if ($usuario) {
        //     $query->where('id_secuser', $usuario);
        //     $titulo = $titulo.' Usuario '.$usuario;
        // }

        $oficinas = Persona::select(DB::raw('CONCAT(m4user, " [ ", oficina, " ]") AS oficina'))
        ->get();   

        if ($etiqueta) {

            $oficinas = Persona::select(DB::raw('oficina'))
            ->where('etiqueta', $etiqueta )                      
            ->distinct( )                      
            ->orderBy('oficina')            
            ->get();               

        }        

            



        if ($regimen) {

            $titulo = $titulo.' Regimen '.$regimen ;

            $regimen = substr( " ".$regimen, -2)  ;
            $query->where(DB::raw('LEFT( RIGHT( CONCAT(" ", rats) , 7), 2)'), $regimen);
        }

        if ($genero) {
            $titulo = $titulo.' Genero '.$genero ;            
            $query->where('genero', $genero);
        }



        if ($estado )
        {  

            $titulo = $titulo.' Estado Trámite '.$estado ;

            if ( $estado =='STI' )
            {
                $query->where(function ($q) {
                    $q->whereNull('last_cod_jub')
                      ->orWhereIn('last_cod_jub', ['J01', 'NAP', 'ANSeS', '-']);
                });                
            }
            else
            {
                $query->where('last_cod_jub', $estado);
            }
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

        // ACA EFECTUA LA CONSULTA FILTRADA DE FUTUROS JUBILADOS
        $futurosjubilados = $query->orderBy('fecha_actualiza','desc')->get();
        
        $totalJubilados = $futurosjubilados->count();


        // LISTAS DE FILTROS        

        $etiquetas = FuturoJubilado::select('etiqueta')->distinct()->orderBy('etiqueta')->get();

        // $usuarios  = FuturoJubilado::select('id_secuser as usuario')
        //     ->where('id_secuser', '!=', '')
        //     ->distinct()
        //     ->orderBy('id_secuser')->get();


        //$usuarios  = Persona::select('CONCAT( m4user ," [ ",  etiqueta,  " ] " ) AS usuario')
          //              ->orderBy('m4user')->get();            

        //   $usuarios = Persona::select(DB::raw('CONCAT(m4user, " [ ", etiqueta, " ]") AS usuario'))
        //   ->orderBy('usuario')->get();     

        //FILTRO POR USUARIOS
        if ($etiqueta) {
            // Si hay una etiqueta seleccionada, filtra por esa etiqueta
            $usuarios = Persona::select(DB::raw('CONCAT(m4user, " [ ", oficina, " ]") AS usuario'))
                ->where('etiqueta', $etiqueta)
                ->where('es_principal', 1 )
                ->orderBy('m4user')
                ->get();
                //dd( $usuarios->toArray() ) ;                     
        } else {
            // Si no hay etiqueta, simplemente selecciona los usuarios sin filtro
          $usuarios = Persona::select(DB::raw('CONCAT(m4user, " [ ", oficina, " ]") AS usuario'))
          ->where('etiqueta', 'NONE')          
          ->get();     
        }
        

        //FILTRO POR USUARIOS
        if ($etiqueta) {
            // Si hay una etiqueta seleccionada, filtra por esa etiqueta
            $unidades = FuturoJubilado::select('descripcionuor as unidad')
                ->where('etiqueta', $etiqueta)
                ->distinct()
                ->orderBy('descripcionuor')->get();            
                //dd( $usuarios->toArray() ) ;                     
        } else {
            // Si no hay etiqueta, simplemente selecciona los usuarios sin filtro
            $unidades = FuturoJubilado::select('descripcionuor as unidad')->distinct()->orderBy('descripcionuor')->get();
        }        

 


        $generos   = FuturoJubilado::select('genero')->distinct()->orderBy('genero')->get();

        $regimenes = FuturoJubilado::select(DB::raw('LEFT( RIGHT( CONCAT(" ", rats) , 7), 2) as regimen') )
            ->distinct()
            ->orderBy('regimen')
            ->get();

        
        $estados = FuturoJubilado::select('last_cod_jub', 'last_cod_jub_desc')
        ->distinct()
        ->whereNotNull('last_cod_jub')
        ->where('last_cod_jub', '!=', '')
        ->orderByRaw("
            CASE 
                WHEN last_cod_jub LIKE 'J%' THEN 0
                WHEN last_cod_jub LIKE 'O%' THEN 1
                ELSE 2
            END, 
            last_cod_jub
        ")
        ->get();        


        //dd($futurosjubilados)            ;
        if ($request->has('export_excel')) {
            return Excel::download(new FuturosJubiladosExport($futurosjubilados, $titulo),
             'futuros_jubilados '.$titulo.'.xlsx');
        }


        return view(
            'futurojubilado.index',
            compact(
                'futurosjubilados', 
                'totalJubilados', 
                'etiquetas', 
                'oficinas', 
                'usuarios', 
                'estados', 
                'regimenes', 
                'generos',
                'mostrarjubilados',
                'maxPeriodo',
                'unidades'
            )
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
                        'id_meta4' => $item['STD_ID_PERSON'],
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

            // Almacenar el mensaje en la sesión
            session()->flash('mensaje', '¡El proceso se completó con éxito!');


            return redirect()->route('futurosjubilados.index');

            // return response()->json(['message' => 'Datos insertados correctamente.'], 200);
        } else {
            // Manejar error en la respuesta de la API
            return response()->json(['message' => 'Error al consumir la API.'], 500);
        }
    }


    public function seguimientoUsuarios($m4user)
    {

        // Limpiar el parámetro eliminando lo que esté después de "["
        $limpioM4User = explode('[', $m4user)[0];
        
        // Eliminar espacios en blanco sobrantes al inicio o final
        $limpioM4User = trim($limpioM4User);        

    // Buscar al usuario en la tabla personas
    $persona = Persona::where('m4user', $limpioM4User)->firstOrFail();
    
        // Obtener la fecha de hoy en formato dd/mm/yyyy
        $fechaHoy = Carbon::now()->format('d/m/Y');
    
        // Verificar si la fecha de hoy ya está presente en las observaciones
        if (strpos($persona->observaciones, "Fecha: " . $fechaHoy) === false) {
            // Si no está presente, agregar la fecha a las observaciones
            $persona->observaciones .= "\nFecha: " . $fechaHoy . "\n";
    
            // Guardar los cambios en la base de datos
            // $persona->save();
            // NO GUARDAR
        }
    
        // Retornar los datos en formato JSON
        return response()->json([
            'usuario' => $m4user,
            'observaciones' => $persona->observaciones
        ]);
    }
    


    // public function seguimientoUsuarios($m4user)
    // {
    //     // Buscar al usuario en la tabla personas
    //     $persona = Persona::where('m4user', $m4user)->firstOrFail();
    
    //     // Obtener la fecha de hoy en formato dd/mm/yyyy
    //     $fechaHoy = Carbon::now()->format('d/m/Y');
    
    //     // Verificar si la fecha de hoy ya está presente en las observaciones
    //     if (strpos($persona->observaciones, "Fecha: " . $fechaHoy) === false) {
    //         // Si no está presente, agregar la fecha a las observaciones
    //         $persona->observaciones .= "\nFecha: " . $fechaHoy . "\n";
    
    //         // Guardar los cambios en la base de datos
    //         $persona->save();
    //     }
    
    //     // Devolver la vista con los datos del usuario
    //     return view('FuturoJubilado.seguimiento', [
    //         'usuario' => $m4user,
    //         'observaciones' => $persona->observaciones
    //     ]);
    // }
    


    public function create()
    {
        return view('futurojubilado.create');
    }


    public function store(Request $request)
    {
 
        $request->validate([
            'id' => 'required|exists:futurosjubilados,id',
            'comments' => 'max:2000'
        ]);

        $futuro = FuturoJubilado::find($request->id);
        if ($futuro) {
            $futuro->comments = $request->comments;
            $futuro->save();
        }

        return response()->json(['success' => 'Comentario actualizado correctamente']);
    }






    public function show($id)
    {


        $cuil = $id;
        $futuro = FuturoJubilado::where('CUIL', $cuil)->first();



        //dd( $futuro );

        $dni = substr($id, 2, 8);
        //dd( 'dni', $dni)  ;
        $apiUrlHisto = 'http://dic-alex-tst.mendoza.gov.ar:3000/futurosjubiladoshisto/';

        //dd($apiUrlHisto . $dni);

        $response = Http::get($apiUrlHisto . $dni);

        if ($response->successful()) {
            // Obtener los datos del JSON
            $data = $response->json()['data'];
            // dd($data );
        }


        //dd( "no vino" ) ;
        $futuroJubilado = $response->json();

        // return view('futurojubilado.show', compact('futuroJubilado'));
        return view('futurojubilado.futurosjubiladoshisto', compact('data', 'dni', 'futuro'));
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

    public function bajas(Request $request)
    {
        
        $titulo = '';
        
        $etiqueta = $request->input('etiqueta');
        $unidad  = $request->input('unidad');
        $usuario = $request->input('usuario');
        
        $estado = $request->input('estado');
        $regimen = $request->input('regimen');
        $genero  = $request->input('genero');
        $search = $request->input('search');
        $comment = $request->input('comment');

        $maxPeriodo = FuturoJubilado::max('PERIODO'); // Obtener el último perido trabajado
        
        

        //INICIALIZO LA CONSULTA CON AQUELLOS QUE SU ULTIMO REGISTRO ESTA EN UN PERIODO ANTERIOR
        $query = FuturoJubilado::where('PERIODO','<', $maxPeriodo);                   
 

        if ($etiqueta) {
            $query->where('etiqueta', $etiqueta);
            $titulo = $titulo.$etiqueta;
        }

        if ($regimen) {

            $titulo = $titulo.' Regimen '.$regimen ;

            $regimen = substr( " ".$regimen, -2)  ;
            $query->where(DB::raw('LEFT( RIGHT( CONCAT(" ", rats) , 7), 2)'), $regimen);
        }

        if ($genero) {
            $titulo = $titulo.' Genero '.$genero ;            
            $query->where('genero', $genero);
        }


        if ($estado )
        {  

            $titulo = $titulo.' Estado Trámite '.$estado ;

            if ( $estado =='STI' )
            {
                $query->where(function ($q) {
                    $q->whereNull('last_cod_jub')
                      ->orWhereIn('last_cod_jub', ['J01', 'NAP', 'ANSeS', '-']);
                });                
            }
            else
            {
                $query->where('last_cod_jub', $estado);
            }
        }        

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nombreapellido', 'like', "%$search%")
                  ->orWhere('cuil', 'like', "%$search%");
            });
            // Agregamos la condición AND para el PERIODO
            $query->where('PERIODO', '<', $maxPeriodo);

        }
        
 

        if ($comment === 'con') {
            $query->whereNotNull('comments');
        } elseif ($comment === 'sin') {
            $query->whereNull('comments');
        }

        $futurosjubilados = $query->orderBy('fecha_actualiza','desc')->get();
        
        $totalJubilados = $futurosjubilados->count();

        $etiquetas = FuturoJubilado::select('etiqueta')->distinct()->orderBy('etiqueta')->get();



        if ($etiqueta) {
            // Si hay una etiqueta seleccionada, filtra por esa etiqueta
            $usuarios = Persona::select(DB::raw('CONCAT(m4user, " [ ", oficina, " ]") AS usuario'))
                ->where('etiqueta', $etiqueta)
                ->where('es_principal', 1 )
                ->orderBy('m4user')
                ->get();
                //dd( $usuarios->toArray() ) ;                     
        } else {
            // Si no hay etiqueta, simplemente selecciona los usuarios sin filtro
          $usuarios = Persona::select(DB::raw('CONCAT(m4user, " [ ", oficina, " ]") AS usuario'))
          ->where('etiqueta', 'NONE')          
          ->get();     
        }
        
 
        $generos   = FuturoJubilado::select('genero')->distinct()->orderBy('genero')->get();

        $regimenes = FuturoJubilado::select(DB::raw('LEFT( RIGHT( CONCAT(" ", rats) , 7), 2) as regimen') )
            ->distinct()
            ->orderBy('regimen')
            ->get();

        
        $estados = FuturoJubilado::select('last_cod_jub', 'last_cod_jub_desc')
        ->distinct()
        ->whereNotNull('last_cod_jub')
        ->where('last_cod_jub', '!=', '')
        ->orderByRaw("
            CASE 
                WHEN last_cod_jub LIKE 'J%' THEN 0
                WHEN last_cod_jub LIKE 'O%' THEN 1
                ELSE 2
            END, 
            last_cod_jub
        ")
        ->get();        


        //dd($futurosjubilados)            ;
        if ($request->has('export_excel')) {
            return Excel::download(new FuturosJubiladosExport($futurosjubilados, $titulo),
             'futuros_jubilados '.$titulo.'.xlsx');
        }



        return view(
            'futurojubilado.bajas_index',
            compact(
                'futurosjubilados', 
                'totalJubilados', 
                'etiquetas', 
                'usuarios', 
                'estados', 
                'regimenes', 
                'generos',
                'maxPeriodo'
            )
        );
    }





}
