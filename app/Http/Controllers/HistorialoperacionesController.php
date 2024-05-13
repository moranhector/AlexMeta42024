<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatehistorialoperacionesRequest;
use App\Http\Requests\UpdatehistorialoperacionesRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\historialoperaciones;
use Illuminate\Http\Request;
use Flash;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;

include 'funciones.php';



class historialoperacionesController extends AppBaseController
{
    /**
     * Display a listing of the historialoperaciones.
     *
     * @param Request $request
     *
     * @return Response
     */
    // public function index(Request $request)
    // {
    //     /** @var historialoperaciones $historialoperaciones */
    //     //$historialoperaciones = historialoperaciones::all();
    //     $historialoperaciones = DB::table('historialoperaciones')->paginate(25);

    //     return view('historialoperaciones.index')
    //         ->with('historialoperaciones', $historialoperaciones);
    // }

    public function index(Request $request)
    {
        //dd('aqui');
        $expediente  = $request->get('expediente');

        if($expediente)
        {        
            $historialoperaciones = DB::table('historialoperaciones')
            ->where('expediente','like','%'.$expediente.'%' ) 
            ->paginate( 100 ) ;   

            $data['historialoperaciones'] = $historialoperaciones;     
            $data['expediente'] = $expediente;     

            return view('historialoperaciones.index',["historialoperaciones"=>$historialoperaciones,"expediente"=>$expediente]);            
        } 
        else
        {
            //$usuarios = Inventario::all()->paginate(25);
            $historialoperaciones = DB::table('historialoperaciones')->paginate(25);
        }
        return view('historialoperaciones.index')
            ->with('historialoperaciones', $historialoperaciones);
    }




    public function contarOLD(){



        //dd('contando');

        $cSelect = 
        "SELECT id_expediente, expediente,
        CONCAT( SUBSTR(fecha_operacion,7,4), SUBSTR(fecha_operacion,4,2) , SUBSTR(fecha_operacion,1,2) ) AS fecha,
        CODIGO_REPARTICION_DESTINO, REPARTICION_USUARIO
         FROM historialoperaciones where SUBSTR(fecha_operacion,7,4)='2023' ORDER BY 1, 3;";

        set_time_limit(0);


        //dd($cCuit);
        $expedientes = DB::select(DB::raw($cSelect));  

        $cexpediente = ' ';
        $nCantidad   = 0 ;
        $nEntrada   = 0 ;
        $nSalida   = 0 ;
        $cid_expediente = '';

        echo "procesando ...";
        echo "<br>";


        foreach($expedientes as $expediente){

            // echo "cexpediente";
            // echo $cexpediente;
            // echo "-";
            // echo "expediente->id_expediente";
            // echo $expediente->id_expediente;
            // echo '<br>';


            if ($expediente->id_expediente == $cid_expediente)
            {
                $nCantidad= $nCantidad + 1 ;
                // echo $nCantidad;
                // echo '<br>';

                IF($expediente->CODIGO_REPARTICION_DESTINO=='CGPROV#MHYF' AND $expediente->REPARTICION_USUARIO <>'CGPROV#MHYF' ) //Entrada
                {
                    $nEntrada= $nEntrada + 1 ;
                }

                IF($expediente->CODIGO_REPARTICION_DESTINO<>'CGPROV#MHYF' AND $expediente->REPARTICION_USUARIO =='CGPROV#MHYF' )  //Salida
                {
                    $nSalida= $nSalida+ 1 ;
                }


                
            }
            else
            {


                if($cexpediente <>' ')
                {
                $sql = 
                "INSERT INTO cgpdashboard.xexpedientes (id,
                EXPEDIENTE,
                ID_EXPEDIENTE,
                cantidad, entradas, salidas )
                VALUES ( null,
                '$cexpediente',
                $cid_expediente,
                $nCantidad,  $nEntrada, $nSalida)";

                $expedientes = DB::insert($sql); 
                }

                //limpio  
                $cid_expediente = $expediente->id_expediente;
                $cexpediente = $expediente->expediente;                

                $nCantidad   = 1 ;

                $nEntrada   = 0 ;
                $nSalida   = 0 ;


                IF($expediente->CODIGO_REPARTICION_DESTINO=='CGPROV#MHYF' AND $expediente->REPARTICION_USUARIO <>'CGPROV#MHYF' ) //Entrada
                {
                    $nEntrada=  1 ;
                }

                IF($expediente->CODIGO_REPARTICION_DESTINO<>'CGPROV#MHYF' AND $expediente->REPARTICION_USUARIO =='CGPROV#MHYF' )  //Salida
                {
                    $nSalida=  1 ;
                }






            }
            //echo $expediente->id;

        }
        
        
        //dd('expedientes...',$expedientes);
        echo "terminado";

