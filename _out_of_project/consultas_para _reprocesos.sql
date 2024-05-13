UPDATE cgpdashboard.xultimoid SET id = cantidad + 1, salidas = salidas +1 WHERE id_expediente = 84658;

SELECT * FROM historialoperaciones WHERE ID_EXPEDIENTE=  1265274

SELECT SUM( cantidad ) FROM xexpedientes

SELECT COUNT(*) FROM historialoperaciones;

12845160;

SELECT id, id_expediente, expediente,
        CONCAT( SUBSTR(fecha_operacion,7,4), SUBSTR(fecha_operacion,4,2) , SUBSTR(fecha_operacion,1,2) ) AS fecha,
        CODIGO_REPARTICION_DESTINO, REPARTICION_USUARIO
         FROM historialoperaciones  WHERE id >1   ORDER BY 1   LIMIT 5000