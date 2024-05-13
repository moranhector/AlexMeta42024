SELECT * FROM existencias e

INNER JOIN inventarios i 

ON e.inventario_id = i.id

WHERE i.id = 126523
AND e.fecha_hasta IS NULL ;

SELECT * FROM existencias;

UPDATE existencias SET fecha_hasta = NULL  WHERE fecha_hasta = '0000-00-00 00:00:00';

--

SELECT * FROM existencias e
INNER JOIN inventarios i 
ON e.inventario_id = i.id
INNER JOIN depositos d
ON e.deposito_id = d.id
WHERE i.id = 126523
AND e.fecha_hasta IS NULL ;

SELECT i.id,i.npieza, i.namepieza,d.nombre AS deposito FROM existencias e
INNER JOIN inventarios i 
ON e.inventario_id = i.id
INNER JOIN depositos d
ON e.deposito_id = d.id
WHERE i.id = 126523
AND e.fecha_hasta IS NULL ;

SELECT i.id,i.npieza, i.namepieza,d.nombre AS deposito, 
t.descrip AS tipopieza, t.tecnica, a.nombre, a.lugar,
i.comprado_at, i.costo,i.precio, i.vendido_at
 FROM existencias e
INNER JOIN inventarios i 
ON e.inventario_id = i.id
INNER JOIN depositos d
ON e.deposito_id = d.id
INNER JOIN tipopiezas t
ON i.tipopieza_id = t.id
INNER JOIN artesanos a
ON i.artesano_id = a.id
WHERE i.id = 126523
AND e.fecha_hasta IS NULL ;


SELECT i.id,i.npieza, i.namepieza,d.nombre AS deposito, 
t.descrip AS tipopieza, t.tecnica, a.nombre, a.lugar,
i.comprado_at, i.costo,i.precio, i.vendido_at
 FROM existencias e
INNER JOIN inventarios i 
ON e.inventario_id = i.id
INNER JOIN depositos d
ON e.deposito_id = d.id
INNER JOIN tipopiezas t
ON i.tipopieza_id = t.id
INNER JOIN artesanos a
ON i.artesano_id = a.id
WHERE i.id = 124513
AND e.fecha_hasta IS NULL ;





SELECT * FROM inventarios WHERE id = 126523 ;

SELECT i.id,i.npieza, i.namepieza,d.nombre AS deposito, 
t.descrip AS tipopieza, t.tecnica, a.nombre, a.lugar,
i.comprado_at, i.costo,i.precio, i.vendido_at, i.factura
 FROM existencias e
INNER JOIN inventarios i 
ON e.inventario_id = i.id
INNER JOIN depositos d
ON e.deposito_id = d.id
INNER JOIN tipopiezas t
ON i.tipopieza_id = t.id
INNER JOIN artesanos a
ON i.artesano_id = a.id
WHERE i.vendido_at IS NULL ;

-- XAMINA
USE xamina;
CREATE TEMPORARY TABLE xaminaweb.estaspiezas  
SELECT 
  npieza,
  namepieza,
  comprob,
  i.costo,
  codprecio AS nrubro,
  p.nombrepieza AS rubro,
  d.nombre AS deposito,
  r.fecha 
FROM
  inventario i 
  LEFT JOIN facturasr f 
    ON i.npieza = f.codigo 
  LEFT JOIN facturas ff 
    ON f.numero = ff.formulario 
  LEFT JOIN precios p 
    ON i.codprecio = p.precio 
  LEFT JOIN depositos d USING (deposito) 
  LEFT JOIN RECIBOS R 
    ON i.comprob = r.formulario 
WHERE (
    i.factura = ' ' 
    OR ff.fecha > '2022-10-07'
  ) 
  AND (
    ISNULL(r.fecha) 
    OR r.fecha <= '2022-10-07'
  ) 
 
 
 --
USE xaminaweb

SELECT * FROM estaspiezas ;

SELECT i.id,i.npieza, i.namepieza,d.nombre AS deposito, 
t.descrip AS tipopieza, t.tecnica, a.nombre, a.lugar,
i.comprado_at, i.costo,i.precio, i.vendido_at, i.factura
 FROM existencias e
INNER JOIN inventarios i 
ON e.inventario_id = i.id
INNER JOIN depositos d
ON e.deposito_id = d.id
INNER JOIN tipopiezas t
ON i.tipopieza_id = t.id
INNER JOIN artesanos a
ON i.artesano_id = a.id
RIGHT JOIN estaspiezas f
ON i.npieza = f.npieza
WHERE i.vendido_at IS NULL ;

-- hagamos una temporal de inventario xw

CREATE TEMPORARY TABLE mispiezas
SELECT i.id,i.npieza, i.namepieza,d.nombre AS deposito, 
t.descrip AS tipopieza, t.tecnica, a.nombre, a.lugar,
i.comprado_at, i.costo,i.precio, i.vendido_at, i.factura
 FROM existencias e