        return ;


    }

    // ██████╗ ██████╗ ███╗   ██╗████████╗ █████╗ ██████╗ 
    // ██╔════╝██╔═══██╗████╗  ██║╚══██╔══╝██╔══██╗██╔══██╗
    // ██║     ██║   ██║██╔██╗ ██║   ██║   ███████║██████╔╝
    // ██║     ██║   ██║██║╚██╗██║   ██║   ██╔══██║██╔══██╗
    // ╚██████╗╚██████╔╝██║ ╚████║   ██║   ██║  ██║██║  ██║
    //  ╚═════╝ ╚═════╝ ╚═╝  ╚═══╝   ╚═╝   ╚═╝  ╚═╝╚═╝  ╚═╝
                                                        




    public function contar(){

        set_time_limit(0);

        //dd('contando');

        // $cSelect = "SELECT * FROM xultimoid" ;
        // $ultimoid = DB::select(DB::raw($cSelect)); 
        // $ultimoid = $ultimoid[0]->id;


        $cSelect = 
        "SELECT id, id_expediente, expediente,
        CONCAT( SUBSTR(fecha_operacion,7,4), SUBSTR(fecha_operacion,4,2) , SUBSTR(fecha_operacion,1,2) ) AS fecha,
        CODIGO_REPARTICION_DESTINO, REPARTICION_USUARIO
         FROM historialoperaciones  where contado is null  ORDER BY 1 desc   limit 2000"; //Ahora hago la recorrida al reves

         // Tomo los movimientos de expedientes de a 1000 

        //dd($cSelect);


        //dd($cCuit);
        $expedientes = DB::select(DB::raw($cSelect));  

        //dd($expedientes);

        $cexpediente = ' ';
        $nCantidad   = 0 ;
        $nEntrada   = 0 ;
        $nSalida   = 0 ;
        $cid_expediente = '';


             echo "procesando ............";
             echo "<br>";




        foreach($expedientes as $expediente){


            //tomo el id de expediente
            $cid_expediente = $expediente->id_expediente;
            $cnumero_expediente = $expediente->expediente;
            $cid_historial = $expediente->id; // Id de Movimiento

            echo "procesando ... $cid_historial";
            



            //lo busco en xexpedientes ESTADISTICAS DE EXPEDIENTES
            $cSelect = "select * from xexpedientes where id_expediente=$cid_expediente";



            $xexpedientes = DB::select(DB::raw($cSelect)); 


            //dd($xexpedientes);

            //dd($xexpedientes);

            if (! $xexpedientes )  // si no existe lo doy de alta
            {

                //$cid_expediente = $expediente->id_expediente;
                //$cexpediente = $expediente->expediente;       


                $sql = 
                "INSERT INTO cgpdashboard.xexpedientes (id,
                EXPEDIENTE,
                ID_EXPEDIENTE, cantidad, entradas, salidas )
                VALUES ( null,
                '$cnumero_expediente',
                $cid_expediente, 0, 0, 0 )";

                $insert = DB::insert($sql); 
                //dd("no lo encontre es nuevo", $sql);

            }

                //estoy enfocado en el expediente respecto a Contaduria, por eso solo me interesan entradas y salidas para ver los reprocesos
                //
 
            IF($expediente->CODIGO_REPARTICION_DESTINO=='CGPROV#MHYF' AND $expediente->REPARTICION_USUARIO <>'CGPROV#MHYF' ) //Entrada
            {
             
                $sql = "update cgpdashboard.xexpedientes set cantidad = cantidad + 1, entradas = entradas + 1
                where id_expediente =  $cid_expediente " ;
                
            }

            IF($expediente->CODIGO_REPARTICION_DESTINO<>'CGPROV#MHYF' AND $expediente->REPARTICION_USUARIO =='CGPROV#MHYF' )  //Salida
            {
       
                $sql = "update cgpdashboard.xexpedientes set cantidad = cantidad + 1, salidas = salidas +1 
                where id_expediente =  $cid_expediente " ;
            }



            IF($expediente->CODIGO_REPARTICION_DESTINO=='CGPROV#MHYF' AND $expediente->REPARTICION_USUARIO =='CGPROV#MHYF' ) // adquisicion
            {
             
                $sql = "update cgpdashboard.xexpedientes set cantidad = cantidad + 1 where id_expediente =  $cid_expediente " ;
                
            }

            //dd($sql);

            DB::statement($sql);

            //$cid_historial
            // $sql = "update cgpdashboard.xultimoid set ultimo_id = $cid_historial " ; //actualizo el registro unico de xultimoid
 
            // DB::statement($sql);



            $sql = "update cgpdashboard.historialoperaciones set contado = 1 where id = $cid_historial " ; //actualizo el registrounico de xultimoid
 
            DB::statement($sql);




        }
        
        echo "Terminando ok .........";
        echo "<br>"; 
        echo "Terminando ok .........";
        echo "<br>";    
        echo "Terminando ok .........";
        echo "<br>"; 
        echo "Terminando ok .........";
        echo "<br>";    
        echo "Terminando ok .........";
        echo "<br>"; 
        echo "Terminando ok .........";
        echo "<br>";    
        echo "Terminando ok .........";
        echo "<br>"; 
        echo "Terminando ok .........";
        echo "<br>";    
        //dd('expedientes...',$expedientes);
 

        return ;


    }


    //  ██████╗ ██████╗ ███╗   ██╗████████╗ █████╗ ██████╗     ██╗   ██╗███████╗██╗   ██╗ █████╗ ██████╗ ██╗ ██████╗ ███████╗
    // ██╔════╝██╔═══██╗████╗  ██║╚══██╔══╝██╔══██╗██╔══██╗    ██║   ██║██╔════╝██║   ██║██╔══██╗██╔══██╗██║██╔═══██╗██╔════╝
    // ██║     ██║   ██║██╔██╗ ██║   ██║   ███████║██████╔╝    ██║   ██║███████╗██║   ██║███████║██████╔╝██║██║   ██║███████╗
    // ██║     ██║   ██║██║╚██╗██║   ██║   ██╔══██║██╔══██╗    ██║   ██║╚════██║██║   ██║██╔══██║██╔══██╗██║██║   ██║╚════██║
    // ╚██████╗╚██████╔╝██║ ╚████║   ██║   ██║  ██║██║  ██║    ╚██████╔╝███████║╚██████╔╝██║  ██║██║  ██║██║╚██████╔╝███████║
    //  ╚═════╝ ╚═════╝ ╚═╝  ╚═══╝   ╚═╝   ╚═╝  ╚═╝╚═╝  ╚═╝     ╚═════╝ ╚══════╝ ╚═════╝ ╚═╝  ╚═╝╚═╝  ╚═╝╚═╝ ╚═════╝ ╚══════╝
                                                                                                                          



    public function contarusuarios(){

        set_time_limit(0);

        //dd('contando');

        // $cSelect = "SELECT * FROM xultimoid" ;
        // $ultimoid = DB::select(DB::raw($cSelect)); 
        // $ultimoid = $ultimoid[0]->id;


        $cSelect = 
        "SELECT id, id_expediente, expediente,
        CONCAT( SUBSTR(fecha_operacion,7,4), SUBSTR(fecha_operacion,4,2) , SUBSTR(fecha_operacion,1,2) ) AS fecha,
        CODIGO_REPARTICION_DESTINO, REPARTICION_USUARIO, usuario, destinatario
         FROM historialoperaciones  where usuario='gconsoli' or destinatario='gconsoli' 
           ORDER BY 1 desc   "; //Ahora hago la recorrida al reves

         // Tomo los movimientos de expedientes de a 1000 

        //dd($cSelect);


        //dd($cCuit);
        $expedientes = DB::select(DB::raw($cSelect));  

        //dd($expedientes);

        $cexpediente = ' ';
        $nCantidad   = 0 ;
        $nEntrada   = 0 ;
        $nSalida   = 0 ;
        $cid_expediente = '';


             echo "procesando ............";
             echo "<br>";




        foreach($expedientes as $expediente){


            //tomo el id de expediente
            $cid_expediente = $expediente->id_expediente;
            $cid_usuario    = 'GCONSOLI';
            $cnumero_expediente = $expediente->expediente;
            $cid_historial = $expediente->id; // Id de Movimiento

            echo "procesando ... $cid_historial";
            



            //lo busco en xexpedientes ESTADISTICAS DE EXPEDIENTES
            //$cSelect = "select * from xexpedientes where id_expediente=$cid_expediente";
            $cSelect = "select * from xusuarios    where id_usuario='$cid_usuario'";



            $xusuarios = DB::select(DB::raw($cSelect)); 


            //dd($xusuarios);

            //dd($xexpedientes);

            if (! $xusuarios )  // si no existe lo doy de alta
            {

                //$cid_expediente = $expediente->id_expediente;
                //$cexpediente = $expediente->expediente;       


                $sql = 
                "INSERT INTO cgpdashboard.xusuarios (id,                
                id_usuario, cantidad, entradas, salidas )
                VALUES ( 1,
                '$cid_usuario', 0, 0, 0 )";

                $insert = DB::insert($sql); 
                //dd("no lo encontre es nuevo", $sql);

            }

                //estoy enfocado en el expediente respecto a Contaduria, por eso solo me interesan entradas y salidas para ver los reprocesos
                //
 
            //IF($expediente->destinatario== '$cid_usuario' AND $expediente->usuario <>'$cid_usuario' ) //Entrada

            //dd($expediente->destinatario== $cid_usuario);

            IF($expediente->destinatario== $cid_usuario AND $expediente->usuario <>$cid_usuario ) //Entrada
            {
             
                $sql = "update cgpdashboard.xusuarios set cantidad = cantidad + 1, entradas = entradas + 1
                where id_usuario=  '$cid_usuario' " ;
                
            }

            IF($expediente->destinatario<>$cid_usuario AND $expediente->usuario ==$cid_usuario )  //Salida
            {
       
                $sql = "update cgpdashboard.xusuarios set cantidad = cantidad + 1, salidas = salidas +1 
                where id_usuario=  '$cid_usuario' " ;
            }



            IF($expediente->destinatario== $cid_usuario  AND $expediente->usuario ==$cid_usuario ) // adquisicion
            {
             
                $sql = "update cgpdashboard.xusuarios set cantidad = cantidad + 1 
                where id_usuario=  '$cid_usuario' " ;
                
            }

            //dd($expediente);

            // if($sql)
            // {
                DB::statement($sql);
            // }
            // {
            //     dd($expediente);
            // }

            

            //$cid_historial
            // $sql = "update cgpdashboard.xultimoid set ultimo_id = $cid_historial " ; //actualizo el registro unico de xultimoid
 
            // DB::statement($sql);



            //$sql = "update cgpdashboard.historialoperaciones set contado = 1 where id = $cid_historial " ; //actualizo el registrounico de xultimoid
 
            //DB::statement($sql);




        }
        
        echo "Terminando ok .........";
        echo "<br>"; 
        echo "Terminando ok .........";
        echo "<br>";    
        echo "Terminando ok .........";
        echo "<br>"; 
        echo "Terminando ok .........";
        echo "<br>";    
        echo "Terminando ok .........";
        echo "<br>"; 
        echo "Terminando ok .........";
        echo "<br>";    
        echo "Terminando ok .........";
        echo "<br>"; 
        echo "Terminando ok .........";
        echo "<br>";    
        //dd('expedientes...',$expedientes);
 

        return ;


    }


    /**
     * Show the form for creating a new historialoperaciones.
     *
     * @return Response
     */
    public function create()
    {
        return view('historialoperaciones.create');
    }

    /**
     * Store a newly created historialoperaciones in storage.
     *
     * @param CreatehistorialoperacionesRequest $request
     *
     * @return Response
     */
    public function store(CreatehistorialoperacionesRequest $request)
    {
        $input = $request->all();

        /** @var historialoperaciones $historialoperaciones */
        $historialoperaciones = historialoperaciones::create($input);

        Flash::success('Historialoperaciones saved successfully.');

        return redirect(route('historialoperaciones.index'));
    }

    /**
     * Display the specified historialoperaciones.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var historialoperaciones $historialoperaciones */
        $historialoperaciones = historialoperaciones::find($id);

        if (empty($historialoperaciones)) {
            Flash::error('Historialoperaciones not found');

            return redirect(route('historialoperaciones.index'));
        }

        return view('historialoperaciones.show')->with('historialoperaciones', $historialoperaciones);
    }

    /**
     * Show the form for editing the specified historialoperaciones.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var historialoperaciones $historialoperaciones */
        $historialoperaciones = historialoperaciones::find($id);

        if (empty($historialoperaciones)) {
            Flash::error('Historialoperaciones not found');

            return redirect(route('historialoperaciones.index'));
        }

        return view('historialoperaciones.edit')->with('historialoperaciones', $historialoperaciones);
    }

    /**
     * Update the specified historialoperaciones in storage.
     *
     * @param int $id
     * @param UpdatehistorialoperacionesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatehistorialoperacionesRequest $request)
    {
        /** @var historialoperaciones $historialoperaciones */
        $historialoperaciones = historialoperaciones::find($id);

        if (empty($historialoperaciones)) {
            Flash::error('Historialoperaciones not found');

            return redirect(route('historialoperaciones.index'));
        }

        $historialoperaciones->fill($request->all());
        $historialoperaciones->save();

        Flash::success('Historialoperaciones updated successfully.');

        return redirect(route('historialoperaciones.index'));
    }

    /**
     * Remove the specified historialoperaciones from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var historialoperaciones $historialoperaciones */
        $historialoperaciones = historialoperaciones::find($id);

        if (empty($historialoperaciones)) {
            Flash::error('Historialoperaciones not found');

            return redirect(route('historialoperaciones.index'));
        }

        $historialoperaciones->delete();

        Flash::success('Historialoperaciones deleted successfully.');

        return redirect(route('historialoperaciones.index'));
    }


