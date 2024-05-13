<?php

function NombreMesEspanol($nMes)
{
    $cNombreMes = "Error";
    //dd($nMes);

    

    switch ($nMes) {
        case  1:  $cNombreMes = 'Enero';     break;
        case  2:  $cNombreMes = 'Febrero';     break;
        case  3:  $cNombreMes = 'Marzo';     break;
        case  4:  $cNombreMes = 'Abril';     break;
        case  5:  $cNombreMes = 'Mayo';     break;
        case  6:  $cNombreMes = 'Junio';     break;
        case  7:  $cNombreMes = 'Julio';     break;
        case  8:  $cNombreMes = 'Agosto';     break;
        case  9:  $cNombreMes = 'Septiembre';     break;
        case 10:  $cNombreMes = 'Octubre';     break;
        case 11:  $cNombreMes = 'Noviembre';     break;
        case 12:  $cNombreMes = 'Diciembre';     break;

        
        default: $cNombreMes = 'Error';     break;

    }
    return $cNombreMes ;

}


function NombreMes($nMes)
{
    $cNombreMes = "Error";

    switch ($nMes) {
        case  1:  $cNombreMes = 'January';     break;
        case  2:  $cNombreMes = 'February';     break;
        case  3:  $cNombreMes = 'March';     break;
        case  4:  $cNombreMes = 'April';     break;
        case  5:  $cNombreMes = 'May';     break;
        case  6:  $cNombreMes = 'June';     break;
        case  7:  $cNombreMes = 'July';     break;
        case  8:  $cNombreMes = 'August';     break;
        case  9:  $cNombreMes = 'September';     break;
        case 10:  $cNombreMes = 'October';     break;
        case 11:  $cNombreMes = 'Novembre';     break;
        case 12:  $cNombreMes = 'Diciembre';     break;
        
        default: $cNombreMes = 'Error';     break;

    }
    return $cNombreMes ;

}


function Val($cNumero)
{
    $integer = (int)$cNumero;
    return $integer;


}


 

//$americandate_venc = french2american( $request->date_venc ) ;
// // DD/MM/AAAA    AAAA-MM-DD  
function french2american( $frenchdate)
{
$dia = substr($frenchdate,0,2);
$mes = substr($frenchdate,3,2);
$ano = substr($frenchdate,6,4);

//dd($ano.'-'.$mes.'-'.$dia) ;
return $ano.'-'.$mes.'-'.$dia;

}

function american2french( $americandate)
{
    //2022-12-31
    $dia = substr($americandate,8,2);
    $mes = substr($americandate,5,2);
    $ano = substr($americandate,0,4);
    
    //dd($ano.'-'.$mes.'-'.$dia) ;
    return $dia.'/'.$mes.'/'.$ano; 
 
return $dtdate;

}




        //$dt2 = Carbon::createFromDate(1987, 4, 23);
        //$dt = Carbon::createFromDate( $cYear, $cMonth, $day);
        //$dtdate =$dt->format('Y-m-d');



///// FUNCIONES GENERALES FUERA DE LA CLASE

function Fecha()
{

    $date = Carbon::today();
    $fecha = $date->format('Ymd');   
    // Esto debe devolver AAAAMMDD por ejemplo  "20190909"

    //dd($fecha);

    echo $fecha;
    return $fecha;
}

function zeros($cadena,$longitud)
{

    $zeros =  substr("00000000".$cadena,-1 * $longitud ,$longitud);
    //dd($zeros);
    return $zeros;
}

////////////////////////////////////////////     

function formatgde( $expediente )
{
    return ( substr( $expediente ,0,2 ) ."-". 
    substr( $expediente ,2,4 ) ."-". 
    substr( $expediente ,6,7 ) ."-   -". 
    substr( $expediente ,13,50 ) );


}


