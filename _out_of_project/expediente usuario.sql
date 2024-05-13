SELECT * FROM usuarios WHERE nombre_usuario = 'gconsoli';

SELECT * FROM historialoperaciones;

SELECT MAX(id), id_expediente FROM historialoperaciones GROUP BY id_expediente 

SELECT 

-- ultimo destinatario

SELECT h.destinatario FROM historialoperaciones h
INNER JOIN
( SELECT MAX(id) AS id, id_expediente FROM historialoperaciones GROUP BY id_expediente )
ultimo_destinatario  

ON h.id_expediente = ultimo_destinatario.id_expediente
WHERE destinatario = 'GCONSOLI' ;

SELECT * FROM historialoperaciones WHERE ID_EXPEDIENTE = 2124877

-- ultimo paso de un expediente


SELECT MAX(id) AS id, id_expediente FROM historialoperaciones GROUP BY id_expediente ;

1448935

SELECT * FROM historialoperaciones WHERE ID_EXPEDIENTE = 1448935 ORDER BY id; ultimo paso 14935396;
-- expedientes en poder del usuario
SELECT DISTINCT  h.EXPEDIENTE, h.id_expediente, h.destinatario, h.fecha_operacion FROM historialoperaciones h
INNER JOIN
( SELECT MAX(id) AS id, id_expediente FROM historialoperaciones GROUP BY id_expediente )
ultimo_destinatario  

ON h.id  = ultimo_destinatario.id 
WHERE destinatario = 'GCONSOLI' ;