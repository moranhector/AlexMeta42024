SELECT * FROM usuarios WHERE numero_cuit='20180834711' 

SELECT * FROM usuarios WHERE numero_cuit='27253524907' ;

LOAD DATA INFILE 'usuarios3.csv' INTO TABLE usuarios FIELDS TERMINATED BY ',' ENCLOSED BY '"'  IGNORE 1 LINES;

TRUNCATE TABLE `cgpdashboard`.`usuarios`; 

LOAD DATA INFILE 'usuarios4.csv' INTO TABLE usuarios FIELDS TERMINATED BY ',' ENCLOSED BY '"'  IGNORE 1 LINES;


SELECT COUNT(*) AS cantidad, SUBSTR(fecha_operacion,4,2) AS mes FROM historialoperaciones WHERE CODIGO_REPARTICION_DESTINO='CGPROV#MHYF'
AND
REPARTICION_USUARIO <>'CGPROV#MHYF' AND SUBSTR(FECHA_OPERACION,7,4) = '2022'
GROUP BY mes ORDER BY mes;

SELECT COUNT(*) AS cantidad, destinatario   AS Usuario, usuarios.apellido_nombre FROM historialoperaciones 
INNER JOIN usuarios ON historialoperaciones.destinatario=usuarios.nombre_usuario 
WHERE CODIGO_REPARTICION_DESTINO='CGPROV#MHYF' AND
        REPARTICION_USUARIO <>'CGPROV#MHYF'
        AND SUBSTR(FECHA_OPERACION,7,4) = '2022' AND SUBSTR(fecha_operacion,4,2) = '01' 
        GROUP BY destinatario,apellido_nombre ORDER BY cantidad DESC ;
        
SELECT COUNT(*) AS cantidad, destinatario   AS Usuario, usuarios.apellido_nombre FROM historialoperaciones 
INNER JOIN usuarios ON historialoperaciones.destinatario=usuarios.nombre_usuario 
WHERE CODIGO_REPARTICION_DESTINO='CGPROV#MHYF' AND
        REPARTICION_USUARIO <>'CGPROV#MHYF'
        AND SUBSTR(FECHA_OPERACION,7,4) = '2022' AND SUBSTR(fecha_operacion,4,2) = '01' 
        GROUP BY destinatario,apellido_nombre ORDER BY cantidad DESC ;        
        
        
        
SELECT  destinatario, ENTRANTES, SALIENTES, ENTRANTES - SALIENTES AS DIFERENCIA, TOTALES FROM
        (  
        SELECT 
        SUM( IF(CODIGO_REPARTICION_DESTINO='CGPROV#MHYF'
        AND 
        REPARTICION_USUARIO <>'CGPROV#MHYF', 1, 0 ) ) AS ENTRANTES,        
        SUM( IF( CODIGO_REPARTICION_DESTINO<>'CGPROV#MHYF'
        AND 
        REPARTICION_USUARIO ='CGPROV#MHYF', 1, 0 ) ) AS SALIENTES,
        COUNT( *) AS TOTALES ,
        destinatario
        FROM historialoperaciones WHERE SUBSTR(fecha_operacion,7,4)='2022' AND SUBSTR(fecha_operacion,4,2) = '01' 
        GROUP BY destinatario ) AS EXPEDIENTES    
        ORDER BY entrantes DESC 
        
        ;    
        
        
        
        -- ENTRANTES
 
        SELECT 
        SUM( IF(CODIGO_REPARTICION_DESTINO='CGPROV#MHYF'
        AND 
        REPARTICION_USUARIO <>'CGPROV#MHYF', 1, 0 ) ) AS ENTRANTES ,       
        destinatario, u.apellido_nombre
        FROM historialoperaciones 
        INNER JOIN usuarios u ON historialoperaciones.destinatario=u.nombre_usuario
        WHERE SUBSTR(fecha_operacion,7,4)='2022' AND SUBSTR(fecha_operacion,4,2) = '01' 
	-- and u.codigo_reparticion = 'CGPROV#MHYF'
        GROUP BY destinatario
        
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
        
        -- SALIENTES  INTERNO   
        
        SELECT 
        SUM( IF( CODIGO_REPARTICION_DESTINO='CGPROV#MHYF'
        AND 
        REPARTICION_USUARIO ='CGPROV#MHYF', 1, 0 ) ) AS SALIENTES_INTERNO,      
        usuario 
        FROM historialoperaciones 
        INNER JOIN usuarios u ON historialoperaciones.usuario=u.nombre_usuario
        WHERE SUBSTR(fecha_operacion,7,4)='2022' AND SUBSTR(fecha_operacion,4,2) = '01' 	
        GROUP BY usuario  
 
         -- ENTRANTE  INTERNO   
        
        SELECT 
        SUM( IF( CODIGO_REPARTICION_DESTINO='CGPROV#MHYF'
        AND 
        REPARTICION_USUARIO ='CGPROV#MHYF', 1, 0 ) ) AS ENTRANTE_INTERNO,      
        DESTINATARIO
        FROM historialoperaciones 
        INNER JOIN usuarios u ON historialoperaciones.destinatario = u.nombre_usuario
        WHERE SUBSTR(fecha_operacion,7,4)='2022' AND SUBSTR(fecha_operacion,4,2) = '01' 	
        GROUP BY destinatario        
        
   ------------- ++++++++++++++++    
   
   
