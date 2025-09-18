# Práctica SQL: Joins, Agregaciones y Sentencias CASE

En esta práctica se exploraron diferentes tipos de **joins**, funciones de agregación, la cláusula `HAVING` y el uso de sentencias `CASE`. A continuación se muestra un resumen con ejemplos de código.

## 1. Left Join

El `LEFT JOIN` devuelve todos los registros de la tabla izquierda (`customers`) y los registros coincidentes de la tabla derecha (`orders`). Si no hay coincidencia, el resultado será `NULL`.

**Ejemplo:** Seleccionar todos los clientes que no tengan órdenes:

```sql
SELECT
  c.CustomerID,
  c.CustomerName
FROM
  customers AS c
LEFT JOIN
  orders AS o ON c.CustomerID = o.CustomerID
WHERE
  o.CustomerID IS NULL;
```

## 2. Right Join

El `RIGHT JOIN` devuelve todos los registros de la tabla derecha (`customers`) y los registros coincidentes de la tabla izquierda (`orders`). Si no hay coincidencia, el resultado será `NULL`.

**Ejemplo:** Seleccionar todos los clientes que no tengan órdenes usando `RIGHT JOIN`:

```sql
SELECT
  c.CustomerID,
  c.CustomerName
FROM
  orders AS o
RIGHT JOIN
  customers AS c ON c.CustomerID = o.CustomerID
WHERE 
  o.CustomerID IS NULL;
```

## 3. Cross Join

El `CROSS JOIN` devuelve el producto cartesiano de las dos tablas. Cada fila de la primera tabla se combina con cada fila de la segunda tabla.

**Ejemplo:**

```sql
SELECT 
  *
FROM 
  customers AS c 
CROSS JOIN 
  orders AS o;
```

> Nota: En SQL, `CROSS JOIN` no utiliza condición `ON`; combina todas las filas.

## 4. Self Join

Un `SELF JOIN` se utiliza para unir una tabla consigo misma. Es útil para comparar filas dentro de la misma tabla.

**Ejemplo:** Encontrar clientes que viven en la misma ciudad:

```sql
SELECT
  c1.CustomerName,
  c1.City,
  c2.CustomerName AS CustomerWithSameCity
FROM
  customers AS c1
JOIN
  customers AS c2 ON c1.City = c2.City AND c1.CustomerID != c2.CustomerID
ORDER BY
  c1.City;
```

## 5. Agregación y HAVING

La cláusula `HAVING` se usa para filtrar grupos después de aplicar funciones de agregación como `COUNT`, `SUM`, `AVG`, etc.

**Ejemplo:** Contar clientes por país con más de 9 clientes:

```sql
SELECT 
  COUNT(CustomerID) AS total,
  country 
FROM customers
GROUP BY country 
HAVING total > 9
ORDER BY total DESC;
```

## 6. Sentencia CASE

La sentencia `CASE` permite usar lógica condicional en consultas SQL.

**Ejemplo:** Determinar si una orden califica para envío gratis:

```sql
SELECT 
  od.orderid,
  od.quantity,
  CASE 
    WHEN od.quantity >= 10 THEN true 
    ELSE false
  END AS EnvioGratis
FROM 
  order_details AS od;
```

> Simplificado: si la cantidad es 10 o más, `EnvioGratis` será `true`; de lo contrario, `false`.

## Resumen

En esta práctica se trabajó con:

- **Joins:** `LEFT`, `RIGHT`, `CROSS` y `SELF` 
- **Funciones de agregación** con `GROUP BY` y `HAVING` 
- **Lógica condicional** usando `CASE` 

Estos conceptos son fundamentales para consultar bases de datos relacionales de manera efectiva.
