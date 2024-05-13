# cgpdashboard

16/8/2022

Próximos pasos

Pantalla Login

Quitar submenu
Armar menu Left

Incorporar consignas contadora


Seleccionar Librería de Gráficos



![Alt text](https://github.com/moranhector/cgp/blob/main/_out_of_project/2022-08-16.png?raw=true "Title")



Ojo, hay dos Jquery insertados.



Completé la visualización del primer gráfico de ejemplo

17/8/2022

Estoy refinando las consultas subyacentes

Retoques visualización, Login, etc.

Consultas de tarjetas indicadores
project://app\Http\Controllers\historialoperacionesController.php#227


2022-08-17 (4)

![Alt text](https://github.com/moranhector/cgp/blob/main/_out_of_project/2022-08-17.png?raw=true "Title")22-08-1




1/9/2022 -

Tabla de Entradas y Salidas por mes del Año 2022

project://app\Http\Controllers\historialoperacionesController.php#262



Vista tabla

project://resources\views\historialoperaciones\graficos2.blade.php


Sql 

  --ENTRANTES Y SALIENTES POR AÑO Y MMES 
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
FROM historialoperaciones 
GROUP BY ANIO, mes
 ;  
 
 
  --ENTRANTES Y SALIENTES POR AÑO Y MMES 
  
 |
 ;  

![Alt text](https://github.com/moranhector/cgp/blob/main/_out_of_project/tablaentradasalidas.jpg?raw=true "Title")



7/9/2022.
Miércoles

Problema con barra inferior, pisaba la tabla.
Tuve que ir a
C:\xampp\htdocs\cgpdashboard\resources\views\layouts\app.blade.php

y retocar la línea 49 para configurarle un min-height de 1700 


<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper" style="min-height: 1700px;">

13/9/2022    
Reunión con gente de Contaduría

Temas que surgieron

Clasificar por Sector
Realizar un proceso para detectar Reprocesos
Planear la consulta que a través de un código en las observaciones 
**05 
**14 
etc identifique tipos de trámites

Otras tareas a realizar
Importar los nombres de los usuarios para no mostrar códigos sino nombres.
Actualizar con movimientos de Septiembre hasta el día de hoy.
Mostrar un gráfico PIE para usuarios y para sectores


Función de enviar a Excel y PDF


php artisan infyom:scaffold Usuario --fieldsFile Usuario.json

_______________________________________________________________________

16/9/2022.
Viernes

Mostrar los nombres de usuarios en estadistica por usuarios.
Agregar paginado y filtrado en index de usuarios.

Copio desde proyecto Xamina, inventarios index y controller.

Copiar fragmento de código de inventarios index.


            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Inventarios</h1>
                    <div class="col-sm">
                        <nav class="navbar navbar-light bg-light">
                        <form class="form-inline" method {{route('inventarios.index')}} >
                            <input name='namepieza' class="form-control mr-sm-2" type="search" placeholder="Buscar por nombre" value="{{ old('namepieza') }}" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                        </form>
                    </nav>                     
                </div>
            </div>


pegarlo en index de la entidad destino.

debajo de estas dos lineas:


    <section class="content-header">
        <div class="container-fluid">


Reemplazar nombre de variable de busqueda. Usar Ctrl F2 para cambiar todas las ocurrencias.

En controlador pegar este fragmento en metodo index.

    public function index(Request $request)
    {

        $nombre  = $request->get('nombre');

        if($nombre)
        {        
            $usuarios = DB::table('usuarios')
            ->where('nombre','like','%'.$nombre.'%' ) 
            ->paginate( 100 ) ;   

            $data['usuarios'] = $usuarios;     
            $data['nombre'] = $nombre;     

            return view('usuarios.index',["usuarios"=>$usuarios,"nombre"=>$nombre]);            
        } 
        else
        {
      
            $usuarios = DB::table('usuarios')->paginate(25);
        }
        return view('usuarios.index')
            ->with('usuarios', $usuarios);
    }

También Reemplazar nombre de variable de busqueda. Usar Ctrl F2 para cambiar todas las ocurrencias.

En Controlador incluir: 

use Illuminate\Support\Facades\DB;


LOAD DATA INFILE 'usuarios2.csv' INTO TABLE usuarios FIELDS TERMINATED BY ',' ENCLOSED BY '"'  IGNORE 1 LINES;


Mejoras en index de historialoperaciones

19/9/2022.

Lunes

Mostrar expedientes asociados a un usuario.

   
          
        
        -- *******************************************************************
        SELECT entrantes.usuario, apelnom, entrantes, salientes , entrantes_internos.entrantes_INTERNOS , salientes_internos.SALIENTES_INTERNOS FROM 
        (
 -- ENTRANTES
        SELECT 
        SUM( IF(CODIGO_REPARTICION_DESTINO='CGPROV#MHYF'
        AND 
        REPARTICION_USUARIO <>'CGPROV#MHYF', 1, 0 ) ) AS ENTRANTES ,       
        destinatario AS usuario, u.apellido_nombre AS apelnom
        FROM historialoperaciones 
        INNER JOIN usuarios u ON historialoperaciones.destinatario=u.nombre_usuario
        WHERE SUBSTR(fecha_operacion,7,4)='2022' AND SUBSTR(fecha_operacion,4,2) = '01' 
         GROUP BY usuario         
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
        WHERE SUBSTR(fecha_operacion,7,4)='2022' AND SUBSTR(fecha_operacion,4,2) = '01' 
         GROUP BY usuario
         ) AS salientes
         ON entrantes.usuario = salientes.usuario
         
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
        WHERE SUBSTR(fecha_operacion,7,4)='2022' AND SUBSTR(fecha_operacion,4,2) = '01' 	
        GROUP BY destinatario            
        ) AS entrantes_internos
        
        ON entrantes.usuario = entrantes_internos.destinatario        
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
        WHERE SUBSTR(fecha_operacion,7,4)='2022' AND SUBSTR(fecha_operacion,4,2) = '01' 	
        GROUP BY usuario 
        ) AS salientes_internos
         ON entrantes.usuario = salientes_internos.usuario      

martes 20 de Septiembre.

Logré la tabla consulta por usuario con entrantes, salientes y movimientos internos.
Incorporé el primer gráfico de tipo doghnut en 
resources\views\historialoperaciones\expedientes_mes_usuario.blade.php

Qué sigue?

En el gráfico, mejorar la estética con una escala de azules, degradar los colores.
Parametrizar para que responda por mes y anio.
Acomodar a un costado derecho de la tabla.

Estudiar las demoras, diferencias de tiempos entre movimientos.
Estudiar los reprocesos.

Jueves 22 de Septiembre.


Mejoras en los colores de la doghnut en 
project://resources\views\historialoperaciones\expedientes_mes_usuario.blade.php#225

https://htmlcolorcodes.com/es/



                        backgroundColor: [
                            'rgba(0, 200, 220)',
                            'rgba(20, 190, 220)',
                            'rgba(40, 180, 220)',
                            'rgba(060, 170, 220)',
                            'rgba(80, 160, 220)',
                            'rgba(100, 150, 220)',
                            'rgba(120, 140, 220)',
                            'rgba(140, 130, 220)',
                            'rgba(160, 120, 220)',
                            'rgba(180, 110, 220)',

                        backgroundColor: [
                            'rgb(114, 6, 60)',
                            'rgb(134, 16, 60)',
                            'rgb(154, 26, 60)',
                            'rgb(174, 36, 60)',
                            'rgb(194, 46, 60)',
                            'rgb(214, 56, 60)',
                            'rgb(234, 66, 60)',
                            'rgb(234,76, 60)',
                            'rgb(240,86, 60)',
                            'rgb(250, 96, 60)',                            


                        ],
                        borderColor: [
                            'black',
                            'black',
                            'black',
                            'black',
                            'black',
                            'black',
                            'black',
                            'black',
                            'black',
                            'black',

                        ]


 


28 de septiembre.

Miércoles

Estuve completando la función de calcular REPROCESOS.

app\Http\Controllers\historialoperacionesController.php

function contar.


Opera correctamente y obtengo la info. El problema que surge es de Memoria y de tiempos.

Symfony\Component\ErrorHandler\Error\FatalError
Allowed memory size of 536870912 bytes exhausted (tried to allocate 125829152 bytes)

Para usar menos memoria traje solo los campos necesarios evitando el select * ... y mejoró.
Pero aún quedó el problema del tiempo  Más de un minuto el Apache empieza a quejarse.

Usé         set_time_limit(0);

para tomar tiempo indefinido pero aún así el servidor cortará en cierto tiempo máximo que puede ser 5 minutos.


Tengo la idea de cambiar el enfoque de la función haciendola incremental.

Tomaré una cantidad reciente de registros nuevos y buscaré los expedientes en xexpedientes acumulando entradas y salidas.

La función deberá tener entonces parámetros de fechas y deberá existir un registro quizá en la tabla mysql 
que indique último expediente y última fecha procesada.



SELECT COUNT(*) FROM historialoperaciones WHERE id_expediente=151311 ;
EX2018593641GDEMZA-SEGE#MSDSYD;

SELECT * FROM historialoperaciones WHERE id_expediente=151311 ORDER BY id;

SELECT COUNT( DISTINCT historialoperaciones.EXPEDIENTE ) FROM historialoperaciones

SELECT DISTINCT id_expediente FROM historialoperaciones

SELECT COUNT(*) FROM xexpedientes

TRUNCATE TABLE `cgpdashboard`.`xexpedientes`

110143

SELECT COUNT(*) FROM historialoperaciones WHERE id_expediente=110143

SELECT * FROM xexpedientes WHERE entradas > 1 ORDER BY entradas DESC
SELECT COUNT(*) FROM xexpedientes;l

SELECT id_expediente, expediente,
        CONCAT( SUBSTR(fecha_operacion,7,4), SUBSTR(fecha_operacion,4,2) , SUBSTR(fecha_operacion,1,2) ) AS fecha,
        CODIGO_REPARTICION_DESTINO, REPARTICION_USUARIO
         FROM historialoperaciones WHERE SUBSTR(fecha_operacion,7,4)='2022' ORDER BY 1, 3 ;
         
         
SELECT COUNT( DISTINCT id_expediente ) id_expediente 
         FROM historialoperaciones WHERE SUBSTR(fecha_operacion,7,4)='2022'   ;






4/10/2022
Martes

SELECT COUNT(*) FROM historialoperaciones  WHERE contado = 1    


SELECT id, id_expediente, expediente,
        CONCAT( SUBSTR(fecha_operacion,7,4), SUBSTR(fecha_operacion,4,2) , SUBSTR(fecha_operacion,1,2) ) AS fecha,
        CODIGO_REPARTICION_DESTINO, REPARTICION_USUARIO
         FROM historialoperaciones  WHERE contado = 1    ORDER BY 1   

         
5/10/2022
Miércoles

Ya tengo los reprocesos. tabla xexpedienttes.
--REPROCESOS
SELECT * FROM xexpedientes ORDER BY entradas DESC

Puedo restar fecha de operacion para acumular dias.

puedo tomar demora maxima del
demora promedio
guardar fecha ultima operacion de cada expediente
guardar ultio usuario y ultimo destinatario
usuario de maxima demora


registro xusuarios

guardar nombre de usuario
acumular cantidad de movimientos


codigo sector destino

a quien le atribuyo los reprocesos, que sector destino?


6/10/2022
Jueves

Dashboard del Usuario


12/10/2022
Miércoles

## Nombre del Sistema: ALEX


Documentar la alimentación de historialoperaciones incremental.



## PROCEDIMIENTO DE EXPORTACION / IMPORTACION / GDE -> ALEX

En MySql tomar el ultimo registro de historialoperaciones importado.

SELECT MAX(id) FROM historialoperaciones; 
Hoy me dio 21975200



- En Oracle Sql Developer:

Teniendo el id de referencia: 
En este caso: 21975200

--MOVIMIENTOS DE EXPEDIENTES HASTA 12/10 incremental solo los registros mayores a 21975200
SELECT
ID,TIPO_OPERACION,FECHA_OPERACION,USUARIO,EXPEDIENTE,ID_EXPEDIENTE,GRUPO_SELECCIONADO,
DESTINATARIO,REPARTICION_USUARIO,
substr(MOTIVO,0,40) as motivo ,
ESTADO_ANTERIOR,LOGGEDUSERNAME,ESTADO,USUARIO_SELECCIONADO,
TIPO_OPERACION_DETALLE,TAREA_GRUPAL,SECTOR_USUARIO_ORIGEN,CODIGO_REPARTICION_DESTINO,CODIGO_SECTOR_DESTINO,
DESCRIPCION_REPARTICION_ORIGEN,DESCRIPCION_SECTOR_ORIGEN,DESCRIPCION_SECTOR_DESTINO,DESCRIPCION_REPARTICION_DESTIN,
CODIGO_JURISDICCION_ORIGEN,CODIGO_JURISDICCION_DESTINO,ORD_HIST
from ee_ged.historialoperacion 
where ( codigo_reparticion_destino ='CGPROV#MHYF' or reparticion_usuario ='CGPROV#MHYF')
and extract( year from FECHA_OPERACION)=2022 and id > 21975200 order by id ;

Sobre la grilla, botón derecho, exportar.



Atención; 
Formato csv, 
Cabecera: checked,  ( default)
Cierre a Izq y Der: “, 
Codificación: UTF8
Terminador de línea: valor por defecto de entorno ( default)
Archivo de salida: HistorialDelta.csv

Siguiente y Terminar.

-Pasar a la máquina con USB, con Google Drive, o como sea.

Para subir al MYSQL


Pegar el archivo CSV en la carpeta 
C:\xampp\mysql\data\cgpdashboard

( Abrir el archivo con Notepad y grabar con UTF8 ( importante ) ) NO HACE FALTA SI ESTA EN UTF8.,


Arrancar el CMD
Ir a la carpeta C:\xampp\mysql\bin

Entrar al mysql 
C:\xampp\mysql\bin>mysql -u root -p013042


MariaDB [cgpdashboard]> 


set character_set_database=utf8;


LOAD DATA INFILE 'HISTORIAL_DELTA.csv'   INTO TABLE historialoperaciones FIELDS TERMINATED BY ','   ENCLOSED BY '"'  IGNORE 1 LINES;


Al terminar tomar el Id para la siguiente subida:

SELECT MAX(id) FROM historialoperaciones; 
22779814 ( 22 millones …. )


Estos pasos también se pueden hacer desde SQLYOG u otro cliente mysql.


## Siguientes pasos: Dashboard del Usuario.

- Probar con gconsoli.

- Problema con ASSETS. Se ve mal el logo. Corregir. OK

- Corregir Login Blade - Copiar de Xaminaweb.  OK

CORREGIDOS APP.BLADE Y SIDEBAR.BLADE en ASSETS

## Proximos pasos: Login

- Expedientes que saqué esta semana, que recibí, este mes, etc.

- Al hacer clic en Más Info mostrar la lista de expedientes.

- Mostrar en letras grandes NOMBRE DE USUARIO.


13/10/2022
Jueves

Foto del usuario. 
graficos cambiar
Sector del usuario.
Titulo nombre usuario.

Nombre, apellido_nombre, nombre usuario, cargo, nombre reparticion_usuario

    0 => "nombre"
    1 => "apellido_nombre"
    2 => "nombre_usuario"
    3 => "mail"
    4 => "numero_cuit"
    5 => "codigo_reparticion"
    6 => "nombre_reparticion"
    7 => "codigo_sector_interno"
    8 => "cargo"




14/10/2022
Viernes

php artisan migrate --path='./database/migrations/2022_09_15_153209_create_usuarios_table.php'


17/10/2022
Lunes
Parametrizar el usuario en Dashboard

SELECT * FROM usuarios WHERE nombre_usuario = 'GCONSOLI';

SELECT * FROM usuarios WHERE codigo_sector_interno='SUBSAP2#CGPROV'

SELECT * FROM usuarios WHERE  codigo_reparticion = "CGPROV#MHYF"   ORDER BY codigo_sector_interno ;
SELECT DISTINCT codigo_sector_interno, cargo FROM usuarios WHERE  codigo_reparticion = "CGPROV#MHYF"   ORDER BY codigo_sector_interno ;


SECTORES ORIGEN

SELECT COUNT(*) AS cantidad, reparticion_usuario
FROM historialoperaciones 
WHERE  codigo_reparticion_destino ='CGPROV#MHYF'
AND REPARTICION_USUARIO<>'CGPROV#MHYF'
GROUP BY REPARTICION_USUARIO
ORDER BY REPARTICION_USUARIO


SELECT * FROM estadias WHERE ;
TRUNCATE TABLE estadias;

SELECT COUNT(*) FROM historialoperaciones


SELECT MAX(fecha_desde) FROM estadias
SELECT * FROM estadias ORDER BY expediente, id ;

SELECT DATEDIFF( fecha_hasta, fecha_desde) dias, fecha_desde, fecha_hasta FROM estadias WHERE usuario = 'gconsoli' AND fecha_hasta IS NULL

Creé un prg que calculas las estadias en cada usuario.


18/10/2022
Martes

Tareas abiertas por usuario, por Sector.
Tareas cerradas la ultima semana
Tareas cerradas el ultimo mes
Expedientes con mas demora
Menu Color azul por usuarios

-- Todas las tareas
SELECT * FROM estadias WHERE usuario='gconsoli' ; 12159 ;

-- Tareas agrupadas por anio
SELECT YEAR(fecha_desde) AS anio, COUNT(*) FROM estadias  WHERE usuario='gconsoli' GROUP BY anio ;

-- lapso de dias transcurridos entre recepcion y entrega de expedientes.
SELECT DATEDIFF( fecha_hasta , fecha_desde ) AS dias, expediente FROM estadias  WHERE usuario='gconsoli'


-- Tareas abiertas
SELECT * FROM estadias WHERE usuario='gconsoli' AND fecha_hasta IS NULL ; 15 ;

-- Tareas abiertas por usuario con demoras
SELECT DATEDIFF( CURRENT_DATE , fecha_desde ) AS dias, expediente FROM estadias WHERE usuario='gconsoli' AND fecha_hasta IS NULL 
ORDER BY dias DESC ; 15 ;

-- Tareas cerradas con mas demoras
SELECT DATEDIFF( fecha_hasta , fecha_desde ) AS dias, expediente FROM estadias WHERE usuario='gconsoli' AND fecha_hasta IS NOT NULL 
ORDER BY dias DESC ;   ;

-- Tareas cerradas con mas demoras del año
SELECT DATEDIFF( fecha_hasta , fecha_desde ) AS dias, expediente FROM estadias 
WHERE usuario='gconsoli' AND YEAR(fecha_desde) = 2022
AND fecha_hasta IS NOT NULL 
ORDER BY dias DESC ; 

-- Tareas cerradas del año promedio de demora
SELECT COUNT(*) AS expedientes, AVG( DATEDIFF( fecha_hasta , fecha_desde  ) ) AS promedio  FROM estadias 
WHERE usuario='gconsoli' AND YEAR(fecha_desde) = 2022
AND fecha_hasta IS NOT NULL 
  ; 
  
-- Tareas cerradas del año promedio de demora de mes SEPTIEMBRE
SELECT COUNT(*) AS expedientes, AVG( DATEDIFF( fecha_hasta , fecha_desde  ) ) AS promedio  FROM estadias 
WHERE usuario='gconsoli' AND YEAR(fecha_desde) = 2022 AND MONTH(fecha_desde) = 9
AND fecha_hasta IS NOT NULL 
  ; 
  
  -- Tareas cerradas del año promedio de demora POR MES
SELECT MONTH(FECHA_DESDE) AS MES,   COUNT(*) AS expedientes, AVG( DATEDIFF( fecha_hasta , fecha_desde  ) ) AS promedio  FROM estadias 
WHERE usuario='gconsoli' AND YEAR(fecha_desde) = 2022  
AND fecha_hasta IS NOT NULL GROUP BY MES ;


20/10/2022
Juevess
Parametrizar por usuario.

27/10/2022
Jueves

Incorporar gráficos Tareas por Mes y Carga respecto al Sector

28/10/2022
Viernes

Mejorar visualización de gráficos del Usuario

1/11/2022
Martes

Nube de palabras - Tag Cloud



2/11/2022
Miércoles

Capacidad de exportar a Excel.


3/11/2022
Jueves

8/11/2022
-Importar solo tablas de usuarios por el campo sexo. No hace falta importar historial
ni estadias porque no hubo cambios.
-Problema para reconocer las carpetas donde están los assets.
-Preparar para demostración para el el martes 15/11

9/11/2022

-Corregir ruta para assets
-Copiar tablas de usuarios.




24/11/2022

Estoy accediendo al Login con este url
http://dic-alex-tst.mendoza.gov.ar/alex/public/index.php/login

Sería deseable entrar con

http://dic-alex-tst.mendoza.gov.ar/login

Al Welcome accedor con
http://dic-alex-tst.mendoza.gov.ar/alex/public/index.php

Debería acceder con:
http://dic-alex-tst.mendoza.gov.ar/


Actualizar movimientos hasta el día de hoy.

11:15

--MOVIMIENTOS DE EXPEDIENTES HASTA 12/10 incremental solo los registros mayores a 21975200
SELECT
ID,TIPO_OPERACION,FECHA_OPERACION,USUARIO,EXPEDIENTE,ID_EXPEDIENTE,GRUPO_SELECCIONADO,
DESTINATARIO,REPARTICION_USUARIO,
substr(MOTIVO,0,40) as motivo ,
ESTADO_ANTERIOR,LOGGEDUSERNAME,ESTADO,USUARIO_SELECCIONADO,
TIPO_OPERACION_DETALLE,TAREA_GRUPAL,SECTOR_USUARIO_ORIGEN,CODIGO_REPARTICION_DESTINO,CODIGO_SECTOR_DESTINO,
DESCRIPCION_REPARTICION_ORIGEN,DESCRIPCION_SECTOR_ORIGEN,DESCRIPCION_SECTOR_DESTINO,DESCRIPCION_REPARTICION_DESTIN,
CODIGO_JURISDICCION_ORIGEN,CODIGO_JURISDICCION_DESTINO,ORD_HIST
from ee_ged.historialoperacion 
where ( codigo_reparticion_destino ='CGPROV#MHYF' or reparticion_usuario ='CGPROV#MHYF')
and extract( year from FECHA_OPERACION)=2022 and id >  22779814 order by id ;

--Tengo este ultimo registro en Alex
SELECT MAX(id) FROM historialoperaciones ; 23371586




#   A l e x M 4  
 "# ALEX-M4-OK" 
#   A l e x M e t a 4 2 0 2 4  
 