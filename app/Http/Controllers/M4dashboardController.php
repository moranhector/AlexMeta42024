<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use Flash;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Usuario;

use Carbon\Carbon;

 

use Illuminate\Http\Request;
use GuzzleHttp\Client;



use Illuminate\Support\Facades\Http;

include 'funciones.php';



class M4dashboardController extends AppBaseController
{



//     _           _     _                         _ 
//     | |         | |   | |                       | |
//   __| | __ _ ___| |__ | |__   ___   __ _ _ __ __| |
//  / _` |/ _` / __| '_ \| '_ \ / _ \ / _` | '__/ _` |
// | (_| | (_| \__ \ | | | |_) | (_) | (_| | | | (_| |
//  \__,_|\__,_|___/_| |_|_.__/ \___/ \__,_|_|  \__,_|    DEL USUARIO 
                                                   
                                                   
    // BUSCAR COMO CTRL + F "ON DASHBOARD"

    public function dashboard( )   // Menu Principal  
    {



        return view('historialoperaciones.dashboard'); 
    }    




 
                                                   
 

    public function planta(   )   // Menu Principal  
    {


        $date_today = date('d-m-Y');
        $date_yesterday = strtotime('-1 day', strtotime($date_today));
        $date_yesterday = date('Y-m-d', $date_yesterday);

        //dd($date_yesterday);


        $dateAyer =  str_replace( "-" , "/" , $date_yesterday ) ;
        $dateAyer =  $date_yesterday  ;

 
        
 
  
 
 
        //SECTOR
        $sexo = 'M';

        //Planta Total

        $cSelect=
        "SELECT COUNT(*) as personas FROM CAR_SIGNOS WHERE estadolegajo=1 AND admin_persona='S' AND rats<>'9999999' AND periodo='202307';";

        $plantaTotal=   collect( DB::select(DB::raw($cSelect))) ;          

        $user_nickname = session('user_nickname');


        //dd($usuario->sexo);

        return view('historialoperaciones.planta', [
        'plantaTotal' => $plantaTotal,        
        ]); 
    }    


    public function jubilaciones( )  
    {


        $date_today = date('d-m-Y');
        $date_yesterday = strtotime('-1 day', strtotime($date_today));
        $date_yesterday = date('Y-m-d', $date_yesterday);



        $dateAyer =  str_replace( "-" , "/" , $date_yesterday ) ;
        $dateAyer =  $date_yesterday  ;


        return view('historialoperaciones.jubilaciones' ); 
    }    



    public function ausentismo( )  
    {


        $date_today = date('d-m-Y');
        $date_yesterday = strtotime('-1 day', strtotime($date_today));
        $date_yesterday = date('Y-m-d', $date_yesterday);

        //dd($date_yesterday);


        $dateAyer =  str_replace( "-" , "/" , $date_yesterday ) ;
        $dateAyer =  $date_yesterday  ;




        //Planta Total

        $cSelect=
        "SELECT COUNT(*) as personas FROM CAR_SIGNOS WHERE estadolegajo=1 AND admin_persona='S' AND rats<>'9999999' AND periodo='202307';";

        $plantaTotal=   collect( DB::select(DB::raw($cSelect))) ;          

 

        //dd($usuario->sexo);

        return view('historialoperaciones.ausentismo', [

        'plantaTotal' => $plantaTotal,        
        ]); 
    }    



    public function sindicatos( )  
    {


        $date_today = date('d-m-Y');
        $date_yesterday = strtotime('-1 day', strtotime($date_today));
        $date_yesterday = date('Y-m-d', $date_yesterday);

        //dd($date_yesterday);


        $dateAyer =  str_replace( "-" , "/" , $date_yesterday ) ;
        $dateAyer =  $date_yesterday  ;



        //Planta Total

        $cSelect=
        "SELECT COUNT(*) as personas FROM CAR_SIGNOS WHERE estadolegajo=1 AND admin_persona='S' AND rats<>'9999999' AND periodo='202307';";

        $plantaTotal=   collect( DB::select(DB::raw($cSelect))) ;          

 

        //dd($usuario->sexo);

        return view('historialoperaciones.sindicatos', [

        'plantaTotal' => $plantaTotal,        
        ]); 
    }    

