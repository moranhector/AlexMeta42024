<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Flash;
use Response;
use Illuminate\Support\Facades\DB;
include 'funciones.php';

class UsuarioController extends AppBaseController
{
    /**
     * Display a listing of the Usuario.
     *
     * @param Request $request
     *
     * @return Response
     */
    // public function index(Request $request)
    // {
    //     /** @var Usuario $usuarios */
    //     $usuarios = Usuario::all();

    //     return view('usuarios.index')
    //         ->with('usuarios', $usuarios);
    // }

    public function index(Request $request)
    {

        $nombre  = $request->get('nombre');

        if($nombre)
        {        
            $usuarios = DB::table('usuarios')
            ->where('nombre','like','%'.$nombre.'%' ) 
            ->Orwhere('apellido_nombre','like','%'.$nombre.'%' ) 
            ->Orwhere('nombre_usuario','like','%'.$nombre.'%' ) 
            ->paginate( 100 ) ;   

            $data['usuarios'] = $usuarios;     
            $data['nombre'] = $nombre;     

            return view('usuarios.index',["usuarios"=>$usuarios,"nombre"=>$nombre]);            
        } 
        else
        {
            //$usuarios = Inventario::all()->paginate(25);
            $usuarios = DB::table('usuarios')->paginate(25);
        }
        return view('usuarios.index')
            ->with('usuarios', $usuarios);
    }



    public function usuarios_reparticion(Request $request)
    {

        $nombre  = $request->get('nombre');

        // $users = User::where('active','1')->where(function($query) {
		// 	$query->where('email','jdoe@example.com')
		// 				->orWhere('email','johndoe@example.com');
        // })->get();

        $_REPARTICION = "CGPROV#MHYF";



        if($nombre)
        {        
            $usuarios = User::where('codigo_reparticion',$_REPARTICION)
                >where(function($query) {
			        $query->where('nombre','like','%'.$nombre.'%' ) 
                        ->Orwhere('apellido_nombre','like','%'.$nombre.'%' ) 
                        ->Orwhere('nombre_usuario','like','%'.$nombre.'%' ) ;
                })->paginate( 50 ); 

            $data['usuarios'] = $usuarios;     
            $data['nombre'] = $nombre;     

            return view('usuarios.index',["usuarios"=>$usuarios,"nombre"=>$nombre]);            
        } 
        else
        {
            //$usuarios = Inventario::all()->paginate(25);
            $usuarios = DB::table('usuarios')->where('codigo_reparticion',$_REPARTICION)->paginate(25);             



        }
        return view('usuarios.index')
            ->with('usuarios', $usuarios);
    }




    /**
     * Show the form for creating a new Usuario.
     *
     * @return Response
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Store a newly created Usuario in storage.
     *
     * @param CreateUsuarioRequest $request
     *
     * @return Response
     */
    public function store(CreateUsuarioRequest $request)
    {
        $input = $request->all();

        /** @var Usuario $usuario */
        $usuario = Usuario::create($input);

        Flash::success('Usuario saved successfully.');

        return redirect(route('usuarios.index'));
    }

    /**
     * Display the specified Usuario.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Usuario $usuario */
        $usuario = Usuario::find($id);

        if (empty($usuario)) {
            Flash::error('Usuario not found');

            return redirect(route('usuarios.index'));
        }

        return view('usuarios.show')->with('usuario', $usuario);
    }

    /**
     * Show the form for editing the specified Usuario.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Usuario $usuario */
        $usuario = Usuario::find($id);

        if (empty($usuario)) {
            Flash::error('Usuario not found');

            return redirect(route('usuarios.index'));
        }

        return view('usuarios.edit')->with('usuario', $usuario);
    }

    /**
     * Update the specified Usuario in storage.
     *
     * @param int $id
     * @param UpdateUsuarioRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUsuarioRequest $request)
    {
        /** @var Usuario $usuario */
        $usuario = Usuario::find($id);

        if (empty($usuario)) {
            Flash::error('Usuario not found');

            return redirect(route('usuarios.index'));
        }

        $usuario->fill($request->all());
        $usuario->save();

        Flash::success('Usuario updated successfully.');

        return redirect(route('usuarios.index'));
    }

    /**
     * Remove the specified Usuario from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Usuario $usuario */
        $usuario = Usuario::find($id);

        if (empty($usuario)) {
            Flash::error('Usuario not found');

            return redirect(route('usuarios.index'));
        }

        $usuario->delete();

        Flash::success('Usuario deleted successfully.');

        return redirect(route('usuarios.index'));
    }


    public function sectores()
    {

                
        $cSelect=
        "SELECT DISTINCT codigo_sector_interno, cargo FROM usuarios WHERE  codigo_reparticion = 'CGPROV#MHYF'   ORDER BY cargo ";

        $sectores =   collect( DB::select(DB::raw($cSelect))) ; 

        return view('usuarios.sectores_index')
            ->with('sectores', $sectores);
    }



    //////////////////////////////////////////////////////

    public function json_grafico_meses_usuario( $usuario ) 
    {
        
        // $cSelect = " SUBSTR(fecha_operacion,4,2) AS mes , COUNT( distinct expediente ) as cantidad";

        // SELECT COUNT(*), MONTH(fecha_desde) AS mes FROM estadias WHERE usuario = 'GCONSOLI'  AND YEAR( FECHA_DESDE) = 2022 GROUP BY mes ;        
        // SELECT MONTH(fecha_desde) AS mes , COUNT(*) as cantidad  FROM estadias WHERE usuario = 'GCONSOLI'  AND YEAR( FECHA_DESDE) = 2022 GROUP BY mes ;        
 
             

         $tareas_mes = \DB::table('estadias')
                          ->select(\DB::raw( 'MONTH(fecha_desde) AS mes , COUNT(*) as cantidad ' ))
                          ->groupBy('mes')
                          ->whereRaw('usuario = "'.$usuario.'"  AND YEAR( FECHA_DESDE) = 2022')                          
                          ->get();   

       
                         
                         
      return response()->json($tareas_mes);
    }

    //////////////////////////////////////////////////////

    public function json_grafico_carga( $usuario ) 
    {

    $cSelect = 
    "SELECT COUNT(*)  AS tareas, usuario FROM estadias WHERE usuario = '".$usuario."' AND  YEAR( estadias.fecha_desde ) = 2022  group by usuario
    UNION
      SELECT COUNT(*)  AS tareas , 'Resto' AS Usuario FROM estadias WHERE usuario IN    
     ( SELECT nombre_usuario FROM usuarios WHERE codigo_sector_interno='SUBSAP2#CGPROV' )     
     AND  YEAR( estadias.fecha_desde ) = 2022 AND usuario <> '".$usuario."' GROUP BY 'Resto'" ; //Ahora hago la recorrida al reves

     // Tomo los movimientos de expedientes de a 1000 

    //dd($cSelect);


    //dd($cCuit);
    $carga = DB::select(DB::raw($cSelect));  

    // SELECT COUNT(*)  AS tareas, usuario FROM estadias WHERE usuario = 'GCONSOLI' AND  YEAR( estadias.fecha_desde ) = 2022  
  
    // UNION
    //   SELECT COUNT(*)  AS tareas , 'Resto' AS Usuario FROM estadias WHERE usuario IN
    
    //  ( SELECT nombre_usuario FROM usuarios WHERE codigo_sector_interno='SUBSAP2#CGPROV' )
     
    //  AND  YEAR( estadias.fecha_desde ) = 2022 AND usuario <> 'GCONSOLI'  

      
                         
                         
     return response()->json($carga);

    }

    //////////////////////////////////////////////////////

}
