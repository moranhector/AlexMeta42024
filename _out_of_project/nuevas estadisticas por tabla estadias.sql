-- Todas las tareas
SELECT * FROM estadias WHERE usuario='gconsoli' ; 12159 ;

-- Tareas agrupadas por anio
SELECT YEAR(fecha_desde) AS anio, COUNT(*) FROM estadias  WHERE usuario='gconsoli' GROUP BY anio ;

-- lapso de dias transcurridos entre recepcion y entrega de expedientes.
SELECT DATEDIFF( fecha_hasta , fecha_desde ) AS dias, expediente FROM estadias  WHERE usuario='gconsoli'


-- Tareas abiertas
SELECT * FROM estadias WHERE usuario='gconsoli' AND fecha_hasta IS NULL ; 15 ;

-- expedientes con más demora
SELECT expediente, DATEDIFF(  CURRENT_DATE , fecha_desde    ) AS demora  FROM estadias
 WHERE usuario='gconsoli' AND fecha_hasta IS  NULL ORDER BY demora DESC

--Tareas cerradas los ultimos 30 dias
SELECT * FROM estadias  WHERE usuario='gconsoli' AND
DATEDIFF(  CURRENT_DATE  , fecha_hasta  )  <=30 

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
ORDER BY dias DESC LIMIT 1; 

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
  
-- Tareas cerradas del año promedio de demora de mes SEPTIEMBRE
SELECT COUNT(*) AS expedientes, AVG( DATEDIFF( fecha_hasta , fecha_desde  ) ) AS promedio  FROM estadias 
WHERE usuario='gconsoli' AND  
DATEDIFF(  CURRENT_DATE  , fecha_hasta  )  <=30 
AND fecha_hasta IS NOT NULL 
  ;  
SELECT * , DATEDIFF( fecha_hasta , fecha_desde  )  AS dias  FROM estadias 
WHERE usuario='gconsoli' AND  
DATEDIFF(  CURRENT_DATE  , fecha_hasta  )  <=30 
AND fecha_hasta IS NOT NULL 
  ;  
  
  
  -- Tareas cerradas del año promedio de demora POR MES
SELECT MONTH(FECHA_DESDE) AS MES,   COUNT(*) AS expedientes, AVG( DATEDIFF( fecha_hasta , fecha_desde  ) ) AS promedio  FROM estadias 
WHERE usuario='gconsoli' AND YEAR(fecha_desde) = 2022  
AND fecha_hasta IS NOT NULL GROUP BY MES ;
 

SELECT *,expediente, DATEDIFF(  CURRENT_DATE , fecha_desde    ) AS demora  FROM estadias
        WHERE usuario='gconsoli' AND fecha_hasta IS  NULL ORDER BY demora DESC