    public function licencias( )  
    {


        $date_today = date('d-m-Y');
        $date_yesterday = strtotime('-1 day', strtotime($date_today));
        $date_yesterday = date('Y-m-d', $date_yesterday);

        //dd($date_yesterday);


        $dateAyer =  str_replace( "-" , "/" , $date_yesterday ) ;
        $dateAyer =  $date_yesterday  ;


        //Planta Total

        $cSelect=
        "SELECT COUNT(*) as personas FROM CAR_SIGNOS WHERE estadolegajo=1 AND admin_persona='S' AND rats<>'9999999' AND periodo='202307';";

        $plantaTotal=   collect( DB::select(DB::raw($cSelect))) ;          

 

        //dd($usuario->sexo);

        return view('historialoperaciones.licencias', [

        'plantaTotal' => $plantaTotal,        
        ]); 
    }    








    public function genero(  ) 
    {

    // $cSelect = 
    // "SELECT COUNT(*)  AS tareas, usuario FROM estadias WHERE usuario = '".$usuario."' AND  YEAR( estadias.fecha_desde ) = 2022  group by usuario
    // UNION
    //   SELECT COUNT(*)  AS tareas , 'Resto' AS Usuario FROM estadias WHERE usuario IN    
    //  ( SELECT nombre_usuario FROM usuarios WHERE codigo_sector_interno='SUBSAP2#CGPROV' )     
    //  AND  YEAR( estadias.fecha_desde ) = 2022 AND usuario <> '".$usuario."' GROUP BY 'Resto'" ; //Ahora hago la recorrida al reves

     $cSelect = "SELECT COUNT(*) AS cantidad, genero
 FROM CAR_SIGNOS WHERE estadolegajo=1 AND admin_persona='S' AND rats<>'9999999' AND periodo='202307' 
GROUP BY genero" ;


    $genero = DB::select(DB::raw($cSelect));  



      
                         
                         
     return response()->json($genero);

    }



    public function uor(  ) 
    {
     $cSelect = "SELECT ETIQUETA  as uor,EMPLEADOS as cantidad  FROM
     (SELECT lqhislegpuerca,lqhislegpuerju, COUNT(DISTINCT cuil) AS EMPLEADOS FROM CAR_SIGNOS WHERE estadolegajo=1 AND admin_persona='S' AND rats<>'9999999' AND periodo='202307'  GROUP BY lqhislegpuerca,lqhislegpuerju) AS total
     INNER JOIN INSTITUCIONES ON total.lqhislegpuerca=caracter AND total.lqhislegpuerju=jurisdiccion GROUP BY ETIQUETA, EMPLEADOS;
     " ;

    $planta = DB::select(DB::raw($cSelect));  

    //dd( $planta ) ;
     return response()->json($planta);

    }


   

    public function uor_explode( $uor ) 
    {
     $cSelect = "SELECT uni_org_desc as uor,EMPLEADOS  as cantidad FROM
     (SELECT lqhislegpuerca,lqhislegpuerju,lqhislegpueruo, COUNT(DISTINCT cuil) AS empleados FROM CAR_SIGNOS WHERE estadolegajo=1 AND admin_persona='S' AND rats<>'9999999' AND periodo='202307'  GROUP BY lqhislegpuerca,lqhislegpuerju,lqhislegpueruo) AS total
     INNER JOIN INSTITUCIONES ON total.lqhislegpuerca=caracter AND total.lqhislegpuerju=jurisdiccion AND total.lqhislegpueruo=unidar_org
     WHERE ETIQUETA='$uor' GROUP BY ETIQUETA, JUR_DESCRIP,unidar_org,uni_org_desc,EMPLEADOS" ;

    $planta = DB::select(DB::raw($cSelect));  

    //dd( $planta ) ;
     return response()->json($planta);

    }    



    public function generoxv(  ) 
    {

     $cSelect = "SELECT COUNT(*) AS value, genero as x
     FROM CAR_SIGNOS WHERE estadolegajo=1 AND admin_persona='S' AND rats<>'9999999' AND periodo='202307' 
     GROUP BY genero" ;

    $genero = DB::select(DB::raw($cSelect));  
                         
     return response()->json($genero);

    }



