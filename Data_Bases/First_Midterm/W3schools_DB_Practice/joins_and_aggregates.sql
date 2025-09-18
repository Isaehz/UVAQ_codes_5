use w3schools;

-- Selecciona todos los clientes que no tegan ordenes
-- Uso del left join
SELECT
  c.CustomerID,
  c.CustomerName
FROM
  customers as c
LEFT JOIN
  orders as o ON c.CustomerID = o.CustomerID
WHERE
  o.CustomerID IS NULL

-- Uso del rigth join
SELECT
  c.CustomerID,
  c.CustomerName
FROM
  orders AS o
RIGHT JOIN
  customers AS c ON c.CustomerID = o.CustomerID
WHERE 
  o.CustomerID is null;

-- Uso del cross join
SELECT 
  *
FROM 
  customers AS c 
CROSS JOIN 
  orders AS o ON c.CustomerID = o.CustomerID;

-- Uso del self join 
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

-- Uso del having
SELECT 
  count(customerid) AS total,
  country 
FROM customers
GROUP BY country HAVING total > 9 ORDER BY total desc;

-- Uso del case
SELECT 
  od.orderid,
  od.quantity,
  CASE 
    WHEN od.quantity >= 10 THEN true 
    WHEN od.quantity < 10 THEN false 
    ELSE false
  END as EnvioGratis
FROM 
  order_details AS od;
