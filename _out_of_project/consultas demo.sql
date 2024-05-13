SELECT * FROM historialoperaciones WHERE YEAR( registrado_at )= 2022 AND MONTH( registrado_at ) = 7 ;

SELECT DISTINCT expediente FROM historialoperaciones WHERE YEAR( registrado_at )= 2022 AND MONTH( registrado_at ) = 7 ; 13746 ;
SELECT COUNT(*) FROM historialoperaciones WHERE YEAR( registrado_at )= 2022 AND MONTH( registrado_at ) = 7 ; 32755 ;

SELECT MONTH( registrado_at ) AS mes, COUNT( DISTINCT expediente ) FROM historialoperaciones  WHERE YEAR( registrado_at )= 2022 GROUP BY mes

SELECT YEAR( registrado_at ) AS anio, COUNT( DISTINCT expediente ) FROM historialoperaciones GROUP BY anio ;

SELECT COUNT( DISTINCT expediente ) FROM historialoperaciones WHERE YEAR( registrado_at )= 2019 ; 118740 ;
SELECT COUNT( DISTINCT expediente ) FROM historialoperaciones WHERE YEAR( registrado_at )= 2020 ; 111469 ;