    public function ShowAltasAgrupadas($periodo = '202308')
    {




        $url = "http://localhost:3000/altas_agrupadas_por_uor/202301";

        // Establece el tiempo de espera en segundos (60 segundos en este ejemplo)
        $timeout = 60;

        // Intenta obtener la respuesta
        $response = @file_get_contents($url, false, stream_context_create(['http' => ['timeout' => $timeout]]));

        // Verifica si se obtuvo una respuesta
        if ($response === false) {
            // Manejar el caso en que la solicitud falló o se alcanzó el tiempo de espera
            return response()->json(['error' => 'Tiempo de espera excedido o solicitud fallida'], 504);
        }

        // Decodifica la respuesta como un array
        $data = json_decode($response, true);        
   

        // Retornar los datos y cargar la vista blade
        return view('planta.showAltasAgrupadas', 
        ['data' => $data, ]  );
    }


    public function ShowAltas($periodo = '202308')
    {


        // Retornar los datos y cargar la vista blade
        return view('planta.showAltas', 
        [ 'periodo' => '202301', ]  );
    }


    public function buscador_gde(Request $request)
    {
        // dd('hasta ');
        $cCantidad_registros = $request->input('Cantidad_registros');
        $cUsuario = $request->input('query');
        // Obtener los otros valores del request, como cFiltro y cFiltroFechas

        if (empty($cUsuario)) {
            //return response()->json(['message' => 'Nada para buscar !!!'], 400);
            return view('historialoperaciones.buscadorgde');            


        }

        // $query = "descripcion:" . $cUsuario;      var query = "cuit_cuil: "+ cCuit ;
        //$query = "numero:" . $cUsuario;        
        //$query = '(numero:' . $cUsuario . ' OR descripcion:' . urlencode($cUsuario) . ')';
        $query = '(numero:' . urlencode($cUsuario) . ' OR descripcion:' . urlencode($cUsuario) . ' OR cuit_cuil:' . urlencode($cUsuario) .  ')';        
        $cFiltroFechas = "fecha_creacion:%20%5B%202016-12-01T00:00:00Z%20TO%202040-12-01T23:59:59Z%20%5D";
        
        //http: //solr.gde4p.mendoza.gov.ar/bweb-solr/core-ee/select?q=descripcion:moran&version=2.2&fq=fecha_creacion:%20%5B%202016-12-01T00:00:00Z%20TO%202040-12-01T23:59:59Z%20%5D&rows=&wt=json
        //https://solr.gde4p.mendoza.gov.ar/bweb-solr/core-ee/select?q=descripcion:MORAN&version=2.2&indent=on&wt=json&callback=jQuery31108599966409378612_1699885856523&json.wrf=on_data&_=1699885856524        
      //$url = 'http://solr.gde4p.mendoza.gov.ar/bweb-solr/core-ee/select?q=' . $query . '&version=2.2&fq=' . $cFiltroFechas . '&rows=' . $cCantidad_registros . '&wt=json';
        $url = 'http://solr.gde4p.mendoza.gov.ar/bweb-solr/core-ee/select?q=' . $query . '&version=2.2&indent=on&wt=json&callback=jQuery31108599966409378612_1699885856523&json.wrf=on_data&_=1699885856524';
        //dd($url);

        $client = new Client();

        try {
 

            //return response()->json($data, 200);

            // Supongamos que $response contiene la respuesta de Guzzle
            $response = $client->get($url); // Realiza la solicitud a Solr
            $jsonData = $response->getBody()->getContents(); // Obtén el contenido de la respuesta como una cadena de texto

            //dd($jsonData);

            // Extraer el JSON puro de los datos JSONP
            $jsonStart = strpos($jsonData, '('); // Encontrar el índice del primer paréntesis
            $jsonEnd = strrpos($jsonData, ')'); // Encontrar el índice del último paréntesis

            if ($jsonStart !== false && $jsonEnd !== false) {
                $jsonContent = substr($jsonData, $jsonStart + 1, $jsonEnd - $jsonStart - 1);
                $data = json_decode($jsonContent, true);

                //dd($data['response']['docs']);

                // Procesar los datos como desees, por ejemplo, pasándolos a la vista
                return view('historialoperaciones.buscadorgde', ['resultados' => $data['response']['docs'] ]);
                        } else {
                            return response()->json(['error' => 'Error al procesar la respuesta de Solr'], 500);
                        }



            //return view('historialoperaciones.buscadorgde', ['resultados' => $resultados]);

        } catch (\Exception $e) {
            //return response()->json(['error' => 'Hubo un error al procesar la solicitud.'], 500);
            $resultados=[];
            return view('historialoperaciones.buscadorgde', ['resultados' => $resultados]);            
        }
    }