INNER JOIN inventarios i 
ON e.inventario_id = i.id
INNER JOIN depositos d
ON e.deposito_id = d.id
INNER JOIN tipopiezas t
ON i.tipopieza_id = t.id
INNER JOIN artesanos a
ON i.artesano_id = a.id

WHERE i.vendido_at IS NULL ;

SELECT * FROM estaspiezas e LEFT JOIN mispiezas m ON e.npieza = m.npieza;
--
-- esta pieza no está en xw 127185

SELECT i.id,i.npieza, i.namepieza,d.nombre AS deposito, 
t.descrip AS tipopieza, t.tecnica, a.nombre, a.lugar,
i.comprado_at, i.costo,i.precio, i.vendido_at
 FROM existencias e
INNER JOIN inventarios i 
ON e.inventario_id = i.id
INNER JOIN depositos d
ON e.deposito_id = d.id
INNER JOIN tipopiezas t
ON i.tipopieza_id = t.id
INNER JOIN artesanos a
ON i.artesano_id = a.id
WHERE i.id = 127185
AND e.fecha_hasta IS NULL ;
SELECT * FROM inventarios WHERE id= 127185

SELECT * FROM inventario WHERE npieza = 127185


SELECT *
 FROM existencias e
INNER JOIN inventarios i 
ON e.inventario_id = i.id
INNER JOIN depositos d
ON e.deposito_id = d.id
INNER JOIN tipopiezas t
ON i.tipopieza_id = t.id
INNER JOIN artesanos a
ON i.artesano_id = a.id
RIGHT JOIN estaspiezas f
ON i.npieza = f.npieza
WHERE i.vendido_at IS NULL ;

SELECT *
 FROM existencias e
INNER JOIN inventarios i 
ON e.inventario_id = i.id
INNER JOIN depositos d
ON e.deposito_id = d.id
INNER JOIN tipopiezas t
ON i.tipopieza_id = t.id
RIGHT JOIN estaspiezas f
ON i.npieza = f.npieza
WHERE f.npieza = 127185 ;

SELECT * FROM inventario WHERE npieza=127185;

SELECT * FROM artesanos WHERE id =1043;

CREATE TEMPORARY TABLE piezas
SELECT i.id
 FROM existencias e
INNER JOIN inventarios i 
ON e.inventario_id = i.id
INNER JOIN depositos d
ON e.deposito_id = d.id
INNER JOIN tipopiezas t
ON i.tipopieza_id = t.id
INNER JOIN artesanos a
ON i.artesano_id = a.id
WHERE i.vendido_at IS NULL ;

SELECT * FROM piezas ;1453
DROP TABLE piezas ;

SELECT * FROM piezas p RIGHT JOIN estaspiezas e ON p.id = e.npieza WHERE p.id IS NULL; 124952 ; 125110; 124952 esta vendida, fecha de vendido_at es incorrecta
SELECT * FROM inventarios WHERE id = 124952 
SELECT * FROM inventarios ORDER BY vendido_at

2604-12-03 000500000063 2019-08-03 ;


-- INVENTARIO
SELECT i.id,i.npieza, i.namepieza,d.nombre AS deposito, 
t.descrip AS tipopieza, t.tecnica, a.nombre, a.lugar,
i.comprado_at, i.costo,i.precio, i.vendido_at, i.factura
 FROM existencias e
INNER JOIN inventarios i 
ON e.inventario_id = i.id
INNER JOIN depositos d
ON e.deposito_id = d.id
INNER JOIN tipopiezas t
ON i.tipopieza_id = t.id
INNER JOIN artesanos a
ON i.artesano_id = a.id
WHERE i.vendido_at IS NULL 

-- INVENTARIO CUENTA

SELECT COUNT(*)
 FROM existencias e
INNER JOIN inventarios i 
ON e.inventario_id = i.id
INNER JOIN depositos d
ON e.deposito_id = d.id
INNER JOIN tipopiezas t
ON i.tipopieza_id = t.id
INNER JOIN artesanos a
ON i.artesano_id = a.id
WHERE i.vendido_at IS NULL 

-- cuenta simplificada
SELECT COUNT(*) FROM inventarios WHERE inventarios.vendido_at IS NULL

-- inventario por depósitos
SELECT d.nombre , COUNT(*)
 FROM existencias e
INNER JOIN inventarios i 
ON e.inventario_id = i.id
INNER JOIN depositos d
ON e.deposito_id = d.id
WHERE i.vendido_at IS NULL 
GROUP BY d.nombre

-- movimientos de la pieza 

SELECT * FROM existencias WHERE inventario_id = 110484

SELECT * FROM inventarios  i 
INNER JOIN existencias e
ON i.id = e.inventario_id
WHERE i.id = 110484
AND e.fecha_hasta IS NULL
