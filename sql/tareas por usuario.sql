SELECT COUNT(*)  AS tareas, usuario FROM estadias WHERE usuario IN 

 ( SELECT nombre_usuario FROM usuarios WHERE codigo_sector_interno='SUBSAP2#CGPROV' )
 
 AND  YEAR( estadias.fecha_desde ) = 2022 GROUP BY usuario ;
 
 --
 
 SELECT COUNT(*)  AS tareas, usuario FROM estadias WHERE usuario IN

 ( SELECT nombre_usuario FROM usuarios WHERE codigo_sector_interno='SUBSAP2#CGPROV' )
 
 AND  YEAR( estadias.fecha_desde ) = 2022 GROUP BY usuario ;
 
 --
 
  SELECT COUNT(*)  AS tareas, usuario FROM estadias WHERE usuario = 'GCONSOLI' AND  YEAR( estadias.fecha_desde ) = 2022 ; 4683 ;
  
  --
  
  
  
  SELECT COUNT(*)  AS tareas , 'Resto' AS Usuario FROM estadias WHERE usuario IN

 ( SELECT nombre_usuario FROM usuarios WHERE codigo_sector_interno='SUBSAP2#CGPROV' )
 
 AND  YEAR( estadias.fecha_desde ) = 2022 AND usuario <> 'GCONSOLI' ;
 
 ---
 
   SELECT COUNT(*)  AS tareas, usuario FROM estadias WHERE usuario = 'GCONSOLI' AND  YEAR( estadias.fecha_desde ) = 2022  
  
UNION
  SELECT COUNT(*)  AS tareas , 'Resto' AS Usuario FROM estadias WHERE usuario IN

 ( SELECT nombre_usuario FROM usuarios WHERE codigo_sector_interno='SUBSAP2#CGPROV' )
 
 AND  YEAR( estadias.fecha_desde ) = 2022 AND usuario <> 'GCONSOLI'   ;
 
 
 
 --
 
 
 SELECT COUNT(*)  AS tareas, usuario FROM estadias WHERE usuario = 'gconsoli' AND  YEAR( estadias.fecha_desde ) = 2022  
    UNION
      SELECT COUNT(*)  AS tareas , 'Resto' AS Usuario FROM estadias WHERE usuario IN    
     ( SELECT nombre_usuario FROM usuarios WHERE codigo_sector_interno='SUBSAP2#CGPROV' )     
     AND  YEAR( estadias.fecha_desde ) = 2022 AND usuario <> 'gconsoli' 
     
     --
     
     con grupos 
     
     
      SELECT COUNT(*)  AS tareas, usuario FROM estadias WHERE usuario = 'gconsoli' AND  YEAR( estadias.fecha_desde ) = 2022  GROUP BY usuario
    UNION
      SELECT COUNT(*)  AS tareas , 'Resto' AS Usuario FROM estadias WHERE usuario IN    
     ( SELECT nombre_usuario FROM usuarios WHERE codigo_sector_interno='SUBSAP2#CGPROV' )     
     AND  YEAR( estadias.fecha_desde ) = 2022 AND usuario <> 'gconsoli' GROUP BY 'Resto'
 
 