    // public function buscador(Request $request)
    // {
    //     // dd('hasta ');
    //     $cCantidad_registros = $request->input('Cantidad_registros');
    //     $cUsuario = $request->input('query');
    //     // Obtener los otros valores del request, como cFiltro y cFiltroFechas

    //     if (empty($cUsuario)) {
    //         //return response()->json(['message' => 'Nada para buscar !!!'], 400);
    //         return view('historialoperaciones.buscador');            


    //     }

    //     $query = "descripcion:" . $cUsuario;
    //     $cFiltroFechas = "fecha_creacion:%20%5B%202016-12-01T00:00:00Z%20TO%202040-12-01T23:59:59Z%20%5D";
        
    //     //http: //solr.gde4p.mendoza.gov.ar/bweb-solr/core-ee/select?q=descripcion:moran&version=2.2&fq=fecha_creacion:%20%5B%202016-12-01T00:00:00Z%20TO%202040-12-01T23:59:59Z%20%5D&rows=&wt=json
    //     //https://solr.gde4p.mendoza.gov.ar/bweb-solr/core-ee/select?q=descripcion:MORAN&version=2.2&indent=on&wt=json&callback=jQuery31108599966409378612_1699885856523&json.wrf=on_data&_=1699885856524        
    //   //$url = 'http://solr.gde4p.mendoza.gov.ar/bweb-solr/core-ee/select?q=' . $query . '&version=2.2&fq=' . $cFiltroFechas . '&rows=' . $cCantidad_registros . '&wt=json';
    //     $url = 'http://solr.gde4p.mendoza.gov.ar/bweb-solr/core-ee/select?q=' . $query . '&version=2.2&indent=on&wt=json&callback=jQuery31108599966409378612_1699885856523&json.wrf=on_data&_=1699885856524';
    //     //dd($url);

    //     $client = new Client();

    //     try {
 

    //         //return response()->json($data, 200);

    //         // Supongamos que $response contiene la respuesta de Guzzle
    //         $response = $client->get($url); // Realiza la solicitud a Solr
    //         $jsonData = $response->getBody()->getContents(); // Obtén el contenido de la respuesta como una cadena de texto

    //         //dd($jsonData);

    //         // Extraer el JSON puro de los datos JSONP
    //         $jsonStart = strpos($jsonData, '('); // Encontrar el índice del primer paréntesis
    //         $jsonEnd = strrpos($jsonData, ')'); // Encontrar el índice del último paréntesis

    //         if ($jsonStart !== false && $jsonEnd !== false) {
    //             $jsonContent = substr($jsonData, $jsonStart + 1, $jsonEnd - $jsonStart - 1);
    //             $data = json_decode($jsonContent, true);

    //             //dd($data['response']['docs']);

    //             // Procesar los datos como desees, por ejemplo, pasándolos a la vista
    //             return view('historialoperaciones.buscador', ['resultados' => $data['response']['docs'] ]);
    //                     } else {
    //                         return response()->json(['error' => 'Error al procesar la respuesta de Solr'], 500);
    //                     }

 

    //         //return view('historialoperaciones.buscadorgde', ['resultados' => $resultados]);

    //     } catch (\Exception $e) {
    //         //return response()->json(['error' => 'Hubo un error al procesar la solicitud.'], 500);
    //         $resultados=[];
    //         return view('historialoperaciones.buscador', ['resultados' => $resultados]);            
    //     }
    // }


   public function personas(   )   // Menu Principal  
    {


        $date_today = date('d-m-Y');
        $date_yesterday = strtotime('-1 day', strtotime($date_today));
        $date_yesterday = date('Y-m-d', $date_yesterday);

        //dd($date_yesterday);


        $dateAyer =  str_replace( "-" , "/" , $date_yesterday ) ;
        $dateAyer =  $date_yesterday  ;

 
        
 
  
 
 
        //SECTOR
        $sexo = 'M';

        //Planta Total

        $cSelect=
        "SELECT COUNT(*) as personas FROM CAR_SIGNOS WHERE estadolegajo=1 AND admin_persona='S' AND rats<>'9999999' AND periodo='202307';";

        $plantaTotal=   collect( DB::select(DB::raw($cSelect))) ;          

        $user_nickname = session('user_nickname');


        //dd($usuario->sexo);

        return view('historialoperaciones.personas', [
        'plantaTotal' => $plantaTotal,        
        ]); 
    }    




}