███╗   ███╗ ██████╗ ██╗   ██╗██╗███╗   ███╗██╗███████╗███╗   ██╗████████╗ ██████╗ ███████╗
████╗ ████║██╔═══██╗██║   ██║██║████╗ ████║██║██╔════╝████╗  ██║╚══██╔══╝██╔═══██╗██╔════╝
██╔████╔██║██║   ██║██║   ██║██║██╔████╔██║██║█████╗  ██╔██╗ ██║   ██║   ██║   ██║███████╗
██║╚██╔╝██║██║   ██║╚██╗ ██╔╝██║██║╚██╔╝██║██║██╔══╝  ██║╚██╗██║   ██║   ██║   ██║╚════██║
██║ ╚═╝ ██║╚██████╔╝ ╚████╔╝ ██║██║ ╚═╝ ██║██║███████╗██║ ╚████║   ██║   ╚██████╔╝███████║
╚═╝     ╚═╝ ╚═════╝   ╚═══╝  ╚═╝╚═╝     ╚═╝╚═╝╚══════╝╚═╝  ╚═══╝   ╚═╝    ╚═════╝ ╚══════╝
                                                                                          
          
        
        -- *******************************************************************
        SELECT entrantes.destinatario, apelnom, entrantes, salientes , entrantes_internos.entrantes_INTERNOS , salientes_internos.SALIENTES_INTERNOS FROM 
        (
 -- ENTRANTES
        SELECT 
        SUM( IF(CODIGO_REPARTICION_DESTINO='CGPROV#MHYF'
        AND 
        REPARTICION_USUARIO <>'CGPROV#MHYF', 1, 0 ) ) AS ENTRANTES ,       
        destinatario , u.apellido_nombre AS apelnom
        FROM historialoperaciones 
        INNER JOIN usuarios u ON historialoperaciones.destinatario=u.nombre_usuario
        WHERE SUBSTR(fecha_operacion,7,4)='2022' AND SUBSTR(fecha_operacion,4,2) = '01' 
         GROUP BY destinatario         
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
        WHERE SUBSTR(fecha_operacion,7,4)='2022' AND SUBSTR(fecha_operacion,4,2) = '01' 	
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
        WHERE SUBSTR(fecha_operacion,7,4)='2022' AND SUBSTR(fecha_operacion,4,2) = '01' 	
        GROUP BY usuario 
        ) AS salientes_internos
         ON entrantes.destinatario = salientes_internos.usuario   
         
    
            
            
        
            -- ********************************    
            
         
                       _           _            _            
                      (_)         (_)          | |           
  _ __ ___   _____   ___ _ __ ___  _  ___ _ __ | |_ ___  ___ 
 | '_ ` _ \ / _ \ \ / / | '_ ` _ \| |/ _ \ '_ \| __/ _ \/ __|
 | | | | | | (_) \ V /| | | | | | | |  __/ | | | || (_) \__ \
 |_| |_| |_|\___/ \_/ |_|_| |_| |_|_|\___|_| |_|\__\___/|___/
                                                             
                                                                         
              -- ********************************         
                  
   
SELECT COUNT(*) AS cantidad, SUBSTR(fecha_operacion,4,2) as mes FROM historialoperaciones WHERE CODIGO_REPARTICION_DESTINO='CGPROV#MHYF'
AND
REPARTICION_USUARIO <>'CGPROV#MHYF' AND SUBSTR(FECHA_OPERACION,7,4) = '2022'
GROUP BY mes ORDER BY mes
-- expedientes_usuario

;


SELECT 
  COUNT(*) AS cantidad,
  destinatario as Usuario,
  usuarios.apellido_nombre 
FROM
  historialoperaciones 
  inner join usuarios 
    on historialoperaciones.destinatario = usuarios.nombre_usuario 
WHERE CODIGO_REPARTICION_DESTINO = 'CGPROV#MHYF' 
  AND REPARTICION_USUARIO <> 'CGPROV#MHYF' 
  AND SUBSTR(FECHA_OPERACION, 7, 4) = '2022' 
  AND SUBSTR(fecha_operacion, 4, 2) = '01' 
GROUP BY destinatario,
  apellido_nombre 
ORDER BY cantidad DESC 
;


        SELECT 
        SUM( IF(CODIGO_REPARTICION_DESTINO='CGPROV#MHYF'
        AND 
        REPARTICION_USUARIO <>'CGPROV#MHYF', 1, 0 ) ) AS ENTRANTES ,       
        destinatario AS usuario, u.apellido_nombre AS apelnom
        FROM historialoperaciones 
        INNER JOIN usuarios u ON historialoperaciones.destinatario=u.nombre_usuario
        WHERE SUBSTR(fecha_operacion,7,4)='2022' AND SUBSTR(fecha_operacion,4,2) = '01' 
         GROUP BY usuario 
         ;
         

  ;
 
        SELECT 
        SUM( IF(CODIGO_REPARTICION_DESTINO='CGPROV#MHYF'
        AND 
        REPARTICION_USUARIO <>'CGPROV#MHYF', 1, 0 ) ) AS ENTRANTES ,       
        destinatario, u.apellido_nombre AS apelnom
        FROM historialoperaciones 
        INNER JOIN usuarios u ON historialoperaciones.destinatario=u.nombre_usuario
        WHERE SUBSTR(fecha_operacion,7,4)='2022' AND SUBSTR(fecha_operacion,4,2) = '01' AND DESTINATARIO='GCONSOLI'
         GROUP BY destinatario
         
  -- reviso los ENTRANTES -          
         
 select * from historialoperaciones
  WHERE CODIGO_REPARTICION_DESTINO = 'CGPROV#MHYF' 
  AND REPARTICION_USUARIO <> 'CGPROV#MHYF' 
  AND SUBSTR(FECHA_OPERACION, 7, 4) = '2022' 
  AND SUBSTR(fecha_operacion, 4, 2) = '01' 
  and DESTINATARIO='GCONSOLI'
         
         
 -- reviso los salientes de contaduria - OK COMPROBADO
 
  select * from historialoperaciones
  WHERE CODIGO_REPARTICION_DESTINO<>'CGPROV#MHYF'
        AND 
        REPARTICION_USUARIO ='CGPROV#MHYF' 
  AND SUBSTR(FECHA_OPERACION, 7, 4) = '2022' 
  AND SUBSTR(fecha_operacion, 4, 2) = '01' 
  and usuario='GCONSOLI'
  ;   
  
  
    -- reviso los ENTRANTES INTERNOS -          
         
 select * from historialoperaciones
  WHERE CODIGO_REPARTICION_DESTINO = 'CGPROV#MHYF' 
  AND REPARTICION_USUARIO = 'CGPROV#MHYF' 
  AND SUBSTR(FECHA_OPERACION, 7, 4) = '2022' 
  AND SUBSTR(fecha_operacion, 4, 2) = '01' 
  and DESTINATARIO='GCONSOLI'  
  
  
 -- reviso los salientes INTERNOS - OK COMPROBADO
 
  select * from historialoperaciones
  WHERE CODIGO_REPARTICION_DESTINO='CGPROV#MHYF'
        AND 
        REPARTICION_USUARIO ='CGPROV#MHYF' 
  AND SUBSTR(FECHA_OPERACION, 7, 4) = '2022' 
  AND SUBSTR(fecha_operacion, 4, 2) = '01' 
  and usuario='GCONSOLI'
  ;  
  
  -- TOTALES DE MOVIMIENTOS POR USUARIO
  
   select * from historialoperaciones
  WHERE  
  SUBSTR(FECHA_OPERACION, 7, 4) = '2022' 
  AND SUBSTR(fecha_operacion, 4, 2) = '01' 
  and ( usuario='GCONSOLI'   OR destinatario='GCONSOLI' )    
  -- 1467
     select * from historialoperaciones
  WHERE  
  SUBSTR(FECHA_OPERACION, 7, 4) = '2022' 
  AND SUBSTR(fecha_operacion, 4, 2) = '01' 
  and ( usuario='GCONSOLI'   and destinatario='GCONSOLI' ) 
  
  
  --- PARA GRAFICAR SOLO USUARIO Y ENTRADAS
  
  
  
$cSelect = 
"

SELECT entrantes.destinatario as usuario, apelnom, entrantes, salientes , 
entrantes_internos.entrantes_internos , salientes_internos.SALIENTES_INTERNOS FROM 
(
-- ENTRANTES
SELECT 
SUM( IF(CODIGO_REPARTICION_DESTINO='CGPROV#MHYF'
AND 
REPARTICION_USUARIO <>'CGPROV#MHYF', 1, 0 ) ) AS ENTRANTES ,       
concat( destinatario , u.apellido_nombre ) AS apelnom
FROM historialoperaciones 
INNER JOIN usuarios u ON historialoperaciones.destinatario=u.nombre_usuario
WHERE SUBSTR(fecha_operacion,7,4)='2022' AND SUBSTR(fecha_operacion,4,2) = '01' 
 GROUP BY destinatario, apellido_nombre       
 ) AS entrantes
 
 
 
  select  concat( destinatario, space(1),  u.apellido_nombre) as destinatario , count(*) as cantidad from historialoperaciones
    INNER JOIN usuarios u ON historialoperaciones.destinatario=u.nombre_usuario
    WHERE CODIGO_REPARTICION_DESTINO = 'CGPROV#MHYF' 
  AND REPARTICION_USUARIO <> 'CGPROV#MHYF' 
  AND SUBSTR(FECHA_OPERACION, 7, 4) = '2022' 
  AND SUBSTR(fecha_operacion, 4, 2) = '01' 
   group by destinatario
   order by cantidad desc limit 10