//     _           _     _                         _ 
//     | |         | |   | |                       | |
//   __| | __ _ ___| |__ | |__   ___   __ _ _ __ __| |
//  / _` |/ _` / __| '_ \| '_ \ / _ \ / _` | '__/ _` |
// | (_| | (_| \__ \ | | | |_) | (_) | (_| | | | (_| |
//  \__,_|\__,_|___/_| |_|_.__/ \___/ \__,_|_|  \__,_|    DEL USUARIO 
                                                   
                                                   
    // BUSCAR COMO CTRL + F "ON DASHBOARD"

    public function dashboard(  $usuario_name=NULL)   // Menu Principal  
    {


        $date_today = date('d-m-Y');
        $date_yesterday = strtotime('-1 day', strtotime($date_today));
        $date_yesterday = date('Y-m-d', $date_yesterday);

        dd($date_yesterday);


        $dateAyer =  str_replace( "-" , "/" , $date_yesterday ) ;
        $dateAyer =  $date_yesterday  ;

        if( isset($usuario_name))
        {
            $usuario_name = $usuario_name;
        }
        else
        {
            $usuario_name = Auth::user()->name;
        }
        
 
        $usuario = Usuario::where('nombre_usuario', $usuario_name )->first( ); 
 
        if( empty( $usuario))
        {
            Flash::success('No hay información del usuario solicitado');
            return view('historialoperaciones.dashboard_error');
        }
 
        //SECTOR

        $cSelect=
        "SELECT * FROM usuarios WHERE nombre_usuario = '$usuario_name'";
        $datos_usuario =   collect( DB::select(DB::raw($cSelect)))->first() ; 

        $sector=  $datos_usuario->codigo_sector_interno;


        //Lista de usuarios del mismo Sector

        $cSelect=
        "SELECT * FROM usuarios WHERE codigo_sector_interno='SUBSAP2#CGPROV'";
        $otros_usuarios_sector=   collect( DB::select(DB::raw($cSelect))) ; 


        //Expedientes que trabajé ayer

        $cSelect=
        "SELECT expediente, DATEDIFF(  CURRENT_DATE , fecha_desde    ) AS demora  FROM estadias 
        WHERE usuario='$usuario_name' AND fecha_hasta = '$dateAyer'";

        $expedientesEntregadosAyer=   collect( DB::select(DB::raw($cSelect))) ; 

        //Planta Total

        $cSelect=
        "SELECT COUNT(*) as personas FROM CAR_SIGNOS WHERE estadolegajo=1 AND admin_persona='S' AND rats<>'9999999' AND periodo='202307';";

        $plantaTotal=   collect( DB::select(DB::raw($cSelect))) ;         
         




        //Expedientes que recibí ayer
        $cSelect=
        "SELECT expediente FROM estadias WHERE usuario='$usuario_name' AND fecha_desde = '$dateAyer'   "   ;  
        $expedientesRecibidosAyer=   collect( DB::select(DB::raw($cSelect))) ; 

        //Tareas Abiertas
        $cSelect=
        "SELECT expediente, DATEDIFF(  CURRENT_DATE , fecha_desde    ) AS demora  FROM estadias
        WHERE usuario='$usuario_name' AND fecha_hasta IS  NULL ORDER BY demora DESC limit 15";

        $tareas_abiertas = collect( DB::select(DB::raw($cSelect)) ) ;

        //--Tareas cerradas los ultimos 30 dias
        //SELECT * FROM estadias  WHERE usuario='gconsoli' AND  DATEDIFF(  CURRENT_DATE  , fecha_hasta  )  <=30    
        $cSelect=
        "SELECT expediente , DATEDIFF( fecha_hasta , fecha_desde  )  AS demora FROM estadias  
        WHERE usuario='$usuario_name' AND  DATEDIFF(  CURRENT_DATE  , fecha_hasta  )  <=30";     
        $tareas_cerradas_30 = collect( DB::select(DB::raw($cSelect)) ) ;
        //$tareas_cerradas_promedio = collect( DB::select(DB::raw($cSelect)) )->avg('dias') ;

        //-- Demora máxima del año

        $cSelect="SELECT DATEDIFF( fecha_hasta , fecha_desde ) AS dias, expediente FROM estadias 
        WHERE usuario='$usuario_name' AND YEAR(fecha_desde) = 2023
        AND fecha_hasta IS NOT NULL 
        ORDER BY dias DESC LIMIT 1";
        $expediente_mas_demorado = collect( DB::select(DB::raw($cSelect)) )->first() ;

        //dd($expediente_mas_demorado ) ;


        $cSelect="SELECT count(*) as cantidad FROM estadias WHERE YEAR(fecha_desde) = 2023 AND usuario='gconsoli' ";
        $expedientes_anio = collect( DB::select(DB::raw($cSelect)) )->first() ;
        //dd($expedientes_anio);

        //expedientes_reproceso_anio
        $cSelect=
        "SELECT expediente, COUNT(*) AS cantidad FROM estadias 
        WHERE YEAR(fecha_desde) = 2023 AND usuario='$usuario_name' 
        GROUP BY expediente 
        HAVING cantidad > 1
        ORDER BY cantidad DESC" ;
        
 

        $expedientes_reproceso_anio = collect( DB::select(DB::raw($cSelect)) ) ;

        
        //ambitos_diferentes_atendidos
        $cSelect=
        "SELECT sector_usuario_origen, COUNT(*) AS cantidad 
        FROM historialoperaciones 
        WHERE destinatario ='$usuario_name'  AND SUBSTRING(fecha_operacion, 7,4)='2023' 
        GROUP BY sector_usuario_origen
        ORDER BY cantidad DESC";

 
        
 

        $ambitos_diferentes_atendidos = collect( DB::select(DB::raw($cSelect)) ) ;        

        $ambito_generador_maximo = $ambitos_diferentes_atendidos->first();

        //dd( $ambito_generador_maximo->sector_usuario_origen) ;

        //$fecha_ultimo_registro

        $cSelect=
        "SELECT fecha_operacion FROM historialoperaciones WHERE id = ( SELECT MAX(id) FROM historialoperaciones )" ;  //24/11/2023
        $fecha_ultimo_registro = collect( DB::select(DB::raw($cSelect)) )->first() ;
        //dd( $fecha_ultimo_registro->fecha_operacion );

        $cSelect=
        "SELECT fecha_desde FROM estadias WHERE id = ( SELECT MAX(id) FROM estadias )" ;  //24/11/2023
        $fecha_ultimo_registro2 = collect( DB::select(DB::raw($cSelect)) )->first() ;
        //dd( american2french( $fecha_ultimo_registro2->fecha_desde ) );        










        //SELECT fecha_desde FROM estadias WHERE id = ( SELECT MAX(id) FROM estadias ); 2023-11-24

 

        //dd($usuario->sexo);

        return view('historialoperaciones.dashboard', [
        'expedientes_anio'=> $expedientes_anio->cantidad,
        'expedientesEntregadosAyer'=> $expedientesEntregadosAyer,
        'expedientesRecibidosAyer' => $expedientesRecibidosAyer,
        'plantaTotal' => $plantaTotal,        
        'expedientes_reproceso_anio'=> $expedientes_reproceso_anio,
        'ambitos_diferentes_atendidos'=> $ambitos_diferentes_atendidos,
        'ambito_generador_maximo'=>  $ambito_generador_maximo,
        'apellido_nombre'=> $usuario->apellido_nombre,
        'cargo'=> $usuario->cargo,
        'sexo'=> $usuario->sexo,
        'usuario_name'=> $usuario_name,
        'sector'=> $sector,
        'otros_usuarios_sector'=> $otros_usuarios_sector,
        // 'mes'=> $mes,                         
        'tareas_abiertas'=> $tareas_abiertas,                         
        'tareas_cerradas_30'=> $tareas_cerradas_30,                         
        'expediente_mas_demorado'=> $expediente_mas_demorado,                         
        'fecha_ultimo_registro'=> $fecha_ultimo_registro                        
        ]); 
    }    


    // ██████╗ ██████╗  █████╗ ███████╗██╗ ██████╗ █████╗ ██████╗ 
    // ██╔════╝ ██╔══██╗██╔══██╗██╔════╝██║██╔════╝██╔══██╗██╔══██╗
    // ██║  ███╗██████╔╝███████║█████╗  ██║██║     ███████║██████╔╝
    // ██║   ██║██╔══██╗██╔══██║██╔══╝  ██║██║     ██╔══██║██╔══██╗
    // ╚██████╔╝██║  ██║██║  ██║██║     ██║╚██████╗██║  ██║██║  ██║
    //  ╚═════╝ ╚═╝  ╚═╝╚═╝  ╚═╝╚═╝     ╚═╝ ╚═════╝╚═╝  ╚═╝╚═╝  ╚═╝
                                                                                            
    // ██████╗ ██████╗ ██████╗ 
    // ██╔════╝██╔════╝ ██╔══██╗
    // ██║     ██║  ███╗██████╔╝
    // ██║     ██║   ██║██╔═══╝ 
    // ╚██████╗╚██████╔╝██║     
    //  ╚═════╝ ╚═════╝ ╚═╝     
                             



    public function cgp()   // Menu Principal  
    {


        $fechaActual = date('d-m-Y');
 
        $fechaActual = '12/10/2023';
        $dateActual = french2american( '12/10/2023' );
        $fechaAyer   = '11/10/2023';
        $dateAyer   = french2american( '11/10/2023' );
        $diaAyer     = '11';
        $mesAyer     = '10';
        $anioAyer    = '2023';


        $fechaActual = '11/11/2023';
        $dateActual = french2american( '11/11/2023' );
        $fechaAyer   = '10/11/2023';
        $dateAyer   = french2american( '10/11/2023' );
        $diaAyer     = '10';
        $mesAyer     = '11';
        $anioAyer    = '2023';
        
        


        //SELECT fecha_operacion, SUBSTR(fecha_operacion,7,4) AS ani FROM  historialoperacione

        $expedientes2023 = Historialoperaciones::selectRaw('count(distinct expediente) cantidad')
        ->whereraw( 'SUBSTR(fecha_operacion,7,4)="2023"' )        
        ->count();  

        // $expedientes = Historialoperaciones::selectRaw('count(distinct expediente) cantidad')
        // ->whereraw( 'year(registrado_at)=2023' )        
        // ->count();  


        $expedientes2021 = Historialoperaciones::selectRaw('count(distinct expediente) cantidad')
        ->whereraw( 'SUBSTR(fecha_operacion,7,4)="2021"' )       
        ->count();    

 
 



        $cSelect=
        "SELECT expediente, DATEDIFF(  CURRENT_DATE , fecha_desde    ) AS demora  FROM estadias WHERE   fecha_hasta = '$dateAyer'";
        //dd($cSelect);
        $expedientesEntregadosAyer=   collect( DB::select(DB::raw($cSelect))) ; 

        //Expedientes que recibí ayer
        $cSelect=
        "SELECT expediente FROM estadias WHERE   fecha_desde = '$dateAyer'   "   ;  
        $expedientesRecibidosAyer=   collect( DB::select(DB::raw($cSelect))) ; 

 
        // project://resources\views\historialoperaciones\graficos.blade.php





       //SELECT fecha_operacion, SUBSTR(fecha_operacion,7,4) AS ani FROM  historialoperacione
       $hoy = date("d/m/Y");
       $hoydia= substr($hoy,0,2);
       $hoymes= substr($hoy,3,2);        
       $hoyanio= substr($hoy,6,4);
        $anio = '2023';

       if( $anio < $hoyanio )  // Si es un año anterior, tomo el 31/12
       {

           $hoy = date("d/m/Y");
           $hoydia= '31';
           $hoymes= '12';        
           $hoyanio= $anio;
           //dd($hoyanio);
       }

       
       //dd($hoydia,$hoymes,$hoyanio);

       $expedientes = Historialoperaciones::selectRaw('count(distinct expediente) cantidad')
       ->whereraw( 'SUBSTR(fecha_operacion,7,4)='.$hoyanio )        
       ->count();  

       $cSelect = 
       "SELECT ANIO, MES, ENTRANTES, SALIENTES, ENTRANTES - SALIENTES AS DIFERENCIA, TOTALES FROM
       (  
       SELECT 
       SUBSTR(FECHA_OPERACION,7,4) AS ANIO, 
       SUBSTR(fecha_operacion,4,2) AS mes, 
       SUM( IF(CODIGO_REPARTICION_DESTINO='CGPROV#MHYF'
       AND 
       REPARTICION_USUARIO <>'CGPROV#MHYF', 1, 0 ) ) AS ENTRANTES,        
       SUM( IF( CODIGO_REPARTICION_DESTINO<>'CGPROV#MHYF'
       AND 
       REPARTICION_USUARIO ='CGPROV#MHYF', 1, 0 ) ) AS SALIENTES,
       COUNT( *) AS TOTALES
       FROM historialoperaciones where SUBSTR(fecha_operacion,7,4)='$hoyanio'
       GROUP BY ANIO, mes ) AS EXPEDIENTES";


       //dd($cCuit);
       $entradas = DB::select(DB::raw($cSelect));
                              

       $months = array(
           '01' => 'enero     ',
           '02' => 'febrero   ',
           '03' => 'marzo     ',
           '04' => 'abril     ',
           '05' => 'mayo      ',
           '06' => 'junio     ',
           '07' => 'julio     ',
           '08' => 'agosto    ',
           '09' => 'septiembre',
           '10' => 'octubre   ',
           '11' => 'noviembre ',
           '12' => 'diciembre '
         );


       // project://resources\views\historialoperaciones\movimientos_por_mes_del_anio.blade.php
 






        return view('historialoperaciones.cgp', [
        'cantidad' => $expedientes2023,
 
        'expedientes2023'=> $expedientes2023,
        'expedientes2021'=> $expedientes2021, 
        'expedientesEntregadosAyer'=> $expedientesEntregadosAyer,
        'expedientesRecibidosAyer' => $expedientesRecibidosAyer,   
        'hoyanio' => $hoyanio,
        'hoymes' => $hoymes,
        'hoydia' => $hoydia,  
        'fecha_informe'  => $hoyanio.$hoymes.$hoydia,   
        'months'=> $months,    
        'cantidad' => $expedientes,
        'expedientes'=> $expedientes, 
        'entradas'=> $entradas,            
                              
        ]); 
    }    



    public function cgp_expedienes_anio()
    {
        
 
 
            $cSelect = "SUBSTR(fecha_operacion,7,4) as anios, COUNT( distinct expediente ) as cantidad";
 

             

         $anios = \DB::table('historialoperaciones')
                          ->select(\DB::raw($cSelect))
                          ->groupBy('Anios')                       
                          ->get();   

                 //         ->whereRaw('year( registrado_at ) >= 2019') 
                         
                         
      return response()->json($anios);
    }


    public function json_grafico_meses()
    {
        
        $cSelect = " SUBSTR(fecha_operacion,4,2) AS mes , COUNT( distinct expediente ) as cantidad";
 
             

         $anios = \DB::table('historialoperaciones')
                          ->select(\DB::raw($cSelect))
                          ->groupBy('mes')
                          ->whereRaw('SUBSTR(fecha_operacion,7,4)="2023"')                          
                          ->get();   

       
                         
                         
      return response()->json($anios);
    }

    //////////////////////////////////////////////////////
    //////////////////////////////////////////////////////
    //////////////////////////////////////////////////////


    public function json_grafico_usuarios()
    {
        
        $cSelect = "select  u.apellido_nombre as destinatario , count(*) as cantidad from historialoperaciones
        INNER JOIN usuarios u ON historialoperaciones.destinatario=u.nombre_usuario
        WHERE CODIGO_REPARTICION_DESTINO = 'CGPROV#MHYF' 
      AND REPARTICION_USUARIO <> 'CGPROV#MHYF' 
      AND SUBSTR(FECHA_OPERACION, 7, 4) = '2023' 
      AND SUBSTR(fecha_operacion, 4, 2) = '01' 
       group by destinatario, apellido_nombre
       order by cantidad desc limit 10";


         $entradas = DB::select(DB::raw($cSelect));
        
 
             

        //  $anios = \DB::table('Historialoperaciones')
        //                   ->select(\DB::raw($cSelect))
        //                   ->groupBy('mes')
        //                   ->whereRaw('SUBSTR(fecha_operacion,7,4)="2023"')                          
        //                   ->get();   

       
                         
                         
      return response()->json($entradas);
    }




    //////////////////////////////////////////////////////

    public function graficar_dias()
    {
        $mes='01';

        $cSelect = 
        "SELECT COUNT(*) AS cantidad, SUBSTR(fecha_operacion,1,2) as dia FROM historialoperaciones WHERE CODIGO_REPARTICION_DESTINO='CGPROV#MHYF' AND
        REPARTICION_USUARIO <>'CGPROV#MHYF'AND SUBSTR(FECHA_OPERACION,7,4) = '2023' AND SUBSTR(fecha_operacion,4,2) = '$mes' 
        GROUP BY dia  ORDER BY dia";

        $dias = DB::select(DB::raw($cSelect));   

   
      // project://resources\views\historialoperaciones\expedientes_dia.blade.php

      return response()->json($dias);


    }


    //////////////////////////////////////////////////////

    public function graficar_meses()
    {
        $mes='01';

        $cSelect = 
        "SELECT COUNT(*) AS cantidad, SUBSTR(fecha_operacion,4,2) as mes FROM historialoperaciones WHERE CODIGO_REPARTICION_DESTINO='CGPROV#MHYF'
        AND 
        REPARTICION_USUARIO <>'CGPROV#MHYF' AND SUBSTR(FECHA_OPERACION,7,4) = '2023'  
        GROUP BY mes ORDER BY mes";

        $dias = DB::select(DB::raw($cSelect));   

   
      // project://resources\views\historialoperaciones\expedientes_dia.blade.php

      return response()->json($dias);


    }




    public function movimientos_por_mes_del_anio($anio)   // Menu Principal  
    {

        //SELECT fecha_operacion, SUBSTR(fecha_operacion,7,4) AS ani FROM  historialoperacione
        $hoy = date("d/m/Y");
        $hoydia= substr($hoy,0,2);
        $hoymes= substr($hoy,3,2);        
        $hoyanio= substr($hoy,6,4);


        if( $anio < $hoyanio )  // Si es un año anterior, tomo el 31/12
        {

            $hoy = date("d/m/Y");
            $hoydia= '31';
            $hoymes= '12';        
            $hoyanio= $anio;
            //dd($hoyanio);
        }

        
        //dd($hoydia,$hoymes,$hoyanio);

        $expedientes = Historialoperaciones::selectRaw('count(distinct expediente) cantidad')
        ->whereraw( 'SUBSTR(fecha_operacion,7,4)='.$hoyanio )        
        ->count();  

        $cSelect = 
        "SELECT ANIO, MES, ENTRANTES, SALIENTES, ENTRANTES - SALIENTES AS DIFERENCIA, TOTALES FROM
        (  
        SELECT 
        SUBSTR(FECHA_OPERACION,7,4) AS ANIO, 
        SUBSTR(fecha_operacion,4,2) AS mes, 
        SUM( IF(CODIGO_REPARTICION_DESTINO='CGPROV#MHYF'
        AND 
        REPARTICION_USUARIO <>'CGPROV#MHYF', 1, 0 ) ) AS ENTRANTES,        
        SUM( IF( CODIGO_REPARTICION_DESTINO<>'CGPROV#MHYF'
        AND 
        REPARTICION_USUARIO ='CGPROV#MHYF', 1, 0 ) ) AS SALIENTES,
        COUNT( *) AS TOTALES
        FROM historialoperaciones where SUBSTR(fecha_operacion,7,4)='$hoyanio'
        GROUP BY ANIO, mes ) AS EXPEDIENTES";


        //dd($cCuit);
        $entradas = DB::select(DB::raw($cSelect));
                               

        $months = array(
            '01' => 'enero     ',
            '02' => 'febrero   ',
            '03' => 'marzo     ',
            '04' => 'abril     ',
            '05' => 'mayo      ',
            '06' => 'junio     ',
            '07' => 'julio     ',
            '08' => 'agosto    ',
            '09' => 'septiembre',
            '10' => 'octubre   ',
            '11' => 'noviembre ',
            '12' => 'diciembre '
          );


        // project://resources\views\historialoperaciones\movimientos_por_mes_del_anio.blade.php


        return view('historialoperaciones.movimientos_por_mes_del_anio', [
        'cantidad' => $expedientes,
        'expedientes'=> $expedientes, 
        'entradas'=> $entradas,
        'months'=> $months,
        'hoyanio' => $hoyanio,
        'hoymes' => $hoymes,
        'hoydia' => $hoydia,
        'fecha_informe'  => $hoyanio.$hoymes.$hoydia,
        ]); 
    }    



    public function expedientes_usuario($fecha_informe,$mes)   // Menu Principal  
    {

         
        $anio =substr($fecha_informe,0,4);

        $cSelect = 
        "CODIGO_REPARTICION_DESTINO='CGPROV#MHYF' AND REPARTICION_USUARIO <>'CGPROV#MHYF' AND SUBSTR(FECHA_OPERACION,7,4) = '$anio' AND SUBSTR(fecha_operacion,4,2) = '$mes'" ;

        $expedientes = Historialoperaciones::selectRaw('count(distinct expediente) cantidad')
        ->whereraw( $cSelect)
        ->count();  

        $cSelect = 
        "SELECT COUNT(*) AS cantidad, destinatario   as Usuario, usuarios.apellido_nombre FROM historialoperaciones inner join usuarios on historialoperaciones.destinatario=usuarios.nombre_usuario WHERE CODIGO_REPARTICION_DESTINO='CGPROV#MHYF' AND
        REPARTICION_USUARIO <>'CGPROV#MHYF'AND SUBSTR(FECHA_OPERACION,7,4) = '$anio' AND SUBSTR(fecha_operacion,4,2) = '$mes' 
        GROUP BY destinatario,apellido_nombre ORDER BY cantidad DESC";

        $cSelect = 
        "SELECT entrantes.destinatario as usuario, apelnom, entrantes, salientes , 
        entrantes_internos.entrantes_internos , salientes_internos.SALIENTES_INTERNOS FROM 
        (
        -- ENTRANTES
        SELECT 
        SUM( IF(CODIGO_REPARTICION_DESTINO='CGPROV#MHYF'
        AND 
        REPARTICION_USUARIO <>'CGPROV#MHYF', 1, 0 ) ) AS ENTRANTES ,       
        destinatario , u.apellido_nombre AS apelnom
        FROM historialoperaciones 
        INNER JOIN usuarios u ON historialoperaciones.destinatario=u.nombre_usuario
        WHERE SUBSTR(fecha_operacion,7,4)='2023' AND SUBSTR(fecha_operacion,4,2) = '01' 
        GROUP BY destinatario, apellido_nombre       
        ) AS entrantes
        INNER JOIN 
        (        
        -- SALIENTES         
        SELECT 
        SUM( IF( CODIGO_REPARTICION_DESTINO<>'CGPROV#MHYF'
        AND 
        REPARTICION_USUARIO ='CGPROV#MHYF', 1, 0 ) ) AS SALIENTES,      
        usuario 
        FROM historialoperaciones 
        INNER JOIN usuarios u ON historialoperaciones.usuario=u.nombre_usuario
        WHERE SUBSTR(fecha_operacion,7,4)='2023' AND SUBSTR(fecha_operacion,4,2) = '01' 
        GROUP BY usuario
        ) AS salientes
        ON entrantes.destinatario = salientes.usuario
        
                INNER JOIN 
        (   
        
        -- ENTRANTE  INTERNO   

        SELECT 
        SUM( IF( CODIGO_REPARTICION_DESTINO='CGPROV#MHYF'
        AND 
        REPARTICION_USUARIO ='CGPROV#MHYF', 1, 0 ) ) AS ENTRANTES_INTERNOS,      
        DESTINATARIO
        FROM historialoperaciones 
        INNER JOIN usuarios u ON historialoperaciones.destinatario = u.nombre_usuario
        WHERE SUBSTR(fecha_operacion,7,4)='2023' AND SUBSTR(fecha_operacion,4,2) = '01' 	
        GROUP BY destinatario            
        ) AS entrantes_internos

        ON entrantes.destinatario = entrantes_internos.destinatario        
        INNER JOIN 
        (         

        -- SALIENTES  INTERNOs   

        SELECT 
        SUM( IF( CODIGO_REPARTICION_DESTINO='CGPROV#MHYF'
        AND 
        REPARTICION_USUARIO ='CGPROV#MHYF', 1, 0 ) ) AS SALIENTES_INTERNOS,      
        usuario 
        FROM historialoperaciones 
        INNER JOIN usuarios u ON historialoperaciones.usuario=u.nombre_usuario
        WHERE SUBSTR(fecha_operacion,7,4)='2023' AND SUBSTR(fecha_operacion,4,2) = '01' 	
        GROUP BY usuario 
        ) AS salientes_internos
        ON entrantes.destinatario = salientes_internos.usuario   order by entrantes desc ";
        










        $entradas = DB::select(DB::raw($cSelect));                               

 

        $months = array(
            '01' => 'enero     ',
            '02' => 'febrero   ',
            '03' => 'marzo     ',
            '04' => 'abril     ',
            '05' => 'mayo      ',
            '06' => 'junio     ',
            '07' => 'julio     ',
            '08' => 'agosto    ',
            '09' => 'septiembre',
            '10' => 'octubre   ',
            '11' => 'noviembre ',
            '12' => 'diciembre '
          );


        return view('historialoperaciones.expedientes_mes_usuario', [
        'cantidad' => $expedientes,
        'expedientes'=> $expedientes,
        'mes'=> $mes,
        'entradas'=> $entradas,
        'months'=> $months,
        'fecha_informe'  => $fecha_informe,
        ]); 

    }

    public function expedientes_dia($fecha_informe,$mes)   // Menu Principal  
    {


        $anio =substr($fecha_informe,0,4);
 
        $cSelect = 
        "CODIGO_REPARTICION_DESTINO='CGPROV#MHYF' AND REPARTICION_USUARIO <>'CGPROV#MHYF' AND SUBSTR(FECHA_OPERACION,7,4) = '$anio' AND SUBSTR(fecha_operacion,4,2) = '$mes'" ;

        $expedientes = Historialoperaciones::selectRaw('count(distinct expediente) cantidad')
        ->whereraw( $cSelect)
        ->count();  

        $cSelect = 
        "SELECT COUNT(*) AS cantidad, SUBSTR(fecha_operacion,1,2) as dia, fecha_operacion as fecha , CONCAT(ELT(WEEKDAY( CONCAT( SUBSTR(FECHA_OPERACION,7,4),'-',SUBSTR(FECHA_OPERACION,4,2),'-',SUBSTR(FECHA_OPERACION,1,2) ) 
        ) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'))  AS diasemana  FROM historialoperaciones WHERE CODIGO_REPARTICION_DESTINO='CGPROV#MHYF' AND
        REPARTICION_USUARIO <>'CGPROV#MHYF'AND SUBSTR(FECHA_OPERACION,7,4) = '$anio' AND SUBSTR(fecha_operacion,4,2) = '$mes' 
        GROUP BY dia,fecha_operacion, diasemana ORDER BY dia";

        $entradas = DB::select(DB::raw($cSelect));                               

  

        $months = array(
            '01' => 'enero     ',
            '02' => 'febrero   ',
            '03' => 'marzo     ',
            '04' => 'abril     ',
            '05' => 'mayo      ',
            '06' => 'junio     ',
            '07' => 'julio     ',
            '08' => 'agosto    ',
            '09' => 'septiembre',
            '10' => 'octubre   ',
            '11' => 'noviembre ',
            '12' => 'diciembre '
          );


        return view('historialoperaciones.expedientes_dia', [
        'cantidad' => $expedientes,      
        'expedientes'=> $expedientes,     
        'entradas'=> $entradas,
        'months'=> $months,

        ]); 

    }





}

