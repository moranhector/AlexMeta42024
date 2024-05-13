UPDATE historialoperaciones SET contado = NULL WHERE contado =1;
SELECT MAX( id ) FROM historialoperaciones WHERE contado IS NULL ;

SELECT * FROM historialoperaciones WHERE id = 21959966 ;

SELECT fecha_operacion FROM historialoperaciones WHERE id=
( SELECT MAX( id ) AS maiximo_id FROM historialoperaciones WHERE contado IS NULL );
SELECT 

SELECT * FROM historialoperaciones WHERE ID_EXPEDIENTE=558994

-- hay destinatario 
--REPROCESOS
SELECT * FROM xexpedientes ORDER BY entradas DESC

SELECT * FROM historialoperaciones WHERE EXPEDIENTE = 'EX20224296548GDEMZA-MGTYJ' ORDER BY id